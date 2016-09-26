@extends('app')

@section('content')
	<br>
	<a href="/exports/create" class="btn btn-primary">Tambah Daftar Export</a> | <a href="/exports/import" class="btn btn-primary">Tambah Daftar Export Dari File Excel</a>
	<br><br>
	<a href="/" class="btn btn-warning">Kembali Ke Menu Utama</a>
	<div class="panel panel-success">
		<h1 class="panel-heading">Daftar Export</h1>
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
				<?php $i += 1 ?>
				@endforeach
		</table>

		<br>
		<div class="center">
			{{$exports->links()}}
		</div>
	</div>
	<br>

@endsection

