@extends('app')

@section('content')
	<br>
	<a href="/kblicodes/create" class="btn btn-primary">Tambah Daftar KBLI</a> | <a href="/kblicodes/import" class="btn btn-primary">Tambah Daftar Dari File Excel</a>
	<br><br>
	<a href="/" class="btn btn-warning">Kembali Ke Menu Utama</a>
	<div class="panel panel-success">
		<h1 class="panel-heading">Daftar KBLI</h1>
		<table class="table table-striped small">
			<tr>
				<th class="col-md-1">No.</th>
				<th class="col-md-2">Kode KBLI</th>
				<th class="col-md-2">Kode HS</th>
				<th colspan="2" class="center">Action</th>
			</tr>
			<?php $i = 0; ?>
				@foreach($kblicodes as $kblicode)
					<tr>
						<td>{{($kblicodes->currentpage()-1)*$kblicodes->perpage()+1 + $i}}</td>
						<td>{{ strtoupper($kblicode->kblicode) }}</td>
						<td>{{ strtoupper($kblicode->hscode) }}</td>

						@if (!Auth::guest())
						<td class="col-md-1" align="right">
							<a href="/kblicodes/{{$kblicode->id}}/edit" class="btn btn-xs btn-info">Edit</a> 
						</td>
						<td class="col-md-1 delete" align="left">
							{!! Form::open(['method'=>'delete', 'route'=>['kblicodes.destroy', $kblicode->id]]) !!}
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
			{{$kblicodes->links()}}
		</div>
	</div>
	<br>

@endsection

