<?php
namespace App\Helpers;

use App\Media;
use App\Admin\ads\Banner;
use App\Term;
use Illuminate\Support\Str;
use App\Admin\Banners\BannerGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Session\Session;
use Intervention\Image\ImageManagerStatic as Image;

require 'vendor/autoload.php';

class common
{
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
        if ($size != 'full') {
            $arr = explode('.', $obj->name_unique);
            $sz = explode('x', $size);
            if (is_array($arr) && count($arr) == 2) {
                $file = $path . $arr[0] . '-' . $size . '.' . $arr[1];
                if(!file_exists($path . $arr[0] . '.' . $arr[1])){
                    return null;
                }
                if (!file_exists($file)) {
                    Image::make($path . $obj->name_unique)->widen($sz[0])->heighten($sz[1])->save($path . $arr[0] . '-' . $size . '.' . $arr[1]);
                }
//                dd($file);
                return url('/') . '/' . $file;
            }
        }
        return url('/') . '/' . $path . $file_name;
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

    public static function update_media($files, $mediable_id, $mediable_type, $type = 'avatar')
    {
        self::delete_media($mediable_id, $mediable_type, $type);
        if (!is_array($files)) {
            $files = array($files);
        }

        foreach ($files as $file) {
            $unique_name = date('ymd') . '-' . time() . '-' . mt_rand(1000000, 9999999);
            $name = $file->getClientOriginalName();
            $name_unique = $unique_name . '.' . $file->getClientOriginalExtension();
            $path = 'public/uploads/' . date('Y') . '/' . date('m');
            if (strtolower($file->getClientOriginalExtension()) == 'jpg' ||
                strtolower($file->getClientOriginalExtension()) == 'jpeg' ||
                strtolower($file->getClientOriginalExtension()) == 'png'
            ) {
                $file->move($path, $name_unique);
                Image::make(asset($path . '/' . $name_unique))->heighten(66)->widen(66)->save($path . '/' . $unique_name . '-66x66.' . $file->getClientOriginalExtension());
                Image::make(asset($path . '/' . $name_unique))->heighten(150)->widen(150)->save($path . '/' . $unique_name . '-150x150.' . $file->getClientOriginalExtension());
                Image::make(asset($path . '/' . $name_unique))->heighten(250)->widen(250)->save($path . '/' . $unique_name . '-250x250.' . $file->getClientOriginalExtension());
                Image::make(asset($path . '/' . $name_unique))->heighten(360)->widen(360)->save($path . '/' . $unique_name . '-360x360.' . $file->getClientOriginalExtension());
                Image::make(asset($path . '/' . $name_unique))->heighten(570)->widen(570)->save($path . '/' . $unique_name . '-570x570.' . $file->getClientOriginalExtension());
                Image::make(asset($path . '/' . $name_unique))->heighten(768)->widen(768)->save($path . '/' . $unique_name . '-768x768.' . $file->getClientOriginalExtension());
                Image::make(asset($path . '/' . $name_unique))->heighten(1024)->widen(1024)->save($path . '/' . $unique_name . '-1024x1024.' . $file->getClientOriginalExtension());
                $media = new Media(['mediable_id' => $mediable_id, 'mediable_type' => $mediable_type, 'name' => $name, 'name_unique' => $name_unique, 'type' => $type,]);
                $media->save();
            }
        }
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
        $banner_group = BannerGroup::where('location','=',$location)->get()->first();

        if(!empty($banner_group)) {
            foreach ($banner_group->banners as $banner):
                // dd($banner->display_time_duration);
                if ($banner->is_active) {

                    // if ($banner->display_time_duration > '20') {
                    echo "<a href='" . $banner->link . "' data-banner-id='" . $banner->id . "' class='ad_clicked' target='_blank'><img src='" . asset(\App\Helpers\common::getMediaPath($banner->media)) . "' class='img-fluid m-auto' style='height:100%' alt=''></a>";
                    // }
                }
            endforeach;
        }
    }

}
