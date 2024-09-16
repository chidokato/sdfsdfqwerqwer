<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\Admin\AdvertiseController;

use App\Http\Controllers\Admin\UploadController;

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;

Route::get('login-admin-mrbin2k3', [LoginController::class, 'index'])->name('login');
Route::post('admin', [LoginController::class, 'store']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/upload', [UploadController::class, 'upload'])->name('upload');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        // main
        Route::get('main', [MainController::class, 'index'])->name('admin');
        Route::resource('data',DataController::class);
        
        Route::get('dellall', [DataController::class, 'dellall'])->name('dellall');

        Route::resource('advertise',AdvertiseController::class);

        Route::resource('users',UserController::class);

    });
});

// home view
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('search', [HomeController::class, 'search'])->name('search');
