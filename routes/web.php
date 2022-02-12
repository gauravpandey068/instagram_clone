<?php

use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'loginView')->name('login');
    Route::post('/', 'login');
    Route::get('/register', 'registerView')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});
