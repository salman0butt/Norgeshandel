<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddPropertyForRent;
use App\Http\Requests\AddPropertyForSale;
use App\Http\Requests\AddFlatWishesRented;
use App\Http\Requests\AddRealEstateBusinessPlot;
use App\Http\Requests\AddCommercialPropertyForSale;
use App\Http\Requests\AddPropertyHolidayHomeForSale;
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

class PropertyController extends Controller
{
    //
    public function __construct()
    {

    }

    public function list()
    {
        return view('user-panel.property.property_list');
    }


    public function adsPropertyForSale()
    {   
        $add_array = DB::table('property_for_sales')->orderBy('id', 'DESC')->get()->toArray();
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
        return view('user-panel.property.new_Add');
    }

    public function newSaleAdd(){
        return view('user-panel.property.new_sale_Add');
    }

    public function getHomeForSaleAdd(Request $request){
        
        $data = $request->all();
        $searchable = $data['sending'];

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
        elseif($data['sending'] == "p-rom-area-low-high")
        {
            $order_by_thing = "primary_room";
            $order_by = "asc";
        }
        else if($data['sending'] == "p-rom-area-high-low")
        {
            $order_by_thing = "primary_room";
            $order_by = "desc";
        }
        elseif($data['sending'] == "p-rom-area-low-high")
        {
            $order_by_thing = "primary_room";
            $order_by = "asc";
        }
        else if($data['sending'] == "tot-price-low-high")
        {
            $order_by_thing = "asking_price";
            $order_by = "asc";
        }
        else if($data['sending'] == "tot-price-high-low")
        {
            $order_by_thing = "asking_price";
            $order_by = "desc";
        }


        $add_array = DB::table('property_holidays_homes_for_sales')
        ->join('media', 'property_holidays_homes_for_sales.id', '=', 'media.mediable_id')
        ->where(['user_id'=>Auth::user()->id, 'mediable_type' => 'App\App\PropertyHolidaysHomesForSale'])->orderBy($order_by_thing, $order_by)->get()->toArray();
        
        $response =  view('user-panel.property.order_specific_holiday_home_for_sale')->with(compact('add_array'))->render();

        $data['success'] = $response;
        echo json_encode($data);
        
    }

    public function getAd(Request $request)
    {
        // $data = $request->all();
        // $searchable = $data['sending'];
        
        // if($data['sending'] == 'priced-low-high')
        // {
        //     $order_by_thing = "monthly_rent";
        //     $order_by       =  "asc";

        // }
        // else if($data['sending'] == "priced-high-low")
        // {
        //     $order_by_thing = "monthly_rent";
        //     $order_by = "desc";
        // }
        // elseif($data['sending'] == "p-rom-area-low-high")
        // {
        //     $order_by_thing = "primary_rom";
        //     $order_by = "asc";
        // }
        // else if($data['sending'] == "p-rom-area-high-low")
        // {
        //     $order_by_thing = "primary_rom";
        //     $order_by = "desc";
        // }
        // elseif($data['sending'] == "p-rom-area-low-high")
        // {
        //     $order_by_thing = "primary_rom";
        //     $order_by = "asc";
        // }
        // else if($data['sending'] == "tot-price-low-high")
        // {
        //     $order_by_thing = "monthly_rent";
        //     $order_by = "asc";
        // }
        // else if($data['sending'] == "tot-price-high-low")
        // {
        //     $order_by_thing = "monthly_rent";
        //     $order_by = "desc";
        // }


        // $add_array = DB::table('property_for_rent')
        // ->join('media', 'property_for_rent.id', '=', 'media.mediable_id')
        // ->where(['user_id'=>Auth::user()->id, 'mediable_type' => 'App\PropertyForRent'])->orderBy($order_by_thing, $order_by)->get()->toArray();

        
        // $response =  view('user-panel.property.order_specific_jobs')->with(compact('add_array'))->render();

        // $data['success'] = $response;
        // echo json_encode($data);
        
       
    }

    
    public function sortedAddsPropertyForRent(Request $request)
    {
        $sorted_by = $request->all();
        $searchable = $sorted_by['sending'];

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

        $add_array = DB::table('property_for_rent')->orderBy($order_by_thing,$order_by)->get(['id'])->toArray();
    
        $response  =  view('common.partials.property.render_ads')->with(compact('add_array'))->render();


        $data['success'] = $response;
        echo json_encode($data);
       

    }

    
    public function sortedAddsPropertyForSale(Request $request){
    
        $data = $request->all();
        $searchable = $data['sending'];
        
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

        $add_array = DB::table('property_for_sales')->orderBy($order_by_thing,$order_by)->get(['id'])->toArray();
    
        $response  =  view('common.partials.property.render_ads_for_sale')->with(compact('add_array'))->render();


        $data['success'] = $response;
        echo json_encode($data);


    }

    public function holidayHomeForSale(Request $request)
    {
        return view('user-panel.property.holiday_home_sale');
    }

    public function addHomeForSaleAdd(AddPropertyHolidayHomeForSale $request)
    {
        $property_home_for_sale_data = $request->all();

        unset($property_home_for_sale_data['property_home_for_sale_photos']);

        $property_home_for_sale_data['user_id'] = Auth::user()->id;

        //Manage Facilities
        $facilities = "";
        foreach($property_home_for_sale_data['facilities'] as $key=>$val)
        {
            $facilities .= $val . ",";
        }
        $property_home_for_sale_data['facilities'] = $facilities;
    
        $property_home_for_sale_data['user_id'] = Auth::user()->id;

        //add Add to table
        $add = array();
        $add['ad_type'] = 'property';
        $add['status']  = 'published';
        $add['user_id'] =  Auth::user()->id;
        $add_response   =  Ad::create($add);
        
        $property_home_for_sale_data['ad_id'] = $add_response->id;

        $response = PropertyHolidaysHomesForSale::create($property_home_for_sale_data);

        
        if ($request->file('property_home_for_sale_photos')) 
        {
            $files = $request->file('property_home_for_sale_photos');
            foreach ($files as $file)
            {
                common::update_media($file, $response->id , 'App\PropertyHolidaysHomesForSale', 'propert_home_holiday_for_sale');
            }
        }

        $data['success'] = $response;
        echo json_encode($data);

    }

    //AddPropertyForSale $request
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
        $add['ad_type'] = 'property';
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

        //add Add to table
        $add = array();
        $add['ad_type'] = 'property';
        $add['status']  = 'published';
        $add['user_id'] =  Auth::user()->id;
        $add_response   =  Ad::create($add);
        
        $property_for_rent_data['ad_id'] = $add_response->id;
        $response = PropertyForRent::create($property_for_rent_data);



        if ($request->file('property_photos')) 
        {
            $files = $request->file('property_photos');
            foreach ($files as $file)
            {
                common::update_media($file, $response->id , 'App\PropertyForRent', 'propert_for_rent');
            }
        }

        $data['success'] = $response;
        echo json_encode($data);
    }


    public function newAddFlatWishesRented()
    {
        return view('user-panel.property.realestate-letting-wanted');
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
        $add['ad_type'] = 'property';
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
                common::update_media($file, $response->id , 'App\flatWishesRenteds', 'flatWishesRenteds');
            }
        }

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

            
        $data['success'] = $response;
        echo json_encode($data);

    }
    public function commercialPropertyForSale(){


        return view('user-panel.property.commercial_property_for_sale');


    }

    public function addCommercialPropertyForSale(AddCommercialPropertyForSale $request)
    {
        $commercial_property_for_sale = $request->all();
        unset($commercial_property_for_sale['commercial_property_for_sale_photos']);
        unset($commercial_property_for_sale['commercial_property_for_sale_pdf']);
        $commercial_property_for_sale['user_id'] = Auth::user()->id;

        $response = CommercialPropertyForSale::create($commercial_property_for_sale);
    
        if ($request->file('commercial_property_for_sale_photos')) 
        {
            $files = $request->file('commercial_property_for_sale_photos');
            foreach ($files as $file)
            {
                common::update_media($file, $response->id , 'App\CommercialPropertyForSale', 'CommercialPropertyForSale');
            }
        }

        $data['success'] = $response;
        echo json_encode($data);
    
    }

    public function AdsForRent(Request $request)
    {

        $add_array = DB::table('property_for_rent')->orderBy('id', 'DESC')->get(['id'])->toArray();
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


}
