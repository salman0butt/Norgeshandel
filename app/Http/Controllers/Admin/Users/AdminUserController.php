<?php

namespace App\Http\Controllers\Admin\Users;


use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Models\AllowedCompanyAd;
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

        $user->roles()->detach();
        $user->roles()->attach($request->role_id);

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
            foreach ($roles as $role) {
                $user->detachRole($role->id);
            }
            $user->delete();
            session()->flash('success', 'User has been updated successfully');
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
        $user = User::find($id);
        $active_ads = DB::table('ads')->where('status', '=', 'published')->where('user_id','=', $user->id)->paginate(env('PAGINATION'));
        return view('user-panel.my-business.profile.public', compact('user', 'active_ads'));
    }

    public function request_company_profile(Request $request){
        if (Auth::check()) {
            if ((isset($request->org_number) && !empty($request->org_number)) ||
                (isset($request->org_name) && !empty($request->org_name))){

                $to_name = "NorgesHandel";
                $to_email = 'zain@digitalmx.no';//env('ADMIN_EMAIL');
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
}
