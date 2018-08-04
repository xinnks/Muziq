<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['name', 'year', 'artist_id', 'cover_art_id', 'unique_id'];
}