<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Favorite;

class Ad extends Model
{
    protected $fillable = [
        'user_id','status','ad_type'
    ];

    public function job(){
        return $this->hasOne('App\Admin\Jobs\Job');
    }

    public function propertyForRent(){
        return $this->hasOne('App\PropertyForRent');
    }

    public function propertyForSale(){
        return $this->hasOne('App\PropertyForSale');
    }

    public function propertyHolydaysHomesForSale(){
        return $this->hasOne('App\PropertyHolidaysHomesForSale');
    }

    public function propertyFlatWishesRented(){
        return $this->hasOne('App\FlatWishesRented');
    }


    public function job_filtered($filter){
        return $this->hasOne('App\Admin\Jobs\Job')->where($filter)->get();
    }

    public function views(){
        return $this->hasMany('App\Models\AdView');
    }

    public static function favorite($ad_id){
        if(\Auth::check()){
            return Favorite::where('user_id', \Auth::user()->id)->where('ad_id', $ad_id)->get();
        }
        return Favorite::where('user_id', 0)->where('ad_id', $ad_id)->get();
    }
}
