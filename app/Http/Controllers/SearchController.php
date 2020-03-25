<?php

namespace App\Http\Controllers;

use App\Models\Search;
use App\Admin\Jobs\Job;
use App\CommercialPlot;
use App\BusinessForSale;
use App\PropertyForRent;
use App\PropertyForSale;
use App\FlatWishesRented;
use Illuminate\Http\Request;
use App\RealestateBusinessPlot;
use App\CommercialPropertyForRent;
use App\CommercialPropertyForSale;
use App\PropertyHolidaysHomesForSale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searches = Auth::user()->saved_searches;
        return view('user-panel.my-business.search.saved-search', compact('searches'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'filter' => $request->filter,
            'type' => 'saved',
            'notification_web' => ($request->notify ?? 1),
            'notification_email' => ($request->notify ?? 1),
            'notification_sms' => ($request->notify ?? 1),
            'user_id' => auth()->user()->id
        ];


        Search::create($data);
        return back()->with('status', 'Search Saved Successfully');

    }

    public function checksearch(Request $request)
    {
        $search = Search::where('filter', $request->filter)->where('type', 'saved')->get();
        if (count($search) > 0)
            exit(true);
        else
            exit(false);
    }

    public function recent($value, $name, $ad_type)
    {
        // dd($ad_type);
        if (\Illuminate\Support\Facades\Auth::check()) {
            if($ad_type == "job"){
                $value = "jobs/search?" . $value;
            } else if($ad_type == 'property-for-rent'){
                $value = "property/property-for-rent/search?" . $value;
            }else if($ad_type == 'holiday-homes-for-sale'){
                $value = "property/holiday-homes-for-sale/search?" . $value;
              
            }else if($ad_type == 'property-for-sale'){
                $value = "property/property-for-sale/search?" . $value;
            }else if($ad_type == 'flat-wishes-rented'){
                $value = "property/flat-wishes-rented/search?" . $value;
            }else if($ad_type == 'commercial-property-for-sale'){
                $value = "property/commercial-property-for-sale/search?" . $value;
            }else if($ad_type == 'commercial-property-for-rent'){
                $value = "property/commercial-property-for-rent/search?" . $value;
            }else if($ad_type == 'commercial-plots'){
                $value = "property/commercial-plots/search?" . $value;
            }else if($ad_type == 'business-for-sale'){
                $value = "property/business-for-sale/search?" . $value;
            }
           
       
            $check = Search::where('type', 'recent')
                ->Where('name', '=', $name)
                ->where('filter', '=', $value)
                ->where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->id)->count();
            if ($check > 0) {
                return back();
            }
            $data = [
                'name' => $name,
                'type' => 'recent',
                'filter' => $value,
                'notification_web' => 0,
                'notification_email' => 0,
                'notification_sms' => 0,
                'user_id' => auth()->user()->id
            ];
            // dd($data);
            Search::create($data);
            // return back()->with('status', 'Search Saved Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Search $search
     * @return \Illuminate\Http\Response
     */
    public function show(Search $search)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Search $search
     * @return \Illuminate\Http\Response
     */
    public function edit(Search $search)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Search $search
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Search $search)
    {
        $search->update(['notification_web' => 0, 'notification_sms' => 0, 'notification_email' => 0]);
        $search->update($request->all());
        Session::flash('success', 'Søk oppdatert');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Search $search
     * @return \Illuminate\Http\Response
     */
    public function destroy(Search $search)
    {
        $search->delete();
        Session::flash('success', 'Søk slettet');
        return redirect()->back();
    }

    public function search($search = "")
    {
        $date = Date('y-m-d',strtotime('-7 days'));
        if (!empty($search)) {
            //Property for rent
            //$property_for_rent = PropertyForRent::where('heading', 'LIKE', '%' . $search . '%')->get();
            $property_for_rent = DB::table('property_for_rent')->join('ads', 'property_for_rent.ad_id', '=', 'ads.id')
//                ->where('ads.status', '=', 'published')
                ->where('ads.visibility', '=', 1)
                ->where('ads.ad_type', '=', 'property_for_rent')
                ->whereNull('ads.deleted_at')
                ->where('property_for_rent.heading', 'LIKE', '%' . $search . '%')
                ->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->get();

            //Property for sale
            //$property_for_sale = PropertyForSale::where('headline', 'LIKE', '%' . $search . '%')->get();
            $property_for_sale = DB::table('property_for_sales')->join('ads', 'property_for_sales.ad_id', '=', 'ads.id')
//                ->where('ads.status', '=', 'published')
                ->where('ads.visibility', '=', 1)
                ->where('ads.ad_type', '=', 'property_for_sale')
                ->whereNull('ads.deleted_at')
                ->where('property_for_sales.headline', 'LIKE', '%' . $search . '%')
                ->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->get();

            //Holiday homes for sale
            //$property_for_holiday_home_for_Sale = PropertyHolidaysHomesForSale::where('ad_headline', 'LIKE', '%' . $search . '%')->get();
            $property_for_holiday_home_for_Sale = DB::table('property_holidays_homes_for_sales')->join('ads', 'property_holidays_homes_for_sales.ad_id', '=', 'ads.id')
//                ->where('ads.status', '=', 'published')
                ->where('ads.visibility', '=', 1)
                ->where('ads.ad_type', '=', 'property_holiday_home_for_sale')
                ->whereNull('ads.deleted_at')
                ->where('property_holidays_homes_for_sales.ad_headline', 'LIKE', '%' . $search . '%')
                ->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->get();

            $property_realstate_business = RealestateBusinessPlot::where('head_line', 'LIKE', '%' . $search . '%')->get();

            // Flat wishes rented
            //$property_flat_wishes = FlatWishesRented::where('headline', 'LIKE', '%' . $search . '%')->get();
            $property_flat_wishes = DB::table('flat_wishes_renteds')->join('ads', 'flat_wishes_renteds.ad_id', '=', 'ads.id')
//                ->where('ads.status', '=', 'published')
                ->where('ads.visibility', '=', 1)
                ->where('ads.ad_type', '=', 'property_flat_wishes_rented')
                ->whereNull('ads.deleted_at')
                ->where('flat_wishes_renteds.headline', 'LIKE', '%' . $search . '%')
                ->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->get();

            //Commercial property for sale
            //$commercial_property_for_sale = CommercialPropertyForSale::where('headline', 'LIKE', '%' . $search . '%')->get();
            $commercial_property_for_sale = DB::table('commercial_property_for_sales')->join('ads', 'commercial_property_for_sales.ad_id', '=', 'ads.id')
//                ->where('ads.status', '=', 'published')
                ->where('ads.visibility', '=', 1)
                ->where('ads.ad_type', '=', 'property_commercial_for_sale')
                ->whereNull('ads.deleted_at')
                ->where('commercial_property_for_sales.headline', 'LIKE', '%' . $search . '%')
                ->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->get();

            //Commercial property for rent
            //$commercial_property_for_rent = CommercialPropertyForRent::where('heading', 'LIKE', '%' . $search . '%')->get();
            $commercial_property_for_rent = DB::table('commercial_property_for_rents')->join('ads', 'commercial_property_for_rents.ad_id', '=', 'ads.id')
//                ->where('ads.status', '=', 'published')
                ->where('ads.visibility', '=', 1)
                ->where('ads.ad_type', '=', 'property_commercial_for_rent')
                ->whereNull('ads.deleted_at')
                ->where('commercial_property_for_rents.heading', 'LIKE', '%' . $search . '%')
                ->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->get();

            //commercial plots
            //$commercial_plot = CommercialPlot::where('headline', 'LIKE', '%' . $search . '%')->get();
            $commercial_plot = DB::table('commercial_plots')->join('ads', 'commercial_plots.ad_id', '=', 'ads.id')
//                ->where('ads.status', '=', 'published')
                ->where('ads.visibility', '=', 1)
                ->where('ads.ad_type', '=', 'property_commercial_plots')
                ->whereNull('ads.deleted_at')
                ->where('commercial_plots.headline', 'LIKE', '%' . $search . '%')
                ->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->get();

            //Business for sale
            //$Business_for_sale = BusinessForSale::where('headline', 'LIKE', '%' . $search . '%')->get();
            $Business_for_sale = DB::table('business_for_sales')->join('ads', 'business_for_sales.ad_id', '=', 'ads.id')
//                ->where('ads.status', '=', 'published')
                ->where('ads.visibility', '=', 1)
                ->where('ads.ad_type', '=', 'property_business_for_sale')
                ->whereNull('ads.deleted_at')
                ->where('business_for_sales.headline', 'LIKE', '%' . $search . '%')
                ->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->get();

            //Part time jobs
            $job_parttime = DB::table('jobs')->join('ads', 'jobs.ad_id', '=', 'ads.id')
//                ->where('ads.status', '=', 'published')
                ->where('ads.visibility', '=', 1)
                ->where('jobs.job_type', '=', 'part_time')
                ->whereNull('ads.deleted_at')
                ->where(function ($query) use ($search) {
                    $query->where('jobs.title', 'LIKE', '%' . $search . '%')
                        ->orWhere('jobs.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('jobs.keywords', 'like', "%" . $search . "%");
                })->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->get();

            //Full time jobs
            $job_fulltime = DB::table('jobs')->join('ads', 'jobs.ad_id', '=', 'ads.id')
//                ->where('ads.status', '=', 'published')
                ->where('ads.visibility', '=', 1)
                ->where('jobs.job_type', '=', 'full_time')
                ->whereNull('ads.deleted_at')
                ->where(function ($query) use ($search) {
                    $query->where('jobs.title', 'LIKE', '%' . $search . '%')
                        ->orWhere('jobs.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('jobs.keywords', 'like', "%" . $search . "%");
                })->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->get();

            //Mangement jobs
            $job_management = DB::table('jobs')->join('ads', 'jobs.ad_id', '=', 'ads.id')
//                ->where('ads.status', '=', 'published')
                ->where('ads.visibility', '=', 1)
                ->where('jobs.job_type', '=', 'management')
                ->whereNull('ads.deleted_at')
                ->where(function ($query) use ($search) {
                    $query->where('jobs.title', 'LIKE', '%' . $search . '%')
                        ->orWhere('jobs.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('jobs.keywords', 'like', "%" . $search . "%");
                })->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->get();

            $html = "";
            $html .= view('user-panel.partials.global-search-inner',
                compact('search','job_parttime', 'job_fulltime', 'job_management', 'property_for_rent', 'property_for_sale', 'property_for_holiday_home_for_Sale', 'property_realstate_business', 'property_flat_wishes', 'commercial_property_for_sale', 'commercial_property_for_rent', 'commercial_plot', 'Business_for_sale', 'search'))->render();
            exit($html);
        } else {
            exit("");
        }
    }

    public function global($search=""){
        return view('user-panel.searches.global', compact('search'));
    }

    public function job_search($search = "")
    {
        $date = Date('y-m-d',strtotime('-7 days'));
        if (!empty($search)) {
            $job_parttime = DB::table('jobs')->join('ads', 'jobs.ad_id', '=', 'ads.id')
                ->where('ads.visibility', '=', 1)
                ->where('jobs.job_type', '=', 'part_time')
                ->where(function ($query) use ($search) {
                    $query->where('jobs.title', 'LIKE', '%' . $search . '%')
                        ->orWhere('jobs.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('jobs.keywords', 'like', "%" . $search . "%");
                })->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->get();
            $job_fulltime = DB::table('jobs')->join('ads', 'jobs.ad_id', '=', 'ads.id')
                ->where('ads.visibility', '=', 1)
                ->where('jobs.job_type', '=', 'full_time')
                ->where(function ($query) use ($search) {
                    $query->where('jobs.title', 'LIKE', '%' . $search . '%')
                        ->orWhere('jobs.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('jobs.keywords', 'like', "%" . $search . "%");
                })->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->get();
            $job_management = DB::table('jobs')->join('ads', 'jobs.ad_id', '=', 'ads.id')
                ->where('ads.visibility', '=', 1)
                ->where('jobs.job_type', '=', 'management')
                ->where(function ($query) use ($search) {
                    $query->where('jobs.title', 'LIKE', '%' . $search . '%')
                        ->orWhere('jobs.name', 'LIKE', '%' . $search . '%')
                        ->orWhere('jobs.keywords', 'like', "%" . $search . "%");
                })->where(function ($query) use ($date){
                    $query->where('ads.status', 'published')
                        ->orwhereDate('ads.sold_at','>',$date);
                })->get();
            $html = "";
            $html .= view('user-panel.partials.job-search-inner',
                compact('search','job_parttime', 'job_fulltime', 'job_management'))->render();
            exit($html);
        } else {
            exit("");
        }
    }
    public function job_global($search=""){
//        return view('user-panel.searches.global', compact('search'));
    }
}
