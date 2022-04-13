<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PrintingModuleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketDetailController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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


/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [FrontController::class, 'index'])->name('welcome');

Route::group([ 'middleware' =>  ['auth' ]], function() { //all users
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::view('/settings', 'roles.settings.setting')->name('settings');
    Route::post('profile/photo/upload', [UserController::class,'profilePhoto'])->name('profile.photo.update');
    Route::post('profile/update',[HomeController::class,'updateProfile'])->name('profile.update');
    Route::post('update/my.password',[HomeController::class,'changePassword'])->name('password.change');
    Route::post('2fa/status', [HomeController::class, 'twoFactorStatus'])->name('2fa.status');
    Route::get('orders/show/{orderId}', [OrderController::class,'show'])->name('order.show');
    Route::get('ticket/show/{ticketId}', [TicketController::class,'show'])->name('ticket.show');
});



Route::group([ 'middleware' =>  ['is_admin','is_manager','auth' , '2fa' ]], function() { //admin and manager
    Route::resource('users',UserController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('orders',OrderController::class)->except(['update', 'show']);
    Route::post('orders/update/{orderId}', [OrderController::class,'update'])->name('order.update');
    Route::post('order/status/change', [OrderController::class,'orderStatusChange'])->name('order.status.change');
    Route::post('order/details/add-form', [OrderDetailController::class,'getAddForm'])->name('get.details.add.form');
    Route::post('order/details/store', [OrderDetailController::class,'store'])->name('order.details.store');

    Route::resource('tickets',TicketController::class)->except(['show']);
    Route::post('ticket/update/{ticketId}', [TicketController::class,'update'])->name('ticket.update');
    Route::post('ticket/status/change', [TicketController::class,'ticketStatusChange'])->name('ticket.status.change');
    Route::post('ticket/details/add-form', [TicketDetailController::class,'getAddForm'])->name('get.ticket.details.add.form');
    Route::post('ticket/details/store', [TicketDetailController::class,'store'])->name('ticket.details.store');

});



Route::get('2fa', [TwoFactorController::class, 'index'])->name('2fa.index');
Route::post('2fa', [TwoFactorController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [TwoFactorController::class, 'resend'])->name('2fa.resend');

Auth::routes([
     'register' => false, // Register Routes...
    //'reset' => false, // Reset Password Routes...
    // 'verify' => false, // Email Verification Routes...
]);

Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
