<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommercialPlot extends Model
{
    //
    protected $table = 'commercial_plots';
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
