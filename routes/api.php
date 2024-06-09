<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AddNewsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PembayaranController;



use App\Models\addNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('news', addNewsController::class);
Route::resource('user', AuthController::class);
Route::resource('pembayaran', PembayaranController::class);

Route::put('/newsloc/{id}', [App\Http\Controllers\addNewsController::class, 'updateLokasi']);

Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);


Route::get('/user/{id}', [App\Http\Controllers\Api\AuthController::class, 'show']);
Route::get('/users/{email}', [App\Http\Controllers\Api\UserController::class, 'show']);
Route::get('/username/{username}', [App\Http\Controllers\Api\UserController::class, 'showUsername']);
// Route::get('/user/{id}', [App\Http\Controllers\Api\UserController::class, 'show']);

// Route::post('login', 'App\Http\Controllers\Api\LoginController@Login');
// Route::post('register', 'App\Http\Controllers\Api\RegisterController@Register');

// routes/api.php
