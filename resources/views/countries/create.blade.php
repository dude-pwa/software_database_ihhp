@extends('app')

@section('content')
	<div class="panel panel-success">
		<h1 class="panel-heading">Tambah Daftar Negara</h1>
		<div class="panel-form panel-content">
			@include('errors.list')
			

			{!! Form::open(['url' => 'countries']) !!}
				@include('countries.form', [$submitButton = 'Simpan'])
			{!! Form::close() !!}
		</div>
	</div>
@stop