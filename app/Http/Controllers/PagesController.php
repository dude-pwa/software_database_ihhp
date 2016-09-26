<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Kblicode;
use App\Export;
use App\Country;

class PagesController extends Controller
{
    public function index($komoditi = null){
    		$kblicodes = Kblicode::groupBy('kblicode')->lists('kblicode', 'kblicode');
	    	return view('pages.index', compact('kblicodes'));	
    }
    public function filter($komoditi=null, $kbli=null, $hs=null, $th=null, $cn=null){
            if($komoditi!=null){
        		$kblicodes = Kblicode::groupBy('kblicode')->lists('kblicode', 'kblicode');
            }
            if($kbli!=null){
                $hscode = Kblicode::where('kblicode', $kbli);
                $hscode = $hscode->lists('hscode', 'hscode');    
            }
            
            if($hs != null){
    			$export = Export::where('hscode', $hs);
    			$tahun = $export->lists('tahun', 'tahun');
    		}else{
                $tahun = Export::where('hscode', $hs);
            }

            if($hs != null){
                $negara = $export->lists('nama_negara', 'kode_negara');
            }else{
                $negara = Export::where('nama_negara', $cn);
            }

            if($komoditi!=null && $kbli!=null && $hs!=null && $th!=null && $cn!=null){
                $exports = Export::orderBy('tahun', 'asc')
                    ->where(['kode_negara'=>$cn]);
                $exports = $exports->paginate();
            }

	    	return view('pages.filter', compact('komoditi','kblicodes', 'kbli', 'hscode', 'hs', 'tahun', 'th', 'negara', 'cn', 'exports'));	
    }
}
