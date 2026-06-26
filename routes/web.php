<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\dapur\DashboardController;
use App\Http\Controllers\dapur\BeritakategoriController;
use App\Http\Controllers\dapur\BeritaController;
use App\Http\Controllers\dapur\PublikasikategoriController;
use App\Http\Controllers\dapur\PublikasiController;
use App\Http\Controllers\dapur\ImagesliderController;
use App\Http\Controllers\dapur\PenggunalevelController;
use App\Http\Controllers\dapur\PenggunaController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/indeks', [HomeController::class, 'indeks']);
Route::get('/manage', [LoginController::class, 'index'])->name('manage');
Route::post('/loginprocess', [LoginController::class, 'authenticate']);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/logout', function(){
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    
        return redirect('/');
    })->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/dap/kategoriberita', [BeritakategoriController::class, 'index']);
    Route::get('/dap/kategoriberita/getlist', [BeritakategoriController::class, 'getlist']);
    Route::get('/dap/kategoriberita/add', [BeritakategoriController::class, 'add']);
    Route::post('/dap/kategoriberita/save', [BeritakategoriController::class, 'save']);
    Route::get('/dap/kategoriberita/edit', [BeritakategoriController::class, 'edit']);
    Route::post('/dap/kategoriberita/saveupdate', [BeritakategoriController::class, 'saveupdate']);
    Route::post('/dap/kategoriberita/delete', [BeritakategoriController::class, 'delete']);

    Route::get('/dap/berita', [BeritaController::class, 'index']);
    Route::get('/dap/berita/getlist', [BeritaController::class, 'getlist']);
    Route::get('/dap/berita/add', [BeritaController::class, 'add']);
    Route::post('/dap/berita/save', [BeritaController::class, 'save']);
    Route::get('/dap/berita/edit', [BeritaController::class, 'edit']);
    Route::post('/dap/berita/saveupdate', [BeritaController::class, 'saveupdate']);
    Route::post('/dap/berita/delete', [BeritaController::class, 'delete']);

    Route::get('/dap/kategoripublikasi', [PublikasikategoriController::class, 'index']);
    Route::get('/dap/kategoripublikasi/getlist', [PublikasikategoriController::class, 'getlist']);
    Route::get('/dap/kategoripublikasi/add', [PublikasikategoriController::class, 'add']);
    Route::post('/dap/kategoripublikasi/save', [PublikasikategoriController::class, 'save']);
    Route::get('/dap/kategoripublikasi/edit', [PublikasikategoriController::class, 'edit']);
    Route::post('/dap/kategoripublikasi/saveupdate', [PublikasikategoriController::class, 'saveupdate']);
    Route::post('/dap/kategoripublikasi/delete', [PublikasikategoriController::class, 'delete']);

    Route::get('/dap/publikasi', [PublikasiController::class, 'index']);
    Route::get('/dap/publikasi/getlist', [PublikasiController::class, 'getlist']);
    Route::get('/dap/publikasi/add', [PublikasiController::class, 'add']);
    Route::post('/dap/publikasi/save', [PublikasiController::class, 'save']);
    Route::get('/dap/publikasi/edit', [PublikasiController::class, 'edit']);
    Route::post('/dap/publikasi/saveupdate', [PublikasiController::class, 'saveupdate']);
    Route::post('/dap/publikasi/delete', [PublikasiController::class, 'delete']);

    Route::get('/dap/imageslider', [ImagesliderController::class, 'index']);
    Route::get('/dap/imageslider/getlist', [ImagesliderController::class, 'getlist']);
    Route::get('/dap/imageslider/add', [ImagesliderController::class, 'add']);
    Route::post('/dap/imageslider/save', [ImagesliderController::class, 'save']);
    Route::get('/dap/imageslider/edit', [ImagesliderController::class, 'edit']);
    Route::post('/dap/imageslider/saveupdate', [ImagesliderController::class, 'saveupdate']);
    Route::post('/dap/imageslider/delete', [ImagesliderController::class, 'delete']);

    Route::get('/dap/levelpengguna', [PenggunalevelController::class, 'index']);
    Route::get('/dap/levelpengguna/getlist', [PenggunalevelController::class, 'getlist']);
    Route::get('/dap/levelpengguna/add', [PenggunalevelController::class, 'add']);
    Route::post('/dap/levelpengguna/save', [PenggunalevelController::class, 'save']);
    Route::get('/dap/levelpengguna/edit', [PenggunalevelController::class, 'edit']);
    Route::post('/dap/levelpengguna/saveupdate', [PenggunalevelController::class, 'saveupdate']);
    Route::post('/dap/levelpengguna/delete', [PenggunalevelController::class, 'delete']);

    Route::get('/dap/pengguna', [PenggunaController::class, 'index']);
    Route::get('/dap/pengguna/getlist', [PenggunaController::class, 'getlist']);
    Route::get('/dap/pengguna/add', [PenggunaController::class, 'add']);
    Route::post('/dap/pengguna/save', [PenggunaController::class, 'save']);
    Route::get('/dap/pengguna/edit', [PenggunaController::class, 'edit']);
    Route::post('/dap/pengguna/saveupdate', [PenggunaController::class, 'saveupdate']);
    Route::post('/dap/pengguna/delete', [PenggunaController::class, 'delete']);
    Route::get('/dap/pengguna/gantipassword', [PenggunaController::class, 'gantipassword']);
    Route::post('/dap/pengguna/passwordupdate', [PenggunaController::class, 'passwordupdate']);
});