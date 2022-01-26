<?php
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

// API Routes

Route::group(['prefix' => 'api'], function ($router) {

        Route::group(['namespace' => 'DOCore\DOQuot\Http\Controllers\Api',
                      'middleware' => ['locale', 'theme', 'currency']], function ($router) {
                Route::get('doquot', 'DOQuotController@index')->defaults('_config', []);
                Route::get('doquot/{id}', 'DOQuotController@get')->defaults('_config', []);
        });

});
