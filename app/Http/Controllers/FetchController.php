<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Audio;
use App\CoverArt;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FetchController extends Controller
{
    public function index(){}

    public function getAllMusic(){
        // artist, title, cover, audio
        $songs = Song::get();
        if(!$songs->isEmpty()){
            $all_songs = [];
            foreach ($songs as $song){
                // get artist name, cover art and auudio file
                $audio = Audio::find($song->audio_id);
                $artist = Artist::find($song->artist_id);
                $cover = CoverArt::find($song->cover_art_id);
                $cover ? $cover_art = url(asset('storage/photos').'/'.$cover->photo) : $cover_art = url(asset('storage/photos').'/default.jpg') ;
                array_push($all_songs, ['title' => $song->title ,'artist' => $artist->name, 'artist_link' => $artist->unique_link, 'pic' => $cover_art, 'src' => url(asset('storage/audio').'/'.$audio->audio_name) ]);
            }

            return response()->json(['status' => 'success', 'message' => 'music files obtained', 'files' => $all_songs]);
        } else {
            return response()->json(['status' => 'failure', 'message' => 'no music files available']);
        }
    }

    public function getAllArtists(){
        $artists = Artist::get();
        $all_artists = [];
        if(!$artists->isEmpty()){
            foreach ($artists as $artist) {
                array_push($all_artists, ['link' => $artist->unique_id, 'name' => $artist->name]);
            }
            return response()->json(['status' => 'success', 'message' => 'music files obtained', 'files' => $all_artists]);
        } else{
            return response()->json(['status' => 'failure', 'message' => 'no music files available']);
        }
    }

    public function getArtistMusic(Request $request, $artist_ui){
        $artist = Artist::where('unique_id', $artist_ui)->first();
        if(!$artist){
            $result = null;
            return response()->json(['status' => 'success', 'message' => 'artist has no music', 'files' => $result]);
        } else {
            $songs = Song::where('artist_id', $artist->id)->get();
            if(!$songs->isEmpty()){
                $all_songs = [];
                foreach ($songs as $song){
                    // get artist name, cover art and auudio file
                    $album = Album::find($song->album_id);
                    $album ? $artist_info = $album->name : $artist_info = $artist->name ;
                    $audio = Audio::find($song->audio_id);
                    $cover = CoverArt::find($song->cover_art_id);
                    $cover ? $cover_art = url(asset('storage/photos').'/'.$cover->photo) : $cover_art = url(asset('storage/photos').'/default.jpg') ;
                    array_push($all_songs, ['title' => $song->title ,'artist' => $artist_info, 'artist_link' => $artist->unique_link, 'pic' => $cover_art, 'src' => url(asset('storage/audio').'/'.$audio->audio_name) ]);
                }
                return response()->json(['status' => 'success', 'message' => 'music files obtained', 'files' => $all_songs, 'artist_name' => $artist->name]);
            } else {
                return response()->json(['status' => 'failure', 'message' => 'no music files available']);
            }
        }
    }

    public function getAllAlbums(){
        $albums = Album::get();
        $all_albums= [];
        if(!$albums->isEmpty()){
            foreach ($albums as $album) {
                array_push($all_albums, ['link' => $album->unique_id, 'name' => $album->name]);
            }
            return response()->json(['status' => 'success', 'message' => 'music files obtained', 'files' => $all_albums]);
        } else{
            return response()->json(['status' => 'failure', 'message' => 'no music files available']);
        }
    }

    public function getAlbumMusic(Request $request, $album_ui){
        $album = Album::where('unique_id', $album_ui)->first();
        if(!$album){
            $result = null;
            return response()->json(['status' => 'success', 'message' => 'artist has no music', 'files' => $result]);
        } else {
            $artist=Artist::find($album->artist_id);
            $songs = Song::where('album_id', $album->id)->get();
            if(!$songs->isEmpty()){
                $all_songs = [];
                foreach ($songs as $song){
                    // get artist name, cover art and auudio file
                    $audio = Audio::find($song->audio_id);
                    $cover = CoverArt::find($song->cover_art_id);
                    $cover ? $cover_art = url(asset('storage/photos').'/'.$cover->photo) : $cover_art = url(asset('storage/photos').'/default.jpg') ;
                    array_push($all_songs, ['title' => $song->title ,'artist' => $artist->name, 'artist_link' => $album->unique_link, 'pic' => $cover_art, 'src' => url(asset('storage/audio').'/'.$audio->audio_name) ]);
                }
                return response()->json(['status' => 'success', 'message' => 'music files obtained', 'files' => $all_songs, 'album_name' => $album->name, 'artist_name' => $artist->name]);
            } else {
                return response()->json(['status' => 'failure', 'message' => 'no music files available']);
            }
        }
    }

    public function getAllPlaylists(){

    }

    public function getPlaylistMusic(){

    }

}
