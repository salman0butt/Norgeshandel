<?php

namespace App\Http\Controllers;

use App\Admin\Jobs\Job;
use App\Model\Search;
use App\Http\Controllers\Auth;
use App\PropertyForRent;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
          $data = [
                'name' => $request->name,
                'type' => 'saved',
                'notification_web' => ($request->notify ?? 0),
                'notification_email' => ($request->notify ?? 0),
                'notification_sms' => ($request->notify ?? 0),
                'user_id' => auth()->user()->id
            ];


        Search::create($data);
        return back()->with('status', 'Search Saved Successfully');

    }
    public function recent($value) {
        $check = Search::where('type','recent')->Where('name','=',$value)->count();
        if ($check > 0) {
           return back();
        }
        $data = [
            'name' => $value,
            'type' => 'recent',
            'notification_web' => 0,
            'notification_email' => 0,
            'notification_sms' => 0,
            'user_id' => auth()->user()->id
        ];
            Search::create($data);
          return back()->with('status', 'Search Saved Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function show(Search $search)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function edit(Search $search)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Search $search)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function destroy(Search $search)
    {
        //
    }

    public function search($search)
    {

        if (!empty($search)) {
            $property_for_rent = PropertyForRent::where('heading', 'LIKE', '%' . $search . '%')->get();

            $job_fulltime = Job::where('job_type', '=', 'full_time')->where('title', 'LIKE', '%'.$search.'%')->get();
            $job_management = Job::where('job_type', '=', 'management')->where('title', 'LIKE', '%'.$search.'%')->get();
            $job_parttime = Job::where('job_type', '=', 'parttime')->where('title', 'LIKE', '%'.$search.'%')->get();

            $html = "";

            $html .= view('user-panel.partials.global-search-inner',
                compact('job_parttime', 'job_fulltime', 'job_management',
                'property_for_rent'))->render();

            exit($html);
        }
    }
}
