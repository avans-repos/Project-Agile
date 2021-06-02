<?php

namespace App\Listeners;

use App\Events\ActionpointReminder;
use App\Notifications\ActionpointNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendActionPointReminder
{
  /**
   * Handle the event.
   *
   * @param  ActionpointReminder  $event
   * @return void
   */
  public function handle(ActionpointReminder $event)
  {
    $delay = Carbon::createFromFormat('Y-m-d', $event->notificationData['reminderdate']);
    Notification::send($event->notificationData['user'], (new ActionpointNotification($event->notificationData))->delay($delay));
  }
}
