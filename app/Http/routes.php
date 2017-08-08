<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }else {
        return view('welcome');
    }
});

Route::auth();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home/{vue?}', 'HomeController@index')->where('vue', '[\/\w\.-]*');
    Route::post('/AddRoom', 'RoomsController@AddRoom');
    Route::get('/MyRooms', 'RoomsController@MyRooms');
    Route::get('/AllRooms', 'RoomsController@AllRooms');
    Route::get('/DeleteRoom/{id}', 'RoomsController@DeleteRoom');
    Route::get('/getRoomMessages/{id}', 'RoomsController@getRoomMessages');
    Route::get('/getOnlineUsers/{id}', 'RoomsController@getOnlineUsers');
    Route::post('/AddMessage', 'MessagesController@AddMessage');
    Route::post('/AddAvatar', 'HomeController@AddAvatar');
    Route::get('/RemoveLeavingUser/{id}', 'RoomsController@RemoveLeavingUser');
});
