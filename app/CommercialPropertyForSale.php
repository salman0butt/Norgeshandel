<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommercialPropertyForSale extends Model
{
    use SoftDeletes;
    protected $table = 'commercial_property_for_sales';
    protected $guarded = [];
    
    public function media(){
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
