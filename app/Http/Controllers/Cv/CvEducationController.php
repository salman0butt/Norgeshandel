<?php

namespace App\Http\Controllers\Cv;

use App\Models\Cv\CvEducation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cv\Cv;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CvEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(Auth::check()){
            $cvEducation = new CvEducation($request->all());
            $cvEducation->user_id = Auth::user()->id;
            $cvEducation->cv_id = Auth::user()->cv->id;
            $cvEducation->save();
            Session::flash('success', 'Cv er oppdatert');
        }
        return back();
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
        //
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
        $cvEducation = CvEducation::where('id', $id)->get()->first();
        $cvEducation->update($request->all());
        Session::flash('success', 'Cv er oppdatert');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CvEducation::where('id', $id)->delete();
        Session::flash('success', 'Opplevelsen slettet!');
        return back();
    }
}
