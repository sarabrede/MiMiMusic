<div class ="col-xs-11 SearchResult">
	<div class="col-xs-5 imageFrame">
		<img src="{{ asset($image) }}" width="100%" height="100%" class="img-rounded"/>
	</div>
				
	<div class="col-xs-4 infoResult">
		<a href="{{ url('song') }}/{{ $id }}" target="_blank"> {{ $title }} </a> 
		<br>
		<a href="{{ url('album') }}/{{ $idAlbum }}" target="_blank"> {{ $album }} </a>
		<br>
		<label>{{ $genre }}</label>
		<br>
		<a href="{{ url('profile') }}/{{ $idUser }}" target="_blank"> {{ $author }} </a>
		<p> {{ $description }} </p>
	</div>
	<div class="col-xs-1 infoResult">
		<p> {{ ($price > 0) ? 'US$'.$price : 'Free'}} </p>
	</div>
</div>
