<?php

namespace App\Models\Cv;

use App\Admin\Jobs\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cv extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }

//    public function job(){
//        return $this->belongsTo(Job::class);
//    }

    public function media(){
        return $this->morphOne('App\Media', 'mediable');
    }

    public function personal(){
        return $this->hasOne('App\Models\Cv\CvPersonal');
    }

    public function experiences(){
        return $this->hasMany('App\Models\Cv\CvExperience');
    }

    public function preference(){
        return $this->hasOne('App\Models\Cv\CvPreference');
    }

    public function languages(){
        return $this->belongsToMany('App\Models\Language');
    }

    public function educations(){
        return $this->hasMany('App\Models\Cv\CvEducation');
    }

    public function meta(){
        return $this->hasOne(CvMeta::class,'value','id')->where('key','cv')->where('user_id',Auth::id());
    }
}
