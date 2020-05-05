<?php

namespace App\Http\Controllers;

use App\Helpers\common;
use App\Models\Agent;
use App\Models\Company;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Agent::whereHas('company', function (Builder $query) {
            $query->where('user_id',Auth::id());
        })->get();
        return view('user-panel.my-business.company-agents.list-agents',compact('agents'));
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
        if($request->company_id){
            $company = Company::where('id',$request->company_id)->where('user_id',Auth::id())->first();
        }
        if($company){
            DB::beginTransaction();
            try{
                $agent = new Agent($request->except('agent_avatar'));
                $agent->save();

                if ($agent && $request->file('agent_avatar')) {
                    $file = $request->file('agent_avatar');
                    $media = common::update_media($file, $agent->id, 'App\Models\Agent', 'agent_avatar');
                }
                DB::commit();
                session()->flash('success', 'Posten er lagt til.');
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
        $agent = Agent::find($id);
        if($agent && $agent->company && $agent->company->user_id == Auth::id()){
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
        $agent = Agent::find($id);

        if($agent && $agent->company && $agent->company->user_id == Auth::id()){
            DB::beginTransaction();
            try{

                $agent->update($request->except(['agent_avatar','agent_avatar_remove_value']));
                if ($agent && $request->file('agent_avatar')) {
                    $file = $request->file('agent_avatar');
                    $media = common::update_media($file, $agent->id, 'App\Models\Agent', 'agent_avatar');
                }else{
                    if($request->agent_avatar_remove_value == 'yes'){
                        common::delete_media($agent->id, 'App\Models\Agent', 'agent_avatar');
                    }
                }
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
        $agent = Agent::find($id);

        if($agent && $agent->company && $agent->company->user_id == Auth::id()){
            DB::beginTransaction();
            try{
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
}
