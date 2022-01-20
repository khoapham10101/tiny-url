<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UrlController;
use App\Http\Controllers\User\RedirectController;

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

Route::get('/', '\App\Http\Controllers\User\UrlController@create');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'auth.isAdmin'])->name('admin.')->group(function() {
    Route::resource('/users', UserController::class);
});

// User routes
Route::prefix('user')->middleware(['auth'])->name('user.')->group(function() {
    Route::resource('/urls', UrlController::class);
});

Route::get('/{url}', '\App\Http\Controllers\User\RedirectController@index')->name('shorten-url');
