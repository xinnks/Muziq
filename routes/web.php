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
    return view('welcome');
});

Auth::routes();

Route::get('storage/audio/{filename}', function ($filename)
{
    $path = storage_path('app/public/music-files/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('storage/photos/{filename}', function ($filename)
{
    $path = storage_path('app/public/cover-arts/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add-song', 'Auth\Add@index')->name('add.song');
//Route::post('/add_song_post', 'Auth\Add@CreateSong')->name('add.song.post');
Route::get('/add-artist', 'Auth\Add@AddArtist')->name('add.artist');
Route::post('/add_artist_post', 'Auth\Add@CreateArtist')->name('add.artist.post');
Route::get('/add-playlist', 'Auth\Add@AddPlaylist')->name('add.playlist');
Route::post('/add_playlist_post', 'Auth\Add@CreatePlaylist')->name('add.playlist.post');
Route::get('/add-album', 'Auth\Add@AddAlbum')->name('add.album');
Route::post('/add_album_post', 'Auth\Add@CreateAlbum')->name('add.album.post');
Route::get('/remove', 'Auth\Remove@index')->name('remove');
Route::get('/player', 'PlayerController@index')->name('player');

Route::post('/add_song', 'Auth\Add@addSong')->name('add.song.post');
Route::post('/add_music_file', 'Auth\Add@uploadMusicFile')->name('add.music.file');