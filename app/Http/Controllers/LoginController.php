<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function Index() {
        return view("login.index");
    }

    public function Login(Request $request) {

        $teacherNames = ['Tanja','Rene','Maikel','Ger','Eric'];

        $request->validate(['userSelect' => 'required']);

        session(['loginUser' => $request->userSelect]);
        session(['loginName' => $teacherNames[$request->userSelect - 1]]);
        return Redirect::to('/home');
    }

    public function Logout() {
        session()->pull('loginUser', null);
        session()->pull('loginName', null);
        return Redirect::to('/home');
    }
}
