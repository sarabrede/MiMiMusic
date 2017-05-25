@extends('master')

@section('title', 'Welcome!')

@section('content')

@php
	$idUser = session('idUser', 0);
@endphp


<div class="container">
	<div class="panel panel-default musicPanel contenido" id="IndexScrollPanel">
		<div class="panel-body">
			<div class="row rowPills hidden-xs visible-sm visible-md visible-lg">
				<ul class="nav nav-pills text-center">
					<li class="col-sm-4" type="nuevo"><a href="#">Lo más nuevo</a></li>
					<li class="active col-sm-4" type="popular"><a href="#">Lo más popular</a></li>

					@if($idUser != 0)
					<li class="col-sm-4" type="suscripciones"><a href="#">Suscripciones</a></li>
					<p style="display: none" id="idUserHidden"> {{ $idUser }} </p>
					@endif
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
