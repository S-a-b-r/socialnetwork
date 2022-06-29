<?php

use App\Http\Controllers\BookController;
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
    Route::get('/', 'index')->name('comments.index');
    Route::post('/', 'store')->name('comments.store');
    Route::get('/{commentId}/answer', 'answer')->name('comments.answer');
    Route::delete('/{id}', 'delete')->name('comments.delete');
});

Route::prefix('books')->controller(BookController::class)->group(function () {
    Route::get('/create', 'create')->name('books.create')->middleware('auth');
    Route::post('/', 'store')->name('books.store');
    Route::get('/{bookId}', 'show')->name('books.show');
    Route::get('/{bookId}/edit', 'edit')->name('books.edit');
    Route::patch('/{bookId}', 'update')->name('books.update');
    Route::delete('/{bookId}', 'delete')->name('books.delete');
});

Route::prefix('/profiles')->controller(ProfileController::class)->group(function () {
    Route::get('/', 'index')->name('profile.index');
    Route::get('/library/{id}', 'library')->name('profile.library');
    Route::get('/{id}', 'show')->name('profile.show');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

