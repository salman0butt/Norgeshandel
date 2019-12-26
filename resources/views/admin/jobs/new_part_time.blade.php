@extends('layouts.admin')

@section('main_title')
    @if(Request::is('admin/jobs/*/edit'))
        Edit job <span class="text-muted">(Part time)</span>
    @else
        Add new job <span class="text-muted">(Part time)</span>
    @endif
@endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Home</a> /
    <a href="#" class="text-muted">Jobs</a> /
    @if(Request::is('admin/jobs/*/edit'))
        <a href="#" class="text-muted">Edit</a> /
    @else
        <a href="#" class="text-muted">Add new</a> /
        <a href="#" class="">Part time</a>
    @endif
@endsection
<?php $job_type = 'part_time';?>
@include('common.partials.job-form')