<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $default_role = Role::first();
        $roles = Role::all();
        $all_permissions = Permission::all();

        return view('entrust', compact('default_role', 'roles', 'all_permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return view('entrust');
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
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
//     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
//    public function edit(Role $role)
    public function edit(Request $request)
    {
        $default_role = Role::find($request->role);
        $roles = Role::all();
        $all_permissions = Permission::all();

        return view('entrust', compact('default_role', 'roles', 'all_permissions'));
    }

    public function edit_role(Request $request)
    {
        $default_role = Role::find($request->role);
        $roles = Role::all();
        $all_permissions = Permission::all();

        return view('entrust', compact('default_role', 'roles', 'all_permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->detachPermissions();
        if (is_array($request->permission_id)){
            $role->attachPermissions($request->permission_id);
        }
        $request->session()->flash('success', 'Permissions updated successfully');

        $default_role = $role;
        $roles = Role::all();
        $all_permissions = Permission::all();

        return view('entrust', compact('default_role', 'roles', 'all_permissions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
