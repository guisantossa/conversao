<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoinsController;

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


Route::get('/convert', [CoinsController::class, 'index'])->middleware('auth');
Route::get('/', [CoinsController::class, 'index'])->middleware('auth');
Route::get('/convert/{id}', [CoinsController::class, 'index'])->middleware('auth');
Route::post('/convert', [CoinsController::class, 'store'])->middleware('auth');
Route::get('/show', [CoinsController::class, 'show'])->middleware('auth');



Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('convert');
})->name('convert');
