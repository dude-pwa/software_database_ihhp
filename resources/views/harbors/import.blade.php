@extends('app')

@section('content')
	<div class="panel panel-success">
		<h1 class="panel-heading">Tambah Daftar Pelabuhan</h1>
		<div class="panel-form panel-content">
			{{-- {!! Form::open(['url' => 'kblicodes', 'files' => true]) !!}
				<div class="input-group">
					{!! Form::label('xls', 'Pilih File: ', ['class'=>'input-group-addon bold']) !!}
					{!! Form::file('xls', null, ['class' => 'form-control']) !!}
				</div> <br>
				{!! Form::submit('Import', ['class' => 'btn btn-primary']) !!}
			{!! Form::close() !!} --}}

			<form action="{{action('HarborsController@postImport')}}" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<label for="file">Pilih File: </label>
				<input type="file" name="file"><br><br>
				<button type="submit">Import</button>
			</form>
		</div>
	</div>
@endsection