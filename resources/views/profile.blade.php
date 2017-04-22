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
					<div class="col-xs-3 editProfile">

						<button type="button" class="btn btn-sm">
          					<span class="glyphicon glyphicon-pencil"></span> Edit 
        				</button>

						<label class="text-center"> <span class="glyphicon glyphicon-user"></span> Personal Information: </label>

						<form class="editProfileForm">

						<div class="form-group">
							<label>Email address:</label>
							<p class="form-control-static">email@example.com</p>
						</div>

						<div class="form-group">
							<label>Username:</label>
							<p class="form-control-static">nombreusuario</p>
						</div>

						<div class="form-group">
							<label>Full Name:</label>
							<p class="form-control-static">Nombre Completo</p>
						</div>

						<div class="form-group">
							<label>Country:</label>
							<p class="form-control-static">Mexico</p>
						</div>

						</form>
					</div>

					<div class="col-xs-7 listOfThings">
					
					@for($i = 0; $i < 3; $i++)
						@component('searchComponent', ['id' => '1', 'title' => 'Título de la canción', 'author' => 'nombreUsuario', 'album' => 'Título del album', 'description' => 'descripcion', 'price' => '0', 'image' => '../audioImages/default.jpg'])
						@endcomponent
					@endfor
					</div>

					<div class="uploadButtons">
						<button type="button" class="btn">
         					<span class="glyphicon glyphicon-upload"></span> Upload Song
        				</button>

        				<button type="button" class="btn">
         					<span class="glyphicon glyphicon-trash"></span> Delete Songs
        				</button>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
