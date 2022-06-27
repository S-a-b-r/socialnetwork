<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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
    return redirect(route('profile.index'));
});

Route::prefix('comments')->controller(CommentController::class)->group(function () {
    Route::post('/', 'store')->name('comments.store');
    Route::delete('/{id}', 'delete')->name('comments.delete');
});

Route::prefix('/profiles')->controller(ProfileController::class)->group(function () {
    Route::get('/', 'index')->name('profile.index');
    Route::get('/{id}', 'show')->name('profile.show');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

