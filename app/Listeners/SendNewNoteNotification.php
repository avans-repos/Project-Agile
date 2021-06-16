<?php

namespace App\Listeners;

use App\Events\NoteAdded;
use App\Notifications\NewNoteNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class SendNewNoteNotification
{
  /**
   * Handle the event.
   *
   * @param  object  $event
   */
  public function handle(NoteAdded $event)
  {
    $delay = Carbon::createFromFormat('Y-m-d', $event->notificationData['reminderdate']);
    $noti = (new NewNoteNotification($event->notificationData))->delay($delay);
    Notification::send($event->notificationData['user'], $noti);
    return $noti;
  }
}
