<div class="input-group">
	{!! Form::label('kblicode', 'Kode KBLI: ', ['class'=>'input-group-addon bold']) !!}
	{!! Form::text('kblicode', null, ['class' => 'form-control']) !!}
</div> <br>
<div class="input-group">
	{!! Form::label('hscode', 'Kode KBLI: ', ['class'=>'input-group-addon bold']) !!}
	{!! Form::text('hscode', null, ['class' => 'form-control']) !!}
</div> <br>
<div class="input-group pull-right">
	<a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-default">Back</a> &nbsp;&nbsp;&nbsp;
	{!! Form::submit($submitButton, ['class' => 'btn btn-primary']) !!}
</div>