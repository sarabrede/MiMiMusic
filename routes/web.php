<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landingPage');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/search/{searchParam?}', function($searchParam = '') {
	$songs = DB::table('Cancion')
	->join('Album', 'Cancion.idAlbum', '=', 'Album.idAlbum')
	->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
	->select('Cancion.*', 'Album.tituloAlbum', 'Album.fotoAlbum', 'Album.precio', 'Usuario.nombreUsuario')
	->where('Cancion.tituloCancion', 'like', '%'.$searchParam.'%')
	->orderby('fechaPublicacion', 'desc')
	->limit(20)
	->get();
	return view('search', ['songs' => $songs, 'search' =>$searchParam]);
});

Route::get('/shop', function() {
	$albums = DB::table('Album')
	->join('Cancion', 'Cancion.idAlbum', '=', 'Album.idAlbum')
	->join('Usuario', 'Usuario.idUsuario', '=', 'Album.idUsuario')
	->select('Album.*', 'Usuario.nombreUsuario', DB::raw("count(Cancion.tituloCancion) as count"))
	->groupby('Album.idAlbum', 'Album.fotoAlbum', 'Album.añoAlbum', 'Album.tituloAlbum', 'Album.idUsuario', 'Album.activo', 'Album.precio', 'Usuario.nombreUsuario')
	->get();
    return view('cart', ['albums' => $albums]);
});

Route::get('/profile', function () {
    return view('profile');
});
