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
                        <li class="breadcrumb-item"><a href="#">liste CV</a></li> <!-- ('cv.breadcrumb.main') -->
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
                                    <a href="#" class="mr-1"><i class="far fa-heart"></i></a>
                                    @if($applied_jobs_cv_list_obj->cv_type == 'external-cv' && $applied_jobs_cv_list_obj->media)
                                        <a href="{{\App\Helpers\common::getMediaPath($applied_jobs_cv_list_obj->media)}}" target="_blank"><i class="fas fa-eye"></i></a>
                                    @else
                                        <a href="{{$applied_jobs_cv_list_obj->user && $applied_jobs_cv_list_obj->user->cv ? url('my-business/cv/view_pdf_cv', $applied_jobs_cv_list_obj->user->cv->id) : '#'}}" target="_blank"><i class="fas fa-eye"></i></a>
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
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#applied_job_table').DataTable();
        } );
    </script>
@endsection