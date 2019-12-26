@extends('layouts.landingSite')

@section('main_title')
    @if(Request::is('admin/jobs/*/edit'))
        Edit job (Part time)
    @else
        Add new job (Part time)
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
        <a href="#" class="">Part time</a>
    @endif
@endsection
<?php $job_type = 'part_time';?>
@include('common.partials.job-form')