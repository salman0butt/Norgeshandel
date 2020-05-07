<?php

namespace App\Http\Controllers\Property;
use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Http\Requests\AddPropertyForRent;
use App\Models\Ad;
use App\Notification;
use App\PropertyForRent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class PropertyForRentController extends Controller
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
    public function search_property_for_rent(Request $request, $get_collection = false)
    {
        if(isset($request->search_id) && !$get_collection){
            Notification::where('notifiable_id', '=', $request->search_id)
                ->whereNull('read_at')->update(['read_at'=>now()]);
        }
//        DB::enableQueryLog();
        $table = 'property_for_rent';
        $col = 'list';
        $sort = 'published';
        if (isset($request->view) && !empty($request->view)) {
            $col = $request->view;
        }
        if (isset($request->sort) && !empty($request->sort)) {
            $sort = $request->sort;
        }
        $query = DB::table('ads')
            ->join($table, $table . '.ad_id', '=','ads.id')
            ->where(function ($query){
                $query->where('ads.status', '=','published')
                    ->orWhere('ads.status', '=','sold');
            })
            ->where(function ($query){
                $query->whereNull('ads.sold_at')
                    ->orWhereDate('ads.sold_at', '>', now()->addDays(-7));
            })
            ->where('ads.visibility', '=', 1)
            ->whereNull('ads.deleted_at')
            ->whereNull($table . '.deleted_at')
            ->where(function ($query){
                $date = Date('y-m-d',strtotime('-7 days'));
                $query->where('ads.status', 'published')
                    ->orwhereDate('ads.sold_at','>',$date);
            });

        if (isset($request->for_sale) && !empty($request->for_sale)) {
            $query->where('ads.status', '!=', 'sold');
        }
        if (isset($request->sold_in_three_days) && !empty($request->sold_in_three_days)) {
            $query->whereDate('ads.sold_at', '>', now()->addDays(-3));
        }
        if (isset($request->search) && !empty($request->search)) {
//            $query->where('heading', 'like', '%' . $request->search . '%');
            common::table_search($query, common::get_model_columns(PropertyForRent::class), $request->search, 'property_for_rent');
        }
        if (isset($request->created_at)) {
            $query->whereDate($table . '.updated_at', '=', $request->created_at);
        }
        if (isset($request->local_area_name_check) && !empty($request->local_area_name_check)) {
            if (isset($request->local_area_name) && !empty($request->local_area_name)) {
                $query->where($table . '.street_address', 'like', '%' . $request->local_area_name . '%');
            }
        }

        if (isset($request->monthly_rent_from) && !empty($request->monthly_rent_from)) {
            $query->where($table . '.monthly_rent', '>=', (int)$request->monthly_rent_from);
        }
        if (isset($request->monthly_rent_to) && !empty($request->monthly_rent_to)) {
            $query->where($table . '.monthly_rent', '<=', (int)$request->monthly_rent_to);
        }

        if (isset($request->use_area_from) && !empty($request->use_area_from)) {
            $query->where($table . '.gross_area', '>=', (int)$request->use_area_from);
        }
        if (isset($request->use_area_to) && !empty($request->use_area_to)) {
            $query->where($table . '.gross_area', '<=', (int)$request->use_area_to);
        }
        if (isset($request->number_of_bedrooms) && !empty($request->number_of_bedrooms)) {
            $query->where($table . '.number_of_bedrooms', '>=', (int)$request->number_of_bedrooms);
        }
        if (isset($request->pfr_property_type) && !empty($request->pfr_property_type)) {
            $query->where(function ($query) use ($request) {
                $query->whereIn('property_for_rent.property_type', $request->pfr_property_type);
                for ($i = 1; $i < count($request->pfr_property_type); $i++) {
                    $query->orWhere('property_for_rent.property_type', '=', str_replace('/', '\\\/', $request->pfr_property_type[$i]));
                }
            });
        }
        if (isset($request->pfr_facilities) && !empty($request->pfr_facilities)) {
            $query->where(function ($query) use ($request) {
                $query->where('property_for_rent.facilities', 'like', '%"' . $request->pfr_facilities[0] . '"%');
                for ($i = 1; $i < count($request->pfr_facilities); $i++) {
                    $query->orWhere('property_for_rent.facilities', 'like', '%"' . $request->pfr_facilities[$i] . '"%');
                }
                $query->orWhere('property_for_rent.facilities', 'like', '%"' . str_replace('/', '\\\/', $request->pfr_facilities[0]) . '"%');
                for ($i = 1; $i < count($request->pfr_facilities); $i++) {
                    $query->orWhere('property_for_rent.facilities', 'like', '%"' . str_replace('/', '\\\/', $request->pfr_facilities[$i]) . '"%');
                }
            });
        }

        if (isset($request->floor) && !empty($request->floor)) {
            $query->where(function ($query) use ($request) {
                for ($i = 0; $i < count($request->floor); $i++) {
                    if ($request->floor[$i] != 'over_6') {
                        $query->orWhere('property_for_rent.floor', '=', $request->floor[$i]);
                    }
                }
                if (in_array('over_6', $request->floor)) {
                    $query->orWhere('property_for_rent.floor', '>', 6);
                }
            });
        }

        if (isset($request->available_from) && !empty($request->available_from)) {
            $query->where(function ($query) use ($request) {
                $query->where('property_for_rent.rented_from', 'LIKE', '%' . $request->available_from[0] . '%');
                for ($i = 1; $i < count($request->available_from); $i++) {
                    $query->orWhere('property_for_rent.rented_from', 'LIKE', '%' . $request->available_from[$i] . '%');
                }
            });
        }
//
        if (isset($request->user_id) && !empty($request->user_id)) {
            $query->where('ads.user_id', $request->user_id);
        }

        if (isset($request->company_id) && !empty($request->company_id)) {
            $query->where('ads.company_id', $request->company_id);
        }
        $query->orderBy('ads.published_on', 'DESC');

        switch ($sort) {
            case 'published':
                $query->orderBy('ads.updated_at', 'DESC');
                break;
            case 'priced-low-high':
                $query->orderBy('asking_price', 'ASC');
                break;
            case 'priced-high-low':
                $query->orderBy('asking_price', 'DESC');
                break;
            case 'p-rom-area-low-high':
                $query->orderBy('primary_room', 'ASC');
                break;
            case 'p-rom-area-high-low':
                $query->orderBy('primary_room', 'DESC');
                break;
            case 'total-price-low-high':
                $query->orderBy('total_price', 'ASC');
                break;
            case 'total-price-high-low':
                $query->orderBy('total_price', 'DESC');
                break;
            default:
                $query->orderBy('property_for_rent.id', 'DESC');
                break;
        }
     

        if ($get_collection){
            return $query->get();
        }

        $add_array = $query->paginate($this->pagination);
        if ($request->ajax()) {
            $html = view('user-panel.property.search-property-for-rent-inner', compact('add_array', 'col', 'sort'))->render();
            exit($html);
        }
        return view('user-panel.property.search-property-for-rent', compact('col', 'add_array', 'sort'));
    }

    //prooperty for rent new
    public function new_property_for_rent(Request $request)
    {
        $ad = new Ad(['ad_type' => 'property_for_rent', 'status' => 'saved', 'user_id' => Auth::id()]);
        $ad->save();
        if ($ad) {
            $property = new PropertyForRent(['user_id' => Auth::id()]);
            $ad->propertyForRent()->save($property);
            if ($property) {
                return redirect(url('complete/ad/' . $ad->id));
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function newAddedit($id)
    {
        common::delete_media(Auth::user()->id, 'property_for_rent_temp_images', 'gallery');
        $property_for_rent1 = PropertyForRent::findOrFail($id);
        if ($property_for_rent1) {
            if (!Auth::user()->hasRole('admin') && ($property_for_rent1->user_id != Auth::user()->id || $property_for_rent1->ad->status == 'sold')) {
                abort(404);
            }
            return view('user-panel.property.new_add', compact('property_for_rent1'));
        } else {
            abort(404);
        }
    }

    public function UpdatePropertyForRentAdd(Request $request, $id,$call_by='')
    {


        DB::beginTransaction();
        try {
            if (!$request->facilities2) {
                $request->merge(['facilities2' => null]);
            }

            $property_for_rent_data = $request->except(['_method', 'upload_dropzone_images_type','media_position','deleted_media','agent_id','notify']);

            //Manage Facilities
            if (isset($property_for_rent_data['facilities'])) {
//                $facilities = "";
//                foreach ($property_for_rent_data['facilities'] as $key => $val) {
//                    $facilities .= $val . ",";
//                }
                $property_for_rent_data['facilities'] = json_encode($property_for_rent_data['facilities']);
            }

            //Add More ViewingTimes
            if (isset($property_for_rent_data['delivery_date']) && $property_for_rent_data['delivery_date'] != "") {
                $property_for_rent_data['secondary_delivery_date'] = null;
                $i = 0;
                foreach ($property_for_rent_data['delivery_date'] as $key => $val) {
                    if ($i == 0) {
                        $property_for_rent_data['delivery_date'] = $val;
                    } else {
                        $property_for_rent_data['secondary_delivery_date'] .= $val . ",";
                    }
                    $i++;
                }
            }

            $property_for_rent_data['secondary_from_clock'] = "";
            if (isset($property_for_rent_data['from_clock'])) {
                $i = 0;
                foreach ($property_for_rent_data['from_clock'] as $key => $val) {
                    if ($i == 0) {
                        $property_for_rent_data['from_clock'] = $val;
                    } else {
                        $property_for_rent_data['secondary_from_clock'] .= $val . ",";
                    }
                    $i++;
                }
            }

            $property_for_rent_data['secondary_clockwise_clock'] = "";
            if (isset($property_for_rent_data['clockwise_clock'])) {
                $i = 0;
                foreach ($property_for_rent_data['clockwise_clock'] as $key => $val) {
                    if ($i == 0) {
                        $property_for_rent_data['clockwise_clock'] = $val;
                    } else {
                        $property_for_rent_data['secondary_clockwise_clock'] .= $val . ",";
                    }
                    $i++;
                }
            }

            $property_for_rent_data['secondary_note'] = "";
            if (isset($property_for_rent_data['note'])) {
                $i = 0;
                foreach ($property_for_rent_data['note'] as $key => $val) {
                    if ($i == 0) {
                        $property_for_rent_data['note'] = $val;
                    } else {
                        $property_for_rent_data['secondary_note'] .= $val . ",";
                    }
                    $i++;
                }
            }

            if (isset($property_for_rent_data['published_on']) && $property_for_rent_data['published_on'] == 'on') {
                $property_for_rent_data['published_on'] = 1;
            } else {
                $property_for_rent_data['published_on'] = 0;
            }

            $property_for_rent_data['user_id'] = Auth::user()->id;

            $response = PropertyForRent::findOrFail($id);

            //Update media (mediable id and mediable type)
            if ($response && $response->ad) {
                $property_for_rent_data = common::updated_dropzone_images_type($property_for_rent_data, $request->upload_dropzone_images_type, $response->ad->id);
                common::sync_ad_agents($response->ad,$request->agent_id);

            }
   
            $response->update($property_for_rent_data);

            if ($request->notify) {
                $ad_id = PropertyForRent::where('id', '=', $id)->first();
              
                $ad = Ad::find($ad_id->ad_id);
                common::property_notification($ad, $this->pusher, Auth::user()->id,'property_for_rent');
            }
             
            DB::commit();
            if($call_by){
                return 'success';
            }
        
            $data['success'] = $response;
            echo json_encode($data);
            exit();
        } catch (\Exception $e) {
            DB::rollback();
            (header("HTTP/1.0 404 Not Found"));
            $data['failure'] = $e->getMessage();
            if($call_by){
                return json_encode($data);
            }
            echo json_encode($data);
            exit();
        }
    }

    //update dummy property for sale to published
    public function UpdateDummyRentAdd(AddPropertyForRent $request, $id)
    {
        $msg = $this->UpdatePropertyForRentAdd($request,$id,'controller');
        if($msg == 'success'){
            //  DB::connection()->enableQueryLog();
            $property = PropertyForRent::find($id);
            if($request->media_position){
                $media_position_arr = $request->media_position;
            }
            $message = '';
            $ad = $property->ad;

            if ($ad && $ad->status == 'saved') {
                $message = 'Annonsen din er publisert.';
            } elseif ($ad && $ad->status == 'published') {
                $media = common::updated_dropzone_images_type($request->all(),'property_for_rent_temp_images',$ad->id);
                if($request->media_position){
                    $media_position = common::update_media_position($media_position_arr);
                }
                if($request->deleted_media){
                    $delete_media = common::delete_json_media($request->deleted_media);
                }
                $message = 'Annonsen din er oppdatert.';
            }
            $published_date = date("Y-m-d H:i:s");

            $response = $ad->update(['status' => 'published', 'published_on' => $published_date]);
           
            if ($response) {
//        notifications bellow
                common::send_search_notification($property, 'saved_search', $message, $this->pusher, 'property/property-for-rent');
//      notifications ended
            }
//  dd(DB::getQueryLog());

            $data['success'] = $response;
            $data['message'] = $message;
            $data['status'] = $ad->status;
            $data['date'] = $published_date;
            echo json_encode($data);
        }else{
            echo $msg;
            exit();
        }

    }

    public function propertyDescription($id)
    {
        $property_data = PropertyForRent::where('id', $id)->first();
        return view('common.partials.property.property_description')->with(compact('property_data'));
    }
}
