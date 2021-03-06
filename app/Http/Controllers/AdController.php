<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Helpers\common;
use App\MessageThread;
use App\Models\Ad;
use App\Models\AdView;
use App\Notification;
use App\User;
use App\UserRatingReview;
use Carbon\Traits\Date;
use DateTime;
use http\Message\Body;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Stmt\DeclareDeclare;
use Pusher\Pusher;
use test\Mockery\ReturnTypeObjectTypeHint;
use function foo\func;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\Mail;

class AdController extends Controller
{
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
    }
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

    public function my_ads($status = [],Request $request)
    {
        DB::enableQueryLog();
        $my_ads = Ad::where('user_id', Auth::user()->id)->where('status','=','published')->orderByDesc('ads.updated_at')->paginate(10);

        $property_for_rent = Ad::where('ad_type','property_for_rent')->where('status','published')->where('user_id',Auth::user()->id)->count();
        $property_for_sale = Ad::where('ad_type','property_for_sale')->where('status','published')->where('user_id',Auth::user()->id)->count();
        $holiday_home_for_sale = Ad::where('ad_type','property_holiday_home_for_sale')->where('status','published')->where('user_id',Auth::user()->id)->count();
        $property_commercial_for_sale = Ad::where('ad_type','property_commercial_for_sale')->where('status','published')->where('user_id',Auth::user()->id)->count();
        $property_commercial_for_rent = Ad::where('ad_type','property_commercial_for_rent')->where('status','published')->where('user_id',Auth::user()->id)->count();
        $property_commercial_plots = Ad::where('ad_type','property_commercial_plots')->where('status','published')->where('user_id',Auth::user()->id)->count();
        $property_business_for_sale = Ad::where('ad_type','property_business_for_sale')->where('status','published')->where('user_id',Auth::user()->id)->count();
        $property_flat_wishes_rented = Ad::where('ad_type','property_flat_wishes_rented')->where('status','published')->where('user_id',Auth::user()->id)->count();
        $all_ads_count = Ad::where('status','published')->where('user_id',Auth::user()->id)->count();

        $full_time_job = Ad::join('jobs','jobs.ad_id','ads.id')->where('jobs.job_type','full_time')->where('ads.status','published')->where('ads.ad_type','job')->where('ads.user_id',Auth::user()->id)->count();
        $part_time_job = Ad::join('jobs','jobs.ad_id','ads.id')->where('jobs.job_type','part_time')->where('ads.status','published')->where('ads.ad_type','job')->where('ads.user_id',Auth::user()->id)->count();
        $management_job = Ad::join('jobs','jobs.ad_id','ads.id')->where('jobs.job_type','management')->where('ads.status','published')->where('ads.ad_type','job')->where('ads.user_id',Auth::user()->id)->count();

        if ($request->ajax()) {
    	$view = view('user-panel.my-business.my_ads_inner',compact('my_ads'))->render();
            return response()->json(['html'=>$view]);
        }


        return view('user-panel/my-business.my_ads', compact('my_ads','all_ads_count','property_for_rent','property_business_for_sale','property_for_sale'
        ,'holiday_home_for_sale','property_commercial_for_rent','property_commercial_for_sale','property_commercial_plots','property_flat_wishes_rented',
            'full_time_job','part_time_job','management_job'));

    }

    public function filter_my_ads($status, $ad_type)
    {
        if($status == 'expired'){
            $status = array('sold','deactivate');//'sold';
        }else{
            $status = array($status);
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
                ->whereIn('ads.status', $status)
                ->where('ads.user_id', '=', Auth::id())
                ->whereNull('ads.deleted_at');
            if ($table == 'jobs') {
                $query->where('job_type', '=', $type)->where('ads.ad_type','job');
            }
        } else {
            $query = DB::table('ads')->select('ads.id as ad_ad_id', 'ads.status', 'ads.ad_type')
                ->whereIn('ads.status', $status)->where('user_id', '=', Auth::id())
                ->whereNull('ads.deleted_at');
        }

        $html = "";
        $ads = $query->orderByDesc('ads.updated_at')->paginate(10);
      
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
         
            // $html = '<div class="row alert alert-warning no-ads dme-tab-content" style="" data-id="no-ads">
            //             <h3 class=" text-center col-md-12">Du har ingen annonser.</h3>
            //             <h5 class=" text-center col-md-12">Dine andre annonser kan du finne ved å endre på filteret.</h5>
            //         </div>';
            $html='';
        }

        $property_for_rent = Ad::where('ad_type','property_for_rent')->whereIn('status',$status)->where('user_id',Auth::user()->id)->count();
        $property_for_sale = Ad::where('ad_type','property_for_sale')->whereIn('status',$status)->where('user_id',Auth::user()->id)->count();
        $holiday_home_for_sale = Ad::where('ad_type','property_holiday_home_for_sale')->whereIn('status',$status)->where('user_id',Auth::user()->id)->count();
        $property_commercial_for_sale = Ad::where('ad_type','property_commercial_for_sale')->whereIn('status',$status)->where('user_id',Auth::user()->id)->count();
        $property_commercial_for_rent = Ad::where('ad_type','property_commercial_for_rent')->whereIn('status',$status)->where('user_id',Auth::user()->id)->count();
        $property_commercial_plots = Ad::where('ad_type','property_commercial_plots')->whereIn('status',$status)->where('user_id',Auth::user()->id)->count();
        $property_business_for_sale = Ad::where('ad_type','property_business_for_sale')->whereIn('status',$status)->where('user_id',Auth::user()->id)->count();
        $property_flat_wishes_rented = Ad::where('ad_type','property_flat_wishes_rented')->whereIn('status',$status)->where('user_id',Auth::user()->id)->count();
        $all_ads_count = Ad::whereIn('status',$status)->where('user_id',Auth::user()->id)->count();

        $full_time_job = Ad::join('jobs','jobs.ad_id','ads.id')->where('jobs.job_type','full_time')->whereIn('ads.status',$status)->where('ads.ad_type','job')->where('ads.user_id',Auth::user()->id)->count();
        $part_time_job = Ad::join('jobs','jobs.ad_id','ads.id')->where('jobs.job_type','part_time')->whereIn('ads.status',$status)->where('ads.ad_type','job')->where('ads.user_id',Auth::user()->id)->count();
        $management_job = Ad::join('jobs','jobs.ad_id','ads.id')->where('jobs.job_type','management')->whereIn('ads.status',$status)->where('ads.ad_type','job')->where('ads.user_id',Auth::user()->id)->count();

        $ads_count = array('total_ads'=>$all_ads_count,'property_for_rent'=>$property_for_rent,'property_for_sale'=>$property_for_sale,'property_holiday_home_for_sale'=>$holiday_home_for_sale,
            'property_commercial_plots'=>$property_commercial_plots, 'property_commercial_for_sale'=>$property_commercial_for_sale,'property_commercial_for_rent'=>$property_commercial_for_rent,
            'full_time_job'=>$full_time_job,'part_time_job'=>$part_time_job,'management_job'=>$management_job,
            'property_business_for_sale'=>$property_business_for_sale,'property_flat_wishes_rented'=>$property_flat_wishes_rented,'html'=>$html);

        return $ads_count;
        exit();
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
    public function ad_sold($id,Request $request){
        $ad = Ad::find($id);
        if($ad){
            if($ad->ad_type != 'job' && ($ad->user_id == Auth::id() || Auth::user()->hasRole('admin'))){
                $ad->sold_at = date('Y-m-d G:i');
                $ad->status = 'sold';
                $ad->update();
                common::fav_mark_sold_notification($ad, $this->pusher);
                Session::flash('success','Annonsen er oppdatert.');
                return Redirect::back()->with('error_code', 5);
            }else{
                return redirect('forbidden');
            }
        }else{
            abort(404);
        }
    }


    //Ad user in sold ads like as buyer of this ad
    public function add_buyer_in_sold_ad($id,Request $request){
        $ad = Ad::find($id);
        if($ad){
            if($ad->ad_type != 'job' && ($ad->user_id == Auth::id() || Auth::user()->hasRole('admin'))) {
                if($request->user_id){
                    $ad->sold_to_user()->attach($request->user_id);

                    // Send notification to buyer
                    $user_name = ($ad->user->first_name || $ad->user->last_name) ? $ad->user->first_name.' '.$ad->user->last_name : 'NH-Bruker';
                    $notif = new Notification(['notifiable_type' => Ad::class, 'type' => 'ad_sold', 'user_id' => $request->user_id, 'notifiable_id' => $ad->id, 'data' => $user_name.' har valgt deg til å være kjøper av denne annonsen. Nå kan du gi din vurdering til vedkommende.']);
                    $notif->save();

                    $data = array('detail' => 'Velg som kjøper', 'to_user_id' => $request->user_id,'id' => $notif->id);
                    $this->pusher->trigger('notification', 'notification-event', $data);

                    // Send email notification to buyer
                    $text = $user_name.' har valgt deg til å være kjøper av denne annonsen. Nå kan du gi din vurdering til vedkommende. Her er koblingen til annonsen.';
                    $link = url('/',$ad->id);
                    $subject = 'Velg som kjøper';
                    $user_obj = User::find($request->user_id);
                    $to_name = $user_obj->username;
                    $to_email = $user_obj->email;
                    Mail::send('mail.property_email_notification',compact('text','link','user_obj'), function ($message) use ($to_name, $to_email,$subject) {
                        $message->to($to_email, $to_name)->subject($subject);
                        $message->from('developer@digitalmx.no', 'NorgesHandel');
                    });

                    Session::flash('success','Kjøperen er lagt til.');
                    return redirect(url('my-business/my-ads/'.$ad->id.'/ratings'));
//                    return Redirect::back()->with('error_code', 6);
                }
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
        $compare_date = $dateMinus12->format("Y-m-d");

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
                $ad_views = DB::table('ad_views')->select(DB::raw('count(ad_id) as count_view'),DB::raw('YEAR(created_at) year'),DB::raw('MONTH(created_at) month_no'),DB::raw('MONTHName(created_at) month'))
                    ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'), DB::raw('MONTHName(created_at)'))
                    ->where('ad_id',$id)
                    ->whereDate('created_at','>',$compare_date)
                    ->get();
                /*
                $ad_views = DB::table('ad_views')->selectRaw("year(created_at) year, monthname(created_at) month, count(ad_id) as count_view,DATE_FORMAT(created_at, '%m-%Y') new_date ")
                    ->whereDate('created_at','>',$compare_date)
                    ->where('ad_id',$id)
                    ->groupBy('year','month','new_date')
                    ->get();
                */

                // find last 15 days ad views
                if($request->type == '15_days_clicks'){
                    $ad_views = DB::table('ad_views')->selectRaw("COUNT(ad_id) as count_view, date(created_at) date ")
                        ->where('ad_id',$id)
                        ->whereDate('created_at','>',$compare_date)
                        //->whereDate('created_at','<=',date('Y-m-d'))
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


    // Change the visibility of an ad from the ad option
    public function update_ad_visibility(Request $request){
        if($request->ad_id){
            $ad = Ad::find($request->ad_id);
            if($ad && ($ad->user_id == Auth::id() || Auth::user()->hasRole('admin'))){
                try {
                    $visibility = 1;
                    $message = 'Annonsen din er nå synlig.';
                    if($ad->visibility == 1){
                        $visibility = 0;
                        $message = 'Annonsen din er skjult nå.';
                    }
                    $ad->visibility = $visibility;
                    $ad->update();
                    DB::commit();
                    Session::flash('success', $message);
                    return back();

                } catch (\Exception $e) {
                    DB::rollback();
                    Session::flash('danger', 'Noe gikk galt.');
                    return back();
                }
            }else{
                return back();
            }
        }else{
            return back();
        }
    }

    //Reactivate the expire ads
    public function reactivate_ad($id,Request $request){
        if($id){
            $ad = Ad::find($id);
            if($ad && ($ad->user_id == Auth::id() || Auth::user()->hasRole('admin'))){
                try {
                    //For free ads
                    if($ad->ad_type != 'property_for_rent' && $ad->ad_type != 'property_flat_wishes_rented'){
                        $ad_expiry_response = common::create_update_ad_expiry($ad,$request->all());
                    }else{ // for paid ads like properties and job ads
                        $ad_expiry_response = common::create_update_ad_expiry_for_free_ads($ad);
                    }

                    if(!$ad_expiry_response['flag']){
                        DB::rollback();
                        Session::flash('danger', $ad_expiry_response['message']);
                        return back();
                    }

                    $ad->status = 'published';
                    $ad->update();
                    DB::commit();
                    Session::flash('success', 'Nå er annonsen din publisert.');
                    return back();

                } catch (\Exception $e) {
                    DB::rollback();
                    Session::flash('danger', 'Noe gikk galt.');
                    return back();
                }
            }else{
                return back();
            }
        }else{
            return back();
        }
    }

}
