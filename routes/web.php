<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller_kepuharjo;
use App\Http\Controllers\controller_berita;
use App\Http\Controllers\controller_masterkk;
use App\Http\Controllers\controller_mastersurat;
use App\Http\Controllers\controller_mastermasyarakat;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\data_usercontroller;
use App\Http\Controllers\DataController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageUploadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [controller_kepuharjo::class, 'index'])->name('index');
Route::get('/login', [controller_kepuharjo::class, 'login'])->name('login');
// Route::post('/loginauth', [controller_kepuharjo::class, 'loginauth'])->name('loginauth');
Route::get('/dashboard', [controller_kepuharjo::class, 'dashboard'])->name('dashboard');
Route::post('/postlogin',[controller_kepuharjo::class, 'customLogin'])->name('postlogin');


Route::get('/suratmasuk', [controller_kepuharjo::class, 'suratmasuk'])->name('suratmasuk');
Route::get('/suratditolak', [controller_kepuharjo::class, 'suratditolak'])->name('suratditolak');
Route::get('/suratselesai', [controller_kepuharjo::class, 'suratselesai'])->name('suratselesai');

Route::get('/masteruser', [controller_kepuharjo::class, 'masteruser'])->name('masteruser');
Route::get('/masterrtrw', [controller_kepuharjo::class, 'master_rtrw'])->name('masterrtrw');

Route::get('/tentang', [controller_kepuharjo::class, 'tentang'])->name('tentang');
Route::get('/buttons', [controller_kepuharjo::class, 'buttons'])->name('buttons');

Route::post('/simpanrtrw',[controller_kepuharjo::class, 'simpanmasterrtrw'])->name('simpanrtrw');

// Route::post('/simpanuserakun/{id}',[controller_kepuharjo::class, 'simpanmasteruserakun']);
// Route::post('/simpanuserakuns/{id}',[controller_kepuharjo::class, 'simpanmasteruserakun]);


Route::get('/masterrt/{id}', [controller_kepuharjo::class, 'master_rt'])->name('masterrt');
Route::post('/simpanrt',[controller_kepuharjo::class, 'simpanmasterrt'])->name('simpanrt');
Route::get('{id}/hapus-masterrt', [controller_kepuharjo::class, 'hapusmasterrt']);
Route::post('update-masterrt/{id}', [controller_kepuharjo::class, 'updatemasterrt']);


Route::get('{id}/hapus-masterrtrw', [controller_kepuharjo::class, 'hapusmasterrtrw']);
Route::post('update-masterrtrw/{id}', [controller_kepuharjo::class, 'updatemasterrtrw']);

Route::get('{id}/hapus-masteruser', [controller_kepuharjo::class, 'hapusmasteruser']);
Route::post('update-masteruser/{id}', [controller_kepuharjo::class, 'updatemasteruser']);

Route::get('/ajax', [controller_kepuharjo::class, 'ajax']);
Route::get('/ajaxmasyarakat', [controller_kepuharjo::class, 'ajax_masyarakat']);
Route::get('/read', [controller_kepuharjo::class, 'read']);


//Route Login
Route::get('login', [LoginController::class,'create'])->name('login');
Route::post('loginauth', [LoginController::class,'store']);



//Route Master KK Bagian Masyarakat
Route::get('/masterkkmas/{id}', [controller_kepuharjo::class, 'master_kk_mas']);
Route::post('/simpanuser',[controller_kepuharjo::class, 'simpanmasteruser'])->name('simpanuser');
Route::post('/simpanuserakuns/{id}', 'controller_kepuharjo@simpanmasteruserakun');
Route::get('simpanakuns/{id}', [controller_kepuharjo::class, 'simpanmasteruserakun']);



// Route Master KK
Route::get('/masterkk', [controller_masterkk::class, 'master_kk'])->name('masterkk');
Route::post('/simpankk',[controller_masterkk::class, 'simpanmasterkk'])->name('simpankk');
Route::get('{id}/hapus-masterkk', [controller_masterkk::class, 'hapus']);
Route::post('update-masterkk/{id}', [controller_masterkk::class, 'update']);



// Route Berita
Route::get('/berita', [controller_berita::class, 'berita'])->name('berita');
Route::get('hapus-berita/{id}', [controller_berita::class, 'hapusberita']);
Route::post('update-berita/{id}', [controller_berita::class, 'updateberita']);
Route::post('/simpanberita',[controller_berita::class, 'simpanmasterberita'])->name('simpanberita');



// Route Master Surat
Route::get('/mastersurat', [controller_mastersurat::class, 'master_surat']);
Route::post('/simpansurat',[controller_mastersurat::class, 'simpan_surat'])->name('simpansurat');
Route::post('/editsurat/{id}',[controller_mastersurat::class, 'updatesurat']);
Route::get('hapussurat/{id}', [controller_mastersurat::class, 'hapusmastersurat']);


//Route img profile
Route::post('image-upload', [ImageUploadController::class, 'imageUploadPost']);

//Route img profile
Route::get('superadmin', [controller_kepuharjo::class, 'superadmin']);
