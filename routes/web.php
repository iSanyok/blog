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
Route::post('/profile/subscribe/{id}', [HomeController::class, 'subscribe'])->name('subscribe')
    ->middleware('auth');

Route::prefix('article')->group(function() {
    Route::get('/show/{id}', [ArticleController::class, 'show'])->name('show');
    Route::post('add/comment/{id}', [ArticleController::class, 'comment'])->name('comment');
    Route::get('/add', [ArticleController::class, 'add'])->middleware('auth')->name('add');
    Route::post('/store', [ArticleController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ArticleController::class, 'edit'])->name('edit')->middleware('auth');
    Route::put('/update/{id}', [ArticleController::class, 'update'])->name('update')->middleware('auth');
    Route::delete('/delete/{id}', [ArticleController::class, 'destroy'])->name('destroy')->middleware('auth');
});
