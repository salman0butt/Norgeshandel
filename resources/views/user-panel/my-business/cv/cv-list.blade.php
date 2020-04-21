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
                        <li class="breadcrumb-item"><a href="#">list CV</a></li> <!-- ('cv.breadcrumb.main') -->
                    </ol>
                </nav>
            </div>
            @include('common.partials.flash-messages')
            <div class="mt-5 mb-5">
                <ul class="nav nav-tabs mb-5" id="applied_cv_tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="cv-tab" data-toggle="tab" href="#cvs" role="tab"
                           aria-controls="home" aria-selected="true">Cvs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="shortlisted-tab" data-toggle="tab" href="#shortlisted_cv" role="tab"
                           aria-controls="profile" aria-selected="false">Nominert</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="cvs" role="tabpanel" aria-labelledby="cv-tab">
                        <div class="inner-tab">
                            <table class="table table-hover table-bordered table-striped" id="applied_job_table">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Jobb</th>
                                    <th>Bruker</th>
                                    <th>Epost</th>
                                    <th>Telefon</th>
                                    <th>Fødselsår</th>
                                    <th>Utdannelse</th>
                                    <th>Nåværende stilling</th>
                                    <th>Utsikt</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($applied_jobs_cv_list->count() > 0)
                                    @foreach($applied_jobs_cv_list as $key=>$applied_jobs_cv_list_obj)
                                        @if(!$applied_jobs_cv_list_obj->meta)
                                            <tr>
                                                <td>{{$applied_jobs_cv_list_obj->id}}</td>
                                                <td title="{{$applied_jobs_cv_list_obj->job && $applied_jobs_cv_list_obj->job->title ? $applied_jobs_cv_list_obj->job->title : ''}}">{{$applied_jobs_cv_list_obj->job && $applied_jobs_cv_list_obj->job->title ? Str::limit($applied_jobs_cv_list_obj->job->title,25) : ''}}</td>
                                                <td>{{$applied_jobs_cv_list_obj->name}}</td>
                                                <td>{{$applied_jobs_cv_list_obj->email}}</td>
                                                <td>{{$applied_jobs_cv_list_obj->telephone}}</td>
                                                <td>{{$applied_jobs_cv_list_obj->dob}}</td>
                                                <td>{{$applied_jobs_cv_list_obj->education}}</td>
                                                <td title="{{$applied_jobs_cv_list_obj->current_position}}">{{Str::limit($applied_jobs_cv_list_obj->current_position,25)}}</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="mr-1 shortlist-apply-job" data-company_id="{{$applied_jobs_cv_list_obj->job ? $applied_jobs_cv_list_obj->job->company_id : ''}}" data-apply_job_id = "{{$applied_jobs_cv_list_obj->id}}"><i class="far fa-heart"></i></a>
                                                    @if($applied_jobs_cv_list_obj->cv_type == 'external-cv' && $applied_jobs_cv_list_obj->media)
                                                        <a href="{{\App\Helpers\common::getMediaPath($applied_jobs_cv_list_obj->media)}}" target="_blank"><i class="fas fa-eye"></i></a>
                                                    @else
                                                        <a href="{{$applied_jobs_cv_list_obj->cv ? url('my-business/cv/view_pdf_cv', $applied_jobs_cv_list_obj->cv->id) : '#'}}" target="_blank"><i class="fas fa-eye"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr class="odd"><td valign="top" colspan="9" class="dataTables_empty">Ingen opptak funnet</td></tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="shortlisted_cv" role="tabpanel" aria-labelledby="shortlisted-tab">
                        <div class="inner-tab">
                            <table class="table table-hover table-bordered table-striped" id="shorlisted_applied_job_table">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Jobb</th>
                                    <th>Bruker</th>
                                    <th>Epost</th>
                                    <th>Telefon</th>
                                    <th>Fødselsår</th>
                                    <th>Utdannelse</th>
                                    <th>Nåværende stilling</th>
                                    <th>Utsikt</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($shortlisted_applied_jobs_cv_list->count() > 0)
                                    @foreach($shortlisted_applied_jobs_cv_list as $key=>$shortlisted_jobs_cv_list_obj)
                                        <tr>
                                            <td>{{$shortlisted_jobs_cv_list_obj->meta->id}}</td>
                                            <td title="{{$shortlisted_jobs_cv_list_obj->job && $shortlisted_jobs_cv_list_obj->job->title ? $shortlisted_jobs_cv_list_obj->job->title : ''}}">{{$shortlisted_jobs_cv_list_obj->job && $shortlisted_jobs_cv_list_obj->job->title ? Str::limit($shortlisted_jobs_cv_list_obj->job->title,25) : ''}}</td>
                                            <td>{{$shortlisted_jobs_cv_list_obj->name}}</td>
                                            <td>{{$shortlisted_jobs_cv_list_obj->email}}</td>
                                            <td>{{$shortlisted_jobs_cv_list_obj->telephone}}</td>
                                            <td>{{$shortlisted_jobs_cv_list_obj->dob}}</td>
                                            <td>{{$shortlisted_jobs_cv_list_obj->education}}</td>
                                            <td title="{{$shortlisted_jobs_cv_list_obj->current_position}}">{{Str::limit($shortlisted_jobs_cv_list_obj->current_position,25)}}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="mr-1 remove-shortlist-apply-job" data-url="{{route('metas.destroy',$shortlisted_jobs_cv_list_obj->meta->id)}}"><i class="fas fa-heart"></i></a>
                                                @if($shortlisted_jobs_cv_list_obj->cv_type == 'external-cv' && $shortlisted_jobs_cv_list_obj->media)
                                                    <a href="{{\App\Helpers\common::getMediaPath($shortlisted_jobs_cv_list_obj->media)}}" target="_blank"><i class="fas fa-eye"></i></a>
                                                @else
                                                    <a href="{{$shortlisted_jobs_cv_list_obj->cv ? url('my-business/cv/view_pdf_cv', $shortlisted_jobs_cv_list_obj->cv->id) : '#'}}" target="_blank"><i class="fas fa-eye"></i></a>
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
                </div>
            </div>


        </div>
    </main>
<script>
$(document).ready( function () {
    $('#cv_list').DataTable({
        "order": [[ 0, "desc" ]]
    });
} );    
</script>

@endsection