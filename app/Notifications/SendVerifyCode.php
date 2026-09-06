<?php

namespace App\Notifications;

use App\Services\WhatsAppService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendVerifyCode extends Notification
{
    use Queueable;

    public string $code;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return app(WhatsAppService::class)->enabled() && ! empty($notifiable->phone)
            ? ['whatsapp']
            : ['mail'];
    }

    /**
     * Get the WhatsApp representation of the notification.
     *
     * @return array{to: string, body: string}
     */
    public function toWhatsApp(object $notifiable): array
    {
        return [
            'to' => (string) $notifiable->phone,
            'body' => "Your verification code is: {$this->code}",
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line("Your verification code is: {$this->code}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
