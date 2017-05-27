<div class ="col-xs-11 SearchResult">
	<div class="col-xs-4 imageFrame">
		<img src="{{ asset($image) }}" width="100%" height="100%" class="img-rounded"/>
	</div>
				
	<div class="col-xs-5 infoResult">
		<a href="{{ url('song') }}/{{ $id }}"> {{ $title }} </a> 
		<br>
		<a href="{{ url('album') }}/{{ $idAlbum }}"> {{ $album }} </a>
		<br>
		<label>{{ $genre }}</label>
		<br>
		<a href="{{ url('profile') }}/{{ $idUser }}"> {{ $author }} </a>
		<p> {{ $description }} </p>
	</div>
	<div class="col-xs-2 infoResult pull-right text-center">
		<p> {{ ($price > 0) ? '$'.$price : 'Free'}} </p>
	</div>
</div>
