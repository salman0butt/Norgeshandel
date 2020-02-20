<?php

namespace App\Http\Controllers;

use App\Media;
use Mapper;
use App\User;
use App\Message;
use App\Models\Ad;
use Pusher\Pusher;
use App\Model\Search;
use App\CommercialPlot;
use App\Helpers\common;
use App\BusinessForSale;
use App\PropertyForRent;
use App\PropertyForSale;
use App\FlatWishesRented;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\RealestateBusinessPlot;
use App\PropertyForRentMoreTimes;
use App\CommercialPropertyForRent;
use App\CommercialPropertyForSale;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\PropertyHolidaysHomesForSale;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AddCommercialPlot;
use App\Http\Requests\AddBusinessForSale;
use App\Http\Requests\AddPropertyForRent;
use App\Http\Requests\AddPropertyForSale;
use App\Http\Requests\AddFlatWishesRented;
use App\Http\Controllers\NotificationController;
use App\Http\Requests\AddRealEstateBusinessPlot;
use App\Http\Requests\AddCommercialPropertyForRent;
use App\Http\Requests\AddCommercialPropertyForSale;
use App\Http\Requests\AddPropertyHolidayHomeForSale;
use App\Events\PropertyForRent as PropertyForRentEvent;



class PropertyController extends Controller
{
    //
    public function __construct()
    {
        Mapper::map(53.381128999999990000, -1.470085000000040000);
    }

    public function mapTest()
    {

    }

    public function search_property_for_sale(Request $request){
        $col = 'list';
        if (isset($request->view) && !empty($request->view)){
            $col = $request->view;
        }
        $query = DB::table('ads')
            ->join('property_for_sales', 'property_for_sales.ad_id', 'ads.id')
            ->where('ads.status', 'published');


        $arr = Arr::only($request->all(), ['country']);
        if (isset($request->search) && !empty($request->search)){
            $query->where('headline', 'like', '%'.$request->search.'%');
        }
        if (isset($request->created_at)){
            $query->whereDate('property_for_sales.created_at', '=', $request->created_at);
        }
        if (isset($request->local_area_name_check) && !empty($request->local_area_name_check)) {
            if (isset($request->local_area_name) && !empty($request->local_area_name)) {
                $query->where('property_for_sales.local_area_name', 'like', '%' . $request->local_area_name . '%');
            }
        }

        if (isset($request->asking_price_from) && !empty($request->asking_price_from)) {
                $query->where('property_for_sales.asking_price', '>=', (int)$request->asking_price_from);
        }
        if (isset($request->asking_price_to) && !empty($request->asking_price_to)) {
                $query->where('property_for_sales.asking_price', '<=', (int)$request->asking_price_to);
        }

        if (isset($request->total_price_from) && !empty($request->total_price_from)) {
                $query->where('property_for_sales.total_price', '>=', (int)$request->total_price_from);
        }
        if (isset($request->total_price_to) && !empty($request->total_price_to)) {
                $query->where('property_for_sales.total_price', '<=', (int)$request->total_price_to);
        }

        if (isset($request->rent_shared_cost_from) && !empty($request->rent_shared_cost_from)) {
                $query->where('property_for_sales.rent_shared_cost', '>=', (int)$request->rent_shared_cost_from);
        }
        if (isset($request->total_price_to) && !empty($request->total_price_to)) {
                $query->where('property_for_sales.rent_shared_cost', '<=', (int)$request->rent_shared_cost_to);
        }

        if (isset($request->use_area_from) && !empty($request->use_area_from)) {
                $query->where('property_for_sales.use_area', '>=', (int)$request->use_area_from);
        }
        if (isset($request->use_area_to) && !empty($request->use_area_to)) {
                $query->where('property_for_sales.use_area', '<=', (int)$request->use_area_to);
        }

        if (isset($request->number_of_bedrooms) && !empty($request->number_of_bedrooms)) {
                $query->where('property_for_sales.number_of_bedrooms', '>=', (int)$request->number_of_bedrooms);
        }

        if (isset($request->land_from) && !empty($request->land_from)) {
            $query->where('property_for_sales.land', '>=', (int)$request->land_from);
        }
        if (isset($request->land_to) && !empty($request->land_to)) {
            $query->where('property_for_sales.land', '<=', (int)$request->land_to);
        }

        if (isset($request->year_from) && !empty($request->year_from)) {
            $query->where('property_for_sales.year', '>=', (int)$request->year_from);
        }

        if (isset($request->year_to) && !empty($request->year_to)) {
            $query->where('property_for_sales.year', '<=', (int)$request->year_to);
        }

        if (isset($request->condition) && !empty($request->condition)) {
            if(in_array("new", $request->condition)){
                $query->where('property_for_sales.year', '>=', today()->addMonths(-6)->year);
            }
            if(in_array("used", $request->condition)){
                $query->where('property_for_sales.year', '<', today()->addMonths(-6)->year);
            }
        }

        if (isset($request->display_date) && !empty($request->display_date)) {
            $query->whereDate('property_for_sales.deliver_date', '=', $request->display_date[0]);
            for($i=1; $i<count($request->display_date); $i++){
                $query->orWhereDate('property_for_sales.deliver_date', '=', $request->display_date[$i]);
            }
        }

        if (isset($request->pfs_property_type) && !empty($request->pfs_property_type)) {
            $query->whereIn('property_for_sales.property_type', $request->pfs_property_type);
        }

        if (isset($request->pfs_tenure) && !empty($request->pfs_tenure)) {
            $query->whereIn('property_for_sales.tenure', $request->pfs_tenure);
        }

        if (isset($request->facilities) && !empty($request->facilities)) {
            $query->where('property_for_sales.facilities', 'like', '%'.$request->facilities[0].'%');
            for($i=1; $i<count($request->facilities); $i++){
                $query->orWhere('property_for_sales.facilities', 'like', '%'.$request->facilities[$i].'%');
            }
        }

        if (isset($request->floor) && !empty($request->floor)) {
            $query->whereIn('property_for_sales.floor', $request->floor);
            if (in_array('over 6', $request->floor)){
//                dd($request->floor);
                $query->orwhere('property_for_sales.floor', '>', 6);
            }
        }

        if (isset($request->energy_unit) && !empty($request->energy_unit)) {
            $query->whereIn('property_for_sales.energy_grade', $request->energy_unit);
        }



        $order_by_thing = 'id';
        $order_by = 'DESC';

        if(isset($request->order) && !empty($request->order)) {
            $order = $request->order;
            switch ($order){
                case 'priced-low-high':
                    $query->orderBy('asking_price' ,'ASC');
                    break;
                case 'priced-high-low':
                    $query->orderBy('asking_price' ,'DESC');
                    break;
                case 'p-rom-area-low-high':
                    $query->orderBy('primary_room' ,'ASC');
                    break;
                case 'p-rom-area-high-low':
                    $query->orderBy('primary_room' ,'DESC');
                    break;
                case 'total-price-low-high':
                    $query->orderBy('total_price' ,'ASC');
                    break;
                case 'total-price-high-low':
                    $query->orderBy('total_price' ,'DESC');
                    break;
            }
        }
        $query->where($arr);

        $add_array = $query->paginate(getenv('PAGINATION'));

        if ($request->ajax()){
            $html = view('user-panel.property.search-property-for-sale-inner', compact( 'add_array', 'col'))->render();
            exit($html);
        }
        return view('user-panel.property.search-property-for-sale', compact('col', 'add_array'));
    }

    public function list()
    {
         $saved_search = Search::where('type', 'saved')->orderBy('id', 'desc')->limit(5)->get();
        $recent_search = Search::where('type', 'recent')->orderBy('id', 'desc')->limit(5)->get();
        $ads = Ad::where('status','published')
            ->where('ad_type','!=','job')
            ->orderBy('id', 'desc')->get();

        return view('user-panel.property.property_list',compact('ads','saved_search','recent_search'));
    }

    public function adsPropertyForSale(Request $request)
    {
        $data = $request->all();
        $searchable = (isset($data['filter']) ? $data['filter'] : "");
        $order_by_thing = 'id';
        $order_by       = 'DESC';

        if($searchable == 'priced-low-high')
        {
            $order_by_thing = "asking_price";
            $order_by       =  "ASC";

        }
        else if($searchable == "priced-high-low")
        {
            $order_by_thing = "asking_price";
            $order_by       =  "DESC";
        }
        elseif($searchable == "p-rom-area-low-high")
        {
            $order_by_thing = "primary_room";
            $order_by = "ASC";
        }
        else if($searchable == "p-rom-area-high-low")
        {
            $order_by_thing = "primary_room";
            $order_by = "DESC";
        }
        elseif($searchable == "total-price-low-high")
        {
            $order_by_thing = "primary_room";
            $order_by = "ASC";
        }
        else if($searchable == "total-price-high-low")
        {
            $order_by_thing = "total_price";
            $order_by = "DESC";
        }


        $add_array = DB::table('property_for_sales')->orderBy($order_by_thing ,$order_by)->paginate(getenv('PAGINATION'));

        if($request->ajax())
        {
            return view('common.partials.property.ads_for_sale_sortion_pagination')->with(compact('add_array'))->render();
        }

        return view('user-panel.property.ads_for_property_for_sale')->with(compact('add_array'));
    }


   public function adsForHomeHolidays()
   {
        // $add_array = DB::table('property_holidays_homes_for_sales')
        // ->join('media', 'property_holidays_homes_for_sales.id', '=', 'media.mediable_id')
        // ->where(['user_id'=>Auth::user()->id,'mediable_type' => 'App\PropertyHolidaysHomesForSale'])->get()->toArray();
        $add_array = DB::table('property_holidays_homes_for_sales')->orderBy('id', 'DESC')->get()->toArray();
        return view('user-panel.property.holiday_for_sale_filter')->with(compact('add_array'));
   }


    public function newAdd(){
        return view('user-panel.property.new_add');
    }
    public function newAddedit($id){
        $property_for_rent = PropertyForRent::findOrFail($id);
        return view('user-panel.property.new_add',compact('property_for_rent'));
    }
        public function UpdatePropertyForRentAdd(Request $request,$id)
    {
        

        $property_for_rent_data = $request->except('_method');
        // dd($property_for_rent_data);
        // // dd($property_for_rent_data);

        //Manage Facilities
        if(isset($property_for_rent_data['facilities']))
        {
            $facilities = "";
            foreach($property_for_rent_data['facilities'] as $key=>$val)
            {
                $facilities .= $val . ",";
            }
            $property_for_rent_data['facilities'] = $facilities;
        }

        //Add More ViewingTimes
        if(isset($property_for_rent_data['delivery_date']) && $property_for_rent_data['delivery_date'] != "")
        {
            $property_for_rent_data['secondary_delivery_date'] = null;
            $i = 0;
            foreach($property_for_rent_data['delivery_date'] as $key=>$val)
            {
                if($i == 0)
                {
                    $property_for_rent_data['delivery_date']  = $val;
                }
                else
                {
                    $property_for_rent_data['secondary_delivery_date'] .= $val.",";
                }
                $i++;
            }
        }

        $property_for_rent_data['secondary_from_clock'] = "";
        if(isset($property_for_rent_data['from_clock']))
        {
            $i = 0;
            foreach($property_for_rent_data['from_clock'] as $key=>$val)
            {
                if($i == 0)
                {
                    $property_for_rent_data['from_clock']  = $val;
                }
                else
                {
                    $property_for_rent_data['secondary_from_clock'] .= $val.",";
                }
                $i++;
            }
        }

        $property_for_rent_data['secondary_clockwise_clock'] = "";
        if(isset($property_for_rent_data['clockwise_clock']))
        {
            $i = 0;
            foreach($property_for_rent_data['clockwise_clock'] as $key=>$val)
            {
                if($i == 0)
                {
                    $property_for_rent_data['clockwise_clock']  = $val;
                }
                else
                {
                    $property_for_rent_data['secondary_clockwise_clock'] .= $val.",";
                }
                $i++;
            }
        }

        $property_for_rent_data['secondary_note'] = "";
        if(isset($property_for_rent_data['note']))
        {
            $i = 0;
            foreach($property_for_rent_data['note'] as $key=>$val)
            {
                if($i == 0)
                {
                    $property_for_rent_data['note']  = $val;
                }
                else
                {
                    $property_for_rent_data['secondary_note'] .= $val.",";
                }
                $i++;
            }
        }

        if(isset($property_for_rent_data['published_on']) && $property_for_rent_data['published_on'] == 'on')
        {
            $property_for_rent_data['published_on'] = 1;
        }
        else
        {
            $property_for_rent_data['published_on'] = 0;
        }

        unset($property_for_rent_data['property_photos']);
        $property_for_rent_data['user_id'] = Auth::user()->id;

        //add Add to tables
        // $add = array();
        // $add['ad_type'] = 'property_for_rent';
        // $add['status']  = 'published';
        // $add['user_id'] =  Auth::user()->id;
        // $add_response   =  Ad::where('id', '=', $id)->update($add);


        // $property_for_rent_data['ad_id'] = $add_response->id;

        $response = PropertyForRent::findOrFail($id);
        $response->update($property_for_rent_data);
        //add images
      // dd($response);
        if (is_countable($request->file('property_photos')))
        {
            common::update_media($request->file('property_photos'), $response->id , 'App\PropertyForRent', 'gallery'); 
            //propert_for_rent
        }

        //Notification data
        // $notifiable_id = $response -> id;
        // $notification_obj = new NotificationController();
        // $notification_response = $notification_obj->create($notifiable_id,'App\PropertyForRent','property have been added');
        // $notification_id_search = $notification_response->id;
        // //trigger event
        // event(new PropertyForRentEvent($notifiable_id,$notification_id_search));

        $data['success'] = $response;
        echo json_encode($data);
    }
    public function deletePropertyForRent($id){
        $property_for_rent = PropertyForRent::findOrFail($id);
        if(!empty($property_for_rent->media)){
            if($property_for_rent->media->first())
        common::delete_media($property_for_rent->media->first->mediable_id,$property_for_rent->media->first->mediable_type, $property_for_rent->media->first->type);
        }
        $property_for_rent->delete();
      // $ad->delete();
       // dd('working');
     Session::flash('success', 'Property Deleted Successfully');

        return redirect('/my-business/my-ads');
    }

    public function property_destroy($obj){
        // $obj has ad id
        $ad = Ad::find($obj);
        if($ad){
            DB::beginTransaction();
            try{
                if(!Auth::user()->hasRole('admin') && $ad && $ad->property && $ad->property->user_id != Auth::id()){
                    abort(404);
                }
                if($ad->property){
                    common::delete_media($ad->property->id, get_class($ad->property), 'logo');
                    common::delete_media($ad->property->id, get_class($ad->property), 'gallery');
                    $ad->property->delete();
                }
                $ad_id = $ad->id;
                $ad->delete();
                common::delete_media($ad_id, Ad::class, 'logo');
                common::delete_media($ad_id, Ad::class, 'gallery');
                DB::commit();
                Session::flash('success', 'Eiendom ble slettet.');
                return back();

            }catch (\Exception $e){
                DB::rollback();
                Session::flash('danger', 'Noe gikk galt.');
                return back();
            }
        }else{
            abort(404);
        }
    }

    public function newSaleAdd(){
        common::delete_media(Auth::user()->id, 'property_for_sale_temp_images', 'gallery');
        return view('user-panel.property.new_sale_add');
    }
     public function editSaleAdd($id){
         $property_for_sale1 = PropertyForSale::findOrFail($id);
         if($property_for_sale1){
             if(!Auth::user()->hasRole('admin') && $property_for_sale1->user_id != Auth::user()->id){
                 abort(404);
             }
             return view('user-panel.property.new_sale_add', compact('property_for_sale1'));
         }else{
             abort(404);
         }

    }

    public function getHomeForSaleAdd(Request $request){

        $data = $request->all();
        $searchable = $data['sending'];
        $filtering  = $data['stylings'];

        $order_by_thing = "asking_price";
        $order_by = "asc";

        if($data['sending'] == 'priced-low-high')
        {
            $order_by_thing = "asking_price";
            $order_by       =  "asc";

        }
        else if($data['sending'] == "priced-high-low")
        {
            $order_by_thing = "asking_price";
            $order_by = "desc";
        }
        else if($data['sending'] == "housing_area_low_high")
        {
            $order_by_thing = "housing_area";
            $order_by = "asc";
        }
        else if($data['sending'] == "housing_area_high_low")
        {
            $order_by_thing = "housing_area";
            $order_by = "desc";
        }

        $add_array = DB::table('property_holidays_homes_for_sales')->orderBy($order_by_thing,$order_by)->paginate(getenv('PAGINATION'));
        // $add_array = DB::table('property_holidays_homes_for_sales')->orderBy($order_by_thing,$order_by)->get(['id'])->toArray();
        $response =  view('common.partials.property.holiday_home_for_sale_render_ads')->with(compact('add_array','filtering'))->render();

        $data['success'] = $response;
        echo json_encode($data);


    }


    public function sortedAddsPropertyForRent(Request $request)
    {
        $sorted_by = $request->all();
        $searchable = $sorted_by['sending'];
        $filtering  = $sorted_by['stylings'];

        if($searchable == 'priced-low-high')
        {
            $order_by_thing = "monthly_rent";
            $order_by       =  "ASC";
        }
        else if($searchable == 'priced-high-low')
        {
            $order_by_thing = "monthly_rent";
            $order_by       =  "DESC";
        }
        else if($searchable == 'p-rom-area-low-high')
        {
            $order_by_thing = "primary_rom";
            $order_by       =  "ASC";
        }
        else if($searchable == 'p-rom-area-high-low')
        {
            $order_by_thing = "primary_rom";
            $order_by       =  "DESC";
        }
        else if($searchable == 'total-price-low-high')
        {
            $order_by_thing = "monthly_rent";
            $order_by       =  "ASC";
        }
        else if($searchable == 'total-price-high-low')
        {
            $order_by_thing = "monthly_rent";
            $order_by       =  "DESC";
        }

        //$add_array = DB::table('property_for_rent')->orderBy($order_by_thing,$order_by)->get(['id'])->toArray();

        $add_array  = DB::table('property_for_rent')->orderBy($order_by_thing,$order_by)->paginate(getenv('PAGINATION'));
        $response  =  view('common.partials.property.render_ads')->with(compact('add_array', 'filtering'))->render();


        $data['success'] = $response;
        echo json_encode($data);


    }


    public function sortedAddsPropertyForSale(Request $request){

        $data = $request->all();
        $searchable = $data['sending'];
        $filtering  = $data['stylings'];

        if($data['sending'] == 'priced-low-high')
        {
            $order_by_thing = "asking_price";
            $order_by       =  "ASC";

        }
        else if($data['sending'] == "priced-high-low")
        {
            $order_by_thing = "asking_price";
            $order_by       =  "DESC";
        }
        elseif($data['sending'] == "p-rom-area-low-high")
        {
            $order_by_thing = "primary_room";
            $order_by = "ASC";
        }
        else if($data['sending'] == "p-rom-area-high-low")
        {
            $order_by_thing = "primary_room";
            $order_by = "DESC";
        }
        elseif($data['sending'] == "total-price-low-high")
        {
            $order_by_thing = "primary_room";
            $order_by = "ASC";
        }
        else if($data['sending'] == "total-price-high-low")
        {
            $order_by_thing = "total_price";
            $order_by = "DESC";
        }

        $add_array = DB::table('property_for_sales')->orderBy($order_by_thing,$order_by)->paginate(getenv('PAGINATION'));

        $response  =  view('common.partials.property.render_ads_for_sale')->with(compact('add_array','filtering'))->render();


        $data['success'] = $response;
        echo json_encode($data);


    }

    public function holidayHomeForSale(Request $request)
    {
        return view('user-panel.property.holiday_home_for_sale');
    }
    //edit Holiday Home For Sale
      public function editHolidayHomeForSale($id)
    {
        $holiday_home_for_sale = PropertyHolidaysHomesForSale::findOrFail($id);
        return view('user-panel.property.holiday_home_for_sale', compact('holiday_home_for_sale'));
    }
    //UpdatePropertyHolidayHomeForSale $request
    public function updateHomeForSaleAd(AddPropertyHolidayHomeForSale $request,$id)
    {
        $property_home_for_sale_data = $request->all();

        //Add More ViewingTimes
        if(isset($property_home_for_sale_data['delivery_date']) && $property_home_for_sale_data['delivery_date'] != "")
        {
            $property_home_for_sale_data['secondary_deliver_date'] = null;
            $i = 0;
            foreach($property_home_for_sale_data['delivery_date'] as $key=>$val)
            {
                if($i == 0)
                {
                    $property_home_for_sale_data['delivery_date']  = $val;
                }
                else
                {
                    $property_home_for_sale_data['secondary_deliver_date'] .= $val.",";
                }
                $i++;
            }
        }

        $property_home_for_sale_data['secondary_from_clock'] = "";
        if(isset($property_home_for_sale_data['from_clock']))
        {
            $i = 0;
            foreach($property_home_for_sale_data['from_clock'] as $key=>$val)
            {
                if($i == 0)
                {
                    $property_home_for_sale_data['from_clock']  = $val;
                }
                else
                {
                    $property_home_for_sale_data['secondary_from_clock'] .= $val.",";
                }
                $i++;
            }
        }

          $property_home_for_sale_data['secondary_clockwise'] = "";
          if(isset($property_home_for_sale_data['clockwise']))
          {
              $i = 0;
              foreach($property_home_for_sale_data['clockwise'] as $key=>$val)
              {
                  if($i == 0)
                  {
                      $property_home_for_sale_data['clockwise']  = $val;
                  }
                  else
                  {
                      $property_home_for_sale_data['secondary_clockwise'] .= $val.",";
                  }
                  $i++;
              }
          }

          $property_home_for_sale_data['secondary_note'] = "";
          if(isset($property_home_for_sale_data['note']))
          {
              $i = 0;
              foreach($property_home_for_sale_data['note'] as $key=>$val)
              {
                  if($i == 0)
                  {
                      $property_home_for_sale_data['note']  = $val;
                  }
                  else
                  {
                      $property_home_for_sale_data['secondary_note'] .= $val.",";
                  }
                  $i++;
              }
        }
        //Manage Facilities
        if(isset($property_home_for_sale_data['facilities']))
        {
            $facilities = "";
            foreach($property_home_for_sale_data['facilities'] as $key=>$val)
            {
                $facilities .= $val . ",";
            }
            $property_home_for_sale_data['facilities'] = $facilities;
        }

        $property_home_for_sale_data['user_id'] = Auth::user()->id;

        //add Add to table
        // $add = array();
        // $add['ad_type'] = 'property_holiday_home_for_sale';
        // $add['status']  = 'published';
        // $add['user_id'] =  Auth::user()->id;
        // $add_response   =  Ad::create($add);
       // $property_home_for_sale_data['ad_id'] = $add_response->id;
        if (isset($property_home_for_sale_data['property_home_for_sale_photos'])) {
           unset($property_home_for_sale_data['property_home_for_sale_photos']);

        }else if (isset($property_home_for_sale_data['property_home_for_sale_pdf_photos'])) {
           unset($property_home_for_sale_data['property_home_for_sale_pdf_photos']);

        }else if (isset($property_home_for_sale_data['property_home_for_sale_sale_quote'])) {
          unset($property_home_for_sale_data['property_home_for_sale_sale_quote']);
        }
        $response = PropertyHolidaysHomesForSale::findOrFail($id);
        $response->update($property_home_for_sale_data);

        //upload files
        if ($request->file('property_home_for_sale_photos') || $request->file('property_home_for_sale_pdf_photos') || $request->file('property_home_for_sale_sale_quote'))
        {
            // $files = $request->file('property_photos');
            // $files_pdf = $request->file('property_pdf');
            // $files_quote = $request->file('property_quote');

            $files = $request->file();
            $files_builded_arr = array();
            foreach($files as $key=>$val)
            {
                array_push($files_builded_arr,$val[0]);
            }

            //Ameer Hamza code to store multiple images
            if(is_countable($request->file('property_home_for_sale_photos'))){
                common::update_media($val, $response->id , 'App\PropertyHolidaysHomesForSale', 'gallery'); // property_home_for_sale_photos
            }
            //End Ameer Hamza code
            $i = 0;
            foreach($files_builded_arr as $key=>$val)
            {
                /* Zille Shah Code commented by Ameer Hamza
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\PropertyHolidaysHomesForSale', 'property_home_for_sale_photos');
                }
                end zille shah code */
                if($i == 1)
                {
                    common::update_media($val, $response->id , 'App\PropertyHolidaysHomesForSale', 'property_home_for_sale_quotes');
                }
                if($i == 2)
                {
                    common::update_media($val, $response->id , 'App\PropertyHolidaysHomesForSale', 'property_home_for_sale_pdf');
                }
                $i++;

            }



        }

        //Notification data
        // $notifiable_id = $response -> id;
        // $notification_obj = new NotificationController();
        // $notification_response = $notification_obj->create($notifiable_id,'App\PropertyHolidaysHomesForSale','property have been added');
        // $notification_id_search = $notification_response->id;

        // //trigger event
        // event(new PropertyForRentEvent($notifiable_id,$notification_id_search));

        $data['success'] = $response;
        echo json_encode($data);

    }
    // Delete Holiday Home for sale
   public function deleteHomeForSaleAd($id){
        
        $holiday_home_for_sale = PropertyHolidaysHomesForSale::findOrFail($id);

        //$ad = Ad::findOrFail($id);

        if(!empty($holiday_home_for_sale->media)){
            if($holiday_home_for_sale->media->first())
        common::delete_media($holiday_home_for_sale->media->first->mediable_id,$holiday_home_for_sale->media->first->mediable_type, $holiday_home_for_sale->media->first->type);
        }
        $holiday_home_for_sale->delete();

        Session::flash('success', 'Property Deleted Successfully');

        return redirect('/my-business/my-ads');
    }


    //AddPropertyHolidayHomeForSale $request
    public function addHomeForSaleAd(AddPropertyHolidayHomeForSale $request)
    {
        $property_home_for_sale_data = $request->all();

        //Add More ViewingTimes
        if(isset($property_home_for_sale_data['delivery_date']) && $property_home_for_sale_data['delivery_date'] != "")
        {
            $property_home_for_sale_data['secondary_deliver_date'] = null;
            $i = 0;
            foreach($property_home_for_sale_data['delivery_date'] as $key=>$val)
            {
                if($i == 0)
                {
                    $property_home_for_sale_data['delivery_date']  = $val;
                }
                else
                {
                    $property_home_for_sale_data['secondary_deliver_date'] .= $val.",";
                }
                $i++;
            }
        }

        $property_home_for_sale_data['secondary_from_clock'] = "";
        if(isset($property_home_for_sale_data['from_clock']))
        {
            $i = 0;
            foreach($property_home_for_sale_data['from_clock'] as $key=>$val)
            {
                if($i == 0)
                {
                    $property_home_for_sale_data['from_clock']  = $val;
                }
                else
                {
                    $property_home_for_sale_data['secondary_from_clock'] .= $val.",";
                }
                $i++;
            }
        }

          $property_home_for_sale_data['secondary_clockwise'] = "";
          if(isset($property_home_for_sale_data['clockwise']))
          {
              $i = 0;
              foreach($property_home_for_sale_data['clockwise'] as $key=>$val)
              {
                  if($i == 0)
                  {
                      $property_home_for_sale_data['clockwise']  = $val;
                  }
                  else
                  {
                      $property_home_for_sale_data['secondary_clockwise'] .= $val.",";
                  }
                  $i++;
              }
          }

          $property_home_for_sale_data['secondary_note'] = "";
          if(isset($property_home_for_sale_data['note']))
          {
              $i = 0;
              foreach($property_home_for_sale_data['note'] as $key=>$val)
              {
                  if($i == 0)
                  {
                      $property_home_for_sale_data['note']  = $val;
                  }
                  else
                  {
                      $property_home_for_sale_data['secondary_note'] .= $val.",";
                  }
                  $i++;
              }
        }
        //Manage Facilities
        if(isset($property_home_for_sale_data['facilities']))
        {
            $facilities = "";
            foreach($property_home_for_sale_data['facilities'] as $key=>$val)
            {
                $facilities .= $val . ",";
            }
            $property_home_for_sale_data['facilities'] = $facilities;
        }

        $property_home_for_sale_data['user_id'] = Auth::user()->id;

        //add Add to table
        $add = array();
        $add['ad_type'] = 'property_holiday_home_for_sale';
        $add['status']  = 'published';
        $add['user_id'] =  Auth::user()->id;
        $add_response   =  Ad::create($add);
        $property_home_for_sale_data['ad_id'] = $add_response->id;
        unset($property_home_for_sale_data['property_home_for_sale_photos']);
        unset($property_home_for_sale_data['property_home_for_sale_pdf_photos']);
        unset($property_home_for_sale_data['property_home_for_sale_sale_quote']);
        $response = PropertyHolidaysHomesForSale::create($property_home_for_sale_data);

        //upload files
        if ($request->file('property_home_for_sale_photos') || $request->file('property_home_for_sale_pdf_photos') || $request->file('property_home_for_sale_sale_quote'))
        {
            // $files = $request->file('property_photos');
            // $files_pdf = $request->file('property_pdf');
            // $files_quote = $request->file('property_quote');

            $files = $request->file();
            $files_builded_arr = array();
            foreach($files as $key=>$val)
            {
                array_push($files_builded_arr,$val[0]);
            }

            //Ameer Hamza code to store multiple images
            if(is_countable($request->file('property_home_for_sale_photos'))){
                common::update_media($val, $response->id , 'App\PropertyHolidaysHomesForSale', 'gallery'); // property_home_for_sale_photos
            }
            //End Ameer Hamza code
            $i = 0;
            foreach($files_builded_arr as $key=>$val)
            {
                /* Zille Shah Code commented by Ameer Hamza
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\PropertyHolidaysHomesForSale', 'property_home_for_sale_photos');
                }
                end zille shah code */
                if($i == 1)
                {
                    common::update_media($val, $response->id , 'App\PropertyHolidaysHomesForSale', 'property_home_for_sale_quotes');
                }
                if($i == 2)
                {
                    common::update_media($val, $response->id , 'App\PropertyHolidaysHomesForSale', 'property_home_for_sale_pdf');
                }
                $i++;

            }



        }

        //Notification data
        $notifiable_id = $response -> id;
        $notification_obj = new NotificationController();
        $notification_response = $notification_obj->create($notifiable_id,'App\PropertyHolidaysHomesForSale','property have been added');
        $notification_id_search = $notification_response->id;

        //trigger event
        event(new PropertyForRentEvent($notifiable_id,$notification_id_search));

        $data['success'] = $response;
        echo json_encode($data);

    }

     public function updateSaleAdd(AddPropertyForSale $request,$id)
    {
        DB::beginTransaction();
        try{
            $property_for_sale_data = $request->except(['_method','upload_dropzone_images_type']);

            if(isset($property_for_sale_data['approved_rental_part']) && $property_for_sale_data['approved_rental_part'] == 'on')
            {
                $property_for_sale_data['approved_rental_part'] = 1;
            }
            else
            {
                $property_for_sale_data['approved_rental_part'] = 0;
            }

            //Add More ViewingTimes
            if(isset($property_for_sale_data['deliver_date']) && $property_for_sale_data['deliver_date'] != "")
            {
                $property_for_sale_data['secondary_deliver_date'] = null;
                $i = 0;
                foreach($property_for_sale_data['deliver_date'] as $key=>$val)
                {
                    if($i == 0)
                    {
                        $property_for_sale_data['deliver_date']  = $val;
                    }
                    else
                    {
                        $property_for_sale_data['secondary_deliver_date'] .= $val.",";
                    }
                    $i++;
                }
            }

            $property_for_sale_data['secondary_from_clock'] = "";
            if(isset($property_for_sale_data['from_clock']))
            {
                $i = 0;
                foreach($property_for_sale_data['from_clock'] as $key=>$val)
                {
                    if($i == 0)
                    {
                        $property_for_sale_data['from_clock']  = $val;
                    }
                    else
                    {
                        $property_for_sale_data['secondary_from_clock'] .= $val.",";
                    }
                    $i++;
                }
            }

            $property_for_sale_data['secondary_clockwise'] = "";
            if(isset($property_for_sale_data['clockwise']))
            {
                $i = 0;
                foreach($property_for_sale_data['clockwise'] as $key=>$val)
                {
                    if($i == 0)
                    {
                        $property_for_sale_data['clockwise']  = $val;
                    }
                    else
                    {
                        $property_for_sale_data['secondary_clockwise'] .= $val.",";
                    }
                    $i++;
                }
            }

            $property_for_sale_data['secondary_note1'] = "";
            if(isset($property_for_sale_data['note1']))
            {
                $i = 0;
                foreach($property_for_sale_data['note1'] as $key=>$val)
                {
                    if($i == 0)
                    {
                        $property_for_sale_data['note1']  = $val;
                    }
                    else
                    {
                        $property_for_sale_data['secondary_note1'] .= $val.",";
                    }
                    $i++;
                }
            }


            unset($property_for_sale_data['property_photos']);
            unset($property_for_sale_data['property_pdf']);
            unset($property_for_sale_data['property_quote']);


            //Manage Facilities
            if(isset($property_for_sale_data['facilities']))
            {
                $property_for_sale_data['facilities'] = json_encode($property_for_sale_data['facilities']);
            }

            $property_for_sale_data['user_id'] = Auth::user()->id;

            //Update media (mediable id and mediable type)
            if($id){
                $temp_property_for_sale_obj = PropertyForSale::find($id);
                if($temp_property_for_sale_obj && $temp_property_for_sale_obj->ad){
                    $property_for_sale_data = $this->updated_dropzone_images_type($property_for_sale_data,$request->upload_dropzone_images_type,$temp_property_for_sale_obj->ad->id);
                }
            }

            $response = PropertyForSale::where('id','=', $id)->update($property_for_sale_data);

            if ($request->file('property_pdf') || $request->file('property_quote'))
            {
                $files = $request->file();
                $files_builded_arr = array();
                foreach($files as $key=>$val)
                {
                    array_push($files_builded_arr,$val[0]);
                }

                $i = 0;
                foreach($files_builded_arr as $key=>$val)
                {
                    if($i == 1)
                    {
                        common::update_media($val, $response->id , 'App\PropertyForSale', 'propert_for_sale_quotes');
                    }
                    if($i == 2)
                    {
                        common::update_media($val, $response->id , 'App\PropertyForSale', 'propert_for_sale_pdf');
                    }
                    $i++;

                }
            }

            //Notification data
            // $notifiable_id = $response -> id;
            // $notification_obj = new NotificationController();
            // $notification_response = $notification_obj->create($notifiable_id,'App\PropertyForSale','property have been added');
            // $notification_id_search = $notification_response->id;

            // // //trigger event
            // event(new PropertyForRentEvent($notifiable_id,$notification_id_search));
            DB::commit();
            $data['success'] = $response;
            echo json_encode($data);

        }catch (\Exception $e){
            DB::rollback();
            (header("HTTP/1.0 404 Not Found"));
            $data['failure'] = $e->getMessage();
            echo json_encode($data);
            exit();
        }
    }

    //Upload dropzone images
    public function upload_dropzone_images(Request $request){
        $mediable_id = '';

        if($request->ad_id){
            $mediable_id = $request->ad_id;
        }
        if ($request->file('files')) {
            $files = $request->file('files');
            if($mediable_id){
                return common::update_media($files, $mediable_id, 'App\Models\Ad', 'gallery','false');
            }else{
                return common::update_media($files, Auth::user()->id, $request->upload_dropzone_images_type, 'gallery','false');
            }
        }
    }

    //Updated the dropzone image
    public function updated_dropzone_images_type($request,$mediable_type,$ad_id=''){
        foreach ($request as $key=>$value){
            if(preg_match('/image_title/',$key)){
                $explode_values = explode('_',$key);
                $name_unique = '';
                if(count($explode_values) > 3) {
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
        $temp_media = Media::where('mediable_id',Auth::user()->id)->where('mediable_type',$mediable_type)->get();
        if($temp_media->count() > 0 && $ad_id){
            foreach ($temp_media as $key=>$temp_media_obj){
                $temp_media_obj->mediable_id = $ad_id;
                $temp_media_obj->mediable_type = 'App\Models\Ad';
                $temp_media_obj->update();
            }

        }
        return $request;
    }
    
    public function addSaleAdd(AddPropertyForSale $request)
    {
        DB::beginTransaction();
        try{
            $property_for_sale_data = $request->except('upload_dropzone_images_type');

            if(isset($property_for_sale_data['approved_rental_part']) && $property_for_sale_data['approved_rental_part'] == 'on')
            {
                $property_for_sale_data['approved_rental_part'] = 1;
            }
            else
            {
                $property_for_sale_data['approved_rental_part'] = 0;
            }

            //Add More ViewingTimes
            if(isset($property_for_sale_data['deliver_date']) && $property_for_sale_data['deliver_date'] != "")
            {
                $property_for_sale_data['secondary_deliver_date'] = null;
                $i = 0;
                foreach($property_for_sale_data['deliver_date'] as $key=>$val)
                {
                    if($i == 0)
                    {
                        $property_for_sale_data['deliver_date']  = $val;
                    }
                    else
                    {
                        $property_for_sale_data['secondary_deliver_date'] .= $val.",";
                    }
                    $i++;
                }
            }

            $property_for_sale_data['secondary_from_clock'] = "";
            if(isset($property_for_sale_data['from_clock']))
            {
                $i = 0;
                foreach($property_for_sale_data['from_clock'] as $key=>$val)
                {
                    if($i == 0)
                    {
                        $property_for_sale_data['from_clock']  = $val;
                    }
                    else
                    {
                        $property_for_sale_data['secondary_from_clock'] .= $val.",";
                    }
                    $i++;
                }
            }

            $property_for_sale_data['secondary_clockwise'] = "";
            if(isset($property_for_sale_data['clockwise']))
            {
                $i = 0;
                foreach($property_for_sale_data['clockwise'] as $key=>$val)
                {
                    if($i == 0)
                    {
                        $property_for_sale_data['clockwise']  = $val;
                    }
                    else
                    {
                        $property_for_sale_data['secondary_clockwise'] .= $val.",";
                    }
                    $i++;
                }
            }

            $property_for_sale_data['secondary_note1'] = "";
            if(isset($property_for_sale_data['note1']))
            {
                $i = 0;
                foreach($property_for_sale_data['note1'] as $key=>$val)
                {
                    if($i == 0)
                    {
                        $property_for_sale_data['note1']  = $val;
                    }
                    else
                    {
                        $property_for_sale_data['secondary_note1'] .= $val.",";
                    }
                    $i++;
                }
            }


            unset($property_for_sale_data['property_photos']);
            unset($property_for_sale_data['property_pdf']);
            unset($property_for_sale_data['property_quote']);


            //Manage Facilities
            if(isset($property_for_sale_data['facilities']))
            {
                $property_for_sale_data['facilities'] = json_encode($property_for_sale_data['facilities']);
            }

            $property_for_sale_data['user_id'] = Auth::user()->id;

            //add Add to table
            $add = array();
            $add['ad_type'] = 'property_for_sale';
            $add['status']  = 'published';
            $add['user_id'] =  Auth::user()->id;
            $add_response   =  Ad::create($add);

            $property_for_sale_data['ad_id'] = $add_response->id;

            //Update media (mediable id and mediable type)
            if($add_response->id){
                $property_for_sale_data = $this->updated_dropzone_images_type($property_for_sale_data,$request->upload_dropzone_images_type,$add_response->id);
            }

            $response = PropertyForSale::create($property_for_sale_data);

            if ($request->file('property_pdf') || $request->file('property_quote'))
            {
                $files = $request->file();
                $files_builded_arr = array();
                foreach($files as $key=>$val)
                {
                    array_push($files_builded_arr,$val[0]);
                }

                $i = 0;
                foreach($files_builded_arr as $key=>$val)
                {
                    if($i == 1)
                    {
                        common::update_media($val, $response->id , 'App\PropertyForSale', 'propert_for_sale_quotes');
                    }
                    if($i == 2)
                    {
                        common::update_media($val, $response->id , 'App\PropertyForSale', 'propert_for_sale_pdf');
                    }
                    $i++;

                }
            }

            //Notification data
            $notifiable_id = $response -> id;
            $notification_obj = new NotificationController();
            $notification_response = $notification_obj->create($notifiable_id,'App\PropertyForSale','property have been added');
            $notification_id_search = $notification_response->id;

            // //trigger event
            event(new PropertyForRentEvent($notifiable_id,$notification_id_search));
            DB::commit();
            $data['success'] = $response;
            echo json_encode($data);
        }catch (\Exception $e){
            DB::rollback();
            (header("HTTP/1.0 404 Not Found"));
            $data['failure'] = $e->getMessage();
            echo json_encode($data);
            exit();
        }




    }

    public function newPropertyForRentAdd(AddPropertyForRent $request)
    {
        $property_for_rent_data = $request->all();
        //Manage Facilities
        if(isset($property_for_rent_data['facilities']))
        {
            $facilities = "";
            foreach($property_for_rent_data['facilities'] as $key=>$val)
            {
                $facilities .= $val . ",";
            }
            $property_for_rent_data['facilities'] = $facilities;
        }

        //Add More ViewingTimes
        if(isset($property_for_rent_data['delivery_date']) && $property_for_rent_data['delivery_date'] != "")
        {
            $property_for_rent_data['secondary_delivery_date'] = null;
            $i = 0;
            foreach($property_for_rent_data['delivery_date'] as $key=>$val)
            {
                if($i == 0)
                {
                    $property_for_rent_data['delivery_date']  = $val;
                }
                else
                {
                    $property_for_rent_data['secondary_delivery_date'] .= $val.",";
                }
                $i++;
            }
        }

        $property_for_rent_data['secondary_from_clock'] = "";
        if(isset($property_for_rent_data['from_clock']))
        {
            $i = 0;
            foreach($property_for_rent_data['from_clock'] as $key=>$val)
            {
                if($i == 0)
                {
                    $property_for_rent_data['from_clock']  = $val;
                }
                else
                {
                    $property_for_rent_data['secondary_from_clock'] .= $val.",";
                }
                $i++;
            }
        }

        $property_for_rent_data['secondary_clockwise_clock'] = "";
        if(isset($property_for_rent_data['clockwise_clock']))
        {
            $i = 0;
            foreach($property_for_rent_data['clockwise_clock'] as $key=>$val)
            {
                if($i == 0)
                {
                    $property_for_rent_data['clockwise_clock']  = $val;
                }
                else
                {
                    $property_for_rent_data['secondary_clockwise_clock'] .= $val.",";
                }
                $i++;
            }
        }

        $property_for_rent_data['secondary_note'] = "";
        if(isset($property_for_rent_data['note']))
        {
            $i = 0;
            foreach($property_for_rent_data['note'] as $key=>$val)
            {
                if($i == 0)
                {
                    $property_for_rent_data['note']  = $val;
                }
                else
                {
                    $property_for_rent_data['secondary_note'] .= $val.",";
                }
                $i++;
            }
        }

        if(isset($property_for_rent_data['published_on']) && $property_for_rent_data['published_on'] == 'on')
        {
            $property_for_rent_data['published_on'] = 1;
        }
        else
        {
            $property_for_rent_data['published_on'] = 0;
        }

        unset($property_for_rent_data['property_photos']);
        $property_for_rent_data['user_id'] = Auth::user()->id;

        //add Add to tables
        $add = array();
        $add['ad_type'] = 'property_for_rent';
        $add['status']  = 'published';
        $add['user_id'] =  Auth::user()->id;
        $add_response   =  Ad::create($add);
        $property_for_rent_data['ad_id'] = $add_response->id;
        $response = PropertyForRent::create($property_for_rent_data);


        //Notification data
        $notifiable_id = $response -> id;
        $notification_obj = new NotificationController();
        $notification_response = $notification_obj->create($notifiable_id,'App\PropertyForRent','property have been added');
        $notification_id_search = $notification_response->id;
        //trigger event
        event(new PropertyForRentEvent($notifiable_id,$notification_id_search));

        $data['success'] = $response;
        echo json_encode($data);
    }


    public function newAddFlatWishesRented()
    {
        return view('user-panel.property.flat_wishes_rented');
    }
       public function editAddFlatWishesRented($id)
    {
        $flat_wishes_rented = FlatWishesRented::findOrFail($id);
        return view('user-panel.property.flat_wishes_rented',compact('flat_wishes_rented'));
    }
    //update flat wishs rented
    public function updateFlatWishesRented(AddFlatWishesRented $request,$id)
    {
     

        $flat_wishes_rented_data = $request->all();
        $regions = "";
        foreach($flat_wishes_rented_data['region'] as $key=>$val)
        {
            $regions .= $val.",";
        }
        $flat_wishes_rented_data['region'] = $regions;

        $property_types = "";
        foreach($flat_wishes_rented_data['property_type'] as $key=>$val)
        {
            $property_types .= $val.",";
        }
        $flat_wishes_rented_data['property_type'] = $property_types;


        unset($flat_wishes_rented_data['flat_wishes_rented']);
        $flat_wishes_rented_data['user_id'] = Auth::user()->id;

         //add Add to table
        // $add = array();
        // $add['ad_type'] = 'property_flat_wishes_rented';
        // $add['status']  = 'published';
        // $add['user_id'] =  Auth::user()->id;
        // $add_response   =  Ad::create($add);

        // $flat_wishes_rented_data['ad_id'] = $add_response->id;
        $response = FlatWishesRented::findOrFail($id);
          $response->update($flat_wishes_rented_data);

        //Ameer Hamza code for storing multiple images
        if (is_countable($request->file('flat_wishes_rented')))
        {
            common::update_media($request->file('flat_wishes_rented'), $response->id , 'App\FlatWishesRented', 'gallery'); //flat_wishes_rented
        }
        //End Ameer Hamza code

        //Notification data
        // $notifiable_id = $response -> id;
        // $notification_obj = new NotificationController();
        // $notification_response = $notification_obj->create($notifiable_id,'App\FlatWishesRented','property have been added');
        // $notification_id_search = $notification_response->id;

        // //trigger event
        // event(new PropertyForRentEvent($notifiable_id,$notification_id_search));


        $data['success'] = $response;
        echo json_encode($data);


    }
      public function deleteFlatWishesRented($id){
        
        $flat_wishes_rented = FlatWishesRented::findOrFail($id);

        //$ad = Ad::findOrFail($id);
    // dd($property_for_rent->media->first->mediable_id);

        if(!empty($flat_wishes_rented->media)){
            if($flat_wishes_rented->media->first())
        common::delete_media($flat_wishes_rented->media->first->mediable_id,$flat_wishes_rented->media->first->mediable_type, $flat_wishes_rented->media->first->type);
        }
        $flat_wishes_rented->delete();
      // $ad->delete();
     Session::flash('success', 'Property Deleted Successfully');

        return redirect('/my-business/my-ads');
    }

    public function addFlatWishesRented(AddFlatWishesRented $request)
    {

        $flat_wishes_rented_data = $request->all();
        $regions = "";
        foreach($flat_wishes_rented_data['region'] as $key=>$val)
        {
            $regions .= $val.",";
        }
        $flat_wishes_rented_data['region'] = $regions;

        $property_types = "";
        foreach($flat_wishes_rented_data['property_type'] as $key=>$val)
        {
            $property_types .= $val.",";
        }
        $flat_wishes_rented_data['property_type'] = $property_types;


        unset($flat_wishes_rented_data['flat_wishes_rented']);
        $flat_wishes_rented_data['user_id'] = Auth::user()->id;

         //add Add to table
        $add = array();
        $add['ad_type'] = 'property_flat_wishes_rented';
        $add['status']  = 'published';
        $add['user_id'] =  Auth::user()->id;
        $add_response   =  Ad::create($add);

        $flat_wishes_rented_data['ad_id'] = $add_response->id;
        $response = FlatWishesRented::create($flat_wishes_rented_data);

        //Ameer Hamza code for storing multiple images
        if (is_countable($request->file('flat_wishes_rented')))
        {
            common::update_media($request->file('flat_wishes_rented'), $response->id , 'App\FlatWishesRented', 'gallery'); //flat_wishes_rented
        }
        //End Ameer Hamza code

        //Notification data
        $notifiable_id = $response -> id;
        $notification_obj = new NotificationController();
        $notification_response = $notification_obj->create($notifiable_id,'App\FlatWishesRented','property have been added');
        $notification_id_search = $notification_response->id;

        //trigger event
        event(new PropertyForRentEvent($notifiable_id,$notification_id_search));


        $data['success'] = $response;
        echo json_encode($data);


    }

    public function addNewRealEstateBusinessPlot()
    {
        return view('user-panel.property.realestate_business_plot');
    }

    public function addRealEstateBusinessPlot(AddRealEstateBusinessPlot $request)
    {

        $realestate_business_plot_data = $request->all();
        unset($realestate_business_plot_data['realestate_business_plot_photos']);
        $realestate_business_plot_data['user_id'] = Auth::user()->id;

        $response = RealestateBusinessPlot::create($realestate_business_plot_data);


        if ($request->file('realestate_business_plot_photos'))
        {
            $files = $request->file('realestate_business_plot_photos');
            foreach ($files as $file)
            {
                common::update_media($file, $response->id , 'App\RealestateBusinessPlot', 'RealestateBusinessPlot');
            }
        }

          //Notification data
          $notifiable_id = $response -> id;
          $notification_obj = new NotificationController();
          $notification_response = $notification_obj->create($notifiable_id,'App\RealestateBusinessPlot','property have been added');
          $notification_id_search = $notification_response->id;
          //trigger event
          event(new PropertyForRentEvent($notifiable_id,$notification_id_search));

        $data['success'] = $response;
        echo json_encode($data);

    }
    public function commercialPropertyForSale()
    {
        return view('user-panel.property.commercial_property_for_sale');
    }
       public function editcommercialPropertyForSale($id)
    {
        $commercial_property = CommercialPropertyForSale::findOrFail($id);
        return view('user-panel.property.commercial_property_for_sale', compact('commercial_property'));
    }

    public function updateCommercialPropertyForSale(AddCommercialPropertyForSale $request, $id)
    {

        $commercial_property_for_sale = $request->except('_method');
        
        unset($commercial_property_for_sale['commercial_property_for_sale_photos']);
        unset($commercial_property_for_sale['commercial_property_for_sale_pdf']);
        $commercial_property_for_sale['user_id'] = Auth::user()->id;

        //add Add to table
        // $add = array();
        // $add['ad_type'] = 'property_commercial_for_sale';
        // $add['status']  = 'published';
        // $add['user_id'] =  Auth::user()->id;
        // $add_response   =  Ad::create($add);
        // $commercial_property_for_sale['ad_id'] = $add_response->id;

        if(isset($commercial_property_for_sale['property_type']) && $commercial_property_for_sale['property_type'] != "")
        {
            $property_type = "";
            foreach($commercial_property_for_sale['property_type'] as $key=>$val)
            {
                $property_type .= $val.",";
            }
            $commercial_property_for_sale['property_type'] = $property_type;
        }
        if(isset($commercial_property_for_sale['facilities']) && $commercial_property_for_sale['facilities'] != "")
        {
            $facilities = "";
            foreach($commercial_property_for_sale['facilities'] as $key=>$val)
            {
                $facilities .= $val.",";
            }
            $commercial_property_for_sale['facilities'] = $facilities;

        }

        $response = CommercialPropertyForSale::where('id','=',$id);
        $response->update($commercial_property_for_sale);


        if (is_countable($request->file('commercial_property_for_sale_photos')) || $request->file('commercial_property_for_sale_pdf'))
        {
            //Ameer Hamza Code start for storing multiple images
            if(is_countable($request->file('commercial_property_for_sale_photos'))){
                common::update_media($request->file('commercial_property_for_sale_photos'), $response->id , 'App\CommercialPropertyForSale', 'gallery');
            }
            //End ameer hamza code
            $files = $request->file();
            $files_builded_arr = array();
            foreach($files as $key=>$val)
            {
                array_push($files_builded_arr,$val[0]);
            }

            $i = 0;
            foreach($files_builded_arr as $key=>$val)
            {
                /* Zille Shad Code commented by Ameer Hamza
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\CommercialPropertyForSale', 'commercial_propert_for_sale_photos');
                }
                */
                if($i == 1)
                {
                    common::update_media($val, $response->id , 'App\CommercialPropertyForSale', 'commercial_property_for_sale_pdf');
                }
                $i++;

            }



        }

        // //Notification data
        // $notifiable_id = $response -> id;
        // $notification_obj = new NotificationController();
        // $notification_response = $notification_obj->create($notifiable_id,'App\CommercialPropertyForSale','property have been added');
        // $notification_id_search = $notification_response->id;
        // //trigger event
        // event(new PropertyForRentEvent($notifiable_id,$notification_id_search));

        $data['success'] = $response;
        echo json_encode($data);

    }

    public function addCommercialPropertyForSale(AddCommercialPropertyForSale $request)
    {

        $commercial_property_for_sale = $request->all();

        unset($commercial_property_for_sale['commercial_property_for_sale_photos']);
        unset($commercial_property_for_sale['commercial_property_for_sale_pdf']);
        $commercial_property_for_sale['user_id'] = Auth::user()->id;

        //add Add to table
        $add = array();
        $add['ad_type'] = 'property_commercial_for_sale';
        $add['status']  = 'published';
        $add['user_id'] =  Auth::user()->id;
        $add_response   =  Ad::create($add);
        $commercial_property_for_sale['ad_id'] = $add_response->id;

        if(isset($commercial_property_for_sale['property_type']) && $commercial_property_for_sale['property_type'] != "")
        {
            $property_type = "";
            foreach($commercial_property_for_sale['property_type'] as $key=>$val)
            {
                $property_type .= $val.",";
            }
            $commercial_property_for_sale['property_type'] = $property_type;
        }
        if(isset($commercial_property_for_sale['facilities']) && $commercial_property_for_sale['facilities'] != "")
        {
            $facilities = "";
            foreach($commercial_property_for_sale['facilities'] as $key=>$val)
            {
                $facilities .= $val.",";
            }
            $commercial_property_for_sale['facilities'] = $facilities;

        }

        $response = CommercialPropertyForSale::create($commercial_property_for_sale);


        if (is_countable($request->file('commercial_property_for_sale_photos')) || $request->file('commercial_property_for_sale_pdf'))
        {
            //Ameer Hamza Code start for storing multiple images
            if(is_countable($request->file('commercial_property_for_sale_photos'))){
                common::update_media($request->file('commercial_property_for_sale_photos'), $response->id , 'App\CommercialPropertyForSale', 'gallery');
            }
            //End ameer hamza code
            $files = $request->file();
            $files_builded_arr = array();
            foreach($files as $key=>$val)
            {
                array_push($files_builded_arr,$val[0]);
            }

            $i = 0;
            foreach($files_builded_arr as $key=>$val)
            {
                /* Zille Shad Code commented by Ameer Hamza
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\CommercialPropertyForSale', 'commercial_propert_for_sale_photos');
                }
                */
                if($i == 1)
                {
                    common::update_media($val, $response->id , 'App\CommercialPropertyForSale', 'commercial_property_for_sale_pdf');
                }
                $i++;

            }



        }

        //Notification data
        $notifiable_id = $response -> id;
        $notification_obj = new NotificationController();
        $notification_response = $notification_obj->create($notifiable_id,'App\CommercialPropertyForSale','property have been added');
        $notification_id_search = $notification_response->id;
        //trigger event
        event(new PropertyForRentEvent($notifiable_id,$notification_id_search));

        $data['success'] = $response;
        echo json_encode($data);

    }

    public function adsForRent(Request $request)
    {

        $data = $request->all();
        $searchable = (isset($data['filter']) ? $data['filter'] : "");
        $order_by_thing = 'id';
        $order_by       = 'DESC';

        if($searchable == 'priced-low-high')
        {
            $order_by_thing = "monthly_rent";
            $order_by       =  "ASC";
        }
        else if($searchable == 'priced-high-low')
        {
            $order_by_thing = "monthly_rent";
            $order_by       =  "DESC";
        }
        else if($searchable == 'p-rom-area-low-high')
        {
            $order_by_thing = "primary_rom";
            $order_by       =  "ASC";
        }
        else if($searchable == 'p-rom-area-high-low')
        {
            $order_by_thing = "primary_rom";
            $order_by       =  "DESC";
        }
        else if($searchable == 'total-price-low-high')
        {
            $order_by_thing = "monthly_rent";
            $order_by       =  "ASC";
        }
        else if($searchable == 'total-price-high-low')
        {
            $order_by_thing = "monthly_rent";
            $order_by       =  "DESC";
        }


        $add_array = DB::table('property_for_rent')->orderBy($order_by_thing, $order_by)->paginate(getenv('PAGINATION'));

        if ($request->ajax())
        {
            return view('common.partials.property.ads_for_rent_sortion_pagination')->with(compact('add_array'))->render();
        }
        // $add_array = DB::table('property_for_rent')->orderBy('id', 'DESC')->get(['id'])->toArray();
        return view('user-panel.property.ads_for_rent')->with(compact('add_array'));
    }

    public function propertyDescription($id)
    {
        $property_data = PropertyForRent::where('id',$id)->first();
        return view('common.partials.property.property_description')->with(compact('property_data'));
    }

    public function propertyForSaleDescription($id)
    {
        $property_data = PropertyForSale::where('id',$id)->first();
        return view('common.partials.property.property_for_sale_description')->with(compact('property_data'));
    }

    public function adsForFlatWishedRented(Request $request){

        $data = $request->all();
        $searchable = (isset($data['filter']) ? $data['filter'] : "");

        $order_by_thing = 'id';
        $order_by       = 'DESC';

        if($searchable == 'max_rent_low_high')
        {
            $order_by_thing = "max_rent_per_month";
            $order_by       =  "ASC";
        }
        else if($searchable == 'max_rent_high_low')
        {
            $order_by_thing = "max_rent_per_month";
            $order_by       =  "DESC";
        }
        else if($searchable == 'time_from')
        {
            $order_by_thing = "wanted_from";
            $order_by       =  "DESC";
        }

        $add_array = DB::table('flat_wishes_renteds')->orderBy($order_by_thing,$order_by)->paginate(getenv('PAGINATION'));
        if ($request->ajax())
        {
            return view('common.partials.property.ads_for_flat_wishes_rented_sortion_pagination')->with(compact('add_array'))->render();
        }

        return view('user-panel.property.ads_for_flat_wishes_rented')->with(compact('add_array'));

    }

    public function flatWishesRentedSortedAd(Request $request)
    {

        $sorted_by =  $request->all();
        $searchable = $sorted_by['sending'];
        $filtering  = $sorted_by['stylings'];

        $order_by_thing = "max_rent_per_month";
        $order_by       =  "ASC";

        if($searchable == 'max_rent_low_high')
        {
            $order_by_thing = "max_rent_per_month";
            $order_by       =  "ASC";
        }
        else if($searchable == 'max_rent_high_low')
        {
            $order_by_thing = "max_rent_per_month";
            $order_by       =  "DESC";
        }
        else if($searchable == 'time_from')
        {
            $order_by_thing = "wanted_from";
            $order_by       =  "DESC";
        }

        $add_array = DB::table('flat_wishes_renteds')->orderBy($order_by_thing,$order_by)->paginate(getenv('PAGINATION'));
        $response  =  view('common.partials.property.render_flat_wishes_rented_ads')->with(compact('add_array','filtering'))->render();


        $data['success'] = $response;
        echo json_encode($data);

    }

    public function flatWishesRentedDescription($id)
    {
        $property_data = FlatWishesRented::where('id',$id)->first();
        return view('common.partials.property.flat_wishes_rented_description')->with(compact('property_data'));
    }

    public function holidayHomeForSaleAds(Request $request)
    {

        $data = $request->all();
        $searchable = (isset($data['filter']) ? $data['filter'] : "");
        $order_by_thing = 'id';
        $order_by       = 'DESC';

        if($searchable  == 'priced-low-high')
        {
            $order_by_thing = "asking_price";
            $order_by       =  "asc";

        }
        else if($searchable  == "priced-high-low")
        {
            $order_by_thing = "asking_price";
            $order_by = "desc";
        }
        else if($searchable  == "housing_area_low_high")
        {
            $order_by_thing = "housing_area";
            $order_by = "asc";
        }
        else if($searchable  == "housing_area_high_low")
        {
            $order_by_thing = "housing_area";
            $order_by = "desc";
        }


        $add_array = DB::table('property_holidays_homes_for_sales')->orderBy( $order_by_thing, $order_by)->paginate(getenv('PAGINATION'));

        if ($request->ajax())
        {
            return view('common.partials.property.ads_for_holiday_home_for_sale_sortion_pagination')->with(compact('add_array'))->render();
        }

        //$add_array = DB::table('property_holidays_homes_for_sales')->orderBy('id', 'DESC')->get('id')->toArray();
        return view('user-panel.property.ads_for_holiday_home_for_sale')->with(compact('add_array'));
    }

    public function holidayHomeForSaleDescription($id)
    {
        $property_data = PropertyHolidaysHomesForSale::where('id',$id)->first();
        return view('common.partials.property.holiday_home_for_sale_description')->with(compact('property_data'));
    }

    public function commercialPropertyForSaleAds(Request $request)
    {
        $data = $request->all();
        $searchable = (isset($data['filter']) ? $data['filter'] : "");

        $order_by_thing = 'id';
        $order_by       = 'DESC';

        if($searchable  == 'priced-low-high')
        {
            $order_by_thing = "rental_income";
            $order_by       =  "asc";

        }
        else if($searchable  == "priced-high-low")
        {
            $order_by_thing = "rental_income";
            $order_by = "desc";
        }


        $add_array = DB::table('commercial_property_for_sales')->orderBy('id', 'DESC')->paginate(getenv('PAGINATION'));
        if ($request->ajax())
        {
            return view('common.partials.property.ads_for_commercial_property_for_sale_sortion_pagination')->with(compact('add_array'))->render();
        }
        return view('user-panel.property.ads_for_commercial_property_for_sale')->with(compact('add_array'));

    }

    public function commercialPropertyForSaleSortedAds(Request $request)
    {
        $data = $request->all();
        $searchable = $data['sending'];
        $filtering = $data['stylings'];

        $order_by_thing = "priced-low-high";
        $order_by = "asc";

        if($data['sending'] == 'priced-low-high')
        {
            $order_by_thing = "rental_income";
            $order_by       =  "asc";

        }
        else if($data['sending'] == "priced-high-low")
        {
            $order_by_thing = "rental_income";
            $order_by = "desc";
        }


        //$add_array = DB::table('commercial_property_for_sales')->orderBy($order_by_thing,$order_by)->get(['id'])->toArray();
        $add_array = DB::table('commercial_property_for_sales')->orderBy($order_by_thing,$order_by)->paginate(getenv('PAGINATION'));
        $response =  view('common.partials.property.commercial_property_for_sale_render_ads')->with(compact('add_array','filtering'))->render();

        $data['success'] = $response;
        echo json_encode($data);
    }
    public function commercialForSaleDescription($id)
    {
        $property_data = CommercialPropertyForSale::where('id',$id)->first();
        return view('common.partials.property.commercialproperty_for_sale_description')->with(compact('property_data'));
    }
    public function commercialPropertyForRent()
    {
        return view('user-panel.property.commercial_property_for_rent');
    }
     public function editCommercialPropertyForRent($id)
    {
        $commercial_for_rent = CommercialPropertyForRent::findOrFail($id);

        return view('user-panel.property.commercial_property_for_rent', compact('commercial_for_rent'));
    }
     public function updateCommercialPropertyForRent(AddCommercialPropertyForRent $request,$id)
    {
        $commercial_property_for_rent = $request->except('_method');

        unset($commercial_property_for_rent['commercial_property_for_rent_photos']);
        unset($commercial_property_for_rent['commercial_property_for_rent_pdf']);
        $commercial_property_for_rent['user_id'] = Auth::user()->id;

        //add Add to table
        // $add = array();
        // $add['ad_type'] = 'property_commercial_for_rent';
        // $add['status']  = 'published';
        // $add['user_id'] =  Auth::user()->id;
        // $add_response   =  Ad::create($add);
        // $commercial_property_for_rent['ad_id'] = $add_response->id;

        if(isset($commercial_property_for_rent['property_type']) && $commercial_property_for_rent['property_type'] != "")
        {
            $property_type = "";
            foreach($commercial_property_for_rent['property_type'] as $key=>$val)
            {
                $property_type .= $val.",";
            }
            $commercial_property_for_rent['property_type'] = $property_type;
        }
        if(isset($commercial_property_for_rent['facilities']) && $commercial_property_for_rent['facilities'] != "")
        {
            $facilities = "";
            foreach($commercial_property_for_rent['facilities'] as $key=>$val)
            {
                $facilities .= $val.",";
            }
            $commercial_property_for_rent['facilities'] = $facilities;

        }


        $response = CommercialPropertyForRent::findOrFail($id);
        $response->update($commercial_property_for_rent);


        if (is_countable($request->file('commercial_property_for_rent_photos')) || $request->file('commercial_property_for_rent_pdf'))
        {
            //Ameer Hamza Code for storing muliple images
            if(is_countable($request->file('commercial_property_for_rent_photos'))){
                common::update_media($request->file('commercial_property_for_rent_photos'), $response->id , 'App\CommercialPropertyForRent', 'gallery');
            }
            //End Ameer Hamza Code
            $files = $request->file();
            $files_builded_arr = array();
            foreach($files as $key=>$val)
            {
                array_push($files_builded_arr,$val[0]);
            }

            $i = 0;
            foreach($files_builded_arr as $key=>$val)
            {
                /* Zille Shah code commented by Ameer Hamza
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\CommercialPropertyForRent', 'commercial_property_for_rent_photos');
                }
                */
                if($i == 1)
                {
                    common::update_media($val, $response->id , 'App\CommercialPropertyForRent', 'commercial_property_for_rent_pdf');
                }
                $i++;

            }



        }

        //Notification data
        // $notifiable_id = $response -> id;
        // $notification_obj = new NotificationController();
        // $notification_response = $notification_obj->create($notifiable_id,'App\CommercialPropertyForRent','property have been added');
        // $notification_id_search = $notification_response->id;

        // //trigger event
        // event(new PropertyForRentEvent($notifiable_id,$notification_id_search));

        $data['success'] = $response;
        echo json_encode($data);
    }


    public function addCommercialPropertyForRent(AddCommercialPropertyForRent $request)
    {
        $commercial_property_for_rent = $request->all();

        unset($commercial_property_for_rent['commercial_property_for_rent_photos']);
        unset($commercial_property_for_rent['commercial_property_for_rent_pdf']);
        $commercial_property_for_rent['user_id'] = Auth::user()->id;

        //add Add to table
        $add = array();
        $add['ad_type'] = 'property_commercial_for_rent';
        $add['status']  = 'published';
        $add['user_id'] =  Auth::user()->id;
        $add_response   =  Ad::create($add);
        $commercial_property_for_rent['ad_id'] = $add_response->id;

        if(isset($commercial_property_for_rent['property_type']) && $commercial_property_for_rent['property_type'] != "")
        {
            $property_type = "";
            foreach($commercial_property_for_rent['property_type'] as $key=>$val)
            {
                $property_type .= $val.",";
            }
            $commercial_property_for_rent['property_type'] = $property_type;
        }
        if(isset($commercial_property_for_rent['facilities']) && $commercial_property_for_rent['facilities'] != "")
        {
            $facilities = "";
            foreach($commercial_property_for_rent['facilities'] as $key=>$val)
            {
                $facilities .= $val.",";
            }
            $commercial_property_for_rent['facilities'] = $facilities;

        }


        $response = CommercialPropertyForRent::create($commercial_property_for_rent);


        if (is_countable($request->file('commercial_property_for_rent_photos')) || $request->file('commercial_property_for_rent_pdf'))
        {
            //Ameer Hamza Code for storing muliple images
            if(is_countable($request->file('commercial_property_for_rent_photos'))){
                common::update_media($request->file('commercial_property_for_rent_photos'), $response->id , 'App\CommercialPropertyForRent', 'gallery');
            }
            //End Ameer Hamza Code
            $files = $request->file();
            $files_builded_arr = array();
            foreach($files as $key=>$val)
            {
                array_push($files_builded_arr,$val[0]);
            }

            $i = 0;
            foreach($files_builded_arr as $key=>$val)
            {
                /* Zille Shah code commented by Ameer Hamza
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\CommercialPropertyForRent', 'commercial_property_for_rent_photos');
                }
                */
                if($i == 1)
                {
                    common::update_media($val, $response->id , 'App\CommercialPropertyForRent', 'commercial_property_for_rent_pdf');
                }
                $i++;

            }



        }

        //Notification data
        $notifiable_id = $response -> id;
        $notification_obj = new NotificationController();
        $notification_response = $notification_obj->create($notifiable_id,'App\CommercialPropertyForRent','property have been added');
        $notification_id_search = $notification_response->id;

        //trigger event
        event(new PropertyForRentEvent($notifiable_id,$notification_id_search));

        $data['success'] = $response;
        echo json_encode($data);
    }

    public function commercialPropertyForRentAds(Request $request)
    {
        $data = $request->all();
        $searchable = (isset($data['filter']) ? $data['filter'] : "");
        $order_by_thing = 'id';
        $order_by       = 'DESC';

        if($searchable == 'sqm-low-high')
        {
            $order_by_thing = "use_area";
            $order_by       =  "asc";

        }
        else if($searchable == "sqm-high-low")
        {
            $order_by_thing = "use_area";
            $order_by = "desc";
        }

        $add_array = DB::table('commercial_property_for_rents')->orderBy($order_by_thing , $order_by)->paginate(getenv('PAGINATION'));


        if ($request->ajax())
        {
            return view('common.partials.property.ads_for_commercial_property_for_rent_sortion_pagination')->with(compact('add_array'))->render();
        }


        return view('user-panel.property.ads_for_commercial_property_for_rent')->with(compact('add_array'));
    }

    public function commercialPropertyForRentSortedAds(Request $request)
    {
        $data = $request->all();
        $searchable = $data['sending'];
        $filtering  = $data['stylings'];

        $order_by_thing = "use_area";
        $order_by = "asc";

        if($data['sending'] == 'sqm-low-high')
        {
            $order_by_thing = "use_area";
            $order_by       =  "asc";

        }
        else if($data['sending'] == "sqm-high-low")
        {
            $order_by_thing = "use_area";
            $order_by = "desc";
        }



        //$add_array = DB::table('commercial_property_for_rents')->orderBy($order_by_thing,$order_by)->get(['id'])->toArray();
        $add_array = DB::table('commercial_property_for_rents')->orderBy($order_by_thing,$order_by)->paginate(getenv('PAGINATION'));
        $response =  view('common.partials.property.commercial_property_for_rent_render_ads')->with(compact('add_array','filtering'))->render();

        $data['success'] = $response;
        echo json_encode($data);
    }

    public function commercialForRentDescription($id)
    {
        $property_data = CommercialPropertyForRent::where('id',$id)->first();
        return view('common.partials.property.commercialproperty_for_rent_description')->with(compact('property_data'));
    }

    public function BusinessForSale()
    {
        return view('user-panel.property.business_for_sale');
    }
    public function addBusinessForSale(AddBusinessForSale $request)
    {

        $business_for_sale = $request->all();

        unset($business_for_sale['business_for_sale_photos']);
        unset($business_for_sale['business_for_sale_pdf']);
        $business_for_sale['user_id'] = Auth::user()->id;

        //add Add to table
        $add = array();
        $add['ad_type'] = 'property_business_for_sale';
        $add['status']  = 'published';
        $add['user_id'] =  Auth::user()->id;
        $add_response   =  Ad::create($add);
        $business_for_sale['ad_id'] = $add_response->id;

        $response = BusinessForSale::create($business_for_sale);

        if (is_countable($request->file('business_for_sale_photos')) || $request->file('business_for_sale_pdf'))
        {
            //Ameer Hamza code for storing multiple images
            if(is_countable($request->file('business_for_sale_photos'))){
                common::update_media($request->file('business_for_sale_photos'), $response->id , 'App\BusinessForSale', 'gallery');
            }
            //End
            $files = $request->file();
            $files_builded_arr = array();
            foreach($files as $key=>$val)
            {
                array_push($files_builded_arr,$val[0]);
            }

            $i = 0;
            foreach($files_builded_arr as $key=>$val)
            {
                /* Zille Shah Code commented by Ameer Hamza
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\BusinessForSale', 'business_for_sale_photos');
                }
                */
                if($i == 1)
                {
                    common::update_media($val, $response->id , 'App\BusinessForSale', 'business_for_sale_pdf');
                }
                $i++;

            }

        }

        //Notification data
        $notifiable_id = $response -> id;
        $notification_obj = new NotificationController();
        $notification_response = $notification_obj->create($notifiable_id,'App\BusinessForSale','property have been added');
        $notification_id_search = $notification_response->id;
        //trigger event
        event(new PropertyForRentEvent($notifiable_id,$notification_id_search));

        $data['success'] = $response;
        echo json_encode($data);

    }

    public function businessForSaleAds(Request $request)
    {

        $data = $request->all();
        $searchable = (isset($data['filter']) ? $data['filter'] : "");
        $order_by_thing = 'id';
        $order_by       = 'DESC';

        if($searchable == 'priced-low-high')
        {
            $order_by_thing = "price";
            $order_by       =  "asc";

        }
        else if($searchable == "priced-high-low")
        {
            $order_by_thing = "price";
            $order_by = "desc";
        }

        $add_array = DB::table('business_for_sales')->orderBy('id', 'DESC')->paginate(getenv('PAGINATION'));
        if($request->ajax())
        {
            return view('common.partials.property.business_for_sale_sortion_pagination')->with(compact('add_array'));
        }
        return view('user-panel.property.ads_business_for_sale')->with(compact('add_array'));
    }

    public function businessForSaleSortedAds(Request $request)
    {
        $data = $request->all();
        $searchable = $data['sending'];
        $filtering  = $data['stylings'];

        $order_by_thing = "price";
        $order_by = "asc";

        if($data['sending'] == 'priced-low-high')
        {
            $order_by_thing = "price";
            $order_by       =  "asc";

        }
        else if($data['sending'] == "priced-high-low")
        {
            $order_by_thing = "price";
            $order_by = "desc";
        }


        $add_array = DB::table('business_for_sales')->orderBy($order_by_thing,$order_by)->paginate(getenv('PAGINATION'));
        $response =  view('common.partials.property.business_for_sale_render_ads')->with(compact('add_array','filtering'))->render();

        $data['success'] = $response;
        echo json_encode($data);

    }

    public function businessForSaleDescription($id)
    {
        $property_data = BusinessForSale::where('id',$id)->first();
        return view('common.partials.property.business_for_sale_description')->with(compact('property_data'));
    }

    public function commercialPlots()
    {
        return view('user-panel.property.commercial_plots');
    }
    public function editCommercialPlots($id)
    {
        $commercial_plots = CommercialPlot::findOrFail($id);
        
        return view('user-panel.property.commercial_plots', compact('commercial_plots'));
    }
        public function updateCommercialPlots(AddCommercialPlot $request, $id)
    {

        $commercial_plot = $request->all();

        unset($commercial_plot['commercial_plot_photos']);
        unset($commercial_plot['commercial_plot_pdf']);
        $commercial_plot['user_id'] = Auth::user()->id;

        //add Add to table
        // $add = array();
        // $add['ad_type'] = 'property_commercial_plots';
        // $add['status']  = 'published';
        // $add['user_id'] =  Auth::user()->id;
        // $add_response   =  Ad::create($add);
        // $commercial_plot['ad_id'] = $add_response->id;

        $response = CommercialPlot::findOrFail($id);
        $response->update($commercial_plot);

        if (is_countable($request->file('commercial_plot_photos')) || $request->file('commercial_plot_pdf'))
        {
            //Ameer Hamza code to store mulitple images
            if(is_countable($request->file('commercial_plot_photos'))){
                common::update_media($request->file('commercial_plot_photos'), $response->id , 'App\CommercialPlot', 'gallery');
            }
            //End Code
            $files = $request->file();
            $files_builded_arr = array();
            foreach($files as $key=>$val)
            {
                array_push($files_builded_arr,$val[0]);
            }

            $i = 0;
            foreach($files_builded_arr as $key=>$val)
            {
                /* Zille Shah Code commented by Ameer Hamza
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\CommercialPlot', 'commercial_plot_photos');
                }
                */
                if($i == 1)
                {
                    common::update_media($val, $response->id , 'App\CommercialPlot', 'commercial_plot_pdf');
                }
                $i++;

            }

        }

        // //Notification data
        // $notifiable_id = $response->id;
        // $notification_obj = new NotificationController();
        // $notification_response = $notification_obj->create($notifiable_id,'App\CommercialPlot','property have been added');
        // $notification_id_search = $notification_response->id;

        // //trigger event
        // event(new PropertyForRentEvent($notifiable_id, $notification_id_search));

        $data['success'] = $response;
        echo json_encode($data);
    }


    public function addcommercialPlotsAd(AddCommercialPlot $request)
    {

        $commercial_plot = $request->all();

        unset($commercial_plot['commercial_plot_photos']);
        unset($commercial_plot['commercial_plot_pdf']);
        $commercial_plot['user_id'] = Auth::user()->id;

        //add Add to table
        $add = array();
        $add['ad_type'] = 'property_commercial_plots';
        $add['status']  = 'published';
        $add['user_id'] =  Auth::user()->id;
        $add_response   =  Ad::create($add);
        $commercial_plot['ad_id'] = $add_response->id;

        $response = CommercialPlot::create($commercial_plot);

        if (is_countable($request->file('commercial_plot_photos')) || $request->file('commercial_plot_pdf'))
        {
            //Ameer Hamza code to store mulitple images
            if(is_countable($request->file('commercial_plot_photos'))){
                common::update_media($request->file('commercial_plot_photos'), $response->id , 'App\CommercialPlot', 'gallery');
            }
            //End Code
            $files = $request->file();
            $files_builded_arr = array();
            foreach($files as $key=>$val)
            {
                array_push($files_builded_arr,$val[0]);
            }

            $i = 0;
            foreach($files_builded_arr as $key=>$val)
            {
                /* Zille Shah Code commented by Ameer Hamza
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\CommercialPlot', 'commercial_plot_photos');
                }
                */
                if($i == 1)
                {
                    common::update_media($val, $response->id , 'App\CommercialPlot', 'commercial_plot_pdf');
                }
                $i++;

            }

        }

        //Notification data
        $notifiable_id = $response->id;
        $notification_obj = new NotificationController();
        $notification_response = $notification_obj->create($notifiable_id,'App\CommercialPlot','property have been added');
        $notification_id_search = $notification_response->id;

        //trigger event
        event(new PropertyForRentEvent($notifiable_id, $notification_id_search));

        $data['success'] = $response;
        echo json_encode($data);
    }

    public function commercialPlotsAds(Request $request)
    {

        $data = $request->all();
        $searchable = (isset($data['filter']) ? $data['filter'] : "");
        $order_by_thing = 'id';
        $order_by       = 'DESC';


        if($searchable == 'priced-low-high')
        {
            $order_by_thing = "asking_price";
            $order_by       =  "asc";

        }
        else if($searchable == "priced-high-low")
        {
            $order_by_thing = "asking_price";
            $order_by = "desc";
        }
        else if($searchable == "area_low_high")
        {
            $order_by_thing = "plot_size";
            $order_by = "asc";
        }
        else if($searchable == "area_high_low")
        {
            $order_by_thing = "plot_size";
            $order_by = "desc";
        }

        $add_array = DB::table('commercial_plots')->orderBy($order_by_thing ,$order_by)->paginate(getenv('PAGINATION'));

        if($request->ajax())
        {
            return view('common.partials.property.commercial_plot_sortion_pagination')->with(compact('add_array'));
        }

        return view('user-panel.property.ads_for_commercial_plots')->with(compact('add_array'));
    }

    public function commercialPlotSortedAds(Request $request)
    {

        $data = $request->all();
        $searchable = $data['sending'];
        $filtering  = $data['stylings'];

        $order_by_thing = "asking_price";
        $order_by = "asc";

        if($data['sending'] == 'priced-low-high')
        {
            $order_by_thing = "asking_price";
            $order_by       =  "asc";

        }
        else if($data['sending'] == "priced-high-low")
        {
            $order_by_thing = "asking_price";
            $order_by = "desc";
        }
        else if($data['sending'] == "area_low_high")
        {
            $order_by_thing = "plot_size";
            $order_by = "asc";
        }
        else if($data['sending'] == "area_high_low")
        {
            $order_by_thing = "plot_size";
            $order_by = "desc";
        }


        $add_array = DB::table('commercial_plots')->orderBy($order_by_thing,$order_by)->paginate(getenv('PAGINATION'));

        $response =  view('common.partials.property.commercial_plot_render_ads')->with(compact('add_array','filtering'))->render();

        $data['success'] = $response;
        echo json_encode($data);
    }

    public function commercialPlotDescription($id)
    {
        $property_data = CommercialPlot::where('id',$id)->first();
        return view('common.partials.property.commercial_plots_description')->with(compact('property_data'));
    }

    public function generalPropertyDescription($id,$type)
    {
        if($type == 'property_for_rent')
        {
            $property_data = PropertyForRent::where('id',$id)->first();
            return view('common.partials.property.property_description')->with(compact('property_data'));
        }
        else if($type == 'property_for_sale')
        {
            $property_data = PropertyForSale::where('id',$id)->first();
            return view('common.partials.property.property_for_sale_description')->with(compact('property_data'));
        }
        else if($type == 'property_holiday_home_for_sale')
        {
            $property_data = PropertyHolidaysHomesForSale::where('id',$id)->first();
            return view('common.partials.property.holiday_home_for_sale_description')->with(compact('property_data'));
        }
        else if($type == 'property_flat_wishes_rented')
        {
            $property_data = FlatWishesRented::where('id',$id)->first();
            return view('common.partials.property.flat_wishes_rented_description')->with(compact('property_data'));
        }
        else if($type == 'property_commercial_for_sale')
        {
            $property_data = CommercialPropertyForSale::where('id',$id)->first();
            return view('common.partials.property.commercialproperty_for_sale_description')->with(compact('property_data'));
        }
        else if($type == 'property_commercial_for_rent')
        {
            $property_data = CommercialPropertyForRent::where('id',$id)->first();
            return view('common.partials.property.commercialproperty_for_rent_description')->with(compact('property_data'));
        }
        else if($type == 'property_commercial_plots')
        {
            $property_data = CommercialPlot::where('id',$id)->first();
            return view('common.partials.property.commercial_plots_description')->with(compact('property_data'));
        }
        else if($type == 'property_business_for_sale')
        {
            $property_data = BusinessForSale::where('id',$id)->first();
            return view('common.partials.property.business_for_sale_description')->with(compact('property_data'));
        }


    }
}
