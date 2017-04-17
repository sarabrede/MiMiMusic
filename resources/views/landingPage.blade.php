@extends('master')

@section('title', 'Welcome!')

@section('mainNavbar') 
	<div> </div>
@endsection

{{-- Get the songs --}}
@php
	$songs = DB::table('Cancion')
	->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
	->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
	->select('Cancion.*', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Usuario.nombreUsuario')
	->orderby('fechaPublicacion', 'desc')
	->limit(6)
	->get();
@endphp

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

							{{-- Display the songs --}}
							@foreach ($songs as $song)
								@component('amazingaudioplayer', ['id' => $song->idCancion, 'title' => $song->tituloCancion, 'author' => $song->nombreUsuario.' - ', 'album' => $song->tituloAlbum, 'description' => $song->descripcion, 'source' => 'http://66.90.93.122/anime_ost/shigatsu-wa-kimi-no-uso-ed-single-kirameki/lkfmuhddrz/01%20-%20Kirameki.mp3', 'image' => $song->fotoAlbum])
								@endcomponent
							@endforeach
							
							{{--<audio id="sound1" preload="auto" src="http://www.jezra.net/audio/skye_boat_song.ogg" autoplay controls></audio>  --}}

							<audio id="sound1" preload="auto" src="http://66.90.93.122/anime_ost/shigatsu-wa-kimi-no-uso-ed-single-kirameki/lkfmuhddrz/01%20-%20Kirameki.mp3" controls></audio>
							
							{{-- <audio id="sound1" preload="auto" src="{{ asset('audios/Its_Not_Like_I_Like_You.mp3') }}" autoplay controls></audio>--}}

							<audio controls preload="auto">
							  <source src="{{ asset('audios/Its_Not_Like_I_Like_You.mp3') }}" type="audio/mpeg">
							</audio>

							<audio controls preload="auto">
							  <source src="http://127.0.0.1:8080/Everybodys_Circulation_(Mashup).mp3" type="audio/mpeg">
							</audio>


						{{--	<script>
								$( document ).ready(function() {

    								audio = document.getElementById("sound10");
								    audio.src = "audios/Its_Not_Like_I_Like_You.mp3";
								    audio.load();
								    audio.play();
								});	
							</script> --}}

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

