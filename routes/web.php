<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/show/{id}', [ArticleController::class, 'show'])->name('show');
Route::get('/add', [ArticleController::class, 'add'])->name('add');
Route::post('/store', [ArticleController::class, 'store'])->name('store');