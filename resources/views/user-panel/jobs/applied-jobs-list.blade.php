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
                <div class="col-4 float-right mb-2 pr-0">
                    <div class="input-group search-box ">
                        <input type="text" name="landing_list_search" id="landing_list_search" class="form-control search-control" placeholder="Filtrer..." autofocus="">
                        <label for="search"><span class="input-group-addon">
                        <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" height="32" width="32">
                        <path fill="currentColor" fill-rule="evenodd" d="M22.412
                            21.198l-.558.656-.656.558a10.449 10.449 0 0 1-6.754 2.476C8.685
                            24.888 4 20.203 4 14.444 4 8.685 8.685 4 14.444 4c5.759 0 10.445
                            4.685 10.445 10.444 0 2.473-.88 4.872-2.477 6.754zm1.524
                            1.294a12.393 12.393 0 0 0 2.953-8.048C26.889 7.571 21.317 2 14.444 2
                            7.572 2 2 7.571 2 14.444c0 6.873 5.572 12.444 12.444 12.444 3.069 0
                            5.878-1.11 8.048-2.952L28.556 30 30 28.555l-6.064-6.063z"></path>
                        </svg>
                        </span>
                        </label>
                    </div>
                </div>

              <table class="table table-hover table-bordered table-striped">
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
            @if($applied_jobs_cv->count() > 0)
                @foreach($applied_jobs_cv as $key=>$applied_job_cv)
                    <tr class="end_fav_item" data-name="{{$applied_job_cv->name}}">
                        <td>{{$applied_job_cv->id}}</td>
                        <td title="{{$applied_job_cv->job && $applied_job_cv->job->title ? $applied_job_cv->job->title : ''}}">{{$applied_job_cv->job && $applied_job_cv->job->title ? Str::limit($applied_job_cv->job->title,25) : ''}}</td>
                        <td>{{$applied_job_cv->name}}</td>
                        <td>{{$applied_job_cv->email}}</td>
                        <td>{{$applied_job_cv->telephone}}</td>
                        <td>{{$applied_job_cv->dob}}</td>
                        <td>{{$applied_job_cv->education}}</td>
                        <td title="{{$applied_job_cv->current_position}}">{{Str::limit($applied_job_cv->current_position,25)}}</td>
                        <td>
                            @if($applied_job_cv->cv_type == 'external-cv' && $applied_job_cv->media)
                                <a href="{{\App\Helpers\common::getMediaPath($applied_job_cv->media)}}" target="_blank"><i class="fas fa-eye"></i></a>
                            @else
                                <a href="{{$applied_job_cv->user && $applied_job_cv->user->cv ? url('my-business/cv/view_pdf_cv', $applied_job_cv->user->cv->id) : '#'}}" target="_blank"><i class="fas fa-eye"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="9"><p class="alert alert-warning">Det er ingen elementer på listen!.</p></td></tr>
            @endif

            <tr class="not"><td colspan="9"><p class="alert alert-warning">Det er ingen elementer på listen!.</p></td></tr>


        </tbody>
    </table>

              
            </div>

        </div>
    </main>
@endsection
@section('script')
    <script>

        $('#landing_list_search12').keyup(function (e) {
            if($(this).val().length > 0){
                $.each($('.end_fav_item'), function(){
                    if($(this).attr('data-name').toLowerCase().search($('#landing_list_search').val().toLowerCase())<0){
                        $(this).hide()
                    }
                    else{
                        $(this).show();
                    }
                });
            }
            else{
                $('.end_fav_item').show();
            }
        });

        $('#landing_list_search').keyup(function(){

            // Search Text
            var search = $(this).val().toUpperCase();


            $("table > tbody > tr").each(function() {
                if ($(this).text().toUpperCase().search(search) > -1) {
                    $(this).show();
                }
                else {
                    $(this).hide();
                }
            });
        });

    </script>
@endsection