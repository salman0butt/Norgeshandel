<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyHolidaysHomesForSale extends Model
{
    use SoftDeletes;
    protected $table = 'property_holidays_homes_for_sales';
    protected $guarded = [];

    
    public function media()
    {
        return $this->morphMany('App\Media', 'mediable');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
      public function ad(){
    return $this->belongsTo('App\Models\Ad');
    }
}
