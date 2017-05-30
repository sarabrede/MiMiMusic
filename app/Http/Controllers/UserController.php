<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use DB;
use Storage;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\GenreController;

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
        $albumC = new AlbumController;
        $albums = $albumC->getAlbums($user);
        $genreC = new GenreController;
        $genres = $genreC->getGenres();
        $countryC = new CountryController;
        $countries = $countryC->getCountries();
        return view('profile', ['info' => $info, 'songs' => $songs, 'albums' => $albums, 'genres' => $genres, 'countries' => $countries]);
    }

    public function songsUser($user)
    {
        $songs = DB::table('Cancion')
        ->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
        ->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
        ->join('Genero', 'Genero.idGenero', '=', 'Cancion.idGenero')
        ->select('Cancion.*', 'Album.idAlbum', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Album.precio', 'Usuario.nombreUsuario', 'Usuario.idUsuario', 'Genero.*')
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

        $usuario->save();

        $request->session()->flush();
        session(['idUser' => $usuario->idUsuario, 'nombreUsuario' => $usuario->nombreUsuario, 'fotoUser' => '../images/defaultUser.png']);

        return redirect('index');
    }

    public function logIn(Request $request) {
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

        if($usuario != null)
        {
            session(['idUser' => $usuario->idUsuario, 'nombreUsuario' => $usuario->nombreUsuario, 'fotoUser' => $usuario->fotoPerfil]);
            return redirect('index');
        }

        else
        {
            $songs = DB::table('Cancion')
            ->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
            ->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
            ->select('Cancion.*', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Usuario.nombreUsuario')
            ->orderby('idCancion', 'desc')
            ->limit(6)
            ->get();
            return view('landingPage', ['songs' => $songs, 'error' => 'si']);
        }
    }

    public function logOut(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    public function editUser(Request $request)
    {
        $idUser = $request->input('idUser');
        $usuario = Usuario::where('idUsuario', '=', $idUser)->first();
        $usuario->nombreCompleto = $request->input('nombreCompleto');
        $usuario->contraseña = $request->input('contraseña');
        $usuario->idPais = $request->input('countryUser');
        $usuario->save();
        return redirect('profile/'.$idUser);
    }

    public function editProfilePicture(Request $request)
    {
        $archivo = $request->file('fileFoto');
        $fileName = str_replace(" ", "_", $archivo->getClientOriginalName());
        $idUser = session('idUser');
        $realFileName = $idUser.rand().$fileName;

        $request->file('fileFoto')->move(public_path("/audioImages"), $realFileName);

        $trueFile = "../audioImages/".$realFileName;

        $usuario = Usuario::where('idUsuario', '=', $idUser)->first();
        $usuario->fotoPerfil = $trueFile;
        $usuario->save();

        $request->session()->forget('fotoUser');
        session(['fotoUser' => $usuario->fotoPerfil]);

        return redirect('/profile/'.$idUser);
    }

    public function editCoverPicture(Request $request)
    {
        $archivo = $request->file('fileCover');
        $fileName = str_replace(" ", "_", $archivo->getClientOriginalName());
        $idUser = session('idUser');
        $realFileName = $idUser.rand().$fileName;

        $request->file('fileCover')->move(public_path("/audioImages"), $realFileName);

        $trueFile = "../audioImages/".$realFileName;

        $usuario = Usuario::where('idUsuario', '=', $idUser)->first();
        $usuario->fotoBanner = $trueFile;
        $usuario->save();
        
        return redirect('/profile/'.$idUser);
    }

    public function checkmail($email)
    {
        $existemail = DB::table('Usuario')
        ->select('Usuario.*')
        ->where('correoElectronico', '=', $email)
        ->count();

        return response()->json($existemail);
    }

    public function checkusername($username)
    {
        $existusuario = DB::table('Usuario')
        ->select('Usuario.*')
        ->where('nombreUsuario', '=', $username)
        ->count();

        return response()->json($existusuario);
    }

}
