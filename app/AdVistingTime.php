<?php

namespace App;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Model;

class AdVistingTime extends Model
{
    protected $table = 'ad_visting_times';
    protected $guarded = [];

    public function ad(){
        return $this->belongsTo(Ad::class,'ad_id','id');
    }
}
