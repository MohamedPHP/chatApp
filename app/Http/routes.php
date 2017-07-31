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
    return view('welcome');
});

Route::auth();

Route::get('/home/{vue?}', 'HomeController@index')->where('vue', '[\/\w\.-]*');
Route::post('/AddRoom', 'RoomsController@AddRoom');
Route::get('/MyRooms', 'RoomsController@MyRooms');
Route::get('/AllRooms', 'RoomsController@AllRooms');
Route::get('/DeleteRoom/{id}', 'RoomsController@DeleteRoom');
Route::get('/getRoomMessages/{id}', 'RoomsController@getRoomMessages');

Route::post('/AddMessage', 'MessagesController@AddMessage');
