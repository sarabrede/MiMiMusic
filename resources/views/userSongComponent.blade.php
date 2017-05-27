<script type="text/javascript">
	$(document).ready(function() {
		dialog{{ $id }} = $( "#dialog-form{{ $id }}" ).dialog({
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
	    form = dialog{{ $id }}.find( "form" ).on( "submit", function( event ) {
	    	//event.preventDefault();
	    	//hacer el upload
	    	//dialog.submit();
	    });
	    $( "#btnEditSong{{ $id }}" ).button().on( "click", function() {
	    	dialog{{ $id }}.dialog( "open" );
	    });
	});
</script>

<div class ="col-xs-11 SearchResult">
	<div class="col-xs-4 imageFrame">
		<img src="{{ asset($image) }}" width="100%" height="100%" class="img-rounded"/>
	</div>
				
	<div class="col-xs-5 infoResult">
		<a href="{{ url('song') }}/{{ $id }}"> {{ $title }} </a> 
		<br>
		<a href="{{ url('album') }}/{{ $idAlbum }}"> {{ $album }} </a>
		<br>
		<label>{{ $genre }}</label>
		<br>
		<a href="{{ url('profile') }}/{{ $idUser }}"> {{ $author }} </a>
		<p> {{ $description }} </p>
	</div>
	<div class="col-xs-2 infoResult pull-right">
		<div class="col-xs-12 text-center">
			<p> {{ ($price > 0) ? '$'.$price : 'Free'}} </p>
		</div>
		<div class="col-xs-6">
			<button type="button" class="btn btn-sm btnEditSong" id="btnEditSong{{ $id }}">
          		<span class="glyphicon glyphicon-pencil"></span> 
        	</button>
		</div>
		<div class="col-xs-6" >
		   <input type="checkbox" class="deletDis" idSong="{{ $id }}" value="None"  id="roundedTwo" name="check"/>
		</div>
	</div>
</div>

<div id="dialog-form{{ $id }}" title="Edit Song">
	<p class="validateTips">All form fields are required.</p>
  	<form id="editSong" action="/editSong/{{ $id }}" method="POST" enctype="multipart/form-data">
    	<fieldset>
    		<input type="hidden" name="idUser" id="idUser" value="{{ $idUser }}">
    		{{ csrf_field() }}

    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon-headphones" data-toggle="tooltip" title="Title"></span>
		      	<input type="text" name="titleSong" id="titleSong" class="form-control text ui-widget-content ui-corner-all" value="{{ $title }}">
    		</div>
    		<br>
    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon-align-justify" data-toggle="tooltip" title="Description"></span>
		      	<input type="text" name="descSong" id="descSong" class="form-control text ui-widget-content ui-corner-all" value="{{ $description }}">
    		</div>
    		<br>
    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon glyphicon-cd" data-toggle="tooltip" title="Album"></span>
		      	<select name="albumSong" id="albumSong" class="form-control">
	    			@foreach ($albums as $album)
	    				<option value="{{ $album->idAlbum }}" {{ ($album->idAlbum == $idAlbum) ? 'selected' : '' }}>{{ $album->tituloAlbum }}</option>
	    			@endforeach
			    </select>
    		</div>
    		<br>
    		<div class="input-group">
    			<span class="input-group-addon glyphicon glyphicon-equalizer" data-toggle="tooltip" title="Genre"></span>
		      	<select name="genreSong" id="genreSong" class="form-control">
	    			@foreach ($genres as $genre)
	    				<option value="{{ $genre->idGenero }}" {{ ($genre->idGenero == $idGenre) ? 'selected' : '' }}>{{ $genre->nombreGenero }}</option>
	    			@endforeach
			    </select>
    		</div>
    		<br>
      		<button type="submit" class="btn-success" style="height: 30px; border:none; border-radius: 20px;">
      		<span class="glyphicon glyphicon-pencil"></span>Edit Song</button>
    	</fieldset>
  	</form>
</div>
