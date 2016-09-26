<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Software Database IHHP</title>
	<link rel="stylesheet" href="{{ URL::to('/src/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{URL::to('/src/css/custom.css')}}">
	<script src="{{URL::to('/src/js/jquery-3.1.0.min.js')}}"></script>
	<script src="{{URL::to('/src/js/bootstrap.min.js')}}"></script>
	

	{{-- <div class="navbar navbar-default navbar-static-top">
	  <div class="container">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	    </button>
	    <a href="/" class="navbar-brand">Data Ekspor dan Impor</a>
	    <div class="navbar-collapse collapse navbar-responsive-collapse">
	      <ul class="nav navbar-nav">
	        <li><a href="/countries">Daftar Negara</a></li>
	        <li><a href="/harbor">Daftar Pelabuhan</a></li>
	        <li><a href="/items">Daftar Item</a></li>
	        <li><a href="/exports">Daftar Export</a></li>
	        <li><a href="/imports">Daftar Import</a></li>
	      </ul>
	      <!-- Right Side Of Navbar -->
	      <ul class="nav navbar-nav navbar-right">
	          <!-- Authentication Links -->
          @if (Auth::guest())
              <li><a href="{{ url('/login') }}">Login</a></li>
              <li><a href="{{ url('/register') }}">Register</a></li>
          @else
              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
          @endif
	      </ul>
	    </div>
	  </div>
	</div> --}}

</head>
<body>
	<div class="container">
		@if(Session::has('message'))
			<div class="alert alert-success">
				{{Session::get('message')}}
			</div>
		@elseif(Session::has('error'))
			<div class="alert alert-danger">
				{{Session::get('error')}}
			</div>
		@endif

		@if (!Auth::guest())
			<br>
			<center><img src="{{URL::to('/src/images/logo.png')}}" alt="" class="logo"></center>
		@endif

		@yield('content')
	</div>
	
	<script>
		$('div.alert').delay(25000).slideUp(300);
    $(".delete").on("submit", function(){
        return confirm("Are you sure?");
    });
</script>
</body>
</html>