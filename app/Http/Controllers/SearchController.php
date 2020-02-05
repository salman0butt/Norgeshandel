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

    public function checksearch(Request $request){
        $search = Search::where('filter', $request->filter)->where('type', 'saved')->get();
        if(count($search)>0)
            exit(true);
        else
            exit(false);
    }
    public function recent($value, $name, $ad_type)
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            $value = $ad_type == "job" ? "jobs/search?" . $value : $value;
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
            Search::create($data);
            return back()->with('status', 'Search Saved Successfully');
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
        $search->update(['notification_web'=>0,'notification_sms'=>0,'notification_email'=>0]);
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
        if (!empty($search)) {
            $property_for_rent = PropertyForRent::where('heading', 'LIKE', '%' . $search . '%')->get();
            $property_for_sale = PropertyForSale::where('headline', 'LIKE', '%' . $search . '%')->get();
            $property_for_holiday_home_for_Sale = PropertyHolidaysHomesForSale::where('ad_headline', 'LIKE', '%' . $search . '%')->get();
            $property_realstate_business = RealestateBusinessPlot::where('head_line', 'LIKE', '%' . $search . '%')->get();
            $property_flat_wishes = FlatWishesRented::where('headline', 'LIKE', '%' . $search . '%')->get();
            $commercial_property_for_sale = CommercialPropertyForSale::where('headline', 'LIKE', '%' . $search . '%')->get();
            $commercial_property_for_rent = CommercialPropertyForRent::where('heading', 'LIKE', '%' . $search . '%')->get();
            $commercial_plot = CommercialPlot::where('headline', 'LIKE', '%' . $search . '%')->get();
            $Business_for_sale = BusinessForSale::where('headline', 'LIKE', '%' . $search . '%')->get();

            $job_parttime = DB::table('jobs')->join('ads', 'jobs.ad_id', 'ads.id')
                ->where('ads.status', '=', 'published')
                ->where('jobs.job_type', '=', 'part_time')
                ->where('jobs.title', 'LIKE', '%' . $search . '%')
                ->orWhere('jobs.name', 'LIKE', '%' . $search . '%')
                ->orWhere('jobs.keywords', 'like', "%" . $search . "%")->get();
            $job_fulltime = DB::table('jobs')->join('ads', 'jobs.ad_id', 'ads.id')
                ->where('ads.status', '=', 'published')
                ->where('jobs.job_type', '=', 'full_time')
                ->where('jobs.title', 'LIKE', '%' . $search . '%')
                ->orWhere('jobs.name', 'LIKE', '%' . $search . '%')
                ->orWhere('jobs.keywords', 'like', "%" . $search . "%")->get();
            $job_management = DB::table('jobs')->join('ads', 'jobs.ad_id', 'ads.id')
                ->where('ads.status', '=', 'published')
                ->where('jobs.job_type', '=', 'management')
                ->where('jobs.title', 'LIKE', '%' . $search . '%')
                ->orWhere('jobs.name', 'LIKE', '%' . $search . '%')
                ->orWhere('jobs.keywords', 'like', "%" . $search . "%")->get();

//        dd($job_fulltime, $job_management, $job_parttime);
            $html = "";
            $html .= view('user-panel.partials.global-search-inner',
                compact('job_parttime', 'job_fulltime', 'job_management', 'property_for_rent', 'property_for_sale', 'property_for_holiday_home_for_Sale', 'property_realstate_business', 'property_flat_wishes', 'commercial_property_for_sale', 'commercial_property_for_rent', 'commercial_plot', 'Business_for_sale', 'search'))->render();
            exit($html);
        } else {
            exit("");
        }
    }

}
