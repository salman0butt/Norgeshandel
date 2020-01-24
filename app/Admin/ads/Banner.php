<?php

namespace App\Admin\ads;

use App\Admin\Banners\BannerGroup;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    protected $guarded = [];
    
    public function user() {
        
        return $this->belognsTo('App\User');
    }
    public function media(){
        return $this->morphOne('App\Media', 'mediable');
    }
    public function groups() {
        return $this->belongsToMany(BannerGroup::class, 'banners_banner_groups');
    }

}
