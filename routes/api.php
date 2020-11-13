<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController,
    App\Http\Controllers\Api\DashboardController,
    App\Http\Controllers\Api\SettingController,
    App\Http\Controllers\Api\MediaController,
    App\Http\Controllers\Api\DynamicFormController,
    App\Http\Controllers\Api\DynamicFillController,
    App\Http\Controllers\Api\LogController;
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


Route::prefix('v1')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('api-reset-password');

    Route::middleware(['jwt.verify'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::prefix('dashboard')->group(function () {
            Route::get('/', [DashboardController::class, 'index']);
        });

        Route::prefix('log')->group(function () {
            Route::get('/', [LogController::class, 'index']);
        });

        Route::prefix('setting')->group(function () {
            Route::get('/', [SettingController::class, 'index']);
        });

        Route::prefix('media')->group(function () {

            Route::get('/', [MediaController::class, 'index']);

            Route::prefix('upload')->group(function () {
                //not yet
            });
        });

        Route::prefix('dynamic-forms')->group(function () {
            Route::get('/', [DynamicFormController::class, 'index']);
        });

        Route::prefix('dynamic-fill')->group(function () {
            Route::get('/', [DynamicFillController::class, 'index']);
        });

        // Route::prefix('sidebar')->group(function () {
        //     Route::get('/login', 'Api\Mobile\AuthController@login');
        // });

    });

});
