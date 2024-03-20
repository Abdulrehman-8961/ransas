<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddEventController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\LogHistoryController;
use App\Http\Controllers\PoolController;
use App\Http\Controllers\SettingsController;

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
    return redirect('/Home');
});


Auth::routes();
Route::get('/Home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/payment', [App\Http\Controllers\HomeController::class, 'payment']);
Route::get('/payment_success', [App\Http\Controllers\HomeController::class, 'successFunction']);

// Employee
Route::get('/Users', [UserController::class, 'view'])->middleware('isAdminAndPool');
Route::get('/User/add', [UserController::class, 'add'])->middleware('isAdminAndPool');
Route::post('/User/save', [UserController::class, 'save'])->middleware('isAdminAndPool');
Route::get('/User/edit/{id}', [UserController::class, 'edit'])->middleware('isAdminAndPool');
Route::post('/User/update/{id}', [UserController::class, 'update'])->middleware('isAdminAndPool');
Route::post('/User/update-password/{id}', [UserController::class, 'update_password'])->middleware('isAdminAndPool');
Route::get('/User/delete/{id}', [UserController::class, 'delete'])->middleware('isAdminAndPool');

// Add event

Route::get('/Add-Event', [AddEventController::class, 'index'])->middleware('pool');
Route::post('/Event/save', [AddEventController::class, 'save'])->middleware('pool');
Route::get('/check-availablity', [AddEventController::class, 'checkAvailability'])->middleware('pool');



// Calendar

Route::get('/Calendar', [CalendarController::class, 'index'])->middleware('pool');
Route::get('/get-events', [CalendarController::class, 'getEvents'])->middleware('isAdminAndPool');
Route::post('/Event-update/{id}', [CalendarController::class, 'updateEvents'])->middleware('pool');
Route::post('/update-event-time', [CalendarController::class, 'changeEventTime'])->middleware('pool');

// log and history

Route::get('/Log-History', [LogHistoryController::class, 'index'])->middleware('isAdminAndPool');

// Coron

Route::get('/Cron-Sms-Reminder', [App\Http\Controllers\CoronController::class, 'smsReminder']);
Route::get('/Cron-Payment-Status', [App\Http\Controllers\CoronController::class, 'checkPaymentStatus']);


// Pool
Route::get('/Pools', [PoolController::class, 'view'])->middleware('isAdmin');
Route::get('/Pool/add', [PoolController::class, 'add'])->middleware('isAdmin');
Route::post('/Pool/save', [PoolController::class, 'save'])->middleware('isAdmin');
Route::get('/Pool/edit/{id}', [PoolController::class, 'edit'])->middleware('isAdmin');
Route::post('/Pool/update/{id}', [PoolController::class, 'update'])->middleware('isAdmin');
Route::post('/Pool/update-password/{id}', [PoolController::class, 'update_password'])->middleware('isAdmin');
Route::get('/Pool/delete/{id}', [PoolController::class, 'delete'])->middleware('isAdmin');

// Login to pool
Route::get('/Login-to-pool/{id}', [PoolController::class, 'loginToPool'])->middleware('auth','isAdmin');
Route::get('/Back-to-Admin/{id}', [PoolController::class, 'loginToAdmin'])->middleware('auth');

// Message Template
Route::get('/Message-Template', [SettingsController::class, 'messageView'])->middleware('auth','isAdmin');
Route::post('/Message-Template/Save', [SettingsController::class, 'saveTemplate'])->middleware('auth','isAdmin');

Route::get('/Pool-Setting', [SettingsController::class, 'poolView'])->middleware('auth','isAdmin');
