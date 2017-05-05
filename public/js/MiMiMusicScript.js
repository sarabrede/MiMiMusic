$(document).ready(function() {

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
			 	var height = $(this).height();
			 	var scrollHeight = $(this)[0].scrollHeight;
        	 	var st = $(this).scrollTop();
        	 	console.log(st >= scrollHeight - height);
			});
			

		/*Index*/
			$(".nav-pills a").click(function() {
				$(".nav-pills li").each(function() {
					$(this).removeClass("active");
				});

				$(this).addClass("active");
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

	
});
