<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('actionpoints', \App\Http\Controllers\ActionpointController::class);

Route::resource('myOwnActions', \App\Http\Controllers\MyOwnActionController::class);

Route::resource('home', \App\Http\Controllers\HomeController::class);

require __DIR__.'/auth.php';
