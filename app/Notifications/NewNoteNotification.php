<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNoteNotification extends Notification implements ShouldQueue
{
  use Queueable;

  protected $notificationData;

  /**
   * Create a new notificationController instance.
   *
   * @return void
   */
  public function __construct($notificationData)
  {
    $this->notificationData = $notificationData;
  }

  /**
   * Get the notificationController's delivery channels.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function via($notifiable)
  {
    return ['database'];
  }

  /**
   * Get the array representation of the notificationController.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function toArray($notifiable)
  {
    return [
      'reminderdate' => $this->notificationData['reminderdate'],
      'note_id' => $this->notificationData['noteId'],
      'description' => $this->notificationData['description'],
      'contact_id' => $this->notificationData['contactId'],
    ];
  }
}
