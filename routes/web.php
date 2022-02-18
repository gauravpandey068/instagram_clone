<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\post\PostController;
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

//auth
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'loginView')->name('login');
    Route::post('/', 'login');
    Route::get('/register', 'registerView')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});

//Home
Route::controller(PostController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::post('/post', 'store')->name('post');
});
//profile
Route::get('/user/posts', [HomeController::class, 'myPost'])->name('myPosts');
Route::patch('/user/edit-profile', [HomeController::class, 'changeProfile'])->name('changeProfile');
Route::patch('/user/edit-profile/change-password/', [HomeController::class, 'changePassword'])->name('changePassword');
Route::patch('/user/edit-profile/change-profile-pic', [HomeController::class, 'updateProfilePic'])->name('updateProfilePic');


