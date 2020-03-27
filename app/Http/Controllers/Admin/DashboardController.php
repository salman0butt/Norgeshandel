<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Admin\Dashboard;
use App\Models\Ad;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $count_users = User::whereDate('created_at','>=',Date('y-m-d'))->count();
        $count_jobs = Ad::whereDate('created_at','>=',Date('y-m-d'))->where('ad_type','job')->count();
        $count_realestates = Ad::whereDate('created_at','>=',Date('y-m-d'))->where('ad_type','<>','job')->count();
        if(count($request->all()) && $request->ajax()){
            if($request->user_filter){
                $count_users = User::whereDate('created_at','>=',$request->user_filter)->count();
                return response(json_encode(array('count_users'=>$count_users)));
                exit();
            }
            if($request->job_filter){
                $count_jobs = Ad::whereDate('created_at','>=',$request->job_filter)->where('ad_type','job')->count();
                return response(json_encode(array('count_jobs'=>$count_jobs)));
                exit();
            }
            if($request->realestate_filter){
                $count_realestates = Ad::whereDate('created_at','>=',$request->realestate_filter)->where('ad_type','<>','job')->count();
                return response(json_encode(array('count_realestates'=>$count_realestates)));
                exit();
            }
        }
        $ads = Ad::where('status','published')->orderBy('updated_at','DESC')->take(3)->get();
        return view('admin.dashboard',compact('ads','count_users','count_jobs','count_realestates'));
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
     * @param  \App\Admin\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
