@extends('layouts.admin')

@section('main_title')
    @if(Request::is('admin/jobs/*/edit'))
    Edit job <span class="text-muted">(Full time)</span>
    @else
    Add new job <span class="text-muted">(Full time)</span>
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