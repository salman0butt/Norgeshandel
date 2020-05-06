<?php

namespace App\Http\Controllers\Cv;

use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Models\Cv\Cv;
use App\Models\Cv\CvEducation;
use App\Models\Cv\CvExperience;
use App\Models\Cv\CvPersonal;
use App\Models\Cv\CvPreference;
use App\Models\Cv\CvRequest;
use App\Models\Language;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use niklasravnsborg\LaravelPdf\Pdf;
//use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;
use DB;

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

            if($cv == null){
                $cv = new Cv(['user_id'=>Auth::user()->id, 'expiry'=>date('Y-m-d', strtotime("+6 months"))]);
                $cv->save();
            }

            $cvpersonal = $cv->personal;

            if($cvpersonal == null){
                $cvpersonal = new CvPersonal(['user_id'=>Auth::user()->id, 'cv_id'=>$cv->id]);
                $cvpersonal->save();
            }

            $cvexperiences = $cv->experiences;
            if($cvexperiences == null){
                $cvexperience = new CvExperience(['user_id'=>Auth::user()->id, 'cv_id'=>$cv->id]);
                $cvexperience->save();
            }

            $cvpreference = $cv->preference;
            if($cvpreference == null){
                $cvpreference = new CvPreference(['user_id'=>Auth::user()->id, 'cv_id'=>$cv->id]);
                $cvpreference->save();
            }

            $cveducations = $cv->educations;;
            if($cveducations==null){
                $cveducation = new CvEducation(['user_id'=>Auth::user()->id, 'cv_id'=>$cv->id]);
                $cveducation->save();
            }

            if($cv->personal){
                return view('user-panel.my-business.cv.cv', compact('cv'));
            }else{
                return redirect(url('my-business/cv'));
            }
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

    public function upload_cv_profile(Request $request){
        if (Auth::check()){
            common::update_media($request->file(), Auth::user()->cv->id, 'App\Models\Cv\Cv');
        }
    }

    public function update_skills(Request $request, $cv_id){
        $cv = Cv::where('id', $cv_id)->get()->first();
        $cv->key_skills = $request->key_skills;
        $cv->other_skills = $request->other_skills;
        $cv->update();
        Session::flash('success', 'Cv er oppdatert');
        return back();
    }

    public function update_preference(Request $request, $cv_id){
        $cvPreference = cvPreference::where('cv_id', $cv_id)->get()->first();
        $cvPreference->update($request->all());
        Session::flash('success', 'Cv er oppdatert');
        return back();

        Session::flash('success', 'Cv er oppdatert');
        return back();
    }

    public function update_education(Request $request, $cv_id){
        dd($request);

        Session::flash('success', 'Cv er oppdatert');
        return back();
    }

    public function update_languages(Request $request, $cv_id){
        $cv = Cv::find($cv_id);
        $cv->languages()->detach();
        $cv->languages()->attach($request->langs);
        Session::flash('success', 'Cv er oppdatert');
        return back();
    }

    //Download is CV in Pdf
    public function download_pdf($cv_id,$anonym_cv=''){

        $anonym_cv_information = '';
        if($anonym_cv){
            $anonym_cv_information = $anonym_cv;
        }
        $cv =   Cv::find($cv_id);
        $html = view('user-panel.my-business.cv.download_pdf', compact('cv','anonym_cv_information'))->render();
        $pdf = new Pdf($html);
        $pdf->download('NorgesHandel-CV-'.$cv_id.'-'.$cv->user->first_name.' '.$cv->user->last_name.'.pdf');
        return back();
    }

    //View is CV in Pdf
    public function view_pdf_cv($cv_id,$anonym_cv=''){
        $anonym_cv_information = '';
        if($anonym_cv){
            $anonym_cv_information = $anonym_cv;
        }
        $cv =   Cv::find($cv_id);
        $html = view('user-panel.my-business.cv.download_pdf', compact('cv','anonym_cv_information'))->render();
        $pdf = new Pdf($html);
        return $pdf->stream('NorgesHandel-CV-'.$cv_id.'pdf');
    }

    //list all cvs to company users
    public function cv_list(){
        $date = Date('Y-m-d');
        if(Auth::user()->hasRole('company')){
            $cvs = Cv::where('status','published')->where('user_id','<>',Auth::id())->whereNull('apply_job_id')
                ->whereHas('personal', function (Builder $query) {
                    $query->whereNotNull('title');
                })->whereDate('expiry','>=',$date)->orderBy('id','DESC')->get();

            $shortlisted_cvs = Cv::where('status','published')->where('user_id','<>',Auth::id())->whereNull('apply_job_id')->whereDate('expiry','>=',$date)
                ->whereHas('meta', function (Builder $query) {
                    $query->where('user_id', Auth::id())->orderBy('id','DESC');
                })->get();

            $requested_cvs = Cv::where('status','published')->where('user_id','<>',Auth::id())->where('visibility','anonymous')->whereNull('apply_job_id')->whereDate('expiry','>=',$date)
                ->whereHas('user.requests_received', function (Builder $query) {
                    $query->where('employer_id', Auth::id())->orderBy('id','DESC');
                })->get();

            return view('user-panel.my-business.cv.cv-list',compact('cvs','shortlisted_cvs','requested_cvs'));
        }else{
            return redirect('forbidden');
        }
    }

    //Cv Request
    public function cv_request(Request $request){
        if($request->status != 'requested'){
            $cv_request = CvRequest::where('user_id',$request->user_id)->where('employer_id',$request->employer_id)->first();
            if(!$cv_request || $cv_request->user_id != Auth::id()){
                (header("HTTP/1.0 404 Not Found"));
                $data['failure'] = 'unauthorized';
                echo json_encode($data);
                exit();
            }
        }
        DB::beginTransaction();
        try{
            $cv_request = CvRequest::updateOrCreate(['user_id' => $request->user_id, 'employer_id' => $request->employer_id], ['status' => $request->status]);

            if($cv_request->status == 'requested'){
                $to_name = $cv_request->user && $cv_request->user->username ? $cv_request->user->username : 'NH-Bruker';
                $to_email = $cv_request->user->email;
                $subject = "CV-forespørsel mottatt";
                $text = "Vi vil informere om at ".($cv_request->employer->username ? $cv_request->employer->username : 'NH-Bruker')." har sendt deg en forespørsel om å se din CV.";
            }else{
                $to_name = $cv_request->employer && $cv_request->employer->username ? $cv_request->employer->username : 'NH-Bruker';
                $to_email = $cv_request->employer->email;
                $subject = "CV-forespørsel ".($cv_request->status == "accepted" ? 'akseptert' : 'avvist');
                $text = "Vi vil informere om at CV-forespørselen din er ".($cv_request->status == "accepted" ? 'akseptert' : 'avvist')." av ".($cv_request->user->username ? $cv_request->user->username : 'NH-Bruker').'.';
            }
            Mail::send('mail.cv_request',compact('text'), function ($message) use ($to_name, $to_email,$subject) {
                $message->to($to_email, $to_name)->subject($subject);
                $message->from('developer@digitalmx.no', 'NorgesHandel');
            });

            DB::commit();
            $data['msg'] = 'success';
            echo json_encode($data);

        }catch (\Exception $e){
            DB::rollback();
            (header("HTTP/1.0 404 Not Found"));
            $data['failure'] = $e->getMessage();
            echo json_encode($data);
            exit();
        }
    }

}
