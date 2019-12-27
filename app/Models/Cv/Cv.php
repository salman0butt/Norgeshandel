<?php

namespace App\Models\Cv;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function personal(){
        return $this->hasOne('App\Models\Cv\CvPersonal');
    }
}
