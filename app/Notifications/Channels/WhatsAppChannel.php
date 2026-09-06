<?php

namespace App\Notifications\Channels;

use App\Services\WhatsAppService;
use Illuminate\Notifications\Notification;

class WhatsAppChannel
{
    public function __construct(private readonly WhatsAppService $whatsapp) {}

    public function send(object $notifiable, Notification $notification): void
    {
        $message = $notification->toWhatsApp($notifiable);

        if (! is_array($message) || empty($message['to']) || empty($message['body'])) {
            return;
        }

        $this->whatsapp->sendText($message['to'], $message['body']);
    }
}
