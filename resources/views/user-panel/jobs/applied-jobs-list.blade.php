@extends('layouts.landingSite')

@section('page_content')
    <style type="text/css" id="cv_style">
        a.edit-btn {
            font-size: 15px;
            border: 1px solid;
            padding: 2px 14px;
            font-weight: 400;
        }

        .table-main {
            padding: 25px 20px 72px;
            background-color: rgba(176, 64, 88, 0.07);
            margin-top: 50px;
            border-radius: 4px;
        }

        .row-border {
            border-bottom: 1px solid #ccc;
        }

        tbody th, tbody tr {
            border-top: 1px solid #dfe4e8;
            vertical-align: top;
            font-weight: 400;
        }

        .row.row-border {
            padding-bottom: 30px;
        }
    </style>
    <main class="cv">
        <div class="dme-container">
            <div class="breade-crumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{url('my-business')}}">Min handel</a></li> <!-- ('cv.breadcrumb.sub') -->
                        <li class="breadcrumb-item"><a href="#">Liste over mine søkte jobber</a></li> <!-- ('cv.breadcrumb.main') -->
                    </ol>
                </nav>
            </div>
            @include('common.partials.flash-messages')
            <div class="mt-5 mb-5">
                <table class="table table-hover table-bordered table-striped" id="applied_job_table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Jobb</th>
                        <th>Arbeidsgiver</th>
                        <th>By</th>
                        <th>Stillingstype</th>
                        <th>Sektor</th>
                        <th>Jobbfunksjon</th>
                        <th>Dato</th>
                        <th>Handling</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($applied_jobs->count() > 0)
                        @foreach($applied_jobs as $key=>$applied_job)
                            @php
                                $job_obj = '';
                                if($applied_job->job && $applied_job->job->ad && $applied_job->job->ad->visibility && $applied_job->job->ad->status == "published"){
                                    $job_obj = $applied_job->job;
                                }
                            @endphp
                            <tr class="cv-item" data-name="{{$applied_job->name}}">
                                <td>{{$applied_job->id}}</td>
                                <td title="{{$job_obj ? $job_obj->title : ''}}">{{$job_obj ? Str::limit($job_obj->title,25) : ''}}</td>
                                <td>{{$job_obj && $job_obj->emp_name ? $job_obj->emp_name : ''}}</td>
                                <td>{{$job_obj && $job_obj->zip_city ? $job_obj->zip_city : ''}}</td>
                                <td>{{$job_obj && $job_obj->commitment_type ? $job_obj->commitment_type : ''}}</td>
                                <td>{{$job_obj && $job_obj->sector ? $job_obj->sector : ''}}</td>
                                <td>{{$job_obj && $job_obj->job_function ? $job_obj->job_function : ''}}</td>
                                <td>{{$applied_job->created_at->format('d-m-Y')}}</td>
                                <td>
                                    @if($job_obj)
                                    <a href="{{route('jobs.show',$applied_job->job_id)}}" target="_blank"><i class="fas fa-eye"></i></a>
                                    @else
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#job_is_no_more"><i class="fas fa-eye"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="odd"><td valign="top" colspan="9" class="dataTables_empty">Ingen opptak funnet</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="modal fade" id="job_is_no_more" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 50px">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Jobb</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Status</h5>
                    <p>Beklager! Nå er denne jobben inaktiv / fjernet fra eieren.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#applied_job_table').DataTable({
                "order": [[ 0, "desc" ]]
            });
        } );
    </script>
@endsection