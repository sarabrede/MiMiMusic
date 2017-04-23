<div class ="col-xs-11 SearchResult">
	<div class="col-xs-4 imageFrame">
		<img src="{{ asset($image) }}" width="100%" height="100%" class="img-rounded"/>
	</div>
				
	<div class="col-xs-5 infoResult">
		<a href="{{ url('song') }}/{{ $id }}" target="_blank"> {{ $title }} </a> 
		<br>
		<a href="{{ url('album') }}/{{ $idAlbum }}" target="_blank"> {{ $album }} </a>
		<br>
		<label>{{ $genre }}</label>
		<br>
		<a href="{{ url('profile') }}/{{ $idUser }}" target="_blank"> {{ $author }} </a>
		<p> {{ $description }} </p>
	</div>
	<div class="col-xs-2 infoResult pull-right">
		<div class="col-xs-12 text-center">
			<p> {{ ($price > 0) ? '$'.$price : 'Free'}} </p>
		</div>

		<div class="col-xs-12 text-right">
			<button type="button" class="btn btn-sm btnEditSong">
          		<span class="glyphicon glyphicon-pencil"></span> 
        	</button>
		</div>
	</div>
</div>
