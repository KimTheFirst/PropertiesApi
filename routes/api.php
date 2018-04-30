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
/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::get('/properties', 'PropertyApiController@meh');

Route::get('/properties/list', 'PropertyApiController@list');

Route::get('/properties/get', 'PropertyApiController@get');

Route::get('/properties/add', 'PropertyApiController@add');

Route::get('/properties/delete', 'PropertyApiController@delete');

Route::get('/properties/search', 'PropertyApiController@search');

