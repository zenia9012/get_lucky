<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlayController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'auth_link'])->name('home');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.showLoginForm');
Route::post('login', [LoginController::class, 'login'])->name('login');


Route::put('users/generate-link', [UsersController::class, 'generateLink']);
Route::put('users/destroy-link', [UsersController::class, 'destroyLink']);


Route::post('plays', [PlayController::class, 'getLucky']);
Route::get('plays', [PlayController::class, 'index']);






Route::name('admin.')->middleware(['is_admin', 'auth'])->prefix('admin')->group( function () {
    Route::resource('users', AdminUsersController::class);
});

