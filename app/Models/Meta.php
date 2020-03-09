<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table = 'metas';
    protected $fillable = ['metable_id','metable_type','key','value'];

    public function metable(){
        return $this->morphTo();
    }
}
