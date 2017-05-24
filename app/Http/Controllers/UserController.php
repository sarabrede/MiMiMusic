<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use DB;
use App\Http\Controllers\Controller;

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

    public function addUser(Request $request) {
    	$usuario = new Usuario;

    	$usuario->correoElectronico = $request->input('emailInput');
    	$usuario->nombreUsuario = $request->input('usernameInput');
    	$usuario->contraseña = $request->input('passwordInput');
    	$usuario->nombreCompleto = 'JEJ';

        $usuario->save();
        return redirect('index');
    }

    public function logIn(Request $request){

        $usuario = DB::table('Usuario')
        ->select('Usuario.*')
        ->where(function($query) use(&$request) {
            $query->where('Usuario.nombreUsuario', '=', $request->input('emailInputlog'))
            ->where('Usuario.contraseña', '=', $request->input('passwordInputlog'));
        })
        ->orWhere(function($query) use(&$request) {
            $query->where('Usuario.correoElectronico', '=', $request->input('emailInputlog'))
            ->where('Usuario.contraseña', '=', $request->input('passwordInputlog'));
        })
        ->first();
        session(['idUser' => $usuario->idUsuario, 'nombreUsuario' => $usuario->nombreUsuario, 
            'fotoUser' => $usuario->fotoPerfil]);

        return redirect('index');
    }

}
