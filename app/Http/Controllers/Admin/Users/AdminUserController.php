<?php

namespace App\Http\Controllers\Admin\Users;


use App\Helpers\common;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Media;
use App\Helpers;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Zizaco\Entrust\EntrustRole;


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
        $user_array = $request->all();
        $user_array['password'] = Hash::make($user_array['password']);

        $user = new User($user_array);
        $role->users()->save($user);

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

        $user = User::where('id', $id);

        $user->update([
            'first_name' => $user_array['first_name'],
            'last_name' => $user_array['last_name'],
            'username' => $user_array['username'],
            'mobile_number' => $user_array['mobile_number'],
            'email' => $user_array['email'],
            'password' => $user_array['password'],
            'address' => $user_array['address'],
            'city' => $user_array['city'],
            'zip' => $user_array['zip'],
            'gender' => $user_array['gender'],
            'country' => $user_array['country'],
            'birthday' => $user_array['birthday'],
//            'status' => $user_array['status']
        ]);
        if ($request->file('file')) {
            $file = $request->file('file');

            common::update_media($file, $id, 'App\User');
        }
        else{
//            User::where('id', $id)->update(['image_path'=>'']);
        }

        $request->session()->flash('success', 'User has been updated successfully');
        $users = User::all();
        return response()->view('admin.users.users', compact('users'));
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
        return view('admin.users.users', compact('users', 'roles'));
    }
}
