<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\WebBeritaController;
use App\Http\Controllers\WebPengajuanController;
use App\Http\Controllers\WebSuratController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('auth/register', [AuthController::class, 'register']);
// Route::post('keluarga', [AuthController::class, 'keluarga']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::get('berita', [WebBeritaController::class, 'berita']);
Route::get('surat', [WebSuratController::class, 'surat']);
Route::post('suratmasuk', [WebPengajuanController::class, 'suratmasuk']);
Route::post('rekap', [WebPengajuanController::class, 'rekap']);
Route::post('statussurat', [WebPengajuanController::class, 'statussurat']);
Route::post('pengajuan', [WebPengajuanController::class, 'pengajuan']);
Route::post('pembatalan', [WebPengajuanController::class, 'pembatalan']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/me', [AuthController::class, 'me']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('keluarga', [AuthController::class, 'keluarga']);
    Route::get('statusdiajukan', [WebPengajuanController::class, 'statusdiajukan']);
    Route::get('statusproses', [WebPengajuanController::class, 'statusproses']);
    Route::get('statusselesai', [WebPengajuanController::class, 'statusselesai']);
    Route::post('editnohp', [AuthController::class, 'editnohp']);
});