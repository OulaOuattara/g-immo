<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BailleurController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyPhotoController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('acceuil');
})->name('acceuil');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Authentication routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// Custom route for user's properties
Route::get('/properties/mine', [PropertyController::class, 'myProperties'])
    ->name('properties.mine');

Route::middleware(['auth'])->group(function () {
    Route::middleware('can:isManager')->group(function () {
        Route::get('/manager/clients', [ClientController::class, 'index'])->name('clients.index');
        Route::put('/manager/clients/{client}/assign-agent', [ClientController::class, 'assignAgent'])->name('clients.assignAgent');
        Route::delete('/manager/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
    });
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});


// Resource routes
Route::resource('properties', PropertyController::class);
Route::resource('agents', AgentController::class);
Route::resource('images', PropertyPhotoController::class);
Route::resource('managers', ManagerController::class);
Route::resource('favorites', FavoriteController::class);
Route::resource('clients', ClientController::class);
Route::resource('roles', RoleController::class);
Route::resource('bailleurs', BailleurController::class);
Route::resource('appointments', AppointmentController::class);