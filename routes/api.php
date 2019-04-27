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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::post('server/ping','Controller@ping');
Route::post('server/new','Controller@create');
Route::post('server/delete','Controller@delete');
Route::post('server/update','Controller@update');
Route::get('server/all','Controller@all');
Route::get('server/find/{id}','Controller@findById');