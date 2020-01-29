<?php

namespace App\Admin\Banners;


use App\Admin\ads\Banner;
use Illuminate\Database\Eloquent\Model;

class BannerGroup extends Model
{
    //
    protected $table = 'banner_groups';
    protected $guarded = [];
       public function banners() {
        return $this->belongsToMany(Banner::class, 'banners_banner_groups');
    }
}
