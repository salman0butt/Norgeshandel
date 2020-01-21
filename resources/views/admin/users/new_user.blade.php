@extends('layouts/admin')

<?php
$err = '';

$first_name = "";
$last_name = "";
$username = "";
$mobile_number = "";
$email = "";
$password = "";
$address = "";
$city = "";
$gender = "";
$zip = "";
$country = "";
$birthday = "";
$role_id = "";
$status = "";
$image_path = "";

if (Request::is('admin/users/*/edit')) {
    $first_name = $user->first_name;
    $last_name = $user->last_name;
    $username = $user->username;
    $mobile_number = $user->mobile_number;
    $email = $user->email;
    $password = $user->password;
    $address = $user->address;
    $city = $user->city;
    $gender = $user->gender;
    $zip = $user->zip;
    $country = $user->country;
    $birthday = $user->birthday;
    $role_id = $user->role_id;
    $status = $user->status;
    $image_path = $user->image_path;
}

$countries_list = countries();
?>

{{--{{dd($gender)}}--}}
@section('main_title')
    Add new user
@endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="text-muted">Users</a> /
    <a href="#" class="">@if(Request::is('admin/users/*/edit'))Edit @else Add new @endif</a>
@endsection

@section('page_content')
    @include('common.partials.flash-messages')
    <form action="@if(Request::is('admin/users/*/edit')){{route('users.update', $user->id)}}
    @else {{route('users.store')}} @endif" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if(Request::is('admin/users/*/edit')) {{method_field('PUT')}} @endif
        <div class="row">
            <div class="col-md-3">
                <div class="profile" style="padding: 10px; background: #fdfdfd; border: 2px dashed #ddd;">
                    <img
                        src="@if(Request::is('admin/users/*/edit') && $user->media!=null){{asset(\App\Helpers\common::getMediaPath($user->media))}}@else {{asset('public/admin/images/users/1.jpg')}} @endif"
                        id="profile_image" style="width:100%; max-height: 250px; height:250px;" alt="">
                </div>
                <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="profile_image_select">
                    <label class="custom-file-label" for="validatedCustomFile">Choose profile picture...</label>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name" class="text-right control-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" value="<?php echo $first_name; ?>"
                                   autofocus name="first_name" placeholder="John">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name" class="text-right control-label ">Last Name</label>
                            <input type="text" class="form-control" id="last_name" value="<?php echo $last_name; ?>"
                                   name="last_name" placeholder="Smith">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="username" class="text-right control-label ">username<span
                                    class="red">*</span></label>
                            <input type="text" class="form-control" id="username" value="<?php echo $username; ?>"
                                   name="username" placeholder="Smith" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile_number" class="control-label col-form-label">Mobile number<span
                                    class="red">*</span></label>
                            <input type="tel" class="form-control" id="mobile_number"
                                   value="<?php echo $mobile_number; ?>" name="mobile_number"
                                   placeholder="+47 123 456789" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="control-label col-form-label">Email<span
                                    class="red">*</span></label>
                            <input type="email" class="form-control" id="email" value="<?php echo $email; ?>"
                                   name="email"
                                   placeholder="example@email.com" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="text-right control-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="*********" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="confirm_passowrd" class="text-right control-label ">Confirm password</label>
                            <input type="password" class="form-control" id="confirm_passowrd" name="confirm_passowrd"
                                   placeholder="*********" >
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <!--            end col-md-9-->
        </div>
        <!--            end row-->
        <div class="form-group row mt-3">
            <label for="address" class="col-sm-2 control-label col-form-label">Street address</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" value="<?php echo $address; ?>" name="address"
                       placeholder="e.g. Revefaret 137">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row form-group">
                    <label class="col-md-4 control-label col-form-label" for="birthday">Born</label>
                    <div class="col-md-8">
                        <input type="date" class="form-control date-inputmask" id="birthday"
                               value="<?php echo $birthday; ?>" name="birthday"
                               placeholder="Birthday">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row form-group">
                    <label class="col-md-4 control-label col-form-label" for="gender">Gender<span
                            class="red">*</span></label>
                    <div class="col-md-8">
                        <select class="select2 form-control custom-select select2-hidden-accessible" id="gender"
                                name="gender"
                                style="width: 100%; height:36px;" data-select2-id="1" aria-hidden="true" required>
                            @if($gender != "")
                                <option selected value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                            @endif
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="city" class="col-sm-4 control-label col-form-label">City</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>"
                               placeholder="e.g. Drammen">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="zip" class="col-sm-4 control-label col-form-label">Zip code</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $zip; ?>"
                               placeholder="e.g. 3033">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="country" class="col-sm-4 control-label col-form-label">Country</label>
                    <div class="col-sm-8">
                        <select class="select2 form-control custom-select select2-hidden-accessible" name="country"
                                style="width: 100%; height:36px;" data-select2-id="1" aria-hidden="true">
                            @if($country != "")
                                <option selected value="<?php echo $country; ?>"><?php echo $country; ?></option>
                            @endif
                            @foreach($countries_list as $ctry)
                                <option value="{{$ctry['name']}}"
                                        @if($ctry['name']=="Norway" && empty($country)) selected @endif>{{$ctry['name']}}</option>
                            @endforeach

                            <option value="">Select</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="role_id" class="col-sm-4 control-label col-form-label">User role</label>
                    <div class="col-sm-8">

                        <select class="form-control custom-select" id="select_role" name="role_id"
                                style="width: 100%; height:36px;" >
                            @if(Request::is('admin/users/*/edit'))
                                <option selected
                                        value="{{$user->roles->first()->id}}">{{$user->roles->first()->display_name}}</option>
                            @endif
                            @if(isset($roles) && count($roles)>0)
                                @foreach($roles as $role)
                                    <option
                                        @if($role->name=='subscriber' && !Request::is('admin/users/*/edit')) selected
                                        @endif value="{{$role->id}}">{{$role->display_name}}</option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
            </div>
        </div>
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <hr>
            </div>
        </div>
{{--        @dd($user->allowed_jobs->first()->value)--}}
    @if(isset($user->roles) && is_countable($user->roles) && count($user->roles)>0)
        @if($user->roles->first()->name=='company')
{{--                @dd($user->allowed_job_companies)--}}
                <div class="row" id="allocation_row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-md-2 m-t-15">Allowed Ad types</label>
                            <div class="col-md-5">
                                <label for="">Jobs</label>
                                <input type="number" name="allowed_jobs" min="0" value="@if(!empty(@$user->allowed_job_companies->first()->value)){{@$user->allowed_job_companies->first()->value}}@endif" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="">Properties</label>
                                <input type="number" name="allowed_properties" min="0" value="@if(!empty(@$user->allowed_property_companies->first()->value)){{@$user->allowed_property_companies->first()->value}}@endif" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="float-right btn btn-success">Submit</button>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile_image').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function (e) {
            $('#select_role').change(function () {
                if($(this).val()=='4'){
                    $('#allocation_row').slideDown();
                }
                else{
                    $('#allocation_row').slideUp();
                }
            });

            //
            $(".select2").select2();
            //
            $('#profile_image_select').change(function (e) {
                readURL(this);
                $('#profile_image').attr('src', this.value);
            });
        });
    </script>
@endsection
