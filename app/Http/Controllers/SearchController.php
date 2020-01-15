<?php

namespace App\Http\Controllers;

use App\Model\Search;
use App\Admin\Jobs\Job;
use App\PropertyForRent;
use Illuminate\Support\Arr;
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
        //
        return view('user-panel/my-business/search/saved-search');
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
        Search::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function show(Search $search)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Search  $search
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
     * @param  \App\Model\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Search $search)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function destroy(Search $search)
    {
        //
    }

    public function search($search)
    
    {

       if (!empty($search)) {
        $data['property'] = PropertyForRent::where('heading', 'LIKE', '%' . $search . '%')->limit(5)->get();
        $property_count = PropertyForRent::where('heading', 'LIKE', '%' . $search . '%')->count();
       

        $data['jobs'] = Job::where('title', 'LIKE', '%'.$search.'%')->limit(5)->get();
        $jobs_count = Job::where('title', 'LIKE', '%'.$search.'%')->count();

        $results =  $data;

        $html = "";
            
                foreach ($data as $result) {

                $html .= view('user-panel.partials.global-search-inner', compact('result', 'search'))->render();
             
               
                }
            
            
 
     
        exit($html);
      }
  }
}
