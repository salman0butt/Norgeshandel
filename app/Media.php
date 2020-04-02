<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $fillable = [
        'mediable_id',
        'mediable_type',
        'name',
        'name_unique',
        'type',
        'title',
        'order'
    ];

    public function mediable(){
        return $this->morphTo();
    }
}
