<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\dapur\DashboardController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/indeks', [HomeController::class, 'indeks']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/loginprocess', [LoginController::class, 'authenticate']);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/logout', function(){
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    
        return redirect('/');
    })->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index']);
});