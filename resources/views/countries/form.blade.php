<div class="input-group">
	{!! Form::label('kode_negara', 'Kode Negara: ', ['class'=>'input-group-addon bold']) !!}
	{!! Form::text('kode_negara', null, ['class' => 'form-control']) !!}
</div> <br>
<div class="input-group">
	{!! Form::label('nama_negara', 'Nama Negara: ', ['class'=>'input-group-addon bold']) !!}
	{!! Form::text('nama_negara', null, ['class' => 'form-control']) !!}
</div> <br>
<div class="input-group pull-right">
	<a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-default">Back</a> &nbsp;&nbsp;&nbsp;
	{!! Form::submit($submitButton, ['class' => 'btn btn-primary']) !!}
</div>