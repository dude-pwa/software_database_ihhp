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
            $getpelabuhan = $request->get('pelabuhan');
            $getbenua = $request->get('benua');
            $getprovinsi = $request->get('provinsi');
            
            if($getkbli!=null){
                $hscode = Kblicode::where('kblicode', $getkbli)->get();
            }

            // fungsi select import where multiple hscode
            $condition = array();
                foreach ($hscode as $hs) {
                    array_push($condition, $hs->hscode);
                }

            // fungsi filter
            if($gettahun != null && $getnegara != null && $getpelabuhan !=null){
                $imports = Import::whereIn('hscode', $condition)->whereIn('tahun', $gettahun)->whereIn('kode_negara', $getnegara)->whereIn('kode_pelabuhan', $getpelabuhan);
                $exports = Export::whereIn('hscode', $condition)->whereIn('tahun', $gettahun)->whereIn('kode_negara', $getnegara)->whereIn('kode_pelabuhan', $getpelabuhan);
            }elseif($gettahun != null && $getnegara == null && $getpelabuhan ==null){
                $imports = Import::whereIn('hscode', $condition)->whereIn('tahun', $gettahun);
                $exports = Export::whereIn('hscode', $condition)->whereIn('tahun', $gettahun);
            }elseif($gettahun == null && $getnegara != null && $getpelabuhan ==null){
                $imports = Import::whereIn('hscode', $condition)->whereIn('kode_negara', $getnegara);
                $exports = Export::whereIn('hscode', $condition)->whereIn('kode_negara', $getnegara);    
            }elseif($gettahun == null && $getnegara == null && $getpelabuhan !=null){
                $imports = Import::whereIn('hscode', $condition)->whereIn('kode_pelabuhan', $getpelabuhan);
                $exports = Export::whereIn('hscode', $condition)->whereIn('kode_pelabuhan', $getpelabuhan);
            }elseif($gettahun == null && $getnegara == null && $getpelabuhan ==null){
                $imports = Import::whereIn('hscode', $condition);
                $exports = Export::whereIn('hscode', $condition);    
            }elseif($gettahun != null && $getnegara != null && $getpelabuhan ==null){
                $imports = Import::whereIn('hscode', $condition)->whereIn('tahun', $gettahun)->whereIn('kode_negara', $getnegara);
                $exports = Export::whereIn('hscode', $condition)->whereIn('tahun', $gettahun)->whereIn('kode_negara', $getnegara);    
            }elseif($gettahun != null && $getnegara == null && $getpelabuhan !=null){
                $imports = Import::whereIn('hscode', $condition)->whereIn('tahun', $gettahun)->whereIn('kode_pelabuhan', $getpelabuhan);
                $exports = Export::whereIn('hscode', $condition)->whereIn('tahun', $gettahun)->whereIn('kode_pelabuhan', $getpelabuhan);    
            }elseif($gettahun == null && $getnegara != null && $getpelabuhan !=null){
                $imports = Import::whereIn('hscode', $condition)->whereIn('kode_negara', $getnegara)->whereIn('kode_pelabuhan', $getpelabuhan);
                $exports = Export::whereIn('hscode', $condition)->whereIn('kode_negara', $getnegara)->whereIn('kode_pelabuhan', $getpelabuhan);    
            }

            // fungsi select tahun negara, dan pelabuhan dari data Import
            $import_tahun_all = Import::whereIn('hscode', $condition)->groupBy('tahun')->get();
            $import_negara_all = Import::whereIn('hscode', $condition)->groupBy('nama_negara')->get();
            $import_pelabuhan_all = Import::whereIn('hscode', $condition)->groupBy('nama_pelabuhan')->get();
            $import_benua_all = Import::whereIn('hscode', $condition)->groupBy('benua')->get();
            $import_provinsi_all = Import::whereIn('hscode', $condition)->groupBy('provinsi')->get();

            // fungsi select tahun dan negara dari data export
            $export_tahun_all = Export::whereIn('hscode', $condition)->groupBy('tahun')->get();
            $export_negara_all = Export::whereIn('hscode', $condition)->groupBy('nama_negara')->get();
            $export_pelabuhan_all = Export::whereIn('hscode', $condition)->groupBy('nama_pelabuhan')->get();
            $export_benua_all = Export::whereIn('hscode', $condition)->groupBy('benua')->get();
            $export_provinsi_all = Export::whereIn('hscode', $condition)->groupBy('provinsi')->get();


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

            // negara array with key => value. 
              $negaraArray = [];
              foreach ($import_negara_all as $import_negara){
                  if(!array_key_exists($import_negara->nama_negara, $negaraArray)){
                      // $negaraArray = array_add($negaraArray, $import_negara->nama_negara, $import_negara->kode_negara);
                    $negaraArray[$import_negara->nama_negara] = $import_negara->kode_negara;
                  }
              }
              foreach ($export_negara_all as $export_negara){
                  if(!array_key_exists($export_negara->nama_negara, $negaraArray)){
                      // $negaraArray = array_add($negaraArray, $export_negara->nama_negara, $export_negara->kode_negara);
                    $negaraArray[$export_negara->nama_negara] = $export_negara->kode_negara;
                  }
              }
            ksort($negaraArray);

            // pelabuhanArray with key => value
            $pelabuhanArray = [];
            foreach ($import_pelabuhan_all as $import_pelabuhan){
                  if(!array_key_exists($import_pelabuhan->nama_pelabuhan, $pelabuhanArray)){
                    $pelabuhanArray[$import_pelabuhan->nama_pelabuhan] = $import_pelabuhan->kode_pelabuhan;
                  }
              }
              foreach ($export_pelabuhan_all as $export_pelabuhan){
                  if(!array_key_exists($export_pelabuhan->nama_pelabuhan, $pelabuhanArray)){
                    $pelabuhanArray[$export_pelabuhan->nama_pelabuhan] = $export_pelabuhan->kode_pelabuhan;
                  }
              }
              ksort($pelabuhanArray);

              // benuaArray with key => value
            $benuaArray = [];
                foreach ($import_benua_all as $import_benua){
                    if(!in_array($import_benua->benua, $benuaArray)){
                        array_push($benuaArray, $import_benua->benua);
                    }
                }
                foreach ($export_benua_all as $export_benua){
                    if(!in_array($export_benua->benua, $benuaArray)){
                        array_push($benuaArray, $export_benua->benua);
                    }
                }
              ksort($benuaArray);

            // benuaArray with key => value
            $provinsiArray = [];
                foreach ($import_provinsi_all as $imp_provinsi){
                    if(!in_array($imp_provinsi->provinsi, $provinsiArray)){
                        array_push($provinsiArray, $imp_provinsi->provinsi);
                    }
                }
                foreach ($export_provinsi_all as $export_provinsi){
                    if(!in_array($export_provinsi->provinsi, $provinsiArray)){
                        array_push($provinsiArray, $export_provinsi->provinsi);
                    }
                }
              ksort($provinsiArray);

            // paginate
            $imports = $imports->get();
            $exports = $exports->get();

            // fungsi sum berat bersih dan nilai
            $neto_import = $imports->sum('berat_bersih');
            $value_import = $imports->sum('nilai');
            $neto_export = $exports->sum('berat_bersih');
            $value_export = $exports->sum('nilai');

            // sort($condition);
            return view('pages.filter', compact('kblicodes', 'getkbli', 'imports', 'neto_import', 'value_import', 'import_tahun_all', 'import_negara_all', 'exports', 'export_tahun_all', 'export_negara_all', 'neto_export', 'value_export', 'tahun_array','negaraArray', 'pelabuhanArray', 'gettahun', 'getnegara','getpelabuhan', 'benuaArray', 'getbenua', 'provinsiArray', 'getprovinsi', 'code'));   
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
