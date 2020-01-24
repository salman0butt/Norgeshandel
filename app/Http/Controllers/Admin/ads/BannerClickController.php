<?php

namespace App\Http\Controllers\Admin\ads;

use App\BannerClick;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerClickController extends Controller
{
    //

public function ad_clicked(Request $request) {

    $ip = \Request::ip();
//     $date = date('Y-m-d H:i:s');
//    dd($date);
    $ip_check = BannerClick::where('ip','=',$ip)->where('banner_id','=',$request->banner_id)->count();
        $data = [
            'user_id' => $request->user_id,
            'banner_id' => $request->banner_id,
            'ip' => $ip
        ];
        if ($ip_check > 0) {
            return 'already clicked';
        }else {
            $banner = new BannerClick($data);
            $banner->save();
        }

      
    }
}
