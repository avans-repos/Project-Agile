<?php

namespace App\Listeners;

use App\Events\NoteAdded;
use App\Notifications\NewNoteNotification;
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
        Notification::send($event->notificationData['user'], new NewNoteNotification($event->notificationData));
    }
}
