<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\home\ProfileController;
use App\Http\Controllers\post\CommentController;
use App\Http\Controllers\post\LikeController;
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
    Route::get('/post/{post}', 'show')->name('show');
    Route::delete('/post/{post}', 'destroy')->name('destroy');
});
//profile
Route::controller(ProfileController::class)->group(function () {
    Route::get('/user/posts', 'profile')->name('myPosts');
    Route::patch('/user/edit-profile', 'changeProfile')->name('changeProfile');
    Route::patch('/user/edit-profile/change-password/', 'changePassword')->name('changePassword');
    Route::patch('/user/edit-profile/change-profile-pic', 'updateProfilePic')->name('updateProfilePic');
});

//post likes
Route::post('/post/{post}/like', [LikeController::class, 'store'])->name('like');

//Comments
Route::controller(CommentController::class)->group(function () {
    Route::post('/post/{post}/comment', 'store')->name('comment');
    Route::delete('/post/{post}/comment/{comment}', 'destroy')->name('deleteComment');
});


