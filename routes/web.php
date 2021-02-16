<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/profile/{id}', [HomeController::class, 'profile'])->name('profile');
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('show');
Route::post('/article/{id}/comment', [ArticleController::class, 'comment'])->name('comment');
Route::get('/article/add', [ArticleController::class, 'add'])->middleware('auth')->name('add');
Route::post('/article/store', [ArticleController::class, 'store'])->name('store');
Route::put('/article/{id}/update', [ArticleController::class, 'update'])->name('update')->middleware('auth');
Route::delete('/article/{id}/delete', [ArticleController::class, 'delete'])->name('delete')->middleware('auth');
