<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ExportRequest;
use App\Export;
use App\Country;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ExportsController extends Controller
{
    public function index()
    {
        $exports = Export::orderBy('tahun');
        $exports = $exports->paginate();
        return view('exports.index', compact('exports'));
    }

    public function getImport(){
        return view('exports.import');
    }

    public function postImport(){
       $rules = ['file' => 'required'];
       $validator = Validator::make(Input::all(), $rules);
       // process the form
       if ($validator->fails()) 
       {
           return redirect('exports/import')->withErrors($validator);
       }else{
            try{
                Excel::load(Input::file('file'), function($reader){
                    $reader->each(function($sheet){
                       $countries = Country::all();
                        foreach ($sheet->toArray() as $row) {
                            foreach ($countries as $negara) {
                                if($sheet['kode_negara'] == $negara->kode_negara){
                                    $sheet['benua'] = $negara->benua_negara;    
                                    // dd($sheet['benua']);
                                    Export::firstOrCreate($sheet->toArray());
                                }
                                // Import::firstOrCreate($sheet->toArray());
                            }
                            // Export::firstOrCreate($sheet->toArray());
                        }
                    });
                });
                Session::flash('message', 'Data Export berhasil di input via file excel');
                return redirect('exports');
            }catch(\Exception $e){
                Session::flash('error', $e->getMessage());
                // Session::flash('error', 'Kolom kode_negara dan nama_negara tidak boleh kosong');
                return redirect('exports');
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
        return view('exports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExportRequest $request)
    {
        Export::create($request->all());
        Session::flash('message', 'Berhasil menambah data Export!');
        return redirect('exports');
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
        $export = Export::findOrFail($id);
        return view('exports.edit', compact('export'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExportRequest $request, $id)
    {
        $export = Export::findOrFail($id);
        $export->update($request->all());

        Session::flash('message', 'Data Export berhasil di rubah!');
        return redirect('exports');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $export = Export::findOrFail($id);
        $export->delete();

        Session::flash('message', 'Data Export berhasil di hapus!');
        return redirect('exports');
    }
}
