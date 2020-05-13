@extends('layouts.landingSite')

@section('page_content')
    @php
        $user_follow_company = \App\Models\Following::where('user_id',\Illuminate\Support\Facades\Auth::id())->where('company_id',$company->id)->first();
         $commitment_type = \App\Taxonomy::where('slug', 'commitment_type')->first();
        $commitment_types = $commitment_type->terms;
    @endphp
<main class="single-company">
    <div class="dme-container">
        <div class="breade-crumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{url('jobs')}}">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Job </font>
                            </font>
                        </a></li>
                    <li class="breadcrumb-item">
                        <a href="{{url('companies')}}">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Bedriftsprofiler </font>
                            </font>
                        </a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">{{$company->emp_name}}</font>
                        </font>
                    </li>
                </ol>
            </nav>
        </div>

        <!--------bread-crumb end----->

        <div class="mt-5 mb-3">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{$company->company_logo->first() ? \App\Helpers\common::getMediaPath($company->company_logo->first()) : asset('/public/images/1280x720.png')}}" alt="logo" width="100">
                </div>
                <div class="col-md-6 text-right">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">{{$company->followings->count()}} følgere </font>
                    </font>
                    <button class="dme-btn-outlined-blue follow-company-button" data-url="{{url('company-follow')}}" data-company_id="{{$company->id}}">@if($user_follow_company) Følger @else Følg @endif</button>
                </div>
            </div>
        </div>

        <!--------folg button end----->

        <div class="row">
            <div class="col-md-12">
                <img src="{{$company->company_gallery->count() ? \App\Helpers\common::getMediaPath($company->company_gallery->first()) : ''}}" alt="" class="img-fluid">
            </div>
            <div class="text pt-4 pl-4 pr-4 pb-2">
                <h2 class="text-dark">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">{{ $company->emp_name }}</font>
                    </font>
                </h2>
                <p style="font-size: 20px;">
                {!! $company->emp_company_information !!}
                </p>
                @if($company->emp_website)
                    <a href="{{$company->emp_website}}" target="_blank">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Les mer på våre hjemmesider </font>
                        </font><span class="ml-1"><i class="fas fa-external-link-alt"></i></span>
                    </a>
                @endif
            </div>

        </div>

        <hr>
        <!------main image section end------>
        @if($company->company_gallery->count() > 1)
            <div class="gallery mt-4 mb-5">
                <div class="row row-eq-height">
                    @foreach($company->company_gallery as $key=>$company_gallery)
                        @if($key == 4) @break @endif
                        @if($key == 1)
                            <div class="col-md-8">
                                <img src="{{\App\Helpers\common::getMediaPath($company_gallery)}}" alt="" class="img-fluid w-100 h-100 radius-8">
                            </div>
                        @endif
                        @if($key == 2)
                            <div class="col-md-4">
                                <img src="{{\App\Helpers\common::getMediaPath($company_gallery)}}" alt="" class="img-fluid mb-4 radius-8">
                                @if(isset($company->company_gallery[3]))
                                    <img src="{{\App\Helpers\common::getMediaPath($company->company_gallery[3])}}" alt="" class="img-fluid radius-8">
                                @endif
                            </div>
                        @endif
                    @endforeach
                    @if($company->company_gallery->count() > 4)
                        <div class="col-12 text-center mt-4">
                            <a class="btn btn btn-outline-primary show_more_gallery">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">show more</font>
                                </font>
                            </a>
                        </div>
                        <div id="more_gallery" class="d-none">
                            @foreach($company->company_gallery as $key=>$company_gallery)
                                @if($key == 4)
                                    <div class="col-6">
                                        <img src="{{\App\Helpers\common::getMediaPath($company_gallery)}}" alt="" class="img-fluid radius-8">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
            <hr>
        @endif



        <!------gallery section end------>

        <div class="row mt-4 mb-3">
            <div class="col-md-6">
                <h3 class="text-dark">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Ledige stillinger</font>
                    </font>
                </h3>
            </div>
            <div class="col-md-6 text-right">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">{{$company->followings->count()}} følgere </font>
                </font>
                <button class="dme-btn-outlined-blue follow-company-button" data-url="{{url('company-follow')}}" data-company_id="{{$company->id}}">@if($user_follow_company) Følger @else Følg @endif</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p class="mb-1">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Velg stillingstype</font>
                    </font>
                </p>

                <select class="form-control commitment_job_dropdown">
                    <option value="all">Alle stillingstype ({{(\App\Helpers\common::company_commitment_jobs($company->id,'all'))->count()}})</option>
                    @foreach($commitment_types as $commitment_type)
                        <option value="{{$commitment_type['name']}}">{{$commitment_type['name']}} ({{(\App\Helpers\common::company_commitment_jobs($company->id,$commitment_type['name']))->count()}})</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6"></div>
        </div>

        <div class="row mt-4 mb-5 all commitment_jobs">
            @php $jobs = \App\Helpers\common::company_commitment_jobs($company->id,'all'); @endphp
            @if($jobs->count() > 0)
                @foreach($jobs as $key=>$job)
                    <div class="col-md-6 mb-2">
                        <h4 class="mb-0" style="font-size: 20px;">
                            <a href="{{route('jobs.show',$job->id)}}" target="_blank">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{$job->name}}</font>
                                </font>
                            </a>
                        </h4>
                        <p class="mb-0">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{$job->name}}</font>
                            </font>
                        </p>
                        {{--<p class="mb-0">--}}
                            {{--<font style="vertical-align: inherit;">--}}
                                {{--<font style="vertical-align: inherit;">{{$job->address ? $job->address.', ': ''.$job->zip_city}}</font>--}}
                            {{--</font>--}}
                        {{--</p>--}}
                    </div>
                @endforeach
            @else
                <div class="col-md-6 m-auto"><p class="alert alert-warning">Ingen jobb funnet</p></div>
            @endif
        </div>

        <div class="row mt-4 mb-5 Engasjement commitment_jobs d-none">
            @php $jobs = \App\Helpers\common::company_commitment_jobs($company->id,'Engasjement'); @endphp
            @if($jobs->count() > 0)
                @foreach($jobs as $key=>$job)
                    <div class="col-md-6 mb-2">
                        <h4 class="mb-0" style="font-size: 20px;">
                            <a href="{{route('jobs.show',$job->id)}}" target="_blank">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{$job->name}}</font>
                                </font>
                            </a>
                        </h4>
                        <p class="mb-0">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{$job->name}}</font>
                            </font>
                        </p>
                    </div>
                @endforeach
            @else
                <div class="col-md-6 m-auto"><p class="alert alert-warning">Ingen jobb funnet</p></div>
            @endif
        </div>

        <div class="row mt-4 mb-5 Fast commitment_jobs d-none">
            @php $jobs = \App\Helpers\common::company_commitment_jobs($company->id,'Fast'); @endphp
            @if($jobs->count() > 0)
                @foreach($jobs as $key=>$job)
                    <div class="col-md-6 mb-2">
                        <h4 class="mb-0" style="font-size: 20px;">
                            <a href="{{route('jobs.show',$job->id)}}" target="_blank">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{$job->name}}</font>
                                </font>
                            </a>
                        </h4>
                        <p class="mb-0">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{$job->name}}</font>
                            </font>
                        </p>
                    </div>
                @endforeach
            @else
                <div class="col-md-6 m-auto"><p class="alert alert-warning">Ingen jobb funnet</p></div>
            @endif
        </div>

        <div class="row mt-4 mb-5 Prosjekt commitment_jobs d-none">
            @php $jobs = \App\Helpers\common::company_commitment_jobs($company->id,'Prosjekt'); @endphp
            @if($jobs->count() > 0)
                @foreach($jobs as $key=>$job)
                    <div class="col-md-6 mb-2">
                        <h4 class="mb-0" style="font-size: 20px;">
                            <a href="{{route('jobs.show',$job->id)}}" target="_blank">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{$job->name}}</font>
                                </font>
                            </a>
                        </h4>
                        <p class="mb-0">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{$job->name}}</font>
                            </font>
                        </p>
                    </div>
                @endforeach
            @else
                <div class="col-md-6 m-auto"><p class="alert alert-warning">Ingen jobb funnet</p></div>
            @endif
        </div>

        <div class="row mt-4 mb-5 Lærling commitment_jobs d-none">
            @php $jobs = \App\Helpers\common::company_commitment_jobs($company->id,'Lærling'); @endphp
            @if($jobs->count() > 0)
                @foreach($jobs as $key=>$job)
                    <div class="col-md-6 mb-2">
                        <h4 class="mb-0" style="font-size: 20px;">
                            <a href="{{route('jobs.show',$job->id)}}" target="_blank">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{$job->name}}</font>
                                </font>
                            </a>
                        </h4>
                        <p class="mb-0">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{$job->name}}</font>
                            </font>
                        </p>
                    </div>
                @endforeach
            @else
                <div class="col-md-6 m-auto"><p class="alert alert-warning">Ingen jobb funnet</p></div>
            @endif
        </div>

        <div class="row mt-4 mb-5 Selvstendig commitment_jobs d-none">
            @php $jobs = \App\Helpers\common::company_commitment_jobs($company->id,'Selvstendig næringsdrivende'); @endphp
            @if($jobs->count() > 0)
                @foreach($jobs as $key=>$job)
                    <div class="col-md-6 mb-2">
                        <h4 class="mb-0" style="font-size: 20px;">
                            <a href="{{route('jobs.show',$job->id)}}" target="_blank">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{$job->name}}</font>
                                </font>
                            </a>
                        </h4>
                        <p class="mb-0">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{$job->name}}</font>
                            </font>
                        </p>
                    </div>
                @endforeach
            @else
                <div class="col-md-6 m-auto"><p class="alert alert-warning">Ingen jobb funnet</p></div>
            @endif
        </div>

        <div class="row mt-4 mb-5 Sommer commitment_jobs d-none">
            @php $jobs = \App\Helpers\common::company_commitment_jobs($company->id,'Sommer/Sesong'); @endphp
            @if($jobs->count() > 0)
                @foreach($jobs as $key=>$job)
                    <div class="col-md-6 mb-2">
                        <h4 class="mb-0" style="font-size: 20px;">
                            <a href="{{route('jobs.show',$job->id)}}" target="_blank">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{$job->name}}</font>
                                </font>
                            </a>
                        </h4>
                        <p class="mb-0">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{$job->name}}</font>
                            </font>
                        </p>
                    </div>
                @endforeach
            @else
                <div class="col-md-6 m-auto"><p class="alert alert-warning">Ingen jobb funnet</p></div>
            @endif
        </div>

        <div class="row mt-4 mb-5 Trainee commitment_jobs d-none">
            @php $jobs = \App\Helpers\common::company_commitment_jobs($company->id,'Trainee'); @endphp
            @if($jobs->count() > 0)
                @foreach($jobs as $key=>$job)
                    <div class="col-md-6 mb-2">
                        <h4 class="mb-0" style="font-size: 20px;">
                            <a href="{{route('jobs.show',$job->id)}}" target="_blank">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{$job->name}}</font>
                                </font>
                            </a>
                        </h4>
                        <p class="mb-0">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{$job->name}}</font>
                            </font>
                        </p>
                    </div>
                @endforeach
            @else
                <div class="col-md-6 m-auto"><p class="alert alert-warning">Ingen jobb funnet</p></div>
            @endif
        </div>

        <div class="row mt-4 mb-5 Vikariat commitment_jobs d-none">
            @php $jobs = \App\Helpers\common::company_commitment_jobs($company->id,'Vikariat'); @endphp
            @if($jobs->count() > 0)
                @foreach($jobs as $key=>$job)
                    <div class="col-md-6 mb-2">
                        <h4 class="mb-0" style="font-size: 20px;">
                            <a href="{{route('jobs.show',$job->id)}}" target="_blank">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{$job->name}}</font>
                                </font>
                            </a>
                        </h4>
                        <p class="mb-0">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{$job->name}}</font>
                            </font>
                        </p>
                    </div>
                @endforeach
            @else
                <div class="col-md-6 m-auto"><p class="alert alert-warning">Ingen jobb funnet</p></div>
            @endif
        </div>

    </div>
    <!---links section end----->
</main>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('change', '.commitment_job_dropdown', function (e) {
                var val = $(this).val();
                $('.commitment_jobs').addClass('d-none');
                if(val === "Selvstendig næringsdrivende"){
                    $('.Selvstendig').removeClass('d-none');
                }else if(val === "Sommer/Sesong"){
                    $('.Sommer').removeClass('d-none');
                }else{
                    $('.'+val).removeClass('d-none');
                }
            });

            $(document).on('click', '.show_more_gallery', function (e) {
                $(this).addClass('d-none');
                $('#more_gallery').removeClass('d-none');

            });
        });
    </script>
@endsection