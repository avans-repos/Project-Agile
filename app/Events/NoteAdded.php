<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NoteAdded
{
  use Dispatchable;
  use InteractsWithSockets;
  use SerializesModels;

  public $notificationData;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($notificationData)
  {
    $this->notificationData = $notificationData;
  }
}
