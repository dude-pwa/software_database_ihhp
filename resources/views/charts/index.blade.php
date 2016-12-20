@extends('app')

@section('content')
	<br>
	<a href="/" class="btn btn-warning">Kembali Ke Menu Utama</a>

	<div class="panel panel-default">
		<div class="panel-success">
			<h1 class="panel-heading">Daftar Negara</h1>
		</div>

		<div class="panel panel-body">
			<div class="col-md-2 col-md-offset-0 btn-xs">
				<h4><center>Afrika</center></h4>
				<div style="max-height: 230px; width: 180px; overflow: auto; padding-left: 50px; border-width: 2px; border-right-style: dotted;">
					@foreach ($negaraAfrika as $negara) 
					  	<a href="/charts/{{$negara}}">{{$negara}}</a>
					  	<br>
					@endforeach
				</div>
			</div>

			<div class="col-md-3 col-md-offset-0 btn-xs">
				<h4><center>Amerika</center></h4>
				<div style="max-height: 230px; width: 230px; overflow: auto; padding-left: 60px; border-width: 2px; border-right-style: dotted;">
					@foreach ($negaraAmerika as $negara) 
					  	<a href="/charts/{{$negara}}">{{$negara}}</a>
					  	<br>
					@endforeach
				</div>
			</div>

			<div class="col-md-3 col-md-offset-0 btn-xs">
				<h4><center>Asia</center></h4>
				<div style="max-height: 230px; width: 230px; overflow: auto; padding-left: 60px; border-width: 2px; border-right-style: dotted;">
					@foreach ($negaraAsia as $negara) 
					  	<a href="/charts/{{$negara}}">{{$negara}}</a>
					  	<br>
					@endforeach
				</div>
			</div>

			<div class="col-md-2 col-md-offset-0 btn-xs">
				<h4><center>Australia</center></h4>
				<div style="max-height: 230px; width: 180px; overflow: auto; padding-left: 50px; border-width: 2px; border-right-style: dotted;">
					@foreach ($negaraAustralia as $negara) 
					  	<a href="/charts/{{$negara}}">{{$negara}}</a>
					  	<br>
					@endforeach
				</div>
			</div>

			<div class="col-md-2 col-md-offset-0 btn-xs">
				<h4><center>Eropa</center></h4>
				<div style="max-height: 230px; width: 180px; overflow: auto; padding-left: 20px; border-width: 2px; border-right-style: dotted;">
					@foreach ($negaraEropa as $negara) 
					  	<a href="/charts/{{$negara}}">{{$negara}}</a>
					  	<br>
					@endforeach
				</div>
			</div>
				
			<br>
			<br>
		</div>
	</div>

@endsection

