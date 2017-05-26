$(document).ready(function() {
var recarga = false;
var tipoPill = "popular";


	/*Poner el scrollbar a la lista de canciones*/
		$(".prfctScrollBar").perfectScrollbar();

	/*Landing Page*/ 
		$("#newHere").click(function() {
			$(".formLogIn").fadeOut("slow", function()
				{
					$(this).css("display", "none");
					$(".loginPanel").css("paddingTop", "1%");
					$(".formSignUp").fadeIn("slow");
				});
		});

		$("#account").click(function(){
			$(".formSignUp").fadeOut("slow", function()
				{
					$(this).css("display", "none");
					$(".loginPanel").css("paddingTop", "4%");
					$(".formLogIn").fadeIn("slow");
				});
		});

		/*Detectar si es el final del contenedor*/
			$("#landingPanel").scroll(function() {
			 	var height = $(this).outerHeight();
			 	var scrollHeight = $(this)[0].scrollHeight;
        	 	var st = $(this).scrollTop();

        	 	if( (st + height >= scrollHeight) && !recarga)
        	 	{
        	 		recarga = true;

        	 		var number = $("#landingPanel .amazingaudioplayer").length;

        	 		 $.ajax({
        	 		 	type: "GET",
        	 		 	url: "/rechargeLandingPage/" + number,
        	 		 	contentType: "application/json",
        	 		 	dataType: "json",
        	 		 	data:'_token = <?php echo csrf_token() ?>',

        	 		 	success: function(data)
						{
							for(var i = number; i < data.length; i++)
							{
								var htmltoAppend = appendPlayer(data[i].nombreUsuario, data[i].tituloCancion, data[i].tituloAlbum, data[i].descripcion, data[i].fotoAlbum,data[i].rutaCancion);
								$(".landingPageSongs").append(htmltoAppend);
							}

							initReproductor();
						    recarga = false;
						}
        	 		 });
        	 	}
			});
			

		/*Index*/
			$(".nav-pills a").click(function(event) {
				event.preventDefault();

				$(".nav-pills li").each(function() {
					$(this).removeClass("active");
				});

				$(this).parent().addClass("active");

				tipoPill = $(this).parent().prop("type");

				if(tipoPill == "nuevo" && !recarga)
        	 	{
        	 		recarga = true;

    	 		 	$.ajax({
    	 		 	type: "GET",
    	 		 	url: "/rechargeLandingPage/0",
    	 		 	contentType: "application/json",
    	 		 	dataType: "json",
    	 		 	data:'_token = <?php echo csrf_token() ?>',

    	 		 	success: function(data)
					{
						var htmltoAppend = "";
						for(var i = 0; i < data.length; i++)
						{
							 htmltoAppend += appendPlayer(data[i].nombreUsuario, data[i].tituloCancion, data[i].tituloAlbum, data[i].descripcion, data[i].fotoAlbum,data[i].rutaCancion);
						}

						console.log(htmltoAppend);
						$(".rowContent").html(htmltoAppend);

					    initReproductor();
					    recarga = false;
					}
    	 		 });
        	 	}


                if(tipoPill == "popular" && !recarga)
                {
                    recarga = true;

                    $.ajax({
                    type: "GET",
                    url: "/index/popularity/0",
                    contentType: "application/json",
                    dataType: "json",
                    data:'_token = <?php echo csrf_token() ?>',

                    success: function(data)
                    {
                        var htmltoAppend = "";
                        for(var i = 0; i < data.length; i++)
                        {
                             htmltoAppend += appendPlayer(data[i].nombreUsuario, data[i].tituloCancion, data[i].tituloAlbum, data[i].descripcion, data[i].fotoAlbum,data[i].rutaCancion);
                        }

                        console.log(htmltoAppend);
                        $(".rowContent").html(htmltoAppend);

                        initReproductor();
                        recarga = false;
                    }
                    });
                }

                if(tipoPill == "suscripciones" && !recarga)
                {
                    recarga = true;

                    var idUser = $("#idUserHidden").text();

                    $.ajax({
                    type: "GET",
                    url: "/index/subscribers/" + idUser + "/0",
                    contentType: "application/json",
                    dataType: "json",
                    data:'_token = <?php echo csrf_token() ?>',

                    success: function(data)
                    {
                        var htmltoAppend = "";
                        for(var i = 0; i < data.length; i++)
                        {
                             htmltoAppend += appendPlayer(data[i].nombreUsuario, data[i].tituloCancion, data[i].tituloAlbum, data[i].descripcion, data[i].fotoAlbum,data[i].rutaCancion);
                        }

                        console.log(htmltoAppend);
                        $(".rowContent").html(htmltoAppend);

                        initReproductor();
                        recarga = false;
                    }
                    });
                }

			});

			$("#IndexScrollPanel").scroll(function() {
			 	var height = $(this).outerHeight();
			 	var scrollHeight = $(this)[0].scrollHeight;
        	 	var st = $(this).scrollTop();

        	 	if( (st + height >= scrollHeight) && !recarga)
        	 	{
        	 		recarga = true;
        	 		var number = $("#IndexScrollPanel .amazingaudioplayer").length;

        	 		if(tipoPill == "nuevo")
        	 		{
        	 		 $.ajax({
        	 		 	type: "GET",
        	 		 	url: "/rechargeLandingPage/" + number,
        	 		 	contentType: "application/json",
        	 		 	dataType: "json",
        	 		 	data:'_token = <?php echo csrf_token() ?>',

        	 		 	success: function(data)
						{
							for(var i = number; i < data.length; i++)
							{
								var htmltoAppend = appendPlayer(data[i].nombreUsuario, data[i].tituloCancion, data[i].tituloAlbum, data[i].descripcion, data[i].fotoAlbum,data[i].rutaCancion);
								$(".rowContent").append(htmltoAppend);
							}

						    initReproductor();
						    recarga = false;
						}
        	 		 });
        	 		}

                    if(tipoPill == "popular")
                    {
                     $.ajax({
                        type: "GET",
                        url: "/index/popularity/" + number,
                        contentType: "application/json",
                        dataType: "json",
                        data:'_token = <?php echo csrf_token() ?>',

                        success: function(data)
                        {
                            for(var i = number; i < data.length; i++)
                            {
                                var htmltoAppend = appendPlayer(data[i].nombreUsuario, data[i].tituloCancion, data[i].tituloAlbum, data[i].descripcion, data[i].fotoAlbum,data[i].rutaCancion);
                                $(".rowContent").append(htmltoAppend);
                            }

                            initReproductor();
                            recarga = false;
                        }
                     });
                    }

                     if(tipoPill == "suscripciones")
                    {
                     $.ajax({
                        type: "GET",
                        url: "/index/subscribers/" + idUser + "/" + number,
                        contentType: "application/json",
                        dataType: "json",
                        data:'_token = <?php echo csrf_token() ?>',

                        success: function(data)
                        {
                            for(var i = number; i < data.length; i++)
                            {
                                var htmltoAppend = appendPlayer(data[i].nombreUsuario, data[i].tituloCancion, data[i].tituloAlbum, data[i].descripcion, data[i].fotoAlbum,data[i].rutaCancion);
                                $(".rowContent").append(htmltoAppend);
                            }

                            initReproductor();
                            recarga = false;
                        }
                     });
                    }
        	 	}
			});


	/*Perfil*/ 
	
		/*Mover la página de perfil un poco, más abajo del banner*/
		var totalToMove = ($("#ProfilePage").height()) / 5;

		$("#ProfilePage").scrollTop(totalToMove);

		/*Hover para que aparezca y desaparezca la camarita en la foto de perfil*/
		$(".profilePicture").mouseover(function(){
			$(".inputPhotoProfile").addClass("hoverOverPhoto");
		});

		$(".profilePicture").mouseout(function(){
			$(".inputPhotoProfile").removeClass("hoverOverPhoto");
		});

	/*Song*/

    $(".btnLove").click(function() {
        var id = $("#idSongPage").val();

        if($(this).hasClass("btnUsed"))
        {
            $.ajax({
            type: "GET",
            url: "/song/" + id +"/deletefavorite",
            contentType: "application/json",
            dataType: "json",
            data:'_token = <?php echo csrf_token() ?>'
            });

            $(this).removeClass("btnUsed"); 
        }
        else
        {
           $.ajax({
            type: "GET",
            url: "/song/" + id +"/favorite",
            contentType: "application/json",
            dataType: "json",
            data:'_token = <?php echo csrf_token() ?>'
            });

            $(this).addClass("btnUsed"); 
        }

        
    });

    $("#btnComment").click(function() {
        var id = $("#idSongPage").val();
        var comment = $("#taComment").val();

        $.ajax({
            type: "GET",
            url: "/song/comment/" + id +"/" + comment,
            contentType: "application/json",
            dataType: "json",
            data:'_token = <?php echo csrf_token() ?>',
            success: function(data)
            {
                var htmltoAppend = "<div class='col-xs-12 comment'>" +
                "<div class='col-xs-2'>" + "<img src='../images/defaultUser.png' width='100%' " +
                "height='100%' class='img-circle'/>" + "</div> <div class='col-xs-7'>" + 
                "<a href=/profile/" + data[0].idUsuario + "' target='_blank'>" +
                data[0].nombreUsuario + "</a> <p>" + data[0].comentario + "</p> </div>" +
                "<div class='col-xs-2 text-right dateOfComment'> <p> " +
                data[0].fechaComentario + "</p> </div> </div>" +
                "<div class='col-xs-12 lineParent'> <div class='col-xs-2'>" +
                "</div> <div class='col-xs-8 line'> </div> </div>";

                var cuenta = $(".comment").length;
                if(cuenta == 0)
                {
                    $(".commentPanel").append(htmltoAppend);
                }
                else
                {
                    $(".comment").eq(0).before(htmltoAppend);
                }

                $("#taComment").val("");
            }
        });
    });


    /*Búsqueda*/

    $(".SearchPills a").click(function(event) {
        event.preventDefault();

        $(".SearchPills a").each(function() {
            $(this).removeClass("activePill");
        });

        $(this).addClass("activePill");

        var busqueda = $("#searchParam").val();

        /*var htmltoAppend = "<div class ='col-xs-3'> <button type='button'" + 
        "class='btn btnFilter' style='width: 100%'> Filter <span class='caret'>" +
        "</span> </button> </div>"; */

        var htmltoAppend = "";
        var error = "<p> Sorry, we didn't find anything. </p>";

        if($(this).hasClass("songsSearch") && !recarga)
        {
            $.ajax({
                type: "GET",
                url: "/search/songs/" + busqueda,
                contentType: "application/json",
                dataType: "json",
                data:'_token = <?php echo csrf_token() ?>',

                success: function(data)
                {
                    for(var i = 0; i < data.length; i++)
                    {
                        htmltoAppend += appendSearchComponent(data[i].fotoAlbum, data[i].tituloCancion, data[i].tituloAlbum, data[i].nombreGenero, data[i].nombreUsuario, data[i].descripcion, data[i].precio, data[i].idCancion, data[i].idAlbum, data[i].idUsuario);
                    }

                    if(htmltoAppend === "")
                    {
                        htmltoAppend = error;
                    }

                    $(".SearchPanel").html(htmltoAppend);
                    recarga = false;
                }
             });
        }

        else if($(this).hasClass("albumSearch") && !recarga)
        {

            $.ajax({
                type: "GET",
                url: "/search/albums/" + busqueda,
                contentType: "application/json",
                dataType: "json",
                data:'_token = <?php echo csrf_token() ?>',

                success: function(data)
                {
                    for(var i = 0; i < data.length; i++)
                    {
                        htmltoAppend += appendSearchComponent(data[i].fotoAlbum, data[i].tituloCancion, data[i].tituloAlbum, data[i].nombreGenero, data[i].nombreUsuario, data[i].descripcion, data[i].precio, data[i].idCancion, data[i].idAlbum, data[i].idUsuario);
                    }

                    if(htmltoAppend === "")
                    {
                        htmltoAppend = error;
                    }


                    $(".SearchPanel").html(htmltoAppend);
                    recarga = false;
                }
             });
        }

        else if($(this).hasClass("userSearch") && !recarga)
        {

            $.ajax({
                type: "GET",
                url: "/search/users/" + busqueda,
                contentType: "application/json",
                dataType: "json",
                data:'_token = <?php echo csrf_token() ?>',

                success: function(data)
                {
                    for(var i = 0; i < data.length; i++)
                    {
                        htmltoAppend += appendSearchComponent(data[i].fotoAlbum, data[i].tituloCancion, data[i].tituloAlbum, data[i].nombreGenero, data[i].nombreUsuario, data[i].descripcion, data[i].precio, data[i].idCancion, data[i].idAlbum, data[i].idUsuario);
                    }

                    if(htmltoAppend === "")
                    {
                        htmltoAppend = error;
                    }


                    $(".SearchPanel").html(htmltoAppend);
                    recarga = false;
                }
              });
        }

    });

	
});

function appendPlayer(nombreUsuario, tituloCancion, tituloAlbum, descripcion, fotoAlbum, rutaCancion)
{
	var htmltoAppend = 
	"<div class='col-sm-4 col-xs-12'>" +
	"<div class='thumbnail'>" +
	"<div class='caption'>" +
	"<div class='amazingaudioplayer' style='display:block;position:relative;width:100%;height:auto;margin:0px auto 0px;'>" +
	"<ul class='amazingaudioplayer-audios' style='display:none;'>" +
	"<li data-artist='" + nombreUsuario + "' " +
	"data-title='" + tituloCancion + "' " +
	"data-album='" + tituloAlbum + "' " +
	"data-info='" + descripcion + "' " +
	"data-image='" + fotoAlbum + "' " +
	"data-duration='10'>" + 
	"<div class='amazingaudioplayer-source' data-src='" + rutaCancion + "' " +
	"data-type='audio/mpeg' />" +
	"</li> </ul> </div> </div> </div> </div>";

	return htmltoAppend;
}

function appendSearchComponent(image, title, album, genre, author, description, price, idSong, idAlbum, idUsuario)
{
    var htmltoAppend = "<div class ='col-xs-11 SearchResult'>" +
    "<div class='col-xs-4 imageFrame'>" + 
    "<img src='" + image +"' width='100%' height='100%' class='img-rounded'/> </div>" +
    "<div class='col-xs-5 infoResult'>" +
    "<a href='/song/" + idSong +"' target='_blank'>" + title + "</a> <br>" +
    "<a href='/album/" + idAlbum + "'target='_blank'>" + album + "</a> <br>" +
    "<label>" + genre + "</label><br>" +
    "<a href='/profile/" + idUsuario + "'target='_blank'>" + author + "</a> <p>" + description + "</p> </div>" +
    "<div class='col-xs-2 infoResult pull-right text-center'>"+
    "<p>";

    if(price == 0)
    {
        htmltoAppend += "Free"; 
    }
    else
    {
        htmltoAppend += "$" + price;
    }

    htmltoAppend += "</p> </div> </div>";
    return htmltoAppend;

}


function initReproductor()
{
	var scripts = document.getElementsByTagName("script");
	var jsFolder = "";

    for (var i= 0; i< scripts.length; i++)
    {
        if( scripts[i].src && scripts[i].src.match(/initaudioplayer\.js/i))
            jsFolder = scripts[i].src.substr(0, scripts[i].src.lastIndexOf("/") + 1);
    }


	jQuery(".amazingaudioplayer").amazingaudioplayer({
        jsfolder:jsFolder,
        skinsfoldername:"",
        titleinbarwidthmode:"fixed",
        timeformatlive:"%CURRENT% / LIVE",
        volumeimagewidth:24,
        barbackgroundimage:"",
        showtime:true,
        titleinbarwidth:80,
        showprogress:true,
        random:false,
        titleformat:"%TITLE%",
        height:600,
        loadingformat:"Loading...",
        prevnextimage:"prevnext-24-24-0.png",
        showinfo:true,
        imageheight:100,
        skin:"Jukebox",
        loopimage:"loop-24-24-0.png",
        loopimagewidth:24,
        showstop:true,
        prevnextimageheight:24,
        infoformat:"%ARTIST% %ALBUM%<br />%INFO%",
        stopotherplayers:true,
        showloading:false,
        forcefirefoxflash:false,
        showvolumebar:true,
        imagefullwidth:false,
        width:300,
        showtitleinbar:false,
        showloop:true,
        volumeimage:"volume-24-24-0.png",
        playpauseimagewidth:24,
        loopimageheight:24,
        tracklistitem:10,
        tracklistitemformat:"%ID%. %TITLE% <span style='position:absolute;top:0;right:0;'>%DURATION%</span>",
        prevnextimagewidth:24,
        tracklistarrowimage:"tracklistarrow-48-16-0.png",
        forceflash:false,
        playpauseimageheight:24,
        showbackgroundimage:false,
        imagewidth:100,
        stopimage:"stop-24-24-0.png",
        playpauseimage:"playpause-24-24-0.png",
        forcehtml5:false,
        showprevnext:false,
        backgroundimage:"",
        autoplay:false,
        volumebarpadding:8,
        progressheight:8,
        showtracklistbackgroundimage:false,
        titleinbarscroll:true,
        showtitle:true,
        defaultvolume:100,
        tracklistarrowimageheight:16,
        heightmode:"auto",
        titleinbarformat:"%TITLE%",
        showtracklist:false,
        stopimageheight:24,
        volumeimageheight:24,
        stopimagewidth:24,
        volumebarheight:80,
        noncontinous:false,
        tracklistbackgroundimage:"",
        showbarbackgroundimage:false,
        showimage:true,
        tracklistarrowimagewidth:48,
        timeformat:"%CURRENT% / %DURATION%",
        showvolume:true,
        fullwidth:true,
        loop:1,
        preloadaudio:true
    });

}
