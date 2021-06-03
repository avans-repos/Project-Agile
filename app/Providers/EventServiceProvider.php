<?php

namespace App\Providers;

use App\Events\NoteAdded;
use App\Events\ActionpointReminder;
use App\Listeners\SendNewNoteNotification;
use App\Listeners\SendActionPointReminder;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
  /**
   * The event listener mappings for the application.
   *
   * @var array
   */
  protected $listen = [
    Registered::class => [SendEmailVerificationNotification::class],
    NoteAdded::class => [SendNewNoteNotification::class],
    ActionpointReminder::class => [SendActionPointReminder::class],
  ];

  /**
   * Register any events for your application.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
