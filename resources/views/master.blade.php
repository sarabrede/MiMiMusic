<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> MiMiMusic - @yield('title')</title>

		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
		<link href="{{ asset('css/MimiMusicCSS.css') }}" rel="stylesheet" type="text/css" >
		<script type="text/javascript" src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/MiMiMusicScript.js') }}"></script>

		
		{{-- Audio Player --}}
		<link href="{{ asset('audioplayerengine/initaudioplayer.css') }}" rel="stylesheet" type="text/css" >
		<script type="text/javascript" src="{{ asset('audioplayerengine/initaudioplayer.js') }}"></script>

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
		      				<a class="navbar-left col-xs-3 col-sm-12" href="#"><img src="images/logo.png" class="img-responsive logoNav">
		      				<img src="images/minilogo.png" class="img-responsive logoNavSM"></a>
		    			</div>
	    			</div>
	    			<div class="collapse navbar-collapse">
		    			<div class="visible-sm visible-md visible-lg hidden-xs col-sm-6">
					    	<ul class="nav navbar-nav">
					       		<li> 
							       	<form class="navbar-form navbar-left">
					  					<div class="input-group searchForm">
					    					<input type="text" class="form-control" placeholder="Search...">
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
						<div class="col-sm-3">
							<ul class="nav navbar-nav navbar-right">
						    	<li class="dropdown">
						    		<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
						    		<ul class="dropdown-menu">
							    		<form>
								        	<li class="dropdown-header"> Email </li>
								        	<li>
								        		<input type="text" class="form-control" id="emailInput" placeholder="Username / Email" />
								        	</li>
								        	<li class="dropdown-header"> Username </li>
								        	<li>
								        		<input type="text" class="form-control" id="usernameInput" placeholder="Username" />
								        	</li>
								        	<li class="dropdown-header"> Password </li>
								        	<li>
								        		<input type="password" class="form-control" id="passwordInput" placeholder="Password" />
								        	</li>
								        	<li><input class="btn" type="button" value="Make my account"/><li>
								        </form>
							        </ul>
						    	</li>
						        <li class="dropdown">
						        	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in"></span> LogIn</a>
						        	<ul class="dropdown-menu">
							        	<form>
								        	<li class="dropdown-header"> Email </li>
								        	<li>
								        		<input type="text" class="form-control" id="emailInput" placeholder="Username / Email" />
								        	</li>
								        	<li class="dropdown-header"> Password </li>
								        	<li>
								        		<input type="password" class="form-control" id="passwordInput" placeholder="Password" />
								        	</li>
								        	<li> <input class="btn" type="button" value="Sign In"/> <li>
								        </form>
							        </ul>
						        </li>
						    </ul>
						</div>
			    	</div>
				</div>
			</div>
		</nav>
		@show

		@yield('content')


			<script type="text/javascript" src="{{ asset('audioplayerengine/jquery.js') }}"></script>
		<script type="text/javascript" src="{{ asset('audioplayerengine/amazingaudioplayer.js') }}"></script>
	</body>
</html>
