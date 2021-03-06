<?php

namespace App\Http\Controllers\Property;
use App\BusinessForSale;
use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Http\Requests\AddBusinessForSale;
use App\Models\Ad;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class BusinessForSaleController extends Controller
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
    public function search_business_for_sale(Request $request, $get_collection = false)
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
            ->join('business_for_sales', 'business_for_sales.ad_id', '=', 'ads.id')
//            ->where('ads.status', '=','published')
            ->where('ads.visibility', '=', 1)
            ->whereNull('ads.deleted_at')
            ->whereNull('business_for_sales.deleted_at')
            ->where(function ($query){
                $date = Date('y-m-d',strtotime('-7 days'));
                $query->where('ads.status', 'published')
                    ->orwhereDate('ads.sold_at','>',$date);
                    
            });
//        DB::enableQueryLog();
        if (isset($request->search) && !empty($request->search)) {
            common::table_search($query, common::get_model_columns(BusinessForSale::class), $request->search, 'business_for_sales');
        }
        if (isset($request->created_at)) {
            $query->whereDate('business_for_sales.created_at', '=', $request->created_at);
        }
        if (isset($request->bfs_industries) && !empty($request->bfs_industries)) {
            $query->where(function ($query) use ($request) {
                $query->whereIn('business_for_sales.industry', $request->bfs_industries);
                $query->orWhereIn('business_for_sales.alternative_industry', $request->bfs_industries);
            });
        }
//        dd(DB::getQueryLog());
        if (isset($request->country) && !empty($request->country)) {
            $query->whereIn('business_for_sales.country', $request->country);
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
                 $query->select(['business_for_sales.headline AS ad_heading','business_for_sales.price AS total_price', 'business_for_sales.*']);
                $all_ads = common::propertyMapFilters($query);
                 return response()->json(['data'=>$all_ads]);
             }
        }

        if($request->local_area_name && $request->radius && $request->map_lat && $request->map_lng && isset($request->local_area_name_check) && $request->local_area_name_check == 'on'){
                $query = common::get_map_filter_ads($request->all(),'business_for_sales',$query);
        }

        switch ($sort) {
            case 'most_relevant':
                $query->orderBy('ads.updated_at', 'DESC');
                break;
            case 'published':
                $query->orderBy('ads.published_on', 'DESC');
                break;
            case 'priced-low-high':
                $query->orderBy('price', 'ASC');
                break;
            case 'priced-high-low':
                $query->orderBy('price', 'DESC');
                break;
            case '99':
                if(isset($request->lat) && $request->lat && isset($request->lon) && $request->lon){
                    common::find_nearby_ads($request->lat, $request->lon,$query,'business_for_sales');
                    break;
                }
        }

        if($get_collection){
            return $query->get();
        }

        $add_array = $query->paginate($this->pagination);
//        dd(DB::getQueryLog());
        if ($request->ajax()) {
            $html = view('user-panel.property.search-business-for-sale-inner', compact('add_array', 'col', 'sort'))->render();
            exit($html);
        }
        return view('user-panel.property.search-business-for-sale', compact('col', 'add_array', 'sort'));
    }

    //prooperty for new_business_for_sale new
    public function new_business_for_sale(Request $request)
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
            $ad = new Ad(['ad_type' => 'property_business_for_sale', 'status' => 'saved', 'user_id' => $auth_id, 'company_id'=>$company_id ]);
            $ad->save();

            if ($ad) {
                $property = new BusinessForSale(['user_id' => $auth_id]);
                $ad->propertyBusinessForSale()->save($property);
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

    // store business for sale ad
    public function addBusinessForSale(AddBusinessForSale $request)
    {
        DB::beginTransaction();
        try {
            $business_for_sale = $request->except('upload_dropzone_images_type','to_publish_ad','package_id');

            unset($business_for_sale['business_for_sale_pdf']);
//            $business_for_sale['user_id'] = Auth::user()->id;

            //add Add to table
            $add = array();
            $add['ad_type'] = 'property_business_for_sale';
            $add['status'] = 'published';
//            $add['user_id'] = Auth::user()->id;
            $add_response = Ad::create($add);
            $business_for_sale['ad_id'] = $add_response->id;

            //Update media (mediable id and mediable type)
            if ($add_response->id) {
                $business_for_sale = common::updated_dropzone_images_type($business_for_sale, $request->upload_dropzone_images_type, $add_response->id);

                //Store property_pdf file
                if($request->file('business_for_sale_pdf')){
                    common::update_media($request->file('business_for_sale_pdf'), $add_response->id, 'App\Models\Ad', 'pdf');
                }

            }

            $response = BusinessForSale::create($business_for_sale);

            //Notification data
            $notifiable_id = $response->id;
            $notification_obj = new NotificationController();
            $notification_response = $notification_obj->create($notifiable_id, 'App\BusinessForSale', 'property have been added');
            $notification_id_search = $notification_response->id;
            //trigger event
            //event(new PropertyForRentEvent($notifiable_id, $notification_id_search));
            DB::commit();
            $data['success'] = $response;
            echo json_encode($data);

        } catch (\Exception $e) {
            DB::rollback();
            (header("HTTP/1.0 404 Not Found"));
            $data['failure'] = $e->getMessage();
            echo json_encode($data);
            exit();
        }
    }

    // Edit form for business for sale ad
    public function editBusinessForSale($id)
    {
        common::delete_media(Auth::user()->id, 'business_for_sale_temp_images', 'gallery');
        $business_for_sale = BusinessForSale::findOrFail($id);
        if ($business_for_sale) {
            if (!Auth::user()->hasRole('admin') && ($business_for_sale->user_id != Auth::user()->id || $business_for_sale->ad->status == 'sold')) {
                return redirect('forbidden');
            }
            return view('user-panel.property.business_for_sale', compact('business_for_sale'));
        } else {
            abort(404);
        }
    }

    //update dummy updateDummyCommercialPropertyForRent
    public function updateDummyBusinessForSale(AddBusinessForSale $request, $id)
    {
        $msg = $this->updateBusinessForSale($request,$id,'controller');
        if($msg['flag'] == 'success'){
            $property = BusinessForSale::find($id);
            $message = '';
            $ad = $property->ad;

            if ($ad && $ad->status == 'saved') {
                $ad_expiry_response = common::create_update_ad_expiry($ad,$request->all());
                if(!$ad_expiry_response['flag']){
                    echo json_encode($ad_expiry_response);
                    exit();
                }

                $message = 'Annonsen din er publisert.';
                //$published_date = date("Y-m-d H:i:s");
                //$response = $ad->update(['status' => 'published', 'published_on' => $published_date]);
            } elseif ($ad && $ad->status == 'published') {
                $message = 'Annonsen din er oppdatert.';
                $media = common::updated_dropzone_images_type($request->all(),'business_for_sale_temp_images',$ad->id);
                if($request->media_position){
                    $media_position = common::update_media_position($request->media_position);
                }
                if($request->deleted_media){
                    $delete_media = common::delete_json_media($request->deleted_media);
                }
            }

            //notification bellow
            common::send_search_notification($property, 'saved_search', 'Søk varsel: ny annonse', $this->pusher, 'property/business-for-sale',$ad);
            //end notification

            $msg['message'] = $message;
//                $data['success'] = $response;
            $msg['status'] = $ad->status;
            echo json_encode($msg);
        }else{
            echo json_encode($msg);
            exit();
        }

    }

    // update for business for sale ad
    public function updateBusinessForSale(Request $request, $id,$call_by='')
    {
        $property_pdf = '';
        DB::beginTransaction();
        try {
            $business_for_sale = $request->except(['_method', 'upload_dropzone_images_type','media_position','deleted_media','company_id','agent_id','old_price','to_publish_ad','package_id']);

            unset($business_for_sale['business_for_sale_pdf']);
//            $business_for_sale['user_id'] = Auth::user()->id;

            if (isset($business_for_sale['published_on']) && $business_for_sale['published_on'] == 'on') {
                $business_for_sale['published_on'] = 1;
            } else {
                $business_for_sale['published_on'] = 0;
            }

            $response = BusinessForSale::find($id);
            if ($response) {
//                Update media (mediable id and mediable type)
                if ($response->ad) {
                    $business_for_sale = common::updated_dropzone_images_type($business_for_sale, $request->upload_dropzone_images_type, $response->ad->id);

                    //Store property_pdf file
                    if($request->file('business_for_sale_pdf')){
                        $property_pdf = common::update_media($request->file('business_for_sale_pdf'), $response->ad->id, 'App\Models\Ad', 'pdf');
                        if($property_pdf){
//                            $property_pdf = json_decode($property_pdf);
                            $property_pdf = $property_pdf['file_names'][0];//$property_pdf->file_names[0];
                        }
                    }
                    common::sync_ad_agents($response->ad,$request->agent_id);

                }
                $response->update($business_for_sale);
                
            if ($request->old_price != $request->monthly_rent) {
                $ad_id = BusinessForSale::where('id', '=', $id)->first();
                $ad = Ad::find($ad_id->ad_id);
                common::property_notification($ad, $this->pusher, Auth::user()->id,'business_for_sale');
            }
            }


//            Notification data
//            $notifiable_id = $response -> id;
//            $notification_obj = new NotificationController();
//            $notification_response = $notification_obj->create($notifiable_id,'App\BusinessForSale','property have been added');
//            $notification_id_search = $notification_response->id;
//            //trigger event
//            //event(new PropertyForRentEvent($notifiable_id,$notification_id_search));
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

    public function businessForSaleDescription($id)
    {
        $property_data = BusinessForSale::where('id', $id)->first();
        return view('common.partials.property.business_for_sale_description')->with(compact('property_data'));
    }
}
