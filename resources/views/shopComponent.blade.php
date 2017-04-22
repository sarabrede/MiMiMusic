<div class ="col-xs-11 CartItem">
	<div class="col-xs-4 imageFrame">
		<img src="{{ asset($image) }}" width="100%" height="100%" class="img-rounded"/>
	</div>

	<div class="col-xs-4 infoShop">
		<a href="{{ url('album') }}/{{ $id }}" target="_blank"> {{ $album }} </a>
		<br>
		<a> {{ $author }} </a>
		<br>
		<p> {{ $numSongs }} </p>
	</div>
	<div class="col-xs-1 infoShop text-right">
		<p> {{ ($price > 0) ? 'US$'.$price : 'Free'}} </p>
	</div>
</div>
