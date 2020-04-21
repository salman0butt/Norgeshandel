<?php

namespace App\Admin\Banners;

use App\Admin\Banners\BannerGroup;
use Illuminate\Database\Eloquent\Model;

class BannerGroup_position extends Model
{
    //
  
      public function bannerGroup() {
        return $this->belongsTo(BannerGroup::class,'banner_group_id');
    }

}
