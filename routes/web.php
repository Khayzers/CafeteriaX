<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dueno\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CafeteriaController;
use App\Http\Controllers\Dueno\CafeteriaController as DuenoCafeteriaController;
use App\Http\Controllers\Dueno\MenuItemController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas públicas de cafeterías
Route::get('/cafeterias', [CafeteriaController::class, 'index'])->name('cafeterias.index');
Route::get('/cafeterias/{id}', [CafeteriaController::class, 'show'])->name('cafeterias.show');

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Rutas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/perfil/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    
    // Rutas de favoritos
    Route::get('/favoritos', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favoritos/toggle/{cafeteria}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favoritos/check/{cafeteria}', [FavoriteController::class, 'check'])->name('favorites.check');
});

// Rutas para dueños
Route::prefix('dueno')->name('dueno.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Gestión de cafeterías
    Route::get('/cafeterias/crear', [DuenoCafeteriaController::class, 'create'])->name('cafeterias.create');
    Route::post('/cafeterias', [DuenoCafeteriaController::class, 'store'])->name('cafeterias.store');
    Route::get('/cafeterias/{id}/editar', [DuenoCafeteriaController::class, 'edit'])->name('cafeterias.edit');
    Route::put('/cafeterias/{id}', [DuenoCafeteriaController::class, 'update'])->name('cafeterias.update');
    Route::delete('/cafeterias/{id}', [DuenoCafeteriaController::class, 'destroy'])->name('cafeterias.destroy');
    
    // Gestión de menú
    Route::get('/cafeterias/{cafeteriaId}/menu', [MenuItemController::class, 'index'])->name('menu.index');
    Route::get('/cafeterias/{cafeteriaId}/menu/crear', [MenuItemController::class, 'create'])->name('menu.create');
    Route::post('/cafeterias/{cafeteriaId}/menu', [MenuItemController::class, 'store'])->name('menu.store');
    Route::get('/cafeterias/{cafeteriaId}/menu/{id}/editar', [MenuItemController::class, 'edit'])->name('menu.edit');
    Route::put('/cafeterias/{cafeteriaId}/menu/{id}', [MenuItemController::class, 'update'])->name('menu.update');
    Route::delete('/cafeterias/{cafeteriaId}/menu/{id}', [MenuItemController::class, 'destroy'])->name('menu.destroy');
});
