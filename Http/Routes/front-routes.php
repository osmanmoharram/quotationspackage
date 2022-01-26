<?php

/*
|--------------------------------------------------------------------------
| Front Routes For doquot
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* Customer Routes */
Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {
        Route::get('/doquot/{id}','DOCore\DOQuot\Http\Controllers\Front\DOQuotController@index')
        ->name('front.doquot.index');
});
