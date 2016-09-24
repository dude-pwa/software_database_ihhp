@extends('app')

@section('content')
	<div class="panel panel-success">
		<h1 class="panel-heading">Edit {{$import->nama_item}} ({{$import->hscode}})</h1>
		<div class="panel-form panel-content">
			@include('errors.list')
			

			{!! Form::model($import, ['method' => 'patch', 'action' => ['ImportsController@update', $import->id]]) !!}
					@include('imports.form', ['submitButton'=>'Simpan Perubahan'])
				{!! Form::close() !!}
		</div>
	</div>
@stop