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
$job_function = \App\Taxonomy::where('slug', 'job_function')->first();
$job_functions = $job_function->terms;
?>
@section('page_content')
    @include('common.partials.flash-messages')
    <div class="container-fluid pl-0">
        <div class="row">
            <div class="col-md-12 pl-0">
                <div class="table-responsive">
                    <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 pl-0">
                        <div style="position: relative; right: -20px;">
                            @if(Request()->get('trashed'))
                                <a href="{{route('admin.jobs.index')}}">
                                    page moved to the job
                                </a>
                            @else
                                <a href="{{url('admin/jobs?trashed=jobs')}}">
                                    page moved to the trash
                                </a>
                            @endif
                        </div>
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
                                                        <?php
                                                            if(Request()->get('trashed')){
                                                                $job = $ad->job()->withTrashed()->first();
                                                            }else{
                                                                $job = $ad->job;
                                                            }
                                                        ?>
                                                        <tr role="row" class="odd">
                                                            <th class="sorting_1">
                                                                <label class="customcheckbox">
                                                                    <input type="checkbox" class="listCheckbox">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </th>
                                                            <td class="sorting_1">
                                                                {{$job->name ? Str::limit($job->name,20) : ''}}
                                                                <br>
                                                                @if(Request()->get('trashed'))
                                                                    @if(($job->user && !$job->company_id) || ($job->company_id && $job->company && $job->user))
                                                                        <a href="{{url('admin/jobs/restore/'.$job->id)}}" class="btn-link-danger" onclick="return confirm('Er du sikker på å gjenopprette denne jobben')">Restore</a>
                                                                    @endif
                                                                @else
                                                                    <a href="{{route('jobs.show', compact('job'))}}" class="mr-2">View</a>
                                                                    <a href="{{route('jobs.edit', compact('job'))}}" class="mr-2">Edit</a>
                                                                    <form action="{{route('admin.jobs.destroy', $job)}}" method="POST"  onsubmit="jarascript:return confirm('Er du sikker på å slette denne jobben: {{$job->title}}')">
                                                                        {{ csrf_field() }} {{method_field('DELETE')}}
                                                                        <input type="submit" name="DELETE" VALUE="Delete" class="btn-link-danger">
                                                                    </form>
                                                                @endif
                                                            </td>
                                                            <td>{{$job->industry}}</td>
                                                            <td>{{$job->positions}}</td>
                                                            <td>{{!empty($job->deadline) ? $job->deadline:'Soonest'}}</td>
                                                            <td>{{$job->emp_name}}</td>
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
                                                        <th rowspan="1" colspan="1">Industry</th>
                                                        <th rowspan="1" colspan="1">Position</th>
                                                        <th rowspan="1" colspan="1">Deadline</th>
                                                        <th rowspan="1" colspan="1">Employer</th>
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
