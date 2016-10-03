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
Route::get('/', 'PagesController@index');
// Route::get('/filter/{komoditi?}/{kbli?}/{hs?}/{th?}/{cn?}', 'PagesController@filter');
Route::get('/filter', [
	'uses'=>'PagesController@filterKomoditi',
	'as'=>'filter.komoditi'
	]);
// Route::get('/filter/import/{kbli?}/{hs?}/{th?}/{cn?}', [
// 	'uses'=>'PagesController@filterImport',
// 	'as'=>'filter.import'
// 	]);

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

// resource export
Route::get('/exports', 'ExportsController@index');
Route::get('/exports/create', 'ExportsController@create');
Route::get('/exports/{id}/edit', 'ExportsController@edit');
Route::post('/exports', 'ExportsController@store');
Route::patch('/exports/{id}', 'ExportsController@update');
Route::delete('/exports/{id}', [
	'uses'=>'ExportsController@destroy',
	'as'=>'exports.destroy'
]);
Route::get('exports/import', 'ExportsController@getImport');
Route::post('exports/import', 'ExportsController@postImport');

// resource import
Route::get('/imports', 'ImportsController@index');
Route::get('/imports/create', 'ImportsController@create');
Route::get('/imports/{id}/edit', 'ImportsController@edit');
Route::post('/imports', 'ImportsController@store');
Route::patch('/imports/{id}', 'ImportsController@update');
Route::delete('/imports/{id}', [
	'uses'=>'ImportsController@destroy',
	'as'=>'imports.destroy'
]);
Route::get('imports/import', 'ImportsController@getImport');
Route::post('imports/import', 'ImportsController@postImport');

// pages controller
// Route::get('/?kbli={kbli}', [
// 	'uses'=>'PagesController@selectkbli',
// 	'as'=>'select_kbli'
// ]);
Route::auth();

Route::get('/home', 'HomeController@index');
