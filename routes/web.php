<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

App::setLocale("pt");

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/load/{id}', [MainController::class, 'load'])->name('load');

Route::post('/next/{id?}', [MainController::class, 'next'])->name('next');
Route::post('/start', [MainController::class, 'start'])->name('start');
Route::post('/child/{id}', [MainController::class, 'child'])->name('child');
Route::post('/store', [MainController::class, 'store'])->name('store');

Route::put('/update/{id?}', [MainController::class, 'update'])->name('update');