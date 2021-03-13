<?php

namespace App\Http\Controllers;

use App\Models\Actionpoint;
use App\Service\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyOwnActionController extends Controller
{
  private $AuthenticationService;

  public function __construct(AuthenticationService $authenticationService)
  {
    $this->AuthenticationService = $authenticationService;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
   */

  public function index()
  {
    /**
     * This page shows the action points you have created
     *
     */

    $userid = Auth::user()->id;

    $actionPoints = DB::table('teacher_has_actionpoints')
      ->where('userid', $userid)
      ->join('actionpoints','teacher_has_actionpoints.actionpointid', '=', 'actionpoints.id')
      ->get();

    return view('myOwnActions.index', compact('actionPoints'));
  }

  public function show(Actionpoint $actionpoint)
  {
    return view('actionPoints.show')
      ->with('actionpoint', $actionpoint);
  }
}
