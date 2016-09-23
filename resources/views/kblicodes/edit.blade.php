@extends('app')

@section('content')
	<div class="panel panel-success">
		<h1 class="panel-heading">Edit {{$kblicode->kbli}}</h1>
		<div class="panel-form panel-content">
			@include('errors.list')
			

			{!! Form::model($kblicode, ['method' => 'patch', 'action' => ['KblicodesController@update', $kblicode->id]]) !!}
					@include('kblicodes.form', ['submitButton'=>'Simpan Perubahan'])
				{!! Form::close() !!}
		</div>
	</div>
@stop