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
Route::post('kblicodes/import', 'KblicodesController@postImport');

// resource country
Route::get('/countries', 'CountriesController@index');
Route::get('/countries/create', 'CountriesController@create');
Route::get('/countries/{id}/edit', 'CountriesController@edit');
Route::post('/countries', 'CountriesController@store');
Route::patch('/countries/{id}', 'CountriesController@update');
Route::delete('/countries/{id}', [
	'uses'=>'CountriesController@destroy',
	'as'=>'countries.destroy'
]);
Route::get('countries/import', 'CountriesController@getImport');
Route::post('countries/import', 'CountriesController@postImport');

//resource pelabuhan
Route::get('/harbors', 'HarborsController@index');
Route::get('/harbors/create', 'HarborsController@create');
Route::get('/harbors/{id}/edit', 'HarborsController@edit');
Route::post('/harbors', 'HarborsController@store');
Route::patch('/harbors/{id}', 'HarborsController@update');
Route::delete('/harbors/{id}', [
	'uses'=>'HarborsController@destroy',
	'as'=>'harbors.destroy'
]);
Route::get('harbors/import', 'HarborsController@getImport');
Route::post('harbors/import', 'HarborsController@postImport');