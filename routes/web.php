<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/welcome','welcome');

Route::get('/', [LoginController::class, 'Index']);

// Login routes
Route::match(['post'],'login', [LoginController::class, 'Login']);
Route::get('/logout', [LoginController::class, 'Logout']);

// Home routes
Route::get('/home', [HomeController::class, 'Index']);
