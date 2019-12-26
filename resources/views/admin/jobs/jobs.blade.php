@extends('layouts.admin')

@section('main_title')
    Jobs
@endsection
@section('breadcrumb')
    <a href="#" class="text-muted">Dashboard</a> /
    <a href="#" class="">Jobs</a>
@endsection
<?php
$approve = 'published';
$countries = countries();
$industry = \App\Taxonomy::where('slug', 'industry')->first();
$industries = $industry->terms;
$job_function = \App\Taxonomy::where('slug', 'job-function')->first();
$job_functions = $job_function->terms;
?>
@section('page_content')
    @include('common.partials.flash-messages')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="zero_config"
                                                   class="table table-striped table-bordered dataTable bg-white"
                                                   role="grid" aria-describedby="zero_config_info">
                                                <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc_disabled sorting_desc_disabled sorting_asc"
                                                        tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1"
                                                        aria-sort="ascending"
                                                        aria-label=": activate to sort column descending"
                                                        style="width: 24px;">
                                                        <label class="customcheckbox m-b-20">
                                                            <input type="checkbox" id="mainCheckbox">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Title: activate to sort column ascending"
                                                        style="width: 123px;">Title
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Category: activate to sort column ascending"
                                                        style="width: 193px;">Industry
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 92px;">Position
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Deadline: activate to sort column ascending"
                                                        style="width: 56px;">Deadline
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Employer: activate to sort column ascending"
                                                        style="width: 85px;">Employer
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Status: activate to sort column ascending"
                                                        style="width: 78px;">Status
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="zero_config"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Views: activate to sort column ascending"
                                                        style="width: 78px;">Views
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if($ads)
                                                @foreach($ads as $ad)
                                                    <?php $job = $ad->job; ?>
                                                <tr role="row" class="odd">
                                                    <th class="sorting_1">
                                                        <label class="customcheckbox">
                                                            <input type="checkbox" class="listCheckbox">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </th>
                                                    <td class="sorting_1">
                                                        {{$job->name}}
                                                        <br>
                                                        <a href="{{route('jobs.show', compact('job'))}}" class="mr-2">View</a>
                                                        <a href="{{route('jobs.edit', compact('job'))}}" class="mr-2">Edit</a>
                                                        <form action="{{route('jobs.destroy', $job)}}" method="POST"  onsubmit="jarascript:return confirm('Are you sure to delete this job: {{$job->title}}')">
                                                            {{ csrf_field() }} {{method_field('DELETE')}}
                                                            <input type="submit" name="DELETE" VALUE="DELETE" class="btn-link-danger">
                                                        </form>
                                                    </td>
                                                    <td>
                                                        @foreach($job->terms as $term)
                                                            @if($term->taxonomy->name=='industry')
                                                                {{$term->name}}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{$job->title}}</td>
{{--                                                    {{dd($job)}}--}}
                                                    <td>{{!empty($job->deadline)?$job->deadline:'Soonest'}}</td>
                                                    <td>{{$job->emp_name}}</td>
                                                    {{--{{dd()}}--}}
                                                    <td>{{$ad->status}} @if($ad->status=='pending') <a href="{{route('jobs.status_change', [$ad, $approve])}}">approve</a>@endif</td>
                                                    <td>{{count($ad->views)}}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">
                                                        <!--                                                <label class="customcheckbox m-b-20">-->
                                                        <!--                                                    <input type="checkbox" id="mainCheckbox">-->
                                                        <!--                                                    <span class="checkmark"></span>-->
                                                        <!--                                                </label>-->
                                                    </th>
                                                    <th rowspan="1" colspan="1">Title</th>
                                                    <th rowspan="1" colspan="1">Category</th>
                                                    <th rowspan="1" colspan="1">Total Price</th>
                                                    <th rowspan="1" colspan="1">Date added</th>
                                                    <th rowspan="1" colspan="1">Author</th>
                                                    <th rowspan="1" colspan="1">Status</th>
                                                    <th rowspan="1" colspan="1">Views</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection