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
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('createroom', 'API\RoomController@createroom');
Route::post('searchroom', 'API\RoomController@searchroom');
Route::post('askroom', 'API\RoomController@askroom');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'API\UserController@details');
});