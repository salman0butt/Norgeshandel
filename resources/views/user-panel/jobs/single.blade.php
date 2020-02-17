@extends('layouts.landingSite')

@section('main_title')
    NorgesHandel - {{$job->title}}
@endsection
@section('page_content')
    <?php
    $job_function = "";
    $industry = "";
    foreach ($job->terms as $term):
        if ($term->taxonomy->slug == 'job_function'):
            $job_function = $term->name;
        elseif ($term->taxonomy->slug == 'industry'):
            $industry = $term->name;
        endif;
    endforeach;
    $logo = $job->media()->where('type', 'company_logo')->get()->first();
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
                                <li class="breadcrumb-item active d-inline-block">@if(!empty($prev))<a
                                        href="{{url('jobs', compact('prev'))}}"> &lt; Forrige </a> @else <span
                                        class="text-muted">Forrige</span>@endif</li>
                                <li class="breadcrumb-item active d-inline-block"><a href="{{url('jobs')}}">Til
                                        søket</a></li>
                                <li class="breadcrumb-item active d-inline-block">@if(!empty($next))<a
                                        href="{{url('jobs', compact('next'))}}"> Neste ></a> @else <span
                                        class="text-muted">Neste</span>@endif</li>
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
                    @php $name = $job->media; $obj = $job; @endphp
                    @include('user-panel.partials.landing_page_slider',compact('name'))
                    {{--<img src="{{asset('public/images/home.jpg')}}" alt="" class="img-fluid">--}}
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-8">
                    @php $ad = $job->ad; @endphp
                    @include('user-panel.partials.favorite-button',compact('ad'))

                    <a href="#" class=""><i class="hover-zoom fa fa-envelope"
                                            style="color: #E43732; font-size: 25px; padding:7px 10px;"></i></a>
                    <a href="#" class=""><i class="hover-zoom fab fa-facebook"
                                            style="color: #3C56A0;font-size: 25px; padding:7px 10px;"></i></a>
                    <a href="#" class=""><i class="hover-zoom fab fa-twitter"
                                            style="color: #5BBCF6;font-size: 25px; padding:7px 10px;"></i></a>
                    <div class="row single-realestate-detail p-3">
                        <div class="col-md-12">
                            <h1 class="u-t2 name">{{$job->name}}</h1>
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
                                <div class="col-md-6 industry"><span
                                        class="font-weight-bold">Bransje: </span>{{$industry}}<span>

                                    </span></div>
                                <div class="col-md-6 job-function"><span
                                        class="font-weight-bold">Stillingsfunksjon: </span>&nbsp;<span>{{$job_function}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="description mt-3 col-md-12">
                            {!! html_entity_decode($job->description) !!}
                        </div>
                        <div class="emp_company_information mt-3 col-md-12">
                            <h2 class="u-t5">Om arbeidsgiveren</h2>
                            @if(!empty($job->company))
                                {!! html_entity_decode($job->company->emp_company_information)!!}
                            @else
                                {!! html_entity_decode($job->emp_company_information)!!}
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
                            <div class="mb-2 contact-name">
                                <span>Kontaktperson: </span>
                                <span> {{$job->app_contact_title}} </span>
                            </div>
                            <div class="mb-2">
                                <span class="contact-name">Telefon: </span>
                                <span class="contact-tel"><a
                                        href="tel:{{$job->app_phone}}">  {{$job->app_phone}}</a></span>
                            </div>
                            <div class="mb-2">
                                <span class="contact-name">Mobil: </span>
                                <span class="contact-tel"><a
                                        href="tel:{{$job->app_mobile}}">  {{$job->app_mobile}}</a></span>
                            </div>

                        </div>
                        <button class="dme-btn-maroon col-12 mb-2">Søk her</button>
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
                                <div><a href="{{$job->emp_website}}" class="emp-website">{{__('Company Homepage')}}</a></div>
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
if (count($count) == 0) {
    $view = new \App\Models\AdView(['ad_id' => $job->ad->id, 'ip' => Request::getClientIp()]);
    $view->save();
}

?>
