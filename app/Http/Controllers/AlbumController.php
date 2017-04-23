<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AlbumController extends Controller
{
    public function shopAlbum($shopping = array())
	{
		$albums = DB::table('Album')
		->join('Cancion', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->select('Album.*', 'Usuario.nombreUsuario', 'Usuario.idUsuario', DB::raw("count(Cancion.tituloCancion) as count"))
		->whereIn('Album.idAlbum', $shopping)
		->groupby('Album.idAlbum', 'Album.fotoAlbum', 'Album.añoAlbum', 'Album.tituloAlbum', 'Album.idUsuario', 'Album.activo', 'Album.precio', 'Usuario.nombreUsuario', 'Usuario.idUsuario')
		->get();
	    return view('cart', ['albums' => $albums]);
	}

	public function getSong($idAlbum)
	{
		$album = DB::table('Album')
		->join('Cancion', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->select('Cancion.*')
		->where('Album.idAlbum', $idAlbum)
		->get();
		$idSong = $album[0]->idCancion;
		$song = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->join('Genero', 'Genero.idGenero', '=', 'Cancion.idGenero')
		->select('Cancion.*', 'Album.idAlbum', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Album.precio', 'Usuario.nombreUsuario', 'Usuario.idUsuario', 'Genero.nombreGenero')
		->where('Cancion.idCancion', '=', $idSong)
		->first();
		$idAlbum = $song->idAlbum;
		$comments = DB::table('UsuarioComentaCancion')
		->join('Usuario', 'UsuarioComentaCancion.idUsuario', '=', 'Usuario.idUsuario')
		->select('UsuarioComentaCancion.*', 'Usuario.nombreUsuario')
		->where('idCancion', '=', $idSong)
		->get();
    	return view ('song', ['song' => $song, 'album' => $album, 'idSong' => $idSong, 'comments' => $comments]);
	}
}
