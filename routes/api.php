<?php

use Illuminate\Http\Request;

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

/**
 * For Respiberry Pi to Upload Data
 */
Route::post('insertData', 'DataController@insertData');
Route::get('getWarn', 'DataController@getWarn');
Route::post('upload', 'DataController@upload');
Route::delete('upload', 'DataController@deleteUpload');