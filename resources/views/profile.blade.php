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
				<img src = "../images/song.jpg" width="100%" height="100%"/>
					<div class="col-xs-3 profilePicture">
						<img src = "../images/song.jpg" width="100%" height="100%" class="img-circle"/>
					</div>
				</div>

				<div class="col-xs-12 Options">

				</div>
			</div>
		</div>
	</div>
</div>
@endsection