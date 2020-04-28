<?php

namespace App\Admin\ads;

use App\Admin\ads\Banner;
use Illuminate\Database\Eloquent\Model;

class BannerView extends Model
{
    //
    public function banner() {
        return $this->belongsTo(Banner::class);
    }

}
