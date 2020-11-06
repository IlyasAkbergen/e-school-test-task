<?php

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

Route::group(['namespace' => 'Marks'], function () {
    Route::post(
        '/get-marks-per-group',
        'MarksController@getMarksPerGroup'
    );

    Route::post(
        '/get-marks-per-pupil',
        'MarksController@getMarksPerPupil'
    );
});
