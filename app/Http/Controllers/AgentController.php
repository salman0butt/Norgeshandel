<?php

namespace App\Http\Controllers;

use App\Helpers\common;
use App\Models\Ad;
use App\Models\Agent;
use App\Models\Company;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user-panel.my-business.company-agents.list-agents');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agent = new Agent();
        return view('user-panel.my-business.company-agents.create-update-agent',compact('agent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'unique:users',
            'created_by_company_id' => 'required',
            'password' => 'required',
            'position' => 'required',
        ]);
        $company = Company::where('id',$request->created_by_company_id)->where('user_id',Auth::id())->first();
        if($company){
            DB::beginTransaction();
            try{
                $user = User::create([
                    'email'=>$request->email,
                    'password' => Hash::make($request->password),
                    'position' => $request->position,
                    'created_by_company_id' => $request->created_by_company_id,
                    'email_verified_at' => Carbon::now()->toDateTimeString(),
                ]);
                $user->roles()->attach(6);
                $password = $request->password;
                $to_name = $user->username;
                $to_email = $user->email;
                Mail::send('mail.user_created_by_company',compact('user','password'), function ($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)->subject('Konto opprettet');
                    $message->from('developer@digitalmx.no', 'NorgesHandel ');
                });
                DB::commit();
                session()->flash('success', 'Personen er lagt til');
                return redirect(url('my-business/company-agents'));
            }catch (\Exception $e){
                DB::rollback();
                session()->flash('danger', 'Noe gikk galt.');
                return back();
            }
        }else{
            session()->flash('danger', 'Bedrift ikke funnet.');
            return back();
        }
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
        $agent = User::find($id);
        if($agent && $agent->created_by_company_id && Auth::user()->property_companies->first() && $agent->created_by_company_id == Auth::user()->property_companies->first()->id){
            return view('user-panel.my-business.company-agents.create-update-agent',compact('agent'));
        }else{
            return abort(404);
        }
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
        $agent = User::find($id);

        if($agent && $agent->created_by_company_id){
            DB::beginTransaction();
            try{
                $agent->position = $request->position;
                $agent->update();
                DB::commit();
                session()->flash('success', 'Posten er oppdatert.');
                return redirect(url('my-business/company-agents'));
            }catch (\Exception $e){
                DB::rollback();
                session()->flash('danger', 'Noe gikk galt.');
                return back();
            }
        }else{
            session()->flash('danger', 'Bedrift ikke funnet.');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agent = User::find($id);

        if($agent && $agent->created_by_company_id){
            DB::beginTransaction();
            try{
                if($agent->ads->count() > 0){
                    foreach ($agent->ads as $ad){
                        if(isset($ad->job) && $ad->job){
                            $ad->job->delete();
                        }

                        if(isset($ad->property) && $ad->property){
                            $ad->property->delete();
                        }
                        $ad->delete();
                    }
                }

                $agent->delete();
                DB::commit();
                session()->flash('success', 'Posten er slettet.');
                return redirect(url('my-business/company-agents'));
            }catch (\Exception $e){
                DB::rollback();
                session()->flash('danger', 'Noe gikk galt.');
                return back();
            }
        }else{
            session()->flash('danger', 'Bedrift ikke funnet.');
            return back();
        }
    }

    //Get company agents while creating an property ad
    public function get_company_agents(Request $request){
        if($request->id){
            $company = Company::find($request->id);
            if($company && $company->user_id == Auth::id()){
                $agents = Agent::where('company_id',$company->id)->where('status',1)->get();
                $ad_agents_array = array();
                if($request->ad_id){
                    $ad = Ad::find($request->ad_id);
                    if($ad && $ad->agents->count() > 0){
                        if($ad->status == 'saved'){
                            $ad->agents()->detach();
                        }
                    }
                }
                $view = view('user-panel.partials.company_agent_inner',compact('agents','ad_agents_array'))->render();
                return response()->json(['html'=>$view]);
            }
        }
    }
}
