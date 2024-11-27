<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\Twilio;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;

class LoginNeedsVerification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [TwilioChannel::class];
    }

    /**
     * Get the Twilio representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toTwilio($notifiable)
    {
        $loginCode = rand(111111, 999999);

        $notifiable->update([
            'login_code' => $loginCode,
        ]);

        return (new TwilioSmsMessage())
            ->content("Your login code is: $loginCode, do not share this code with anyone.");
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
