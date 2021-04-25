<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return View
   */
  public function index()
  {
    $users = User::all();
    return view('user.index', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return View
   */
  public function create()
  {
    return view('user.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return Response
   */
  public function store(Request $request)
  {
    $data = $request->validate([
      'user_id' => ['required'],
    ]);

    $user = Customer::create($data);

    return redirect()->route('user.show', $user);
  }

  /**
   * Display the specified resource.
   *
   * @param User $user
   * @return View
   */
  public function show(User $user)
  {
    return view('user.show', compact('user'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param User $user
   * @return View
   */
  public function edit(User $user)
  {
    return view('user.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param User $user
   * @return RedirectResponse
   */
  public function update(Request $request, User $user)
  {
    $data = $request->validate();

    $user->update($data);

    return redirect()->route('user.show', $user);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param User $user
   * @return RedirectResponse
   */
  public function destroy(User $user)
  {
    try {
      $user->delete();
    } catch (\Exception) {
    }
    return Redirect::to('user.index');
  }
}
