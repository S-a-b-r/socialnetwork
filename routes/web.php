<?php

use App\Http\Controllers\AccessController;
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

Route::prefix('access')->controller(AccessController::class)->middleware('auth')->group(function () {
    Route::post('/add', 'add')->name('access.list.add');
    Route::post('/delete', 'delete')->name('access.list.delete');
});

Route::prefix('comments')->controller(CommentController::class)->group(function () {
    Route::get('/', 'index')->name('comments.index');
    Route::post('/', 'store')->name('comments.store')->middleware('auth');
    Route::get('/{comment}/answer', 'answer')->name('comments.answer')->middleware('auth');
    Route::delete('/{comment}', 'delete')->name('comments.delete')->middleware('auth');
});

Route::prefix('books')->controller(BookController::class)->middleware('auth')->group(function () {
    Route::get('/create', 'create')->name('books.create');
    Route::get('/link/{link}', 'showByLink')->name('books.showByLink');
    Route::post('/', 'store')->name('books.store');
    Route::get('/{book}', 'show')->name('books.show')->middleware('access.list');
    Route::get('/{book}/edit', 'edit')->name('books.edit')->middleware('book.author');
    Route::patch('/{book}', 'update')->name('books.update')->middleware('book.author');
    Route::delete('/{book}', 'delete')->name('books.delete')->middleware('book.author');
    Route::post('/{book}/make_link','makeLink')->name('books.make.link')->middleware('book.author');
});

Route::prefix('/profiles')->controller(ProfileController::class)->group(function () {
    Route::get('/', 'index')->name('profile.index');
    Route::get('/library/{id}', 'library')->name('profile.library');
    Route::get('/{id}', 'show')->name('profile.show');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

