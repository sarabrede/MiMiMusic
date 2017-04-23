@extends('master')

@section('title', 'Song')

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
							

					<div class="col-xs-4 listOfSongs">
						<p> {{ $song->tituloAlbum }} </p>

							<div class="col-xs-12 songContainer activeSong">
								<div class="col-xs-9 nameSong">
									<a href="#"> {{ $song->tituloCancion }} </a>
								</div>
								<div class="col-xs-2 pull-right timeSong">
									<p> 3:50 </p>
								</div>
							</div>


							@for($i = 0; $i < 10; $i++)
								@component('songComponent')
								@endcomponent
							@endfor
								
							
						
					</div>
				</div>

				<div class="col-xs-12 reproductorColumn">
					<div class="col-xs-6 reproductor">
						<audio controls class="audioHtml">
						  <source src="horse.ogg" type="audio/ogg">
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

						@for($i = 0; $i < 5; $i++)
							@component('comment')
							@endcomponent
						@endfor
						

					</div>

					<div class="col-xs-4 descriptionPanel">
						<a href="#"> {{ $song->nombreUsuario }} </a>
				
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
