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


Route::get('/search', 'SongController@searchSongByTitle');
Route::get('/search/songs/{titulo}', 'SongController@searchSongByTitleAjax');
Route::get('/search/albums/{titulo}', 'SongController@searchSongByAlbum');
Route::get('/search/users/{usuario}', 'SongController@searchSongByUser');
/*Route::get('/search/{type?}/{searchParam?}', 'SongController@searchSong');*/


Route::get('/shop', 'AlbumController@shopAlbum');
Route::get('/shop/delete/{idAlbum}', 'AlbumController@deleteAlbum');
Route::post('/shop/buy', 'AlbumController@buyAlbums');

Route::get('/profile/{userProfile}', 'UserController@profileUser');

Route::get('/song/{idSong}', 'SongController@getSong');
Route::get('/song/{idSong}/favorite', 'SongController@addFavorite');
Route::get('/song/{idSong}/deletefavorite', 'SongController@deleteFavorite');
Route::get('/song/comment/{idSong}/{comentario}', 'CommentController@addComment');
Route::get('/song/{idSong}/addToCart', 'SongController@addToCart');

Route::get('/album/{idAlbum}', 'AlbumController@getSong');

Route::post('/addUser', 'UserController@addUser');
Route::post('/editUser', 'UserController@editUser');
Route::post('/editProfilePicture', 'UserController@editProfilePicture');
Route::post('/editCoverPicture', 'UserController@editCoverPicture');
Route::get('/emailUsed/{email}', 'UserController@checkmail');
Route::get('/usernameUsed/{username}' , 'UserController@checkusername');

Route::post('/logIn', 'UserController@logIn');
Route::get('/logOut', 'UserController@logOut');

Route::post('/addSong', 'SongController@addSong');

Route::post('/editSong/{idSong}', 'SongController@editSong');

Route::get('/deleteSongs/{idSongs}/{idUser}', 'SongController@deleteSongs');

Route::post('/addAlbum', 'AlbumController@addAlbum');
