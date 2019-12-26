<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use http\Message\Body;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function foo\func;
use function GuzzleHttp\Psr7\str;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::where('ads.status', 'published')->orderBy('ads.updated_at', 'desc')->get();


//        $ads = Ad::where('status','published')->orderBy('id', 'desc')->get();
//
//        dd($ads);
        return view('home', compact('ads'));

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
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        //
    }

    public function filter_ads($string = ""){
        $filtered_ads = DB::table('ads')->join('jobs', 'jobs.id', '=', 'ads.id')
            ->where('ads.status', 'published')
            ->where(function ($query) use ($string){
                $query->where('jobs.title', 'like', '%'.$string.'%')
                    ->orWhere('jobs.name', 'like', '%'.$string.'%')
                    ->orWhere('ads.ad_type', 'like', '%'.$string.'%');
            })
            ->orderByDesc('ads.updated_at')->get();
//        dd($filtered_ads);
//        $ads = Ad::where('status','published')->orderBy('id', 'desc')->get();
        $html = "";
        if(count($filtered_ads)>0) {
            foreach ($filtered_ads as $filtered_ad) {
                if ($filtered_ad->ad_type == 'job') {
                    $html .= view('user-panel.partials.templates.job-sequare', compact('filtered_ad'))->render();
                }
            }
        }
        else{
            $html = '<div class="col-md-12 ml-3 alert alert-warning no-ads dme-tab-content" style="" data-id="no-ads">
                        <h3 class=" text-center">Ingen annonser funnet.</h3>
                    </div>';
        }

        exit($html);
    }

    public function my_ads($status = []){
        $my_ads = Ad::where('user_id', Auth::user()->id)->get();
        return view('user-panel/my-business.my_ads', compact('my_ads'));
    }

    public function filter_my_ads($status, $ad_type){
        $jobs = array();
        if ($ad_type==='all-ads'){
            $my_ads = Ad::where('user_id', Auth::user()->id)->where('status',$status)->get();
            foreach ($my_ads as $my_ad){
                array_push($jobs, $my_ad->job);
            }
//            dd($jobs);
        }
        else{
            $arr = explode('-', $ad_type);
            $ad_type = $arr[0];
            $subtype = $arr[1];
            $my_ads = Ad::where('user_id', Auth::user()->id)->where('ad_type', $ad_type)->where('status',$status)->get();
            foreach ($my_ads as $my_ad){
                if($ad_type=='job'){
                    $get_job = $my_ad->job_filtered(['job_type'=>$subtype]);
                    if(count($get_job)>0){
                        array_push($jobs, $get_job->first());
                    }
                }
            }
//            dd($jobs);
        }
//        dd($jobs);
        $html="";
        if(count($jobs)>0){
            if($status==='saved'){
                $html = view('user-panel.partials.templates.job-saved', compact('jobs'))->render();
            }
            else
            {
                $html = view('user-panel.partials.templates.job-my-jobs', compact('jobs'))->render();
            }
        }
        else{
            $html = '<div class="row alert alert-warning no-ads dme-tab-content" style="" data-id="no-ads">
                        <h3 class=" text-center col-md-12">Du har ingen annonser.</h3>
                        <h5 class=" text-center col-md-12">Dine andre annonser kan du finne ved å endre på filteret.</h5>
                    </div>';
        }
        exit($html);

    }
}
