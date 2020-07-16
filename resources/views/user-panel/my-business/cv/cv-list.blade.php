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
        <div class="dme-container col-12">
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
                <ul class="nav nav-tabs mb-5" id="cv_tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="cv-tab" data-toggle="tab" href="#cvs" role="tab"
                           aria-controls="home" aria-selected="true">CV liste</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="shortlisted-tab" data-toggle="tab" href="#shortlisted_cv" role="tab"
                           aria-controls="profile" aria-selected="false">Utvalgte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="requested-tab" data-toggle="tab" href="#requested_cv" role="tab"
                           aria-controls="profile" aria-selected="false">Forespørsler</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="cvs" role="tabpanel" aria-labelledby="cv-tab">
                        <div class="inner-tab">
                            <table class="table table-hover table-bordered table-striped" id="cv_list">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Tittel</th>
                                    <th>Bransje</th>
                                    <th>Navn</th>
                                    <th>E-post</th>
                                    <th>Sist oppdatert</th>
                                    <th>Utløper</th>
                                    <th>Handling</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($cvs->count() > 0)
                                    @foreach($cvs as $key=>$cv)
                                        @if(!$cv->meta && $cv->user && !$cv->user->cv_requests_sent())
                                            <tr>
                                                <td>{{$cv->id}}</td>
                                                <td>
                                                    {{$cv->personal && $cv->personal->title ? $cv->personal->title : ''}}
                                                </td>
                                                <td>
                                                    @if($cv->personal && $cv->personal->industries)
                                                        @php
                                                            $industries = array();
                                                            $industries = json_decode($cv->personal->industries);
                                                        @endphp

                                                        @if(count($industries))
                                                            <ul class="pl-4">
                                                                @foreach($industries as $industry)
                                                                    <li>{{$industry}}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($cv->visibility == 'anonymous')
                                                        Anonym
                                                    @else
                                                        {{$cv->personal && ($cv->personal->first_name || $cv->personal->last_name) ? $cv->personal->first_name.' '.$cv->personal->last_name : ''}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($cv->visibility == 'anonymous')
                                                        Anonym
                                                    @else
                                                        {{$cv->personal && $cv->personal->email ? $cv->personal->email : ''}}
                                                    @endif
                                                </td>
                                                <td>{{$cv->updated_at ? date('d-m-Y', strtotime($cv->updated_at)) : ''}}</td>
                                                <td>{{$cv->expiry ? date('d-m-Y',strtotime($cv->expiry)) : ''}}</td>
                                                <td>
                                                    <a href="javascript:void(0);" class="mr-1 shortlist-cv" title="Kortliste CV" data-id="{{$cv->id}}"><i class="far fa-heart"></i></a>
                                                    @if($cv->visibility == 'anonymous')
                                                        <a href="javascript:void(0);" class="mr-1 send-request" title="Send forespørsel" data-user_id="{{$cv->user ? $cv->user->id : ''}}"><i class="fas fa-share"></i></a>
                                                    @endif
                                                    <a href="{{ $cv->visibility == 'anonymous' ? url('my-business/cv/view_pdf_cv/'.$cv->id.'/yes') : url('my-business/cv/view_pdf_cv/'.$cv->id)}}" title="Se CV" target="_blank" class="mr-1"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ $cv->visibility == 'anonymous' ?  url('my-business/cv/download_pdf/'.$cv->id.'/yes') : url('my-business/cv/download_pdf/'.$cv->id)}}" title="Last ned CV"  target="_blank"><i class="fas fa-arrow-circle-down"></i></a>

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr class="odd"><td valign="top" colspan="9" class="dataTables_empty text-center">Ingen opptak funnet</td></tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="shortlisted_cv" role="tabpanel" aria-labelledby="shortlisted-tab">
                        <div class="inner-tab">
                            <table class="table table-hover table-bordered table-striped" id="shortlisted_cv_list">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Tittel</th>
                                    <th>Bransje</th>
                                    <th>Navn</th>
                                    <th>E-post</th>
                                    <th>Sist oppdatert</th>
                                    <th>Utløper</th>
                                    <th>Handling</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($shortlisted_cvs->count() > 0)
                                    @foreach($shortlisted_cvs as $key=>$shortlisted_cv)
                                        @if($shortlisted_cv->meta && !$shortlisted_cv->user->cv_requests_sent())
                                            <tr>
                                                <td>{{$shortlisted_cv->meta->id}}</td>
                                                <td>
                                                    {{$shortlisted_cv->personal && $shortlisted_cv->personal->title ? $shortlisted_cv->personal->title : ''}}
                                                </td>
                                                <td>
                                                    @if($shortlisted_cv->personal && $shortlisted_cv->personal->industries)
                                                        @php
                                                            $industries = array();
                                                            $industries = json_decode($shortlisted_cv->personal->industries);
                                                        @endphp

                                                        @if(count($industries))
                                                            <ul class="pl-4">
                                                                @foreach($industries as $industry)
                                                                    <li>{{$industry}}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($shortlisted_cv->visibility == 'anonymous')
                                                        Anonym
                                                    @else
                                                        {{$shortlisted_cv->personal && ($shortlisted_cv->personal->first_name || $shortlisted_cv->personal->last_name) ? $shortlisted_cv->personal->first_name.' '.$shortlisted_cv->personal->last_name : ''}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($shortlisted_cv->visibility == 'anonymous')
                                                        Anonym
                                                    @else
                                                        {{$shortlisted_cv->personal && $shortlisted_cv->personal->email ? $shortlisted_cv->personal->email : ''}}
                                                    @endif
                                                </td>
                                                <td>{{$shortlisted_cv->updated_at ? date('d-m-Y', strtotime($shortlisted_cv->updated_at)) : ''}}</td>
                                                <td>{{$shortlisted_cv->expiry ? date('d-m-Y',strtotime($shortlisted_cv->expiry)) : ''}}</td>
                                                <td>
                                                    <a href="javascript:void(0);" class="mr-1 remove-shortlist-cv" title="Fjern cv fra kortlisten" data-url="{{route('metas.destroy',$shortlisted_cv->meta->id)}}"><i class="fas fa-heart"></i></a>
                                                    @if($shortlisted_cv->visibility == 'anonymous')
                                                        <a href="#" class="mr-1 send-request" title="Send forespørsel" data-user_id="{{$shortlisted_cv->user ? $shortlisted_cv->user->id : ''}}"><i class="fas fa-share"></i></a>
                                                    @endif

                                                    <a href="{{ $shortlisted_cv->visibility == 'anonymous' ? url('my-business/cv/view_pdf_cv/'.$shortlisted_cv->id.'/yes') : url('my-business/cv/view_pdf_cv/'.$shortlisted_cv->id)}}" title="Se CV" target="_blank" class="mr-1"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ $shortlisted_cv->visibility == 'anonymous' ?  url('my-business/cv/download_pdf/'.$shortlisted_cv->id.'/yes') : url('my-business/cv/download_pdf/'.$shortlisted_cv->id)}}" title="Last ned CV"  target="_blank"><i class="fas fa-arrow-circle-down"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr class="odd"><td valign="top" colspan="9" class="dataTables_empty text-center">Ingen opptak funnet</td></tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="requested_cv" role="tabpanel" aria-labelledby="requested-cv">
                        <div class="inner-tab">
                            <table class="table table-hover table-bordered table-striped" id="requested_cv_table">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Tittel</th>
                                    <th>Bransje</th>
                                    <th>Navn</th>
                                    <th>E-post</th>
                                    <th>Sist oppdatert</th>
                                    <th>Utløper</th>
                                    <th>Status</th>
                                    <th>Handling</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($requested_cvs->count() > 0)
                                    @foreach($requested_cvs as $key=>$requested_cv)
                                        @if($requested_cv->user && $requested_cv->user->cv_requests_sent())
                                            <tr style="
                                                @if($requested_cv->user->cv_requests_sent()->status == "accepted")
                                                    background-color: #28a745;
                                                    color: white;
                                                @elseif($requested_cv->user->cv_requests_sent()->status == "rejected")
                                                    background-color: #dc3545;
                                                    color: white;
                                                @endif">
                                                <td>{{$requested_cv->user->cv_requests_sent()->id}}</td>
                                                <td>
                                                    {{$requested_cv->personal && $requested_cv->personal->title ? $requested_cv->personal->title : ''}}
                                                </td>
                                                <td>
                                                    @if($requested_cv->personal && $requested_cv->personal->industries)
                                                        @php
                                                            $industries = array();
                                                            $industries = json_decode($requested_cv->personal->industries);
                                                        @endphp

                                                        @if(count($industries))
                                                            <ul class="pl-4">
                                                                @foreach($industries as $industry)
                                                                    <li>{{$industry}}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($requested_cv->user->cv_requests_sent()->status == "accepted")
                                                        {{$requested_cv->personal && ($requested_cv->personal->first_name || $requested_cv->personal->last_name) ? $requested_cv->personal->first_name.' '.$requested_cv->personal->last_name : ''}}
                                                    @elseif($requested_cv->user->cv_requests_sent()->status != "accepted")
                                                        Anonym
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($requested_cv->user->cv_requests_sent()->status == "accepted")
                                                        {{$requested_cv->personal && $requested_cv->personal->email ? $requested_cv->personal->email : ''}}
                                                    @elseif($requested_cv->user->cv_requests_sent()->status != "accepted")
                                                        Anonym
                                                    @endif
                                                </td>
                                                <td>{{$requested_cv->updated_at ? date('d-m-Y', strtotime($requested_cv->updated_at)) : ''}}</td>
                                                <td>{{$requested_cv->expiry ? date('d-m-Y',strtotime($requested_cv->expiry)) : ''}}</td>
                                                <td>
                                                    @if($requested_cv->user->cv_requests_sent()->status == "requested")
                                                        <span class="badge badge-primary">Avventer</span>
                                                    @elseif($requested_cv->user->cv_requests_sent()->status == "accepted")
                                                        <span class="badge badge-success">Akseptert</span>
                                                    @elseif($requested_cv->user->cv_requests_sent()->status == "rejected")
                                                        <span class="badge badge-danger">Avvist</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($requested_cv->meta)
                                                        <a @if($requested_cv->user->cv_requests_sent()->status != "requested") style="color: white;" @endif href="javascript:void(0);" class="mr-1 remove-shortlist-cv" title="Fjern cv fra kortlisten" data-url="{{route('metas.destroy',$requested_cv->meta->id)}}"><i class="fas fa-heart"></i></a>
                                                    @else
                                                        <a @if($requested_cv->user->cv_requests_sent()->status != "requested") style="color: white;" @endif href="javascript:void(0);" class="mr-1 shortlist-cv" title="Kortliste CV" data-id="{{$requested_cv->id}}"><i class="far fa-heart"></i></a>
                                                    @endif

                                                    @if($requested_cv->user->cv_requests_sent()->status == "accepted")
                                                        <a style="color: white;" href="{{url('my-business/cv/view_pdf_cv/'.$requested_cv->id)}}" title="Se CV" target="_blank" class="mr-1"><i class="fas fa-eye"></i></a>
                                                        <a style="color: white;" href="{{url('my-business/cv/download_pdf/'.$requested_cv->id)}}" title="Last ned CV"  target="_blank"><i class="fas fa-arrow-circle-down"></i></a>
                                                    @else
                                                        <a @if($requested_cv->user->cv_requests_sent()->status == "rejected") style="color: white;" @endif href="{{url('my-business/cv/view_pdf_cv/'.$requested_cv->id.'/yes')}}" title="Se CV" target="_blank" class="mr-1"><i class="fas fa-eye"></i></a>
                                                        <a @if($requested_cv->user->cv_requests_sent()->status == "rejected") style="color: white;" @endif href="{{url('my-business/cv/download_pdf/'.$requested_cv->id.'/yes')}}" title="Last ned CV"  target="_blank"><i class="fas fa-arrow-circle-down"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr class="odd"><td valign="top" colspan="9" class="dataTables_empty text-center">Ingen opptak funnet</td></tr>
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
    @if($cvs->count() > 0)
        jquery_data_tables_languages($('#cv_list'));
    @endif

    @if($shortlisted_cvs->count() > 0)
        jquery_data_tables_languages($('#shortlisted_cv_list'));
    @endif

    @if($requested_cvs->count() > 0)
        jquery_data_tables_languages($('#requested_cv_table'));
    @endif


    function showTab(hash) {
        if (location.hash != "") {
            $('#cv_tabs .nav-link').removeClass('active');
            $('.tab-pane').removeClass('show');
            $('.tab-pane').removeClass('active');
            $('.tab-pane' + hash).addClass('show');
            $('.tab-pane' + hash).addClass('active');
            $('#cv_tabs .nav-item a[href="'+hash+'"]').addClass('active');
        }
    }

    showTab(location.hash);

    $(document).on('click', '#cv_tabs a', function () {
        location.hash = $(this).attr('href');
    });

    //add apply job cv from Cv Meta
    $(document).on('click', '.shortlist-cv', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        // var id = $(this).data('company_id');
        var company_id = null;

        $.ajax({
            url: "{{route('metas.store')}}",
            type: "POST",
            data: {'value':id,'key':'cv','company_id':company_id},
            async: false,
            success: function (response) {
                if(response.msg == 'Cv er allerede på listen.'){
                    notify("error",response.msg);
                }else{
                    location.reload();
                }
            },
            error: function (jqXhr, json, errorThrown) { // this are default for ajax errors
                var errors = jqXhr.responseJSON;

                notify("error","noe gikk galt!");
                return false;
            },
        });
    });

    //remove apply job cv from Cv Meta
    $(document).on('click', '.remove-shortlist-cv', function (e) {
        e.preventDefault();

        var url = $(this).data('url');
        $.ajax({
            url: url,
            type: "delete",
            async: false,
            success: function (response) {
                location.reload();
            },
            error: function (jqXhr, json, errorThrown) { // this are default for ajax errors
                var errors = jqXhr.responseJSON;

                notify("error","noe gikk galt!");
                return false;
            },
        });
    });

    //Sent request to view CV
    $(document).on('click', '.send-request', function (e) {
        e.preventDefault();
        var user_id = $(this).data('user_id');
        var employer_id = '{{\Illuminate\Support\Facades\Auth::id()}}';
        $.ajax({
            url: '{{route('cv-request')}}',
            type: "POST",
            data:{'user_id':user_id,'employer_id':employer_id,'status':'requested'},
            async: false,
            success: function (response) {
                location.reload();
            },
            error: function (jqXhr, json, errorThrown) { // this are default for ajax errors
                var errors = jqXhr.responseJSON;

                notify("error","noe gikk galt!");
                return false;
            },
        });
    });
} );    
</script>

@endsection