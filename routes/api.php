<?php

use App\Http\Controllers\api\AuthMobileController;
use App\Http\Controllers\api\BumdesController;
use App\Http\Controllers\api\EventController;
use App\Http\Controllers\api\InformationController;
use App\Http\Controllers\api\LayananDesaController;
use App\Http\Controllers\api\PengajuanController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('guest')->group(function () {
    Route::post('login', [AuthMobileController::class, 'login']);
    Route::post('register', [AuthMobileController::class, 'register']);
    Route::post('check-token', [AuthMobileController::class, 'checkToken']);
});


Route::prefix('umum')->group(function () {
    Route::get('events', [EventController::class, 'getEvents']);
    Route::get('event/{id}', [EventController::class, 'getSingleEvent']);
    Route::get('informasi', [InformationController::class, 'getInformations']);
    Route::get('bumdes', [BumdesController::class, 'getBumdes']);
    Route::get('informasi-detail/{id}', [InformationController::class, 'getSingleInformations']);
});

Route::middleware('is-authenticated')->prefix('auth')->group(function () {
    Route::get('check-pengajuan/{id}', [LayananDesaController::class, 'checkPengajuan']);
    Route::get('layanan', [LayananDesaController::class, 'getLayanan']);
    Route::get('layanan-detail/{id}', [LayananDesaController::class, 'getDetailLayanan']);
    Route::post('submit-layanan/{id}', [LayananDesaController::class, 'storeLayanan']);
    Route::post('upload-berkas/{id}/{field_name}', [LayananDesaController::class, 'uploadBerkas']);
    Route::get('data-pengajuan', [PengajuanController::class, 'getPengajuan']);
    Route::post('upload-pic/{type}', [AuthMobileController::class, 'uploadPic']);
    Route::post('update-profile', [AuthMobileController::class, 'updateProfile']);
});
