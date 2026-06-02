<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect('/login'));

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class,'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| AUTH PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Accounts
    Route::get('/create/account/{type}', [AccountController::class, 'create']);
    Route::post('/accounts/store', [AccountController::class, 'store']);
    Route::get('/accounts', [AccountController::class, 'index']);
    Route::get('/accounts/{account}/edit', [AccountController::class, 'edit']);
    Route::put('/accounts/{account}', [AccountController::class, 'update']);
    Route::delete('/accounts/{account}', [AccountController::class, 'destroy']);

    // Cartes
    Route::resource('cartes', CarteController::class);

    // Operations
    Route::get('/operation/create/{type}', [OperationController::class,'create']);
    Route::post('/operation/store', [OperationController::class,'store']);
    Route::get('/operations/history', [OperationController::class,'history']);
    Route::get('/operations/historique', [OperationController::class,'historique']);

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::get('/notifications/dropdown', [NotificationController::class, 'dropdown']);
    Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead']);

    // Clients / Agents
    Route::resource('clients', ClientController::class);
    Route::resource('agents', AgentController::class);
});
