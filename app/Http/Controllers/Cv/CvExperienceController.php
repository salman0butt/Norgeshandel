<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Controller;
use App\Models\Cv\CvExperience;
use App\Models\Cv\CvPersonal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CvExperienceController extends Controller
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
            $cvExperience = new CvExperience($request->all());
            $cvExperience->user_id = Auth::user()->id;
            $cvExperience->cv_id = Auth::user()->cv->id;
            $cvExperience->save();
//            dd($cvExperience);
            Session::flash('success', 'Cv er oppdatert');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cv\CvExperience  $cvExperience
     * @return \Illuminate\Http\Response
     */
    public function show(CvExperience $cvExperience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cv\CvExperience  $cvExperience
     * @return \Illuminate\Http\Response
     */
    public function edit(CvExperience $cvExperience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cv\CvExperience  $cvExperience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cvExperience = cvExperience::where('id', $id)->get()->first();
        $cvExperience->update($request->all());
        Session::flash('success', 'Cv er oppdatert');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cv\CvExperience  $cvExperience
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CvExperience::where('id', $id)->delete();
        Session::flash('success', 'Opplevelsen slettet!');
        return back();
    }
}
