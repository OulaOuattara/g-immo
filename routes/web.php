<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BailleurController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyPhotoController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('acceuil');
})->name('acceuil');
Route::get('/search', [PropertyController::class, 'search'])->name('properties.search');
Route::get('/filter', [PropertyController::class, 'filter'])->name('properties.filter');
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');


// Authentication routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

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