<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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

    return view('user.edit', compact('user', 'roles'));
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

    $resolvedRoles = Role::select('id', 'name')
      ->whereIn('id', $roleIds)
      ->get();

    $roleNames = $resolvedRoles->pluck('name')->toArray();

    $exceptions = [];

    if (in_array('Student', $roleNames) && in_array('Teacher', $roleNames)) {
      array_push($exceptions, ['student_is_teacher' => 'Een gebruiker kan niet een student & docent zijn.']);
    }

    if (in_array('Student', $roleNames) && in_array('Admin', $roleNames)) {
      array_push($exceptions, ['student_is_admin' => 'Een gebruiker kan niet een student & admin zijn.']);
    }

    if(!in_array('Admin',$roleNames) && count(User::role('Admin')->where('id', '!=', $user->id)->get()) < 1) {
      array_push($exceptions, ['no_admin' => 'Er moet minimaal één (1) admin in het systeem staan.']);
    }

    if (sizeof($exceptions) > 0) {
      throw ValidationException::withMessages($exceptions);
    }

    $user->syncRoles($roleIds);
    return redirect()->route('user.edit', $user);
  }
}
