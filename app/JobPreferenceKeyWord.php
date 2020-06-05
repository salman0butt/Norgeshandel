<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPreferenceKeyWord extends Model
{
    protected $table = 'job_preference_key_words';
    protected $guarded = [];


    //
    public function user(){
        return $this->belongsTo(User::class);
    }

}
