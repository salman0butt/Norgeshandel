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
use App\UserRatingReview;
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
use Maatwebsite\Excel\Facades\Excel;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    
     //show all Users to admin
    public function index(Request $request){
        if (request()->route()->getPrefix() == '/admin') {
            if(!count($request->all())){
                $users = User::orderBy('id','DESC');
            }else{
                $users = User::when(($request->first_name), function($query) use ($request) {
                    if($request->first_name){
                        $query->where('first_name','like','%'.$request->first_name.'%');
                    }
                })->when(($request->last_name), function($query) use ($request) {
                    if($request->last_name){
                        $query->where('last_name','like','%'.$request->last_name.'%');
                    }
                })->when(($request->username), function($query) use ($request) {
                    if($request->username){
                        $query->where('username','like','%'.$request->username.'%');
                    }
                })->when(($request->role_id), function($query) use ($request) {
                    if(($request->role_id)){
                        $query->whereHas('roles',function ($q) use($request){
                            $q->where('roles.id', $request->role_id);
                        });
                    }
                })->when(is_numeric($request->account_status), function($query) use ($request) {
                    if(is_numeric($request->account_status)){
                        $query->where('account_status',$request->account_status);
                    }
                })->when(($request->email), function($query) use ($request) {
                    if($request->email){
                        $query->where('email', 'like', '%' . $request->email . '%');
                    }
                })->when(($request->start_date), function($query) use ($request) {
                    if($request->start_date){
                        $query->where('created_at','>=',$request->start_date);
                    }
                })->when(($request->end_date), function($query) use ($request) {
                    if($request->end_date){
                        $query->where('created_at','<=',$request->end_date);
                    }
                })->orderBy('id','DESC');
            }
            if($request->trashed){
                $users = $users->onlyTrashed()->get();
            }else{
                $users = $users->get();
            }
            if(isset($request->export_users) && $request->export_users == 'yes'){
                return Excel::download(new \App\Exports\User($users), 'users.xlsx');
            }
            $roles = Role::orderBy('id', 'DESC')->get();
            return response()->view('admin.users.users', compact('users','roles'));
        }
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
        $user_array['password'] = Hash::make($request->password);

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

        //$user->allowed_ads()->delete();

        if(isset($request->allowed_companies) && count($request->allowed_companies)){
            if(is_numeric(array_search('job',$request->allowed_companies))){
                $allowed_jobs = new AllowedCompanyAd(['key'=>'jobs', 'value'=>1]);
                $user->allowed_ads()->save($allowed_jobs);
            }
            if(is_numeric(array_search('property',$request->allowed_companies))){
                $allowed_property = new AllowedCompanyAd(['key'=>'properties', 'value'=>1]);
                $user->allowed_ads()->save($allowed_property);
            }
        }

        if(isset($request->role_id) && !empty($request->role_id)) {
            $user->roles()->detach();
            $user->roles()->attach($request->role_id);
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
        $self_account = '';
        $user = User::find($id);

        if(!$user){
            session()->flash('danger', 'Posten ble ikke funnet.');
            return back();
        }

        $roles = $user ? $user->roles : '';

        //store user records in temp variable
        $role_id = $user->roles->first()->id;
        $user_obj = $user;

        if($user->id == Auth::id()){
            $self_account = 'yes';
        }
        if (!$user->hasRole('admin')) {
            if(!Auth::user()->hasRole('admin') && $user->id != Auth::id()){
                session()->flash('danger', 'Du kan ikke slette denne brukeren.');
                return back();
            }
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

                $user->delete();

                //reattach the role to deleted user
                $user_obj->roles()->attach($role_id);
                DB::commit();
                if($self_account){
                    Auth::logout();
                    return redirect(url('/'));
                }else{
                    session()->flash('success', 'User has been deleted successfully');
                    return back();
                }

            }catch (\Exception $e){
                DB::rollback();
                session()->flash('danger', 'Noe gikk galt.');
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
        if($user){
            $ratings = UserRatingReview::where('to_user_id',$user->id)->orderBy('id','DESC')->paginate(5);
            $count_active_ads = DB::table('ads')
                ->where('visibility', '=', 1)
                ->where('user_id','=', $user->id)
                ->whereNull('deleted_at')
                ->where(function ($query) use ($date){
                    $query->where('status', 'published')
                        ->orwhereDate('sold_at','>',$date);
                })->count();
            $active_ads = DB::table('ads')
                ->where('visibility', '=', 1)
                ->where('user_id','=', $user->id)
                ->whereNull('deleted_at')
                ->where(function ($query) use ($date){
                    $query->where('status', 'published')
                        ->orwhereDate('sold_at','>',$date);
                })->orderBy('id','DESC')->paginate($pagination);
            return view('user-panel.my-business.profile.public', compact('user', 'active_ads','ratings','count_active_ads'));
        }else{
            abort(404);
        }

    }

    //Show more public profile ads
    public function show_more_public_profile_ads(Request $request){
        $pagination = 20;
        if(env('PAGINATION')){
            $pagination = env('PAGINATION');
        }
        $date = Date('y-m-d',strtotime('-7 days'));
        $user = User::find($request->user_id);
        $active_ads = DB::table('ads')
            ->where('visibility', '=', 1)
            ->where('user_id','=', $user->id)
            ->whereNull('deleted_at')
            ->where(function ($query) use ($date){
                $query->where('status', 'published')
                    ->orwhereDate('sold_at','>',$date);
            })->where('id','<',$request->last_id)
            ->orderBy('id','DESC')->paginate($pagination);

        $view = view('user-panel.my-business.public-user-ads-inner',compact('active_ads','user'))->render();

        return response()->json(['html'=>$view]);
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

                    // User Ratings and Reviews settings
                    $user_ratings_reviews_setting = Meta::where('metable_id',Auth::id())->where('metable_type','App\User')->where('key', 'like', 'show_ratings_reviews')->first();
                    if($user_ratings_reviews_setting){
                        $user_ratings_reviews_setting->value = 0;
                        $user_ratings_reviews_setting->update();
                    }
                    if($request->show_ratings_reviews){
                        Meta::updateOrCreate(['metable_id' => $user->id, 'metable_type' => 'App\User','key' => 'show_ratings_reviews'], ['value' => $request->show_ratings_reviews]);
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

        //Restore Users
    public function restore($id){
        if($id){
            $user = User::where('id','=',$id)->withTrashed();
            if($user){
                if(!Auth::user()->hasRole('admin') && $user != Auth::id()){
                    return redirect('forbidden');
                }
                DB::beginTransaction();
                try{
                    $user->restore();
                    DB::commit();
                    Session::flash('success', 'User Restored Successfully');
                    return back();
                }catch (\Exception $e){
                    DB::rollback();
                    Session::flash('danger', 'Noe gikk galt.');
                    return back();
                }
            }else{
                abort(404);
                Session::flash('danger', 'Noe gikk galt.');
                return back();
            }
        }
    }



}
