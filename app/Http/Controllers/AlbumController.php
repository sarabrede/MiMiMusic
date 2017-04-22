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
		->select('Album.*', 'Usuario.nombreUsuario', DB::raw("count(Cancion.tituloCancion) as count"))
		->whereIn('Album.idAlbum', $shopping)
		->groupby('Album.idAlbum', 'Album.fotoAlbum', 'Album.añoAlbum', 'Album.tituloAlbum', 'Album.idUsuario', 'Album.activo', 'Album.precio', 'Usuario.nombreUsuario')
		->get();
	    return view('cart', ['albums' => $albums]);
	}
}
