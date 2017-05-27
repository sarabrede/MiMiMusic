<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use DB;
use App\Http\Controllers\Controller;
use App\Transaccion;
use App\TransaccionAlbum;

class AlbumController extends Controller
{
    public function shopAlbum()
	{
		$shoppingCart = session('cart', '0');
		if ($shoppingCart == '0')
			$shopping = array();
		else
			$shopping = explode(',', $shoppingCart);

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

	public function getAlbums($user)
	{
		$albums = DB::table('Album')
		->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
		->select('Album.*')
		->where('Usuario.idUsuario', '=', $user)
		->get();
		return $albums;
	}

	public function addAlbum(Request $request)
	{
		$album = new Album;
		$archivo = $request->file('fileAlbum');
		$fileName = str_replace(" ", "_", $archivo->getClientOriginalName());
		$idUser = $request->input('idUser');
		$realFileName = $idUser.rand().$fileName;
		$album->tituloAlbum = $request->input('titleAlbum');
		$album->añoAlbum = \Carbon\Carbon::now();
		$album->idUsuario = $idUser;
		$album->precio = $request->input('priceAlbum');
		$request->file('fileAlbum')->move(public_path("/audioImages"), $realFileName);
		$trueFile = "../audioImages/".$realFileName;
		$album->fotoAlbum = $trueFile;
		$album->save();
		return redirect('profile/'.$idUser);
	}

	public function deleteAlbum($idAlbum, Request $request)
	{
		$cart = session('cart');
		$array = "";
		$shopping = explode(',', $cart);

		for($i = 0; $i < sizeof($shopping); $i++)
		{
			if($shopping[$i] != $idAlbum)
			{
				$array = $array.$shopping[$i].",";
			}
		}

		$bien = substr($array, 0, -1);

		if ($bien != "")
			session(['cart' => $bien]);
		else
			$request->session()->forget('cart');

		return response()->json($bien);
	}

	public function buyAlbums(Request $request)
	{
		DB::transaction(function () use(&$request) {
			$songs = session('cart', '0');
			$albums = explode(',', $songs);
			$transaction = new Transaccion;
			$transaction->totalVenta = $request->input('total');
			$transaction->fechaCompra = \Carbon\Carbon::now();
			$transaction->idUsuario = session('idUser');
			$transaction->save();
			foreach ($albums as $album) {
				$transaccionAlbum = new TransaccionAlbum;
				$transaccionAlbum->idAlbum = $album;
				$transaccionAlbum->idTransaccion = $transaction->idTransaccion;
				$transaccionAlbum->save();
			}
			$request->session()->forget('cart');
		});
		return redirect('/index');
	}

}
