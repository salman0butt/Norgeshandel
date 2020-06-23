<?php

namespace App;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Model;

class AdExpiry extends Model
{
    protected $table = 'ad_expiry';
    protected $guarded = [];


    //
    public function ad(){
        return $this->belongsTo(Ad::class);
    }
}
