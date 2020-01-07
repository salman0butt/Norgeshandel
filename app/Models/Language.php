<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $guarded = [];

    public function cvs(){
        return $this->hasMany('App\Models\Cv\Cv');
    }
}
