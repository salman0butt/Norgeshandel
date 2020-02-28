<?php
namespace App\Helpers;

use App\Media;
use Carbon\Carbon;
use App\Admin\ads\Banner;
use App\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Admin\Banners\BannerGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Session\Session;
use Intervention\Image\ImageManagerStatic as Image;

class common
{
    public static function map_json($json){
        $returnable = "";
        foreach(json_decode($json) as $val):
            $returnable .= $val.', ';
        endforeach;
        return rtrim($returnable, ', ');
    }

    public static function insert_term_array($arr, $taxonomy, $parent = 0){
        $Parent = $parent;
        foreach ($arr as $value) {
            if (!is_array($value)) {
                $term = new Term(['name' => $value, 'slug' => Str::slug($value),
                    'taxonomy_id'=>$taxonomy,'parent' => $parent]);
                $term->save();
                $Parent = $term->id;
            } else {
                common::insert_term_array($value, $taxonomy, $Parent);
            }
        }
    }

    public static function map_nav($terms)
    {
        $html = '<ul class="list list-unstyled">';
        foreach ($terms as $term) {
            $html .= '
            <li>
                <div class="input-toggle">
                    <input type="checkbox" name="' . $term->taxonomy->slug . '[]" value="'.$term->name.'" id="'.$term->taxonomy->id.'-'.$term->id.'">
                    <label for="'.$term->taxonomy->id.'-'.$term->id.'" class="">'.$term->name . ' <span data-name="'.$term->name.'" data-title="'.$term->taxonomy->slug.'" class="count"></span></label>
                </div>
                ';
            if (!empty($terms = $term->getChildren)) {
                $html.= common::map_nav($terms);
            }
            $html .= '</li>';
        }
        $html.='</ul>';
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
                if(!file_exists($path . $arr[0] . '.' . $arr[1])){
                    $return_able =  null;
                }
                if (!file_exists($file) && file_exists($path.$file_name)) {
                    Image::make($path . $obj->name_unique)->widen($sz[0])->heighten($sz[1])->save($path . $arr[0] . '-' . $size . '.' . $arr[1]);
                }
                $return_able =  url('/') . '/' . $file;
            }
        }
        if(!$return_able){
            $return_able = url('/') . '/' . $path . $file_name;
        }
        return $return_able;
    }


    public static function slug_unique($name, $num = 0, $Model, $collumn)
    {
        $slug_to_check = $num != 0 ? $name . '-' . $num : $name;
        $slug_to_check = Str::slug($slug_to_check);

        $media = $Model::where($collumn, $slug_to_check)->first();
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

    public static function update_media($files, $mediable_id, $mediable_type, $type = 'avatar',$delete_old='true',$process_image=true)
    {
        $max_old_media_order = Media::where('mediable_type',$mediable_type)->where('mediable_id',$mediable_id)->where('type',$type)->orderBy('order','DESC')->first();
        if($delete_old == 'true') {
            self::delete_media($mediable_id, $mediable_type, $type);
        }
        $order = 0;
        if($max_old_media_order){
            $order = $max_old_media_order->order;
        }

        if (!is_array($files)) {
            $files = array($files);
        }
        $names_files = array();
        $org_file_names = array();
        $file_names_encoded = array();
        foreach ($files as $key=>$file) {
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
            }
            $media = new Media(['mediable_id' => $mediable_id, 'mediable_type' => $mediable_type, 'name' => $name, 'name_unique' => $name_unique, 'type' => $type,]);
            $media->order = $order + 1;
            $media->save();
            $names_files[] = $media->name_unique;
            $org_file_names[] = $media->name;
            $file_names_encoded[] = base64_encode($media->name_unique);
            $order++;
        }
        return json_encode([
        'file_names' => $names_files,
        'org_file_names' => $org_file_names,
        'file_names_encoded' => $file_names_encoded,
        ]);
    }

    public static function delete_media($mediable_id, $mediable_type, $type)
    {
        $obj_old_media = Media::where('mediable_id', $mediable_id)
            ->where('mediable_type', $mediable_type)
            ->where('type', $type);
//        dd($obj_old_media);
        $old_media = $obj_old_media->get();
        if ($old_media) {
            foreach ($old_media as $obj) {
                $path = 'public/uploads/' . date('Y', strtotime($obj->updated_at)) . '/' . date('m', strtotime($obj->updated_at)) . '/';
                $arr = explode('.', $obj->name_unique);

                foreach (glob($path . $arr[0] . '*.*') as $file) {
                    unlink($file);
                }
            }
            $obj_old_media->delete();
        }
    }
    public static function display_ad($location){
        $id = 0;
        $banner_group = BannerGroup::where('location','=',$location)->get()->first();
        if (isset($banner_group->banners)) {

                $satrt = Carbon::createFromDate($banner_group->time_start);
                $end = Carbon::createFromDate($banner_group->time_end);
                $testdate = $satrt->diff($end);
                // dump($testdate);

            foreach($banner_group->banners as $banner):
                // dd($banner->display_time_duration);

                // echo "<a href='".$banner->link."' data-banner-id='".$banner->id."' class='ad_clicked  d-block w-100' data-id='".$id."' target='_blank'><img src='".asset(\App\Helpers\common::getMediaPath($banner->media,'300x200'))."' class='img-fluid m-auto' style='height:100%' alt=''></a>";
                echo "<img src='".asset(\App\Helpers\common::getMediaPath($banner->media))."' class='img-fluid m-auto' style='height:100%' alt=''>";
                $id++;
            endforeach;
            }
    }

    public static function get_ad_attribute($obj,$attribute){
        if($obj){
            if($attribute == 'heading'){
                $heading = '';
                if($obj->ad_type  == 'property_for_rent' || $obj->ad_type == 'property_commercial_for_rent'){
                    $heading = $obj->property->heading;
                }if($obj->ad_type  == 'property_for_sale' || $obj->ad_type == 'property_flat_wishes_rented' || $obj->ad_type == 'property_commercial_for_sale' || $obj->ad_type == 'property_commercial_plots' || $obj->ad_type == 'property_business_for_sale'){
                    $heading = $obj->property->headline;
                }if($obj->ad_type  == 'property_holiday_home_for_sale'){
                    $heading = $obj->property->ad_headline;
                }if($obj->ad_type == 'job'){
                    $heading = $obj->job->title;
                }
                return $heading;
            }

            if($attribute == 'started'){
                $started = '';
                if($obj->ad_type  == 'property_for_rent'){
                    $started = $obj->property->rented_from;
                }
                if($obj->ad_type  == 'property_commercial_for_rent'){
                    $started = $obj->property->availiable_from;
                }
                return $started;
            }

            if($attribute == 'expired'){
                $expired = '';
                if($obj->ad_type  == 'property_for_rent'){
                    $expired = $obj->property->rented_to;
                }
                return $expired;
            }
        }
    }

    //Calculate favorite list total ads
    public static function count_list_ads($list_id){
        $total_list_ads = 0;
        $list_ads = \App\Favorite::where('user_id',Auth::id())->where('list_id',$list_id)->get();
        if($list_ads->count() > 0){
            foreach ($list_ads as $list_ad){
                if($list_ad->ad){
                    $total_list_ads = $total_list_ads + 1;
                }
            }
        }
        return $total_list_ads;
    }
}
