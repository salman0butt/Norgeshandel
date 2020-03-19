<?php

namespace App\Http\Controllers;

use App\Media;
use App\Models\Ad;
use App\Model\Search;
use App\CommercialPlot;
use App\Helpers\common;
use App\BusinessForSale;
use App\PropertyForRent;
use App\PropertyForSale;
use App\FlatWishesRented;
use Illuminate\Http\Request;
use App\CommercialPropertyForRent;
use App\CommercialPropertyForSale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\PropertyHolidaysHomesForSale;
use Illuminate\Support\Facades\Session;

class PropertyController extends Controller
{
//    zain
    public function complete_property($id)
    {
        $ad = Ad::find($id);
        if ($ad) {
            if ($ad->ad_type == 'property_for_sale') {
                common::delete_media(Auth::user()->id, 'property_for_sale_temp_images', 'gallery');
                $property_for_sale1 = $ad->property;
                if ($property_for_sale1) {
                    return view('user-panel.property.new_sale_add', compact('property_for_sale1'));
                }
            } else if ($ad->ad_type == 'property_for_rent') {
                common::delete_media(Auth::user()->id, 'property_for_rent_temp_images', 'gallery');
                $property_for_rent1 = $ad->property;
                return view('user-panel.property.new_add', compact('property_for_rent1'));
            } else if ($ad->ad_type == 'property_flat_wishes_rented') {
                common::delete_media(Auth::user()->id, 'flat_wishes_rented_temp_images', 'gallery');
                $flat_wishes_rented1 = $ad->property;
                return view('user-panel.property.flat_wishes_rented', compact('flat_wishes_rented1'));
            } else if ($ad->ad_type == 'property_holiday_home_for_sale') {
                common::delete_media(Auth::user()->id, 'holiday_home_for_sale_temp_images', 'gallery');
                $holiday_home_for_sale1 = $ad->property;
                return view('user-panel.property.holiday_home_for_sale', compact('holiday_home_for_sale1'));
            } else if ($ad->ad_type == 'property_commercial_for_sale') {
                common::delete_media(Auth::user()->id, 'commercial_property_for_sale_temp_images', 'gallery');
                $commercial_property = $ad->property;
                return view('user-panel.property.commercial_property_for_sale', compact('commercial_property'));
            } else if ($ad->ad_type == 'property_commercial_for_rent') {
                common::delete_media(Auth::user()->id, 'commercial_property_for_rent_temp_images', 'gallery');
                $commercial_for_rent = $ad->property;
                return view('user-panel.property.commercial_property_for_rent', compact('commercial_for_rent'));
            } else if ($ad->ad_type == 'property_business_for_sale') {
                common::delete_media(Auth::user()->id, 'business_for_sale_temp_images', 'gallery');
                $business_for_sale = $ad->property;
                return view('user-panel.property.business_for_sale', compact('business_for_sale'));
            } else if ($ad->ad_type == 'property_commercial_plots') {
                common::delete_media(Auth::user()->id, 'commercial_plots_temp_images', 'gallery');
                $commercial_plots = $ad->property;
                return view('user-panel.property.commercial_plots', compact('commercial_plots'));
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public
    function list()
    {
        $saved_search = Search::where('type', 'saved')->orderBy('id', 'desc')->limit(5)->get();
        $recent_search = Search::where('type', 'recent')->orderBy('id', 'desc')->limit(5)->get();
        $ads = Ad::where('status', 'published')
            ->where('ad_type', '!=', 'job')
            ->where('visibility', '=', 1)
            ->orderBy('id', 'desc')->get();

        return view('user-panel.property.property_list', compact('ads', 'saved_search', 'recent_search'));
    }

    public function property_destroy($obj)
    {
        // $obj has ad id
        $ad = Ad::find($obj);
        if ($ad) {
            DB::beginTransaction();
            try {
                if (!Auth::user()->hasRole('admin') && $ad && $ad->property && $ad->property->user_id != Auth::id()) {
                    abort(404);
                }
                if ($ad->property) {
                    $ad->property->delete();
                }
                $ad_id = $ad->id;
                $ad->delete();
                DB::commit();
                Session::flash('success', 'Eiendom ble slettet.');
                return redirect(url('my-business/my-ads'));

            } catch (\Exception $e) {
                DB::rollback();
                Session::flash('danger', 'Noe gikk galt.');
                return back();
            }
        } else {
            abort(404);
        }
    }

//  IMPORTANT:    INSTEAD OF THIS FUNCTION JUST USE THIS ROUTE {{url('/', $ad->id)}}
    public function generalPropertyDescription($id, $type)
    {
        if ($type == 'property_for_rent') {
            $property_data = PropertyForRent::where('id', $id)->first();
            $this->store_ad_views($property_data);
            return view('common.partials.property.property_description')->with(compact('property_data'));
        } else if ($type == 'property_for_sale') {
            $property_data = PropertyForSale::where('id', $id)->first();
            $this->store_ad_views($property_data);
            return view('common.partials.property.property_for_sale_description')->with(compact('property_data'));
        } else if ($type == 'property_holiday_home_for_sale') {
            $property_data = PropertyHolidaysHomesForSale::where('id', $id)->first();
            $this->store_ad_views($property_data);
            return view('common.partials.property.holiday_home_for_sale_description')->with(compact('property_data'));
        } else if ($type == 'property_flat_wishes_rented') {
            $property_data = FlatWishesRented::where('id', $id)->first();
            $this->store_ad_views($property_data);
            return view('common.partials.property.flat_wishes_rented_description')->with(compact('property_data'));
        } else if ($type == 'property_commercial_for_sale') {
            $property_data = CommercialPropertyForSale::where('id', $id)->first();
            $this->store_ad_views($property_data);
            return view('common.partials.property.commercialproperty_for_sale_description')->with(compact('property_data'));
        } else if ($type == 'property_commercial_for_rent') {
            $property_data = CommercialPropertyForRent::where('id', $id)->first();
            $this->store_ad_views($property_data);
            return view('common.partials.property.commercialproperty_for_rent_description')->with(compact('property_data'));
        } else if ($type == 'property_commercial_plots') {
            $property_data = CommercialPlot::where('id', $id)->first();
            $this->store_ad_views($property_data);
            return view('common.partials.property.commercial_plots_description')->with(compact('property_data'));
        } else if ($type == 'property_business_for_sale') {
            $property_data = BusinessForSale::where('id', $id)->first();
            $this->store_ad_views($property_data);
            return view('common.partials.property.business_for_sale_description')->with(compact('property_data'));
        }
    }

    // Store ad view when an user click on property ad
    public function store_ad_views($obj)
    {
        if ($obj && $obj->ad) {
            $view = new \App\Models\AdView(['ad_id' => $obj->ad->id, 'ip' => \request()->getClientIp(), 'user_id' => Auth::id()]);
            $view->save();
            /*
            $count = $obj->ad->views()->where('ip', \request()->getClientIp())->get();
            if (count($count) == 0) {
                $view = new \App\Models\AdView(['ad_id' => $obj->ad->id, 'ip' =>  \request()->getClientIp()]);
                $view->save();
            }
            */
        }
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
            foreach ($temp_media as $key => $temp_media_obj) {
                $temp_media_obj->mediable_id = $ad_id;
                $temp_media_obj->mediable_type = 'App\Models\Ad';
                $temp_media_obj->update();
            }

        }
        return $request;
    }


}
