<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = ['name','bio','photo_id','unique_id'];

    public function song(){
        $this->hasMany('App\Song');
    }
}
