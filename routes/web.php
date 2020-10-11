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
    return view('cms._layout.app');
    return view('welcome');
});

// Route::group(['middleware' => 'auth'], function() {

    Route::prefix('/')->group(function () {

        Route::prefix('settings')->group(function () {
            Route::get('/', 'SettingController@index')->name('setting-index');
            Route::post('/update', 'SettingController@update')->name('setting-update');
            Route::delete('/delete/{id}', 'SettingController@delete')->name('setting-delete');
        });

        Route::prefix('/log')->group(function () {
            Route::get('/', 'LogController@index')->name('log-index');
            Route::get('/datatables', 'LogController@datatables')->name('log-datatables');
        });

    });

// });