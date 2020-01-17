<?php

namespace App\Http\Controllers;

use App\Admin\jobs\JobPreference;
use Illuminate\Http\Request;

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
        //
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
}
