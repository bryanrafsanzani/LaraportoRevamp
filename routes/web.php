<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
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
    return view('cms._layout.app');
    return view('welcome');
});

// Route::group(['middleware' => 'auth'], function() {

    Route::prefix('/')->group(function () {

        Route::prefix('settings')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->middleware('jwt.auth');
            Route::post('/update', 'SettingController@update')->middleware('jwt.auth');
            Route::delete('/delete/{id}', 'SettingController@delete')->middleware('jwt.auth');
        });

        Route::prefix('/log')->group(function () {
            Route::get('/', 'LogController@index')->name('log-index');
            Route::get('/datatables', 'LogController@datatables')->name('log-datatables');
        });

    });

// });