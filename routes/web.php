<?php

use App\Http\Controllers\SendmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ForumController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [EventController::class, 'index']);
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
Route::get('/events/contact', [EventController::class, 'contact']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::post('/events', [EventController::class, 'store']);
Route::get('/events/register', [EventController::class, 'register']);
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
Route::put('events/update/{id}', [EventController::class, 'update'])->middleware('auth');
Route::resource('email', SendmailController::class)->middleware('auth');

Route::get('/dashboard', [EventController::class, 'dashboard'])->name('dashboard')
    ->middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ]);

Route::get('/maps', [EventController::class, 'dashboardData'])->name('maps');

Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');

Route::delete('/events/leave/{id}', [EventController::class, 'leaveEvent'])->middleware('auth');

Route::post('/session', [StripeController::class, 'session'])->name('session')->middleware('auth');

Route::get('/success', [StripeController::class, 'success'])->name('success');

Route::post('/tickets/refund/{id}', [TicketController::class, 'requestRefund'])->name('tickets.refund');

Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');

Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');

Route::middleware(['auth'])->group(function () {
    Route::get('/my-account', [AccountController::class, 'myAccount'])->name('account.profile');
    Route::put('/my-account/update', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
});

Route::get('/my-account/settings-profile', [EventController::class, 'settingsprofile'])->middleware('auth');

Route::fallback(function () {
    return response()->view('events.erro', [], 404);
});
