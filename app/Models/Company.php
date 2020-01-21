<?php

namespace App\Models;

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
}
