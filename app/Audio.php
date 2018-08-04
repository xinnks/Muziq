<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $fillable = ['audio_name'];

    public function song(){
        $this->belongsTo('App\Song');
    }
}
