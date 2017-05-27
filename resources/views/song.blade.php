@extends('master')

@section('title', $song->tituloCancion)

@section('style')
.panel-body{
	padding:0px;
}
@endsection

@php
$nombreUsuario = session('nombreUsuario', 'default');
@endphp

@section('content')

<input type="hidden" id="idSongPage" value="{{ $song->idCancion }}" />
<input type="hidden" id="priceSongPage" value="{{ $song->precio }}" />
<input type="hidden" id="idAlbumPage" value="{{ $song->idAlbum }}" />
<input type="hidden" id="buyed" value="{{ $buyed }}" />

<div class="container">
	<div class="panel panel-default musicPanel contenido">
		<div class="panel-body">
			<div class="row songRow">
				<div class="col-xs-12">
					<div class="col-xs-8 photoSong">
						<div class="gradientParent col-xs-12">
							<div class="gradient col-xs-11">
								<img src = "{{ $song->fotoAlbum }}" width="100%" height="100%"/>
							</div>

							@if( strcmp($nombreUsuario, "default") != 0)

								@if($song->precio != 0.00 && $buyed == 0) 
									<button type="button" class="btn btnSong btnBuy">
		          						<span class="glyphicon glyphicon-shopping-cart"></span>
		        					</button>
		        				@endif
								
								@if($isfavorite == 0)
									<button type="button" class="btn btnSong btnLove">
		          						<span class="glyphicon glyphicon-heart"></span>
		        					</button>

		        				@else
		        					<button type="button" class="btn btnSong btnLove btnUsed">
		          						<span class="glyphicon glyphicon-heart"></span>
		        					</button>
		        				@endif
        					@endif

        					<p class="songName"> {{ $song->tituloCancion }} </p>
						</div>
					</div>
							
					<div class="col-xs-4 listOfSongs prfctScrollBar">
						<p> {{ $song->tituloAlbum }} </p>

						@foreach($album as $single)
							@component('songComponent', ['id' => $single->idCancion, 'title' => $single->tituloCancion, 'description' => $single->descripcion, 'idAlbum' => $single->idAlbum, 'idSong' => $idSong])
							@endcomponent
						@endforeach
					</div>
				</div>

				<div class="col-xs-11 reproductorColumn">
					<div class="col-xs-7 reproductor">
						<audio controls class="audioHtml" id="audioSongPlayer">
						  <source src="{{ $song->rutaCancion }}" type="audio/mp3">
						</audio>
					</div>
				</div>

				
				<div class="col-xs-12">
					<div class="col-xs-8 commentPanel">
					@if( strcmp($nombreUsuario, "default") != 0)
						<div class="col-xs-12">
							<textarea class="form-control" rows="10" placeholder="Write a comment..." id="taComment"></textarea>
						</div>

						<div class="col-xs-7">
						</div>

						<div class="col-xs-5 commentArea">
							<button type="button" class="btn">
								Cancel
							</button>
							<button type="button" class="btn" id="btnComment">
								Comment
							</button>
						</div>
					@else
						<div class="col-xs-12">
							<p> Only logged users can comment. </p>
						</div>
					@endif


					@foreach($comments as $comment)
						@component('comment', ['user' => $comment->nombreUsuario, 'msg' => $comment->comentario, 'fecha' => $comment->fechaComentario, 'idUser' => $comment->idUsuario])
						@endcomponent
					@endforeach
					</div>

					<div class="col-xs-4 descriptionPanel">
						<a href="{{ url('profile') }}/{{ $song->idUsuario }}" target="_blank"> {{ $song->nombreUsuario }} </a>
				
						<p> {{ $song->fechaPublicacion }} </p>
				
						<p> {{ $song->descripcion }} </p>
						<p> Views: {{ $song->visitas }} </p>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
