<?php

namespace App\Models\Cv;

use Illuminate\Database\Eloquent\Model;

class CvPersonal extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function cv(){
        return $this->belongsTo('App\Models\Cv\Cv');
    }
}
