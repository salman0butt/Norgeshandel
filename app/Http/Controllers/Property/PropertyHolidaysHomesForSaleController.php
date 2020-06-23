<?php

namespace App\Http\Controllers\Property;
use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPropertyHolidayHomeForSale;
use App\Models\Ad;
use App\Notification;
use App\PropertyHolidaysHomesForSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Pusher\Pusher;

class PropertyHolidaysHomesForSaleController extends Controller
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
    public function search_holiday_homes_for_sale(Request $request, $get_collection = false)
    {
        if(isset($request->search_id) && !$get_collection){
            Notification::where('notifiable_id', '=', $request->search_id)
                ->whereNull('read_at')->update(['read_at'=>now()]);
        }
//        DB::enableQueryLog();
        $col = 'list';
        $sort = 'published';
        if (isset($request->view) && !empty($request->view)) {
            $col = $request->view;
        }
        if (isset($request->sort) && !empty($request->sort)) {
            $sort = $request->sort;
        }
        $query = DB::table('ads')
            ->join('property_holidays_homes_for_sales', 'property_holidays_homes_for_sales.ad_id', '=','ads.id')
//            ->where('ads.status', '=','published')
            ->where('ads.visibility', '=', 1)
            ->whereNull('ads.deleted_at')
            ->whereNull('property_holidays_homes_for_sales.deleted_at')
            ->where(function ($query){
                $date = Date('y-m-d',strtotime('-7 days'));
                $query->where('ads.status', 'published')
                    ->orwhereDate('ads.sold_at','>',$date);
            });

//        if (isset($request->country) && !empty($request->country)) {
//            $query->whereIn('country', $request->country);
//        }
//        DB::enableQueryLog();
        if (isset($request->search) && !empty($request->search)) {
//            $query->where('property_holidays_homes_for_sales.ad_headline', 'like', '%' . $request->search . '%');
            common::table_search($query, common::get_model_columns(PropertyHolidaysHomesForSale::class), $request->search, 'property_holidays_homes_for_sales');
        }
        if (isset($request->created_at)) {
            $query->whereDate('property_holidays_homes_for_sales.created_at', '=', $request->created_at);
        }
        if (isset($request->asking_price_from) && !empty($request->asking_price_from)) {
            $query->where('property_holidays_homes_for_sales.asking_price', '>=', (int)$request->asking_price_from);
        }
        if (isset($request->asking_price_to) && !empty($request->asking_price_to)) {
            $query->where('property_holidays_homes_for_sales.asking_price', '<=', (int)$request->asking_price_to);
        }
        if (isset($request->total_price_from) && !empty($request->total_price_from)) {
            $query->where('property_holidays_homes_for_sales.total_price', '>=', (int)$request->total_price_from);
        }
        if (isset($request->total_price_to) && !empty($request->total_price_to)) {
            $query->where('property_holidays_homes_for_sales.total_price', '<=', (int)$request->total_price_to);
        }
        if (isset($request->use_area_from) && !empty($request->use_area_from)) {
            $query->where('property_holidays_homes_for_sales.use_area', '>=', (int)$request->use_area_from);
        }
        if (isset($request->use_area_to) && !empty($request->use_area_to)) {
            $query->where('property_holidays_homes_for_sales.use_area', '<=', (int)$request->use_area_to);
        }
        if (isset($request->number_of_bedrooms) && !empty($request->number_of_bedrooms)) {
            $query->where('property_holidays_homes_for_sales.number_of_bedrooms', '>=', (int)$request->number_of_bedrooms);
        }
        if (isset($request->location) && !empty($request->location)) {
            $query->whereIn('property_holidays_homes_for_sales.location', $request->location);
        }
        if (isset($request->owned_site) && !empty($request->owned_site)) {
            $query->whereNotNull('property_holidays_homes_for_sales.owned_site');
        }
        if (isset($request->hhfs_facilities) && !empty($request->hhfs_facilities)) {
            $query->where(function ($query) use ($request) {
                $query->where('property_holidays_homes_for_sales.facilities', 'like', '%' . $request->hhfs_facilities[0] . '%');
                for ($i = 1; $i < count($request->hhfs_facilities); $i++) {
                    $query->orWhere('property_holidays_homes_for_sales.facilities', 'like', '%' . $request->hhfs_facilities[$i] . '%');
                }
                $query->orWhere('property_holidays_homes_for_sales.facilities', 'like', '%' . str_replace('/', '\\\/', $request->hhfs_facilities[0]) . '%');
                for ($i = 1; $i < count($request->hhfs_facilities); $i++) {
                    $query->orWhere('property_holidays_homes_for_sales.facilities', 'like', '%' . str_replace('/', '\\\/', $request->hhfs_facilities[$i]) . '%');
                }
            });
        }
        if (isset($request->hhfs_property_type) && !empty($request->hhfs_property_type)) {
            $query->whereIn('property_holidays_homes_for_sales.property_type', $request->hhfs_property_type);
        }
        if (isset($request->display_date) && !empty($request->display_date)) {
            $query->join('ad_visting_times','ad_visting_times.ad_id','=','ads.id')
                ->whereIn('ad_visting_times.delivery_date',$request->display_date)->select('ads.*');
        }

        if (isset($request->user_id) && !empty($request->user_id)) {
            $query->where('ads.user_id', $request->user_id);
        }

        if (isset($request->company_id) && !empty($request->company_id)) {
            $query->where('ads.company_id', $request->company_id);
        }

        if(isset($request->sort) && $request->sort){
            $sort = $request->sort;
        }

             //Holiday Home For Sale Filters
       if ($request->ajax()) {
             if(isset($request->map) && $request->map){
                 $query->select(['property_holidays_homes_for_sales.ad_headline AS ad_heading', 'property_holidays_homes_for_sales.*']);
                $all_ads = common::propertyMapFilters($query);
                 return response()->json(['data'=>$all_ads]);
             }
        }


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
            case 'housing_area_low_high':
                $query->orderBy('primary_room', 'ASC');
                break;
            case 'housing_area_high_low':
                $query->orderBy('primary_room', 'DESC');
                break;
            case '99':
                //find nearby ads
                if(isset($request->lat) && $request->lat && isset($request->lon) && $request->lon){
                    common::find_nearby_ads($request->lat, $request->lon,$query,'property_holidays_homes_for_sales');
                    break;
                }
        }
        if(!isset($request->lat) && isset($request->lon)) {
            $query->select('property_holidays_homes_for_sales.*', 'ads.published_on', 'ads.updated_at')->distinct();
        }
        //$query->orderBy('ads.published_on', 'DESC');

        if ($get_collection){
            return $query->get();
        }
        $add_array = $query->paginate($this->pagination);
//        dd(DB::getQueryLog());
        if ($request->ajax()) {
            $html = view('user-panel.property.search-holiday-homes-for-sale-inner', compact('add_array', 'col', 'sort'))->render();
            exit($html);
        }
        return view('user-panel.property.search-holiday-homes-for-sale', compact('col', 'add_array', 'sort'));
    }

    //property for new_property_for_holiday_homes_for_sale new
    public function new_property_for_holiday_homes_for_sale(Request $request)
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
            $ad = new Ad(['ad_type' => 'property_holiday_home_for_sale', 'status' => 'saved', 'user_id' => $auth_id, 'company_id'=>$company_id]);
            $ad->save();
            if ($ad) {
                $property = new PropertyHolidaysHomesForSale(['user_id' => $auth_id]);
                $ad->propertyHolydaysHomesForSale()->save($property);
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

    public function editHolidayHomeForSale($id)
    {
        common::delete_media(Auth::user()->id, 'holiday_home_for_sale_temp_images', 'gallery');
        $holiday_home_for_sale1 = PropertyHolidaysHomesForSale::findOrFail($id);
        if ($holiday_home_for_sale1) {
            if (!Auth::user()->hasRole('admin') && ($holiday_home_for_sale1->user_id != Auth::user()->id || $holiday_home_for_sale1->ad->status == 'sold')) {
                abort(404);
            }
            return view('user-panel.property.holiday_home_for_sale', compact('holiday_home_for_sale1'));
        } else {
            abort(404);
        }

    }

    //update dummy updateDummyHomeForSaleAd
    public function updateDummyHomeForSaleAd(AddPropertyHolidayHomeForSale $request, $id)
    {
        $msg = $this->updateHomeForSaleAd($request,$id,'controller');
        if($msg['flag'] == 'success'){
            $property = PropertyHolidaysHomesForSale::find($id);
            $message = '';
            $ad = $property->ad;
            if ($ad && $ad->status == 'saved') {
                $message = 'Annonsen din er publisert.';
            } elseif ($ad && $ad->status == 'published') {
                $message = 'Annonsen din er oppdatert.';
                $media = common::updated_dropzone_images_type($request->all(),'holiday_home_for_sale_temp_images',$ad->id);
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
            common::send_search_notification($property, 'saved_search', 'Søk varsel: ny annonse', $this->pusher, 'property/holiday-homes-for-sale',$ad);
//            end notification

            $msg['message'] = $message;
//                $data['success'] = $response;
            $msg['status'] = $ad->status;
            echo json_encode($msg);
        }else{
            echo json_encode($msg);
            exit();
        }

    }

    public function updateHomeForSaleAd(Request $request, $id,$call_by='')
    {
        $property_quote = $property_pdf = '';
        DB::beginTransaction();
        try {
            if (!$request->amenities) {
                $request->merge(['amenities' => null]);
            }
            if (!$request->owned_site) {
                $request->merge(['owned_site' => null]);
            }
            $property_home_for_sale_data = $request->except(['upload_dropzone_images_type','media_position','deleted_media','company_id','agent_id','old_price','delivery_date','time_start','time_end','note']);

            //Manage Facilities
            if (isset($property_home_for_sale_data['facilities'])) {
                $facilities = "";
                foreach ($property_home_for_sale_data['facilities'] as $key => $val) {
                    $facilities .= $val . ",";
                }
                $property_home_for_sale_data['facilities'] = $facilities;
            }

//            $property_home_for_sale_data['user_id'] = Auth::user()->id;
            unset($property_home_for_sale_data['property_home_for_sale_pdf']);
            unset($property_home_for_sale_data['property_home_for_sale_sales_quote']);
            $response = PropertyHolidaysHomesForSale::findOrFail($id);

            //Update media (mediable id and mediable type)
            if ($response && $response->ad) {
                $property_home_for_sale_data = common::updated_dropzone_images_type($property_home_for_sale_data, $request->upload_dropzone_images_type, $response->ad->id);

                //Store property_home_for_sale_sales_quote file
                if($request->file('property_home_for_sale_sales_quote')){
                    $property_quote = common::update_media($request->file('property_home_for_sale_sales_quote'), $response->ad->id, 'App\Models\Ad', 'sales_information');
                    if($property_quote){
//                        $property_quote = json_decode($property_quote);
                        $property_quote = $property_quote['file_names'][0];//$property_quote->file_names[0];
                    }
                }

                //Store property_home_for_sale_pdf file
                if($request->file('property_home_for_sale_pdf')){
                    $property_pdf = common::update_media($request->file('property_home_for_sale_pdf'), $response->ad->id, 'App\Models\Ad', 'pdf');
                    if($property_pdf){
//                        $property_pdf = json_decode($property_pdf);
                        $property_pdf = $property_pdf['file_names'][0]; //$property_pdf->file_names[0];
                    }
                }

                common::sync_ad_agents($response->ad,$request->agent_id);
                common::ad_visting_time($response->ad,$request);
            }
            if (isset($property_home_for_sale_data['published_on']) && $property_home_for_sale_data['published_on'] == 'on') {
                $property_home_for_sale_data['published_on'] = 1;
            } else {
                $property_home_for_sale_data['published_on'] = 0;
            }

            $response->update($property_home_for_sale_data);
            
            if ($request->old_price != $request->total_price) {
                $ad_id = PropertyHolidaysHomesForSale::where('id', '=', $id)->first();
                $ad = Ad::find($ad_id->ad_id);
                common::property_notification($ad, $this->pusher, Auth::user()->id,'holiday_home_for_sale');
            }
            DB::commit();

            $data['success'] = $response;
            $data['property_quote'] = $property_quote;
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

    public function deleteHomeForSaleAd($id)
    {

        $holiday_home_for_sale = PropertyHolidaysHomesForSale::findOrFail($id);

        //$ad = Ad::findOrFail($id);

        if (!empty($holiday_home_for_sale->media)) {
            if ($holiday_home_for_sale->media->first())
                common::delete_media($holiday_home_for_sale->media->first->mediable_id, $holiday_home_for_sale->media->first->mediable_type, $holiday_home_for_sale->media->first->type);
        }
        $holiday_home_for_sale->delete();

        Session::flash('success', 'Property Deleted Successfully');

        return redirect('/my-business/my-ads');
    }

    public function holidayHomeForSaleDescription($id)
    {
        $property_data = PropertyHolidaysHomesForSale::where('id', $id)->first();
        return view('common.partials.property.holiday_home_for_sale_description')->with(compact('property_data'));
    }
}
