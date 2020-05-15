<?php

namespace App\Http\Controllers\Admin\Users;


use App\Helpers\common;
use App\Http\Controllers\AdController;
use App\Http\Controllers\Controller;
use App\Models\AllowedCompanyAd;
use App\Models\Meta;
use App\Role;
use App\User;
use App\Media;
use App\Helpers;
//use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Null_;
use Zizaco\Entrust\EntrustRole;
use Illuminate\Support\Facades\Mail;


class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.users.users', compact('users', 'roles'));
//        return view('admin.users.users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.new_user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $user_array = $request->except(['_token', '_method', 'file',
        'confirm_passowrd', 'role_id', 'password',
        'allowed_properties', 'allowed_jobs']);
        $user_array['password'] = Hash::make($user_array['password']);

        $user = new User($user_array);
        $role->users()->save($user);

        $user->allowed_ads()->delete();
        $allowed_jobs = new AllowedCompanyAd(['key'=>'jobs', 'value'=>$request->allowed_jobs]);
        $user->allowed_ads()->save($allowed_jobs);
        $allowed_property = new AllowedCompanyAd(['key'=>'properties', 'value'=>$request->allowed_properties]);
        $user->allowed_ads()->save($allowed_property);

        if (!empty($request->password)){
            $user->update(['password'=>Hash::make($request->password)]);
        }

        if ($request->file('file')) {
            $file = $request->file('file');

            common::update_media($file, $user->id, 'App\User', 'avatar');
        }

        $roles = Role::all();
        $response = true;
        return view('admin.users.new_user', compact('roles', 'response'));
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
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.users.new_user', compact('roles', 'user'));
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
        if($request->profile_submit_type && $request->profile_submit_type == 'change-password'){
            $user = User::find($id);
            if($user){
                if (Hash::check($request->old_password,$user->password)) {
                    if($request->password == $request->verify_password){
                        $user->password = Hash::make($request->password);;
                        $user->save();
                        $date = date('d-m-Y G:i:s');
                        $to_name = $user->username;
                        $to_email = $user->email;
                        Mail::send('mail.changed_password',compact('date'), function ($message) use ($to_name, $to_email) {
                            $message->to($to_email, $to_name)->subject('Passord endret');
                            $message->from('developer@digitalmx.no', 'NorgesHandel ');
                        });

                        if($request->change_password_type && $request->change_password_type == 'ajax'){
                            $data['message'] = 'Passordet er endret.';
                            $data['class'] = 'success';
                            return json_encode($data);
                        }else{
                            $request->session()->flash('success', 'Passordet er endret.');
                            return redirect()->back();
                        }

                    }else{
                        if($request->change_password_type && $request->change_password_type == 'ajax'){
                            $data['message'] = 'Passordene stemmer ikke overens.';
                            $data['class'] = 'error';
                            return json_encode($data);
                        }else{
                            $request->session()->flash('danger', 'Passordene stemmer ikke overens.');
                            return redirect()->back();
                        }
                    }
                }else{
                    if($request->change_password_type && $request->change_password_type == 'ajax'){
                        $data['message'] = 'Ditt nåværende passord er feil. Vennligst prøv igjen med riktig passord.';
                        $data['class'] = 'error';
                        return json_encode($data);
                    }else{
                        $request->session()->flash('danger', 'Ditt nåværende passord er feil. Vennligst prøv igjen med riktig passord.');
                        return redirect()->back();
                    }

                }
            }
        }
        if($request->dob_day && $request->dob_month && $request->dob_year){
            $birthday = $request->dob_year.'-'.$request->dob_month.'-'.$request->dob_day;
            $request->merge(['birthday'=>$birthday]);
        }
        $user_array = $request->all();
        if (isset($user_array['password']) && $user_array['password'] != ""){
            $user_array['password'] = Hash::make($user_array['password']);
        }
        $user = User::find($id);
        $user->update($request->except(['_token', '_method', 'file',
            'confirm_passowrd', 'role_id', 'password',
            'allowed_properties', 'allowed_jobs']));
        if (!empty($request->password)){
            $user->update(['password'=>Hash::make($request->password)]);
        }

        $user->allowed_ads()->delete();
        $allowed_jobs = new AllowedCompanyAd(['key'=>'jobs', 'value'=>$request->allowed_jobs]);
        $user->allowed_ads()->save($allowed_jobs);
        $allowed_property = new AllowedCompanyAd(['key'=>'properties', 'value'=>$request->allowed_properties]);
        $user->allowed_ads()->save($allowed_property);

        if(isset($request->role_id) && !empty($request->role_id)) {
            $user->roles()->detach();
            $user->roles()->attach($request->role_id);
        }

        if (isset($request->allowed_ad_types)){

        }

        if ($request->file('file')) {
            $file = $request->file('file');
            common::update_media($file, $id, 'App\User');
        }

        $request->session()->flash('success', 'Profilen din har blitt oppdatert');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $roles = $user->roles;

        if (!$user->hasRole('admin')) {

            DB::beginTransaction();
            try{
                if($user->hasRole('company')){
                    if($user->property_companies->count() > 0){
                        foreach ($user->property_companies->first()->agents as $company_agent){
                            if($company_agent->ads->count() > 0){
                                foreach ($company_agent->ads as $agent_ad){
                                    if($agent_ad->ad_type != 'job' &&  isset($agent_ad->property) && $agent_ad->property){
                                        $agent_ad->property->delete();
                                    }
                                    $agent_ad->delete();
                                }
                            }
                            $company_agent->delete();
                        }
                        $user->property_companies->first()->delete();
                    }

                    if($user->job_companies->count() > 0){
                        if($user->job_companies->first()->jobs->count() > 0){
                            foreach ($user->job_companies->first()->jobs as $company_job_ad){
                                if($company_job_ad->ad_type == 'job' && isset($company_job_ad->job) && $company_job_ad->job){
                                    $company_job_ad->job->delete();
                                    $company_job_ad->delete();
                                }

                                if($company_job_ad->ad_type != 'job' && isset($company_job_ad->property) && $company_job_ad->property){
                                    $company_job_ad->property->delete();
                                    $company_job_ad->delete();
                                }

                            }
                        }
                        $user->job_companies->first()->delete();
                    }
                }
                if($user->ads->count() > 0){
                    foreach ($user->ads as $ad){
                        if($ad->ad_type == 'job' && isset($ad->job) && $ad->job){
                            $ad->job->delete();
                        }

                        if($ad->ad_type != 'job' && isset($ad->property) && $ad->property){
                            $ad->property->delete();
                        }

                        $ad->delete();
                    }
                }
//            foreach ($roles as $role) {
//                $user->detachRole($role->id);
//            }
                $user->delete();
                DB::commit();
                session()->flash('success', 'User has been updated successfully');
                return back();

            }catch (\Exception $e){
                DB::rollback();
                dd($e->getMessage());
                session()->flash('danger', 'Something went wrong.');
                return back();
            }
        }
        else{
            session()->flash('danger', 'Administrator can\'t be deleted');
        }
        $users = User::all();
        return response()->view('admin.users.users', compact('users'));
    }

    public function change_role(Request $request){
        $user_role = $request->change_role;
        $users_list = $request->user;

        if (is_array($users_list) && count($users_list)>0 &&
            isset($user_role) && $user_role != null){
            foreach ($users_list as $user_id){
                $user = User::find($user_id);
                $user->roles()->detach();
                $user->roles()->attach($user_role);
            }
        }
        $roles = Role::orderBy('id', 'DESC')->get();
        $users = User::orderBy('id', 'DESC')->get();
        return redirect()->back();
    }


    public function profile(Request $request = null){
        if($request==null){
            $user = Auth::user();
            return view('user-panel.my-business.profile.profile', compact('user'));
        }
    }

    public function public_profile($id){
        $pagination = 20;
        if(env('PAGINATION')){
            $pagination = env('PAGINATION');
        }
        $date = Date('y-m-d',strtotime('-7 days'));
        $user = User::find($id);
        $active_ads = DB::table('ads')
            ->where('visibility', '=', 1)
            ->where('user_id','=', $user->id)
            ->whereNull('deleted_at')
            ->where(function ($query) use ($date){
                $query->where('status', 'published')
                    ->orwhereDate('sold_at','>',$date);
            })->paginate($pagination);
        return view('user-panel.my-business.profile.public', compact('user', 'active_ads'));
    }

    public function request_company_profile(Request $request){
        if (Auth::check()) {
            if ((isset($request->org_number) && !empty($request->org_number)) ||
                (isset($request->org_name) && !empty($request->org_name))){

                $to_name = "NorgesHandel";
                $to_email = getenv('COMPANY_REQUEST_EMAIL');//env('ADMIN_EMAIL');
                $user = Auth::user();
                $data = ['username'=>$user->username,'display_name'=>$user->first_name.' '.$user->last_name, 'email'=>$user->email,
                    'type'=>$request->type, 'org_name'=>$request->org_name,
                    'org_number'=>$request->org_number, 'contact_name'=>$request->first_name.' '.$request->last_name,
                    'contact_email'=>$request->email,'contact_phone'=>$request->phone,
                    'comment'=>$request->comment, 'form_type'=>$request->form_type];
                Mail::send('mail.request_company_profile',
                    $data,
                    function ($message) use ($to_name, $to_email, $user) {
                        $message->to($to_email, $to_name)->subject('Forespørsel om ny firmaprofil');
                        $message->from($user->email, $user->first_name.' '.$user->last_name.' ('.$user->username.')');
                    });
                    

                Session::flash('success', 'Forespørselen din har blitt sendt på e-post, snart vil du bli kontaktet.');
            }
            else{
                Session::flash('danger','Vennligst fyll obligatoriske felt!');
            }
            return redirect()->back();
        }
    }


    // Ad user email as alternative
    public function store_user_alternative_email(Request $request){
        $email = Meta::where('key','account_setting_alt_email')->where('value',$request->email)->where('metable_type','App\User')->first();
        if($email){
            session()->flash('danger', 'E-posten finnes allerede.');
            return back();
        }

        DB::beginTransaction();
        try{
            Meta::create([
                'metable_id' => Auth::id(),
                'metable_type' => 'App\User',
                'key' => 'account_setting_alt_email',
                'value' => $request->email,
            ]);
            DB::commit();
            session()->flash('success', $request->email.' ble lagret! Vennligst bekreft denne for bruk i SPiD ved å følge instruksjonene i e-posten du har mottatt.');
            return back();

        }catch (\Exception $e){
            DB::rollback();
            session()->flash('danger', 'Noe gikk galt.');
            return back();
        }
    }

    // Ad user contact number as alternative
    public function store_user_alternative_contact_no(Request $request){
        $contact_no = Meta::where('key','account_setting_alt_contact_no')->where('value',$request->country_code.$request->phone_number)->where('metable_type','App\User')->first();
        if($contact_no){
            session()->flash('danger', 'Telefonnummeret er allerede aktivt på en annen konto.');
            return back();
        }

        DB::beginTransaction();
        try{
            Meta::create([
                'metable_id' => Auth::id(),
                'metable_type' => 'App\User',
                'key' => 'account_setting_alt_contact_no',
                'value' => $request->country_code.$request->phone_number,
            ]);
            DB::commit();
            return back();

        }catch (\Exception $e){
            DB::rollback();
            session()->flash('danger', 'Noe gikk galt.');
            return back();
        }
    }

    //Saved/updated the user notification settings
    public function store_notifications_setting(Request $request){
        $user = Auth::user();
        if($user){
            try {
                if($request->all()){
                    $user_notifications = Meta::where('metable_id',Auth::id())->where('metable_type','App\User')->where('key', 'like', 'notification_%')->get();
                    if($user_notifications->count() > 0){
                        foreach($user_notifications as $user_notification){
                            $user_notification->value = 0;
                            $user_notification->update();
                        }
                    }
                    foreach ($request->all() as $key=>$value) {
                        if(preg_match('/^notification_/', $key)){
                            Meta::updateOrCreate(['metable_id' => $user->id, 'metable_type' => 'App\User','key' => $key], ['value' => $value]);
                        }
                    }

                }
                DB::commit();
                Session::flash('success', 'Innstillingen blir oppdatert.');
                return back();

            } catch (\Exception $e) {
                DB::rollback();
                Session::flash('danger', 'Noe gikk galt.');
                return back();
            }

        }
    }


}
