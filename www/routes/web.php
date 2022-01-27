<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UrlController;
use App\Http\Controllers\User\RedirectController;
use App\Mail\FirstMail;

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

Route::get('/language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language-switch');


Route::get('/auth/google', [\App\Http\Controllers\User\GoogleController::class, 'redirectToGoogle'])->name('google-login');
Route::get('/auth/google/callback', [\App\Http\Controllers\User\GoogleController::class, 'handleGoogleCallback'])->name('google-login-callback');
