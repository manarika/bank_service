<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/service', function () {
    return view('service');
});
Route::get('/Formservices', function () {
    return view('Formservice');
});
Route::get('/Formcaisse', function () {
    return view('Formcaisse');
});

Route::get('/success', function () {
    return view('success');
})->name('success');

Route::get('/view', function () {
    return view('emails.reservation');
})->name('view');


Route::post('/reserve-service', [ServiceController::class, 'store'])->name('reserveturn');

Route::post('/reserve-Caisse', [CaisseController::class, 'store'])->name('reserveCaisse');


Route::get('/admin', function () {
    return view('admin');
});

Route::get('/Queueservices', [ServiceController::class, 'afficher'])->name('Queueservice');
Route::get('/ViewQueueservice', function () {
    return view('Queueservice');
});

Route::get('/QueueCaisse', [CaisseController::class, 'afficher'])->name('Queuecaisse');

Route::get('/ViewQueueCaisse', function () {
    return view('Queuecaisse');
});

Route::get('/delete-client/{clientId}', [ClientController::class, 'deleteClient']);
Route::get('/delete-clientcaisse/{clientId}', [ClientController::class, 'deleteClientCaisse']);


