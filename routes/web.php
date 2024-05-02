<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddEventController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\LogHistoryController;
use App\Http\Controllers\PoolController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileSettings;
use App\Http\Controllers\SupportController;

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
Route::get('/Users', [UserController::class, 'view'])->middleware('isAdmin');
Route::get('/User/add', [UserController::class, 'add'])->middleware('isAdmin');
Route::post('/User/save', [UserController::class, 'save'])->middleware('isAdmin');
Route::get('/User/edit/{id}', [UserController::class, 'edit'])->middleware('isAdmin');
Route::post('/User/update/{id}', [UserController::class, 'update'])->middleware('isAdmin');
Route::post('/User/update-password/{id}', [UserController::class, 'update_password'])->middleware('isAdmin');
Route::get('/User/delete/{id}', [UserController::class, 'delete'])->middleware('isAdmin');


// Add event

Route::get('/Add-Event', [AddEventController::class, 'index'])->middleware('user')->middleware('user');
Route::get('/getPaymentOptions', [AddEventController::class, 'getPaymentOptions'])->middleware('user');
Route::get('/getAvailableDays', [AddEventController::class, 'getAvailableDays'])->middleware('user');
Route::get('/getAvailableTimeSlots', [AddEventController::class, 'getAvailableTimeSlots'])->middleware('user');
Route::post('/Event/save', [AddEventController::class, 'save'])->middleware('user')->middleware('user');
Route::get('/check-availablity', [AddEventController::class, 'checkAvailability'])->middleware('user');
Route::get('/delete/event/{id}', [AddEventController::class, 'deleteEvent'])->middleware('user');



// Calendar

Route::get('/Calendar', [CalendarController::class, 'index'])->middleware('user');
Route::get('/get-events', [CalendarController::class, 'getEvents'])->middleware('user');
Route::post('/Event-update/{id}', [CalendarController::class, 'updateEvents'])->middleware('user');
Route::post('/update-event-time', [CalendarController::class, 'changeEventTime'])->middleware('user');

// log and history

Route::get('/Log-History', [LogHistoryController::class, 'index'])->middleware('isAdmin');

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

// Login to user
Route::get('/Login-to-user/{id}', [PoolController::class, 'loginToPool'])->middleware('auth','isAdmin');
Route::get('/Back-to-Admin/{id}', [PoolController::class, 'loginToAdmin'])->middleware('auth');

// Message Template
Route::get('/Message-Template', [SettingsController::class, 'messageView'])->middleware('auth','isAdmin');
Route::post('/Message-Template/Save', [SettingsController::class, 'saveTemplate'])->middleware('auth','isAdmin');
Route::post('/Template/Save', [SettingsController::class, 'savePoolTemplate'])->middleware('auth','isAdmin');
Route::get('/Fav-Icon', [SettingsController::class, 'favicon'])->middleware('auth','isAdmin');
Route::post('/Fav-Icon/Save', [SettingsController::class, 'saveFavIcon'])->middleware('auth','isAdmin');
Route::get('/Fav-Icon/Delete', [SettingsController::class, 'deleteFavIcon'])->middleware('auth','isAdmin');

Route::get('/Pool-Setting', [SettingsController::class, 'poolView'])->middleware('auth','isAdmin');


//profile setting
Route::get('/profile-settings', [ProfileSettings::class, 'settings']);
Route::post('/profile-settings/update', [ProfileSettings::class, 'update_profile']);
Route::post('/profile-settings/update-password', [ProfileSettings::class, 'update_password']);
Route::get('/Delete-image', [ProfileSettings::class, 'deleteImg']);

Route::post('/fetch-data', [CalendarController::class, 'fetchData']);
Route::post('/set-selected-pool', [App\Http\Controllers\HomeController::class, 'setSelectedPool']);

Route::get('/Support', [SupportController::class, 'view'])->middleware('auth');
Route::get('/New-Ticket', [SupportController::class, 'newTicket'])->middleware('auth');
Route::post('/Ticket/save', [SupportController::class, 'saveTicket'])->middleware('auth');
Route::post('/Send-message/{id}', [SupportController::class, 'sendMessage'])->middleware('auth');
Route::get('/Ticket/{id}', [SupportController::class, 'ticket'])->middleware('auth');
Route::post('/update/status/{id}', [SupportController::class, 'updateStatus'])->middleware('auth');
Route::get('/download/{id}', [SupportController::class, 'download_files'])->middleware('auth');
