<?php

namespace App\Admin\Banners;

use App\Admin\Banners\BannerGroup;
use Illuminate\Database\Eloquent\Model;

class BannerGroupCategory extends Model
{
    //
    public function BannerGroup() {
       return $this->hasMany(BannerGroup::class, 'banner_group_id');

    }
}
