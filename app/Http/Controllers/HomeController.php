<?php

namespace App\Http\Controllers;

use App\Models\Actionpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
      ->with('actionpoints', json_decode($actionPoints))
      ->with('notifications', $notifications);
  }
}
