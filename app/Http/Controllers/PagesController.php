<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Kblicode;
use App\Export;
use App\Import;
use App\Country;

class PagesController extends Controller
{
    public function index($komoditi = null){
    		$kblicodes = Kblicode::groupBy('kblicode')->lists('kblicode', 'kblicode');

	    	return view('pages.index', compact('kblicodes'));	
    }
    public function filterKomoditi(Request $request){
    		$kblicodes = Kblicode::groupBy('kblicode')->lists('kblicode', 'kblicode');

            // mengambil parameter
            $getkbli = $request->get('kbli');
            $gettahun = $request->get('tahun');
            $getnegara = $request->get('negara');
            
            if($getkbli!=null){
                $hscode = Kblicode::where('kblicode', $getkbli)->get();
            }

            // fungsi select import where multiple hscode
            $condition = array();
                foreach ($hscode as $hs) {
                    array_push($condition, $hs->hscode);
                }

            // fungsi filter
            if($gettahun != null && $getnegara != null){
                $imports = Import::whereIn('hscode', $condition)->whereIn('tahun', $gettahun)->whereIn('kode_negara', $getnegara);
                $exports = Export::whereIn('hscode', $condition)->whereIn('tahun', $gettahun)->whereIn('kode_negara', $getnegara);
            }elseif($gettahun != null && $getnegara == null){
                $imports = Import::whereIn('hscode', $condition)->whereIn('tahun', $gettahun);
                $exports = Export::whereIn('hscode', $condition)->whereIn('tahun', $gettahun);
            }elseif($gettahun == null && $getnegara != null){
                $imports = Import::whereIn('hscode', $condition)->whereIn('kode_negara', $getnegara);
                $exports = Export::whereIn('hscode', $condition)->whereIn('kode_negara', $getnegara);    
            }elseif($gettahun == null && $getnegara == null){
                $imports = Import::whereIn('hscode', $condition);
                $exports = Export::whereIn('hscode', $condition);    
            }

            // fungsi select tahun dan negara dari data Import
            $import_tahun_all = Import::whereIn('hscode', $condition)->groupBy('tahun')->get();
            $import_negara_all = Import::whereIn('hscode', $condition)->groupBy('nama_negara')->get();

            // fungsi select tahun dan negara dari data export
            $export_tahun_all = Export::whereIn('hscode', $condition)->groupBy('tahun')->get();
            $export_negara_all = Export::whereIn('hscode', $condition)->groupBy('nama_negara')->get();

            //tahun array
            $tahun_array = array();            
                foreach ($import_tahun_all as $import_tahun){
                    if(!in_array($import_tahun->tahun, $tahun_array)){
                        array_push($tahun_array, $import_tahun->tahun);
                    }
                }
                foreach ($export_tahun_all as $export_tahun){
                    if(!in_array($export_tahun->tahun, $tahun_array)){
                        array_push($tahun_array, $export_tahun->tahun);
                    }
                }
            sort($tahun_array);

            // negara array with key => value. harus di tulis di view.
              $negaraArray = [];
              foreach ($import_negara_all as $import_negara){
                  if(!array_key_exists($import_negara->nama_negara, $negaraArray)){
                      $negaraArray = array_add($negaraArray, $import_negara->nama_negara, $import_negara->kode_negara);
                  }
              }
              foreach ($export_negara_all as $export_negara){
                  if(!array_key_exists($export_negara->nama_negara, $negaraArray)){
                      $negaraArray = array_add($negaraArray, $export_negara->nama_negara, $export_negara->kode_negara);
                  }
              }
            ksort($negaraArray);

            // paginate
            $imports = $imports->paginate();
            $exports = $exports->paginate();

            // fungsi sum berat bersih dan nilai
            $neto_import = $imports->sum('berat_bersih');
            $value_import = $imports->sum('nilai');
            $neto_export = $exports->sum('berat_bersih');
            $value_export = $exports->sum('nilai');

	    	return view('pages.filter', compact('kblicodes', 'getkbli', 'imports', 'neto_import', 'value_import', 'import_tahun_all', 'import_negara_all', 'exports', 'export_tahun_all', 'export_negara_all', 'neto_export', 'value_export', 'tahun_array', 'negaraArray'));	
    }
    public function filterImport($kbli=null, $hs=null, $th=null, $cn=null){
            $kblicodes = Kblicode::groupBy('kblicode')->lists('kblicode', 'kblicode');
            if($kbli!=null){
                $hscode = Kblicode::where('kblicode', $kbli);
                $hscode = $hscode->lists('hscode', 'hscode');    
            }
            
            if($hs != null){
                $import = Import::where('hscode', $hs);
                $tahun = $import->lists('tahun', 'tahun');
            }else{
                $tahun = Import::where('hscode', $hs);
            }

            if($hs != null){
                $negara = $import->lists('nama_negara', 'kode_negara');
            }else{
                $negara = Import::where('nama_negara', $cn);
            }

            if($kbli!=null && $hs!=null && $th!=null && $cn!=null){
                $imports = Import::orderBy('tahun', 'asc')
                    ->where(['kode_negara'=>$cn, 'tahun'=>$th, 'hscode'=>$hs]);
                $imports = $imports->paginate(20);
            }

            return view('pages.filter', compact('kblicodes', 'kbli', 'hscode', 'hs', 'tahun', 'th', 'negara', 'cn', 'imports'));    
    }
}
