<?php

namespace App\Http\Controllers\Cv;

use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Models\Cv\Cv;
use App\Models\Cv\CvEducation;
use App\Models\Cv\CvExperience;
use App\Models\Cv\CvPersonal;
use App\Models\Cv\CvPreference;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            $cv = Cv::where('user_id', Auth::user()->id)->get()->first();
            if($cv==null){
                $cv = new Cv(['user_id'=>Auth::user()->id, 'expiry'=>date('Y-m-d', strtotime("+6 months"))]);
                $cv->save();
            }
            $cvpersonal = $cv->personal;
            if($cvpersonal==null){
                $cvpersonal = new CvPersonal(['user_id'=>Auth::user()->id, 'cv_id'=>$cv->id]);
                $cvpersonal->save();
            }
            $cvexperiences = $cv->experiences;
            if($cvexperiences==null){
                $cvexperience = new CvExperience(['user_id'=>Auth::user()->id, 'cv_id'=>$cv->id]);
                $cvexperience->save();
            }
            $cvpreference = $cv->preference;
            if($cvpreference==null){
                $cvpreference = new CvPreference(['user_id'=>Auth::user()->id, 'cv_id'=>$cv->id]);
                $cvpreference->save();
            }
            $cveducations = $cv->educations;;
            if($cveducations==null){
                $cveducation = new CvEducation(['user_id'=>Auth::user()->id, 'cv_id'=>$cv->id]);
                $cveducation->save();
            }
            return view('user-panel.my-business.cv.cv', compact('cv'));
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
     * @param  \App\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function show(Cv $cv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function edit(Cv $cv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cv $cv)
    {
        $cv->update(['status'=>$request->status, 'visibility'=>$request->visibility]);
        return redirect(url('my-business/cv#profile'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cv $cv)
    {
        //
    }

    public function extend(){
        if (Auth::check()){
            $cv = Cv::where('user_id', Auth::user()->id)->get()->first();
            $cv->expiry = date('Y-m-d', strtotime("+6 months", strtotime($cv->expiry)));
            $cv->save();
            return redirect(url('my-business/cv#profile'));
        }
        return redirect(url('my-business/cv#profile'));
    }

    public function upload_cv_profile(Request $request){
        if (Auth::check()){
            common::update_media($request->file(), Auth::user()->cv->id, 'App\Models\Cv\Cv');
        }
    }

    public function update_skills(Request $request, $cv_id){
        $cv = Cv::where('id', $cv_id)->get()->first();
        $cv->key_skills = $request->key_skills;
        $cv->other_skills = $request->other_skills;
        $cv->update();
        Session::flash('success', 'Cv er oppdatert');
        return back();
    }

    public function update_preference(Request $request, $cv_id){
        $cvPreference = cvPreference::where('cv_id', $cv_id)->get()->first();
        $cvPreference->update($request->all());
        Session::flash('success', 'Cv er oppdatert');
        return back();

        Session::flash('success', 'Cv er oppdatert');
        return back();
    }

    public function update_education(Request $request, $cv_id){
        dd($request);

        Session::flash('success', 'Cv er oppdatert');
        return back();
    }

    public function update_languages(Request $request, $cv_id){
        $cv = Cv::find($cv_id);
        $cv->languages()->detach();
        $cv->languages()->attach($request->langs);
        Session::flash('success', 'Cv er oppdatert');
        return back();
    }
}
