@extends('app')

@section('content')
	<br>
	<a href="/" class="btn btn-warning">Kembali Ke Menu Utama</a>

	<div class="panel panel-default">
		<div class="panel-success">
			<h1 class="panel-heading">Daftar Negara</h1>
		</div>

		<div class="panel panel-body">
			<div class="col-md-2 col-md-offset-0 btn-xs">
				<h4><center>Afrika</center></h4>
				<div style="max-height: 230px; width: 180px; overflow: auto; padding-left: 50px; border-width: 2px; border-right-style: dotted;">
					@foreach ($negaraAfrika as $negara) 
					  	<a href="/charts/{{$negara}}">{{$negara}}</a>
					  	<br>
					@endforeach
				</div>
			</div>

			<div class="col-md-3 col-md-offset-0 btn-xs">
				<h4><center>Amerika</center></h4>
				<div style="max-height: 230px; width: 230px; overflow: auto; padding-left: 60px; border-width: 2px; border-right-style: dotted;">
					@foreach ($negaraAmerika as $negara) 
					  	<a href="/charts/{{$negara}}">{{$negara}}</a>
					  	<br>
					@endforeach
				</div>
			</div>

			<div class="col-md-3 col-md-offset-0 btn-xs">
				<h4><center>Asia</center></h4>
				<div style="max-height: 230px; width: 230px; overflow: auto; padding-left: 60px; border-width: 2px; border-right-style: dotted;">
					@foreach ($negaraAsia as $negara) 
					  	<a href="/charts/{{$negara}}">{{$negara}}</a>
					  	<br>
					@endforeach
				</div>
			</div>

			<div class="col-md-2 col-md-offset-0 btn-xs">
				<h4><center>Australia</center></h4>
				<div style="max-height: 230px; width: 180px; overflow: auto; padding-left: 50px; border-width: 2px; border-right-style: dotted;">
					@foreach ($negaraAustralia as $negara) 
					  	<a href="/charts/{{$negara}}">{{$negara}}</a>
					  	<br>
					@endforeach
				</div>
			</div>

			<div class="col-md-2 col-md-offset-0 btn-xs">
				<h4><center>Eropa</center></h4>
				<div style="max-height: 230px; width: 180px; overflow: auto; padding-left: 20px; border-width: 2px; border-right-style: dotted;">
					@foreach ($negaraEropa as $negara) 
					  	<a href="/charts/{{$negara}}">{{$negara}}</a>
					  	<br>
					@endforeach
				</div>
			</div>
				
			<br>
			<br>
		</div>
	</div>

	<div class="panel panel-default">
		<h1 class="panel-heading">{{$country}}</h1>
		<div class="panel panel-body">
			<!-- <p><center>
				<button type="button" id="btnImport">Tampilkan Grafik Import</button> | 
				<button type="button" id="btnExport">Tampilkan Grafik Export</button>
			</center></p> -->
			<center><div id="chart_import" style="width: 900px; height: 300px"></div></center>
			<!-- <?#= $lavaImport->render('ColumnChart', 'Value', 'chart_import') ?> -->

			<br><br>

			<center><div id="chart_export" style="width: 900px; height: 300px"></div></center>
			
			<!-- <?#= $lavaExport->render('ColumnChart', 'Value', 'chart_export') ?> -->
		</div>
	</div>

	<script>
		// $("#btnImport").click(function(){
		//     $("#chart_import").show();
		//     $("#chart_export").hide();
		// });
		// $("#btnExport").click(function(){
		//     $("#chart_import").hide();
		//     $("#chart_export").show();
		// });
	</script>

	<script>
		google.charts.load('current', {packages: ['corechart', 'bar']});
		google.charts.setOnLoadCallback(drawImport);
		google.charts.setOnLoadCallback(drawExport);

		function drawImport(){
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Tahun');
			data.addColumn('number', 'Value');
			data.addColumn('number', 'Netto');

			var RowImport = new Array();
			RowImport = {!!json_encode($chartRowImport)!!};

			// console.log(RowImport);

			for (var i=0; i<RowImport.length; i++) {
				data.addRows([
					RowImport[i]
				]);
			}

			var options = {
				title: 'Grafik Nilai dan Berat Komoditi Import'
			};

			var chart = new google.visualization.ColumnChart(
		        document.getElementById('chart_import'));

	        chart.draw(data, options);
		}

		function drawExport(){
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Tahun');
			data.addColumn('number', 'Value');
			data.addColumn('number', 'Netto');

			var RowExport = new Array();
			RowExport = {!!json_encode($chartRowExport)!!};


			for (var i=0; i<RowExport.length; i++) {
				data.addRows([
					RowExport[i]
				]);
			}

			var options = {
				title: 'Grafik Nilai dan Berat Komoditi Export'
			};

			var chart = new google.visualization.ColumnChart(
		        document.getElementById('chart_export'));

	        chart.draw(data, options);
		}
	</script>

@endsection
