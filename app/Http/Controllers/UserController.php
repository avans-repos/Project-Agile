<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (Auth::user()->isAdmin()) {
      $users = User::all();
      return view('user.index', compact('users'));
    } else {
      return redirect(route('dashboard'));
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param User $user
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View|RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function edit(User $user)
  {
    if (Auth::user()->isAdmin()) {
      $roles = Role::all();

      return view('user.edit', compact('user', 'roles'));
    } else {
      return redirect(route('dashboard'));
    }
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
    if (Auth::user()->isAdmin()) {
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

      if (!in_array('Admin', $roleNames) && count(User::role('Admin')->where('id', '!=', $user->id)->get()) < 1) {
        array_push($exceptions, ['no_admin' => 'Er moet minimaal één (1) admin in het systeem staan.']);
      }

      if (sizeof($exceptions) > 0) {
        throw ValidationException::withMessages($exceptions);
      }

      $user->syncRoles($roleIds);
      return redirect()->route('user.edit', $user);
    } else {
      return redirect(route('dashboard'));
    }
  }
}
