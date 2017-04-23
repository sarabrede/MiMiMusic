@extends('master')

@section('title', 'Search')

@section('searchParam', $search)

@section('content')
<div class="container">
	<div class="panel panel-default musicPanel contenido">
		<div class="panel-body">
			<div class="row searchRow">
				<div class ="col-xs-8 SearchPanel">
					<div class ="col-xs-3">
						<button type="button" class="btn btnFilter" style="width: 100%"> Filter <span class="caret"> </span> </button>
					</div>
					@if(sizeof($songs) > 0)

					@foreach ($songs as $song)
						@component('searchComponent', ['id' => $song->idCancion, 'title' => $song->tituloCancion, 'author' => $song->nombreUsuario, 'album' => $song->tituloAlbum, 'description' => $song->descripcion, 'price' => $song->precio, 'image' => $song->fotoAlbum, 'idUser' => $song->idUsuario, 'genre' => $song->nombreGenero, 'idAlbum' => $song->idAlbum])
						@endcomponent
					@endforeach

					@else
						<p> Sorry, baka, we didn't find anything. It's not like we care or anything. </p>
					@endif

					
				</div>
				<div class="col-xs-4 SearchPills">
			    	<ul class="nav nav-tabs nav-stacked">
			        	<li><a href="{{ url('search') }}/song/{{ $search }}" class="songsSearch activePill" >Songs</a></li>
			        	<li><a href="{{ url('search') }}/album/{{ $search }}" class="albumSearch" >Albums</a></li>
			        	<li><a href="{{ url('search') }}/user/{{ $search }}" class="userSearch" >Users</a></li>
			      	</ul>
			    </div>
		    </div>
		</div>
	</div>
</div>
@endsection
