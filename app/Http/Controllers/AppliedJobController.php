<?php

namespace App\Http\Controllers;

use App\Admin\Jobs\Job;
use App\AppliedJob;
use App\Helpers\common;
use App\Models\Cv\Cv;
use App\Models\Cv\CvEducation;
use App\Models\Cv\CvExperience;
use App\Models\Cv\CvPersonal;
use App\Models\Cv\CvPreference;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

class AppliedJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('company')){
            $applied_jobs_cv_list = AppliedJob::whereHas('job', function (Builder $query) {
                $query->where('user_id', Auth::id());
            })->orderBy('id','DESC')->get();

            $shortlisted_applied_jobs_cv_list = AppliedJob::whereHas('job', function (Builder $query) {
                $query->where('user_id', Auth::id());
            })->whereHas('meta', function (Builder $query) {
                $query->where('user_id', Auth::id())->orderBy('id','DESC');
            })->get();

            return view('user-panel.jobs.applied-jobs-cv-list',compact('applied_jobs_cv_list','shortlisted_applied_jobs_cv_list'));
        }else{
            return redirect('forbidden');
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
        $job = Job::find($id);
        if($job){
            return view('user-panel.jobs.apply-job',compact('job'));
        }else{
            abort(404);
        }
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
        $job = Job::find($id);
        if($job){

            $apply_job = AppliedJob::where('user_id',Auth::id())->where('job_id',$job->id)->first();

            if($apply_job){
                session()->flash('danger', 'Du har allerede søkt på denne jobben.');
                return back();
            }

            DB::beginTransaction();
            try{
                $cv_type = 'norgeshandel-cv';
                $file_name = 'Norgeshandel-cv.pdf';

                if($request->file('cv')){
                    $cv_type = 'external-cv';
                    $file_name = $request->file('cv')->getClientOriginalName();
                }

                $apply_job = new AppliedJob($request->except('cv'));
                $apply_job->user_id = Auth::id();
                $apply_job->job_id = $job->id;
                $apply_job->cv_type = $cv_type;
                $apply_job->save();

                if($request->file('cv')){
                    $cv_pdf = common::update_media($request->file('cv'), $apply_job->id, 'App\AppliedJob', 'applied_job_cv');
                }

                if($apply_job && $apply_job->cv_type == "norgeshandel-cv"){
                    //create new cv with different id
                    $cv = Cv::where('user_id',Auth::id())->whereNull('apply_job_id')->first();
                    if($cv){
                        $newcv = $cv->replicate();
                        $newcv->user_id = null;
                        $newcv->apply_job_id = $apply_job->id;
                        $newcv->save();

                        if($newcv){

                            //Duplicate Cv languages
                            foreach($cv->languages as $cv_language)
                            {
                                $newcv->languages()->attach($cv_language);
                            }

                            //Cv Media
                            if($cv->media){
                                $cv_media = $cv->media;
                                $newcv_media = $cv_media->replicate();
                                $newcv_media->mediable_id = $newcv->id;
                                $newcv_media->save();
                            }

                            // Replace new education
                            $cv_educa = CvEducation::where('cv_id',$cv->id)->where('user_id',Auth::id())->first();
                            if($cv_educa){
                                $newcv_educa = $cv_educa->replicate();
                                $newcv_educa->user_id = null;
                                $newcv_educa->cv_id = $newcv->id;
                                $newcv_educa->save();
                            }

                            // Replace new experience
                            $cv_exper = CvExperience::where('cv_id',$cv->id)->where('user_id',Auth::id())->first();
                            if($cv_exper){
                                $newcv_exper = $cv_exper->replicate();
                                $newcv_exper->user_id = null;
                                $newcv_exper->cv_id = $newcv->id;
                                $newcv_exper->save();
                            }

                            // Replace new Personals
                            $cv_personal = CvPersonal::where('cv_id',$cv->id)->where('user_id',Auth::id())->first();
                            if($cv_personal){
                                $newcv_personal = $cv_personal->replicate();
                                $newcv_personal->user_id = null;
                                $newcv_personal->cv_id = $newcv->id;
                                $newcv_personal->save();
                            }

                            //Replace new preference
                            $cv_pref = CvPreference::where('cv_id',$cv->id)->where('user_id',Auth::id())->first();
                            if($cv_pref){
                                $newcv_pref = $cv_pref->replicate();
                                $newcv_pref->user_id = null;
                                $newcv_pref->cv_id = $newcv->id;
                                $newcv_pref->save();
                            }
                        }
                    }

                }


                $to_name = $apply_job->name;
                $to_email = $apply_job->email;
                $subject = 'Takk for søknaden din på stillingen "'.$apply_job->job->title.'"';
                Mail::send('mail.cv_applied_on_job',compact('apply_job','file_name'), function ($message) use ($to_name, $to_email,$subject) {
                    $message->to($to_email, $to_name)->subject($subject);
                    $message->from('developer@digitalmx.no', 'NorgesHandel');
                });

                DB::commit();
                session()->flash('success', 'Du har søkt på denne jobben.');
                return back();
            }catch (\Exception $e){
                DB::rollback();
                echo $e->getMessage();
                exit();
                session()->flash('danger', 'Noe gikk galt.');
                return back();
            }

        }else{
            abort(404);
        }
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

    //
    public function applied_jobs_list(){
        $applied_jobs = AppliedJob::where('user_id', Auth::id())->orderBy('id','DESC')->get();
        return view('user-panel.jobs.applied-jobs-list',compact('applied_jobs'));
    }
}
