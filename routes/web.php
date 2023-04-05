<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller_kepuharjo;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\data_usercontroller;
use App\Http\Controllers\DataController;

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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/home', function () {
    return view('home', ['name' => 'Edy Atthoillah', 'role' => 'user']);
});



Route::get('/', [controller_kepuharjo::class, 'index'])->name('index');
Route::get('/login', [controller_kepuharjo::class, 'login'])->name('login');
Route::get('/dashboard', [controller_kepuharjo::class, 'dashboard'])->name('dashboard');
Route::post('/postlogin',[controller_kepuharjo::class, 'customLogin'])->name('postlogin');


Route::get('/suratmasuk', [controller_kepuharjo::class, 'suratmasuk'])->name('suratmasuk');
Route::get('/suratditolak', [controller_kepuharjo::class, 'suratditolak'])->name('suratditolak');
Route::get('/suratselesai', [controller_kepuharjo::class, 'suratselesai'])->name('suratselesai');

Route::get('/masteruser', [controller_kepuharjo::class, 'masteruser'])->name('masteruser');
Route::get('/masterrtrw', [controller_kepuharjo::class, 'master_rtrw'])->name('masterrtrw');

Route::get('/masterkk', [controller_kepuharjo::class, 'master_kk'])->name('masterkk');

Route::get('/berita', [controller_kepuharjo::class, 'berita'])->name('berita');
Route::get('/tentang', [controller_kepuharjo::class, 'tentang'])->name('tentang');

Route::get('/buttons', [controller_kepuharjo::class, 'buttons'])->name('buttons');


Route::post('/simpankk',[controller_kepuharjo::class, 'simpanmasterkk'])->name('simpankk');
Route::post('/simpanrtrw',[controller_kepuharjo::class, 'simpanmasterrtrw'])->name('simpanrtrw');
Route::post('/simpanuser',[controller_kepuharjo::class, 'simpanmasteruser'])->name('simpanuser');
Route::post('/simpanberita',[controller_kepuharjo::class, 'simpanmasterberita'])->name('simpanberita');


Route::get('{id}/hapus-masterkk', [controller_kepuharjo::class, 'hapusmasterkk']);
Route::post('update-masterkk/{id}', [controller_kepuharjo::class, 'update']);

Route::get('{id}/hapus-berita', [controller_kepuharjo::class, 'hapusberita']);
Route::post('update-berita/{id}', [controller_kepuharjo::class, 'updateberita']);

Route::get('{id}/hapus-masterrtrw', [controller_kepuharjo::class, 'hapusmasterrtrw']);
Route::post('update-masterrtrw/{id}', [controller_kepuharjo::class, 'updatemasterrtrw']);

Route::get('{id}/hapus-masteruser', [controller_kepuharjo::class, 'hapusmasteruser']);
Route::post('update-masteruser/{id}', [controller_kepuharjo::class, 'updatemasteruser']);

// Route::get('/data_user', 'data');
// Route::get('/data_user', [data_usercontroller::class, 'index']);
// Route::get('/data_user/json', [data_usercontroller::class, 'json']);