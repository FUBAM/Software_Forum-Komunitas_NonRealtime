<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\EventsController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/komunitas', [KomunitasController::class, 'index'])->name('komunitas.index');
    Route::get('/komunitas/{id}', [KomunitasController::class, 'show'])->name('komunitas.show');
    Route::post('/komunitas/join', [KomunitasController::class, 'join'])->name('komunitas.join');

    Route::get('/events', [EventsController::class, 'index'])->name('events.index');
    Route::post('/events/{id}/klaim', [EventsController::class, 'klaimXP'])->name('events.klaim');

    Route::middleware(['can:admin'])->group(function () {
        Route::get('/admin/laporan', [KomunitasController::class, 'listLaporan'])->name('admin.laporan');
    });
});