<?php

/*use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'login']);

Route::get('/dashboard', function(){
    return "Bienvenue Dashboard";
})->middleware('auth')->name('dashboard');

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

Route::get('/create/account/dinar', function(){});
Route::get('/create/account/devise', function(){});
Route::get('/create/card', function(){});



Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');*/



// Login
/*Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'login']);

// Dashboard (protected)
Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth')->name('dashboard');

// Création routes
Route::get('/create/account/dinar', function(){})->middleware('auth');
Route::get('/create/account/devise', function(){})->middleware('auth');
Route::get('/create/card', function(){})->middleware('auth');
Route::get('/', function () {
    return redirect('/dashboard');
});*/

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CarteController;
// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
// Login
Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'login']);
// Root
Route::get('/', fn() => redirect('/login'));

// Dashboard
Route::get('/dashboard', [DashboardController::class,'index'])
    ->middleware('auth')
    ->name('dashboard');

// Routes protégées
Route::middleware('auth')->group(function () {
    // Création compte (dinar / devise)
    Route::get('/create/account/{type}', [AccountController::class, 'create'])
        ->name('accounts.create');
    Route::post('/accounts/store', [AccountController::class, 'store'])
        ->name('accounts.store');
    // Liste comptes
    Route::get('/accounts', [AccountController::class, 'index'])
        ->name('accounts.index'); // ?type=dinar ou ?type=devise
    // Edit
    Route::get('/accounts/{account}/edit', [AccountController::class, 'edit'])
        ->name('accounts.edit');
    // Update
    Route::put('/accounts/{account}', [AccountController::class, 'update'])
        ->name('accounts.update');
    // Delete
    Route::delete('/accounts/{account}', [AccountController::class, 'destroy'])
        ->name('accounts.destroy');

     Route::get('/cartes/create', [CarteController::class, 'create'])->name('cartes.create');
    Route::post('/cartes/store', [CarteController::class, 'store'])->name('cartes.store');
    Route::get('/cartes', [CarteController::class, 'index'])->name('cartes.index');
    Route::get('cartes/{id}/edit', [CarteController::class, 'edit'])->name('cartes.edit');
Route::put('cartes/{id}', [CarteController::class, 'update'])->name('cartes.update');
Route::delete('cartes/{id}', [CarteController::class, 'destroy'])->name('cartes.destroy');
});


Route::middleware('auth')->group(function() {
    Route::get('/operation/create/{type}', [OperationController::class,'create'])
        ->name('operations.create'); // ?type=dinar أو ?type=devise
    Route::post('/operation/store', [OperationController::class,'store'])
        ->name('operations.store');
    Route::get('/operations/history', [OperationController::class,'history'])
        ->name('operations.history'); // ?account_id=1
});
Route::get('/operations/historique', [OperationController::class,'historique'])
    ->name('operations.historique')
    ->middleware('auth');
   /* Route::get('/operations/historique', [OperationController::class, 'historique'])->name('operations.historique');*/

// Administration

Route::get('/admin/clients', [ClientController::class,'index']);



use App\Http\Controllers\NotificationController;

Route::middleware('auth')->group(function () {

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::get('/notifications/dropdown', [NotificationController::class, 'dropdown'])
        ->name('notifications.dropdown');

    Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');
   

});




/*Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class,'index'])->name('users.index');
    Route::get('/users/create', [UserController::class,'create'])->name('users.create');
    Route::post('/users', [UserController::class,'store'])->name('users.store');
});*/
Route::middleware('auth')->group(function () {
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');





    
   
});


Route::middleware('auth')->group(function () {
    Route::resource('agents', AgentController::class);
    Route::resource('clients', ClientController::class);
});

