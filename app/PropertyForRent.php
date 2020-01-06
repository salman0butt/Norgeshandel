<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyForRent extends Model
{
    //
    protected $table = 'property_for_rent';
    protected $guarded = [];

    public function media(){
        return $this->morphMany('App\Media', 'mediable');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
