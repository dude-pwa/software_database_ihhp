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

Route::get('/kblicodes', 'KblicodesController@index');
Route::get('/kblicodes/create', 'KblicodesController@create');
Route::get('/kblicodes/{id}/edit', 'KblicodesController@edit');
Route::post('/kblicodes', 'KblicodesController@store');
Route::patch('/kblicodes/{id}', 'KblicodesController@update');
Route::delete('/kblicodes/{id}', [
	'uses'=>'KblicodesController@destroy',
	'as'=>'kblicodes.destroy'
]);
Route::get('kblicodes/import', 'KblicodesController@getImport');
Route::post('kblicodes', 'KblicodesController@postImport');