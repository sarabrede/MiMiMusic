@extends('master')

@section('title', 'Welcome!')

@section('mainNavbar') 
	<div> </div>
@endsection

@section('content')
	<div class="container-fluid containerPanel">
		<div class="row rowLoginPanel">
			<div class="col-sm-4 col-xs-12 loginPanel text-center">
				<div class="row logoRow">
					<div class="col-xs-12 logo">
						<img src = "../images/logo.png" width="100%" height="100%"/>
					</div>
				</div>
				<div class="row">
					<form class="formLogIn" action="/logIn" method="POST">
					{{ csrf_field() }}
						<div class="col-xs-12 rowLogin">
							<div class="col-xs-12">
								<label class="headerText"> Log In </label> 
							</div>
							<div class="col-xs-12">
								<div class="form-group form-group-lg row">
									<label for="emailInputlog" class="pull-left">Email address:</label>
									@if(strcmp($error, "no") == 0)
									<input type="text" class="form-control" id="emailInputlog" placeholder="Username / Email" name="emailInputlog" />
									@else
									<input type="text" class="form-control error" id="emailInputlog" placeholder="Username / Email" name="emailInputlog" />
									@endif
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group form-group-lg row">
									<label for="passwordInputlog" class="pull-left">Password:</label>
									@if(strcmp($error, "no") == 0)
									<input type="password" class="form-control" id="passwordInputlog" placeholder="Password" name="passwordInputlog"/>
									@else
									<input type="password" class="form-control error" id="passwordInputlog" placeholder="Password" name="passwordInputlog"/>
									@endif
								</div>
							</div>
							<div class="col-xs-12">
								<input type="submit" class="btn btn-lg btnLogin" value="Log in"/>
								<p id="newHere"> Are you new here? <u> Sign up now! </u></p>
							</div>
						</div>
					</form>

					<form class="formSignUp" action="/addUser" method="POST" id="formSignUpLanding">
						{{ csrf_field() }}
						<div class="col-xs-12 rowLogin">
							<div class="col-xs-12">
								<label class="headerText"> Sign Up </label> 
							</div>
							<div class="col-xs-12">
								<div class="form-group form-group-lg row">
									<label for="emailInput" class="pull-left">Email:</label>
									<input type="email" class="form-control emailCheck" id="emailInput" placeholder="Email" name="emailInput"/>
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group form-group-lg row">
									<label for="usernameInput" class="pull-left">Username:</label>
									<input type="text" class="form-control usernameCheck" id="usernameInput" placeholder="Username" name="usernameInput"/>
								</div>
							</div>
							<div class="col-xs-12">
								<div class="form-group form-group-lg row">
									<label for="passwordInput" class="pull-left">Password:</label>
									<input type="password" class="form-control" id="passwordInput" placeholder="Password" name ="passwordInput"/>
								</div>
							</div>
							<div class="col-xs-12">
								<input type="button" class="btn btnLogin btnSignUp" value="Sign Up" id="btnSignUpLanding" />
								<br>
								<p id="account"> <u> I already have an account! </u> </p>
							</div>
						</div>
					</form>

				</div>
			</div>
			<div class="col-sm-8 col-xs-12 imagePanel">
				<div class="panel panel-default musicPanel" id="landingPanel">
					<div class="panel-body landingPageSongs">
						<form class="form-group" action="{{ url('search') }}">
						  	<div class="input-group">
						    	<input type="text" class="form-control" placeholder="Search..." name="searchParam"/>
						    	<div class="input-group-btn">
						        	<button class="btn btn-default" type="submit">
							    		<i class="glyphicon glyphicon-search"></i>
							    	</button>
								</div>
							</div>
						</form>
						@foreach ($songs as $song)
							@component('amazingaudioplayer', ['id' => $song->idCancion, 'title' => $song->tituloCancion, 'author' => $song->nombreUsuario.' - ', 'album' => $song->tituloAlbum, 'description' => $song->descripcion, 'source' => $song->rutaCancion, 'image' => $song->fotoAlbum])
							@endcomponent
						@endforeach

						

					</div>
				</div>
			</div>
		</div>
		<div class="row footer hidden-xs visible-sm visible-md visible-lg">
			<div class="col-md-12">
				<p class="text-center"> <small> <span class="glyphicon glyphicon-copyright-mark"></span>2017 MiMiMusic - All right reserved</small></p>
			</div>
		</div>
	</div>
@endsection
