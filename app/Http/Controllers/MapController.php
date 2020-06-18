<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
// use FarhanWazir\GoogleMaps\Facades\GMapsFacade as GMaps;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function map(){
        return view('map.map');
    }
    public function index()
    {
        $html = view('map.search')->render();
        exit($html);

    }
    public function direction() {

    $html = view('map.direction')->render();
    exit($html);

    }
    public function propertyForSaleFilter() {
        return view('map.map-filter');
    }
    
    public function selectPropertyType(Request $request) {
        if($request->property_type == 'property_for_sale'){
            $html = view('user-panel.partials.templates.filter-property-for-sale')->render();
            exit($html);
        }
        else if($request->property_type == 'property_for_rent'){
            $html = view('user-panel.partials.templates.filter-property-for-rent')->render();
            exit($html);
        }
        else if($request->property_type == 'commercial_property_for_sale'){
            $html = view('user-panel.partials.templates.filter-commercial-property-for-sale')->render();
            exit($html);
            }
        else if($request->property_type == 'commercial_property_for_rent'){
            $html = view('user-panel.partials.templates.filter-commercial-property-for-rent')->render();
            exit($html);
        }
        else if($request->property_type == 'commercial_plot'){
            $html =  view('user-panel.partials.templates.filter-commercial-plots')->render();
            exit($html);
        }
            else if($request->property_type == 'holiday_home_for_sale'){
            $html = view('user-panel.partials.templates.filter-holiday-homes-for-sale')->render();
            exit($html);
            }
        else if($request->property_type == 'flat_wishes_rented'){
            $html = view('user-panel.partials.templates.filter-business-for-sale')->render();
            exit($html);
        }
        else if($request->property_type == 'Business_for_sale'){
            $html = view('user-panel.partials.templates.filter-flat-wishes-rented')->render();
            exit($html);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
