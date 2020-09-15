<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('books', 'BookController');
    Route::resource('categories', 'CategoryController');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('users/{user}/make-admin', 'UserController@makeAdmin')->name('users.make-admin');
    Route::get('users/profile', 'UserController@edit')->name('users.edit-profile');
    Route::put('users/profile', 'UserController@update')->name('users.update-profile');
    Route::resource('users', 'UserController');
    Route::resource('books', 'BookController')->only(['create', 'store', 'edit', 'update']);
    Route::resource('categories', 'CategoryController')->only(['create', 'store', 'edit', 'update']);
});


