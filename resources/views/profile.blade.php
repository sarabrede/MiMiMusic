@extends('master')

@section('title', 'X\'s Profile')

@section('style')
	.panel-body
	{
		padding-top: 0px;
	}
@endsection

@section('content')
<div class="container">
	<div class="panel panel-default musicPanel contenido">
		<div class="panel-body">
			<div class="row Profile">
				<div class="col-xs-12 bannerPhoto img-rounded">
					<img src = "../images/defaultBanner.jpg" width="100%" height="100%"/>

					<div class="col-xs-3 profilePicture">
						<img src = "../images/defaultUser.png" width="100%" height="100%" class="img-circle"/>
					</div>

					<div class="col-xs-1 inputPhotoBanner">
						<input accept=".jpg" type="file" name="filecamera" id="filecamera" class="filecamera" accept="image/*"/>
						<label for="filecamera" class="labelcamera"> <span class="glyphicon glyphicon-camera"></span></label>
					</div>
				</div>

				<div class="col-xs-12 Options">

				</div>

				<div class="col-xs-12 everythingElse">
					<div class="col-xs-3 editProfile">
					</div>

					<div class="col-xs-7 listOfThings">
					
					@for($i = 0; $i < 3; $i++)
						@component('searchComponent', ['id' => '1', 'title' => 'Título de la canción', 'author' => 'nombreUsuario', 'album' => 'Título del album', 'description' => 'descripcion', 'price' => '0', 'image' => '../audioImages/default.jpg'])
						@endcomponent
					@endfor
					</div>

					<div class="col-xs-2 uploadButtons">
						<button type="button" class="btn"> Upload song </button>
						<button type="button" class="btn"> Create album </button>
					</div> 
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
