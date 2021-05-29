<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActionpointRequest;
use App\Models\Actionpoint;
use App\Models\User;
use App\Service\AuthenticationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActionpointController extends Controller
{
  private $AuthenticationService;

  public function __construct(AuthenticationService $authenticationService)
  {
    $this->AuthenticationService = $authenticationService;
  }
  /**
   * Display a listing of the resource.
   *
   * @return Application|Factory|View|Response
   */

  public function index()
  {
    /**
     * This page shows the action points you have created
     *
     */

    $currentUserId = Auth::user()->id;

    $actionPoints = Actionpoint::where('creator', $currentUserId)
      ->join('users', 'actionpoints.creator', '=', 'users.id')
      ->select('actionpoints.*', 'users.name')
      ->get();

    //die($actionPoints);

    return view('actionPoints.index', compact('actionPoints'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Application|Factory|View|Response
   */
  public function create()
  {
    $teachers = json_decode(User::role('Teacher')->get());

    $actionpoint = new Actionpoint();
    $assigned = null;
    return view('actionPoints.manage')
      ->with('teachers', $teachers)
      ->with('actionpoint', $actionpoint)
      ->with('action', 'store')
      ->with('assigned', $assigned);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(ActionpointRequest $request)
  {
    // sets creator to the value of the nickname property of the current user
    $creator = Auth::user()->id;

    $request->validated();

    $actionPoint = Actionpoint::create(array_merge($request->all(), ['creator' => $creator]));

    if (isset($request->assigned)) {
      foreach ($request->assigned as $assigned) {
        $actionPoint->teachers()->attach($assigned);
      }
    }

    return redirect()->route('actionpoints.index');
  }

  /**
   * Display the specified resource.
   *
   * @param Actionpoint $actionpoint
   * @return Application|Factory|View|Response
   */
  public function show(Actionpoint $actionpoint)
  {
    $assigned = Actionpoint::where('id', $actionpoint->id)
      ->first()
      ->teachers()
      ->get();

    $creator = User::where('id', '=', $actionpoint->creator)->first();

    return view('actionPoints.show')
      ->with('actionpoint', $actionpoint)
      ->with('assigned', $assigned)
      ->with('creatorName', $creator->name);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Actionpoint $actionpoint
   * @return Application|Factory|View|Response
   */
  public function edit(Actionpoint $actionpoint)
  {
    $assigned = Actionpoint::where('id', $actionpoint->id)
      ->first()
      ->teachers()
      ->get();

    $assigned = array_map(function ($teacher) {
      return $teacher->id;
    }, json_decode($assigned));

    $teachers = json_decode(User::all('id', 'name'));
    return view('actionPoints.manage', compact('actionpoint'))
      ->with('teachers', $teachers)
      ->with('assigned', $assigned)
      ->with('action', 'update');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param Actionpoint $actionpoint
   * @return RedirectResponse
   */
  public function update(ActionpointRequest $request, Actionpoint $actionpoint)
  {
    $creator = Auth::user()->id;

    $request->validated();

    if (!isset($request->assigned)) {
      $request->assigned = [];
    }
    $actionpoint->teachers()->sync($request->assigned);
    $actionpoint->update(array_merge($request->all(), ['Creator' => $creator]));

    return redirect()->route('actionpoints.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Actionpoint $actionpoint
   * @return RedirectResponse
   */
  public function destroy(Actionpoint $actionpoint)
  {
    $actionpoint->delete();

    return redirect()->route('actionpoints.index');
  }

  public function complete(Actionpoint $actionpoint)
  {
    $actionpoint->finished = true;
    $actionpoint->save();
    return redirect()->route('dashboard');
  }
}
