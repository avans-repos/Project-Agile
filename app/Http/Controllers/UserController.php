<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

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
   * Show the form for editing the specified resource.
   *
   * @param User $user
   * @return View
   */
  public function edit(User $user)
  {
    $roles = Role::all();

    return view('user.edit', compact('user','roles'));
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
    $roleIds = $request->roles;
    $user->syncRoles($roleIds);
    return redirect()->route('user.edit', $user);
  }
}
