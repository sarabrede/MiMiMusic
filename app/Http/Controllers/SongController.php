<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancion;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

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

		$buyed = DB::table('Cancion')
		->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
		->join('TransaccionAlbum', 'TransaccionAlbum.idAlbum', '=', 'Album.idAlbum')
		->join('Transaccion', 'Transaccion.idTransaccion', '=', 'TransaccionAlbum.idTransaccion')
		->where([
				['Cancion.idCancion', '=', $idSong],
				['Transaccion.idUsuario', '=', session('idUser') ],
		])->count();

    	return view ('song', ['song' => $song, 'album' => $album, 'idSong' => $idSong, 'comments' => $comments, 'isfavorite' => $isfavorite, 'buyed' => $buyed]);
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
    	$archivo = $request->file('fileSong');
    	$fileName = str_replace(" ", "_", $archivo->getClientOriginalName());
    	$idUser = session('idUser');
        $realFileName = $idUser.rand().$fileName;

        $request->file('fileSong')->move(public_path("/usersAudios"), $realFileName);

        $trueFile = "../usersAudios/".$realFileName;

		$cancion = new Cancion;
        $cancion->tituloCancion = $request->input('titleSong');
        $cancion->descripcion = $request->input('descSong');
        $cancion->rutaCancion = $trueFile;
        $cancion->idAlbum = $request->input('albumSong');
        $cancion->idGenero = $request->input('genreSong');
        $cancion->fechaPublicacion = \Carbon\Carbon::now();
        $cancion->save();

        return redirect('profile/'.$idUser);
    }

    public function editSong($idSong, Request $request)
    {
    	$cancion = Cancion::where('idCancion', '=', $idSong)->first();
    	$cancion->tituloCancion = $request->input('titleSong');
        $cancion->descripcion = $request->input('descSong');
        $cancion->idAlbum = $request->input('albumSong');
        $cancion->idGenero = $request->input('genreSong');
        $cancion->fechaPublicacion = \Carbon\Carbon::now();
        $cancion->save();
        $idUser = $request->input('idUser');
        return redirect('profile/'.$idUser);
    }

    public function deleteSongs($idSongs, $idUser)
    {
    	$songs = explode(',', $idSongs);
    	foreach ($songs as $song) {
    		$cancion = Cancion::where('idCancion', '=', $song)->first();
    		$cancion->delete();
    	}
    	return redirect('profile/'.$idUser);
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

    public function addToCart($idSong)
    {
    	$songs = session('cart', '0');
    	if ($songs == '0')
    	{
    		session(['cart' => $idSong]);
    	}
    	else
    	{
    		$cartString = $songs.','.$idSong;
    		session(['cart' => $cartString]);
    	}
    	
    }

    /*public function redirect_post($url, array $data)
	{
	    ?>
	    <html xmlns="http://www.w3.org/1999/xhtml">
	    <head>
	        <script type="text/javascript">
	            function closethisasap() {
	                document.forms["redirectpost"].submit();
	            }
	        </script>
	    </head>
	    <body onload="closethisasap();">
	    <form name="redirectpost" method="post" action=<?php echo $url?> enctype="multipart/form-data">
	        <?php
	        if ( !is_null($data) ) {
	            foreach ($data as $k => $v) {
	                echo '<input type="hidden" name="' . $k . '" value="' . $v . '"> ';
	            }
	            echo '<input type="hidden" name="_token" value="'.csrf_token().'">';
	        }
	        ?>
	    </form>
	    </body>
	    </html>
	    <?php
	    exit;
	}*/

    /*public function __invoke($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }*/
}
