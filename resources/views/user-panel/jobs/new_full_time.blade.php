@extends('layouts.landingSite')

@section('main_title')
    @if(Request::is('jobs/*/edit'))
        Edit job (Full time)
    @else
        Add new job (Full time)
    @endif
@endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="text-muted">Jobs</a> /
    <a href="#" class="text-muted">Add new</a> /
    @if(Request::is('admin/jobs/*/edit'))
        <a href="#" class="text-muted">Edit</a> /
    @else
        <a href="#" class="text-muted">Add new</a> /
        <a href="#" class="">Full time</a>
    @endif
@endsection
<?php $job_type = 'full_time';?>
@include('common.partials.job-form')