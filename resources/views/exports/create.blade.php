@extends('app')

@section('content')
	<div class="panel panel-success">
		<h1 class="panel-heading">Tambah Daftar Export</h1>
		<div class="panel-form panel-content">
			@include('errors.list')
			

			{!! Form::open(['url' => 'exports']) !!}
				@include('exports.form', [$submitButton = 'Simpan'])
			{!! Form::close() !!}
		</div>
	</div>
@stop