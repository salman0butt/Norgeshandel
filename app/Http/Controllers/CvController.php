<?php

namespace App\Http\Controllers;

use App\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            Cv::where('user_id', Auth::user()->id)->get();
            return view('user-panel.my-business.cv.cv');
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
        //
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
}
