<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'index'])->name('books.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
	Route::group(['prefix' => 'users'], function () {
		Route::get('/', [UserController::class, 'index'])->name('users.index');
		Route::get('/create', [UserController::class, 'create'])->name('users.create');
		Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
		Route::post('/store', [UserController::class, 'store'])->name('users.store');
		Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
		Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
	});
});
