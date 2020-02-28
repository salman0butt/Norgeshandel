<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyForRent extends Model
{
    use SoftDeletes;
    protected $table = 'property_for_rent';
    protected $guarded = [];

    public function media(){
        return $this->morphMany('App\Media', 'mediable');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function ad(){
        return $this->belongsTo('App\Models\Ad');
    }
}
