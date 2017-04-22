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

Route::get('/', 'SongController@landingSongs');

Route::get('/index/{type?}/{idUser?}', 'SongController@indexSong');

Route::get('/search/{searchParam?}/{type?}', 'SongController@searchSong');

Route::get('/shop', 'AlbumController@shopAlbum');

Route::get('/profile/{userProfile}', 'UserController@profileUser');
