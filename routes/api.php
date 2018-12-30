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
Route::post('message/store', 'MessageController@store');
Route::get('conv/{id}', 'ConversationController@show');
Route::get('categories', 'CategoryController@show');
Route::get('interests', 'InterestController@getAll');
Route::post('subscribe/{id}/{int}/add', 'InterestController@subscribe');
Route::post('subscribe/{id}/{int}/remove', 'InterestController@unsubscribe');
Route::get('interest/profile/{id}', 'InterestController@show');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');
Route::group(['middleware' => 'jwt.auth'], function(){
	Route::get('auth/user', 'AuthController@user');
	Route::post('auth/logout', 'AuthController@logout');
});

Route::group(['middleware' => 'jwt.refresh'], function(){
	Route::get('auth/refresh', 'AuthController@refresh');
	Route::get('/{id}/profile', 'AuthController@refresh');
});
