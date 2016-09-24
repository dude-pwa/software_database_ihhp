@extends('app')

@section('content')
	<div class="panel panel-success">
		<h1 class="panel-heading">Tambah Daftar KBLI</h1>
		<div class="panel-form panel-content">
			@include('errors.list')
			

			{!! Form::open(['url' => 'kblicodes']) !!}
				@include('kblicodes.form')
			{!! Form::close() !!}
		</div>
	</div>
@stop