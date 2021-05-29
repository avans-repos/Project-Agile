<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function index(Request $request)
  {
    $actionPoints = Auth::user()
      ->actionpoints()
      ->where('finished', null)
      ->orderBy('actionpoints.deadline')
      ->get();

    $notifications = auth()->user()->unreadNotifications;

    return view('home.index')
      ->with('actionpoints', $actionPoints)
      ->with('notifications', $notifications);
  }
}
