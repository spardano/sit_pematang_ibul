<?php

use App\Http\Controllers\converToPDFController;
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

Route::get('/sktm', [converToPDFController::class, 'suratSKTM']);
Route::get('/sku', [converToPDFController::class, 'suratUsaha']);
Route::get('/skm', [converToPDFController::class, 'suratKematian']);
Route::get('/skr', [converToPDFController::class, 'suratIzinKeramaian']);
Route::get('/skck', [converToPDFController::class, 'skck']);
Route::get('/skim', [converToPDFController::class, 'suratMenikah']);
