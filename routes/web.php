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

//Auth::routes();

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/profile/{id}', [HomeController::class, 'index'])->name('home');

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('show');
Route::get('/add', [ArticleController::class, 'add'])->name('add');
Route::post('/store', [ArticleController::class, 'store'])->name('store');
