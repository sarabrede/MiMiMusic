<div class="col-xs-12 comment">
	<div class="col-xs-2">
		<img src="{{ $foto }}" width="100%" height="100%" class="img-circle"/>
	</div>
	<div class="col-xs-7">
		<a href="{{ url('profile') }}/{{ $idUser }}"> {{ $user }} </a>
		<p> {{ $msg }} </p>
	</div>
	<div class="col-xs-2 text-right dateOfComment">
		<p> {{ $fecha }} </p>
	</div>
</div>

<div class="col-xs-12 lineParent">
	<div class="col-xs-2">
	</div>
	<div class="col-xs-8 line">
	</div>
</div>
