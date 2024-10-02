<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
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
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    //post routes
    Route::get('/post/{post}', [HomeController::class, 'show'])->name('post.show');
    Route::put('/post/{post}', [HomeController::class, 'update'])->name('post.update')->middleware('can:update,post');
    Route::post('/post', [HomeController::class, 'store'])->name('post.store');
    Route::get('/post/{post}/edit', [HomeController::class, 'edit'])->name('post.edit')->middleware('can:edit,post');
    Route::delete('/post/{post}', [HomeController::class, 'destroy'])->name('post.destroy')->middleware('can:delete,post');

    //comment routes
    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/comment/{comment}/edit', [CommentController::class, 'edit'])->name('comment.edit')->middleware('can:edit,comment');
    Route::put('/comment/{comment}', [CommentController::class, 'update'])->name('comment.update')->middleware('can:update,comment');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy')->middleware('can:delete,comment');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile-edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile-edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
