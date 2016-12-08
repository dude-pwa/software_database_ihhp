<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CountriesRequest;
use App\Country;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use DB;

class CountriesController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('nama_negara');
        $countries = $countries->paginate();
        return view('countries.index', compact('countries'));
    }

    public function getImport(){
        return view('countries.import');
    }

    public function postImport(){
       $rules = ['file' => 'required'];
       $validator = Validator::make(Input::all(), $rules);


       // process the form
       if ($validator->fails()) 
       {
           return redirect('countries/import')->withErrors($validator);
       }else{
            try{
                // 1st WAY -> BUG FIXED
                // NOTE:
                // 1. if new column was added, please make sure make it fillable in the model
                Excel::load(Input::file('file'), function($reader){
                    $reader->each(function($sheet){
                        foreach ($sheet->toArray() as $row) {
                            Country::firstOrCreate($sheet->toArray());
                        }
                    });
                });

                // // 2nd WAY
                // $path = Input::file('file')->getRealPath();
                // $data = Excel::load($path, function($reader) {
                // })->get();
                // if(!empty($data) && $data->count()){
                //     foreach ($data as $key => $value) {
                //         $insert[] = ['kode_negara' => $value->title, 'nama_negara' => $value->description];
                //     }
                //     if(!empty($insert)){
                //         DB::table('countries')->insert($insert);
                //         dd('Insert Record successfully.');
                //     }
                // }

                Session::flash('message', 'Data Negara berhasil di input via file excel');
                return redirect('countries');
            }catch(\Exception $e){
                Session::flash('error', $e->getMessage());
                // Session::flash('error', 'Kolom kode_negara dan nama_negara tidak boleh kosong');
                return redirect('countries');
            }
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountriesRequest $request)
    {
        Country::create($request->all());
        Session::flash('message', 'Berhasil menambah data Negara!');
        return redirect('countries');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountriesRequest $request, $id)
    {
        $country = Country::findOrFail($id);
        $country->update($request->all());

        Session::flash('message', 'Data Negara berhasil di rubah!');
        return redirect('countries');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        Session::flash('message', 'Data Negara berhasil di hapus!');
        return redirect('countries');
    }
}
