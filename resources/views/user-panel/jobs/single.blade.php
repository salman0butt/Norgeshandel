@extends('layouts.landingSite')

@section('main_title')
    NorgesHandel - {{$job->title}}
@endsection
@section('page_content')
    <?php
    $job_function = "";
    $logo = $job->ad->media()->where('type', 'logo')->get()->first();

    if (!empty($logo)) {
        $logo = \App\Helpers\common::getMediaPath($logo, '150x150');
    }else{
        if ($job->company_id != 0) {
            if (is_countable($job->company->company_logo) && count($job->company->company_logo) > 0) {
                $logo = \App\Helpers\common::getMediaPath($job->company->company_logo->first(),'150x150');
            }
        }
    }
    ?>
    <main>

        @php $banner_ad_category = 'jobs-landing'; @endphp
        <div class="left-ad float-left" id="left_banner_ad">
            @include('user-panel.banner-ads.left-banner')
        </div>
        <div class="dme-container">
            <div class="row top-ad" id="top_banner_ad">
                @include('user-panel.banner-ads.top-banner')
            </div>
        </div>
        <div class="dme-container p-3">
            <div class="breade-crumb">
                <nav aria-label="breadcrumb">
                    <div class="row pl-3 pr-3">
                        <div class="col-md-6 p-0">
                            <ol class="breadcrumb w-100 "
                                style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">NorgesHandel </a></li>
                                <li class="breadcrumb-item active"><a href="{{url('jobs')}}">Jobb </a></li>
                            </ol>
                        </div>
                        <div class="col-md-6 p-0">
                            <ul class="breadcrumb w-100   text-right d-block"
                                style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;">
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{($prev) ? url('/', $prev->id) : url('jobs')}}"> &lt; Forrige </a>
                                </li>
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{url('jobs')}}">Til søket</a>
                                </li>
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{($next) ? url('/', $next->id) : url('jobs')}}"> Neste ></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @php $name = $job->ad->company_gallery; $obj = $job; @endphp
                    @if($name->count())
                        @include('user-panel.partials.landing_page_slider',compact('name'))
                    @endif

                    {{--<img src="{{asset('public/images/home.jpg')}}" alt="" class="img-fluid">--}}
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-8">
                    @php $ad = $job->ad; @endphp
                    @include('user-panel.partials.favorite-button',compact('ad'))
                    <div class="row single-realestate-detail p-3">
                        <div class="col-md-12">
                            <h1 class="u-t2 name">{{$job->name}}</h1>
                        </div>
                        <div class="col-md-12 text-muted">{{$job->address ? $job->address.', ' : ''}}
                            <span>
                                @if($job->zip)
                                    {{$job->zip}}
                                    {{$job->zip_city ? Str::ucfirst(Str::lower($job->zip_city)) : ''}}
                                @endif
                            </span>
                        </div>
                        <div class="bg-light-grey radius-8 col-md-12 p-3">
                            <div class="row">
                                <div class="col-md-12 title"><span
                                            class="font-weight-bold">Stillingstittel: </span><span>{{$job->title}}</span>
                                </div>
                                @if($job->emp_name)
                                    <div class="col-md-6 emp_name"><span
                                            class="font-weight-bold">Arbeidsgiver: </span><span>{{$job->emp_name}}</span>
                                    </div>
                                @endif
                                @if($job->country)
                                <div class="col-md-6 place"><span
                                        class="font-weight-bold">Sted: </span><span>{{$job->country}}</span></div>
                                @endif
                                <div class="col-md-6 commitment_type"><span
                                        class="font-weight-bold">Stillingstype: </span><span>{{$job->commitment_type}}</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="mt-2 col-md-12"></div>
                        <div class="bg-light-grey radius-8 col-md-12 p-3">
                            <div class="row">
                                <div class="col-md-6 sector"><span
                                        class="font-weight-bold">Sektor: </span>&nbsp;<span>{{$job->sector}}</span>
                                </div>
                                <div class="col-md-6 positions"><span
                                        class="font-weight-bold">Antall stillinger: </span>&nbsp;<span>{{$job->positions}}</span>
                                </div>
                                @if($job && $job->industry)
                                    <div class="col-md-6 industry">
                                        <span class="font-weight-bold">Bransje: </span>{{$job->industry}}<span>
                                        </span>
                                    </div>
                                @endif
                                @if($job->job_function)
                                    <div class="col-md-6 job-function"><span
                                            class="font-weight-bold">Jobbfunksjon: </span>&nbsp;<span>{{$job->job_function}}</span>
                                    </div>
                                @endif
                                @if($job->keywords)
                                    <div class="col-md-6 job-function">
                                        <span class="font-weight-bold">Nøkkelord: </span>&nbsp;
                                        <span>{{$job->keywords}}</span>
                                    </div>
                                @endif
                                @if($job->leadership_category)
                                    <div class="col-md-6 job-function">
                                        <span class="font-weight-bold">Lederkategori: </span>&nbsp;
                                        <span>{{$job->leadership_category}}</span>
                                    </div>
                                @endif
                                @if($job->deadline_type)
                                    <div class="col-md-6 job-function">
                                        <span class="font-weight-bold">Frist: </span>&nbsp;
                                        <span>{{$job->deadline_type}}</span>
                                    </div>
                                @endif
                                @if($job->deadline)
                                    <div class="col-md-6 job-function">
                                        <span class="font-weight-bold">Frist: </span>&nbsp;
                                        <span>{{date('d-m-Y',strtotime($job->deadline))}}</span>
                                    </div>
                                @endif
                                @if($job->accession)
                                    <div class="col-md-6 job-function">
                                        <span class="font-weight-bold">Tiltredelse: </span>&nbsp;
                                        <span>{{date('d-m-Y',strtotime($job->accession))}}</span>
                                    </div>
                                @endif
                                {{--@if($job->app_receive_by)--}}
                                    {{--<div class="col-md-6 job-function">--}}
                                        {{--<span class="font-weight-bold">Motta søknader via: </span>&nbsp;--}}
                                        {{--<span>{{ucfirst($job->app_receive_by)}}</span>--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            </div>
                        </div>
                        @if($job->description)
                            <div class="description mt-3 col-md-12" style="white-space: pre-line">
                                <span class="font-weight-bold">Stillingsbeskrivelse</span>
                                {{(($job->description))}}
                            </div>
                        @endif
                        <div class="emp_company_information mt-3 col-md-12">
                            @if(!empty($job->company))
                                <span class="font-weight-bold">Om arbeidsgiveren</span>
                                <div style="white-space: pre-line">{!! html_entity_decode($job->company->emp_company_information)!!}</div>
                            @else
                                <span class="font-weight-bold">Om arbeidsgiveren</span>
                                <div style="white-space: pre-line">{!! html_entity_decode($job->emp_company_information)!!}</div>
                            @endif

                        </div>
                        <div class="col-md-12"><a href="{{url('customer-services')}}" class="u-strong">Rapporter annonse</a></div>
                        <div class="col-md-12"><span class="font-weight-bold">Handelskode: </span>
                            <span> {{$job->ad->id}}</span></div>
                        <div class="col-md-12"><span class="font-weight-bold">Oppdatert: </span>
                            <span>{{ date('d.m.y',strtotime($job->ad->updated_at))}}</span></div>
                    </div>
                </div>
                {{----}}
                {{--right detail collumn--}}
                <div class="col-md-4">
                    <div class=" radius-8 p-3">
                        <div
                            style=" box-shadow: 0px 0px 2px 1px #ac304a; padding: 4px 10px; margin-bottom: 20px; border-radius: 5px;">
                            <div class="text-center">
                                <img src="{{asset($logo)}}" class="img-fluid emp-logo mt-3" style="max-width: 150px;"
                                     alt="">
                            </div>
                            <p class="mt-3 u-t3">Spørsmål om stillingen</p>
                            @if($job && $job->app_contact_title)
                                <div class="mb-2 contact-name">
                                    <span>Kontaktperson: </span>
                                    <span> {{$job->app_contact_title}} </span>
                                </div>
                            @endif
                            @if($job && $job->app_contact)
                                <div class="mb-2 contact-name">
                                    <span>Stillingstittel: </span>
                                    <span> {{$job->app_contact}} </span>
                                </div>
                            @endif
                            @if($job && $job->app_phone)
                                <div class="mb-2">
                                    <span class="contact-name">Telefon: </span>
                                    <span class="contact-tel"><a
                                            href="tel:{{$job->app_phone}}">  {{$job->app_phone}}</a></span>
                                </div>
                            @endif
                            @if($job && $job->app_mobile)
                                <div class="mb-2">
                                    <span class="contact-name">Mobil: </span>
                                    <span class="contact-tel"><a
                                            href="tel:{{$job->app_mobile}}">  {{$job->app_mobile}}</a></span>
                                </div>
                            @endif

                            @if($job && ($job->app_linkedin || $job->app_twitter))
                                <div class="mb-2">
                                    <span class="contact-name">Nettverk: </span>
                                    @if($job->app_linkedin)
                                        <span class="contact-tel"><a href="{{$job->app_linkedin}}">LinkedIn</a></span>
                                    @endif
                                    @if($job->app_linkedin && $job->app_twitter)<span>,</span>@endif
                                    @if($job->app_twitter)
                                        <span class="contact-tel"><a href="https://twitter.com/{{$job->app_twitter}}">Twitter</a></span>
                                    @endif
                                </div>
                            @endif
                            @if($job->company_id != 0)
                                @if($job->company && ($job->company->emp_facebook || $job->company->emp_linkedin || $job->company->emp_twitter))
                                    <div class="mb-2">
                                        <span class="contact-name">Bedriftens nettverk: </span>
                                        @if($job->company->emp_linkedin)
                                            <span class="contact-tel"><a href="{{$job->company->emp_linkedin}}">LinkedIn</a>,</span>
                                        @endif
{{--                                        @if($job->company->emp_linkedin && ($job->company->emp_twitter || $job->company->emp_facebook)) , @endif--}}
                                        @if($job->company->emp_twitter)
                                            <span class="contact-tel"><a href="https://twitter.com/{{$job->company->emp_twitter}}">Twitter</a>,</span>
                                        @endif
                                        {{--@if($job->company->emp_facebook && ($job->company->emp_twitter || $job->company->emp_linkedin)) , @endif--}}
                                        @if($job->company->emp_facebook)
                                            <span class="contact-tel"><a href="{{$job->company->emp_facebook}}">Facebook</a></span>
                                        @endif
                                    </div>
                                @endif
                            @endif
                            @if($job && ($job->emp_facebook || $job->emp_linkedin || $job->emp_twitter))
                                <div class="mb-2">
                                    <span class="contact-name">Bedriftens nettverk: </span>
                                    @if($job->emp_linkedin)
                                        <span class="contact-tel"><a href="{{$job->emp_linkedin}}">LinkedIn</a>,</span>
                                    @endif
{{--                                    @if($job->emp_linkedin && ($job->emp_twitter || $job->emp_facebook)) , @endif--}}
                                    @if($job->emp_twitter)
                                        <span class="contact-tel"><a href="https://twitter.com/{{$job->emp_twitter}}">Twitter</a>,</span>
                                    @endif
{{--                                    @if($job->emp_facebook && ($job->emp_twitter || $job->emp_linkedin)) , @endif--}}
                                    @if($job->emp_facebook)
                                        <span class="contact-tel"><a href="{{$job->emp_facebook}}">Facebook</a></span>
                                    @endif
                                </div>
                            @endif

                        </div>
                        @if($job->app_link_to_receive && $job->app_receive_by == 'url')
                            <button class="dme-btn-maroon col-12 mb-2" onclick="window.location.href='{{$job->app_link_to_receive}}';">Søk her</button>
                        @endif
                        @if($job->app_receive_by == 'email')
                            <button class="dme-btn-maroon col-12 mb-2" onclick="window.open('{{route('apply-job',$job->id)}}', '_blank');">Søk her</button>
                        @endif

                        @if(!empty($job->company))
                            @php
                                $user_follow_company = \App\Models\Following::where('user_id',\Illuminate\Support\Facades\Auth::id())->where('company_id',$job->company->id)->first();
                            @endphp
                            <button class="dme-btn-outlined-blue col-8 mb-2 follow-company-button" data-url="{{url('company-follow')}}" data-company_id="{{$job->company->id}}">@if($user_follow_company) Slutt å følge firma @else Følg firma @endif</button>
                            <div class="col-4"></div>
                            <div class="text-muted following-count">{{$job->company && $job->company->followings ? $job->company->followings->count() : '0'}} følger dette firmaet</div>
                            @if(!empty($job->company->emp_website))
                                <div><a href="{{$job->company->emp_website}}" class="emp-website">{{$job->company->emp_website}}</a></div>
                            @endif
                            <div><a href="{{url('jobs/company/'.$job->company->id.'/ads')}}" class="emp-ads">Flere annonser fra firma</a></div>
                        @else
                            @if(!empty($job->emp_website))
                                <div><a href="{{$job->emp_website}}" class="emp-website">{{__('Hjemmeside')}}</a></div>
                            @endif
                        @endif

                    </div>
                    <div class="mt-3 location"><h5 class="u-t3">location</h5></div>
                         <div style="width: 306px; height: 306px;">
                             <div id="map" style="height: 100%; width: 100%;"></div>
                        </div>
                    {{-- <p class="u-mt4">
                        <a href="" class="u-mr8 mr-2">Stort kart</a>
                        <a href="" class="u-mr8 mr-2">Hybridkart</a>
                        <a href="" class="u-mr8 mr-2">Flyfoto</a>
                    </p> --}}
                </div>
            </div>
        </div>

        <div class="right-ad pull-right" id="right_banner_ad">
            @include('user-panel.banner-ads.right-banner')
        </div>
    </main>

@endsection
<?php
$count = $job->ad->views()->where('ip', Request::getClientIp())->get();
//if (count($count) == 0) {
    $view = new \App\Models\AdView(['ad_id' => $job->ad->id, 'ip' => Request::getClientIp()]);
    $view->save();
//}

?>


@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.follow-company-button', function (e) {
                e.preventDefault();
                var company_id = $(this).data('company_id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{url('company-follow')}}",
                    type: "GET",
                    data: {'company_id':company_id},
                    async: false,
                    success: function (response) {
                        location.reload();
                    }
                });
            });
        })
    </script>
@endsection
@php $map_obj = $job @endphp
@include('common.partials.description_map',compact('map_obj'))

