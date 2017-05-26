<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancion;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
    	DB::table('Cancion')->increment('visitas');

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
		->orderby('idComentario', 'desc')
		->get();

		$idUser = session('idUser', 0);
		$isfavorite = 0;

		if($idUser != 0)
		{
			$isfavorite	= DB::table('UsuarioCancionFavorita')
			->select('UsuarioCancionFavorita.*')
			->where([
				['idUsuario', '=', $idUser],
				['idCancion', '=', $idSong ],
			])->count();
		}

    	return view ('song', ['song' => $song, 'album' => $album, 'idSong' => $idSong, 'comments' => $comments, 'isfavorite' => $isfavorite]);
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

	/*public function searchSong($type = 'song', $searchParam = '')
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
		
	}*/

    public function searchSongByTitle(Request $request)
    {
    	$titulo = $request->input('searchParam');
		
		$songs = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->join('Genero', 'Genero.idGenero', '=', 'Cancion.idGenero')
		->select('Cancion.*', 'Album.idAlbum', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Album.precio', 'Usuario.nombreUsuario', 'Usuario.idUsuario', 'Genero.nombreGenero')
		->where('Cancion.tituloCancion', 'like', '%'.$titulo.'%')
		->orderby('fechaPublicacion', 'desc')
		->limit(20)
		->get();

       return view('search', ['songs' => $songs, 'search' => $titulo]);
    }

    public function searchSongByTitleAjax($titulo)
    {	
		$songs = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->join('Genero', 'Genero.idGenero', '=', 'Cancion.idGenero')
		->select('Cancion.*', 'Album.idAlbum', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Album.precio', 'Usuario.nombreUsuario', 'Usuario.idUsuario', 'Genero.nombreGenero')
		->where('Cancion.tituloCancion', 'like', '%'.$titulo.'%')
		->orderby('fechaPublicacion', 'desc')
		->limit(20)
		->get();

      	 return response()->json($songs);
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
        
        return response()->json($songs);
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
       return response()->json($songs);
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

    public function addSong(Request $request)
    {
    	$cancion = new Cancion;
    	$pathBase = 'http://127.0.0.1:8080/audios/';
    	$archivo = $request->file('fileSong');
    	$fileName = str_replace(" ", "_", $archivo->getClientOriginalName());
    	$file = $request->file('fileSong')->storeAs('usersAudios', $fileName);
    	$pathTrue = $pathBase.\Carbon\Carbon::now().$fileName;
    	//$path = Storage::putFileAs('usersAudios', $request->file('fileSong'), $fileName);

        $cancion->tituloCancion = $request->input('titleSong');
        $cancion->descripcion = $request->input('descSong');
        $cancion->rutaCancion = $file;
        $cancion->idAlbum = $request->input('albumSong');
        $cancion->idGenero = $request->input('genreSong');
        $cancion->fechaPublicacion = \Carbon\Carbon::now();

        //$contents = Storage::put('usersAudios', $archivo->path());

        //$archivo = Input::file('fileSong');
        //$fileData = file_get_contents($archivo->getRealPath());

        //$move = File::move($file->getRealPath(), $pathTrue);
        //$fileData = FILE::get($file->path());
        //move_uploaded_file($fileData, $pathTrue);
        //Storage::copy(FILE::get($file), $pathTrue);
        //$cancion->save();
        return view('kek', ['cancion' => $cancion, 'jej' => $archivo]);//.$request->input('idUser')
    }

    public function addFavorite($idSong)
    {
    	DB::table('UsuarioCancionFavorita')->insert([
    		'idUsuario' => $idUser = session('idUser'),
    		'idCancion' => $idSong
    		]);
    }

    public function deleteFavorite($idSong)
    {
    	$idUser = session('idUser');
    	DB::table('UsuarioCancionFavorita')
    	->where([
				['idUsuario', '=', $idUser],
				['idCancion', '=', $idSong ],
			])->delete();

    }

    /*public function __invoke($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }*/
}
