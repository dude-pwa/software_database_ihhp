<div class="input-group">
	{!! Form::label('kbli', 'Kode KBLI: ', ['class'=>'input-group-addon bold']) !!}
	{!! Form::text('kbli', null, ['class' => 'form-control']) !!}
</div> <br>
<div class="input-group pull-right">
	<a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-default">Back</a> &nbsp;&nbsp;&nbsp;
	{!! Form::submit($submitButton, ['class' => 'btn btn-primary']) !!}
</div>