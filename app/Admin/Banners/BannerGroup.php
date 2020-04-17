<?php

namespace App\Admin\Banners;


use App\Admin\ads\Banner;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Banners\BannerGroup_position;

class BannerGroup extends Model
{
    //
    protected $table = 'banner_groups';
    protected $guarded = [];

       public function banners() {
        return $this->belongsToMany(Banner::class, 'banners_banner_groups');
    }
    public function positions() {
        return $this->belongsToMany(BannerGroup_position::class,'banner_group_positions');
    }

}
