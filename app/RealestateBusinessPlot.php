<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealestateBusinessPlot extends Model
{
    //
    protected $table = 'realestate_business_plots';
    protected $guarded = [];

     public function ad(){
    return $this->belongsTo('App\Models\Ad');
    }
}
