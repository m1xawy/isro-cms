<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private string $token;

    private string $baseUrl;

    public function __construct()
    {
        $this->token = (string) config('services.whatsapp.token', '');
        $this->baseUrl = rtrim((string) config('services.whatsapp.base_url', 'https://waba-v2.360dialog.io'), '/');
    }

    public function enabled(): bool
    {
        return (bool) config('services.whatsapp.enabled', false)
            && $this->token !== '';
    }

    /**
     * Send a plain text WhatsApp message to a number.
     * The number should be in E.164 format without the leading "+" (e.g. 15551234567).
     */
    public function sendText(string $to, string $message): bool
    {
        if (! $this->enabled()) {
            Log::warning('WhatsApp is not configured. Skipping message.', ['to' => $to]);

            return false;
        }

        return $this->send([
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => ltrim($to, '+'),
            'type' => 'text',
            'text' => ['preview_url' => false, 'body' => $message],
        ]);
    }

    /**
     * Send an approved template message to a number. This is the only message
     * type allowed outside of the 24-hour customer service window.
     */
    public function sendTemplate(string $to, string $templateName, array $parameters = [], string $language = 'en_US'): bool
    {
        if (! $this->enabled()) {
            Log::warning('WhatsApp is not configured. Skipping message.', ['to' => $to]);

            return false;
        }

        $bodyParams = array_map(fn ($param) => ['type' => 'text', 'text' => (string) $param], $parameters);

        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => ltrim($to, '+'),
            'type' => 'template',
            'template' => [
                'name' => $templateName,
                'language' => ['code' => $language],
                'components' => $bodyParams ? [['type' => 'body', 'parameters' => $bodyParams]] : [],
            ],
        ];

        return $this->send($payload);
    }

    private function send(array $payload): bool
    {
        $response = Http::withHeaders(['D360-API-KEY' => $this->token])
            ->acceptJson()
            ->post($this->baseUrl.'/messages', $payload);

        if ($response->successful()) {
            Log::info('WhatsApp message sent.', [
                'to' => $payload['to'],
                'message_id' => data_get($response->json(), 'messages.0.id'),
            ]);

            return true;
        }

        Log::error('WhatsApp message failed.', [
            'to' => $payload['to'],
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return false;
    }
}
