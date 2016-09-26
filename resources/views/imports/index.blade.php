@extends('app')

@section('content')
	<br>
	<a href="/imports/create" class="btn btn-primary">Tambah Daftar Import</a> | <a href="/imports/import" class="btn btn-primary">Tambah Daftar Import Dari File Excel</a>
	<br><br>
	<a href="/" class="btn btn-warning">Kembali Ke Menu Utama</a>
	<div class="panel panel-success">
		<h1 class="panel-heading">Daftar Import</h1>
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
				@foreach($imports as $import)
					<tr>
						<td>{{($imports->currentpage()-1)*$imports->perpage()+1 + $i}}</td>
						<td>{{ strtoupper($import->tahun) }}</td>
						<td>{{ strtoupper($import->hscode) }}</td>
						<td>{{ strtoupper($import->nama_item) }}</td>
						<td>{{ strtoupper($import->kode_negara) }}</td>
						<td>{{ strtoupper($import->nama_negara) }}</td>
						<td>{{ strtoupper($import->kode_pelabuhan) }}</td>
						<td>{{ strtoupper($import->nama_pelabuhan) }}</td>
						<td>{{ strtoupper($import->berat_bersih) }}</td>
						<td>{{ strtoupper($import->nilai) }}</td>

						@if (!Auth::guest())
						<td class="col-md-1" align="right">
							<a href="/imports/{{$import->id}}/edit" class="btn btn-xs btn-info">Edit</a> 
						</td>
						<td class="col-md-1 delete" align="left">
							{!! Form::open(['method'=>'delete', 'route'=>['imports.destroy', $import->id]]) !!}
							{!! Form::submit('Delete', ['class'=>'btn btn-xs btn-danger']) !!}
							{!!Form::close()!!}
						</td>
						@endif
					</tr>
				<?php $i += 1 ?>
				@endforeach
		</table>

		<br>
		<div class="center">
			{{$imports->links()}}
		</div>
	</div>
	<br>

@endsection

