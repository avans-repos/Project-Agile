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
    $userid = Auth::user()->id;

    //    $actionPoints = DB::table('teacher_has_actionpoints')
    //      ->where('userid', $userid, 'and')
    //      ->where('finished', null)
    //      ->join('actionpoints', 'teacher_has_actionpoints.actionpointid', '=', 'actionpoints.id')
    //      ->orderBy('actionpoints.deadline')
    //      ->get();

    $actionPoints = Actionpoint::where('finished', null)
      ->teachers()
      ->where('user_id', $userid)
      ->orderBy('actionpoints.deadline');

    $notifications = auth()->user()->unreadNotifications;

    return view('home.index')
      ->with('actionpoints', json_decode($actionPoints))
      ->with('notifications', $notifications);
  }
}
