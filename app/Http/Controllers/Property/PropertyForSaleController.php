<?php

namespace App\Http\Controllers\Property;
use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Http\Requests\AddPropertyForRent;
use App\Http\Requests\AddPropertyForSale;
use App\Models\Ad;
use App\Models\AdView;
use App\Notification;
use App\PropertyForRent;
use App\PropertyForSale;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class PropertyForSaleController extends Controller
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

    public function search_property_for_sale(Request $request, $get_collection=false)
    {
        if(isset($request->search_id) && !$get_collection){
            Notification::where('notifiable_id', '=', $request->search_id)
                ->whereNull('read_at')->update(['read_at'=>now()]);
        }
        $table = 'property_for_sales';
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


        $arr = Arr::only($request->all(), ['country']);

        if (isset($request->for_sale) && !empty($request->for_sale)) {
            $query->where('ads.status', '!=', 'sold');
        }
        if (isset($request->sold_in_three_days) && !empty($request->sold_in_three_days)) {
            $query->whereDate('ads.sold_at', '>', now()->addDays(-3));
        }
        if (isset($request->search) && !empty($request->search)) {
//            $query->where('headline', 'like', '%' . $request->search . '%');
            common::table_search($query, common::get_model_columns(PropertyForSale::class), $request->search, 'property_for_sales');
        }
        if (isset($request->created_at)) {
            $query->whereDate($table . '.updated_at', '=', $request->created_at);
        }
        if (isset($request->local_area_name_check) && !empty($request->local_area_name_check)) {
            if (isset($request->local_area_name) && !empty($request->local_area_name)) {
                $query->where($table . '.local_area_name', 'like', '%' . $request->local_area_name . '%');
            }
        }


        if (isset($request->asking_price_from) && !empty($request->asking_price_from)) {
            $query->where($table . '.asking_price', '>=', (int)$request->asking_price_from);
        }
        if (isset($request->asking_price_to) && !empty($request->asking_price_to)) {
            $query->where($table . '.asking_price', '<=', (int)$request->asking_price_to);
        }

        if (isset($request->total_price_from) && !empty($request->total_price_from)) {
            $query->where($table . '.total_price', '>=', (int)$request->total_price_from);
        }
        if (isset($request->total_price_to) && !empty($request->total_price_to)) {
            $query->where($table . '.total_price', '<=', (int)$request->total_price_to);
        }

        if (isset($request->rent_shared_cost_from) && !empty($request->rent_shared_cost_from)) {
            $query->where($table . '.rent_shared_cost', '>=', (int)$request->rent_shared_cost_from);
        }
        if (isset($request->total_price_to) && !empty($request->total_price_to)) {
            $query->where($table . '.rent_shared_cost', '<=', (int)$request->rent_shared_cost_to);
        }

        if (isset($request->use_area_from) && !empty($request->use_area_from)) {
            $query->where($table . '.use_area', '>=', (int)$request->use_area_from);
        }
        if (isset($request->use_area_to) && !empty($request->use_area_to)) {
            $query->where($table . '.use_area', '<=', (int)$request->use_area_to);
        }

        if (isset($request->number_of_bedrooms) && !empty($request->number_of_bedrooms)) {
            $query->where($table . '.number_of_bedrooms', '>=', (int)$request->number_of_bedrooms);
        }

        if (isset($request->land_from) && !empty($request->land_from)) {
            $query->where($table . '.land', '>=', (int)$request->land_from);
        }
        if (isset($request->land_to) && !empty($request->land_to)) {
            $query->where($table . '.land', '<=', (int)$request->land_to);
        }

        if (isset($request->year_from) && !empty($request->year_from)) {
            $query->where($table . '.year', '>=', (int)$request->year_from);
        }

        if (isset($request->year_to) && !empty($request->year_to)) {
            $query->where($table . '.year', '<=', (int)$request->year_to);
        }

        if (isset($request->condition) && !empty($request->condition)) {
            if (in_array("new", $request->condition)) {
                $query->where($table . '.year', '>=', today()->addMonths(-6)->year);
            }
            if (in_array("used", $request->condition)) {
                $query->where($table . '.year', '<', today()->addMonths(-6)->year);
            }
        }
        if (isset($request->display_date) && !empty($request->display_date)) {
            $query->whereDate($table . '.deliver_date', '=', $request->display_date[0]);
            for ($i = 1; $i < count($request->display_date); $i++) {
                $query->orWhereDate($table . '.deliver_date', '=', $request->display_date[$i]);
            }
        }

        if (isset($request->pfs_property_type) && !empty($request->pfs_property_type)) {
            $query->whereIn($table . '.property_type', $request->pfs_property_type);
        }

        if (isset($request->pfs_tenure) && !empty($request->pfs_tenure)) {
            $query->whereIn($table . '.tenure', $request->pfs_tenure);
        }


        if (isset($request->facilities) && !empty($request->facilities)) {
            $query->where($table . '.facilities', 'like', '%' . $request->facilities[0] . '%');
            for ($i = 1; $i < count($request->facilities); $i++) {
                $query->orWhere($table . '.facilities', 'like', '%' . $request->facilities[$i] . '%');
            }
        }
        if (isset($request->floor) && !empty($request->floor)) {
            $query->whereIn($table . '.floor', $request->floor);
            if (in_array('over 6', $request->floor)) {
                $query->orwhere($table . '.floor', '>', 6);
            }
        }

        if (isset($request->energy_unit) && !empty($request->energy_unit)) {
            $query->whereIn($table . '.energy_grade', $request->energy_unit);
        }

        if (isset($request->user_id) && !empty($request->user_id)) {
            $query->where('ads.user_id', $request->user_id);
        }
        if (isset($request->company_id) && !empty($request->company_id)) {
            $query->where('ads.company_id', $request->company_id);
        }
//        $query->orderBy('ads.published_on', 'DESC');

        switch ($sort) {
            case 'most_relevant':
                $query->orderBy('ads.updated_at', 'DESC');
                break;
            case 'published':
                $query->orderBy('ads.published_on', 'DESC');
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
        }
        $query->where($arr);

        if ($get_collection){
            return $query->get();
        }

        $query->orderBy('ads.published_on', 'DESC');
        $all = $query->get();
        $ids = $all->pluck('id');
        $clicks = AdView::whereIn('ad_id', $ids)->count();
        $add_array = $query->paginate($this->pagination);
        if ($request->ajax()) {
            $html = view('user-panel.property.search-property-for-sale-inner', compact('add_array', 'col', 'sort', 'clicks'))->render();
            exit($html);
        }
        return view('user-panel.property.search-property-for-sale', compact('col', 'add_array', 'sort', 'clicks'));
    }

//    zain
    public function new_property_for_sale(Request $request)
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
            $ad = new Ad(['ad_type' => 'property_for_sale', 'status' => 'saved', 'user_id' => $auth_id, 'company_id'=>$company_id]);
            $ad->save();
            if ($ad) {
                $property = new PropertyForSale(['user_id' => $auth_id]);
                $ad->propertyForSale()->save($property);
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


    public function editSaleAdd($id)
    {
        common::delete_media(Auth::user()->id, 'property_for_sale_temp_images', 'gallery');
        $property_for_sale1 = PropertyForSale::findOrFail($id);
        if ($property_for_sale1) {
            if (!Auth::user()->hasRole('admin') && ($property_for_sale1->user_id != Auth::user()->id || $property_for_sale1->ad->status == 'sold')) {
                abort(404);
            }
            return view('user-panel.property.new_sale_add', compact('property_for_sale1'));
        } else {
            abort(404);
        }

    }

    //update dummy property for sale to published
    public function UpdateDummySaleAdd(AddPropertyForSale $request, $id)
    {

        $msg = $this->updateSaleAdd($request,$id,'controller');
        if($msg['flag'] == 'success'){
            //  DB::connection()->enableQueryLog();
            $property = PropertyForSale::find($id);
            $ad  = $property->ad();
            if ($property) {
                $message = '';
                $ad = $property->ad;
                if ($ad && $ad->status == 'saved') {
                    $message = 'Annonsen din er publisert.';
                } elseif ($ad && $ad->status == 'published') {
                    $message = 'Annonsen din er oppdatert.';
                    $media = common::updated_dropzone_images_type($request->all(),'property_for_sale_temp_images',$ad->id);
                    if($request->media_position){
                        $media_position = common::update_media_position($request->media_position);
                    }
                    if($request->deleted_media){
                        $delete_media = common::delete_json_media($request->deleted_media);
                    }
                }
                $published_date = date("Y-m-d H:i:s");
                $response = $ad->update(['status' => 'published', 'published_on' => $published_date]);
                if ($response) {
                    //notifications bellow
                    common::send_search_notification($property, 'saved_search', 'Søk varsel: ny annonse', $this->pusher, 'property/property-for-sale',$ad);
                    //notifications ended
                }
                $msg['message'] = $message;
                $msg['status'] = $ad->status;
                echo json_encode($msg);
            }
        }else{
            echo json_encode($msg);
            exit();
        }
    }

    public function updateSaleAdd(Request $request, $id,$call_by='')
    {
        $property_quote = $property_pdf = '';
        DB::beginTransaction();
        try {
            if (!$request->approved_rental_part) {
                $request->merge(['approved_rental_part' => null]);
            }
            if (!$request->facilities2) {
                $request->merge(['facilities2' => null]);
            }
            if (!$request->facilities3) {
                $request->merge(['facilities3' => null]);
            }
            if (!$request->facilities4) {
                $request->merge(['facilities4' => null]);
            }

            $property_for_sale_data = $request->except(['_method', 'upload_dropzone_images_type','media_position','deleted_media','company_id','agent_id','old_price']);

            $property_for_sale_data['secondary_deliver_date'] = $property_for_sale_data['secondary_from_clock'] = $property_for_sale_data['secondary_clockwise'] = $property_for_sale_data['secondary_note1'] = null;

            if(isset($request->secondary_deliver_date)){
                $property_for_sale_data['secondary_deliver_date'] = json_encode($request->secondary_deliver_date);
            }

            if(isset($request->secondary_from_clock)){
                $property_for_sale_data['secondary_from_clock'] = json_encode($request->secondary_from_clock);
            }

            if(isset($request->secondary_clockwise)){
                $property_for_sale_data['secondary_clockwise'] = json_encode($request->secondary_clockwise);
            }

            if(isset($request->secondary_note1)){
                $property_for_sale_data['secondary_note1'] = json_encode($request->secondary_note1);
            }

           /*
            //Add More ViewingTimes
            if (isset($property_for_sale_data['deliver_date']) && $property_for_sale_data['deliver_date'] != "") {
                $property_for_sale_data['secondary_deliver_date'] = null;
                $i = 0;
                foreach ($property_for_sale_data['deliver_date'] as $key => $val) {
                    if ($i == 0) {
                        $property_for_sale_data['deliver_date'] = $val;
                    } else {
                        $property_for_sale_data['secondary_deliver_date'] .= $val . ",";
                    }
                    $i++;
                }
            }

            $property_for_sale_data['secondary_from_clock'] = "";
            if (isset($property_for_sale_data['from_clock'])) {
                $i = 0;
                foreach ($property_for_sale_data['from_clock'] as $key => $val) {
                    if ($i == 0) {
                        $property_for_sale_data['from_clock'] = $val;
                    } else {
                        $property_for_sale_data['secondary_from_clock'] .= $val . ",";
                    }
                    $i++;
                }
            }

            $property_for_sale_data['secondary_clockwise'] = "";
            if (isset($property_for_sale_data['clockwise'])) {
                $i = 0;
                foreach ($property_for_sale_data['clockwise'] as $key => $val) {
                    if ($i == 0) {
                        $property_for_sale_data['clockwise'] = $val;
                    } else {
                        $property_for_sale_data['secondary_clockwise'] .= $val . ",";
                    }
                    $i++;
                }
            }

            $property_for_sale_data['secondary_note1'] = "";
            if (isset($property_for_sale_data['note1'])) {
                $i = 0;
                foreach ($property_for_sale_data['note1'] as $key => $val) {
                    if ($i == 0) {
                        $property_for_sale_data['note1'] = $val;
                    } else {
                        $property_for_sale_data['secondary_note1'] .= $val . ",";
                    }
                    $i++;
                }
            }

           */

            unset($property_for_sale_data['property_pdf']);
            unset($property_for_sale_data['property_quote']);

            //Manage Facilities
            if (isset($property_for_sale_data['facilities'])) {
                $property_for_sale_data['facilities'] = json_encode($property_for_sale_data['facilities']);
            }

//            $property_for_sale_data['user_id'] = Auth::user()->id;

            //Update media (mediable id and mediable type)
            if ($id) {
                $temp_property_for_sale_obj = PropertyForSale::find($id);
                if ($temp_property_for_sale_obj && $temp_property_for_sale_obj->ad) {
                    $property_for_sale_data = common::updated_dropzone_images_type($property_for_sale_data, $request->upload_dropzone_images_type, $temp_property_for_sale_obj->ad->id);

                    //Store property_pdf file
                    if($request->file('property_pdf')){
                        $property_pdf = common::update_media($request->file('property_pdf'), $temp_property_for_sale_obj->ad->id, 'App\Models\Ad', 'pdf');
                        if($property_pdf){
                            $property_pdf = $property_pdf['file_names'][0];//$property_pdf->file_names[0];
                        }
                    }

                    //Store property_quote file
                    if($request->file('property_quote')){
                        $property_quote = common::update_media($request->file('property_quote'), $temp_property_for_sale_obj->ad->id, 'App\Models\Ad', 'sales_information');
                        if($property_quote){
                            $property_quote = $property_quote['file_names'][0];//$property_quote->file_names[0];
                        }
                    }

                    common::sync_ad_agents($temp_property_for_sale_obj->ad,$request->agent_id);


                }
            }
            if (isset($property_for_sale_data['published-on']) && $property_for_sale_data['published-on'] == 'on') {
                $property_for_sale_data['published-on'] = 1;
            } else {
                $property_for_sale_data['published-on'] = 0;
            }

            $response = PropertyForSale::where('id', '=', $id)->update($property_for_sale_data);
            if ($request->old_price != $request->total_price) {
                $ad_id = PropertyForSale::where('id', '=', $id)->first();
              
                $ad = Ad::find($ad_id->ad_id);
         
                common::property_notification($ad, $this->pusher, Auth::user()->id,'property_for_sale');
            }
            DB::commit();
            $data['property_quote'] = $property_quote;
            $data['property_pdf'] = $property_pdf;
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

    public function propertyForSaleDescription($id)
    {
        $property_data = PropertyForSale::where('id', $id)->first();
        return view('common.partials.property.property_for_sale_description')->with(compact('property_data'));
    }
}
