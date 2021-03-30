<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SidebarController;
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

Route::get('/', [HomeController::class, 'index'])
    ->name('index');

Route::prefix('profile')->group(function () {
    Route::get('/{id}', [HomeController::class, 'profile'])
        ->name('profile');

    Route::post('/subscribe/{id}', [HomeController::class, 'subscribe'])
        ->name('subscribe')
        ->middleware('auth');

    Route::delete('/unsubscribe/{id}', [HomeController::class, 'unsubscribe'])
        ->name('unsubscribe')
        ->middleware('auth');
});

Route::prefix('article')->group(function () {
    Route::get('/show/{id}', [ArticleController::class, 'show'])
        ->name('show');

    Route::post('add/comment/{id}', [ArticleController::class, 'storeComment'])
        ->name('storeComment');

    Route::get('/add', [ArticleController::class, 'add'])
        ->middleware('auth')
        ->name('add');

    Route::post('/store', [ArticleController::class, 'store'])
        ->name('store');

    Route::get('/edit/{id}', [ArticleController::class, 'edit'])
        ->middleware('auth')
        ->name('edit');

    Route::put('/update/{id}', [ArticleController::class, 'update'])
        ->middleware('auth')
        ->name('update');

    Route::delete('/delete/{id}', [ArticleController::class, 'destroy'])
        ->middleware('auth')
        ->name('destroy');

    Route::put('/like/{id}', [ArticleController::class, 'like'])
        ->middleware('auth')
        ->name('like');

    Route::put('/dislike/{id}', [ArticleController::class, 'dislike'])
        ->middleware('auth')
        ->name('dislike');
});

Route::get('/get/today', [SidebarController::class, 'getToday'])->name('getToday');
Route::get('/get/week', [SidebarController::class, 'getWeek'])->name('getWeek');
Route::get('/get/mouth', [SidebarController::class, 'getMouth'])->name('getMouth');
Route::get('/get/yead', [SidebarController::class, 'getYear'])->name('getYear');
