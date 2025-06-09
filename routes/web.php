<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PredictController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Landing\IndexController;

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

Route::get('/', [IndexController::class, 'index'])->name('landing.index');
Route::post('landing/predict', [IndexController::class, 'prediction'])->name('landing.predict');

# Auth Controller
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

# Dashboard Controller
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

# Comment Controller
Route::get('sentiment', [CommentController::class, 'index'])->name('sentiment')->middleware('auth');
Route::post('sentiment/import', [CommentController::class, 'importCsv'])->name('sentimen.import')->middleware('auth');
Route::delete('sentiment/delete', [CommentController::class, 'deleteAll'])->name('sentiment.delete')->middleware('auth');

# Predict Controller
Route::get('prediction', [PredictController::class, 'index'])->name('predict')->middleware('auth');
Route::post('prediction', [PredictController::class, 'prediction'])->name('predict.post')->middleware('auth');
