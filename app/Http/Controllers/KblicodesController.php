<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\KblicodeRequest;
use App\Kblicode;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class KblicodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kblicodes = Kblicode::orderBy('kblicode');
        $kblicodes = $kblicodes->paginate(75);
        return view('kblicodes.index', compact('kblicodes'));
    }

    public function getImport(){
        return view('kblicodes.import');
    }

    public function postImport(){
       $rules = ['file' => 'required'];
       $validator = Validator::make(Input::all(), $rules);
       // process the form
       if ($validator->fails()) 
       {
           return redirect('kblicodes/import')->withErrors($validator);
       }else{
            try{
                Excel::load(Input::file('file'), function($reader){
                    $reader->each(function($sheet){
                        foreach ($sheet->toArray() as $row) {
                            Kblicode::firstOrCreate($sheet->toArray());
                        }
                    });
                });
                Session::flash('message', 'Data KBLI berhasil di input via file excel');
                return redirect('kblicodes');
            }catch(\Exception $e){
                // Session::flash('error', $e->getMessage() . 'Kolom kblicode dan hscode tidak boleh kosong');
                Session::flash('error', 'Kolom kblicode dan hscode tidak boleh kosong');
                return redirect('kblicodes');
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
        return view('kblicodes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KblicodeRequest $request)
    {
        Kblicode::create($request->all());
        Session::flash('message', 'Berhasil menambah data KBLI!');
        return redirect('kblicodes');
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
        $kblicode = Kblicode::findOrFail($id);
        return view('kblicodes.edit', compact('kblicode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KblicodeRequest $request, $id)
    {
        $kblicode = Kblicode::findOrFail($id);
        $kblicode->update($request->all());

        Session::flash('message', 'Data KBLI berhasil di rubah!');
        return redirect('kblicodes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kblicode = Kblicode::findOrFail($id);
        $kblicode->delete();

        Session::flash('message', 'Data KBLI berhasil di hapus!');
        return redirect('kblicodes');
    }
}
