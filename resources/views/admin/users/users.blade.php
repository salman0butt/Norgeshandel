@extends('layouts/admin')

@section('main_title')Users @endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="">Users</a>
@endsection
@section('style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        a{
            color: #ac304a;
        }
        .custom-control-input:checked~.custom-control-label::before{
            border-color: #ac304a;
            background-color: #ac304a;
        }
    </style>
@endsection
@section('page_content')
    {{--    @if(isset($response) && $response)<div class="alert alert-success">User has been added successfully</div>@endif--}}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('common.partials.flash-messages')
        </div>
        <div class="col-md-12">
            @if(Request()->get('trashed'))
                <a href="{{url('admin/users')}}">
                    page moved to the Users
                </a>
            @else
                <a href="{{url('admin/users?trashed=users')}}">
                    page moved to the trash
                </a>
            @endif
                {{--{{method_field('PUT')}}--}}
            <div class="row">

                <div class="col-6">
                    <form action="{{route('admin.users.change_role')}}" method="POST" class="">
                        {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="change_role" class="col-sm-4 control-label col-form-label">Change role to</label>
                        <div class="col-sm-4">
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
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <form action="{{route('admin.users.index')}}" method="GET" id="user_filter_form">
                        <input type="hidden" name="trashed" value="{{isset(request()->trashed) ? 'users' : ''}}">
                        <a style="background: #ac304a; color: white;padding: 3px; border-radius: 4px;" href="javascript:" class="pull-right" title="Advanced Search" data-toggle="collapse" data-target="#toggle-search-filters" aria-expanded="true"><i class="fa fa-search fa-2x"></i></a>
                        <button name="export_users" value="yes" class="btn btn-primary mr-2" onclick="document.getElementById('user_filter_form').submit();"  ><i class="fa fa-download pr-1"></i>Export</button>
                </div>
            </div>

              <!-- Search Filters -->
              <div id="toggle-search-filters" class="collapse <?php if(Request()->has('first_name')) echo 'show'; ?>">
                  <div class="card  clearfix mb-3">
                      <div class="card-header bg-dark text-white px-2 py-2">
                          <b>Advanced Search</b>
                          <a class="float-right" data-toggle="collapse" href="#toggle-search-filters" aria-expanded="true"> <i class="fa fa-times text-white"></i> </a>
                          <div class="clearfix"></div>
                      </div>
                      <div class="card-body py-1">
                          <div class="form-body">
                              <div class="row">
                                  <div class="col-md-3 my-1 px-1">
                                      <label class="form-label mb-0">Fornavn</label>
                                      <input type="text" class="form-control" name="first_name" value="{{Request()->first_name}}">
                                  </div>
                                  <div class="col-md-3 my-1 px-1">
                                      <label class="form-label mb-0">Etternavn</label>
                                      <input type="text" class="form-control" name="last_name" value="{{Request()->last_name}}">
                                  </div>
                                  <div class="col-md-3 my-1 px-1">
                                      <label class="form-label mb-0">Brukernavn</label>
                                      <input type="text" class="form-control" name="username" value="{{Request()->username}}">
                                  </div>

                                  <div class="col-md-3 my-1 px-1">
                                      <label class="form-label mb-0">E-post</label>
                                      <input type="text" class="form-control" name="email" value="{{Request()->email}}">
                                  </div>
                              </div>

                              <div class="row mt-1">
                                  <div class="col-md-3 my-1 px-1">
                                      <label class="form-label mb-0">Status</label>
                                      <select class="form-control filter" name="account_status">
                                          <option value="">Status</option>
                                          <option value="1" {{Request()->account_status && Request()->account_status == '1' ? 'selected' : ''}}>Active</option>
                                          <option value="0" {{is_numeric(Request()->account_status) && Request()->account_status == '0' ? 'selected' : ''}}>Deactive</option>
                                      </select>
                                  </div>
                                  <div class="col-md-3 my-1 px-1">
                                      <label class="form-label mb-0">Rolle</label>
                                      <select class="form-control filter" name="role_id">
                                          <option value="">Velg rolle</option>
                                          @if($roles->count() > 0)
                                              @foreach($roles as $role)
                                                  <option value="{{$role->id}}" {{Request()->role_id && Request()->role_id == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                                              @endforeach
                                          @endif
                                      </select>
                                  </div>
                                  <div class="col-md-3 my-1 px-1">
                                      <label class="form-label mb-0">Opprettet dato Start</label>
                                      <input type="date" class="form-control" name="start_date" value="{{Request()->start_date}}">
                                  </div>
                                  <div class="col-md-3 my-1 px-1">
                                      <label class="form-label mb-0">Opprettet dato slutt</label>
                                      <input type="date" class="form-control" name="end_date" value="{{Request()->end_date}}">
                                  </div>
                              </div>
                          </div><!-- .form-body -->
                          <div class="clearfix"> </div>
                      </div>
                      <div class="card-footer py-1">
                          <div class="row text-right d-block">
                              <a href="{{route('admin.users.index')}}" class="btn btn-sm btn-default">Reset Search Results</a>
                              <button type="submit" class="btn btn-sm btn-primary"> Search  </button>
                          </div>
                          <div class="clearfix"></div>
                      </div>
                  </div>

              </div>
              </form>


              <div class="card">
                <div class="table-responsive pt-4">
                    <table class="table" id="zero_config">
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
                            <th scope="col">Role</th>
                            <th scope="col">Ads count</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody class="customtable">
                        @if(isset($users) && $users->count() > 0)
                            @foreach($users as $user)
                                <tr>
                                    <th>
                                        <label class="customcheckbox">
                                            <input type="checkbox" class="listCheckbox" data-value="{{$user->id}}" data-id="users_checklist">
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    <td><img style="height: 70px; width:60px;" src="@if($user->media!=null){{asset(\App\Helpers\common::getMediaPath($user->media))}}@else {{asset('public/admin/images/users/1.jpg')}} @endif" alt="" class="mr-2"></td>
                                    <td><div class="display_name mb-2">{{$user->first_name}} {{$user->last_name}}</div>
                                    @if(Request()->get('trashed'))
                                        @if($user)
                                            <a href="{{url('admin/user/restore/'.$user->id)}}" class="btn-link-danger" onclick="return confirm('Fo You Want to restore this User')">Restore</a>
                                        @endif
                                    @else
                                        <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-primary float-left mr-1 btn-sm">Edit</a>
                                        <form action="{{route('admin.users.destroy', $user->id)}}" method="POST"  onsubmit="jarascript:return confirm('Do you want to delete this user? Ads are deleted from this user. And you can\'t restore it again. Thanks!')">
                                            {{ csrf_field() }} {{method_field('DELETE')}}
                                            <input type="submit" name="DELETE" VALUE="DELETE" class="btn btn-danger btn-sm">
                                        </form>
                                        @endif
                                    </td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{@$user->roles->first()->display_name}}</td>
                                    <td>{{$user->ads->count()}}</td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" data-ajaxurl="{{url('change-status')}}" data-class="{{\App\User::class}}" data-column="account_status" class="custom-control-input status" id="user_{{$user->id}}" {{$user->account_status == 1 ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="user_{{$user->id}}"></label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">
                                    <h5 class="m-2 text-center">There is no user to display!</h5>
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
                //console.log($(this).attr('data-value'));
            }
            else{
                $(id).remove();
            }
        });
        $('#mainCheckbox').change(function (e) {
            $('#users_list input').remove();
            if (this.checked){
                $('input[data-id=users_checklist]').each(function (e) {
//                    //console.log($(this).attr('data-value'));
                    $('#users_list').append('<input type="hidden" name="user[]" value="'+$(this).attr('data-value')+'" id="user_'+$(this).attr('data-value')+'">');
                })
            }
        })
    })
</script>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endsection
