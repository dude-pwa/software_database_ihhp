<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sistem Informasi Perpustakaan</title>
	<link rel="stylesheet" href="{{ URL::to('/src/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{URL::to('/src/css/custom.css')}}">
	<script src="{{URL::to('/src/js/bootstrap.min.js')}}"></script>
	<script src="{{URL::to('/src/js/jquery-3.1.0.min.js')}}"></script>

	<div class="navbar navbar-default navbar-static-top">
	  <div class="container">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	    </button>
	    <a href="/" class="navbar-brand">Seleksi Tim Sepakbola</a>
	    <div class="navbar-collapse collapse navbar-responsive-collapse">
	      <ul class="nav navbar-nav">
	        <li><a href="#">Groups</a></li>
	        <li><a href="#">Peserta</a></li>
	        <li><a href="#">Bobot</a></li>
	        <li><a href="#">Kriteria</a></li>
	        <li class="dropdown">
	          {{-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <% if coach_signed_in? %>
	              <li>
	              <%= link_to('Logout', destroy_coach_session_path, :method => :delete) %>        
	              </li>
	            <% else %>
	              <li><%= link_to 'Signup', new_coach_registration_path %></li>
	              <li><%= link_to 'Login', new_coach_session_path %></li>
	            <% end %>
	          </ul> --}}
	        </li>
	      </ul>
	    </div>
	  </div>
	</div>

</head>
<body>
	<div class="container">
		@if(Session::has('message'))
			<div class="alert alert-success">
				{{Session::get('message')}}
			</div>
		@endif
		@yield('content')
	</div>
	
	<script>
		$('div.alert').delay(3000).slideUp(300);
	</script>
</body>
</html>