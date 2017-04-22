@extends('master')

@section('title', 'Welcome!')

@section('mainNavbar') 
	<div> </div>
@endsection

@section('content')
	<div class="container-fluid containerPanel">
			<div class="row rowLoginPanel">
				<div class="col-sm-4 loginPanel text-center">
					<div class="row logoRow">
						<div class="col-sm-12 logo"></div>
					</div>
					<form class="formLogIn">
						<label class="headerText"> Log In </label> 
						<div class="form-group form-group-lg row">
							<label for="emailInput" class="pull-left">Email address:</label>
							<input type="text" class="form-control" id="emailInput" placeholder="Username / Email" />
						</div>
						<div class="form-group form-group-lg row">
							<label for="passwordInput" class="pull-left">Password:</label>
							<input type="password" class="form-control" id="passwordInput" placeholder="Password" />
						</div>
						<input type="submit" class="btn btn-lg btnLogin" value="Log in"/>
						<p> Are you new here? <u> Sign up now! </u></p>
					</form>
					
				</div>
				<div class="col-sm-8 imagePanel">
					<div class="panel panel-default musicPanel">
						<div class="panel-body">
							<form class="form-group">
							  <div class="input-group">
							    <input type="text" class="form-control" placeholder="Search..."/>
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
@endsection

@section('footer')
	<div class="row footer hidden-xs visible-sm visible-md visible-lg">
				<div class="col-md-12">
					<p class="text-center"> <small> <span class="glyphicon glyphicon-copyright-mark"></span>2017 MiMiMusic - All right reserved</small></p>
				</div>
			</div>
		</div>
@endsection
