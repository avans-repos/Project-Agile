<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function Index(Request $request) {
        if($request->session()->has('loginUser')) {
            return view('home.index');
        } else {
            return Redirect::to('/');
        }
    }
}
