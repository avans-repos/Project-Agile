<?php

use App\Http\Controllers\ActionpointController;
use App\Http\Controllers\ApiExampleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyOwnActionController;
use App\Http\Controllers\NoteController;
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

Route::get('/', [HomeController::class, 'index'])
  ->middleware(['auth'])
  ->name('dashboard');

Route::resource('actionpoints', ActionpointController::class)->middleware(['auth']);
Route::get('/actionpoints/{actionpoint}/complete', [ActionpointController::class, 'complete'])
  ->middleware(['auth'])
  ->name('actionpoints.complete');

Route::resource('contact', ContactController::class)->middleware(['auth']);
require __DIR__ . '/auth.php';

Route::resource('company', \App\Http\Controllers\CompanyController::class);

Route::get('/notes/create/{contact}', [NoteController::class, 'create'])
  ->middleware(['auth'])
  ->name('notes.create');
Route::post('/notes/insert/{contact}', [NoteController::class, 'insert'])
  ->middleware(['auth'])
  ->name('notes.insert');

// API Example controller using the avans API

Route::get('/api-example', [ApiExampleController::class, 'index']);
