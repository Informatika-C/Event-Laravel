<?php

use App\Http\Controllers\ApiControllers\AuthController;
use App\Http\Controllers\ApiControllers\HomeController;
use App\Http\Controllers\ApiControllers\EventController;
use App\Http\Controllers\ApiControllers\LombaController;
use App\Http\Controllers\ApiControllers\PesertaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::put('/user', [AuthController::class, 'update'])->middleware('auth:sanctum');

Route::get('/home', [HomeController::class, 'index']);

Route::get('/event/kategori/{kategori}', [EventController::class, 'byKategori']);
Route::get('/event/detail/{id}', [EventController::class, 'show']);

Route::get('/lomba/detail/{id}', [LombaController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/lomba/register/solo', [LombaController::class, 'registerSolo']);
    Route::post('/lomba/register/grup', [LombaController::class, 'registerGrup']);
    Route::delete('/lomba/unregister', [LombaController::class, 'unRegister']);
});

Route::get('/peserta/search', [PesertaController::class, 'search']);
