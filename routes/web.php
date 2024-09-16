<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login.index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'registerPage'])->name('register.index');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// Protected routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', HomeController::class)->name('home')->middleware('auth');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile-edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile-edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
