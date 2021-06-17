<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  public function edit()
  {
    return view('profile.manage')
      ->with('user', Auth::user())
      ->with('action', 'update');
  }

  public function update(ProfileRequest $request)
  {
    $user = Auth::user();
    if ($request->get('email') != null) {
      $user->email = $request->get('email');
    }
    if ($request->get('password') != null) {
      $user->password = bcrypt($request->get('password'));
    }
    $user->save();
    return redirect(route('dashboard'));
  }
}
