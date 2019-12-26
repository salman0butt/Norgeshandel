<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent',
        'taxonomy_id',
        'detail'
    ];

    public function taxonomy(){
        return $this->belongsTo('App\Taxonomy');
    }

    public function jobs(){
        return $this->belongsToMany('App\Admin\Jobs\Job');
    }

}
