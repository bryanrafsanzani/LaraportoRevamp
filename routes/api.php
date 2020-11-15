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
    Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('api-reset-password');
    Route::post('/reset-password', [AuthController::class, 'submitResetPassword']);

    Route::middleware(['jwt.verify'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::prefix('dashboard')->group(function () {
            Route::get('/', [DashboardController::class, 'index']);
        });

        Route::prefix('log')->group(function () {
            Route::get('/', [LogController::class, 'index']);
        });

        Route::prefix('setting')->group(function () { //Done
            Route::get('/', [SettingController::class, 'index']);
            Route::post('/update', [SettingController::class, 'update']);
            Route::post('/store', [SettingController::class, 'store']);
        });

        Route::prefix('media')->group(function () {

            Route::get('/', [MediaController::class, 'index']);

            Route::prefix('upload')->group(function () {
                //not yet
            });
        });

        Route::prefix('dynamic-form')->group(function () { //done
            Route::get('/', [DynamicFormController::class, 'index']);
            Route::post('/store', [DynamicFormController::class, 'store']);
            Route::get('/view', [DynamicFormController::class, 'view']); //specific data
            Route::post('/update', [DynamicFormController::class, 'update']);
            Route::delete('/delete/{id}', [DynamicFormController::class, 'delete']);
        });

        Route::prefix('dynamic-fill')->group(function () {
            Route::get('/', [DynamicFillController::class, 'index']);
            Route::post('/store', [DynamicFillController::class, 'store']);
            Route::get('/view', [DynamicFillController::class, 'view']); //specific data
            Route::post('/update', [DynamicFillController::class, 'update']);
            Route::delete('/delete/{id}', [DynamicFillController::class, 'delete']);
        });

        // Route::prefix('sidebar')->group(function () {
        //     Route::get('/login', 'Api\Mobile\AuthController@login');
        // });

    });

});
