<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlatWishesRented extends Model
{
    //  
    protected $table = 'flat_wishes_renteds';
    protected $guarded = [];

    public function media(){
        return $this->morphMany('App\Media', 'mediable');
    }
}
