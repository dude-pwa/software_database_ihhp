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
                ?>
                &nbsp;&nbsp;&nbsp;&nbsp;
                {{-- {!! Form::select('pilih_data_komoditi', ['export' => 'Export', 'import' => 'Import'], null, 
                    [
                        'placeholder' => $komoditi_default,
                        'id'=>'pilih_data_komoditi',
                        'onchange'=>"window.open('http://localhost/filter/'+this.options[ this.selectedIndex ].value, '_self')"
                    ]); !!} --}}
              <div class="panel-body panel-filter" id="filter">
                <div class="col-md-12 col-md-offset-0">
                KBLI: 
                {!! Form::select('kblicode', $kblicodes, null, array('class'=>'', 
                    'placeholder'=>$kbli_default, 
                    'id'=>'kbli',
                    'onchange'=>"window.open('http://localhost/filter?kbli='+this.options[ this.selectedIndex ].value, '_self')"
                    )) !!}
                </div>

                <br><br>

                {!! Form::open(['method'=>'GET', 'route'=>'filter.komoditi']) !!}
                  {!!Form::hidden('kbli', $kbli_default)!!}
                  <div class="col-md-3 col-md-offset-0 btn-xs" id="tahun_checkbox" style="width: 180px;">
                    <b>Tahun: </b><br>
                    <a class="btn btn-xs" id="uncheck_tahun">Uncheck All</a> / 
                    <a class="btn btn-xs" id="check_tahun">Check All</a>
                    <br>
                    <div style="max-height: 400px; overflow: auto">
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
                        @endif
                      > {{$tahun}} <br> 
                    @endforeach
                    </div>
                  </div>

                  <div class="col-md-3 col-md-offset-0 btn-xs" id="benua_checkbox" style="max-height: 400px; width: 180px; overflow: auto">
                    <b>Benua:</b> <br> 
                    <a class="btn btn-xs" id="uncheck_benua">Uncheck All</a> / 
                    <a class="btn btn-xs" id="check_benua">Check All</a>
                    <br>
                    @foreach ($benuaArray as $benua) 
                      <input 
                        type="checkbox" 
                        name="benua[]" 
                        value="{{$benua}}"
                        id = "{{$benua}}Check"
                        @if($getbenua != null)
                          @foreach($getbenua as $benua_param)
                            @if($benua_param == $benua)
                              checked="checked" 
                            @endif
                          @endforeach
                        @endif
                      > {{$benua}} <br> 
                    @endforeach
                    <br>
                    <a href="#" class="btn btn-xs btn-success" id="filterNegara">Filter Negara</a>
                  </div>

                  <div class="col-md-3 col-md-offset-0 btn-xs" id="negara_checkbox" style="width: 210px;">
                    <b>Negara:</b> <br>
                    <a class="btn btn-xs" id="uncheck_negara">Uncheck All</a> / 
                    <a class="btn btn-xs" id="check_negara">Check All</a>
                    <br>
                    <div style="max-height: 400px; overflow: auto">
                      <div id="Negara">
                        @foreach ($negaraArray as $key => $value)
                          <input 
                            type="checkbox" 
                            name="negara[]" 
                            value="{{$value}}" 
                            display="{{$key}}"
                            @if($getnegara != null)
                              @foreach($getnegara as $negara_param)
                                @if($negara_param == $value)
                                  checked="checked" 
                                @endif
                              @endforeach
                            @endif
                          > {{$key}} <br> 
                        @endforeach
                        <!-- <input type="checkbox" name="negara[]" value=""> -->
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 col-md-offset-0 btn-xs" id="prov_checkbox" style="max-height: 400px; width: 210px; overflow: auto">
                    <b>Provinsi:</b> <br> 
                    <a class="btn btn-xs" id="uncheck_prov">Uncheck All</a> / 
                    <a class="btn btn-xs" id="check_prov">Check All</a>
                    <br>
                    @foreach ($provinsiArray as $provinsi) 
                      <input 
                        type="checkbox" 
                        name="provinsi[]" 
                        value="{{$provinsi}}"
                        @if($getprovinsi != null)
                          @foreach($getprovinsi as $provinsi_param)
                            @if($provinsi_param == $provinsi)
                              checked="checked" 
                            @endif
                          @endforeach
                        @endif
                      > {{$provinsi}} <br> 
                    @endforeach
                    <br>
                    <a href="#" class="btn btn-xs btn-success" id="filterProvinsi">Filter Provinsi</a>
                  </div>

                   <div class="col-md-3 col-md-offset-0 btn-xs" id="pelabuhan_checkbox" style="width:200px;">
                    <b>Pelabuhan:</b> <br>
                    <a class="btn btn-xs" id="uncheck_pelabuhan">Uncheck All</a> / 
                    <a class="btn btn-xs" id="check_pelabuhan">Check All</a>
                    <br>
                    <div style="height:400px; overflow: auto">
                      <div id="Pelabuhan">
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
                            @endif
                          > {{$key}} <br> 
                        @endforeach
                      </div>
                    </div>
                  </div>

                  <div class="col-md-1 col-md-offset-0">
                    <b>Action: </b><br><br>
                    {!!Form::submit('Filter', ['class'=>'btn btn-primary', 'id'=>'SubmitFilter'])!!}
                  </div>
                {!!Form::close()!!}

              </div>

                <script type="text/javascript">
                // validation tahun filter
                  $("#SubmitFilter").click(function(e){
                    if($("#tahun_checkbox").find('input[type=checkbox]:checked').length < 1){
                      e.preventDefault();
                      alert("Parameter Tahun Harus Dipilih");
                    }
                  });

                // fungsi unchek tahun
                  $("#uncheck_tahun").click(function(){
                    $("#tahun_checkbox").find('input[type=checkbox]:checked').prop('checked', false);      
                  });
                  // fungsi unchek benua
                  $("#uncheck_benua").click(function(){
                    $("#benua_checkbox").find('input[type=checkbox]:checked').prop('checked', false);      
                  });

                 // fungsi unchek all
                  $("#uncheck").click(function(){
                    $("#filter").find('input[type=checkbox]:checked').prop('checked', false);      
                  });

                // fungsi check tahun
                  $("#check_tahun").click(function(){
                    $("#tahun_checkbox").find('input[type=checkbox]').prop('checked', true);      
                  });
                  // fungsi check benua
                  $("#check_benua").click(function(){
                    $("#benua_checkbox").find('input[type=checkbox]').prop('checked', true);

                      // $("#AsiaCheck").change(function(){
                        // alert("Asia");
                        // if(this.checked){
                          // alert("http://localhost/filter?kbli="+{{$kbli_default}}+"&benua[]=Asia");
                      //   }
                      // });
                  });

                  // fungsi unchek negara
                  $("#uncheck_negara").click(function(){
                    $("#negara_checkbox").find('input[type=checkbox]:checked').prop('checked', false);      
                  });
                  // fungsi check negara
                  $("#check_negara").click(function(){
                    $("#negara_checkbox").find('input[type=checkbox]').prop('checked', true);      
                  });
                  // fungsi unchek pelabuhan
                  $("#uncheck_pelabuhan").click(function(){
                    $("#pelabuhan_checkbox").find('input[type=checkbox]:checked').prop('checked', false);      
                  });
                  // fungsi check pelabuhan
                  $("#check_pelabuhan").click(function(){
                    $("#pelabuhan_checkbox").find('input[type=checkbox]').prop('checked', true);      
                  });
                  // fungsi unchek provinsi
                  $("#uncheck_prov").click(function(){
                    $("#prov_checkbox").find('input[type=checkbox]:checked').prop('checked', false);      
                  });
                  // fungsi check provinsi
                  $("#check_prov").click(function(){
                    $("#prov_checkbox").find('input[type=checkbox]').prop('checked', true);      
                  });

                  // --------------------------------------------------------------------------------------

                  $("#filterNegara").click(function(e){
                    // alert("Asia");
                    var asia, eropa, afrika, amerika, australia; 
                    
                    if($("#AsiaCheck").is(":checked")){
                      asia = "Asia";
                    }else{
                       asia= "";
                    }
                    if($("#EropaCheck").is(":checked")){
                      eropa = "Eropa";
                    }else{
                       eropa= "";
                    }
                    if($("#AfrikaCheck").is(":checked")){
                      afrika = "Afrika";
                    }else{
                       afrika= "";
                    }
                    if($("#AmerikaCheck").is(":checked")){
                      amerika = "Amerika";
                    }else{
                       amerika= "";
                    }
                    if($("#AustraliaCheck").is(":checked")){
                      australia = "Australia";
                    }else{
                       australia= "";
                    }
                    

                    var benua = [asia,eropa,afrika,amerika,australia];
                    // console.log(benua);
                    
                    $.get('/ajax-negara?kbli='+{{$kbli_default}}+'&benua='+benua, function(data){
                      $('#Negara').empty();
                      $.each(data, function(index, negaraObj){
                        $('#Negara').append(
                          '<input type="checkbox" name="negara[]" value="'+negaraObj.id+'"> '+negaraObj.name+ '<br>'
                        );
                      });
                    });
                  });

                  $("#filterProvinsi").click(function(e){
                    var provinsi = new Array();
                    
                    $("input[name='provinsi[]']").each( function () {
                      if($(this).is(":checked")){
                        provinsi.push($(this).val());
                      }
                    });

                    // console.log(provinsi);

                    $.get('/ajax-provinsi?kbli='+{{$kbli_default}}+'&provinsi='+provinsi, function(data){
                      $('#Pelabuhan').empty();
                      $.each(data, function(index, pelabuhanObj){
                        $('#Pelabuhan').append(
                          '<input type="checkbox" name="pelabuhan[]" value="'+pelabuhanObj.id+'"> '+pelabuhanObj.name+ '<br>'
                        );
                      });
                    });
                  });
                </script>
        </div>
    </div>


    {{-- total import end ekspor --}}
    <div class="row">
      <div class="panel panel-success">
        <div class="panel-heading">
          {!! Form::open(['url' => '/filter/result/import']) !!}
          <h4>Total Import KBLI {{$getkbli}} &nbsp;&nbsp;&nbsp;{!! Form::submit('Download', ['class' => 'btn btn-default']) !!}</h4>
          </div>
        <table class="table table-striped">
          <tr>
            <th>Tahun</th>
            <th>Total Berat Bersih</th>
            <th>Total Nilai (USD)</th>
          </tr>
          @for($i=0; $i<count($gettahun); $i++)
            <?php 
              if($getnegara != null && $getpelabuhan != null){
                $importsByTahun = \App\Import::where('tahun', $gettahun[$i])->whereIn('hscode', $condition)->whereIn('kode_negara', $getnegara)->whereIn('kode_pelabuhan', $getpelabuhan)->get();
              }elseif($getnegara != null && $getpelabuhan ==null){
                $importsByTahun = \App\Import::where('tahun', $gettahun[$i])->whereIn('hscode', $condition)->whereIn('kode_negara', $getnegara)->get();
              }elseif($getnegara == null && $getpelabuhan !=null){
                $importsByTahun = \App\Import::where('tahun', $gettahun[$i])->whereIn('hscode', $condition)->whereIn('kode_pelabuhan', $getpelabuhan)->get();
              }
            ?>
          <tr>
              <td>{{$gettahun[$i]}}</td>
              <td>{{$importsByTahun->sum('berat_bersih')}}</td>
              <td>{{$importsByTahun->sum('nilai')}}</td>
              <!-- <td>{{$neto_import}}</td> -->
              <!-- <td>{{$value_import}}</td> -->
          </tr>
            <!-- SEND TO @importResult, Controller -->
            {!! Form::hidden('tahun[]', $gettahun[$i]) !!} 
            {!! Form::hidden('total_netto[]', $importsByTahun->sum('berat_bersih')) !!} 
            {!! Form::hidden('total_value[]', $importsByTahun->sum('nilai')) !!} 
            <!-- <br> -->
          @endfor
        </table>
          {!! Form::close() !!}
      </div>
    </div>

    <div class="row">
      <div class="panel panel-success">
        <div class="panel-heading">
          {!! Form::open(['url' => '/filter/result/export']) !!}
          <h4>Total Export KBLI {{$getkbli}} &nbsp;&nbsp;&nbsp;{!! Form::submit('Download', ['class' => 'btn btn-default']) !!}</h4>
          </div>
        <table class="table table-striped">
          <tr>
            <th>Tahun</th>
            <th>Total Berat Bersih</th>
            <th>Total Nilai (USD)</th>
          </tr>
          @for($i=0; $i<count($gettahun); $i++)
            <?php 
              if($getnegara != null && $getpelabuhan != null){
                $exportsByTahun = \App\Export::where('tahun', $gettahun[$i])->whereIn('hscode', $condition)->whereIn('kode_negara', $getnegara)->whereIn('kode_pelabuhan', $getpelabuhan)->get();
              }elseif($getnegara != null && $getpelabuhan ==null){
                $exportsByTahun = \App\Export::where('tahun', $gettahun[$i])->whereIn('hscode', $condition)->whereIn('kode_negara', $getnegara)->get();
              }elseif($getnegara == null && $getpelabuhan !=null){
                $exportsByTahun = \App\Export::where('tahun', $gettahun[$i])->whereIn('hscode', $condition)->whereIn('kode_pelabuhan', $getpelabuhan)->get();
              }
            ?>
          <tr>
              <td>{{$gettahun[$i]}}</td>
              <td>{{$exportsByTahun->sum('berat_bersih')}}</td>
              <td>{{$exportsByTahun->sum('nilai')}}</td>
              <!-- <td>{{$neto_import}}</td> -->
              <!-- <td>{{$value_import}}</td> -->
          </tr>
           <!-- SEND TO @importResult, Controller -->
            {!! Form::hidden('tahun[]', $gettahun[$i]) !!} 
            {!! Form::hidden('total_netto[]', $exportsByTahun->sum('berat_bersih')) !!} 
            {!! Form::hidden('total_value[]', $exportsByTahun->sum('nilai')) !!} 
            <!-- <br> -->
          @endfor
        </table>
          {!! Form::close() !!}
      </div>
    </div>

    <script>
      $("#ImportResultButton").click(function(){
        $.ajax("/filter/result/import", {
          type: 'POST',
          data: {result: <?php $importResultArray ?>}
        });
      });
    </script>

    {{-- select * import filter --}}
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
                    {{-- <td>{{($imports->currentpage()-1)*$imports->perpage()+1 + $i}}</td> --}}
                    <td>{{$i+1}}</td>
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
              {{-- {{$imports->links()}} --}}
            </div>
        </div>
    </div>

  {{-- select * export filter --}}
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
                    {{-- <td>{{($exports->currentpage()-1)*$exports->perpage()+1 + $i}}</td> --}}
                    <td>{{$i+1}}</td>
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
              {{-- {{$exports->links()}} --}}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
