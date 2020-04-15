<?php

namespace App\Http\Controllers;

use App\Admin\Jobs\Job;
use App\AppliedJob;
use App\Helpers\common;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class AppliedJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applied_jobs_cv = AppliedJob::whereHas('job', function (Builder $query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('user-panel.jobs.applied-jobs-list',compact('applied_jobs_cv'));
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

                if($request->file('cv')){
                    $cv_type = 'external-cv';
                    $file = $request->file('cv');
                }

                $apply_job = new AppliedJob($request->except('cv'));
                $apply_job->user_id = Auth::id();
                $apply_job->job_id = $job->id;
                $apply_job->cv_type = $cv_type;
                $apply_job->save();

                if($request->file('cv')){
                    $cv_pdf = common::update_media($request->file('cv'), $apply_job->id, 'App\AppliedJob', 'applied_job_cv');
                }

                DB::commit();
                session()->flash('success', 'Du har søkt på denne jobben.');
                return back();
            }catch (\Exception $e){
                DB::rollback();
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
}
