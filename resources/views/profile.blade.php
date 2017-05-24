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
	function uploadSong() {
		alert('JEJ');
	}
	$(document).ready(function() {
		dialog = $( "#dialog-form" ).dialog( {
	    	autoOpen: false,
	    	height: 400,
	    	width: 350,
	    	modal: true,
	    	buttons: {
	        	"Upload Song": uploadSong,
	        	Cancel: function() {
	        		dialog.dialog( "close" );
	        	}
	    	},
	    	close: function() {
	        //form[ 0 ].reset();
	        //allFields.removeClass( "ui-state-error" );
			}
	    });
	    form = dialog.find( "form" ).on( "submit", function( event ) {
	    	event.preventDefault();
	    	//hacer el upload
	    	alert('usuario :O');
	    });
	    $( "#btnUploadSong" ).button().on( "click", function() {
	    	dialog.dialog( "open" );
	    });
	});
</script>
<div class="container">
	<div class="panel panel-default musicPanel contenido" id="ProfilePage">
		<div class="panel-body">
			<div class="row Profile">
				<div class="col-xs-12 bannerPhoto img-rounded">
					<img src = "../images/defaultBanner.jpg" width="100%" height="100%"/>

					<div class="col-xs-3 profilePicture">
						<img src = "../images/defaultUser.png" width="100%" height="100%" class="img-circle"/>
						<div class="col-xs-4 inputPhotoProfile">
							<input accept=".jpg" type="file" name="filecamera" id="filecamera" class="filecamera" accept="image/*"/>
							<label for="filecamera" class="labelcamera"> <span class="glyphicon glyphicon-camera"></span></label>
						</div>
					</div>

					<div class="col-xs-1 inputPhotoBanner">
						<input accept=".jpg" type="file" name="filecamera" id="filecamera" class="filecamera" accept="image/*"/>
						<label for="filecamera" class="labelcamera"> <span class="glyphicon glyphicon-camera"></span></label>
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

						<div class="col-xs-4">
							<button type="button" class="btn" id="btnUploadSong">
	         					<span class="glyphicon glyphicon-upload"></span> Upload Song
	        				</button>

	        				<button type="button" class="btn">
	         					<span class="glyphicon glyphicon-trash"></span> Delete Songs
	        				</button>
						</div>
						
					</div>
					<div class="col-xs-3 editProfile">

						<button type="button" class="btn btn-sm">
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
						@component('userSongComponent', ['id' => $song->idCancion, 'title' => $song->tituloCancion, 'author' => $song->nombreUsuario, 'album' => $song->tituloAlbum, 'description' => $song->descripcion, 'price' => $song->precio, 'image' => $song->fotoAlbum, 'idUser' => $song->idUsuario, 'genre' => $song->nombreGenero, 'idAlbum' => $song->idAlbum])
						@endcomponent
					@endforeach
					</div>

					<button id="create-user">Create new user</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="dialog-form" title="Upload a Song">
	<p class="validateTips">All form fields are required.</p>
  	<form>
    	<fieldset>
      		<label for="name">Name</label>
      		<input type="text" name="name" id="name" value="Jane Smith" class="text ui-widget-content ui-corner-all">
      		<label for="email">Email</label>
		    <input type="text" name="email" id="email" value="jane@smith.com" class="text ui-widget-content ui-corner-all">
		    <label for="password">Password</label>
		    <input type="password" name="password" id="password" value="xxxxxxx" class="text ui-widget-content ui-corner-all">
 
      		<!-- Allow form submission with keyboard without duplicating the dialog button -->
      		<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    	</fieldset>
  	</form>
</div>
@endsection
