<?php

namespace App\Admin\ads;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    protected $guarded = [];
    
    public function user() {
        
        return $this->belognsTo('App\User');
    }

}
