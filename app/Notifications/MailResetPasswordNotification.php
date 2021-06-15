<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
       $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
      $link = url( '/reset-password/' . $this->token );
      return (new MailMessage())
        ->greeting('Hallo, ' . $notifiable->name)
        ->salutation('Avans AD')
        ->subject( 'Reset je wachtwoord' )
        ->line( "Klik op de knop om een nieuw wachtwoord te maken." )
        ->action( 'Wachtwoord resetten', $link )
        ->line( 'Bedankt!' )
        ->from(env('MAIL_FROM_ADDRESS'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
