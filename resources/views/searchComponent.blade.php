<div class ="col-xs-11 SearchResult">
	<div class="col-xs-5 imageFrame">
		<img src="{{ $image }}" width="100%" height="100%" class="img-rounded"/>
	</div>
				
	<div class="col-xs-4 infoResult">
		<a> {{ $title }} </a> 
		<br>
		<a> {{ $album }} </a>
		<br>
		<a> {{ $author }} </a>
		<p> {{ $description }} </p>
	</div>
	<div class="col-xs-1 infoResult">
		<p> {{ ($price > 0) ? 'US$'.$price : 'Free'}} </p>
	</div>
</div>
