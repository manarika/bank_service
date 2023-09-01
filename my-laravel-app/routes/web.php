<?php

use App\Http\Controllers\CaisseController;
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
Route::get('/simulate', function () {
    return view('emails.reservation');
})->name('simulate');

Route::post('/reserve-service', [ServiceController::class, 'store'])->name('reserveturn');

Route::post('/reserve-Caisse', [CaisseController::class, 'store'])->name('reserveCaisse');
