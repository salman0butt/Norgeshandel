<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPreferenceCity extends Model
{
    protected $table = 'job_preference_cities';
    protected $guarded = [];


    //
    public function user(){
        return $this->belongsTo(User::class);
    }
}
