<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function profileUser($user)
    {
		$info = DB::table('Usuario')
		->join('Pais', 'Usuario.idPais', '=', 'Pais.idPais')
		->select('Usuario.*', 'Pais.nombrePais')
		->where('Usuario.idUsuario', '=', $user)
		->first();
		$songs = $this->songsUser($user);
        return view('profile', ['info' => $info, 'songs' => $songs]);
    }

    public function songsUser($user)
    {
    	$songs = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->join('Genero', 'Genero.idGenero', '=', 'Cancion.idGenero')
		->select('Cancion.*', 'Album.idAlbum', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Album.precio', 'Usuario.nombreUsuario', 'Usuario.idUsuario', 'Genero.nombreGenero')
		->where('Usuario.idUsuario', '=', $user)
		->orderby('fechaPublicacion', 'desc')
		->limit(20)
		->get();
        return $songs;
    }
}
