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
      <br><br>
      <a href="/" class="btn btn-warning">Kembali Ke Menu Utama</a>

        <div class="panel panel-success">
            <h1 class="panel-heading">Filter Data Komoditi Per HS</h1>
            <br>
                <?php 
                    $kbli_default = 'Pilih Kode KBLI'; 
                    if($getkbli != null){
                        $kbli_default = $getkbli;
                    }
                    if($gettahun != null){
                        $kbli_default = $getkbli;
                    }
                    // if($hs != null){
                    //     $hs_default = $hs;
                    // }if($th != null){
                    //     $th_default = $th;
                    // }if($cn != null){
                    //     $cn_name = \App\Country::where('kode_negara', $cn)->first();
                    //     $cn_default = $cn_name->nama_negara;
                    // }
                ?>
                &nbsp;&nbsp;&nbsp;&nbsp;
                {{-- {!! Form::select('pilih_data_komoditi', ['export' => 'Export', 'import' => 'Import'], null, 
                    [
                        'placeholder' => $komoditi_default,
                        'id'=>'pilih_data_komoditi',
                        'onchange'=>"window.open('http://localhost:8080/filter/'+this.options[ this.selectedIndex ].value, '_self')"
                    ]); !!} --}}
              <div class="panel-body" id="filter">
                <div class="col-md-1 col-md-offset-0">
                KBLI: 
                {!! Form::select('kblicode', $kblicodes, null, array('class'=>'', 
                    'placeholder'=>$kbli_default, 
                    'id'=>'kbli',
                    'onchange'=>"window.open('http://localhost:8080/filter?kbli='+this.options[ this.selectedIndex ].value, '_self')"
                    )) !!}
                </div>

                {!! Form::open(['method'=>'GET', 'route'=>'filter.komoditi']) !!}
                  {!!Form::hidden('kbli', $kbli_default)!!}
                  <div class="col-md-1 col-md-offset-0">
                    Tahun: <br>
                    @foreach ($tahun_array as $tahun) 
                      <input 
                        type="checkbox" 
                        name="tahun[]" 
                        value="{{$tahun}}"
                        @if($gettahun != null)
                          @foreach($gettahun as $tahun_param)
                            @if($tahun_param == $tahun)
                              checked="checked" 
                            @endif
                          @endforeach
                        @else
                        checked="" 
                        @endif
                      > {{$tahun}} <br> 
                    @endforeach
                  </div>

                  <div class="col-md-3 col-md-offset-0">
                    Negara: <br>
                    @foreach ($negaraArray as $key => $value)
                      <input 
                        type="checkbox" 
                        name="negara[]" 
                        value="{{$value}}"
                        @if($getnegara != null)
                          @foreach($getnegara as $negara_param)
                            @if($negara_param == $value)
                              checked="checked" 
                            @endif
                          @endforeach
                        @else
                        checked="" 
                        @endif
                      > {{$key}} <br> 
                    @endforeach
                  </div>

                  <div class="col-md-3 col-md-offset-0">
                    Pelabuhan: <br>
                    @foreach ($pelabuhanArray as $key => $value)
                      <input 
                        type="checkbox" 
                        name="pelabuhan[]" 
                        value="{{$value}}"
                        @if($getpelabuhan != null)
                          @foreach($getpelabuhan as $pelabuhan_param)
                            @if($pelabuhan_param == $value)
                              checked="checked" 
                            @endif
                          @endforeach
                        @else
                        checked="" 
                        @endif
                      > {{$key}} <br> 
                    @endforeach
                  </div>

                  <div class="col-md-3 col-md-offset-0">
                    Action: <br>
                    <a href="#" id="uncheck">Uncheck All</a> / 
                    <a href="#" id="check_all">Check All</a> <br><br>
                    {!!Form::submit('Filter', ['class'=>'btn btn-primary'])!!}
                  </div>
                {!!Form::close()!!}

              </div>

                <script type="text/javascript">
                // fungsi unchek all
                  $("#uncheck").click(function(){
                    $("#filter").find('input[type=checkbox]:checked').prop('checked', false);      
                  });

                // fungsi check all
                  $("#check_all").click(function(){
                    $("#filter").find('input[type=checkbox]').prop('checked', true);      
                  });
                </script>
                <br><br>
        </div>
    </div>

    {{-- total import end ekspor --}}
    <div class="row">
      <div class="panel panel-success">
        <div class="panel-heading"><h4>Total Import KBLI {{$getkbli}}</h4></div>
        <table class="table table-striped">
          <tr>
            <th>Total Berat Bersih (kg)</th>
            <th>Total Nilai (USD)</th>
          </tr>
          <tr>
            <td>{{$neto_import}}</td>
            <td>{{$value_import}}</td>
          </tr>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="panel panel-success">
        <div class="panel-heading"><h4>Total Export KBLI {{$getkbli}}</h4></div>
        <table class="table table-striped">
          <tr>
            <th>Total Berat Bersih (kg)</th>
            <th>Total Nilai (USD)</th>
          </tr>
          <tr>
            <td>{{$neto_export}}</td>
            <td>{{$value_export}}</td>
          </tr>
        </table>
      </div>
    </div>

    {{-- select * import --}}
    @if($getkbli!=null)
    <div class="row">
        <div class="panel panel-success">
            <h4 class="panel-heading">Daftar Komoditi Import</h4>
            <table class="table table-striped small">
                <tr>
                  <th class="col-md-1">No.</th>
                  <th class="col-md-2">Tahun</th>
                  <th class="col-md-2">Kode HS</th>
                  <th class="col-md-2">Nama Item</th>
                  <th class="col-md-2">Nama Negara</th>
                  <th class="col-md-2">Nama Pelabuhan</th>
                  <th class="col-md-2">Berat Bersih</th>
                  <th class="col-md-2">Nilai</th>
                  <th colspan="2" class="center">Action</th>
                </tr>
                <?php $i = 0; ?>
                @foreach($imports as $import)
                  <tr>
                    <td>{{($imports->currentpage()-1)*$imports->perpage()+1 + $i}}</td>
                    <td>{{ strtoupper($import->tahun) }}</td>
                    <td>{{ strtoupper($import->hscode) }}</td>
                    <td>{{ strtoupper($import->nama_item) }}</td>
                    <td>{{ strtoupper($import->nama_negara) }}</td>
                    <td>{{ strtoupper($import->nama_pelabuhan) }}</td>
                    <td>{{ strtoupper($import->berat_bersih) }}</td>
                    <td>{{ strtoupper($import->nilai) }}</td>

                    @if (!Auth::guest())
                      <td class="col-md-1" align="right">
                        <a href="/exports/{{$import->id}}/edit" class="btn btn-xs btn-info">Edit</a> 
                      </td>
                      <td class="col-md-1 delete" align="left">
                        {!! Form::open(['method'=>'delete', 'route'=>['exports.destroy', $import->id]]) !!}
                        {!! Form::submit('Delete', ['class'=>'btn btn-xs btn-danger']) !!}
                        {!!Form::close()!!}
                      </td>
                    @endif
                  </tr>
                  <?php $i += 1; ?>
                @endforeach
            </table>
            <br>
            <div class="center">
              {{$imports->links()}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-success">
            <h4 class="panel-heading">Daftar Komoditi Export</h4>
            <table class="table table-striped small">
                <tr>
                  <th class="col-md-1">No.</th>
                  <th class="col-md-2">Tahun</th>
                  <th class="col-md-2">Kode HS</th>
                  <th class="col-md-2">Nama Item</th>
                  <th class="col-md-2">Nama Negara</th>
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
                    <td>{{ strtoupper($export->nama_negara) }}</td>
                    <td>{{ strtoupper($export->nama_pelabuhan) }}</td>
                    <td>{{ strtoupper($export->berat_bersih) }}</td>
                    <td>{{ strtoupper($export->nilai) }}</td>

                    @if (!Auth::guest())
                      <td class="col-md-1" align="right">
                        <a href="/exports/{{$export->id}}/edit" class="btn btn-xs btn-info">Edit</a> 
                      </td>
                      <td class="col-md-1 delete" align="left">
                        {!! Form::open(['method'=>'delete', 'route'=>['exports.destroy', $export->id]]) !!}
                        {!! Form::submit('Delete', ['class'=>'btn btn-xs btn-danger']) !!}
                        {!!Form::close()!!}
                      </td>
                    @endif
                  </tr>
                  <?php $i += 1; ?>
                @endforeach
            </table>
            <br>
            <div class="center">
              {{$exports->links()}}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
