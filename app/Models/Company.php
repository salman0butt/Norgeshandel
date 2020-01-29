<?php

namespace App\Models;

use App\Admin\Jobs\Job;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company_logo(){
        return $this->morphMany('App\Media', 'mediable')->where('type','=','company_logo');
    }

    public function company_gallery(){
        return $this->morphMany('App\Media', 'mediable')->where('type','=','company_gallery');
    }

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function followings(){
        return $this->hasMany(Following::class);
    }
}
