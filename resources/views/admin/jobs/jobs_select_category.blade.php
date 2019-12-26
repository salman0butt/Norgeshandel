@extends('layouts.admin')

@section('main_title')
    Select job category
@endsection
@section('breadcrumb')
    <a href="{{url('/admin')}}" class="text-muted">Home</a> /
    <a href="{{url('/admin/jobs')}}" class="text-muted">Jobs</a> /
    <a href="#" class="">@if(Request::is('admin/jobs/*/edit'))Edit @else Add new @endif</a>
@endsection

@section('page_content')
    <div class="container-fluid">
        <ul class="row list-unstyled select-cat-list" id="home" style="">
            <li class="col-md-6" style="">
                <a href="{{url('admin/jobs/create/full_time')}}">Full time
                    <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                </a>
                <hr class="col-6">
            </li>
            <li class="col-md-6" style="">
                <a href="{{url('admin/jobs/create/part_time')}}">Part time
                    <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                </a>
                <hr class="col-6">
            </li>
            <li class="col-md-6" style="">
                <a href="{{url('admin/jobs/create/management')}}">Management
                    <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                </a>
                <hr class="col-6">
            </li>
        </ul>
    </div>
@endsection