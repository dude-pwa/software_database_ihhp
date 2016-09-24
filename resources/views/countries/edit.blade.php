@extends('app')

@section('content')
	<div class="panel panel-success">
		<h1 class="panel-heading">Edit {{$country->nama_negara}}</h1>
		<div class="panel-form panel-content">
			@include('errors.list')
			

			{!! Form::model($country, ['method' => 'patch', 'action' => ['CountriesController@update', $country->id]]) !!}
					@include('countries.form', ['submitButton'=>'Simpan Perubahan'])
				{!! Form::close() !!}
		</div>
	</div>
@stop