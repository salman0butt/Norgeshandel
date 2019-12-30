<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommercialPropertyForRent extends Model
{
    //
    protected $table = 'commercial_property_for_rents';
    protected $guarded = [];
    
    public function media(){
        return $this->morphMany('App\Media', 'mediable');
    }
}

