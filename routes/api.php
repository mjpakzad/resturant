<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::prefix('v1')->namespace('App\Http\Controllers\Api\V1')->group(function () {
    Route::post('register', 'AuthController@register')->name('register');
    Route::post('login', 'AuthController@login')->name('login');

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', 'AuthController@logout')->name('logout');

        Route::prefix('admin')->name('admin')->namespace('Admin')->group(function() {
            Route::resource('menus', 'MenuController')->only('store');
            Route::resource('foods', 'FoodController')->except(['create', 'edit', 'destroy']);
        });

        Route::name('frontend')->namespace('Frontend')->group(function () {
            Route::resource('menus', 'MenuController')->only(['index', 'show']);
            Route::resource('foods', 'FoodController')->only(['index', 'show']);
        });
    });
});
