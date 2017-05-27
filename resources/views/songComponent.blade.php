@if( $idSong == $id)
	<div class="col-xs-12 songContainer activeSong">
		<div class="col-xs-9 nameSong">
			<a href="{{ url('song') }}/{{ $id }}"> {{ $title }} </a>
		</div>
		<div class="col-xs-2 pull-right timeSong">
			<p> 3:50 </p>
		</div>
	</div>
@else
	<div class="col-xs-12 songContainer ">
		<div class="col-xs-9 nameSong">
			<a href="{{ url('song') }}/{{ $id }}"> {{ $title }} </a>
		</div>
		<div class="col-xs-2 pull-right timeSong">
			<p> 3:50 </p>
		</div>
	</div>
@endif
