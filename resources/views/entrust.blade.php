<?php
use App\User;
use App\Role;
use App\Permission;

?>
@extends('layouts.admin')

@section('main_title')
    User role permission settings
@endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="text-muted">Users</a> /
    <a href="#" class="">Settings</a> /
@endsection
<?php
$permit_roles = $all_permissions[0]->roles->toArray();
$given_permissions = $default_role->permissions->toArray();
$arr = array();
foreach ($given_permissions as $permission) {
    $arr = array_merge(array_values($permission), $arr);
}
?>
@section('page_content')
    @include('common.partials.flash-messages')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('roles.edit_role')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{--{{method_field('PUT')}}--}}
                    <div class="form-group row">
                        <label for="role" class="col-sm-2 control-label col-form-label">Select Role</label>
                        <div class="col-sm-2">
                            <select name="role" id="role" class="select2 form-control custom-select select2-hidden-accessible"
                                    style="width: 100%; height:36px;">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}" @if($role->id==$default_role->id) selected @endif>{{$role->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-success" value="Show">
                        </div>
                    </div>
                    @if ($default_role->name=="admin")
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            Administrator privileges can't be edited!
                        </div>
                    @endif
                </form>
                <form action="{{route('roles.update', $default_role)}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}
                    <div class="card pl-5 pr-5 pb-4">
                        <div class="row pt-3">
                            @foreach($all_permissions as $permission)
                                <div class="custom-control custom-checkbox col-md-4">
                                    <input type="checkbox" @if ($default_role->name=="admin") disabled @endif name="permission_id[]" value="{{$permission->id}}" class="custom-control-input"
                                           @if(in_array($permission->name, $arr)) checked @endif id="{{$permission->name}}">
                                    <label class="custom-control-label"
                                           for="{{$permission->name}}">{{$permission->display_name}}</label>
                                </div>
                            @endforeach
                        </div>
                        @if ($default_role->name!="admin")
                        <div class="row pt-2">
                            <div class="col-md-12">
                                <input type="submit" value="Update" name="update" class="btn btn-default float-right">
                            </div>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection