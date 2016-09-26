@extends('app')

@section('content')
{{-- <style>
    body{
        background: url('/src/images/bg.jpg') no-repeat;
        background-size: cover;
    }
</style> --}}
<div class="container">
    <div class="row">
        <div class="panel panel-success">
            <h1 class="panel-heading">Filter Data Komoditi Per HS</h1>
            <br>
                <?php 
                    $komoditi_default = 'Pilih Data Komoditi';
                    $kbli_default = 'Pilih Kode KBLI'; 
                    $hs_default = 'Pilih Kode HS'; 
                    $th_default = 'Pilih Tahun'; 
                    $cn_default = 'Pilih Negara';
                    if($komoditi != null){
                        $komoditi_default = $komoditi;
                    }if($kbli != null){
                        $kbli_default = $kbli;
                    }if($hs != null){
                        $hs_default = $hs;
                    }if($th != null){
                        $th_default = $th;
                    }if($cn != null){
                        $cn_name = \App\Country::where('kode_negara', $cn)->first();
                        $cn_default = $cn_name->nama_negara;
                    }
                ?>
                &nbsp;&nbsp;&nbsp;&nbsp;
                {!! Form::select('pilih_data_komoditi', ['export' => 'Export', 'import' => 'Import'], null, 
                    [
                        'placeholder' => $komoditi_default,
                        'id'=>'pilih_data_komoditi',
                        'onchange'=>"window.open('http://localhost:8080/filter/'+this.options[ this.selectedIndex ].value, '_self')"
                    ]); !!}

                {!! Form::select('kblicode', $kblicodes, null, array('class'=>'', 
                    'placeholder'=>$kbli_default, 
                    'id'=>'kbli',
                    'onchange'=>"window.open('http://localhost:8080/filter/$komoditi/'+this.options[ this.selectedIndex ].value, '_self')"
                    )) !!}

                @if($kbli != null)
                {!! Form::select('hscode', $hscode, null, array(
                    'class'=>'', 
                    'placeholder'=>$hs_default, 
                    'id'=>'hs',
                    'onchange'=>"window.open('http://localhost:8080/filter/$komoditi/$kbli/'+this.options[ this.selectedIndex ].value, '_self')"
                    )) !!}
                @endif

                @if($hs != null)
                {!! Form::select('tahun', $tahun, null, array(
                    'class'=>'', 
                    'placeholder'=>$th_default, 
                    'id'=>'tahun',
                    'onchange'=>"window.open('http://localhost:8080/filter/$komoditi/$kbli/$hs/'+this.options[ this.selectedIndex ].value, '_self')"
                    )) !!}
                @endif

                @if($th != null)
                {!! Form::select('negara', $negara, null, array(
                    'class'=>'', 
                    'placeholder'=>$cn_default, 
                    'id'=>'negara',
                    'onchange'=>"window.open('http://localhost:8080/filter/$komoditi/$kbli/$hs/$th/'+this.options[ this.selectedIndex ].value, '_self')"
                    )) !!}
                @endif

                <script type="text/javascript">
                 // var urlmenu = document.getElementById( 'kbli' );
                 // urlmenu.onchange = function() {
                 //   window.location.replace('http://localhost:8080/filter/'+this.options[ this.selectedIndex ].value, '_self');
                 // };

                 // var urlhs = document.getElementById( 'hs' );
                 // urlhs.onchange = function() {
                 {{-- // window.location.replace('http://localhost:8080/filter/'+{{$kbli}}+'/'+this.options[ this.selectedIndex ].value, '_self'); --}}
                 // };

                 // var urlth = document.getElementById( 'tahun' );
                 // urlth.onchange = function() {
                 {{-- // window.location.replace('http://localhost:8080/filter/'+{{$kbli}}+'/'+{{$hs}}+'/'+this.options[ this.selectedIndex ].value, '_self'); --}}
                 // };

                </script>
                <br><br>
        </div>
    </div>
    @if($komoditi!=null && $kbli!=null && $hs!=null && $th!=null && $cn!=null)
    <div class="row">
        <div class="panel panel-success">
            <h1 class="panel-heading">Daftar Komoditi {{ucfirst($komoditi)}}</h1>
            <table class="table table-striped small">
                <tr>
                  <th class="col-md-1">No.</th>
                  <th class="col-md-2">Tahun</th>
                  <th class="col-md-2">Kode HS</th>
                  <th class="col-md-2">Nama Item</th>
                  <th class="col-md-2">Kode Negara</th>
                  <th class="col-md-2">Nama Negara</th>
                  <th class="col-md-2">Kode Pelabuhan</th>
                  <th class="col-md-2">Nama Pelabuhan</th>
                  <th class="col-md-2">Berat Bersih</th>
                  <th class="col-md-2">Nilai</th>
                  <th colspan="2" class="center">Action</th>
                </tr>
                <?php $i = 0; ?>
                @foreach($exports as $export)
                  <tr>
                    <td>{{($exports->currentpage()-1)*$exports->perpage()+1 + $i}}</td>
                    <td>{{ strtoupper($export->tahun) }}</td>
                    <td>{{ strtoupper($export->hscode) }}</td>
                    <td>{{ strtoupper($export->nama_item) }}</td>
                    <td>{{ strtoupper($export->kode_negara) }}</td>
                    <td>{{ strtoupper($export->nama_negara) }}</td>
                    <td>{{ strtoupper($export->kode_pelabuhan) }}</td>
                    <td>{{ strtoupper($export->nama_pelabuhan) }}</td>
                    <td>{{ strtoupper($export->berat_bersih) }}</td>
                    <td>{{ strtoupper($export->nilai) }}</td>
                    <td class="col-md-1" align="right">
                      <a href="/exports/{{$export->id}}/edit" class="btn btn-xs btn-info">Edit</a> 
                    </td>
                    <td class="col-md-1 delete" align="left">
                      {!! Form::open(['method'=>'delete', 'route'=>['exports.destroy', $export->id]]) !!}
                      {!! Form::submit('Delete', ['class'=>'btn btn-xs btn-danger']) !!}
                      {!!Form::close()!!}
                    </td>
                  </tr>
                  <?php $i += 1; ?>
                @endforeach
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
