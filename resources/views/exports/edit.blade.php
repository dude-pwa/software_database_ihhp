@extends('app')

@section('content')
	<div class="panel panel-success">
		<h1 class="panel-heading">Edit {{$export->nama_item}} ({{$export->hscode}})</h1>
		<div class="panel-form panel-content">
			@include('errors.list')
			

			{!! Form::model($export, ['method' => 'patch', 'action' => ['ExportsController@update', $export->id]]) !!}
					@include('exports.form', ['submitButton'=>'Simpan Perubahan'])
				{!! Form::close() !!}
		</div>
	</div>
@stop