<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyForSale extends Model
{
    //
    protected $table = 'property_for_sales';
    protected $guarded = [];


    public function media(){
        return $this->morphMany('App\Media', 'mediable');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
