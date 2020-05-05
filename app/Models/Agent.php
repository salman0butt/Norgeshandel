<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use SoftDeletes;
    protected $table = 'agents';
    protected $guarded = [];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function avatar(){
        return $this->morphOne('App\Media', 'mediable')->where('type','agent_avatar');
    }

}
