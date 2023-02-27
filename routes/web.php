<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller_kepuharjo;

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

// Route::get('/login', function () {
//     return view('login');
// });



Route::get('/', [controller_kepuharjo::class, 'index']);
Route::get('/login', [controller_kepuharjo::class, 'login']);
Route::get('/dashboard', [controller_kepuharjo::class, 'dashboard']);