<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Kblicode;
use App\Export;
use App\Import;
use App\Country;

class ChartsController extends Controller
{
    public function index(){
        $import_negara_afrika = Import::where('benua', 'Afrika')->groupBy('nama_negara')->orderBy('benua')->get();
        $export_negara_afrika = Export::where('benua', 'Afrika')->groupBy('nama_negara')->orderBy('benua')->get();
        $import_negara_amerika = Import::where('benua', 'Amerika')->groupBy('nama_negara')->orderBy('benua')->get();
        $export_negara_amerika = Export::where('benua', 'Amerika')->groupBy('nama_negara')->orderBy('benua')->get();
        $import_negara_asia = Import::where('benua', 'Asia')->groupBy('nama_negara')->orderBy('benua')->get();
        $export_negara_asia = Export::where('benua', 'Asia')->groupBy('nama_negara')->orderBy('benua')->get();
        $import_negara_australia = Import::where('benua', 'Australia')->groupBy('nama_negara')->orderBy('benua')->get();
        $export_negara_australia = Export::where('benua', 'Australia')->groupBy('nama_negara')->orderBy('benua')->get();
        $import_negara_eropa = Import::where('benua', 'Eropa')->groupBy('nama_negara')->orderBy('benua')->get();
        $export_negara_eropa = Export::where('benua', 'Eropa')->groupBy('nama_negara')->orderBy('benua')->get();

	    $negaraAfrika = [];
		foreach ($import_negara_afrika as $import_negara){
		  if(!in_array($import_negara->nama_negara, $negaraAfrika)){
		    $negaraAfrika[] = $import_negara->nama_negara;
		  }
		}
		foreach ($export_negara_afrika as $export_negara){
		  if(!in_array($export_negara->nama_negara, $negaraAfrika)){
		    $negaraAfrika[] = $export_negara->nama_negara;
		  }
		}
		sort($negaraAfrika);

		$negaraAmerika = [];
		foreach ($import_negara_amerika as $import_negara){
		  if(!in_array($import_negara->nama_negara, $negaraAmerika)){
		    $negaraAmerika[] = $import_negara->nama_negara;
		  }
		}
		foreach ($export_negara_amerika as $export_negara){
		  if(!in_array($export_negara->nama_negara, $negaraAmerika)){
		    $negaraAmerika[] = $export_negara->nama_negara;
		  }
		}
		sort($negaraAmerika);

		$negaraAsia = [];
		foreach ($import_negara_asia as $import_negara){
		  if(!in_array($import_negara->nama_negara, $negaraAsia)){
		    $negaraAsia[] = $import_negara->nama_negara;
		  }
		}
		foreach ($export_negara_asia as $export_negara){
		  if(!in_array($export_negara->nama_negara, $negaraAsia)){
		    $negaraAsia[] = $export_negara->nama_negara;
		  }
		}
		sort($negaraAsia);

		$negaraAustralia = [];
		foreach ($import_negara_australia as $import_negara){
		  if(!in_array($import_negara->nama_negara, $negaraAustralia)){
		    $negaraAustralia[] = $import_negara->nama_negara;
		  }
		}
		foreach ($export_negara_australia as $export_negara){
		  if(!in_array($export_negara->nama_negara, $negaraAustralia)){
		    $negaraAustralia[] = $export_negara->nama_negara;
		  }
		}
		sort($negaraAustralia);

		$negaraEropa = [];
		foreach ($import_negara_eropa as $import_negara){
		  if(!in_array($import_negara->nama_negara, $negaraEropa)){
		    $negaraEropa[] = $import_negara->nama_negara;
		  }
		}
		foreach ($export_negara_eropa as $export_negara){
		  if(!in_array($export_negara->nama_negara, $negaraEropa)){
		    $negaraEropa[] = $export_negara->nama_negara;
		  }
		}
		sort($negaraEropa);

        return view('charts.index', compact('negaraAfrika', 'negaraAmerika', 'negaraAsia', 'negaraAustralia', 'negaraEropa'));
    }

    public function show($country){
    	$import_negara_afrika = Import::where('benua', 'Afrika')->groupBy('nama_negara')->orderBy('benua')->get();
        $export_negara_afrika = Export::where('benua', 'Afrika')->groupBy('nama_negara')->orderBy('benua')->get();
        $import_negara_amerika = Import::where('benua', 'Amerika')->groupBy('nama_negara')->orderBy('benua')->get();
        $export_negara_amerika = Export::where('benua', 'Amerika')->groupBy('nama_negara')->orderBy('benua')->get();
        $import_negara_asia = Import::where('benua', 'Asia')->groupBy('nama_negara')->orderBy('benua')->get();
        $export_negara_asia = Export::where('benua', 'Asia')->groupBy('nama_negara')->orderBy('benua')->get();
        $import_negara_australia = Import::where('benua', 'Australia')->groupBy('nama_negara')->orderBy('benua')->get();
        $export_negara_australia = Export::where('benua', 'Australia')->groupBy('nama_negara')->orderBy('benua')->get();
        $import_negara_eropa = Import::where('benua', 'Eropa')->groupBy('nama_negara')->orderBy('benua')->get();
        $export_negara_eropa = Export::where('benua', 'Eropa')->groupBy('nama_negara')->orderBy('benua')->get();

	    $negaraAfrika = [];
		foreach ($import_negara_afrika as $import_negara){
		  if(!in_array($import_negara->nama_negara, $negaraAfrika)){
		    $negaraAfrika[] = $import_negara->nama_negara;
		  }
		}
		foreach ($export_negara_afrika as $export_negara){
		  if(!in_array($export_negara->nama_negara, $negaraAfrika)){
		    $negaraAfrika[] = $export_negara->nama_negara;
		  }
		}
		sort($negaraAfrika);

		$negaraAmerika = [];
		foreach ($import_negara_amerika as $import_negara){
		  if(!in_array($import_negara->nama_negara, $negaraAmerika)){
		    $negaraAmerika[] = $import_negara->nama_negara;
		  }
		}
		foreach ($export_negara_amerika as $export_negara){
		  if(!in_array($export_negara->nama_negara, $negaraAmerika)){
		    $negaraAmerika[] = $export_negara->nama_negara;
		  }
		}
		sort($negaraAmerika);

		$negaraAsia = [];
		foreach ($import_negara_asia as $import_negara){
		  if(!in_array($import_negara->nama_negara, $negaraAsia)){
		    $negaraAsia[] = $import_negara->nama_negara;
		  }
		}
		foreach ($export_negara_asia as $export_negara){
		  if(!in_array($export_negara->nama_negara, $negaraAsia)){
		    $negaraAsia[] = $export_negara->nama_negara;
		  }
		}
		sort($negaraAsia);

		$negaraAustralia = [];
		foreach ($import_negara_australia as $import_negara){
		  if(!in_array($import_negara->nama_negara, $negaraAustralia)){
		    $negaraAustralia[] = $import_negara->nama_negara;
		  }
		}
		foreach ($export_negara_australia as $export_negara){
		  if(!in_array($export_negara->nama_negara, $negaraAustralia)){
		    $negaraAustralia[] = $export_negara->nama_negara;
		  }
		}
		sort($negaraAustralia);

		$negaraEropa = [];
		foreach ($import_negara_eropa as $import_negara){
		  if(!in_array($import_negara->nama_negara, $negaraEropa)){
		    $negaraEropa[] = $import_negara->nama_negara;
		  }
		}
		foreach ($export_negara_eropa as $export_negara){
		  if(!in_array($export_negara->nama_negara, $negaraEropa)){
		    $negaraEropa[] = $export_negara->nama_negara;
		  }
		}
		sort($negaraEropa);


		$import_tahun_all = Import::where('nama_negara', $country)->groupBy('tahun')->orderBy('tahun')->get();
        $export_tahun_all = Export::where('nama_negara', $country)->groupBy('tahun')->orderBy('tahun')->get();

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

	    // dd($tahun_array);

		// $imports = Import::where('nama_negara', $country)->get()->toArray();
		
		$chartRowImport = [];
	    for($i=0; $i<count($tahun_array); $i++){
    		$imports = Import::where('nama_negara', $country)
    				->where('tahun', $tahun_array[$i])->get();
    		array_push(
    			$chartRowImport, 
    			[
    				$tahun_array[$i], 
    				$imports->sum('nilai'),
    				$imports->sum('berat_bersih'),
    			]
    		);
	    }

	    


	    $chartRowExport = [];
	    for($i=0; $i<count($tahun_array); $i++){
    		$exports = Export::where('nama_negara', $country)
    				->where('tahun', $tahun_array[$i])->get();
    		array_push(
    			$chartRowExport, 
    			[
    				$tahun_array[$i], 
    				$exports->sum('nilai'),
    				$exports->sum('berat_bersih'),
    			]
    		);
	    }

	    // dd($chartRowImport);


     //    $lavaExport = new Lavacharts();
     //    $chartExport = $lavaExport->DataTable();
     //    $chartExport->addStringColumn('Tahun')
     //    		->addNumberColumn('Value')
     //    		->addNumberColumn('Netto');
	    //         // ->addRow(['2011',  68, 65]);

	    // for($i=0; $i<count($chartRowExport); $i++){
	    // 	$chartExport->addRow($chartRowExport[$i]);
	    // }

	    // dd($chartImport);

	    // $lavaExport->ColumnChart('Value', $chartExport, [
	    // 	'title'=> 'Grafik Nilai dan Berat Komoditi Export'
	    // ]);

        return view('charts.show', compact('negaraAfrika', 'negaraAmerika', 'negaraAsia', 'negaraAustralia', 'negaraEropa', 'country', 'chartRowImport', 'chartRowExport'));
    }
}
