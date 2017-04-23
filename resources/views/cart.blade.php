@extends('master')

@section('title', 'Shopping Cart')

@php
	$total = 0.0;
@endphp
@section('content')
<div class="container">
	<div class="panel panel-default musicPanel contenido">
		<div class="panel-body">
			<div class="row ShopRow">
				<div class ="col-xs-7 ShopPanel">
					@if(sizeof($albums) > 0)

					@foreach ($albums as $album)
						@component('shopComponent', ['id' => $album->idAlbum, 'album' => $album->tituloAlbum, 'image' => $album->fotoAlbum, 'author' => $album->nombreUsuario, 'numSongs' => 'Total songs: '.$album->count, 'price' => $album->precio, 'idAuthor' => $album->idUsuario])
						@endcomponent
						@php
							$total += $album->precio;
						@endphp
					@endforeach

					@else
						<p> You haven't bought anything you... baka!  </p>
					@endif
				</div>

				<div class="col-xs-4">
					<form>
			        	<label for="noCardInput" class="pull-left">Card Number:</label>
						<input type="text" class="form-control" id="noCardInput" placeholder="Card Number" />

						<label for="monthInput" class="pull-left">Expiration Date:</label>
						<select class="form-control" id="monthInput">
							<option value="1">January</option>
							<option value="2">February</option>
							<option value="3">March</option>
							<option value="4">April</option>
							<option value="5">May</option>
							<option value="6">June</option>
							<option value="7">July</option>
							<option value="8">August</option>
							<option value="9">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>
						</select>
						<select class="form-control" id="yearInput">
							@for ($i = 0; $i < 20; $i++)
								<option value="{{(2017 + $i)}}">{{(2017 + $i)}}</option>
							@endfor
						</select>

						<label for="securityCardInput" class="pull-left">Security Code:</label>
						<input type="text" class="form-control" id="securityCardInput" placeholder="Security Code" />

						<label class="pull-left">{{'US$'.$total}}</label>

						<input type="submit" class="btn btn-lg btnLogin" value="Buy!"/>
			        </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
