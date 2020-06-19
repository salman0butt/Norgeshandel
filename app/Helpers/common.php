<?php

namespace App\Helpers;

use App\AdAgent;
use App\Admin\Jobs\Job;
use App\AdVistingTime;
use App\CommercialPropertyForRent;
use App\CommercialPropertyForSale;
use App\Favorite;
use App\Http\Controllers\Admin\Jobs\JobController;
use App\Http\Controllers\Property\BusinessForSaleController;
use App\Http\Controllers\Property\CommercialPlotController;
use App\Http\Controllers\Property\CommercialPropertyForRentController;
use App\Http\Controllers\Property\CommercialPropertyForSaleController;
use App\Http\Controllers\Property\FlatWishesRentedController;
use App\Http\Controllers\Property\PropertyForRentController;
use App\Http\Controllers\Property\PropertyForSaleController;
use App\Http\Controllers\Property\PropertyHolidaysHomesForSaleController;
use App\Http\Controllers\PropertyController;
use App\Media;
use App\Models\Search;
use App\Models\Ad;
use App\Notification;
use App\Models\Meta;
use App\PropertyForSale;
use App\PropertyHolidaysHomesForSale;
use App\User;
use App\UserPackage;
use Carbon\Carbon;
use App\Admin\ads\Banner;
use App\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use App\Admin\Banners\BannerGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Session\Session;
use Intervention\Image\ImageManagerStatic as Image;
use \Illuminate\Http\Request;
use Pusher\Pusher;
use App\CommercialPlot;
use App\BusinessForSale;
use App\FlatWishesRented;
use App\PropertyForRent;
use function foo\func;
use Illuminate\Support\Facades\Mail;

class common
{
    public static function get_model_columns($Model)
    {
        $result = $Model::first();
        if($result){
            return array_keys($result->toArray());
        }
        return [];
    }
    public static function table_search(&$query, $columns, $search_key, $table)
    {
        $query->where(function ($query) use ($columns, $search_key, $table){
            if(isset($columns[0])){
                $query->where($table.'.'.$columns[0], 'LIKE', '%' . $search_key . '%');
            }
            for($i=1; $i<count($columns); $i++){
                if(isset($columns[$i])){
                    $query->orWhere($table.'.'.$columns[$i], 'LIKE', '%' . $search_key . '%');
                }
            }
        });
    }
    public static function map_json($json)
    {
        $returnable = "";
        if ($json) {
            $json_value = (json_decode($json));
            if ($json_value) {
                foreach (json_decode($json) as $key => $val):
                    $returnable .= $val . ', ';
                endforeach;
                return rtrim($returnable, ', ');

            } else {

                return rtrim($json, ', ');
            }


        }
    }

    public static function insert_term_array($arr, $taxonomy, $parent = 0)
    {
        $Parent = $parent;
        foreach ($arr as $value) {
            if (!is_array($value)) {
                $term = new Term(['name' => $value, 'slug' => Str::slug($value),
                    'taxonomy_id' => $taxonomy, 'parent' => $parent]);
                $term->save();
                $Parent = $term->id;
            } else {
                common::insert_term_array($value, $taxonomy, $Parent);
            }
        }
    }

    public static function map_nav($terms,$url_params='')
    {
        //
        $html = '<ul class="list list-unstyled">';
        foreach ($terms as $term) {
            $value = $term->taxonomy->slug == 'states_and_cities' ? $term->serial : $term->name;
            $html .= '
            <li>
                <div class="input-toggle">
                    <input type="checkbox" name="' . $term->taxonomy->slug . '[]" value="' . $value . '" id="' . $term->taxonomy->id . '-' . $term->id . '" '.($url_params ? is_numeric(array_search($value,$url_params)) ? "checked" : "" : "").'>
                    <label for="' . $term->taxonomy->id . '-' . $term->id . '" class="">' . $term->name . ' <span data-name="' . $term->name . '" data-title="' . $term->taxonomy->slug . '" class="count"></span></label>
                </div>
                ';
            if (!empty($terms = $term->getChildren)) {
                $html .= common::map_nav($terms);
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public static function getMediaPath($obj, $size = 'full')
    {
        $file_name = $obj->name_unique;
        $path = 'public/uploads/' . date('Y', strtotime($obj->updated_at)) . '/' . date('m', strtotime($obj->updated_at)) . '/';
        $return_able = '';
        if ($size != 'full') {
            $arr = explode('.', $obj->name_unique);
            $sz = explode('x', $size);
            if (is_array($arr) && count($arr) == 2) {
                $file = $path . $arr[0] . '-' . $size . '.' . $arr[1];
                if (!file_exists($path . $arr[0] . '.' . $arr[1])) {
                    $return_able = null;
                }
                if (!file_exists($file) && file_exists($path . $file_name)) {
                    Image::make($path . $obj->name_unique)->widen($sz[0])->heighten($sz[1])->save($path . $arr[0] . '-' . $size . '.' . $arr[1]);
                }
                $return_able = url('/') . '/' . $file;
            }
        }
        if (!$return_able) {
            $return_able = url('/') . '/' . $path . $file_name;
        }
        return $return_able;
    }


    public static function slug_unique($name, $num = 0, $Model, $collumn)
    {
        $slug_to_check = $num != 0 ? $name . '-' . $num : $name;
        $slug_to_check = Str::slug($slug_to_check);

        $media = $Model::where($collumn, $slug_to_check)->withTrashed()->first();
        if ($media != null) {
            $num++;
            return common::slug_unique($name, $num, $Model, $collumn);
        } else {
            return $slug_to_check;
        }
    }

    public static function name_unique($name, $num = 0, $Model, $collumn)
    {
        $slug_to_check = $num != 0 ? $name . '-' . $num : $name;

        $media = $Model::where($collumn, $slug_to_check)->first();
        if ($media != null) {
            $num++;
            return common::slug_unique($name, $num, $Model, $collumn);
        } else {
            return $slug_to_check;
        }
    }
//    public static function upload_media($file, $mediable_id, $mediable_type, $type = 'avatar')
//    {
//
//        $name_format = date('ymd') . '-' . time() . '-' . mt_rand(1000000, 9999999);
//
//        $name = $file->getClientOriginalName();
//        $unique_name = common::name_unique($name_format, 0, 'App\Media', 'name_unique');
//        $name_unique = $unique_name . '.' . $file->getClientOriginalExtension();
//        $path = 'public/uploads/' . date('Y') . '/' . date('m');
//
//        if ($file->getClientOriginalExtension() == 'jpg' ||
//            $file->getClientOriginalExtension() == 'jpeg' ||
//            $file->getClientOriginalExtension() == 'png'
//        ) {
//            $file->move($path, $name_unique);
//            Image::make(asset($path . '/' . $name_unique))->heighten(66)->widen(66)->save($path . '/' . $unique_name . '-66x66.' . $file->getClientOriginalExtension());
//            Image::make(asset($path . '/' . $name_unique))->heighten(150)->widen(150)->save($path . '/' . $unique_name . '-150x150.' . $file->getClientOriginalExtension());
//            Image::make(asset($path . '/' . $name_unique))->heighten(360)->widen(360)->save($path . '/' . $unique_name . '-360x360.' . $file->getClientOriginalExtension());
//            Image::make(asset($path . '/' . $name_unique))->heighten(570)->widen(570)->save($path . '/' . $unique_name . '-570x570.' . $file->getClientOriginalExtension());
//            Image::make(asset($path . '/' . $name_unique))->heighten(768)->widen(768)->save($path . '/' . $unique_name . '-768x768.' . $file->getClientOriginalExtension());
//            Image::make(asset($path . '/' . $name_unique))->heighten(1024)->widen(1024)->save($path . '/' . $unique_name . '-1024x1024.' . $file->getClientOriginalExtension());
//
//            $media = new Media(['mediable_id' => $mediable_id, 'mediable_type' => $mediable_type, 'name' => $name, 'name_unique' => $name_unique, 'type' => $type,]);
//            $media->save();
//        }
//    }

    public static function update_media($files, $mediable_id, $mediable_type, $type = 'avatar', $delete_old = 'true', $process_image = true,$banner_size = false)
    {
        $max_old_media_order = Media::where('mediable_type', $mediable_type)->where('mediable_id', $mediable_id)->where('type', $type)->orderBy('media_order', 'DESC')->first();
        if ($delete_old == 'true') {
            self::delete_media($mediable_id, $mediable_type, $type);
        }
        $order = 0;
        if ($max_old_media_order) {
            $order = $max_old_media_order->media_order;
        }

        if (!is_array($files)) {
            $files = array($files);
        }
        $names_files = array();
        $org_file_names = array();
        $file_names_encoded = array();
        $file_ids = array();
        foreach ($files as $key => $file) {
            $unique_name = date('ymd') . '-' . time() . '-' . mt_rand(1000000, 9999999);
            $name = $file->getClientOriginalName();
            $name_unique = $unique_name . '.' . $file->getClientOriginalExtension();
            $path = 'public/uploads/' . date('Y') . '/' . date('m');
            $file->move($path, $name_unique);
            if ((strtolower($file->getClientOriginalExtension()) == 'jpg' ||
                    strtolower($file->getClientOriginalExtension()) == 'jpeg' ||
                    strtolower($file->getClientOriginalExtension()) == 'png') &&
                $process_image
            ) {
                Image::make(asset($path . '/' . $name_unique))->heighten(66)->widen(66)->save($path . '/' . $unique_name . '-66x66.' . $file->getClientOriginalExtension());
                Image::make(asset($path . '/' . $name_unique))->heighten(150)->widen(150)->save($path . '/' . $unique_name . '-150x150.' . $file->getClientOriginalExtension());
                Image::make(asset($path . '/' . $name_unique))->heighten(250)->widen(250)->save($path . '/' . $unique_name . '-250x250.' . $file->getClientOriginalExtension());
                Image::make(asset($path . '/' . $name_unique))->heighten(360)->widen(360)->save($path . '/' . $unique_name . '-360x360.' . $file->getClientOriginalExtension());
                Image::make(asset($path . '/' . $name_unique))->heighten(570)->widen(570)->save($path . '/' . $unique_name . '-570x570.' . $file->getClientOriginalExtension());
                Image::make(asset($path . '/' . $name_unique))->heighten(768)->widen(768)->save($path . '/' . $unique_name . '-768x768.' . $file->getClientOriginalExtension());
                Image::make(asset($path . '/' . $name_unique))->heighten(1024)->widen(1024)->save($path . '/' . $unique_name . '-1024x1024.' . $file->getClientOriginalExtension());
                if ($banner_size) {
                   Image::make(asset($path . '/' . $name_unique))->heighten(150)->widen(1000)->save($path . '/' . $unique_name . '-1000x150.' . $file->getClientOriginalExtension());
                   Image::make(asset($path . '/' . $name_unique))->heighten(600)->widen(160)->save($path . '/' . $unique_name . '-160x600.' . $file->getClientOriginalExtension());


                }
            }
            $media = new Media(['mediable_id' => $mediable_id, 'mediable_type' => $mediable_type, 'name' => $name, 'name_unique' => $name_unique, 'type' => $type,]);
            $media->media_order = $order + 1;
            $media->save();
            $names_files[] = $media->name_unique;
            $org_file_names[] = $media->name;
            $file_names_encoded[] = base64_encode($media->name_unique);
            $file_ids[] = $media->id;
            $order++;
        }
        return [
            'file_names' => $names_files,
            'org_file_names' => $org_file_names,
            'file_names_encoded' => $file_names_encoded,
            'file_ids' => $file_ids,
        ];
    }

    public static function delete_media($mediable_id, $mediable_type, $type)
    {
        $obj_old_media = Media::where('mediable_id', $mediable_id)
            ->where('mediable_type', $mediable_type)
            ->where('type', $type);

        $old_media = $obj_old_media->get();
        if ($old_media) {

            if($mediable_type != 'App\Models\Cv\Cv'){
                foreach ($old_media as $obj) {
                    $path = 'public/uploads/' . date('Y', strtotime($obj->updated_at)) . '/' . date('m', strtotime($obj->updated_at)) . '/';
                    $arr = explode('.', $obj->name_unique);

                    foreach (glob($path . $arr[0] . '*.*') as $file) {
                        unlink($file);
                    }
                }
            }


            $obj_old_media->delete();

        }
    }

    public static function display_ad($location)
    {
        $id = 0;
        $banner_group = BannerGroup::where('location', '=', $location)->get()->first();
        if (isset($banner_group->banners)) {

            $satrt = Carbon::createFromDate($banner_group->time_start);
            $end = Carbon::createFromDate($banner_group->time_end);
            $testdate = $satrt->diff($end);
            // dump($testdate);

            foreach ($banner_group->banners as $banner):
                // echo "<a href='".$banner->link."' data-banner-id='".$banner->id."' class='ad_clicked  d-block w-100' data-id='".$id."' target='_blank'><img src='".asset(\App\Helpers\common::getMediaPath($banner->media,'300x200'))."' class='img-fluid m-auto' style='height:100%' alt=''></a>";
                echo "<img src='" . asset(\App\Helpers\common::getMediaPath($banner->media)) . "' class='img-fluid m-auto' style='height:100%' alt=''>";
                $id++;
            endforeach;
        }
    }

    public static function get_ad_attribute($obj, $attribute)
    {
        if ($obj) {
            if ($attribute == 'heading') {
                $heading = '';
                if ($obj->ad_type == 'property_for_rent' || $obj->ad_type == 'property_commercial_for_rent') {
                    $heading = $obj->property->heading;
                }
                if ($obj->ad_type == 'property_for_sale' || $obj->ad_type == 'property_flat_wishes_rented' || $obj->ad_type == 'property_commercial_for_sale' || $obj->ad_type == 'property_commercial_plots' || $obj->ad_type == 'property_business_for_sale') {
                    $heading = $obj->property->headline;
                }
                if ($obj->ad_type == 'property_holiday_home_for_sale') {
                    $heading = $obj->property->ad_headline;
                }
                if ($obj->ad_type == 'job') {
                    $heading = $obj->job->title;
                }
                return $heading;
            }

            if ($attribute == 'price') {
                $price = '';
                if ($obj->property) {
                    if ($obj->ad_type == 'property_for_rent') {
                        $price = $obj->property->monthly_rent;
                    }
                    if ($obj->ad_type == 'property_for_sale' || $obj->ad_type == 'property_commercial_plots') {
                        $price = $obj->property->asking_price;
                    }
                    if ($obj->ad_type == 'property_holiday_home_for_sale') {
                        $price = $obj->property->total_price;
                    }
                    if ($obj->ad_type == 'property_flat_wishes_rented') {
                        $price = $obj->property->max_rent_per_month;
                    }
                    if ($obj->ad_type == 'property_commercial_for_sale') {
                        $price = $obj->property->rental_income;
                    }
                    if ($obj->ad_type == 'property_commercial_for_rent') {
                        $price = $obj->property->rent_per_meter_per_year;
                    }
                    if ($obj->ad_type == 'property_business_for_sale') {
                        $price = $obj->property->price;
                    }
                }
                if ($obj->ad_type == 'job') {
                    $price = '';
                }
                return $price;
            }

            if ($attribute == 'started') {
                $started = '';
                if ($obj->ad_type == 'property_for_rent') {
                    $started = $obj->property->rented_from;
                }
                if ($obj->ad_type == 'property_commercial_for_rent') {
                    $started = $obj->property->availiable_from;
                }
                return $started;
            }

            if ($attribute == 'expired') {
                $expired = '';
                if ($obj->ad_type == 'property_for_rent') {
                    $expired = $obj->property->rented_to;
                }
                return $expired;
            }
        }
    }

    //Calculate favorite list total ads
    public static function count_list_ads($list_id)
    {
        $date = Date('y-m-d',strtotime('-7 days'));
        $total_list_ads = 0;
        $list_ads = \App\Favorite::where('user_id', Auth::id())->where('list_id', $list_id)->get();
        if ($list_ads->count() > 0) {
            foreach ($list_ads as $list_ad) {
                if ($list_ad->ad && $list_ad->ad->visibility && (strtotime($list_ad->ad->sold_at) > strtotime($date) || !$list_ad->ad->sold_at)) {
                    $total_list_ads = $total_list_ads + 1;
                }
            }
        }
        return $total_list_ads;
    }

//    get filter from url
    public static function get_request_from_search_url($url)
    {
        $arr = explode('/', $url);
        $arr_type = $arr[0];
        if ($arr_type == 'jobs') {
            $str = $arr[1];
        } else if ($arr_type == 'property') {
            $str = $arr[2];
        }
        $arr2 = explode('?', $str);
        $filter = $arr2[1];
        $array_filter = explode('&', $filter);
        $request = new Request();
        $request_arr = array();
        foreach ($array_filter as $key=>$value) {
            $count = 1;
            $pairs = explode('=', $value);
            if (count($pairs) > 1) {

                //Covert the ASCII code to space
                if($pairs[0] == 'search'){
                    $pairs[1] = str_replace("%20",' ',$pairs[1]);
                }

                //Covert the ASCII code to space
                if($pairs[0] == 'search'){
                    $pairs[1] = str_replace("+",' ',$pairs[1]);
                }

                //Covert the ASCII code to special character +
                 if($pairs[0] == 'search'){
                     $pairs[1] = str_replace("%2B",'+',$pairs[1]);
                 }

                //Covert the ASCII code to space
                if(strpos($pairs[0], '%5B%5D')){
                    $count++;
                    $pairs[0] = str_replace("%5B%5D",'',$pairs[0]);
                }

                //Covert the ASCII code to special character /
                if(strpos($pairs[1], '%2F')){
                    $pairs[1] = str_replace("%2F",'/',$pairs[1]);
                }
                //Covert the ASCII code to special character Æ
                if(strpos($pairs[1], '%C3%86')){
                    $pairs[1] = str_replace("%C3%86",'Æ',$pairs[1]);
                }
                $pairs[1] = str_replace("%C3%86",'Æ',$pairs[1]);

                //Covert the ASCII code to special character æ
                if(strpos($pairs[1], '%C3%A6')){
                    $pairs[1] = str_replace("%C3%A6",'æ',$pairs[1]);
                }

                //Covert the ASCII code to special character Ø
                if(strpos($pairs[1], '%C3%98')){
                    $pairs[1] = str_replace("%C3%98",'Ø',$pairs[1]);
                }

                //Covert the ASCII code to special character ø
                if(strpos($pairs[1], '%C3%B8')){
                    $pairs[1] = str_replace("%C3%B8",'ø',$pairs[1]);
                }

                //Covert the ASCII code to special character Å
                if(strpos($pairs[1], '%C3%85')){
                    $pairs[1] = str_replace("%C3%85",'Å',$pairs[1]);
                }

                //Covert the ASCII code to special character å
                if(strpos($pairs[1], '%C3%A5')){
                    $pairs[1] = str_replace("%C3%A5",'å',$pairs[1]);
                }

                //Covert the ASCII code to special character é
                if(strpos($pairs[1], '%C3%A9')){
                    $pairs[1] = str_replace("%C3%A9",'é',$pairs[1]);
                }

                //Covert the ASCII code to special character ,
                if(strpos($pairs[1], '%2C')){
                    $pairs[1] = str_replace("%2C",',',$pairs[1]);
                }


                if($count > 1){
                    $request_arr[$pairs[0]][] = $pairs[1];
                }

                $request->merge([$pairs[0] => $pairs[1]]);
            }
        }

        foreach ($request->all() as $request_key=>$request_obj){
            foreach ($request_arr as $arr_req_key=>$request_arr_obj){
                if($request_key == $arr_req_key){
                    $request->merge([$arr_req_key => $request_arr_obj]);
                    break;
                }
            }
        }

        return $request;
    }

//    check_job_from_search_parameters
    public static function check_job_from_search_parameters($request, Job $job)
    {
        $jobController = new JobController();
        $jobs = $jobController->mega_menu_search($request, true);
        if ($jobs) {
            $arr = $jobs->pluck('ad_id');
            if (in_array($job->ad_id, $arr->toArray())) {
                return true;
            }
        }
        return false;
    }

//    check_property_from_search_parameters
    public static function check_property_from_search_parameters($request, $property)
    {
        if ($property->ad->ad_type == 'property_for_sale') {
            $propertyController = new PropertyForSaleController();
            $properties = $propertyController->search_property_for_sale($request, true);
        } elseif ($property->ad->ad_type == 'property_for_rent') {
            $propertyController = new PropertyForRentController();
            $properties = $propertyController->search_property_for_rent($request, true);
        } elseif ($property->ad->ad_type == 'property_business_for_sale') {
            $propertyController = new BusinessForSaleController();
            $properties = $propertyController->search_business_for_sale($request, true);
        } elseif ($property->ad->ad_type == 'property_holiday_home_for_sale') {
            $propertyController = new PropertyHolidaysHomesForSaleController();
            $properties = $propertyController->search_holiday_homes_for_sale($request, true);
        } elseif ($property->ad->ad_type == 'property_commercial_for_rent') {
            $propertyController = new CommercialPropertyForRentController();
            $properties = $propertyController->search_commercial_property_for_rent($request, true);
        } elseif ($property->ad->ad_type == 'property_commercial_for_sale') {
            $propertyController = new CommercialPropertyForSaleController();
            $properties = $propertyController->search_commercial_property_for_sale($request, true);
        } elseif ($property->ad->ad_type == 'property_commercial_plots') {
            $propertyController = new CommercialPlotController();
            $properties = $propertyController->search_commercial_plots($request, true);
        } elseif ($property->ad->ad_type == 'property_flat_wishes_rented') {
            $propertyController = new FlatWishesRentedController();
            $properties = $propertyController->search_flat_wishes_rented($request, true);
        }
        if ($properties) {
            $arr = $properties->pluck('ad_id');
            if (in_array($property->ad_id, $arr->toArray())) {
                return true;
            }
        }
        return false;
    }

//    notification
    public static function send_search_notification($obj, $type, $message, Pusher $pusher, $searche_str, $ad)
    {
        $searches = \App\Models\Search::where('type', '=', 'saved')
            ->where('filter', 'like', '%' . $searche_str . '%')
            ->where('notification_web', '=', '1')
            ->get();
        if ($searches->count() > 0) {
            foreach ($searches as $search) {
                $req = common::get_request_from_search_url($search->filter);
//                if ($req) {
                $to_be_sent = false;
                if ($obj->ad->ad_type == 'job') {
                    $to_be_sent = common::check_job_from_search_parameters($req, $obj);
                } elseif ($obj->ad->ad_type == 'property_for_sale' ||
                    $obj->ad->ad_type == 'property_for_rent' ||
                    $obj->ad->ad_type == 'property_business_for_sale' ||
                    $obj->ad->ad_type == 'property_holiday_home_for_sale' ||
                    $obj->ad->ad_type == 'property_commercial_for_rent' ||
                    $obj->ad->ad_type == 'property_commercial_for_sale' ||
                    $obj->ad->ad_type == 'property_commercial_plots' ||
                    $obj->ad->ad_type == 'property_flat_wishes_rented'
                ) {
                    $to_be_sent = common::check_property_from_search_parameters($req, $obj);
                }

                if ($to_be_sent) {
                    $notif = new Notification(['notifiable_type' => Ad::class, 'type' => $type, 'user_id' => $search->user_id, 'notifiable_id' => $ad->id, 'data' => $message]);
                    $notif->save();
                    $data = array('detail' => $message, 'to_user_id' => $search->user_id);
                    $pusher->trigger('notification', 'notification-event', $data);

                    //Send email notification if user check the email notification in settings
                    $user_meta_notification_new_ad = Meta::where('metable_id',$search->user_id)->where('metable_type','App\User')->where('key','notification_new_ad')->first();
                    if($user_meta_notification_new_ad){
                        $user_meta_notification_email = Meta::where('metable_id',$search->user_id)->where('metable_type','App\User')->where('key','notification_email')->first();
                        $user_obj = User::find($search->user_id);
                        if($user_meta_notification_email && $user_obj && $user_obj->email){
                            common::property_email_notification($user_obj,'saved_searches',$ad,$search);
                        }
                    }
                }
//                }
            }
        }
    }

    //find account setting alternative email verified or not.
    public static function is_account_setting_alt_email_verified($obj)
    {
        $flag = '';
        if ($obj) {
            $is_email_verified = Meta::where('metable_id', $obj->metable_id)->where('metable_type', $obj->metable_type)
                ->where('key', 'account_setting_alt_email_verified')->where('value', $obj->value)->first();
            if ($is_email_verified) {
                $flag = 'success';
            }
        }
        return $flag;
    }

    //Upload dropzone images
    public static function upload_dropzone_images(Request $request)
    {
        $mediable_id = '';
        if ($request->ad_id) {
            $mediable_id = $request->ad_id;
        }
        if ($request->file('files')) {
            $files = $request->file('files');
            if ($mediable_id) {
                return common::update_media($files, $mediable_id, 'App\Models\Ad', 'gallery', 'false');
            } else {
                return common::update_media($files, Auth::user()->id, $request->upload_dropzone_images_type, 'gallery', 'false');
            }
        }
    }

    //Updated the dropzone image
    public static function updated_dropzone_images_type($request, $mediable_type, $ad_id = '')
    {
        if (count($request) > 0) {
            foreach ($request as $key => $value) {
                if (preg_match('/image_title/', $key)) {
                    $explode_values = explode('_', $key);
                    $name_unique = '';
                    if (count($explode_values) > 3) {
                        if ($explode_values[2] && $explode_values[3]) {
                            $name_unique = $explode_values[2] . '.' . $explode_values[3];
                        }
                        if ($name_unique) {
                            $media = Media::where('name_unique', $name_unique)->first();
                            if ($media) {
                                $media->title = $value;
                                $media->update();
                            }
                        }
                    }
                    unset($request[$key]);
                }
            }
        }

        $temp_media = Media::where('mediable_id', Auth::user()->id)->where('mediable_type', $mediable_type)->get();
        if ($temp_media->count() > 0 && $ad_id) {
            $max_old_media_order = Media::where('mediable_type', 'App\Models\Ad')->where('mediable_id', $ad_id)->where('type', 'gallery')->orderBy('media_order', 'DESC')->first();

            $order = 0;
            if ($max_old_media_order) {
                $order = $max_old_media_order->media_order;
            }
            foreach ($temp_media as $key => $temp_media_obj) {
                $temp_media_obj->mediable_id = $ad_id;
                $temp_media_obj->mediable_type = 'App\Models\Ad';
                $temp_media_obj->media_order = $order+1;
                $temp_media_obj->update();
                $order++;
            }

        }
        return $request;
    }

    public static function fav_mark_sold_notification(Ad $ad, Pusher $pusher){
        $users = DB::table('favorites')
            ->join('metas', 'metas.metable_id', '=', 'favorites.user_id')
            ->where('metas.metable_type', '=', 'App\User')
            ->where('favorites.ad_id', '=', $ad->id)
            ->where('metas.key', '=', 'notification_ad_sold')
            ->where('metas.value', '=', 1)
            ->get();
        if($users){
            $ids = $users->pluck('user_id');
            foreach ($ids as $user_id) {
                $notif = new Notification(['notifiable_type' => Ad::class, 'type' => 'ad_sold', 'user_id' => $user_id, 'notifiable_id' => $ad->id, 'data' => 'Eiendom er solgt']);
                $notif->save();
                $data = array('detail' => 'Eiendom er solgt', 'to_user_id' => $user_id);
                $pusher->trigger('notification', 'notification-event', $data);

                //Send email notification if user check the email notification in settings
                $user_meta = Meta::where('metable_id',$user_id)->where('metable_type','App\User')->where('key','notification_email')->first();
                $user_obj = User::find($user_id);
                if($user_meta && $user_obj && $user_obj->email){
                        common::property_email_notification($user_obj,'ad_sold_or_rented',$ad,'');
                }
            }
        }
    }

    // update notification for property 
    public static function property_notification(Ad $ad, Pusher $pusher,$user_id, $property_type){
        $users = DB::table('favorites')
            ->join('metas', 'metas.metable_id', '=', 'favorites.user_id')
            ->where('metas.metable_type', '=', 'App\User')
            ->where('favorites.ad_id', '=', $ad->id)
            ->where('metas.key', '=', 'notification_price_changed')
            ->where('metas.value', '=', 1)
            ->get();
        if($users){
            $ids = $users->pluck('user_id');
            foreach ($ids as $user_id) {

                $notif = new Notification(['notifiable_type' => Ad::class, 'type' => $property_type, 'user_id' => $user_id, 'notifiable_id' => $ad->id, 'data' => 'Prisen har blitt endret']);
                $notif->save();
                $data = array('detail' => 'Eiendom oppdatert', 'to_user_id' => $user_id);
                $pusher->trigger('notification', 'notification-event', $data);


                //Send email notification if user check the email notification in settings
                $user_meta = Meta::where('metable_id',$user_id)->where('metable_type','App\User')->where('key','notification_email')->first();
                $user_obj = User::find($user_id);
                if($user_meta && $user_obj && $user_obj->email){
                    common::property_email_notification($user_obj,'price_changed',$ad,'');
                }
            }
        }
    }

    //Notify user via email when he/she checked the email notify in his/her setting
    public static function property_email_notification($user_obj,$key,$ad='',$search=''){
        if($user_obj && $key){
            if($key == 'price_changed' && $ad){
                $text = 'Vi vil informere deg om at prisen er endret fra denne <b>'.$ad->getTitle().'</b> annonsen. Her er lenken til annonsen.';
                $link = url('/',$ad->id);
                $subject = 'Annonseprisen ble endret';
            }

            if($key == 'ad_sold_or_rented' && $ad){
                if($ad->ad_type == 'property_for_rent' || $ad->ad_type == 'property_flat_wishes_rented' || $ad->ad_type == 'property_commercial_for_rent'){
                    $status = 'Utleid';
                }else{
                    $status = 'Solgt';
                }
                $text = 'Vi vil informere deg om at <b>'.$ad->getTitle().'</b> annonse er '.$status.'. Her er lenken til annonsen.';
                $link = url('/',$ad->id);
                $subject = 'Annonse '.$status;
            }

            if($key == 'saved_searches' && $search && $ad){
                $text = 'Vi vil informere deg om at det er lagt til en ny annonse på NorgesHandel relatert til lagrede søk. Her er lenken til annonsen.';
                $link = url('/',$ad->id);
                $subject = 'Ny annonse opprettet';
            }

            if($key == 'price_changed'&& $ad){
                $text = 'Vi vil informere deg om at prisen er endret fra denne <b>'.$ad->getTitle().'</b> annonsen. Her er lenken til annonsen.';
                $link = url('/',$ad->id);
                $subject = 'Pris endret';
            }

            $to_name = $user_obj->username;
            $to_email = $user_obj->email;
            Mail::send('mail.property_email_notification',compact('text','link','user_obj'), function ($message) use ($to_name, $to_email,$subject) {
                $message->to($to_email, $to_name)->subject($subject);
                $message->from('developer@digitalmx.no', 'NorgesHandel');
            });
        }
    }

    //find previous ad
    public static function previous_ad($obj){
        $prev = '';
        if($obj && $obj->ad){
            $ad = $obj->ad;
            $date = Date('y-m-d',strtotime('-7 days'));
            $prev = Ad::where('ad_type',$ad->ad_type)
                ->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->where('visibility',1)
                ->where('id', '<', $ad->id)->orderBy('id', 'desc')->first();
        }
        return $prev;
    }

    //find next ad
    public static function next_ad($obj){
        $next = '';
        if($obj && $obj->ad){
            $ad = $obj->ad;
            $date = Date('y-m-d',strtotime('-7 days'));
            $next = Ad::where('ad_type',$ad->ad_type)
                ->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->where('visibility',1)
                ->where('id', '>', $ad->id)->orderBy('id', 'asc')->first();
        }
        return $next;
    }

    //Update media position
    public static function update_media_position($arr){
        if (isset($arr)) {
            $data = json_decode($arr);
            foreach ($data as $key=>$data_arr) {
                $response['flag'] = 'success';
                $media = Media::where('name_unique', $data_arr[0])->first();
                if ($media) {
                    $media->media_order = $data_arr[1];
                    $media->save();
                }
            }
        }
        return 'success';
    }

    //Delete Media using edit form
    public static function delete_json_media($arr){
        if($arr){
            $arr = json_decode($arr);
            if($arr){
                foreach ($arr as $arr_obj){
                    $media = Media::where('name_unique', $arr_obj)->first();
                    if ($media) {
                        $path = 'public/uploads/' . date('Y', strtotime($media->updated_at)) . '/' . date('m', strtotime($media->updated_at)) . '/';
                        $arr = explode('.', $media->name_unique);

                        foreach (glob($path . $arr[0] . '*.*') as $file) {
                            unlink($file);
                        }
                        $media->delete();
                    }
                }
                return 'success';
            }
        }
        return '';
    }

    //sync ad agents (add/remove colleagues for agent user role)
    public static function sync_ad_agents($ad,$agent_id_arr){
        if(Auth::user()->hasRole('company') || Auth::user()->created_by_company_id){
            $ad->agents()->sync($agent_id_arr);
        }
    }

    // Ad vistings times (like property for rent, sales, holiday homes for sales)
    public static function ad_visting_time($ad,$request){
        if(count($request->delivery_date) || count($request->time_start) || count($request->time_end) || count($request->note)){
            $max_val = max(count($request->delivery_date),count($request->time_start),count($request->time_end),count($request->note));
            if($max_val){
                AdVistingTime::where('ad_id',$ad->id)->delete();
                for ($i=0;$i<$max_val;$i++){
                    $ad_visting_time = new AdVistingTime();
                    $ad_visting_time->ad_id = $ad->id;
                    $ad_visting_time->delivery_date = $request->delivery_date[$i];
                    $ad_visting_time->time_start = $request->time_start[$i];
                    $ad_visting_time->time_end = $request->time_end[$i];
                    $ad_visting_time->note = $request->note[$i];
                    $ad_visting_time->save();
                }
            }
        }
    }

    // Get commitment jobs against a company
    public static function company_commitment_jobs($company_id,$type){
        $count = 0;
        $jobs = DB::table('ads')
            ->join('jobs', 'ads.id', '=', 'jobs.ad_id')
            ->where('ads.status', '=', 'published')
            ->where('ads.ad_type', '=', 'job')
            ->where('ads.visibility',1)
            ->whereNull('jobs.deleted_at')
            ->whereNull('ads.deleted_at')
            ->where('jobs.company_id',$company_id)
            ->where(function ($query) use ($type){
                if ($type != 'all'){
                    $query->where('jobs.commitment_type',$type);
                }
            })
            ->where('ads.visibility','=',1)->get();
        return $jobs;
    }

    //Property Map Filters
    public static function propertyMapFilters($query){
        $all_ads = $query->get();
         $full_path = array();
          foreach($all_ads as $ad){
              $ad = Ad::find($ad->ad_id);
              if($ad->company_gallery->first() && $ad->company_gallery->first()->name_unique){
                $full_path[] = \App\Helpers\common::getMediaPath($ad->company_gallery->first());
              //  dd($full_path);
              }
              else{
                  $full_path[] = asset('public/images/placeholder.png');

              }
          }

        array_walk_recursive($all_ads, function (&$ad) use (&$full_path) {
            $ad->full_path = current($full_path);
            next($full_path);
        });
        return $all_ads;
    } 

    //Send site and email notification to user according to job preferences related to
    public static function job_preferences_notifications($ad,$pusher){
        if($ad && $ad->job && $ad->job->company_id && $ad->job->company && $ad->job->company->followings->count() ){
            foreach ($ad->job->company->followings as $following){
                $count = 0;
                $functions = $cities = array();

                //find job functions
                if($following->user && $following->user->job_preference_key_words->count() > 0 && $ad->job->job_function){
                    $functions = $following->user->job_preference_key_words->pluck('key_word')->toArray();
                    if(is_numeric(array_search($ad->job->job_function,$functions))){
                        $count++;
                    }
                }

                // find job city
                if($following->user && $following->user->job_preference_cities->count() > 0 && $ad->job->zip_city){
                    $cities = $following->user->job_preference_cities->pluck('city')->toArray();
                    if(is_numeric(array_search($ad->job->zip_city,$functions))){
                        $count++;
                    }
                }
                //send email and site notification
                if($count){
                    $notif = new Notification(['notifiable_type' => Ad::class, 'type' => 'new_job_posted', 'user_id' => $following->user->id, 'notifiable_id' => $ad->id, 'data' => 'En ny jobb legges ut relatert til din jobbpreferanse.']);
                    $notif->save();
                    $data = array('detail' => 'En ny jobb legges ut relatert til din jobbpreferanse.', 'to_user_id' => $following->user->id);
                    $pusher->trigger('notification', 'notification-event', $data);


                    if($following->user->email){
                        $text = 'Vi vil informere deg om at en ny jobb er lagt ut i henhold til dine stillingspreferanser. Her er koblingen til jobben.';
                        $link = url('/',$ad->id);
                        $subject = 'Ny jobb lagt ut';
                        $user_obj = $following->user;
                        $to_name = $following->user->username;
                        $to_email = $following->user->email;
                        Mail::send('mail.property_email_notification',compact('text','link','user_obj'), function ($message) use ($to_name, $to_email,$subject) {
                            $message->to($to_email, $to_name)->subject($subject);
                            $message->from('developer@digitalmx.no', 'NorgesHandel');
                        });
                    }
                }
            }
        }

    }

    //find nearby ads related to current location using lati and longs and miles
    public static function find_nearby_ads($lat,$lon,$query,$table_name){
        $query->WhereNotNull($table_name.'.latitude')->WhereNotNull($table_name.'.longitude')
        ->select($table_name.".*","ads.published_on","ads.updated_at"
            ,DB::raw("6371 * acos(cos(radians(" . $lat . "))
                        * cos(radians(".$table_name.".latitude))
                        * cos(radians(".$table_name.".longitude) - radians(" . $lon . "))
                        + sin(radians(" .$lat. "))
                        * sin(radians(".$table_name.".latitude))) AS distance"))
            ->orderBy('distance','ASC')->distinct();
        /*
        $d = 31.0686;       //50km in miles ;
        $r = 3959;          //earth's radius in miles
        $latitude = $lat;   //58.32775757729577;
        $longitude = $lon;  //8.218992760525595;

        $latN = rad2deg(asin(sin(deg2rad($latitude)) * cos($d / $r)
            + cos(deg2rad($latitude)) * sin($d / $r) * cos(deg2rad(0))));

        $latS = rad2deg(asin(sin(deg2rad($latitude)) * cos($d / $r)
            + cos(deg2rad($latitude)) * sin($d / $r) * cos(deg2rad(180))));

        $lonE = rad2deg(deg2rad($longitude) + atan2(sin(deg2rad(90))
                * sin($d / $r) * cos(deg2rad($latitude)), cos($d / $r)
                - sin(deg2rad($latitude)) * sin(deg2rad($latN))));

        $lonW = rad2deg(deg2rad($longitude) + atan2(sin(deg2rad(270))
                * sin($d / $r) * cos(deg2rad($latitude)), cos($d / $r)
                - sin(deg2rad($latitude)) * sin(deg2rad($latN)))); //longitude
        $query->where($table_name.'.latitude','<=',$latN)->where($table_name.'.latitude','>=',$latS)
            ->where($table_name.'.longitude','<=',$lonE)->where($table_name.'.longitude','>=',$lonW);
        */
    }

    //check user packages is exist(active package) or not, if exist then -1 from available ads and add the ad expiry in the table
    public static function create_update_ad_expiry($ad){
        $flag = false;
        $message = 'success';
        if(Auth::user()){
            $user_package = Auth::user()->packages->where('status',12)->first();
            if($user_package && $user_package->available_ads){
                $temp_avail_ads = $user_package->available_ads - 1;
                $user_package->available_ads = $temp_avail_ads;
                DB::beginTransaction();
                try{
                    $temp_avail_ads->update();
                    //Create ad expiry
                    UserPackage::updateOrCreate(['user_id' => Auth::id(),'package_id',$user_package->id], ['available_ads' => $temp_avail_ads]);
                    DB::commit();
                    $flag = true;
                }catch (\Exception $e){
                    DB::rollback();
                    $flag = false;
                    $message = 'Noe gikk galt. Prøv igjen senere.';
                }
            }else{
                $message = 'Pakken ble ikke funnet.';
            }
        }

        $data['message'] = $message;
        $data['flag'] = $flag;
        dd($data);
        return $data;
    }
}
