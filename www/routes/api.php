<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Url;
use App\Http\Controllers\User\UrlApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->prefix('v1')->group(function() {
    Route::get('/user', function(Request $request){
        return $request->user();
    });
//    Route::get('urls', [UrlApiController::class, 'index']);
//    Route::get('urls/{id}', [UrlApiController::class, 'show']);
    Route::apiResource('/urls', UrlApiController::class);
});
