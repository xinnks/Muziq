<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ['title','artist_id','audio_id','cover_art_id','album_id','year','genre_id','unique_id','lyrics'];

    public function audio(){
        $this->hasOne('App\Audio');
    }

    public function artist(){
        $this->belongsTo('App\Artist');
    }
}
