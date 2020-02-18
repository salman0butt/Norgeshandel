<?php

namespace App\Http\Controllers;

use App\BusinessForSale;
use App\CommercialPlot;
use App\CommercialPropertyForRent;
use App\CommercialPropertyForSale;
use App\FlatWishesRented;
use App\Models\Ad;
use App\Model\Search;
use App\PropertyForRent;
use App\PropertyForSale;
use App\PropertyHolidaysHomesForSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index(Request $request)
    {
        if ($request->handel){
            $ad = Ad::find($request->handel);
            if ($ad){
                $type = "";
                if ($ad->ad_type=='job'){
                    $type='jobs';
                }
                else{
                    $type="properties";
                }
                return redirect($type.'/ad?handel='.$ad->id);
            }
            abort(404);
        }

        $saved_search = null;
        $recent_search = null;
        if (Auth::check()) {
            $saved_search = Search::where('type', 'saved')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->limit(5)->get();
            $recent_search = Search::where('type', 'recent')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->limit(5)->get();
        }
        $ads = Ad::where('status', 'published')->orderBy('id', 'desc')->get();
        return view('home', compact('ads', 'saved_search', 'recent_search'));
    }

    //clear search history
    public function single_ad(Request $request, $ad_type){
        $ad = Ad::find($request->handel);
        if ($ad){
            $type = $ad->ad_type;
            if ($type == 'job' && $ad_type == 'jobs'){
                $job = $ad->job;
                return view('user-panel.jobs.single', compact('job'));
            }
            else if($type == 'property_for_rent'){
                if ($ad->property) {
                    $property_data = PropertyForRent::find($ad->property->id);
                    return view('common.partials.property.property_description', compact('property_data'));
                }
                abort(404);
            }
            else if($type == 'property_for_sale'){
                if($ad->property) {
                    $property_data = PropertyForSale::find($ad->property->id);
                    return view('common.partials.property.property_for_sale_description', compact('property_data'));
                }
                abort(404);
            }
            else if($type == 'property_holiday_home_for_sale'){
                if($ad->property) {
                    $property_data = PropertyHolidaysHomesForSale::find($ad->property->id);
                    return view('common.partials.property.holiday_home_for_sale_description', compact('property_data'));
                }
                abort(404);
            }
            else if($type == 'property_flat_wishes_rented'){
                if($ad->property) {
                    $property_data = FlatWishesRented::find($ad->property->id);
                    return view('common.partials.property.flat_wishes_for_rented_description', compact('property_data'));
                }
                abort(404);
            }
            else if($type == 'property_commercial_for_sale'){
                if($ad->property) {
                    $property_data = CommercialPropertyForSale::find($ad->property->id);
                    return view('common.partials.property.commercialproperty_for_sale_description', compact('property_data'));
                }
                abort(404);
            }
            else if($type == 'property_commercial_for_rent'){
                if($ad->property) {
                    $property_data = CommercialPropertyForRent::find($ad->property->id);
                    return view('common.partials.property.commercialproperty_for_rent_description', compact('property_data'));
                }
                abort(404);
            }
            else if($type == 'property_commercial_plots'){
                if($ad->property) {
                    $property_data = CommercialPlot::find($ad->property->id);
                    return view('common.partials.property.commercial_plots_description', compact('property_data'));
                }
                abort(404);
            }
            else if($type == 'property_business_for_sale'){
                if($ad->property) {
                    $property_data = BusinessForSale::find($ad->property->id);
                    return view('common.partials.property.business_for_sale_description', compact('property_data'));
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
