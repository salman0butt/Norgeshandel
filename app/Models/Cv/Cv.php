<?php

namespace App\Models\Cv;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function media(){
        return $this->morphOne('App\Media', 'mediable');
    }

    public function personal(){
        return $this->hasOne('App\Models\Cv\CvPersonal');
    }

    public function experiences(){
        return $this->hasMany('App\Models\Cv\CvExperience');
    }

    public function languages(){
        return $this->belongsToMany('App\Models\Language');
    }

//    public function education(){
//        return $this->hasOne('App\Models\Cv\CvEducation');
//    }
}
