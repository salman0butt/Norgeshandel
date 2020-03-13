<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\MessageThread;
use App\Models\Ad;
use App\Models\AdView;
use Carbon\Traits\Date;
use DateTime;
use http\Message\Body;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Stmt\DeclareDeclare;
use test\Mockery\ReturnTypeObjectTypeHint;
use function foo\func;
use function GuzzleHttp\Psr7\str;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return redirect('home');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Ad $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Ad $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Ad $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Ad $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        //
    }

    public function filter_ads($string = "")
    {
        $filtered_ads = DB::table('ads')->join('jobs', 'jobs.id', '=', 'ads.id')
            ->where('ads.status', 'published')
            ->where(function ($query) use ($string) {
                $query->where('jobs.title', 'like', '%' . $string . '%')
                    ->orWhere('jobs.name', 'like', '%' . $string . '%')
                    ->orWhere('ads.ad_type', 'like', '%' . $string . '%');
            })
            ->orderByDesc('ads.updated_at')->get();
//        dd($filtered_ads);
//        $ads = Ad::where('status','published')->orderBy('id', 'desc')->get();
        $html = "";
        if (count($filtered_ads) > 0) {
            foreach ($filtered_ads as $filtered_ad) {
                if ($filtered_ad->ad_type == 'job') {
                    $html .= view('user-panel.partials.templates.job-sequare', compact('filtered_ad'))->render();
                }
            }
        } else {
            $html = '<div class="col-md-12 ml-3 alert alert-warning no-ads dme-tab-content" style="" data-id="no-ads">
                        <h3 class=" text-center">Ingen annonser funnet.</h3>
                    </div>';
        }

        exit($html);
    }

    public function my_ads($status = [])
    {
        DB::enableQueryLog();

        $my_ads = Ad::where('user_id', Auth::user()->id)->where('status','=','published')->orderByDesc('ads.updated_at')->get();
        return view('user-panel/my-business.my_ads', compact('my_ads'));
    }

    public function filter_my_ads($status, $ad_type)
    {
        if($status == 'expired'){
            $status = 'sold';
        }
        $type = "";
        $table = "";
        if ($ad_type != 'all_ads') {
            $arr_type = explode('-', $ad_type);
            if (isset($arr_type[0])) {
                if ($arr_type[0] == 'jobs') {
                    $table = $arr_type[0];
                } else {
                    $table = $arr_type[1];
                }
            }
            if (isset($arr_type[1])) {
                $type = $arr_type[1];
            }
        }
        $query = null;
        $jobs = array();
        if ($ad_type != 'all_ads') {
            $query = DB::table('ads')
                ->select('ads.id as ad_ad_id', 'ads.status', 'ads.ad_type')
                ->join($table, 'ads.id', '=', $table . '.ad_id')
                ->where('ads.status', '=', $status)
                ->where('ads.user_id', '=', Auth::id());
            if ($table == 'jobs') {
                $query->where('job_type', '=', $type);
            }
        } else {
            $query = DB::table('ads')->select('ads.id as ad_ad_id', 'ads.status', 'ads.ad_type')
                ->where('ads.status', '=', $status)->where('user_id', '=', Auth::id());
        }

        $html = "";
        $ads = $query->orderByDesc('ads.updated_at')->get();
        if(count($ads)>0) {
            foreach ($ads as $ad) {
                $ad = Ad::find($ad->ad_ad_id);
                if($ad){
                    if ($ad->ad_type == 'job') {
                        $job = $ad->job;
                        if (!empty($job)) {
                            $html .= view('user-panel.partials.templates.myads-job', compact('job'))->render();
                        }
                    } else {
                        $html.= view('user-panel.partials.templates.myads-property', compact('ad'))->render();
                    }
                }

            }
        }
        else {
            $html = '<div class="row alert alert-warning no-ads dme-tab-content" style="" data-id="no-ads">
                        <h3 class=" text-center col-md-12">Du har ingen annonser.</h3>
                        <h5 class=" text-center col-md-12">Dine andre annonser kan du finne ved å endre på filteret.</h5>
                    </div>';
        }
        exit($html);
    }

    // Show the options against an ad
    public function ad_option($id){
        $ad = Ad::find($id);
        if($ad){
            if($ad->user_id == Auth::id() || Auth::user()->hasRole('admin')){
                return view('user-panel.my-business.my_ads_options',compact('ad'));
            }else{
                return redirect('forbidden');
            }
        }else{
            abort(404);
        }
    }

    // Mark as sold an ad
    public function ad_sold($id){
        $ad = Ad::find($id);
        if($ad){
            if($ad->user_id == Auth::id() || Auth::user()->hasRole('admin')){
                $ad->sold_at = date('Y-m-d G:i');
                $ad->status = 'sold';
                $ad->update();
                return back();
            }else{
                return redirect('forbidden');
            }
        }else{
            abort(404);
        }
    }


    // Static of an ad
    public function ad_statistics(Request $request,$id){
        $ad = Ad::find($id);
        $date = new DateTime();
        $dateMinus12 = $date->modify("-12 months");
        $compare_date = $dateMinus12->format("Y-m-t");

        if($request->type == '15_days_clicks'){
            $compare_date = (date("Y-m-d", strtotime("-15 day")));
        }
        if($ad){
            if($ad->user_id == Auth::id() || Auth::user()->hasRole('admin')){
                $count_favorite = Favorite::where('ad_id',$ad->id)->count();
                $count_thread = MessageThread::where('ad_id',$ad->id)->count();

                // find users that have been click on ad just one time
                $once_click_users = DB::table('ad_views')->selectRaw('user_id, count(ad_id) as count_view, count(user_id) as count_user')
                    ->where('ad_id',$id)
                    ->whereNotNull('user_id')
                    ->havingRaw('count_user = 1')
                    ->groupBy('ad_id','user_id')
                    ->get();

                // find users that have been click on ad two to five times
                $two_to_five_time_click_users = DB::table('ad_views')->selectRaw('user_id, count(ad_id) as count_view, count(user_id) as count_user')
                    ->where('ad_id',$id)
                    ->whereNotNull('user_id')
                    ->havingRaw('count_user > 1 AND count_user < 6')
                    ->groupBy('ad_id','user_id')
                    ->get();

                // find users that have been click on ad more than five times
                $more_than_five_time_click_users = DB::table('ad_views')->selectRaw('user_id, count(ad_id) as count_view, count(user_id) as count_user')
                    ->where('ad_id',$id)
                    ->whereNotNull('user_id')
                    ->havingRaw('count_user > 5')
                    ->groupBy('ad_id','user_id')
                    ->get();

                // find last year ad views
                $ad_views = DB::table('ad_views')->selectRaw('year(created_at) year, monthname(created_at) month, count(ad_id) as count_view')
                    ->whereDate('created_at','>',$compare_date)
                    ->where('ad_id',$id)
                    ->groupBy('year', 'month')
                    ->get();

                // find last 15 days ad views
                if($request->type == '15_days_clicks'){
                    $ad_views = DB::table('ad_views')->selectRaw("COUNT(ad_id) as count_view, date(created_at) date ")
                        ->where('ad_id',$id)
                        ->whereDate('created_at','>',$compare_date)
                        ->groupBy('date')
                        ->get();
                }

                $total_clicks = 0;
                if($ad_views->count() > 0){
                    foreach ($ad_views as $ad_view){
                        $total_clicks = $total_clicks + $ad_view->count_view;
                    }
                }

                if($request->ajax()){
//                    return response(json_encode($ad_views,$total_clicks));
                    return response(json_encode(array('ad_views'=>$ad_views,'total_clicks'=>$total_clicks)));
                    exit();
                }

                return view('user-panel.my-business.ads_statistics',compact('count_favorite','count_thread','ad','ad_views','once_click_users','more_than_five_time_click_users','two_to_five_time_click_users','total_clicks'));
            }else{
                return redirect('forbidden');
            }
        }else{
            abort(404);
        }

    }

}
