<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comentario;
use App\Http\Controllers\Controller;
use DB;

class CommentController extends Controller
{
    public function addComment($idSong, $comentar)
    {
    	$comentario = new Comentario;
    	$comentario->fechaComentario = \Carbon\Carbon::now();
    	$comentario->comentario = $comentar;
    	$comentario->idUsuario = $idUser = session('idUser');
    	$comentario->idCancion = $idSong;

    	$comentario->save();

    	$newComment = DB::table('UsuarioComentaCancion')
    	->join('Usuario', 'UsuarioComentaCancion.idUsuario', '=', 'Usuario.idUsuario')
		->select('UsuarioComentaCancion.*', 'Usuario.nombreUsuario')
		->where('idComentario', '=', $comentario->idComentario)
		->get();

		return response()->json($newComment);
 
    }
}
