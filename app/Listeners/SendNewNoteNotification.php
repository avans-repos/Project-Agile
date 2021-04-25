<?php

namespace App\Listeners;

use App\Events\NoteAdded;
use App\Notifications\NewNoteNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewNoteNotification
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NoteAdded $event)
    {
      $delay = Carbon::createFromFormat('m/d/Y', $event->notificationData['reminderdate'])->format('Y-m-d');
      Notification::send($event->notificationData['user'], (new NewNoteNotification($event->notificationData))->delay($delay));
    }
}
