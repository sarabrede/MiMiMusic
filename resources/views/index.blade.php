@extends('master')

@section('title', 'Welcome!')

@php
	/*$songs = DB::table('Cancion')
	->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
	->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
	->select('Cancion.*', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Usuario.nombreUsuario')
	->orderby('fechaPublicacion', 'desc')
	->limit(9)
	->get();*/
	/*$songs = DB::table('Cancion')
	->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
	->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
	->select('Cancion.*', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Usuario.nombreUsuario')
	->where('Usuario.idUsuario', '1')
	->orderby('fechaPublicacion', 'desc')
	->limit(9)
	->get();*/
	$songs = DB::table('Cancion')
	->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
	->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
	->select('Cancion.*', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Usuario.nombreUsuario')
	->orderby('visitas', 'desc')
	->limit(9)
	->get();
@endphp

@section('content')
<div class="container">
	<div class="panel panel-default musicPanel contenido">
		<div class="panel-body">
			<div class="row rowPills hidden-xs visible-sm visible-md visible-lg">
				<ul class="nav nav-pills text-center">
					<li class="col-sm-4"><a href="#">Lo más nuevo</a></li>
					<li class="active col-sm-4"><a href="#">Lo más popular</a></li>
					<li class="col-sm-4"><a href="#">Suscripciones</a></li>
				</ul>
			</div>

			<div class="row rowPillsXS visible-xs hidden-sm hidden-md hidden-lg">
				<div class="btn-group">
				  <button type="button" class="btn btn-primary col-xs-4"><span class="glyphicon glyphicon-plus-sign"> </span></button>
				  <button type="button" class="btn btn-primary col-xs-4"><span class="glyphicon glyphicon-fire"> </span></button>
				  <button type="button" class="btn btn-primary col-xs-4 active"><span class="glyphicon glyphicon-star"> </span>
				  </button>
				</div>
			</div>

			<div class= "row rowContent">
				@foreach ($songs as $song)
					@component('amazingaudioplayer', ['id' => $song->idCancion, 'title' => $song->tituloCancion, 'author' => $song->nombreUsuario.' - ', 'album' => $song->tituloAlbum, 'description' => $song->descripcion, 'source' => $song->rutaCancion, 'image' => $song->fotoAlbum])
					@endcomponent
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection