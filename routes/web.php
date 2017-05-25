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


Route::get('/rechargeLandingPage/{number}', 'SongController@landingPageRecharge');
Route::get('/index', 'SongController@indexSongByPopularity');
Route::get('/index/popularity/{number}', 'SongController@indexSongByPopularityAjax');
Route::get('/index/subscribers/{idUser}/{number}', 'SongController@indexSongBySubscribers');
/*Route::get('/index/{type?}/{idUser?}', 'SongController@indexSong');*/



Route::get('/search/{type?}/{searchParam?}', 'SongController@searchSong');

Route::get('/shop', 'AlbumController@shopAlbum');

Route::get('/profile/{userProfile}', 'UserController@profileUser');

Route::get('/song/{idSong}', 'SongController@getSong');

Route::get('/album/{idAlbum}', 'AlbumController@getSong');

Route::post('/addUser', 'UserController@addUser');

Route::post('/logIn', 'UserController@logIn');




