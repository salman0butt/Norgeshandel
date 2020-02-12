<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $guarded = [];

    public function thread(){
        return $this->belongsTo(MessageThread::class);
    }
}
