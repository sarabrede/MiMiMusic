<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> MiMiMusic - @yield('title')</title>
		<link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}" />

		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
		<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet" type="text/css" >
		<link href="{{ asset('css/jquery-ui.structure.css') }}" rel="stylesheet" type="text/css" >
		<link href="{{ asset('css/jquery-ui.theme.css') }}" rel="stylesheet" type="text/css" >
		<link href="{{ asset('css/MimiMusicCSS.css') }}" rel="stylesheet" type="text/css" >

		{{-- Audio Player --}}
		<link href="{{ asset('audioplayerengine/initaudioplayer.css') }}" rel="stylesheet" type="text/css" >
		
		{{--PerfectScrollBar --}}
		<link href="{{ asset('css/perfect-scrollbar.min.css') }}" rel="stylesheet" type="text/css" >

		<script type="text/javascript" src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
		{{--<script type="text/javascript" src="{{ asset('audioplayerengine/jquery.js') }}"></script>--}}
		<script type="text/javascript" src="{{ asset('js/jquery-ui.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

		{{--Amazing AudioPlayer --}}
		<script type="text/javascript" src="{{ asset('audioplayerengine/amazingaudioplayer.js') }}"></script>
		<script type="text/javascript" src="{{ asset('audioplayerengine/initaudioplayer.js') }}"></script>

		{{--PerfectScrollBar --}}
			<script type="text/javascript" src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>

		<script type="text/javascript" src="{{ asset('js/MiMiMusicScript.js') }}"></script>


		<style>
		@yield('style')
		</style>

	</head>

	<body>
		@section('mainNavbar') 
			<nav class="navbar navbar-inverse navbar-fixed-top">
  				<div class="container">
  					<div class="row">
  						<div class="col-sm-2 col-xs-12 headerLogo">
		    				<div class="navbar-header">
					    		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					        	<span class="icon-bar"></span>
					        	<span class="icon-bar"></span>
					        	<span class="icon-bar"></span>                        
					      		</button>
					      		<button type="button" class="navbar-toggle btn">
					        	<span class="glyphicon glyphicon-search"></span>
					      		</button>
		      				<a class="navbar-left col-xs-3 col-sm-12" href="{{ url('index') }}">
		      				<img src="{{ asset('images/logo.png') }}" class="img-responsive logoNav">
		      				<img src="{{ asset('images/minilogo.png') }}" class="img-responsive logoNavSM"></a>
		    			</div>
	    			</div>

	    			<div class="collapse navbar-collapse">
		    			<div class="visible-sm visible-md visible-lg hidden-xs col-sm-6">
					    	<ul class="nav navbar-nav">
					       		<li> 
							       	<form class="navbar-form navbar-left" action="{{ url('search') }}">
					  					<div class="input-group searchForm">

					    					<input type="text" class="form-control" placeholder="Search..." value="@section('searchParam')@show" name="searchParam" id="searchParam" />

											<div class="input-group-btn">
					  							<button class="btn btn-default" type="submit">
					    							<i class="glyphicon glyphicon-search"></i>
					  							</button>
											</div>

					  					</div>
									</form>
					    		<li>
			      		  	</ul>
		      		  	</div>


		      		  	@php
		      		  	$nombreUsuario = session('nombreUsuario', 'default');
		      		  	$imageUser = session('fotoUser', 'default');
		      		  	$idUser = session('idUser', '0');
		      		  	@endphp

		      		  	@if( strcmp($nombreUsuario, "default") == 0)
						<div class="col-sm-3">
							<ul class="nav navbar-nav navbar-right">
						    	<li class="dropdown">
						    		<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
						    		<ul class="dropdown-menu">
							    		<form action="/addUser" method="POST">
							    			{{ csrf_field() }}
								        	<li class="dropdown-header"> Email </li>
								        	<li>
								        		<input type="text" class="form-control" id="emailInput" placeholder="Username / Email" name="emailInput"/>
								        	</li>
								        	<li class="dropdown-header"> Username </li>
								        	<li>
								        		<input type="text" class="form-control" id="usernameInput" placeholder="Username" name="usernameInput"/>
								        	</li>
								        	<li class="dropdown-header"> Password </li>
								        	<li>
								        		<input type="password" class="form-control" id="passwordInput" placeholder="Password" name ="passwordInput"/>
								        	</li>
								        	<li><input class="btn" type="submit" value="Make my account"/><li>
								        </form>
							        </ul>
						    	</li>
						        <li class="dropdown">
						        	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in"></span> LogIn</a>
						        	<ul class="dropdown-menu">
							        	<form action="/logIn" method="POST">
							        		{{ csrf_field() }}
								        	<li class="dropdown-header"> Email </li>
								        	<li>
								        		<input type="text" class="form-control" id="emailInput" placeholder="Username / Email" name="emailInputlog"/>
								        	</li>
								        	<li class="dropdown-header"> Password </li>
								        	<li>
								        		<input type="password" class="form-control" id="passwordInput" placeholder="Password" name="passwordInputlog"/>
								        	</li>
								        	<li> <input class="btn" type="submit" value="Sign In"/> <li>
								        </form>
							        </ul>
						        </li>
						    </ul>
						</div>
						
						@else
						<div class="col-sm-3 profilePhotoNavBar">
							<ul class="nav navbar-nav navbar-right">

								<li class="col-sm-2">
									<img src="{{ $imageUser }}" width="100%" height="100%" class="img-circle"/>
								</li>

								<li class="col-sm-4 colProfile"> 
									<a class="profileName" href="/profile/{{ $idUser }}">  {{ $nombreUsuario }} </a>
								</li>
								
								<li class="dropdown col-sm-1">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"> </a>
  									<ul class="dropdown-menu logoutddmenu">
  										<li>
									    	<a style="color: #D1F4E9" href="/shop"> <span class="glyphicon glyphicon-shopping-cart"></span> ShopCart </a>
										</li>
										<li class="divider"></li>
									    <li>
									    	<a style="color: #D1F4E9" href="/logOut"> <span class="glyphicon glyphicon-log-out"></span> Log out </a>
										</li>
								  </ul>
								</li>

							</ul>
						</div>

						@endif
			    	</div>
				</div>
			</div>
		</nav>
		@show

		@yield('content')


	</body>
</html>
