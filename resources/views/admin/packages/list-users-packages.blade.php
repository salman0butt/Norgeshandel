@extends('layouts/admin')

@section('main_title')Packages @endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="">Users Packages</a>
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
            <div class="card">
            <br>
                <div class="table-responsive">
                    <table class="table" id="zero_config">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">Package</th>
                            <th scope="col">Total Ads</th>
                            <th scope="col">Available Ads</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody class="customtable">
                        @if($users_packages->count())
                            @foreach($users_packages as $users_package)
                                <tr>
                                    <td>{{$users_package->user && $users_package->user->username ? $users_package->user->username : 'NH-Bruker'}}</td>
                                    <td>{{$users_package->package->title}}</td>
                                    <td>{{$users_package->total_ads}}</td>
                                    <td>{{$users_package->available_ads}}</td>
                                    <td>{{$users_package->total_price.' Kr'}}</td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" data-ajaxurl="{{url('change-status')}}" data-class="{{\App\UserPackage::class}}" data-column="status" class="custom-control-input status" id="package_{{$users_package->id}}" {{$users_package->status == 1 ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="package_{{$users_package->id}}"></label>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">
                                    <h5 class="m-2 text-center">No record found.</h5>
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
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
@endsection
