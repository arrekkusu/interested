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

Route::post('conv/store', 'ConversationController@store');
Route::post('interest/store', 'InterestController@store');
Route::post('message/store', 'MessageController@store');
Route::post('message/{id}/conv', 'MessageController@show');
Route::get('conv/{id}', 'ConversationController@show');
Route::get('get/users', 'AutoCompleteController@getUsers');
Route::get('subscribed/{pageTitle}/{UserInt}', 'ConversationController@isSubscribed');
Route::get('categories', 'CategoryController@show');
Route::get('{id}/recommended', 'CategoryController@recommended');
Route::get('interests', 'InterestController@getAll');
Route::post('subscribe/{id}/{int}/add', 'InterestController@subscribe');
Route::post('subscribe/{id}/{int}/remove', 'InterestController@unsubscribe');
Route::get('interest/profile/{id}', 'InterestController@show');
Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');
Route::group(['middleware' => 'api'], function(){
	Route::get('auth/user', 'AuthController@user');
	Route::post('auth/logout', 'AuthController@logout');
});

Route::group(['middleware' => 'jwt.refresh'], function(){
	Route::get('auth/refresh', 'AuthController@refresh');
	Route::get('/{id}/profile', 'AuthController@refresh');
});

Route::middleware('auth:api')->group(function () {
    Route::get('dashboard', function () {
        return response()->json(['data' => 'Test Data']);
    });
});