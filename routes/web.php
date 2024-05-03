<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'home'])->name('books.home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
	Route::group(['prefix' => 'users', 'middleware' => ['role:admin'], 'controller' => UserController::class], function () {
		Route::get('/', 'index')->name('users.index');
		Route::get('/create', 'create')->name('users.create');
		Route::get('/{user}/edit', 'edit')->name('users.edit');
		Route::post('/store', 'store')->name('users.store');
		Route::put('/{user}', 'update')->name('users.update');
		Route::delete('/{user}', 'destroy')->name('users.destroy');
	});

	Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
		Route::get('/', 'index')->name('categories.index')->middleware('can:categories.index');
		Route::get('/get-all', 'index')->name('categories.get-all')->middleware('can:categories.get-all');
		Route::get('/get-all-dt', 'getAll')->name('categories.get-all-db');
		Route::get('/{category}', 'show')->name('categories.show');

		Route::get('/create', 'create')->name('categories.create')->middleware('can:categories.create');
		Route::get('/{category}/edit', 'edit')->name('categories.edit')->middleware('can:categories.edit');
		Route::post('/store', 'store')->name('categories.store')->middleware('can:categories.store');
		Route::put('/{category}', 'update')->name('categories.update')->middleware('can:categories.update');
		Route::delete('/{category}', 'destroy')->name('categories.destroy');
	});

	Route::group(['prefix' => 'books', 'controller' => BookController::class], function () {
		Route::get('/', 'index')->name('books.index');
		Route::get('/{book}', 'show')->name('books.show')->middleware('can:books.show');
		Route::post('/store', 'store')->name('books.store')->middleware('can:books.store');
		//se usa post para update, porque se envia un form y laravel no acepta con put
		Route::post('/update/{book}', 'update')->name('books.update')->middleware('can:books.update');
		Route::delete('/{book}', 'destroy')->name('books.destroy')->middleware('can:books.destroy');
	});
});
