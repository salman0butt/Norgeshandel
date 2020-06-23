<?php

namespace App\Http\Controllers\Property;
use App\CommercialPropertyForRent;
use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Http\Requests\AddCommercialPropertyForRent;
use App\Models\Ad;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class CommercialPropertyForRentController extends Controller
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
    public function search_commercial_property_for_rent(Request $request, $get_collection = false)
    {
        if(isset($request->search_id) && !$get_collection){
            Notification::where('notifiable_id', '=', $request->search_id)
                ->whereNull('read_at')->update(['read_at'=>now()]);
        }
        $table = 'commercial_property_for_rents';
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
//            ->where('ads.status', '=','published')
            ->where('ads.visibility', '=', 1)
            ->whereNull('ads.deleted_at')
            ->whereNull($table . '.deleted_at')
            ->where(function ($query){
                $date = Date('y-m-d',strtotime('-7 days'));
                $query->where('ads.status', 'published')
                    ->orwhereDate('ads.sold_at','>',$date);
            });

        if (isset($request->country) && !empty($request->country)) {
            $query->whereIn('country', $request->country);
        }
        if (isset($request->search) && !empty($request->search)) {
//            $query->where('heading', 'like', '%' . $request->search . '%');
            common::table_search($query, common::get_model_columns(CommercialPropertyForRent::class), $request->search, 'commercial_property_for_rents');
        }
        if (isset($request->created_at)) {
            $query->whereDate($table . '.created_at', '=', $request->created_at);
        }
        if (isset($request->local_area_name_check) && !empty($request->local_area_name_check)) {
            if (isset($request->local_area_name) && !empty($request->local_area_name)) {
                $query->where($table . '.street_address', 'like', '%' . $request->local_area_name . '%');
            }
        }

        if (isset($request->use_area_from) && !empty($request->use_area_from)) {
            $query->where($table . '.use_area', '>=', (int)$request->use_area_from);
        }
        if (isset($request->use_area_to) && !empty($request->use_area_to)) {
            $query->where($table . '.use_area', '<=', (int)$request->use_area_to);
        }

        if (isset($request->cpfs_property_type) && !empty($request->cpfs_property_type)) {
            $query->where($table . '.property_type', 'like', '%' . $request->cpfs_property_type[0] . '%');
            for ($i = 1; $i < count($request->cpfs_property_type); $i++) {
                $query->orWhere($table . '.property_type', 'like', '%' . $request->cpfs_property_type[$i] . '%');
            }
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
                 $query->select(['commercial_property_for_rents.heading AS ad_heading', 'commercial_property_for_rents.*']);

                $all_ads = common::propertyMapFilters($query);
                 return response()->json(['data'=>$all_ads]);
             }
        }

        switch ($sort) {
            case 'most_relevant':
                $query->orderBy('ads.updated_at', 'DESC');
                break;
            case 'published':
                $query->orderBy('ads.published_on', 'DESC');
                break;
            case 'sqm-low-high':
                $query->orderBy('use_area', 'ASC');
                break;
            case 'sqm-high-low':
                $query->orderBy('use_area', 'DESC');
                break;
            case '99':
                //find nearby ads
                if(isset($request->lat) && $request->lat && isset($request->lon) && $request->lon){
                    common::find_nearby_ads($request->lat, $request->lon,$query,$table);
                    break;
                }
        }
        //$query->orderBy('ads.published_on', 'DESC');
        if ($get_collection){
            return $query->get();
        }

        $add_array = $query->paginate($this->pagination);
        if ($request->ajax()) {
            $html = view('user-panel.property.search-commercial-property-for-rent-inner', compact('add_array', 'col', 'sort'))->render();
            exit($html);
        }
        return view('user-panel.property.search-commercial-property-for-rent', compact('col', 'add_array', 'sort'));
    }

    //prooperty for new_commercial_property_for_rent new
    public function new_commercial_property_for_rent(Request $request)
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
            $ad = new Ad(['ad_type' => 'property_commercial_for_rent', 'status' => 'saved', 'user_id' => $auth_id, 'company_id'=>$company_id]);
            $ad->save();

            if ($ad) {
                $property = new CommercialPropertyForRent(['user_id' => $auth_id]);
                $ad->propertyCommercialPropertyForRent()->save($property);
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

    //update dummy updateDummyCommercialPropertyForRent
    public function updateDummyCommercialPropertyForRent(AddCommercialPropertyForRent $request, $id)
    {
        $msg = $this->updateCommercialPropertyForRent($request,$id,'controller');
        if($msg['flag'] == 'success'){
            //  DB::connection()->enableQueryLog();
            $property = CommercialPropertyForRent::find($id);
            $message = '';
            $ad = $property->ad;
            if ($ad && $ad->status == 'saved') {
                $message = 'Annonsen din er publisert.';
            } elseif ($ad && $ad->status == 'published') {
                $message = 'Annonsen din er oppdatert.';
                $media = common::updated_dropzone_images_type($request->all(),'commercial_property_for_rent_temp_images',$ad->id);
                if($request->media_position){
                    $media_position = common::update_media_position($request->media_position);
                }
                if($request->deleted_media){
                    $delete_media = common::delete_json_media($request->deleted_media);
                }
            }
            $published_date = date("Y-m-d H:i:s");

            $response = $ad->update(['status' => 'published', 'published_on' => $published_date]);

//            notification bellow
            common::send_search_notification($property, 'saved_search', 'Søk varsel: ny annonse', $this->pusher, 'property/commercial-property-for-rent',$ad);
//            end notification
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

    // Update commercial property for rent
    public function updateCommercialPropertyForRent(Request $request, $id,$call_by='')
    {
        $property_pdf = '';
        DB::beginTransaction();
        try {
            $commercial_property_for_rent = $request->except(['_method', 'upload_dropzone_images_type','media_position','deleted_media','company_id','agent_id','old_price']);

            unset($commercial_property_for_rent['commercial_property_for_rent_pdf']);
//            $commercial_property_for_rent['user_id'] = Auth::user()->id;

            if (isset($commercial_property_for_rent['property_type']) && $commercial_property_for_rent['property_type'] != "") {
                $commercial_property_for_rent['property_type'] = json_encode($commercial_property_for_rent['property_type']);
            } else {
                $commercial_property_for_rent['property_type'] = null;
            }

            if (isset($commercial_property_for_rent['facilities']) && $commercial_property_for_rent['facilities'] != "") {
                $facilities = "";
                foreach ($commercial_property_for_rent['facilities'] as $key => $val) {
                    $facilities .= $val . ",";
                }
                $commercial_property_for_rent['facilities'] = $facilities;
            } else {
                $commercial_property_for_rent['facilities'] = null;
            }

            if (isset($commercial_property_for_rent['published-on']) && $commercial_property_for_rent['published-on'] == 'on') {
                $commercial_property_for_rent['published-on'] = 1;
            } else {
                $commercial_property_for_rent['published-on'] = 0;
            }

            $response = CommercialPropertyForRent::findOrFail($id);
            //Update media (mediable id and mediable type)
            if ($response && $response->ad) {
                $commercial_property_for_rent = common::updated_dropzone_images_type($commercial_property_for_rent, $request->upload_dropzone_images_type, $response->ad->id);

                //Store property_pdf file
                if($request->file('commercial_property_for_rent_pdf')){
                    $property_pdf = common::update_media($request->file('commercial_property_for_rent_pdf'), $response->ad->id, 'App\Models\Ad', 'pdf');
                    if($property_pdf){
//                        $property_pdf = json_decode($property_pdf);
                        $property_pdf = $property_pdf['file_names'][0];// $property_pdf->file_names[0];
                    }
                }

                common::sync_ad_agents($response->ad,$request->agent_id);
            }
            $response->update($commercial_property_for_rent);
            if ($request->old_price != $request->rent_per_meter_per_year) {
                $ad_id = CommercialPropertyForRent::where('id', '=', $id)->first();
                $ad = Ad::find($ad_id->ad_id);
                common::property_notification($ad, $this->pusher, Auth::user()->id,'commercial_property_for_rent');
            }

            DB::commit();
            $data['success'] = $response;
            $data['property_pdf'] = $property_pdf;
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

    // Edit commercial property for rent
    public function editCommercialPropertyForRent($id)
    {
        common::delete_media(Auth::user()->id, 'commercial_property_for_rent_temp_images', 'gallery');
        $commercial_for_rent = CommercialPropertyForRent::findOrFail($id);
        if ($commercial_for_rent) {
            if (!Auth::user()->hasRole('admin') && ($commercial_for_rent->user_id != Auth::user()->id || $commercial_for_rent->ad->status == 'sold')) {
                abort(404);
            }
            return view('user-panel.property.commercial_property_for_rent', compact('commercial_for_rent'));
        } else {
            abort(404);
        }
    }

    public function commercialForRentDescription($id)
    {
        $property_data = CommercialPropertyForRent::where('id', $id)->first();
        return view('common.partials.property.commercialproperty_for_rent_description')->with(compact('property_data'));
    }

}
