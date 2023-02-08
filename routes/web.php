<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth_controller;

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
//     return view('admin.login');
// });

Route::get('/', [Auth_controller::class, 'login_page']);
Route::post('/login_aksi', [Auth_controller::class, 'login']);
Route::get('/register', [Auth_controller::class, 'register']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [Auth_controller::class, 'dashboard']);
    Route::get('/edit_user', [Auth_controller::class, 'edit_user']);
    Route::post('/aksi_edit_user', [Auth_controller::class, 'aksi_edit_user']);
    Route::get('/logout', [Auth_controller::class, 'logout']);
});
Route::get('/', [Auth_controller::class, 'login_page'])->name('login');
