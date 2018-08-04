<?php

namespace App\Http\Controllers;

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
}
