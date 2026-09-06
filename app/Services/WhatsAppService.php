<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class WhatsAppService
{
    private string $sid;

    private string $token;

    private string $from;

    public function __construct()
    {
        $this->sid = (string) config('services.whatsapp.account_sid', '');
        $this->token = (string) config('services.whatsapp.auth_token', '');
        $this->from = ltrim((string) config('services.whatsapp.from', '14155238886'), '+');
    }

    public function enabled(): bool
    {
        return (bool) config('services.whatsapp.enabled', false)
            && $this->sid !== ''
            && $this->token !== ''
            && $this->from !== '';
    }

    /**
     * Send a plain text WhatsApp message. Number in E.164 form, e.g. 201028625484.
     */
    public function sendText(string $to, string $message): bool
    {
        if (! $this->enabled()) {
            Log::warning('WhatsApp is not configured. Skipping message.', ['to' => $to]);

            return false;
        }

        return $this->send($to, ['Body' => $message]);
    }

    /**
     * Send a Twilio WhatsApp content template (required for business-initiated
     * messages outside the 24 hour window). $contentSid is the template SID,
     * $variables is a [placeholder => value] map.
     */
    public function sendTemplate(string $to, string $contentSid, array $variables = []): bool
    {
        if (! $this->enabled()) {
            Log::warning('WhatsApp is not configured. Skipping message.', ['to' => $to]);

            return false;
        }

        return $this->send($to, [
            'ContentSid' => $contentSid,
            'ContentVariables' => json_encode($variables),
        ]);
    }

    /**
     * Send a WhatsApp account verification link (replaces the email
     * verification sent for new registrations). Only works when the API is
     * enabled and the user has a phone number.
     */
    public function sendVerificationLink(User $user): bool
    {
        if (! $this->enabled() || empty($user->phone)) {
            return false;
        }

        return $this->sendText($user->phone, __((string) config(
            'services.whatsapp.confirm_message',
            'Confirm your account here: :verify_link'
        ), [
            'site' => config('global.site_name'),
            'username' => $user->username,
            'verify_link' => URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]),
        ]));
    }

    private function send(string $to, array $fields): bool
    {
        $response = Http::withBasicAuth($this->sid, $this->token)
            ->asForm()
            ->post("https://api.twilio.com/2010-04-01/Accounts/{$this->sid}/Messages.json", array_merge([
                'From' => 'whatsapp:+'.$this->from,
                'To' => 'whatsapp:+'.ltrim($to, '+'),
            ], $fields));

        if ($response->successful()) {
            Log::info('WhatsApp message sent.', [
                'to' => $to,
                'message_id' => data_get($response->json(), 'sid'),
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
