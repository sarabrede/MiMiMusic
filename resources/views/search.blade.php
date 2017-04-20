@extends('master')

@section('title', 'Search')


@section('content')
<div class="container">
	<div class="panel panel-default musicPanel contenido">
		<div class="panel-body">

		<div class="row searchRow">
		<div class ="col-xs-8 SearchPanel">
			<div class ="col-xs-3">
			<button type="button" class="btn btnFilter" style="width: 100%"> Filter <span class="caret"> </span> </button>
			</div>
			
			@for ($i = 0; $i < 4; $i++)
			    @component('searchComponent')
			    @endcomponent
			@endfor

			<div class ="col-xs-11 SearchResult">
				<div class="col-xs-5 imageFrame">
					<img src="audios/AlbumImages/07.jpg" width="100%" height="100%" class="img-rounded"/>
				</div>
				<div class="col-xs-4 infoResult">
					<a> Título de la canción </a> 
					<br>
					<a> Título albúm </a>
					<br>
					<a> nombreUsuario </a>
					<p> descripción </p>
				</div>
				<div class="col-xs-1 infoResult">
					
				</div>
			</div>

			
			<div class ="col-xs-11 SearchResult">
				<div class="col-xs-5 imageFrame">
					<img src="audios/AlbumImages/default.jpg" width="100%" height="100%" class="img-rounded"/>
				</div>
				<div class="col-xs-4 infoResult">
					<a> Título de la canción </a> 
					<br>
					<a> Título albúm </a>
					<br>
					<a> nombreUsuario </a>
					<p> descripción </p>
				</div>
				<div class="col-xs-1 infoResult">
					<p> $20.0 </p>
				</div>
			</div>

		
			
		</div>

				 <div class="col-xs-4 SearchPills">
			      <ul class="nav nav-tabs nav-stacked">
			        <li><a href="#" class="songsSearch activePill" >Songs</a></li>
			        <li><a href="#" class="albumSearch" >Albums</a></li>
			        <li><a href="#" class="userSearch" >Users</a></li>
			      </ul>
			    </div>
			   </div>
			</div>
	</div>
</div>
@endsection

