<?php

use App\Http\Controllers\Api\LoginApiController;
use App\Http\Controllers\Api\RegisterApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [LoginApiController::class, 'login'])->name('api.login');


Route::post('/register', [RegisterApiController::class, 'register'])->name('api.register');
