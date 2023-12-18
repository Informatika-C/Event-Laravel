<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventLombaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\PenyelenggaraController;
use App\Http\Controllers\ContestantController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KelompokController;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use App\Models\Admin;
use App\Models\Kelompok;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/pembayaran', function () {
    $params = array(
        'transaction_details' => array(
            'order_id' => 2,
            'gross_amount' => 1000000000,
        )
    );

    try {
        // Get Snap Payment Page URL
        $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

        // Redirect to Snap Payment Page
        header('Location: ' . $paymentUrl);
        dd($paymentUrl);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
});

Route::get('/home/lombapgs/id/{event_id}', [HomeController::class, 'detailLomba'])->name('home.lombapgs');
Route::get('/home/eventpgs', [HomeController::class, 'showEventPage'])->name('home.eventpgs');

Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard.home');
    })->name('dashboard');

    Route::get('/dashboard/events', [EventLombaController::class, 'index'])->name('dashboard.events');
    Route::post('/dashboard/events', [EventLombaController::class, 'store'])->name('dashboard.events.store');
    Route::get('/dashboard/events/create', [EventLombaController::class, 'create'])->name('dashboard.events.create');
    Route::put('/dashboard/events/update', [EventLombaController::class, 'update']);
    Route::get('/dashboard/events/edit/{id}', [EventLombaController::class, 'edit']);
    Route::get('/dashboard/events/show/{id}', [EventLombaController::class, 'show']);
    Route::delete('/dashboard/events/destroy/{id}', [EventLombaController::class, 'destroy']);
    Route::put('/dashboard/events/upload-image', [EventLombaController::class, 'uploadImage'])->name('dashboard.events.uploadImage');


    Route::get('/dashboard/penyelenggara', [PenyelenggaraController::class, 'index'])->name('dashboard.penyelenggara');
    Route::post('/dashboard/penyelenggara', [PenyelenggaraController::class, 'store'])->name('dashboard.penyelenggara.store');
    Route::get('/dashboard/penyelenggara/create', [PenyelenggaraController::class, 'create'])->name('dashboard.penyelenggara.create');
    Route::put('/dashboard/penyelenggara/update', [PenyelenggaraController::class, 'update']);
    Route::get('/dashboard/penyelenggara/edit/{id}', [PenyelenggaraController::class, 'edit']);
    Route::get('/dashboard/penyelenggara/show/{id}', [PenyelenggaraController::class, 'show']);
    Route::delete('/dashboard/penyelenggara/destroy/{id}', [PenyelenggaraController::class, 'destroy']);
    Route::put('/dashboard/penyelenggara/upload-image', [PenyelenggaraController::class, 'uploadImage'])->name('dashboard.penyelenggara.uploadImage');


    Route::get('/dashboard/lomba/id/{event_id}', [LombaController::class, 'index'])->name('dashboard.lomba');
    Route::post('/dashboard/lomba/store', [LombaController::class, 'store'])->name('dashboard.lomba.store');
    Route::get('/dashboard/lomba/create/{event_id?}', [LombaController::class, 'create'])->name('dashboard.lomba.create');
    Route::put('/dashboard/lomba/update', [LombaController::class, 'update']);
    Route::get('/dashboard/lomba/edit/{id}', [LombaController::class, 'edit']);
    Route::get('/dashboard/lomba/show/{id}', [LombaController::class, 'show']);
    Route::delete('/dashboard/lomba/destroy/{id}', [LombaController::class, 'destroy']);
    Route::put('/dashboard/lomba/upload-image', [LombaController::class, 'uploadImage'])->name('dashboard.lomba.uploadImage');


    Route::get('/kategori', [KategoriController::class, 'index'])->name('dashboard.kategori');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('dashboard.kategori.store');
    Route::get('/kategori/lomba/{id}', [KategoriController::class, 'lomba']);

    Route::get('/dashboard/contestant', [ContestantController::class, 'index'])->name('dashboard.contestant');
    Route::get('/dashboard/contestant/all', [ContestantController::class, 'showAllContestants'])->name('dashboard.contestant.all');
    Route::delete('/dashboard/contestant/{id}', [ContestantController::class, 'destroy'])->name('dashboard.contestant.destroy');


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

Route::group(['middleware' => ['auth']], function () {
    Route::post('/lomba/register', [LombaController::class, 'register'])->name('lomba.register');
    Route::post('/lomba/register/solo', [LombaController::class, 'registerSolo'])->name('lomba.register.solo');
    Route::post('/lomba/register/grup', [LombaController::class, 'registerGrup'])->name('lomba.register.grup');
    Route::delete('/lomba/register', [LombaController::class, 'unregister'])->name('lomba.unregister');

    Route::get('/kelompok', [KelompokController::class, 'index'])->name('kelompok');
    Route::post('/kelompok', [KelompokController::class, 'store'])->name('kelompok.store');
});

Route::get('/ajax-autocomplete-contestant', [ContestantController::class, 'search'])->name('ajax-autocomplete-contestant');

Route::Group(['middleware' => ['guest']], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');
});

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');


Route::get('/broadcast', function () {
    return view('broadcast');
});
