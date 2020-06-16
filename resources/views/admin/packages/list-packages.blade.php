@extends('layouts/admin')

@section('main_title')Packages @endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="">Packages</a>
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
                            <th scope="col">Title</th>
                            <th scope="col">No of Ads</th>
                            <th scope="col">Price</th>
                            <th scope="col">Expiry</th>
                            <th scope="col">Worth Value</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="customtable">
                        @if($packages->count())
                            @foreach($packages as $package)
                                <tr>
                                    <td>{{$package->title}}</td>
                                    <td>{{$package->no_of_ads}}</td>
                                    <td>{{$package->total_price.' Kr'}}</td>
                                    <td>{{$package->ad_expiry.' '.$package->ad_expiry_unit}}</td>
                                    <td>{{$package->worth_values.' Kr'}}</td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" data-ajaxurl="{{url('change-status')}}" data-class="{{\App\Package::class}}" data-column="status" class="custom-control-input status" id="package_{{$package->id}}" {{$package->status == 1 ? 'checked' : ''}}>
                                            <label class="custom-control-label" for="package_{{$package->id}}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.packages.edit',$package->id)}}" class="btn btn-primary float-left mr-1 btn-sm">Edit</a>
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
