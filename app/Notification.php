<?php

namespace App;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $guarded = [];

    public function notifiable(){
        return $this->morphTo();
    }

    public function searches(){
        return $this->morphTo()->whereDate('created_at', '>', $this->created_at);
    }
    public function ad() {
        return $this->belongsTo(Ad::class,'notifiable_id','id');
    }
}
