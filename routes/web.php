<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\Authed;
use App\Http\Middleware\Guest;
use Illuminate\Support\Facades\Route;

/*************************************
 * Portal - authenticated users only *
 ************************************/
Route::middleware(Authed::class)->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});

/*********
 * Login *
 ********/
Route::get('/login', [LoginController::class, 'index'])->middleware(Guest::class)->name('login');

/************
 * Register *
 ************/
Route::get('/register', [RegisterController::class, 'index'])->middleware(Guest::class)->name('register');

/********************
 * Activate Account *
 ********************/
Route::get('/activate', [RegisterController::class, 'activate'])->middleware(Guest::class)->name('activate');
