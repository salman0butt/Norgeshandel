<?php
namespace App\Helpers;

use App\Media;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

require 'vendor/autoload.php';

use Intervention\Image\ImageManagerStatic as Image;

class common
{
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

}
