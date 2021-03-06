<?php

namespace App\Models;

use App\Admin\Jobs\Job;
use App\Media;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company_logo(){
        return $this->morphMany(Media::class, 'mediable')->where('type','=','company_logo');
    }

    public function company_gallery(){
        return $this->morphMany(Media::class, 'mediable')->where('type','=','company_gallery')->orderBy('media_order','ASC');
    }

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function followings(){
        return $this->hasMany(Following::class);
    }

    public function agents(){
        return $this->hasMany(User::class,'created_by_company_id','id');
    }

    public function ads(){
        return $this->hasMany(Ad::class);
    }
}
