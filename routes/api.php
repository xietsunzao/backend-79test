<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\AccountController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\PointController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// auth
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// route group controller
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/accounts', [AccountController::class, 'index'])->name('account.index');
    Route::get('/accounts/{id}', [AccountController::class, 'show'])->name('account.show');
    Route::post('/accounts', [AccountController::class, 'store'])->name('account.store');
    Route::post('/accounts/{id}', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/accounts/{id}', [AccountController::class, 'destroy'])->name('account.destroy');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transaction.show');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transaction.store');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/points', [PointController::class, 'index'])->name('point.index');
    Route::get('/points/{id}', [PointController::class, 'show'])->name('point.show');
    Route::get('/points/{account_id}/account', [PointController::class, 'showByAccount'])->name('point.showByAccount');
});
