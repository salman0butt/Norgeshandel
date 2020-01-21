@extends('layouts/admin')

@section('main_title')Users @endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="">Users</a>
@endsection
@section('page_content')
    {{--    @if(isset($response) && $response)<div class="alert alert-success">User has been added successfully</div>@endif--}}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('common.partials.flash-messages')
        </div>
        <div class="col-md-12">
            <form action="{{route('admin.users.change_role')}}" method="POST" class="">
                {{ csrf_field() }}
                {{--{{method_field('PUT')}}--}}
                <div class="form-group row">
                {{--<label for="delete" class="col-sm-2 control-label col-form-label">With selected</label>--}}
                {{--<div class="col-sm-2">--}}
                {{--<select class="select2 form-control custom-select select2-hidden-accessible" style="width: 100%; height:36px;" data-select2-id="1" tabindex="-1" aria-hidden="true">--}}
                {{--<option value="">Select</option>--}}
                {{--<option value="delete">Delete</option>--}}
                {{--</select>--}}
                {{--</div>--}}
                {{--<div class="col-md-2">--}}
                {{--<button type="submit" class="btn btn-success">Apply</button>--}}
                {{--</div>--}}
                    <label for="change_role" class="col-sm-2 control-label col-form-label">Change role to</label>
                    <div class="col-sm-2">
                        <select name="change_role" class="form-control custom-select" style="width: 100%; height:36px;">
                            <option value="">Select</option>
                            @if(isset($roles) && count($roles)>0):
                            @foreach($roles as $role):
                            <option value="{{$role->id}}">{{$role->display_name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div id="users_list">

                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="btn btn-success" value="Change" name="change_role_submit">
                    </div>
            </div>
            </form>
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th colspan="2">
                                <label class="customcheckbox m-b-20">
                                    <input type="checkbox" id="mainCheckbox">
                                    <span class="checkmark"></span>
                                </label>
                            </th>
                            <th scope="col">Display name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Role</th>
                            <th scope="col">Ads count</th>
                        </tr>
                        </thead>
                        <tbody class="customtable">
                        @if(isset($users))
                            @foreach($users as $user)
                            <tr>
                                <th>
                                    <label class="customcheckbox">
                                        <input type="checkbox" class="listCheckbox" data-value="{{$user->id}}" data-id="users_checklist">
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                {{--{{getUrl($user->media)}}--}}
                                <td><img style="height: 70px; width:60px;" src="@if($user->media!=null){{asset(\App\Helpers\common::getMediaPath($user->media))}}@else {{asset('public/admin/images/users/1.jpg')}} @endif" alt="" class="mr-2"></td>
                                <td><div class="display_name mb-2">{{$user->first_name}} {{$user->last_name}}</div>
                                    <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-default float-left">Edit</a>
                                    <form action="{{route('admin.users.destroy', $user->id)}}" method="POST"  onsubmit="jarascript:return confirm('Are you sure to delete the user: {{$user->name}}')">
                                        {{ csrf_field() }} {{method_field('DELETE')}}
                                        <input type="submit" name="DELETE" VALUE="DELETE" class="btn btn-danger">
                                    </form>
{{--                                    {{dd($user->role)}}--}}
                                </td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->mobile_number}}</td>
                                <td>{{@$user->roles->first()->display_name}}</td>
                                <td>0</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8">
                                    <h4 class="m-2 text-center">There is no user to display!</h4>
                                </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function (e) {
        $('input[data-id=users_checklist]').change(function (e) {
            var id = '#user_'+$(this).attr('data-value');
            if(this.checked){
                $('#users_list').append('<input type="hidden" name="user[]" value="'+$(this).attr('data-value')+'" id="user_'+$(this).attr('data-value')+'">');
                console.log($(this).attr('data-value'));
            }
            else{
                $(id).remove();
            }
        });
        $('#mainCheckbox').change(function (e) {
            $('#users_list input').remove();
            if (this.checked){
                $('input[data-id=users_checklist]').each(function (e) {
//                    console.log($(this).attr('data-value'));
                    $('#users_list').append('<input type="hidden" name="user[]" value="'+$(this).attr('data-value')+'" id="user_'+$(this).attr('data-value')+'">');
                })
            }
        })
    })
</script>
@endsection
