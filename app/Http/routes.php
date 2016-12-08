<?php

// use App\Http\Requests;
// use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Export;
use App\Import;
use App\Kblicode;

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

// fungsi FILTER NEGARA
Route::get('/ajax-negara', function(Request $request){
	// $benua = $request->get('benua');
	$getkbli = $request->get('kbli');

	$benua = explode(',', $request->get('benua'));
	// dd($benua);


	if($getkbli!=null){
        $hscode = Kblicode::where('kblicode', $getkbli)->get();
    }

    $condition = array();
    foreach ($hscode as $hs) {
        array_push($condition, $hs->hscode);
    }

	$import_negara_all = Import::whereIn('hscode', $condition)
		->whereIn('benua', $benua)
		->groupBy('nama_negara')->get();

		// dd($import_negara_all);

    $export_negara_all = Export::whereIn('hscode', $condition)
	    ->whereIn('benua', $benua)
	    ->groupBy('nama_negara')->get();


	$negaraGroup = [];
	foreach ($import_negara_all as $import_negara){
	  if(!in_array($import_negara->nama_negara, $negaraGroup)){
	    $negaraGroup[] = ['id'=>$import_negara->kode_negara, 'name'=>$import_negara->nama_negara];
	  }
	}
	foreach ($export_negara_all as $export_negara){
	  if(!in_array($export_negara->nama_negara, $negaraGroup)){
	    $negaraGroup[] = ['id'=>$export_negara->kode_negara, 'name'=>$export_negara->nama_negara];
	  }
	}
	ksort($negaraGroup);

	return Response::json($negaraGroup);
});

Route::get('/ajax-provinsi', function(Request $request){
	// $provinsi = $request->get('provinsi');
	$getkbli = $request->get('kbli');

	$provinsi = explode(',', $request->get('provinsi'));
	// var_dump($provinsi);


	if($getkbli!=null){
        $hscode = Kblicode::where('kblicode', $getkbli)->get();
    }

    $condition = array();
    foreach ($hscode as $hs) {
        array_push($condition, $hs->hscode);
    }

	$import_pelabuhan_all = Import::whereIn('hscode', $condition)
		->whereIn('provinsi', $provinsi)
		->groupBy('nama_pelabuhan')->get();

		// dd($import_pelabuhan_all);

    $export_pelabuhan_all = Export::whereIn('hscode', $condition)
	    ->whereIn('provinsi', $provinsi)
	    ->groupBy('nama_pelabuhan')->get();


	// dd(count($import_pelabuhan_all->toArray()));

	$pelabuhanGroup = [];
	foreach ($import_pelabuhan_all as $import_pelabuhan){
	  if(!in_array($import_pelabuhan->nama_pelabuhan, $pelabuhanGroup)){
	    $pelabuhanGroup[] = ['id'=>$import_pelabuhan->kode_pelabuhan, 'name'=>$import_pelabuhan->nama_pelabuhan];
	  }
	}
	foreach ($export_pelabuhan_all as $export_pelabuhan){
	  if(!in_array($export_pelabuhan->nama_pelabuhan, $pelabuhanGroup)){
	    $pelabuhanGroup[] = ['id'=>$export_pelabuhan->kode_pelabuhan, 'name'=>$export_pelabuhan->nama_pelabuhan];
	  }
	}
	ksort($pelabuhanGroup);

	return Response::json($pelabuhanGroup);
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
