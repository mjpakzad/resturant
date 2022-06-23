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
    Route::prefix('admin')->name('admin')->namespace('Admin')->group(function() {
        Route::resource('foods', 'FoodController')->except(['create', 'edit', 'destroy']);

    });

    Route::name('frontend')->namespace('Frontend')->group(function () {
        Route::resource('foods', 'FoodController')->only(['index', 'show']);
    });
});
