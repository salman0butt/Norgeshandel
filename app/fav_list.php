<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Favorite;

class fav_list extends Model
{
    protected $guarded = [];

    public function favorites(){
        return $this->hasMany('App\Favorite', 'list_id');
    }

    public function ads(){
        return $this->hasMany('App\Models\Ad', 'list_id');
//        return count(Favorite::where('ad_id', $this->id)->get());
    }
}
