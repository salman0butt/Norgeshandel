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
//            $query->where('business_for_sales.headline', 'like', '%' . $request->search . '%');
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

        switch ($sort) {
            case 'published':
                $query->orderBy('ads.updated_at', 'DESC');
                break;
            case 'priced-low-high':
                $query->orderBy('price', 'ASC');
                break;
            case 'priced-high-low':
                $query->orderBy('price', 'DESC');
                break;
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

        $ad = new Ad(['ad_type' => 'property_business_for_sale', 'status' => 'saved', 'user_id' => Auth::id()]);
        $ad->save();


        if ($ad) {
            $property = new BusinessForSale(['user_id' => Auth::id()]);
            $ad->propertyBusinessForSale()->save($property);
            if ($property) {

                return redirect(url('complete/ad/' . $ad->id));
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    // store business for sale ad
    public function addBusinessForSale(AddBusinessForSale $request)
    {
        DB::beginTransaction();
        try {
            $business_for_sale = $request->except('upload_dropzone_images_type');

            unset($business_for_sale['business_for_sale_pdf']);
            $business_for_sale['user_id'] = Auth::user()->id;

            //add Add to table
            $add = array();
            $add['ad_type'] = 'property_business_for_sale';
            $add['status'] = 'published';
            $add['user_id'] = Auth::user()->id;
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
                $message = 'Annonsen din er publisert.';
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
            $response = $ad->update(['status' => 'published']);

//            notification bellow
            common::send_search_notification($property, 'saved_search', $message, $this->pusher, 'property/business-for-sale');
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

    // update for business for sale ad
    public function updateBusinessForSale(Request $request, $id,$call_by='')
    {
        $property_pdf = '';
        DB::beginTransaction();
        try {
            $business_for_sale = $request->except(['_method', 'upload_dropzone_images_type','media_position','deleted_media']);

            unset($business_for_sale['business_for_sale_pdf']);
            $business_for_sale['user_id'] = Auth::user()->id;

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
                }
                $response->update($business_for_sale);
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
