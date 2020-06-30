<?php

namespace App\Http\Controllers\Admin\Jobs;

use App\Models\Company;
use App\Notification;
use App\Term;
use App\User;
use App\Media;
use App\Models\Ad;
use App\Models\Search;
use App\Admin\Jobs\Job;
use App\Helpers\common;
use http\QueryString;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Intervention\Image\AbstractDecoder;
use App\Http\Controllers\Admin\Users\AdminUserController;
use Pusher\Pusher;
use const http\Client\Curl\AUTH_ANY;
use Illuminate\Support\Facades\Mail;

//use function Sodium\compare;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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

    public function index(Request $request)
    {
        if (request()->route()->getPrefix() == '/admin') {
            $ads = Ad::where('ad_type','job')->orderBy('published_on','DESC')->get();
            if($request->trashed){
                $ads = Ad::where('ad_type','job')->onlyTrashed()->orderBy('published_on','DESC')->get();
            }
            return response()->view('admin.jobs.jobs', compact('ads'));
        }

        $saved_search = null;
        $recent_search = null;
        if (Auth::check()) {
            $saved_search = Search::where('type', 'saved')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->limit(5)->get();
            $recent_search = Search::where('type', 'recent')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->limit(5)->get();
        }

        $date = Date('y-m-d',strtotime('-7 days'));

        $ads = Ad::where('ad_type', 'job')->where(function ($query) use ($date){
            $query->where('ads.status', 'published')
                ->orwhereDate('ads.sold_at','>',$date);
        })->where('visibility',1)
            ->orderBy('published_on', 'desc')
            ->paginate(getenv('PAGINATION'));;
        $management_jobs = Ad::join('jobs','ads.id','jobs.ad_id')
            ->where(function ($query) use ($date){
                $query->where('ads.status', 'published')
                    ->orwhereDate('ads.sold_at','>',$date);
            })->where('ads.visibility',1)->where('jobs.job_type','management')->paginate(getenv('PAGINATION'));
        $companies = Company::where('company_type','Jobb')->get();
        return response()->view('user-panel.jobs.jobs', compact('ads', 'recent_search','saved_search','management_jobs','companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type = '')
    {
        $view = 'new_';
        if ($type == 'full_time' ||
            $type == 'part_time' ||
            $type == 'management') {
            return view('admin.jobs.new_' . $type);
        } else {
            return view('admin.jobs.jobs_select_category');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ad_id = '';
        if ($request->ad_id && !empty($ad->id)) {
            $ad_id = $request->ad_id;
        }
        if ($request->file('files')) {
            return $this->upload_images($request, $ad_id);
        }

        $arr = array(
            'name' => $request->name,
            'title' => $request->title,
            'job_type' => $request->job_type,
            'positions' => $request->positions,
            'commitment_type' => $request->commitment_type,
            'sector' => $request->sector,
            'leadership_category' => $request->leadership_category,
            'job_function' => $request->job_function,
            'industry' => $request->industry,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'accession' => $request->accession,
            'emp_name' => $request->emp_name,
            'emp_company_information' => $request->emp_company_information,
            'emp_website' => $request->emp_website,
            'emp_facebook' => $request->emp_facebook,
            'emp_linkedin' => $request->emp_linkedin,
            'emp_twitter' => $request->emp_twitter,
            'country' => $request->country,
            'zip' => $request->zip,
            'address' => $request->address,
            'workplace_video' => $request->workplace_video,
            'app_receive_by' => $request->app_receive_by,
            'app_link_to_receive' => $request->app_link_to_receive,
            'app_email_to_receive' => $request->app_email_to_receive,
            'app_contact' => $request->app_contact,
            'app_contact_title' => $request->app_contact_title,
            'app_mobile' => $request->app_mobile,
            'app_phone' => $request->app_phone,
            'app_email' => $request->app_email,
            'app_linkedin' => $request->app_linkedin,
            'app_twitter' => $request->app_twitter,
        );

        $ad = Ad::find($request->ad_id);
        if($ad){
            common::sync_ad_agents($ad,$request->agent_id);
        }
        $published_date = date("Y-m-d H:i:s");

        if($ad && $ad->job && $ad->job->company && $ad->job->company->full_address && $ad->job->company->latitude && $ad->job->company->longitude){
            $arr['latitude'] = $ad->job->company->latitude;
            $arr['longitude'] = $ad->job->company->longitude;
            $arr['full_address'] = $ad->job->company->full_address;
        }


        $ad->job->update($arr);

        if ($ad && $ad->status == 'saved') {
            $ad_expiry_response = common::create_update_ad_expiry($ad,$request->all());
            if(!$ad_expiry_response['flag']){
                echo json_encode($ad_expiry_response);
                exit();
            }

            $ad->update(['status' => 'published', 'published_on' => $published_date]);
        }
     
        if ($request->file('company_logo')) {
            $file = $request->file('company_logo');
            common::update_media($file, $ad->id, 'App\Models\Ad', 'logo');
        }

        //notification bellow
        common::send_search_notification($ad->job, 'saved_search', 'Søk varsel: ny annonse', $this->pusher, 'jobs/search',$ad);
        //end notification

        $terms = Term::find([$request->industry, $request->job_function]);
        $ad->job->terms()->detach();
        $ad->job->terms()->attach($terms);
        return json_encode([
            'success'=>'true',
            'status' => $ad->status
        ]);

    }


    public function upload_images($request, $ad_id=''){
        $mediable_id = '';
        $ad_status = '';
        if ($request->ad_id) {
            $ad = Ad::find($request->ad_id);
            $ad_status = $ad && $ad->status ? $ad->status : '';
            $mediable_id = $request->ad_id;
        }
        if ($request->file('files')) {
            $files = $request->file('files');
            if ($mediable_id && $ad_status == 'saved') {
                return common::update_media($files, $mediable_id, 'App\Models\Ad', 'gallery', 'false');
            } else {
                return common::update_media($files, Auth::user()->id, $request->upload_dropzone_images_type, 'gallery', 'false');
            }
        }
//        if(empty($ad_id)){
//            if($request->ad_id){
//                $ad_id = $request->ad_id;
//            }
//        }
//        if ($request->file('files')) {
//            $files = $request->file('files');
//            if($ad_id){
//                return common::update_media($files, $ad_id, 'App\Models\Ad', 'gallery','false');
//            }else{
//                return common::update_media($files, Auth::user()->id, 'temp_job_image', 'gallery','false');
//            }
//        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    // public function store_dummy(Request $request)
    // {
    //     $ad = new Ad(['ad_type' => 'job', 'status' => 'saved', 'user_id' => Auth::user()->id]);
    //     $ad->save();
    //     $job = new Job(['job_type' => $request->job_type, 'user_id' => Auth::user()->id]);
    //     $ad->job()->save($job);
    //     $ids = ['ad_id' => $ad->id, 'job_id' => $ad->job->id];
    //     return response(json_encode($ids));
    // }

    public function new_job(Request $request)
    {   
        $type = '';
         if($request->is('*/full_time')){
            $type = 'full_time';
         }else if($request->is('*/management')){
            $type = 'management';
         }else if($request->is('*/part_time')){
            $type = 'part_time';
         }
        if($type){

            DB::beginTransaction();
            try{
                $company_id = 0;
                if(Auth::user()->hasRole('agent')){
                    $company_id = Auth::user()->created_by_company_id;
                }
                if(Auth::user()->hasRole('company') && Auth::user()->job_companies->first() && Auth::user()->job_companies->first()->id){
                    $company_id = Auth::user()->job_companies->first()->id;
                }
                $auth_id = Auth::user()->id;
                $ad = new Ad(['ad_type' => 'job', 'status' => 'saved', 'user_id' => $auth_id]);
                $ad->save();
                if ($ad) {
                    $job = new Job(['job_type' => $type, 'user_id' => $auth_id, 'company_id'=>$company_id]);
                    $ad->job()->save($job);
                    if ($job) {
                        DB::commit();
                        return redirect(url('complete/job/' . $ad->id))->with('type',$type);
                    } else {
                        DB::rollback();
                        abort(404);
                    }
                } else {
                    DB::rollback();
                    abort(404);
                }
            }catch (\Exception $e){
                DB::rollback();
                abort(404);
            }

    } else {
            abort(404);
        }
    }

    public function complete_job($id){
        $ad_type = session('type');
        $ad = Ad::find($id);
        if ($ad) {
            if ($ad->ad_type == 'job' && $ad_type == 'full_time') {
                common::delete_media(Auth::user()->id, 'temp_job_image', 'gallery');
                $job = $ad->job;
                if ($job) {
                    Session::forget('type');
                    $ad_type='';
                    return view('user-panel.jobs.new_full_time', compact('job'));
                }
            } else if ($ad->ad_type == 'job' && $ad_type == 'part_time') {
                common::delete_media(Auth::user()->id, 'temp_job_image', 'gallery');
                $job = $ad->job;
                Session::forget('type');
                $ad_type = '';
                return view('user-panel.jobs.new_part_time', compact('job'));
            } else if ($ad->ad_type == 'job' && $ad_type == 'management') {
                common::delete_media(Auth::user()->id, 'temp_job_image', 'gallery');
                $job = $ad->job;
                Session::forget('type');
                $ad_type = '';
                return view('user-panel.jobs.new_management', compact('job'));
            }
            
             else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Admin\Jobs\Job $job ->id
     * @return \Illuminate\Http\Response
     */
    public function update_dummy(Request $request,$call_by = '')
    {
        foreach ($request->all() as $key=>$value){
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
            }
        }
        $job_temp_media = Media::where('mediable_id',Auth::user()->id)->where('mediable_type','temp_job_image')->get();
        if($job_temp_media->count() > 0 && $request->ad_id){
            foreach ($job_temp_media as $key=>$job_temp_media_obj){
                $job_temp_media_obj->mediable_id = $request->ad_id;
                $job_temp_media_obj->mediable_type = 'App\Models\Ad';
                $job_temp_media_obj->update();
            }
        }

        $job_id = $request->job_id;
        $job = Job::where('id', $job_id)->first();
        $arr = array(
            'name' => $request->name,
            'title' => $request->title,
            'job_type' => $request->job_type,
            'positions' => $request->positions,
            'commitment_type' => $request->commitment_type,
            'sector' => $request->sector,
            'leadership_category' => $request->leadership_category,
            'job_function' => $request->job_function,
            'industry' => $request->industry,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'accession' => $request->accession,
            'emp_name' => $request->emp_name,
            'emp_company_information' => $request->emp_company_information,
            'emp_website' => $request->emp_website,
            'emp_facebook' => $request->emp_facebook,
            'emp_linkedin' => $request->emp_linkedin,
            'emp_twitter' => $request->emp_twitter,
            'country' => $request->country,
            'zip' => $request->zip,
            'zip_city' => $request->zip_city,
            'address' => $request->address,
            'workplace_video' => $request->workplace_video,
            'app_receive_by' => $request->app_receive_by,
            'app_link_to_receive' => $request->app_link_to_receive,
            'app_email_to_receive' => $request->app_email_to_receive,
            'app_contact' => $request->app_contact,
            'app_contact_title' => $request->app_contact_title,
            'app_mobile' => $request->app_mobile,
            'app_phone' => $request->app_phone,
            'app_email' => $request->app_email,
            'app_linkedin' => $request->app_linkedin,
            'app_twitter' => $request->app_twitter,
//            'user_id' => Auth::user()->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'full_address' => $request->full_address,
        );


        if($job && $job->company && $job->company->full_address && $job->company->latitude && $job->company->longitude){
            $arr['latitude'] = $job->company->latitude;
            $arr['longitude'] = $job->company->longitude;
            $arr['full_address'] = $job->company->full_address;
        }

        $job->update($arr);
        $company_logo_id = '';
        if ($request->file('company_logo')) {
            $file = $request->file('company_logo');
            $company_logo = common::update_media($file, $job->ad->id, 'App\Models\Ad', 'logo');
            $company_logo_id = $company_logo['file_names'][0];
        }
        if($job->ad){
            common::sync_ad_agents($job->ad,$request->agent_id);
        }
        $ids = ['ad_id' => $request->ad_id, 'job_id' => $request->job_id,'company_logo_id'=>$company_logo_id];
        if ($call_by) {
           return $ids;
        } else {
            echo json_encode($ids);
            exit();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Admin\Jobs\Job $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $prev = common::previous_ad($job);
        $next = common::next_ad($job);
        return view('user-panel/jobs/single', compact('job', 'prev', 'next'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Admin\Jobs\Job $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        common::delete_media(Auth::user()->id, 'job_temp_images', 'gallery');
        if(!Auth::user()->hasRole('admin') && $job->user_id != Auth::id()){
            return redirect('forbidden');
        }
        if (request()->route()->getPrefix() == '/admin') {
            return view('admin.jobs.new_' . $job->job_type, compact('job'));
        }
        return view('user-panel.jobs.new_' . $job->job_type, compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Admin\Jobs\Job $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if($request->job_id){
            $job = Job::find($request->job_id);
        }
        if ($request->file('files')) {
            return $this->upload_images($request,$request->ad_id);
        }
        try{
            $call_by = '';
            if($request->click_button && $request->click_button == 'yes'){
                $call_by  = 'controller';
            }
            $ids = $this->update_dummy($request,$call_by);
            if($job && $job->ad && $job->ad->status == 'saved'){
                $ad_expiry_response = common::create_update_ad_expiry($job->ad,$request->all());
                if(!$ad_expiry_response['flag']){
                    echo json_encode($ad_expiry_response);
                    exit();
                }
                $published_date = date("Y-m-d H:i:s");
                $response = $job->ad->update(['status'=>'published', 'published_on' => $published_date]);
            }
            $media = common::updated_dropzone_images_type($request->all(),'job_temp_images',$job->ad->id);
            if($request->media_position){
                $media_position = common::update_media_position($request->media_position);
            }
            if($request->deleted_media){
                $delete_media = common::delete_json_media($request->deleted_media);
            }
            $message = 'Annonsen din er oppdatert.';
            $ad = $job->ad();
//            DB::commit();

            //notification bellow
            common::send_search_notification($job, 'saved_search', 'Søk varsel: ny annonse', $this->pusher, 'jobs/search',$ad);

            //Send company followers job notifications
            if($job->ad && $job->company_id){
                common::job_preferences_notifications($job->ad,$this->pusher);
            }

            $msg['message'] = $message;
            $msg['status'] = $job->ad->status;
            $msg['company_logo_id']  = $ids['company_logo_id'];
            echo json_encode($msg);

        }catch (\Exception $e){

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Admin\Jobs\Job $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        if($job){
            if(!Auth::user()->hasRole('admin') && $job->user_id != Auth::id()){
                return redirect('forbidden');
            }
            DB::beginTransaction();
            try{
                $ad_id = $job->ad->id;
                $job->ad()->delete();
                $job->delete();
                //common::delete_media($ad_id, Ad::class, 'logo');
                //common::delete_media($ad_id, Ad::class, 'gallery');
                DB::commit();
                Session::flash('success', 'Jobben er slettet');
                if (request()->route()->getPrefix() == '/admin') {
                    return back();
                }
                return redirect(url('my-business/my-ads'));
            }catch (\Exception $e){
                DB::rollback();
                Session::flash('danger', 'Noe gikk galt.');
                return back();
            }
        }else{
            abort(404);
            Session::flash('danger', 'Noe gikk galt.');
            return back();
        }
    }


    public function restore($id){
        if($id){
            $job = Job::where('id',$id)->withTrashed()->first();
            if($job){
                if(!Auth::user()->hasRole('admin') && $job->user_id != Auth::id()){
                    return redirect('forbidden');
                }
                DB::beginTransaction();
                try{
                    $job->ad()->restore();
                    $job->restore();
                    DB::commit();
                    Session::flash('success', 'Jobben er gjenopprettet');
                    return back();
                }catch (\Exception $e){
                    DB::rollback();
                    Session::flash('danger', 'Noe gikk galt.');
                    return back();
                }
            }else{
                abort(404);
                Session::flash('danger', 'Noe gikk galt.');
                return back();
            }
        }
    }

    /**
     * Change status of Ad.
     *
     * @param \App\Admin\Jobs\Job $job
     * @return \Illuminate\Http\Response
     */
    public function status_change(Ad $ad, $status)
    {
//        $status = '';
        if ($status == 'draft' ||
            $status == 'pending' ||
            $status == 'published') {
            $ad = Ad::where('id', $ad->id)->first();
            $ad->status = $status;
            $ad->update();
            session()->flash('success', 'Status er oppdatert');
        } else {
            session()->flash('danger', 'Ikke gyldig status!');
        }
        return back();
    }

    /**
     * Change status of Ad.
     *
     * @param \App\Admin\Jobs\Job $job
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $date = Date('y-m-d',strtotime('-7 days'));

        $jobs = DB::table('ads')
            ->join('jobs', 'ads.id', '=', 'jobs.ad_id')
//            ->where('ads.status', '=', 'published')
            ->where('ads.ad_type', '=', 'job')
            ->whereNull('jobs.deleted_at')
            ->whereNull('ads.deleted_at')
            ->where('ads.visibility','=',1)
            ->where(function ($query) use ($date){
                $query->where('ads.status', 'published')
                    ->orwhereDate('ads.sold_at','>',$date);
            })->orderBy('ads.published_on','DESC')->limit(getenv('PAGINATION'))->get();
        return response()->view('user-panel.jobs.jobs_filter_page', compact('jobs'));
    }

    //Show more ads by a company
    public function company_more_ads($id){
        $pagination = 20;
        if(getenv('PAGINATION')){
            $pagination = getenv('PAGINATION');
        }
        $date = Date('y-m-d',strtotime('-7 days'));

        $jobs = DB::table('ads')
            ->join('jobs', 'ads.id', '=', 'jobs.ad_id')
//            ->where('ads.status', '=', 'published')
            ->where('ads.ad_type', '=', 'job')
            ->whereNull('jobs.deleted_at')
            ->whereNull('ads.deleted_at')
            ->where('ads.visibility','=',1)
            ->where('jobs.company_id',$id)
            ->where(function ($query) use ($date){
                $query->where('ads.status', 'published')
                    ->orwhereDate('ads.sold_at','>',$date);
            })->orderBy('ads.published_on','DESC')->limit($pagination)->get();
        return response()->view('user-panel.jobs.jobs_filter_page', compact('jobs'));
    }

    public function count(){

    }

    public function mega_menu_search(Request $request, $is_notif = false, $after_created = null)
    {
        $req = $request->query;
        $filter = 'jobs/search?';
        foreach ($req as $key=>$value){
           if(is_countable($value) && count($value)){
              foreach($value as $value_obj){
                  $filter.=$key.'='.$value_obj.'&';
              }
           }else{
               if($value){
                   $filter.=$key.'='.$value.'&';
               }
           }
        }

        $filter = rtrim($filter, '&');
        if (!$is_notif && Auth::check()) {
            $search = Auth::user()->saved_searches()->where('filter', '=', $filter)->get();
            foreach ($search as $value) {
                foreach ($value->unread_notifications as $notification) {
                    $notification->update(['read_at' => now()]);
                }
            }
        }

        $view = $request->view;
        $sort = $request->sort;
        $arr = Arr::only($request->all(), ['job_function', 'industry', 'country', 'commitment_type', 'job_type',
            'sector', 'leadership_category']);
        $date = Date('y-m-d',strtotime('-7 days'));
        $query = DB::table('ads')
            ->join('jobs', 'jobs.ad_id', '=', 'ads.id')
            ->join('users', 'jobs.user_id', '=','users.id')
            ->where('ads.visibility', '=', 1)
            ->where('ads.ad_type', '=', 'job')
            ->whereNull('ads.deleted_at')
            ->whereNull('jobs.deleted_at')
            ->select('jobs.*')
            ->where(function ($query) use ($date){
                $query->where('ads.status', 'published')
                    ->orwhereDate('ads.sold_at','>',$date);
            });
        $query->where($arr);
        if(isset($request->created_at)){
            $query->whereDate('jobs.created_at', $request->created_at);
        }
        if (isset($request->search) && !empty($request->search)){
            common::table_search($query, common::get_model_columns(Job::class), $request->search, 'jobs');
//            $query->where(function ($query) use ($request){
//                $query->where('jobs.name', 'like', "%".$request->search."%");
//                $query->orWhere('jobs.keywords', 'like', "%".$request->search."%");
//                $query->orWhere('jobs.title', 'like', "%".$request->search."%");
//            });
        }



        if (isset($request->deadline)) {
            if (in_array("today", $request->deadline)) {
                $query = $query->whereNull('jobs.deadline')
                    ->orWhereDate('jobs.deadline', today());
            }
            elseif(in_array("three_days", $request->deadline)) {
                $query = $query->whereNull('jobs.deadline')
                    ->orWhereDate('jobs.deadline', '<', today()->addDays(3));
            }
            elseif(in_array("this_week", $request->deadline)) {
                $query = $query->whereNull('jobs.deadline')
                    ->orWhereDate('jobs.deadline', '<', today()->addDays(7));
            }
        }


        if(isset($sort) && !empty($sort)) {
            switch ($sort){
                case 0:
                    $query->orderBy('ads.updated_at', 'DESC');
//                    $query->orderBy('jobs.updated_at', 'desc');
                    break;
                case 1:
                    $query->orderBy('ads.published_on', 'DESC');
                    break;
                case 2:
                    $query->orderBy('users.first_name', 'asc');
                    break;
                case 3:
                    $query->orderBy('jobs.zip_city', 'asc');
                    break;
                case 4:
                    if(isset($request->lat) && $request->lat && isset($request->lon) && $request->lon){
                        common::find_nearby_ads($request->lat, $request->lon,$query,'jobs');
                    }
                    break;
                default:
                    break;
            }
        }

        if(!isset($request->lat) && !isset($request->lon)) {
            $query->orderBy('ads.published_on', 'DESC');
        }
        if($request->job_type){
            $query = $query->where('jobs.job_type',$request->job_type);

        } //jobtype

        if($request->jobtype){
            $query = $query->whereIn('jobs.job_type',$request->jobtype);
        }
        if (isset($request->map_job_type) && $request->map_job_type) {
            $query = $query->where('jobs.job_type', $request->map_job_type);
        }


        if($is_notif){
            if (!empty($after_created)){
                $query->where('ads.created_at', '>', $after_created);
            }
            $jobs = $query->get();
            return $jobs;
        }
        $jobs = $query->get();

             //Job Map Filters
       if ($request->ajax()) {
             if(isset($request->map) && $request->map){
                $query->select(['jobs.name AS ad_heading', 'jobs.*']);
                $all_ads = common::propertyMapFilters($query);
                 return response()->json(['data'=>$all_ads]);
             }
        }

        $html = view('user-panel.jobs.jobs_filter_page_inner', compact('jobs', 'view', 'sort'))->render();
        exit($html);
    }

    public function sort(Request $request)
    {
        $sortings = [
            "0" => 'Most relevent',
            "1" => "Published",
            "2" => "Employer",
            "3" => "Place",
            "4" => "Closest",
        ];
        $filters = $request->all();
        $ads = Ad::where(['status' => 'published', 'ad_type' => 'job'])->get();
        if (is_array($filters) && !empty($filters)) {
            $ads = Ad::where(['status' => 'published', 'ad_type' => 'job'])->get();
        }
        return response()->view('user-panel.jobs.jobs_filter_page', compact('ads', 'filters'));
    }

    public function sort_jobs($job_type, $orderBy = 0)
    {
        $jobs = DB::table('ads')->join('jobs', 'jobs.id', '=', 'ads.id')
            ->where('ads.status', 'published')
            ->orderByDesc('ads.updated_at')->get();

        $jobs = Job::where('job_type', $job_type)->orderBy('name', 'asc')->get();
        if ($job_type === 'all') {
            switch ($orderBy) {
                case 1:
                    $jobs = DB::table('ads')->join('jobs', 'jobs.id', '=', 'ads.id')
                        ->where('ads.status', 'published')->orderBy('jobs.updated_at', 'desc')->get();
                    break;
                case 2:
                    $jobs = DB::table('ads')->join('jobs', 'jobs.id', '=', 'ads.id')
                        ->where('ads.status', 'published')->orderBy('jobs.emp_name', 'asc')->get();
                    break;
                case 3:
                    $jobs = DB::table('ads')->join('jobs', 'jobs.id', '=', 'ads.id')
                        ->where('ads.status', 'published')->orderBy('jobs.country', 'asc')->get();
                    break;
                default:
                    $jobs = DB::table('ads')->join('jobs', 'jobs.id', '=', 'ads.id')
                        ->where('ads.status', 'published')->orderBy('jobs.name', 'asc')->get();
            }
        } else {
            switch ($orderBy) {
                case 1:
                    $jobs = DB::table('ads')->join('jobs', 'jobs.id', '=', 'ads.id')
                        ->where('ads.status', 'published')->where('jobs.job_type', $job_type)->orderBy('jobs.updated_at', 'desc')->get();
                    break;
                case 2:
                    $jobs = DB::table('ads')->join('jobs', 'jobs.id', '=', 'ads.id')
                        ->where('ads.status', 'published')->where('jobs.job_type', $job_type)->orderBy('jobs.emp_name', 'asc')->get();
                    break;
                case 3:
                    $jobs = DB::table('ads')->join('jobs', 'jobs.id', '=', 'ads.id')
                        ->where('ads.status', 'published')->where('jobs.job_type', $job_type)->orderBy('jobs.country', 'asc')->get();
                    break;
                default:
                    $jobs = DB::table('ads')->join('jobs', 'jobs.id', '=', 'ads.id')
                        ->where('ads.status', 'published')->where('jobs.job_type', $job_type)->orderBy('jobs.name', 'asc')->get();
            }
        }
        $html = "";
        if (count($jobs) > 0) {
            foreach ($jobs as $filtered_ad) {
                $html .= view('user-panel.partials.templates.job-sequare', compact('filtered_ad'))->render();
            }
        } else {
            $html = '<div class="col-md-12 ml-3 alert alert-warning no-ads dme-tab-content" style="" data-id="no-ads">
                        <h3 class=" text-center">Ingen annonser funnet.</h3>
                    </div>';
        }
        exit($html);
    }
}
