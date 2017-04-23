$(document).ready(function() {

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

	/*Poner el scrollbar a la lista de canciones*/
	$(".prfctScrollBar").perfectScrollbar();
});
