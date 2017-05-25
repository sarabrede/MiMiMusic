<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SongController extends Controller
{
	public function landingSongs()
    {
		$songs = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->select('Cancion.*', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Usuario.nombreUsuario')
		->orderby('idCancion', 'desc')
		->limit(6)
		->get();
        return view('landingPage', ['songs' => $songs]);
    }

    public function getSong($idSong)
    {
    	$song = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->join('Genero', 'Genero.idGenero', '=', 'Cancion.idGenero')
		->select('Cancion.*', 'Album.idAlbum', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Album.precio', 'Usuario.nombreUsuario', 'Usuario.idUsuario', 'Genero.nombreGenero')
		->where('Cancion.idCancion', '=', $idSong)
		->first();
		$idAlbum = $song->idAlbum;
		$album = DB::table('Album')
		->join('Cancion', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->select('Cancion.*')
		->where('Album.idAlbum', $idAlbum)
		->get();
		$comments = DB::table('UsuarioComentaCancion')
		->join('Usuario', 'UsuarioComentaCancion.idUsuario', '=', 'Usuario.idUsuario')
		->select('UsuarioComentaCancion.*', 'Usuario.nombreUsuario')
		->where('idCancion', '=', $idSong)
		->get();
    	return view ('song', ['song' => $song, 'album' => $album, 'idSong' => $idSong, 'comments' => $comments]);
    }

	/*public function indexSong($type = 'default', $idUser = 0)
	{
		switch($type)
		{
			case 'default':
				$result = $this->indexSongByPopularity();
				return view('index', ['songs' => $result]);

			case 'popularity':
				$result = $this->indexSongByPopularity();
				break;
			case 'newest':
				$this->indexSongByNewest();
				break;

			case 'subscribers':
				$result = $this->indexSongBySubscribers($idUser);
				break;
		}
		
	}*/

	public function indexSongByPopularity()
    {
		$songs = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->join('Genero', 'Genero.idGenero', '=', 'Cancion.idGenero')
		->select('Cancion.*', 'Album.idAlbum', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Album.precio', 'Usuario.nombreUsuario', 'Usuario.idUsuario', 'Genero.nombreGenero')
		->orderby('visitas', 'desc')
		->limit(6)
		->get();
        return view('index', ['songs' => $songs]);
    }

    public function indexSongByPopularityAjax($number)
    {
    	$number += 6;

		$songs = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->join('Genero', 'Genero.idGenero', '=', 'Cancion.idGenero')
		->select('Cancion.*', 'Album.idAlbum', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Album.precio', 'Usuario.nombreUsuario', 'Usuario.idUsuario', 'Genero.nombreGenero')
		->orderby('visitas', 'desc')
		->limit($number)
		->get();

       return response()->json($songs);
    }

   /* public function indexSongByNewest()
    {
		$songs = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->join('Genero', 'Genero.idGenero', '=', 'Cancion.idGenero')
		->select('Cancion.*', 'Album.idAlbum', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Album.precio', 'Usuario.nombreUsuario', 'Usuario.idUsuario', 'Genero.nombreGenero')
		->orderby('idCancion', 'desc')
		->limit(6)
		->get();
		
       return response()->json($songs);
    }*/

    public function indexSongBySubscribers($id)
    {
    	$suscripcions = DB::table('usuariosuscribeusuario')
    	->select('Suscripcion')
    	->where('Suscriptor', '=', $id)
    	->get();
    	$search = array();
    	foreach ($suscripcions as $suscripcion) {
    		$search[] = $suscripcion->Suscripcion;
    	}
    	$songs = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->join('Genero', 'Genero.idGenero', '=', 'Cancion.idGenero')
		->select('Cancion.*', 'Album.idAlbum', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Album.precio', 'Usuario.nombreUsuario', 'Usuario.idUsuario', 'Genero.nombreGenero')
		->whereIn('Usuario.idUsuario', $search)
		->orderby('fechaPublicacion', 'asc')
		->limit(6)
		->get();

        return response()->json($songs);
    }

	public function searchSong($type = 'song', $searchParam = '')
	{
		switch($type)
		{
			case 'song':
				$result = $this->searchSongByTitle($searchParam);
				break;
			case 'album':
				$result = $this->searchSongByAlbum($searchParam);
				break;
			case 'user':
				$result = $this->searchSongByUser($searchParam);
				break;
		}
		return view('search', ['songs' => $result, 'search' =>$searchParam]);
	}

    public function searchSongByTitle($title)
    {
    	$songs = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->join('Genero', 'Genero.idGenero', '=', 'Cancion.idGenero')
		->select('Cancion.*', 'Album.idAlbum', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Album.precio', 'Usuario.nombreUsuario', 'Usuario.idUsuario', 'Genero.nombreGenero')
		->where('Cancion.tituloCancion', 'like', '%'.$title.'%')
		->orderby('fechaPublicacion', 'desc')
		->limit(20)
		->get();
        return $songs;
    }

    public function searchSongByAlbum($album)
    {
    	$songs = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->join('Genero', 'Genero.idGenero', '=', 'Cancion.idGenero')
		->select('Cancion.*', 'Album.idAlbum', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Album.precio', 'Usuario.nombreUsuario', 'Usuario.idUsuario', 'Genero.nombreGenero')
		->where('Album.tituloAlbum', 'like', '%'.$album.'%')
		->orderby('fechaPublicacion', 'desc')
		->limit(20)
		->get();
        return $songs;
    }

    public function searchSongByUser($user)
    {
    	$songs = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->join('Genero', 'Genero.idGenero', '=', 'Cancion.idGenero')
		->select('Cancion.*', 'Album.idAlbum', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Album.precio', 'Usuario.nombreUsuario', 'Usuario.idUsuario', 'Genero.nombreGenero')
		->where('Usuario.nombreUsuario', 'like', '%'.$user.'%')
		->orderby('fechaPublicacion', 'desc')
		->limit(20)
		->get();
        return $songs;
    }

    /*public function __invoke($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }*/

    public function landingPageRecharge($number)
    {

    	$number += 6;

    	$songs = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->select('Cancion.*', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Usuario.nombreUsuario')
		->orderby('idCancion', 'desc')
		->limit($number)
		->get();

		return response()->json($songs);
    }
}
