<?php

namespace App\Http\Controllers\Cv;

use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Models\Cv\Cv;
use App\Models\Cv\CvPersonal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CvPersonalController extends Controller
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
     * @param  \App\Models\Cv\CvPersonal  $cvPersonal
     * @return \Illuminate\Http\Response
     */
    public function show(CvPersonal $cvPersonal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cv\CvPersonal  $cvPersonal
     * @return \Illuminate\Http\Response
     */
    public function edit(CvPersonal $cvPersonal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cv\CvPersonal  $cvPersonal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cvpersonal = CvPersonal::where('id', $id)->get()->first();
        $cvpersonal->update($request->all());
        Session::flash('success', 'Cv er oppdatert');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cv\CvPersonal  $cvPersonal
     * @return \Illuminate\Http\Response
     */
    public function destroy(CvPersonal $cvPersonal)
    {
//        $cvPersonal->delete();
//        Session::flash('success', 'Opplevelsen slettet!');
//        return back();
    }

}
