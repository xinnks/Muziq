<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getallmusic','FetchController@getAllMusic');
Route::get('getallartists','FetchController@getAllArtists');
Route::get('getartistmusic/{artist_ui}','FetchController@getArtistMusic');
Route::get('getallalbums','FetchController@getAllAlbums');
Route::get('getalbummusic/{album_ui}','FetchController@getAlbumMusic');
Route::get('getallplaylists','FetchController@getAllPlaylists');
Route::get('getplaylistmusic/{playlist_ui}','FetchController@getPlaylistMusic');
Route::post('add_music_file', 'Auth\Add@uploadMusicFile');