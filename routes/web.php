<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\DataController;

use App\Http\Controllers\Admin\UploadController;

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });

Route::get('admin', [LoginController::class, 'index'])->name('login');
Route::post('admin', [LoginController::class, 'store']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('account/register', [LoginController::class, 'register'])->name('register');


Route::post('/upload', [UploadController::class, 'upload'])->name('upload');
Route::get('admin/get-section', function () {
    return view('admin.post.add_section')->render();
});


// ajax
Route::group(['prefix'=>'ajax'],function(){
    
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        // main
        Route::get('main', [MainController::class, 'index'])->name('admin');
        Route::resource('data',DataController::class);
        Route::get('dellall', [DataController::class, 'dellall'])->name('dellall');

        Route::resource('users',UserController::class);

    });
});

// home view
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('search', [HomeController::class, 'search'])->name('search');
