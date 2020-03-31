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
    }
    ?>
    <main>

        <div class="left-ad float-left">
            <img src="{{asset('public/images/left-ad.png')}}" class="img-fluid" alt="">
        </div>
        <div class="dme-container">
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
            <div class="row top-ad">
                <img src="{{asset('public/images/top-ad.png')}}" class="img-fluid m-auto" alt="">
            </div>
        </div>
        <div class="dme-container p-3">
            <div class="row">
                <div class="col-md-12">
                    @php $name = $job->ad->company_gallery; $obj = $job; @endphp
                    @include('user-panel.partials.landing_page_slider',compact('name'))
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
                                    {{$job->zip_city ? $job->zip_city : ''}}
                                @endif
                            </span>
                        </div>
                        <div class="bg-light-grey radius-8 col-md-12 p-3">
                            <div class="row">
                                <div class="col-md-6 emp_name"><span
                                        class="font-weight-bold">Arbeidsgiver: </span><span>{{$job->emp_name}}</span>
                                </div>
                                <div class="col-md-6 title"><span
                                        class="font-weight-bold">Stillingstittel: </span><span>{{$job->title}}</span>
                                </div>
                                <div class="col-md-6 place"><span
                                        class="font-weight-bold">Sted: </span><span>{{$job->country}}</span></div>
                                <div class="col-md-6 deadline"><span class="font-weight-bold">Frist: </span><span>@if(empty($job->deadline))
                                            Snarset @else {{$job->deadline}} @endif</span></div>
                                <div class="col-md-6 commitment_type"><span
                                        class="font-weight-bold">Varighet: </span><span>{{$job->commitment_type}}</span>
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
                        <div class="col-md-12"><a href="#" class="u-strong">Rapporter annonse</a></div>
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
                                    @if($job->app_linkedin && $job->app_twitter) , @endif
                                    @if($job->app_twitter)
                                        <span class="contact-tel"><a href="https://twitter.com/{{$job->app_twitter}}">Twitter</a></span>
                                    @endif
                                </div>
                            @endif

                        </div>
                        <button class="dme-btn-maroon col-12 mb-2" onclick="window.location.href='{{$job->app_link_to_receive}}';">Søk her</button>
                        @if(!empty($job->company))
                            <button class="dme-btn-outlined-blue col-8 mb-2">Følg firma</button>
                            <div class="col-4"></div>
                            <div class="text-muted following-count">643 følger dette firmaet</div>
                            @if(!empty($job->company->emp_website))
                                <div><a href="{{$job->company->emp_website}}" class="emp-website">{{$job->company->emp_website}}</a></div>
                            @endif
                            <div><a href="#" class="emp-ads">more ads by company</a></div>
                        @else
                            @if(!empty($job->emp_website))
                                <div><a href="{{$job->emp_website}}" class="emp-website">{{__('Hjemmeside')}}</a></div>
                            @endif
                        @endif

                    </div>
                    <div class="mt-3 location"><h5 class="u-t3">location</h5></div>
                    <a href="#" class=""><img src="{{asset('public/images/staticmap.png')}}" class="img-fluid"
                                              alt=""></a>
                    <p class="u-mt4">
                        <a href="" class="u-mr8 mr-2">Stort kart</a>
                        <a href="" class="u-mr8 mr-2">Hybridkart</a>
                        <a href="" class="u-mr8 mr-2">Flyfoto</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="right-ad pull-right">
            <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
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
