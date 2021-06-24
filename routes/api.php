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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers\HR')->group(function () {
    Route::post('store/evaluation', 'MonthlyEvaluationController@store')->name('store');
    Route::post('update/evaluation', 'MonthlyEvaluationController@update')->name('update');
    Route::delete('delete/evaluation/{data}', 'MonthlyEvaluationController@destroy')->name('destroy');
    Route::get('evaluation', 'MonthlyEvaluationController@index')->name('index');
    Route::get('evaluation/{id}', 'MonthlyEvaluationController@show')->name('show');

    Route::post('store/evaluation/category', 'MonthlyEvaluationController@storeCategory');
    Route::post('update/evaluation/category', 'MonthlyEvaluationController@updateCatgory');
    Route::delete('delete/evaluation/category/{data}', 'MonthlyEvaluationController@destroyCategory');
});

