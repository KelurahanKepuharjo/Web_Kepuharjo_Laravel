<?php

use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\PengajuanController;
use App\Http\Controllers\Api\SuratController;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiBeritaController;
use Illuminate\Http\Request;
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
Route::get('surat', [SuratController::class, 'surat']);
Route::post('rekap', [PengajuanController::class, 'rekap']);
Route::post('statussurat', [PengajuanController::class, 'statussurat']);
Route::post('pengajuan', [PengajuanController::class, 'pengajuan']);
Route::post('pembatalan', [PengajuanController::class, 'pembatalan']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/me', [ApiAuthController::class, 'me']);
    Route::post('auth/logout', [ApiAuthController::class, 'logout']);
    Route::get('keluarga', [ApiAuthController::class, 'keluarga']);
    Route::post('statusdiajukan', [PengajuanController::class, 'statusdiajukan']);
    Route::get('statusproses', [PengajuanController::class, 'statusproses']);
    Route::get('statusselesai', [PengajuanController::class, 'statusselesai']);
    Route::post('editnohp', [ApiAuthController::class, 'editnohp']);
    Route::post('suratmasuk', [PengajuanController::class, 'suratmasuk']);
});
