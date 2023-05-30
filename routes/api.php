<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiBeritaController;
use App\Http\Controllers\ApiPengajuanController;
use App\Http\Controllers\ApiSuratController;
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

Route::post('auth/register', [ApiAuthController::class, 'register']);
Route::post('auth/login', [ApiAuthController::class, 'login']);
Route::get('berita', [ApiBeritaController::class, 'berita']);
Route::get('surat', [ApiSuratController::class, 'surat']);
Route::post('rekap', [ApiPengajuanController::class, 'rekap']);
Route::post('statussurat', [ApiPengajuanController::class, 'statussurat']);
Route::post('pengajuan', [ApiPengajuanController::class, 'pengajuan']);
Route::post('pembatalan', [ApiPengajuanController::class, 'pembatalan']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/cek', [ApiAuthController::class, 'cektoken']);
    Route::get('auth/me', [ApiAuthController::class, 'me']);
    Route::post('auth/logout', [ApiAuthController::class, 'logout']);
    Route::get('keluarga', [ApiAuthController::class, 'keluarga']);
    Route::post('statusdiajukan', [ApiPengajuanController::class, 'statusdiajukan']);
    Route::get('statusproses', [ApiPengajuanController::class, 'statusproses']);
    Route::get('statusselesai', [ApiPengajuanController::class, 'statusselesai']);
    Route::post('editnohp', [ApiAuthController::class, 'editnohp']);
    Route::post('suratmasuk', [ApiPengajuanController::class, 'suratmasuk']);
});
