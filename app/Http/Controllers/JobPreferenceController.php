<?php

namespace App\Http\Controllers;

use App\Admin\jobs\JobPreference;
use App\JobPreferenceCity;
use App\JobPreferenceKeyWord;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class JobPreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user-panel.my-business.job_preferences');
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
        if(!isset($request->cities) && !isset($request->functions)){
            Session::flash('danger','Velg data for å lagre dem.');
            return back();
        }

        if($request->cities){
            $request->merge(['cities'=>json_decode($request->cities)]);
        }

        DB::beginTransaction();
        try{
            Auth::user()->job_preference_cities()->delete();
            if($request->cities){
                foreach ($request->cities as $city){
                    $pre_city = new JobPreferenceCity();
                    $pre_city->user_id = Auth::id();
                    $pre_city->city = $city;
                    $pre_city->save();
                }
            }
            Auth::user()->job_preference_key_words()->delete();
            if($request->functions){
                foreach ($request->functions as $function){
                    $pre_key_word = new JobPreferenceKeyWord();
                    $pre_key_word->user_id = Auth::id();
                    $pre_key_word->key_word = $function;
                    $pre_key_word->save();
                }
            }

            DB::commit();
            Session::flash('success','Posten er lagt til.');
            return back();
        }catch (\Exception $e){
            DB::rollback();
            Session::flash('danger','Noe gikk galt.');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\jobs\JobPreference  $jobPreference
     * @return \Illuminate\Http\Response
     */
    public function show(JobPreference $jobPreference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\jobs\JobPreference  $jobPreference
     * @return \Illuminate\Http\Response
     */
    public function edit(JobPreference $jobPreference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\jobs\JobPreference  $jobPreference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobPreference $jobPreference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\jobs\JobPreference  $jobPreference
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobPreference $jobPreference)
    {
        //
    }

    public function delete_job_preference(){

        Auth::user()->job_preference_key_words()->delete();
        Auth::user()->job_preference_cities()->delete();

        Session::flash('success','Posten er slettet.');
        return back();

    }
}
