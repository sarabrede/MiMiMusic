@extends('master')

@section('title', $info->nombreUsuario.'\'s Profile')

@section('style')

	.panel-body
	{
		padding-top: 0px;
	}
@endsection

@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		dialog = $( "#dialog-form" ).dialog({
	    	open: function() {
	    		//$( this ).find( "[type=submit]" ).hide();
	    	},
	    	close: function() {
		        //form[ 0 ].reset();
		        //allFields.removeClass( "ui-state-error" );
			},
	    	autoOpen: false,
	    	height: 400,
	    	width: 500,
	    	modal: true,
	    	buttons: [
	    	{
	    		text: "Cancel",
	            click: function() {
	                $( this ).dialog( "close" );
	            }
	    	}]
	    });
	    dialogAlbum = $( "#dialog-formAlbum" ).dialog({
	    	open: function() {
	    		//$( this ).find( "[type=submit]" ).hide();
	    	},
	    	close: function() {
		        //form[ 0 ].reset();
		        //allFields.removeClass( "ui-state-error" );
			},
	    	autoOpen: false,
	    	height: 400,
	    	width: 500,
	    	modal: true,
	    	buttons: [
	    	{
	    		text: "Cancel",
	            click: function() {
	                $( this ).dialog( "close" );
	            }
	    	}]
	    });
	    dialogUser = $( "#dialog-formEdit" ).dialog({
	    	open: function() {
	    		//$( this ).find( "[type=submit]" ).hide();
	    	},
	    	close: function() {
		        //form[ 0 ].reset();
		        //allFields.removeClass( "ui-state-error" );
			},
	    	autoOpen: false,
	    	height: 400,
	    	width: 500,
	    	modal: true,
	    	buttons: [
	    	{
	    		text: "Cancel",
	            click: function() {
	                $( this ).dialog( "close" );
	            }
	    	}]
	    });
	    $( "#btnEditUser" ).button().on( "click", function() {
	    	dialogUser.dialog( "open" );
	    });
	    $( "#btnUploadSong" ).button().on( "click", function() {
	    	dialog.dialog( "open" );
	    });
	    $("#btnDeleteSong").button().on("click", function(){
	    	var ids = [];
	    	$(".deletDis:checked").each(function(){
	    		ids.push($(this).attr( 'idSong' ));
	    	});
	    	var idSongs = ids.toString();
	    	if (idSongs != "")
	    		window.location.href = "http://localhost:8000/deleteSongs/"+idSongs+"/"+{{$info->idUsuario}};
	    });
	    $( "#btnAddAlbum" ).button().on( "click", function() {
	    	dialogAlbum.dialog( "open" );
	    });
	    $('[data-toggle="tooltip"]').tooltip();
	});
</script>
<div class="container">
	<div class="panel panel-default musicPanel contenido" id="ProfilePage">
		<div class="panel-body">
			<div class="row Profile">
				<div class="col-xs-12 bannerPhoto img-rounded">
					<img src = "{{ $info->fotoBanner }}" width="100%" height="100%"/>

					<div class="col-xs-3 profilePicture">
						<img src = "{{ $info->fotoPerfil }}" width="100%" height="100%" class="img-circle"/>
						<div class="col-xs-4 inputPhotoProfile">
							<form action="/editProfilePicture" method="post" enctype="multipart/form-data" id="ProfilePhotoForm">
								{{ csrf_field() }}
								<input accept=".jpg" type="file" name="fileFoto" id="ProfilePhoto" class="filecamera" accept="image/*"/>
								<label for="ProfilePhoto" class="labelcamera"> <span class="glyphicon glyphicon-camera"></span></label>
								<input type="hidden" value="profile"/>
							</form>
						</div>
					</div>

					<div class="col-xs-1 inputPhotoBanner">

						<form action="/editCoverPicture" method="post" enctype="multipart/form-data" id="BannerPhotoForm">
							{{ csrf_field() }}
							<input accept=".jpg" type="file" name="fileCover" id="filecamera" class="filecamera" accept="image/*"/>
							<label for="filecamera" class="labelcamera"> <span class="glyphicon glyphicon-camera"></span></label>
						</form>

					</div>
				</div>

				<div class="col-xs-12 Options">
						<ul class="ListOptionsProfile">
							<li class="col-xs-2">
								<div>
								</div>
							</li>

							<li class="col-xs-2 activeLink">
								<div>
									<a> My Songs </a>
								</div>
							</li>

							<li class="col-xs-2">
								<div>
									<a> My Albums </a>
								</div>
							</li>

							<li class="col-xs-2">
								<div>
									<a> Subscribers </a>
								</div>
							</li>

							<li class="col-xs-2">
								<div>
									<a> Subscriptions </a>
								</div>
							</li>

							<li class="col-xs-2">
								<div>
								</div>
							</li>
						</ul>	
				</div>

				<div class="col-xs-12 everythingElse">
					<div class="col-xs-12 uploadButtons">
						<div class="col-xs-4">
						</div>

						<div class="col-xs-8">
							<button type="button" class="btn" id="btnUploadSong">
	         					<span class="glyphicon glyphicon-upload"></span> Upload Song
	        				</button>

	        				<button type="button" class="btn" id="btnDeleteSong">
	         					<span class="glyphicon glyphicon-trash"></span> Delete Songs
	        				</button>

	        				<button type="button" class="btn" id="btnAddAlbum">
	         					<span class="glyphicon glyphicon-plus"></span> Add Album
	        				</button>
						</div>
						
					</div>
					<div class="col-xs-3 editProfile">

						<button type="button" class="btn btn-sm" id="btnEditUser">
          					<span class="glyphicon glyphicon-pencil"></span> Edit 
        				</button>

						<label class="text-center"> <span class="glyphicon glyphicon-user"></span> Personal Information: </label>

						<form class="editProfileForm">

						<div class="form-group">
							<label>Email address:</label>
							<p class="form-control-static">{{ $info->correoElectronico }}</p>
						</div>

						<div class="form-group">
							<label>Username:</label>
							<p class="form-control-static">{{ $info->nombreUsuario }}</p>
						</div>

						<div class="form-group">
							<label>Full Name:</label>
							<p class="form-control-static">{{ $info->nombreCompleto }}</p>
						</div>

						<div class="form-group">
							<label>Country:</label>
							<p class="form-control-static">{{ $info->nombrePais }}</p>
						</div>

						</form>
					</div>

					<div class="col-xs-7 listOfThings">
					
					@foreach ($songs as $song)
						@component('userSongComponent', ['id' => $song->idCancion, 'title' => $song->tituloCancion, 'author' => $song->nombreUsuario, 'album' => $song->tituloAlbum, 'description' => $song->descripcion, 'price' => $song->precio, 'image' => $song->fotoAlbum, 'idUser' => $song->idUsuario, 'genre' => $song->nombreGenero, 'idGenre' => $song->idGenero, 'idAlbum' => $song->idAlbum, 'albums' => $albums, 'genres' => $genres, 'idUser' => $info->idUsuario])
						@endcomponent
					@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="dialog-form" title="Upload a Song">
	<p class="validateTips">All form fields are required.</p>
  	<form id="addSong" action="/addSong" method="POST" enctype="multipart/form-data">
    	<fieldset>
    		<input type="hidden" name="idUser" id="idUser" value="{{$info->idUsuario}}">
    		{{ csrf_field() }}
    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon-headphones" data-toggle="tooltip" title="Title"></span>
		      	<input type="text" name="titleSong" id="titleSong" class="form-control text ui-widget-content ui-corner-all">
    		</div>
    		<br>
    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon-align-justify" data-toggle="tooltip" title="Description"></span>
		      	<input type="text" name="descSong" id="descSong" class="form-control text ui-widget-content ui-corner-all">
    		</div>
    		<br>
    		<label for="fileSong">File: </label>
    		<label><input type="file" name="fileSong" id="fileSong" class=""></label>
    		<br><br>
    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon glyphicon-cd" data-toggle="tooltip" title="Album"></span>
		      	<select name="albumSong" id="albumSong" class="form-control">
	    			@foreach ($albums as $album)
	    				<option value="{{ $album->idAlbum }}">{{ $album->tituloAlbum }}</option>
	    			@endforeach
			    </select>
    		</div>
    		<br>
    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon-equalizer" data-toggle="tooltip" title="Genre"></span>
		      	<select name="genreSong" id="genreSong" class="form-control">
	    			@foreach ($genres as $genre)
	    				<option value="{{ $genre->idGenero }}">{{ $genre->nombreGenero }}</option>
	    			@endforeach
			    </select>
    		</div>
    		<br>
      		<button type="submit" class="btn-success" style="height: 30px; border:none; border-radius: 20px;">
      		<span class="glyphicon glyphicon-upload"></span>Upload Song</button>
    	</fieldset>
  	</form>
</div>
<div id="dialog-formAlbum" title="Add Album">
	<p class="validateTips">All form fields are required.</p>
  	<form id="addAlbum" action="/addAlbum" method="POST" enctype="multipart/form-data">
    	<fieldset>
    		<input type="hidden" name="idUser" id="idUser" value="{{$info->idUsuario}}">
    		{{ csrf_field() }}
    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon-headphones" data-toggle="tooltip" title="Title"></span>
		      	<input type="text" name="titleAlbum" id="titleAlbum" class="form-control text ui-widget-content ui-corner-all">
    		</div>
    		<br>
    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon-usd" data-toggle="tooltip" title="Price"></span>
		      	<input type="text" name="priceAlbum" id="priceAlbum" class="form-control text ui-widget-content ui-corner-all">
    		</div>
    		<br>
    		<label for="fileAlbum">File: </label>
    		<label><input type="file" name="fileAlbum" id="fileAlbum" class=""></label>
    		<br><br>
    		<button type="submit" class="btn-success" style="height: 30px; border:none; border-radius: 20px;">
      		<span class="glyphicon glyphicon-plus"></span>Add Album</button>
    	</fieldset>
  	</form>
</div>
<div id="dialog-formEdit" title="Edit Information">
	<p class="validateTips">All form fields are required.</p>
  	<form id="editUser" action="/editUser" method="POST" enctype="multipart/form-data">
    	<fieldset>
    		<input type="hidden" name="idUser" id="idUser" value="{{$info->idUsuario}}">
    		{{ csrf_field() }}
    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon-user" data-toggle="tooltip" title="Username"></span>
		      	<input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control text ui-widget-content ui-corner-all" value="{{ $info->nombreUsuario }}" disabled>
    		</div>
    		<br>
    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon-envelope" data-toggle="tooltip" title="Email address"></span>
		      	<input type="text" name="correoElectronico" id="correoElectronico" class="form-control text ui-widget-content ui-corner-all" value="{{ $info->correoElectronico }}" disabled>
    		</div>
    		<br>
    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon-text-color" data-toggle="tooltip" title="Full Name"></span>
		      	<input type="text" name="nombreCompleto" id="nombreCompleto" class="form-control text ui-widget-content ui-corner-all" value="{{ $info->nombreCompleto }}">
    		</div>
    		<br>
    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon-sunglasses" data-toggle="tooltip" title="Password"></span>
		      	<input type="password" name="contraseña" id="contraseña" class="form-control text ui-widget-content ui-corner-all" value="{{ $info->contraseña }}">
    		</div>
    		<br>
    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon-globe" data-toggle="tooltip" title="Country"></span>
		      	<select name="countryUser" id="countryUser" class="form-control">
	    			@foreach ($countries as $country)
	    				<option value="{{ $country->idPais }}">{{ $country->nombrePais }}</option>
	    			@endforeach
			    </select>
    		</div>
    		<br>
    		<button type="submit" class="btn-success" style="height: 30px; border:none; border-radius: 20px;">
      		<span class="glyphicon glyphicon-pencil"></span>Edit Information</button>
    	</fieldset>
  	</form>
</div>
@endsection
