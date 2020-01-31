<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'detail'
    ];

    public function terms(){
        return $this->hasMany('App\Term');
    }

    public function parent_terms(){
        return $this->hasMany('App\Term')->where('parent', '=', 0)->get();
    }

}
