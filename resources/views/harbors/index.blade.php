@extends('app')

@section('content')
	<br>
	<a href="/harbors/create" class="btn btn-primary">Tambah Daftar Pelabuhan</a> | <a href="/harbors/import" class="btn btn-primary">Tambah Daftar Pelabuhan Dari File Excel</a>
	<br><br>
	<a href="/" class="btn btn-warning">Kembali Ke Menu Utama</a>
	<div class="panel panel-success">
		<h1 class="panel-heading">Daftar Pelabuhan</h1>
		<table class="table table-striped">
			<tr>
				<th class="col-md-1">No.</th>
				<th class="col-md-2">Kode Pelabuhan</th>
				<th class="col-md-2">Nama Pelabuhan</th>
				<th colspan="2" class="center">Action</th>
			</tr>
			<?php $i = 0; ?>
				@foreach($harbors as $harbor)
					<tr>
						<td>{{($harbors->currentpage()-1)*$harbors->perpage()+1 + $i}}</td>
						<td>{{ strtoupper($harbor->kode_pelabuhan) }}</td>
						<td>{{ strtoupper($harbor->nama_pelabuhan) }}</td>
						<td class="col-md-1" align="right">
							<a href="/harbors/{{$harbor->id}}/edit" class="btn btn-xs btn-info">Edit</a> 
						</td>
						<td class="col-md-1 delete" align="left">
							{!! Form::open(['method'=>'delete', 'route'=>['harbors.destroy', $harbor->id]]) !!}
							{!! Form::submit('Delete', ['class'=>'btn btn-xs btn-danger']) !!}
							{!!Form::close()!!}
						</td>
					</tr>
				<?php $i += 1 ?>
				@endforeach
		</table>

		<br>
		<div class="center">
			{{$harbors->links()}}
		</div>
	</div>
	<br>

@endsection

