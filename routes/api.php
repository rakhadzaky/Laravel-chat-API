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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user_chat')->group(function(){
    Route::post('login', 'UserController@login_proses');
    Route::post('users', 'UserController@store');
// middleware:login
    Route::middleware('auth:user')->group(function(){
        Route::get('users', 'UserController@index');
        Route::get('users/{id}', 'UserController@show');
        Route::put('users/{id}', 'UserController@update');
        Route::delete('users/{id}', 'UserController@destroy');
        Route::get('who_am_i', 'UserController@who_am_i');
// prefix:rooms
        Route::prefix('rooms')->group(function(){
            Route::get('list', 'RoomController@own_room');
            Route::post('create/{id}','PersonController@store');
// middleware:owner            
            Route::middleware('owner')->group(function(){
                Route::get('detail/{id}', 'RoomController@show_own');
                Route::delete('delete/{id}', 'RoomController@destroy');
                Route::prefix('persons/{id}')->group(function(){
                    Route::post('add', 'PersonController@add_person');
                    Route::get('list', 'PersonController@room_persons');
                    Route::delete('delete/{uid}','PersonController@destroy');
                });
            });
            // Route::post('create', 'RoomController@store');
        });
// prefix::chat_room/{id} middleware:owner
        Route::prefix('chat_room/{id}')->middleware('owner')->group(function(){
            Route::get('message', 'ChatController@Chat_In_Room');
            Route::post('create', 'ChatController@store');
        });
        Route::get('logout', 'UserController@logout_proses');
    });
});