<?php

namespace App;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Model;

class AdAgent extends Model
{
    protected $table = 'ad_agents';
    protected $guarded = [];

    public function ad(){
        return $this->belongsTo(Ad::class,'ad_id','id');
    }

}
