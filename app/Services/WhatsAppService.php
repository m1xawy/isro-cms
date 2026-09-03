<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private string $token;

    private string $phoneNumberId;

    private string $apiVersion;

    public function __construct()
    {
        $this->token = (string) config('services.whatsapp.token', '');
        $this->phoneNumberId = (string) config('services.whatsapp.phone_number_id', '');
        $this->apiVersion = (string) config('services.whatsapp.api_version', 'v20.0');
    }

    public function enabled(): bool
    {
        return (bool) config('services.whatsapp.enabled', false)
            && $this->token !== ''
            && $this->phoneNumberId !== '';
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

        $url = "https://graph.facebook.com/{$this->apiVersion}/{$this->phoneNumberId}/messages";

        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => ltrim($to, '+'),
            'type' => 'text',
            'text' => ['preview_url' => false, 'body' => $message],
        ];

        $response = Http::withToken($this->token)
            ->acceptJson()
            ->post($url, $payload);

        if ($response->successful()) {
            Log::info('WhatsApp message sent.', [
                'to' => $to,
                'message_id' => data_get($response->json(), 'messages.0.id'),
            ]);

            return true;
        }

        Log::error('WhatsApp message failed.', [
            'to' => $to,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return false;
    }
}
