<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ImportsRequest;
use App\Import;
use App\Country;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ImportsController extends Controller
{
    public function index()
    {
        $imports = Import::orderBy('tahun');
        $imports = $imports->paginate();
        return view('imports.index', compact('imports'));
    }

    public function getImport(){
        return view('imports.import');
    }

    public function postImport(){
       $rules = ['file' => 'required'];
       $validator = Validator::make(Input::all(), $rules);
       // process the form
       if ($validator->fails()) 
       {
           return redirect('imports/import')->withErrors($validator);
       }else{
            try{
                Excel::load(Input::file('file'), function($reader){
                    $reader->each(function($sheet){
                        // selek negara
                       $countries = Country::all();
                        foreach ($sheet->toArray() as $row) {
                            foreach ($countries as $negara) {
                                if($sheet['kode_negara'] == $negara->kode_negara){
                                    $sheet['benua'] = $negara->benua_negara;    
                                    // dd($sheet['benua']);
                                    Import::firstOrCreate($sheet->toArray());
                                }
                                // Import::firstOrCreate($sheet->toArray());
                            }
                        }
                    });
                });
                Session::flash('message', 'Data Import berhasil di input via file excel');
                return redirect('imports');
            }catch(\Exception $e){
                Session::flash('error', $e->getMessage());
                // Session::flash('error', 'Kolom kode_negara dan nama_negara tidak boleh kosong');
                return redirect('imports');
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
        return view('imports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImportsRequest $request)
    {
        Import::create($request->all());
        Session::flash('message', 'Berhasil menambah data Import!');
        return redirect('imports');
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
        $import = Import::findOrFail($id);
        return view('imports.edit', compact('import'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImportsRequest $request, $id)
    {
        $import = Import::findOrFail($id);
        $import->update($request->all());

        Session::flash('message', 'Data Import berhasil di rubah!');
        return redirect('imports');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $import = Import::findOrFail($id);
        $import->delete();

        Session::flash('message', 'Data Import berhasil di hapus!');
        return redirect('imports');
    }
}
