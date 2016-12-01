@extends('app')

@section('content')
	<br>
	<a href="/countries/create" class="btn btn-primary">Tambah Daftar Negara</a> | <a href="/countries/import" class="btn btn-primary">Tambah Daftar Negara Dari File Excel</a>
	<br><br>
	<a href="/" class="btn btn-warning">Kembali Ke Menu Utama</a>
	<div class="panel panel-success">
		<h1 class="panel-heading">Daftar Negara</h1>
		<table class="table table-striped small">
			<tr>
				<th class="col-md-1">No.</th>
				<th class="col-md-2">Kode Negara</th>
				<th class="col-md-2">Nama Negara</th>
				<th class="col-md-2">Benua</th>
				<th colspan="2" class="center">Action</th>
			</tr>
			<?php $i = 0; ?>
				@foreach($countries as $country)
					<tr>
						<td>{{($countries->currentpage()-1)*$countries->perpage()+1 + $i}}</td>
						<td>{{ strtoupper($country->kode_negara) }}</td>
						<td>{{ strtoupper($country->nama_negara) }}</td>
						<td>{{ strtoupper($country->benua_negara) }}</td>

						@if (!Auth::guest())
						<td class="col-md-1" align="right">
							<a href="/countries/{{$country->id}}/edit" class="btn btn-xs btn-info">Edit</a> 
						</td>
						<td class="col-md-1 delete" align="left">
							{!! Form::open(['method'=>'delete', 'route'=>['countries.destroy', $country->id]]) !!}
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
			{{$countries->links()}}
		</div>
	</div>
	<br>

@endsection

