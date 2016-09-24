<div class="input-group">
	{!! Form::label('tahun', 'Tahun: ', ['class'=>'input-group-addon bold']) !!}
	{!! Form::text('tahun', null, ['class' => 'form-control']) !!}
</div> <br>
<div class="input-group">
	{!! Form::label('hscode', 'Kode HS: ', ['class'=>'input-group-addon bold']) !!}
	{!! Form::text('hscode', null, ['class' => 'form-control']) !!}
</div> <br>
<div class="input-group">
	{!! Form::label('nama_item', 'Nama Item: ', ['class'=>'input-group-addon bold']) !!}
	{!! Form::text('nama_item', null, ['class' => 'form-control']) !!}
</div> <br>
<div class="input-group">
	{!! Form::label('kode_negara', 'Kode Negara: ', ['class'=>'input-group-addon bold']) !!}
	{!! Form::text('kode_negara', null, ['class' => 'form-control']) !!}
</div> <br>
<div class="input-group">
	{!! Form::label('nama_negara', 'Nama Negara: ', ['class'=>'input-group-addon bold']) !!}
	{!! Form::text('nama_negara', null, ['class' => 'form-control']) !!}
</div> <br>
<div class="input-group">
	{!! Form::label('kode_pelabuhan', 'Kode Pelabuhan: ', ['class'=>'input-group-addon bold']) !!}
	{!! Form::text('kode_pelabuhan', null, ['class' => 'form-control']) !!}
</div> <br>
<div class="input-group">
	{!! Form::label('nama_pelabuhan', 'Nama Pelabuhan: ', ['class'=>'input-group-addon bold']) !!}
	{!! Form::text('nama_pelabuhan', null, ['class' => 'form-control']) !!}
</div> <br>
<div class="input-group">
	{!! Form::label('berat_bersih', 'Berat Bersih: ', ['class'=>'input-group-addon bold']) !!}
	{!! Form::text('berat_bersih', null, ['class' => 'form-control']) !!}
</div> <br>
<div class="input-group">
	{!! Form::label('nilai', 'Nilai: ', ['class'=>'input-group-addon bold']) !!}
	{!! Form::text('nilai', null, ['class' => 'form-control']) !!}
</div> <br>
<div class="input-group pull-right">
	<a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-default">Back</a> &nbsp;&nbsp;&nbsp;
	{!! Form::submit($submitButton, ['class' => 'btn btn-primary']) !!}
</div>