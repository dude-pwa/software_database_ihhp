<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\HarborsRequest;
use App\Harbor;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class HarborsController extends Controller
{
    public function index()
    {
        $harbors = Harbor::orderBy('nama_pelabuhan');
        $harbors = $harbors->paginate();
        return view('harbors.index', compact('harbors'));
    }

    public function getImport(){
        return view('harbors.import');
    }

    public function postImport(){
       $rules = ['file' => 'required'];
       $validator = Validator::make(Input::all(), $rules);
       // process the form
       if ($validator->fails()) 
       {
           return redirect('harbors/import')->withErrors($validator);
       }else{
            try{
                Excel::load(Input::file('file'), function($reader){
                    $reader->each(function($sheet){
                        foreach ($sheet->toArray() as $row) {
                            Harbor::firstOrCreate($sheet->toArray());
                        }
                    });
                });
                Session::flash('message', 'Data Pelabuhan berhasil di input via file excel');
                return redirect('harbors');
            }catch(\Exception $e){
                Session::flash('error', $e->getMessage());
                // Session::flash('error', 'Kolom kode_negara dan nama_negara tidak boleh kosong');
                return redirect('harbors');
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
        return view('harbors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HarborsRequest $request)
    {
        Harbor::create($request->all());
        Session::flash('message', 'Berhasil menambah data Pelabuhan!');
        return redirect('harbors');
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
        $harbor = Harbor::findOrFail($id);
        return view('harbors.edit', compact('harbor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HarborsRequest $request, $id)
    {
        $harbor = Harbor::findOrFail($id);
        $harbor->update($request->all());

        Session::flash('message', 'Data Pelabuhan berhasil di rubah!');
        return redirect('harbors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $harbor = Harbor::findOrFail($id);
        $harbor->delete();

        Session::flash('message', 'Data Pelabuhan berhasil di hapus!');
        return redirect('harbors');
    }
}
