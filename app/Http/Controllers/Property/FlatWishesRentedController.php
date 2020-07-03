<?php

namespace App\Http\Controllers\Property;
use App\FlatWishesRented;
use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Http\Requests\AddFlatWishesRented;
use App\Models\Ad;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class FlatWishesRentedController extends Controller
{
    //
    private $pagination;
    private $pusher;

    public function __construct()
    {
        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        $this->pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $this->pagination = getenv('PAGINATION');
        $this->pagination = $this->pagination == 0 ? 30 : $this->pagination;
    }
//    zain
    public function search_flat_wishes_rented(Request $request, $get_collection = false)
    {
        if(isset($request->search_id) && !$get_collection){
            Notification::where('notifiable_id', '=', $request->search_id)
                ->whereNull('read_at')->update(['read_at'=>now()]);
        }
        $col = 'list';
        $sort = 'published';
        if (isset($request->view) && !empty($request->view)) {
            $col = $request->view;
        }
        if (isset($request->sort) && !empty($request->sort)) {
            $sort = $request->sort;
        }
        $query = DB::table('ads')
            ->join('flat_wishes_renteds', 'flat_wishes_renteds.ad_id', '=','ads.id')
//            ->where('ads.status', '=','published')
            ->where('ads.visibility', '=', 1)
            ->whereNull('ads.deleted_at')
            ->whereNull('flat_wishes_renteds.deleted_at')
            ->where(function ($query){
                $date = Date('y-m-d',strtotime('-7 days'));
                $query->where('ads.status', 'published')
                    ->orwhereDate('ads.sold_at','>',$date);
            });

        if (isset($request->search) && !empty($request->search)) {
            common::table_search($query, common::get_model_columns(FlatWishesRented::class), $request->search, 'flat_wishes_renteds');
        }
        if (isset($request->created_at)) {
            $query->whereDate('flat_wishes_renteds.created_at', '=', $request->created_at);
        }
        if (isset($request->price_from) && !empty($request->price_from)) {
            $query->where('flat_wishes_renteds.max_rent_per_month', '>=', (int)$request->price_from);
        }
        if (isset($request->price_to) && !empty($request->price_to)) {
            $query->where('flat_wishes_renteds.max_rent_per_month', '<=', (int)$request->price_to);
        }
        if (isset($request->country) && !empty($request->country)) {
            $query->whereIn('flat_wishes_renteds.region', $request->country);
        }
        if (isset($request->fwr_property_type) && !empty($request->fwr_property_type)) {
            $query->where(function ($query) use ($request) {
                $query->where('flat_wishes_renteds.property_type', 'like', '%' . $request->fwr_property_type[0] . '%');
                for ($i = 1; $i < count($request->fwr_property_type); $i++) {
                    $query->orWhere('flat_wishes_renteds.property_type', 'like', '%' . $request->fwr_property_type[$i] . '%');
                }
            });
        }
        if (isset($request->wanted_from) && !empty($request->wanted_from)) {
            $query->where(function ($query) use ($request) {
                $query->where('flat_wishes_renteds.wanted_from', 'like', '%' . $request->wanted_from[0] . '%');
                for ($i = 1; $i < count($request->wanted_from); $i++) {
                    $query->orWhere('flat_wishes_renteds.wanted_from', 'like', '%' . $request->wanted_from[$i] . '%');
                }
            });
        }
        if (isset($request->number_of_tenants) && !empty($request->number_of_tenants)) {
            $query->where(function ($query) use ($request) {
                $query->whereIn('flat_wishes_renteds.number_of_tenants', $request->number_of_tenants);
                if (in_array(4, $request->number_of_tenants)) {
                    $query->orWhere('flat_wishes_renteds.number_of_tenants', '>=', 4);
                }
            });
        }

        if (isset($request->user_id) && !empty($request->user_id)) {
            $query->where('ads.user_id', $request->user_id);
        }
        if (isset($request->company_id) && !empty($request->company_id)) {
            $query->where('ads.company_id', $request->company_id);
        }
             //Property Map Filters
       if ($request->ajax()) {
             if(isset($request->map) && $request->map){
                $query->select(['flat_wishes_renteds.headline AS ad_heading','flat_wishes_renteds.max_rent_per_month AS total_price','flat_wishes_renteds.*']);
                $all_ads = common::propertyMapFilters($query);
                 return response()->json(['data'=>$all_ads]);
             }
        }

//        if($request->local_area_name && $request->radius && $request->map_lat && $request->map_lng && isset($request->local_area_name_check) && $request->local_area_name_check == 'on'){
//            $query = common::get_map_filter_ads($request->all(),'flat_wishes_renteds',$query);
//        }


        switch ($sort) {
            case 'most_relevant':
                $query->orderBy('ads.updated_at', 'DESC');
                break;
            case 'published':
                $query->orderBy('ads.published_on', 'DESC');
                break;
            case 'priced_low_high':
                $query->orderBy('flat_wishes_renteds.max_rent_per_month', 'ASC');
                break;
            case 'priced_high_low':
                $query->orderBy('flat_wishes_renteds.max_rent_per_month', 'DESC');
                break;
            case 'time_from':
                $query->orderBy('flat_wishes_renteds.wanted_from', 'ASC');
                break;
            case '99':
                //find nearby ads
                if(isset($request->lat) && $request->lat && isset($request->lon) && $request->lon){
                    common::find_nearby_ads($request->lat, $request->lon,$query,'flat_wishes_renteds');
                    break;
                }
        }

        //$query->orderBy('ads.published_on', 'DESC');

        if ($get_collection){
            return $query->get();
        }

        $add_array = $query->paginate($this->pagination);
        if ($request->ajax()) {
            $html = view('user-panel.property.search-flat-wishes-rented-inner', compact('add_array', 'col', 'sort'))->render();
            exit($html);
        }
        return view('user-panel.property.search-flat-wishes-rented', compact('col', 'add_array', 'sort'));
    }

    //prooperty for new_property_for_flat_wishes_rented new
    public function new_property_for_flat_wishes_rented(Request $request)
    {
        DB::beginTransaction();
        try{
            $company_id = 0;
            if(Auth::user()->hasRole('agent')){
                $company_id = Auth::user()->created_by_company_id;
            }
            if(Auth::user()->hasRole('company') && Auth::user()->property_companies->first() && Auth::user()->property_companies->first()->id){
                $company_id = Auth::user()->property_companies->first()->id;
            }
            $auth_id = Auth::id();
            $ad = new Ad(['ad_type' => 'property_flat_wishes_rented', 'status' => 'saved', 'user_id' => $auth_id, 'company_id'=>$company_id]);
            $ad->save();

            if ($ad) {
                $property = new FlatWishesRented(['user_id' => $auth_id]);
                $ad->propertyFlatWishesRented()->save($property);
                if ($property) {
                    DB::commit();
                    return redirect(url('complete/ad/' . $ad->id));
                } else {
                    DB::rollback();
                    abort(404);
                }
            } else {
                DB::rollback();
                abort(404);
            }
        }catch (\Exception $e){
            DB::rollback();
            abort(404);
        }
    }

    //update dummy property for sale to published
    public function updateDummyFlatWishesRented(AddFlatWishesRented $request, $id)
    {
        $msg = $this->updateFlatWishesRented($request,$id,'controller');
        if($msg['flag'] == 'success'){
            //  DB::connection()->enableQueryLog();
            $property = FlatWishesRented::find($id);
            $message = '';
            $ad = $property->ad;
            if ($ad && $ad->status == 'saved') {
                $ad_expiry_response = common::create_update_ad_expiry_for_free_ads($ad);
                if(!$ad_expiry_response['flag']){
                    echo json_encode($ad_expiry_response);
                    exit();
                }

                $message = 'Annonsen din er publisert.';
                $published_date = date("Y-m-d H:i:s");
                $response = $ad->update(['status' => 'published', 'published_on' => $published_date]);
            } elseif ($ad && $ad->status == 'published') {
                $message = 'Annonsen din er oppdatert.';
                $media = common::updated_dropzone_images_type($request->all(),'flat_wishes_rented_temp_images',$ad->id);
                if($request->media_position){
                    $media_position = common::update_media_position($request->media_position);
                }
                if($request->deleted_media){
                    $delete_media = common::delete_json_media($request->deleted_media);
                }
            }

            //notification bellow
            common::send_search_notification($property, 'saved_search', 'Søk varsel: ny annonse', $this->pusher, 'property/flat-wishes-rented',$ad);
            //end notification
            //  dd(DB::getQueryLog());

            $msg['message'] = $message;
//                $data['success'] = $response;
            $msg['status'] = $ad->status;
            echo json_encode($msg);
        }else{
            echo json_encode($msg);
            exit();
        }
    }

    public function updateFlatWishesRented(Request $request, $id,$call_by='')
    {
        DB::beginTransaction();
        try {
            $flat_wishes_rented_data = $request->except('upload_dropzone_images_type','media_position','deleted_media','company_id','agent_id');
            $regions = "";
            if (isset($flat_wishes_rented_data['region'])) {
                foreach ($flat_wishes_rented_data['region'] as $key => $val) {
                    $regions .= $val . ",";
                }
                $flat_wishes_rented_data['region'] = $regions;
            } else {
                $flat_wishes_rented_data['region'] = null;
            }

            $property_types = "";
            if (isset($flat_wishes_rented_data['property_type'])) {
                foreach ($flat_wishes_rented_data['property_type'] as $key => $val) {
                    $property_types .= $val . ",";
                }
                $flat_wishes_rented_data['property_type'] = $property_types;
            } else {
                $flat_wishes_rented_data['property_type'] = null;
            }

            if (isset($flat_wishes_rented_data['published-on']) && $flat_wishes_rented_data['published-on'] == 'on') {
                $flat_wishes_rented_data['published-on'] = 1;
            } else {
                $flat_wishes_rented_data['published-on'] = 0;
            }

            unset($flat_wishes_rented_data['flat_wishes_rented']);
//            $flat_wishes_rented_data['user_id'] = Auth::user()->id;

            $response = FlatWishesRented::findOrFail($id);

            //Update media (mediable id and mediable type)
            if ($response && $response->ad) {
                $flat_wishes_rented_data = common::updated_dropzone_images_type($flat_wishes_rented_data, $request->upload_dropzone_images_type, $response->ad->id);
                common::sync_ad_agents($response->ad,$request->agent_id);
            }

            $response->update($flat_wishes_rented_data);
            DB::commit();
            $data['success'] = $response;
            if($call_by){
                $data['flag'] = 'success';
                return $data;
            }
            echo json_encode($data);

        } catch (\Exception $e) {
            DB::rollback();
            (header("HTTP/1.0 404 Not Found"));
            $data['failure'] = $e->getMessage();
            if($call_by){
                $data['flag'] = 'failure';
                return $data;
            }
            echo json_encode($data);
            exit();
        }
    }

    public function editAddFlatWishesRented($id)
    {
        common::delete_media(Auth::user()->id, 'flat_wishes_rented_temp_images', 'gallery');
        $flat_wishes_rented1 = FlatWishesRented::findOrFail($id);
        if ($flat_wishes_rented1) {
            if (!Auth::user()->hasRole('admin') && ($flat_wishes_rented1->user_id != Auth::user()->id || $flat_wishes_rented1->ad->status == 'sold')) {
                abort(404);
            }
            return view('user-panel.property.flat_wishes_rented', compact('flat_wishes_rented1'));
        } else {
            abort(404);
        }
    }

    public function flatWishesRentedDescription($id)
    {
        $property_data = FlatWishesRented::where('id', $id)->first();
        return view('common.partials.property.flat_wishes_rented_description')->with(compact('property_data'));
    }
}
