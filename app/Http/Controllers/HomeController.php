<?php

namespace App\Http\Controllers;

use App\Admin\Banners\BannerGroup;
use App\Helpers\common;
use App\Models\Ad;
use App\Media;
use App\Models\Search;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\PropertyHolidaysHomesForSale;
use App\CommercialPlot;
use App\BusinessForSale;
use App\CommercialPropertyForRent;
use App\CommercialPropertyForSale;
use App\FlatWishesRented;
use App\PropertyForRent;
use App\PropertyForSale;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $handel=0)
    {
//        if (Auth::check()){
//            $notification = Notification::where('notifiable_type',Ad::class)->where('notifiable_id',$handel)->whereNull('read_at')->update(['read_at'=>now()]);
//        }

        if ($request->handel) {
            $handel = $handel!=0?$handel:$request->handel;
            if (Auth::check()){
                $ad = Ad::where('id', '=', $handel)->where(function ($query){
                    $query->where('visibility', '=', 1)
                        ->orWhere('user_id', Auth::id());
                })->where(function ($query){
                    $date = Date('y-m-d',strtotime('-7 days'));
                    $query->where('status', 'published')
                        ->orwhereDate('sold_at','>',$date);
                })->first();
            }
            else{
                $ad = Ad::where('id', '=', $handel)->where('visibility', '=', 1)->where(function ($query){
                    $date = Date('y-m-d',strtotime('-7 days'));
                    $query->where('status', 'published')
                        ->orwhereDate('sold_at','>',$date);
                })->first();
            }
            if ($ad) {
                $type = "";
                if ($ad->ad_type == 'job') {
                    $type = 'jobs';
                } else {
                    $type = "properties";
                }

                $view = new \App\Models\AdView(['ad_id' => $ad->id, 'ip' => \request()->getClientIp(), 'user_id' => Auth::id()]);
                $view->save();

                return redirect($type . '/ad?handel=' . $ad->id);
            }
            abort(404);
        }
        $saved_search = null;
        $recent_search = null;
        if (Auth::check()) {
            $saved_search = Search::where('type', 'saved')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->limit(5)->get();
            $recent_search = Search::where('type', 'recent')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->limit(5)->get();
        }//where('status', 'published')->

        $ads = Ad::where('visibility', '=', 1)->orderBy('published_on', 'desc')
            ->where(function ($query){
                $date = Date('y-m-d',strtotime('-7 days'));
                $query->where('status', 'published')
                    ->orwhereDate('sold_at','>',$date);
            })->limit(5)->get();
        return view('home', compact('ads', 'saved_search', 'recent_search'));

    }
    public function paginate(Request $request,$id) {
        $currentPage = $id;
       Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });


        $ads = Ad::where(function ($query){
            $date = Date('y-m-d',strtotime('-7 days'));
            $query->where('status', 'published')
                ->orwhereDate('sold_at','>',$date);
        })->where('visibility', '=', 1)->orderBy('id', 'desc')->paginate(getenv('PAGINATION'));
        $html = "";
        if ($ads && is_countable($ads) && count($ads) > 0) {
            foreach ($ads as $ad) {
                if ($ad->ad_type == 'job') {
                    $html .= view('user-panel.partials.templates.job-sequare', compact('ad'))->render();
                } else {
                    $html .= view('user-panel.partials.templates.propert-sequare', compact('ad'))->render();
                }
            }
            return $html;
        }


    }
    //clear search history
    public function single_ad(Request $request, $ad_type){
        if (Auth::check()){
            $ad = Ad::where('id', '=', $request->handel)->where(function ($query){
                $query->where('visibility', '=', 1)
                    ->orWhere('user_id', Auth::id());
            })->first();
        }
        else{
            $ad = Ad::where('id', '=', $request->handel)->where('visibility', '=', 1)->first();
        }
        if ($ad){
            $type = $ad->ad_type;
            if ($type == 'job' && $ad_type == 'jobs'){
                $job = $ad->job;
                $prev = common::previous_ad($job);
                $next = common::next_ad($job);
                return view('user-panel.jobs.single', compact('job','prev','next'));
            }
            else if($type == 'property_for_rent'){
                if ($ad->property) {
                    $property_data = PropertyForRent::find($ad->property->id);
                    $prev = common::previous_ad($property_data);
                    $next = common::next_ad($property_data);
                    return view('common.partials.property.property_description', compact('property_data','prev','next'));
                }
                abort(404);
            }
            else if($type == 'property_for_sale'){
                if($ad->property) {
                    $property_data = PropertyForSale::find($ad->property->id);
                    $prev = common::previous_ad($property_data);
                    $next = common::next_ad($property_data);
                    return view('common.partials.property.property_for_sale_description', compact('property_data','prev','next'));
                }
                abort(404);
            }
            else if($type == 'property_holiday_home_for_sale'){
                if($ad->property) {
                    $property_data = PropertyHolidaysHomesForSale::find($ad->property->id);
                    $prev = common::previous_ad($property_data);
                    $next = common::next_ad($property_data);
                    return view('common.partials.property.holiday_home_for_sale_description', compact('property_data','prev','next'));
                }
                abort(404);
            }
            else if($type == 'property_flat_wishes_rented'){
                if($ad->property) {
                    $property_data = FlatWishesRented::find($ad->property->id);
                    $prev = common::previous_ad($property_data);
                    $next = common::next_ad($property_data);
                    return view('common.partials.property.flat_wishes_rented_description', compact('property_data','prev','next'));
                }
                abort(404);
            }
            else if($type == 'property_commercial_for_sale'){
                if($ad->property) {
                    $property_data = CommercialPropertyForSale::find($ad->property->id);
                    $prev = common::previous_ad($property_data);
                    $next = common::next_ad($property_data);
                    return view('common.partials.property.commercialproperty_for_sale_description', compact('property_data','prev','next'));
                }
                abort(404);
            }
            else if($type == 'property_commercial_for_rent'){
                if($ad->property) {
                    $property_data = CommercialPropertyForRent::find($ad->property->id);
                    $prev = common::previous_ad($property_data);
                    $next = common::next_ad($property_data);
                    return view('common.partials.property.commercialproperty_for_rent_description', compact('property_data','prev','next'));
                }
                abort(404);
            }
            else if($type == 'property_commercial_plots'){
                if($ad->property) {
                    $property_data = CommercialPlot::find($ad->property->id);
                    $prev = common::previous_ad($property_data);
                    $next = common::next_ad($property_data);
                    return view('common.partials.property.commercial_plots_description', compact('property_data','prev','next'));
                }
                abort(404);
            }
            else if($type == 'property_business_for_sale'){
                if($ad->property) {
                    $property_data = BusinessForSale::find($ad->property->id);
                    $prev = common::previous_ad($property_data);
                    $next = common::next_ad($property_data);
                    return view('common.partials.property.business_for_sale_description', compact('property_data','prev','next'));
                }
                abort(404);
            }
            else{
                abort(404);
            }
        }
        abort(404);
    }

    public function clearSearches(Request $request){
        $flag = '';
        if($request->type){
            $searches = Search::where('type', $request->type)->where('user_id', Auth::user()->id);
            if($searches->count() > 0){
                $searches->delete();
                $flag = 'success';
                return json_encode($flag);
                exit();
            }
        }
        return json_encode($flag);
        exit();
    }
}
