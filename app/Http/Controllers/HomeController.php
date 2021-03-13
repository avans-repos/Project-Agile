<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController  extends Controller
{
  public function index(Request $request){
    $userid = Auth::user()->id;

    $actionPoints = DB::table('teacher_has_actionpoints')
      ->where('userid', $userid, 'and')
      ->where('finished', null)
      ->join('actionpoints','teacher_has_actionpoints.actionpointid', '=', 'actionpoints.id')
      ->orderBy('actionpoints.deadline')
      ->get();
   // die(json_encode($actionPoints));

    return view('home.index')
      ->with('actionpoints', json_decode($actionPoints));
  }
}
