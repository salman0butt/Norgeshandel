<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyHolidaysHomesForSale extends Model
{
    //
    protected $table = 'property_holidays_homes_for_sales';
    protected $guarded = [];

    
    public function media()
    {
        return $this->morphMany('App\Media', 'mediable');
    }

}
