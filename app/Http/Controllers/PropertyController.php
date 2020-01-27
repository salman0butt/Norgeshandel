<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddPropertyForRent;
use App\Http\Requests\AddPropertyForSale;
use App\Http\Requests\AddFlatWishesRented;
use App\Http\Requests\AddRealEstateBusinessPlot;
use App\Http\Requests\AddCommercialPropertyForSale;
use App\Http\Requests\AddCommercialPropertyForRent;
use App\Http\Requests\AddPropertyHolidayHomeForSale;
use App\Http\Requests\AddBusinessForSale;
use App\Http\Requests\AddCommercialPlot;
use App\PropertyForRent;
use App\Models\Ad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\common;
use App\PropertyForSale;
use App\PropertyHolidaysHomesForSale;
use App\FlatWishesRented;
use App\RealestateBusinessPlot;
use App\CommercialPropertyForSale;
use App\PropertyForRentMoreTimes;
use App\CommercialPropertyForRent;
use App\BusinessForSale;
use App\CommercialPlot;
use Mapper;
use App\User;
use App\Message;
use Pusher\Pusher;
use App\Events\PropertyForRent as PropertyForRentEvent;
use App\Http\Controllers\NotificationController;


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

    public function list()
    {
        $ads = Ad::where('status','published')
            ->where('ad_type','!=','job')
            ->orderBy('id', 'desc')->get();

        return view('user-panel.property.property_list',compact('ads'));
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

    public function newSaleAdd(){
        return view('user-panel.property.new_sale_add');
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

            $i = 0;
            foreach($files_builded_arr as $key=>$val)
            {
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\PropertyHolidaysHomesForSale', 'property_home_for_sale_photos');
                }
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
          
        //trigger event
        event(new PropertyForRentEvent($notifiable_id));

        $data['success'] = $response;
        echo json_encode($data);

    }

    public function addSaleAdd(AddPropertyForSale $request)
    {
        $property_for_sale_data = $request->all();

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
            $facilities = "";
            foreach($property_for_sale_data['facilities'] as $key=>$val)
            {
                $facilities .= $val . ",";
            }
            $property_for_sale_data['facilities'] = $facilities;
        }

        $property_for_sale_data['user_id'] = Auth::user()->id;

        //add Add to table
        $add = array();
        $add['ad_type'] = 'property_for_sale';
        $add['status']  = 'published';
        $add['user_id'] =  Auth::user()->id;
        $add_response   =  Ad::create($add);

        $property_for_sale_data['ad_id'] = $add_response->id;

        $response = PropertyForSale::create($property_for_sale_data);

        if ($request->file('property_photos') || $request->file('property_pdf') || $request->file('property_quote'))
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

            $i = 0;
            foreach($files_builded_arr as $key=>$val)
            {
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\PropertyForSale', 'propert_for_sale_photos');
                }
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
         
        //trigger event
        event(new PropertyForRentEvent($notifiable_id));

        $data['success'] = $response;
        echo json_encode($data);

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

        //add images
        if ($request->file('property_photos'))
        {
            $file = $request->file('property_photos');
            common::update_media($file, $response->id , 'App\PropertyForRent', 'propert_for_rent');

        }

        //Notification data
        $notifiable_id = $response -> id;
        $notification_obj = new NotificationController();
        $notification_response = $notification_obj->create($notifiable_id,'App\PropertyForRent','property have been added');
        
        //trigger event
        event(new PropertyForRentEvent($notifiable_id));

        $data['success'] = $response;
        echo json_encode($data);
    }


    public function newAddFlatWishesRented()
    {
        return view('user-panel.property.flat_wishes_rented');
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


        if ($request->file('flat_wishes_rented'))
        {
            $files = $request->file('flat_wishes_rented');
            foreach ($files as $file)
            {
                common::update_media($file, $response->id , 'App\FlatWishesRented', 'flat_wishes_rented');
            }
        }

        //Notification data
        $notifiable_id = $response -> id;
        $notification_obj = new NotificationController();
        $notification_response = $notification_obj->create($notifiable_id,'App\FlatWishesRented','property have been added');
            
        //trigger event
        event(new PropertyForRentEvent($notifiable_id));
   

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
              
          //trigger event
          event(new PropertyForRentEvent($notifiable_id));

        $data['success'] = $response;
        echo json_encode($data);

    }
    public function commercialPropertyForSale()
    {
        return view('user-panel.property.commercial_property_for_sale');
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


        if ($request->file('commercial_property_for_sale_photos') || $request->file('commercial_property_for_sale_pdf'))
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
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\CommercialPropertyForSale', 'commercial_propert_for_sale_photos');
                }
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
            
        //trigger event
        event(new PropertyForRentEvent($notifiable_id));

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


        if ($request->file('commercial_property_for_rent_photos') || $request->file('commercial_property_for_rent_pdf'))
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
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\CommercialPropertyForRent', 'commercial_property_for_rent_photos');
                }
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
            
        //trigger event
        event(new PropertyForRentEvent($notifiable_id));

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

        if ($request->file('business_for_sale_photos') || $request->file('business_for_sale_pdf'))
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
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\BusinessForSale', 'business_for_sale_photos');
                }
                if($i == 1)
                {
                    common::update_media($val, $response->id , 'App\BusinessForSale', 'business_for_sale_pdf');
                }
                $i++;

            }

        }

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

        if ($request->file('commercial_plot_photos') || $request->file('commercial_plot_photos'))
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
                if($i == 0)
                {
                    common::update_media($val, $response->id , 'App\CommercialPlot', 'commercial_plot_photos');
                }
                if($i == 1)
                {
                    common::update_media($val, $response->id , 'App\CommercialPlot', 'commercial_plot_pdf');
                }
                $i++;

            }

        }

        //Notification data
        $notifiable_id = $response -> id;
        $notification_obj = new NotificationController();
        $notification_response = $notification_obj->create($notifiable_id,'App\CommercialPlot','property have been added');
            
        //trigger event
        event(new PropertyForRentEvent($notifiable_id));

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

    public function messages(Request $request)
    {   
        //select all users except logged in user
        //$users = User::where('id', '!=', Auth::id())->get();

        $users = DB::select("select users.id, users.username, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.username, users.email");

        return view('user-panel.chat.messages',['users' => $users]);
    }

    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        // Make read all unread message
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return view('common.partials.messages.index', ['messages' => $messages]);
    }


    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);

    }

}
