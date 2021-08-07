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

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

    Route::get('userList','AuthController@getUserList');
});
Route::post('register','User\UserController@createUser');
Route::post('login','User\UserController@loginUser');


Route::middleware('auth:sanctum')->group(function (){

Route::get('customer','User\UserController@getUser');
Route::get('customer/{id}/message','Message\MessageController@getMessageByUserId');
Route::put('customer/{id}','User\UserController@updateUser');
Route::delete('customer/{id}','User\UserController@deleteUser');

Route::get('message','Message\MessageController@getMessage');
Route::post('message','Message\MessageController@createMessage');

Route::get('report','Report\ReportController@getReport');
Route::post('report','Report\ReportController@createReport');
});
