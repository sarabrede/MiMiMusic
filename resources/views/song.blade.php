@extends('master')

@section('title', $song->tituloCancion)

@section('style')
.panel-body{
	padding:0px;
}
@endsection

@section('content')
<div class="container">
	<div class="panel panel-default musicPanel contenido">
		<div class="panel-body">
			<div class="row songRow">

				<div class="col-xs-12">
					<div class="col-xs-8 photoSong">
						<div class="gradientParent col-xs-12">
							<div class="gradient col-xs-11">
								<img src = "../audioImages/09.jpg" width="100%" height="100%"/>
							</div>

							<button type="button" class="btn btnSong btnBuy">
          						<span class="glyphicon glyphicon-shopping-cart"></span>
        					</button>
								
							<button type="button" class="btn btnSong btnLove">
          						<span class="glyphicon glyphicon-heart"></span>
        					</button>

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
						<audio controls class="audioHtml">
						  <source src="{{ $song->rutaCancion }}" type="audio/mp3">
						</audio>
					</div>
				</div>

				<div class="col-xs-12">
					<div class="col-xs-8 commentPanel">
						<div class="col-xs-12">
							<textarea class="form-control" rows="10" placeholder="Write a comment..."></textarea>
						</div>

						<div class="col-xs-7">
						</div>

						<div class="col-xs-5">
							<button type="button" class="btn">
								Cancel
							</button>
							<button type="button" class="btn">
								Comment
							</button>
						</div>

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
