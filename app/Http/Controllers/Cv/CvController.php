<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Controller;
use App\Models\Cv\Cv;
use App\Models\Cv\CvPersonal;
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
            $cv = Cv::where('user_id', Auth::user()->id)->get()->first();
            if($cv==null){
                $cv = new Cv(['user_id'=>Auth::user()->id, 'expiry'=>date('Y-m-d', strtotime("+6 months"))]);
                $cv->save();
            }
            $cvpersonal = $cv->personal;;
            if($cvpersonal==null){
                $cvpersonal = new CvPersonal(['user_id'=>Auth::user()->id, 'cv_id'=>$cv->id]);
                $cvpersonal->save();
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
        $cv->update(['status'=>$request->status, 'visibility'=>$request->visibility]);
        return redirect(url('my-business/cv#profile'));
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

    public function extend(){
        if (Auth::check()){
            $cv = Cv::where('user_id', Auth::user()->id)->get()->first();
            $cv->expiry = date('Y-m-d', strtotime("+6 months", strtotime($cv->expiry)));
            $cv->save();
            return redirect(url('my-business/cv#profile'));
        }
        return redirect(url('my-business/cv#profile'));
    }
}
