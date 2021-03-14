<?php

use App\Http\Controllers\ActionpointController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyOwnActionController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('actionpoints', ActionpointController::class);
Route::get('/actionpoints/{actionpoint}/complete', [ActionpointController::class, 'complete']);

Route::resource('myOwnActions', MyOwnActionController::class);

Route::resource('contact', ContactController::class);

require __DIR__.'/auth.php';
