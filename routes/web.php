<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventLombaController;
use App\Http\Controllers\PenyelenggaraController;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard.home');
    })->name('dashboard');

    Route::get('/dashboard/contestant', function () {
        return view('dashboard.contestant');
    })->name('dashboard.contestant');

    Route::get('/dashboard/events', [EventLombaController::class, 'index'])->name('dashboard.events');
    Route::post('/dashboard/events', [EventLombaController::class, 'store'])->name('dashboard.events.store');
    Route::get('/dashboard/events/edit/{id}', [EventLombaController::class, 'edit']);
    Route::put('/dashboard/events/update', [EventLombaController::class, 'update']);
    Route::delete('/dashboard/events/destroy', [EventLombaController::class, 'destroy']);


    Route::get('/dashboard/penyelenggara', [PenyelenggaraController::class, 'index'])->name('dashboard.penyelenggara');
    // Route::get('/dashboard/penyelenggara/create', [PenyelenggaraController::class, 'create'])->name('dashboard.penyelenggara.create');
    Route::post('/dashboard/penyelenggara', [PenyelenggaraController::class, 'store'])->name('dashboard.penyelenggara.store');
    Route::get('/dashboard/penyelenggara/edit/{id}', [PenyelenggaraController::class, 'edit']);
    Route::put('/dashboard/penyelenggara/update', [PenyelenggaraController::class, 'update']);
    Route::delete('/dashboard/penyelenggara/{id}/destroy', [PenyelenggaraController::class, 'destroy']);

    Route::get('/dashboard/schedule', function () {
        return view('dashboard.schedule');
    })->name('dashboard.schedule');

    Route::get('/dashboard/sponsor', function () {
        return view('dashboard.sponsor');
    })->name('dashboard.sponsor');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('edit-profile');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('update-profile');

Route::group(['middleware' => ['auth'], 'prefix' => 'user'], function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('user.profile');
});

Route::Group(['middleware' => ['guest']], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');
});

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');
