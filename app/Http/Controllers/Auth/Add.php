<?php

namespace App\Http\Controllers\Auth;

use App\Album;
use App\Artist;
use App\Audio;
use App\CoverArt;
use App\Http\Requests\AddAlbumRequest;
use App\Http\Requests\AddArtistRequest;
use App\Http\Requests\AudioRequest;
use App\Http\Requests\SongInfoRequest;
use App\Song;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class Add extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $artists = Artist::get();
        !$artists->isEmpty() ? $all_artists = $artists : $all_artists = null ;

        $albums = Album::get();
        !$albums->isEmpty() ? $all_albums = $albums : $all_albums = null ;
        $data = [
            'artists' => $all_artists,
            'albums' => $all_albums
        ];
        return view('auth.add_song',$data);
    }

    public function AddArtist(){
        return view('auth.add_artist');
    }

    public function CreateArtist(AddArtistRequest $request){
        if($request->file('photo')){
            // save photo and get id
            $photo = $this->random_num_gen(20) . '.' . $request->file('photo')->getClientOriginalExtension();
            $path = $request->file('photo')->storeAs('', $photo, 'cover_arts');
            $savePhoto= new CoverArt([ 'photo' => $path]);
            $savePhoto->save();


            $artist = new Artist();
            $artist->name = $request->input('name');
            $artist->bio = $request->input('bio');
            $artist->photo_id = $savePhoto->id;
            $artist->unique_id = $this->random_num_gen(15);
            if($artist->save()){
                return back()->with('success', 'added artist successfully');
            } else {
                return back()->with('failure', 'failed to add artist');
            }
        } else {
            $artist = new Artist();
            $artist->name = $request->input('name');
            $artist->bio = $request->input('bio');
            $artist->photo_id = 1;
            $artist->unique_id = $this->random_num_gen(15);
            if($artist->save()){
                return back()->with('success', 'added artist successfully with default cover');
            } else {
                return back()->with('failure', 'failed to add artist');
            }
        }
    }

    public function AddPlaylist(){
        return view('auth.add_playlist');
    }

    public function CreatePlaylist(){
        return view('auth.add_playlist');
    }

    public function AddAlbum(){
        $artists = Artist::get();
        !$artists->isEmpty() ? $all_artists = $artists : $all_artists = null ;

        $data = [
            'artists' => $all_artists
        ];
        return view('auth.add_album', $data);
    }

    public function CreateAlbum(AddAlbumRequest $request){
        if($request->file('cover')){
            // save photo and get id
            $photo = $this->random_num_gen(20) . '.' . $request->file('cover')->getClientOriginalExtension();
            $path = $request->file('cover')->storeAs('', $photo, 'cover_arts');
            $savePhoto= new CoverArt([ 'photo' => $path]);
            $savePhoto->save();

            $album = new Album();
            $album->name = $request->input('name');
            $album->year = $request->input('year');
            $album->artist_id = $request->input('artist_id');
            $album->cover_art_id = $savePhoto->id;
            $album->unique_id = $this->random_num_gen(10);
            if($album->save()){
                return back()->with('success', 'added album successfully');
            } else {
                return back()->with('failure', 'failed to add album');
            }
        } else {
            $album = new Album();
            $album->name = $request->input('name');
            $album->year = $request->input('year');
            $album->artist_id = $request->input('artist_id');
            $album->cover_art_id = 1;
            $album->unique_id = $this->random_num_gen(10);
            if($album->save()){
                return back()->with('success', 'added album successfully with default cover');
            } else {
                return back()->with('failure', 'failed to add album');
            }
        }
    }

    public function addSong(SongInfoRequest $request){

        //return var_dump(file('audio_file'));

        if ($request->file('audio_file')) {

            // generate product unique link
            $audio_name = $this->random_num_gen(30) . '.' . $request->file('audio_file')->getClientOriginalExtension();

            /*$music_file = Input::file('featured_mp3');
            if(isset($music_file)){
                $filename = $music_file->getClientOriginalName();
                 $location = public_path('audio/');
                 $music_file->move($location,$filename);
                 $posts_music->mp3 = $filename;
            }*/

            $path = $request->file('audio_file')->storeAs('', $audio_name, 'music_files');

            $audioFile = new Audio([
                'audio_name' => $path
            ]);

            // save file to audio table
            if($audioFile->save()) {
                //return response()->json(['status' => 'success','message' => 'Photo Updated!', 'audio_id' => $audioFile]);

                if ($request->hasFile('cover_art')) {

                    $cover_art = $this->random_num_gen(20) . '.' . $request->file('cover_art')->getClientOriginalExtension();
                    $path = $request->file('cover_art')->storeAs('', $cover_art, 'cover_arts');
                    $saveCoverArt = new CoverArt(['photo' => $path]);
                    $saveCoverArt->save();
                }

                $songDetails = new Song();
                if (isset($saveCoverArt->id)) {
                    $songDetails->cover_art_id = $saveCoverArt->id;
                } else {
                    if (!empty($request->input('album_id'))) {
                        $albumInfo = Album::find($request->input('album_id'));
                        $songDetails->cover_art_id = $albumInfo->cover_art_id;
                    } else {
                        $songDetails->cover_art_id = 1;
                    }
                }
                $songDetails->title = $request->input('song_title');
                $songDetails->artist_id = $request->input('artist_id');
                $songDetails->audio_id = $audioFile->id;
                $songDetails->album_id = $request->input('album_id');
                $songDetails->year = $request->input('year');
                $songDetails->genre_id = $request->input('genre_id');
                $songDetails->unique_id = $this->random_num_gen().date('Yms');
                $songDetails->lyrics = $request->input('lyrics');

                if($songDetails->save()){
                    //return response()->json(['status' => 'success','message' => 'Song Added!']);
                    return back()->with('success', 'Song Added!');
                }else{
                    //return response()->json(['status' => 'failure','message' => 'Song Not Added!']);
                    return back()->with('failure', 'Song Not Added!');
                }

            }else{
                //return response()->json(['status' => 'failure','message' => 'Couldn\'t save file!']);
                return back()->with('failure', 'Couldn\'t save file!');
            }
        } else {
            //return response()->json(['status' => 'failure','message' => 'Audio File Not Received!']);
            return back()->with('failure', 'Audio File Not Received!');
        }

    }

    public function uploadMusicFile(AudioRequest $request){
        if ($request->hasFile('music_file')) {

            // generate product unique link
            $audio_name = $this->random_num_gen(20) . '.' . $request->file('music_file')->getClientOriginalExtension();
            $path = $request->file('music_file')->storeAs('', $audio_name, 'music_files');

            $audioFile = new Audio([
                'audio_name' => $path
            ]);

            // save file to audio table
            if($audioFile->save()){
                return response()->json(['status' => 'success','message' => 'Photo Updated!', 'audio_id' => $audioFile]);
            }else{
                return response()->json(['status' => 'failure','message' => 'Couldn\'t save file!']);
            }
        } else {
            return response()->json(['status' => 'failure','message' => 'Audio File Not Received!']);
        }
    }


    public function random_num_gen($length = 10){
        $val = strtoupper('01234567899876543210ABCDEFGHIJKLMNOPQRSTUVWXYZ_-');
        $random_value = $this->AphanRand($length,$val);
        return $random_value;
    }
    /* random alphanumeric number generating function starts */
    public function AphanRand($length,$val){
        //Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
        $Caracteres = $val;
        $QuantidadeCaracteres = strlen($Caracteres);
        $QuantidadeCaracteres--;

        $Hash=NULL;
        for($x=1;$x<=$length;$x++){
            $Posicao = rand(0,$QuantidadeCaracteres);
            $Hash .= substr($Caracteres,$Posicao,1);
        }
        return $Hash;
    }

}
