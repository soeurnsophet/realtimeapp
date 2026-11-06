<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use URL;

class EmailVerificationNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public ?string $callback_url = null;
    /**
     * Create a new notification instance.
     */
    public function __construct($callback_url)
    {
        $this->callback_url = $callback_url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);
        return (new MailMessage)
            ->line('Hi ' . $notifiable->name . ',')
            ->line('Please click the button below to verify your email address.')
            ->action('Verify Email', $this->callback_url . '?frontend_url=' . urlencode($verificationUrl))
            ->line('Thank you for using our application!');
    }
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(1),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

}
