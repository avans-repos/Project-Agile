<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
  public function markNotification($notificationId)
  {
    auth()
      ->user()
      ->unreadNotifications->when($notificationId, function ($query) use ($notificationId) {
        return $query->where('id', $notificationId);
      })
      ->markAsRead();

    return back();
  }

  public function markAllNotifications()
  {
    auth()
      ->user()
      ->unreadNotifications->markAsRead();

    return back();
  }
}
