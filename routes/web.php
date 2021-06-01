<?php

use App\Http\Controllers\ActionpointController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactpointController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailFormatController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectGroupController;
use App\Http\Controllers\UserController;
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

Route::get('project/{projectid}/addgroup/{groupid}', [ProjectController::class, 'addGroup'])
  ->name('addgroup')
  ->middleware(['auth']);
Route::get('project/{projectid}/removegroup/{groupid}', [ProjectController::class, 'removeGroup'])
  ->name('removegroup')
  ->middleware(['auth']);

Route::resource('project', ProjectController::class)->middleware(['auth']);

Route::resource('user', UserController::class)->middleware(['auth']);

Route::resource('project', ProjectController::class)->middleware(['auth']);

Route::get('/notes/create/{contact}', [NoteController::class, 'create'])
  ->middleware(['auth'])
  ->name('notes.create');
Route::post('/notes/insert/{contact}', [NoteController::class, 'insert'])
  ->middleware(['auth'])
  ->name('notes.insert');
Route::get('/notes/edit/{note}', [NoteController::class, 'edit'])
  ->middleware(['auth'])
  ->name('notes.edit');
Route::patch('/notes/update/{note}', [NoteController::class, 'update'])
  ->middleware(['auth'])
  ->name('notes.update');
Route::delete('/notes/delete/{note}', [NoteController::class, 'delete'])
  ->middleware(['auth'])
  ->name('notes.delete');

// Notifications
Route::get('notificationController/mark/{notificationId}', [NotificationController::class, 'markNotification'])
  ->name('notification.mark')
  ->middleware(['auth']);
Route::get('notificationController/markall', [NotificationController::class, 'markAllNotifications'])
  ->name('notification.markall')
  ->middleware(['auth']);

// API Example controller using the avans API

Route::get('company/{companyid}/addcontact/{contactid}', [CompanyController::class, 'addcontact'])
  ->name('company.addContact')
  ->middleware(['auth']);
Route::get('company/{companyid}/removecontact/{contactid}', [CompanyController::class, 'removecontact'])
  ->name('company.removeContact')
  ->middleware(['auth']);
Route::resource('company', CompanyController::class)->middleware(['auth']);

Route::resource('contactpoint', ContactpointController::class)
  ->except(['create'])
  ->middleware(['auth']);
Route::get('/contactpoint/create/{id}', [ContactpointController::class, 'create'])
  ->name('contactpoint.create')
  ->middleware(['auth']);

Route::resource('role', RoleController::class)->middleware(['auth']);

Route::resource('classroom', ClassRoomController::class)->middleware(['auth']);

Route::resource('mailformat', MailFormatController::class)
  ->middleware(['auth'])
  ->except(['show']);
Route::get('/mailformat/send', [MailFormatController::class, 'mailSetup'])
  ->name('mailformat.mailSetup')
  ->middleware(['auth']);
Route::post('/mailformat/send', [MailFormatController::class, 'sendMail'])
  ->name('mailformat.sendMail')
  ->middleware(['auth']);

require __DIR__ . '/auth.php';
Route::get('projectgroup/{projectgroupid}/addContact/{contactid}', [ProjectGroupController::class, 'addContact'])
  ->name('projectgroup.addContact')
  ->middleware(['auth']);
Route::get('projectgroup/{projectgroupid}/removeContact/{contactid}', [ProjectGroupController::class, 'removeContact'])
  ->name('projectgroup.removeContact')
  ->middleware(['auth']);
Route::resource('projectgroup', ProjectGroupController::class)->middleware(['auth']);
