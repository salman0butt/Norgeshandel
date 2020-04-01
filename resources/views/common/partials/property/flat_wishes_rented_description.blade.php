@extends('layouts.landingSite')
@section('page_content')
<main>
    <div class="left-ad float-left">
        <img src="{{asset('public/images/left-ad.png')}}" class="img-fluid" alt="">
    </div>
    <div class="dme-container">
        <div class="row top-ad">
            <img src="{{asset('public/images/top-ad.png')}}" class="img-fluid m-auto" alt="">
        </div>
    </div>
    <div class="dme-container p-3">
        <div class="breade-crumb">
            <nav aria-label="breadcrumb">
                <div class="row pl-3 pr-3">
                    <div class="col-md-6 p-0">
                        <ol class="breadcrumb w-100 "
                            style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">NorgesHandel </a></li>
                            <li class="breadcrumb-item active"><a href="{{url('property/realestate')}}">Eiendom</a></li>
                            <li class="breadcrumb-item active"><a href="{{url('property/flat-wishes-rented/search')}}">Bolig ønskes leid</a></li>
                        </ol>
                    </div>
                    <div class="col-md-6 p-0">
                        <ul class="breadcrumb w-100   text-right d-block"
                            style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;">
                            <li class="breadcrumb-item active d-inline-block">@if(!empty($prev))<a href="#"> &lt;
                                    Forrige </a> @else <span class="text-muted">Forrige</span>@endif</li>
                            <li class="breadcrumb-item active d-inline-block"><a href="{{url('property/flat-wishes-rented/search')}}">Til
                                    søket</a></li>
                            <li class="breadcrumb-item active d-inline-block">@if(!empty($next))<a href="#"> Neste ></a>
                                @else <span class="text-muted">Neste</span>@endif</li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12">
                @php $name = $property_data->ad->company_gallery; @endphp
                @include('user-panel.partials.landing_page_slider',compact('name'))
            </div>

        </div>
        <div class="row mt-4">
            <div class="col-md-8">
                @php $ad = $property_data->ad; @endphp
                @include('user-panel.partials.favorite-button',compact('ad'))

                <div class="row single-realestate-detail p-3">
                    <div class="col-md-12">

                        <h1 class="u-t2">{{$property_data->headline}}</h1>
                    </div>
                    @if($property_data->max_rent_per_month)
                        <div class="col-md-12 font-weight-bold mt-3">Maks månedsleie</div>
                        <div class="col-md-12 u-t3">{{number_format($property_data->max_rent_per_month,0,""," ")}} Kr</div>
                    @endif
                    <div class="clearfix"></div>
                    <div class="bg-light-grey radius-8 col-md-12 p-3">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="font-weight-bold">Boligtype: </span>&nbsp;
                                <span>{{rtrim($property_data->property_type)}} </span>
                            </div>
                            <div class="col-md-12">
                                <span class="font-weight-bold">Ønsket område:
                                </span>&nbsp;<span>{{rtrim($property_data->region)}}</span>
                            </div>
                            @if($property_data->number_of_tenants)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">
                                        Antall beboere:
                                    </span>&nbsp;
                                    <span>{{rtrim($property_data->number_of_tenants)}}</span>
                                </div>
                            @endif

                            @if($property_data->wanted_from)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Ønskes fra: </span>&nbsp;
                                    <span>{{date("d.m.Y", strtotime($property_data->wanted_from))}}</span>
                                </div>
                            @endif

                            @if($property_data->furnishing)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Møblert: </span>&nbsp;
                                    <span>{{$property_data->furnishing}}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- <a href="#" class="mt-2"><svg width="12" height="12" viewBox="0 0 12 12"><line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line><line x1="6" y1="0" x2="6" y2="12" stroke-width="2" stroke="currentColor"></line></svg> Flere detaljer</a> -->


                    @if($property_data->description)
                        <div class="col-md-12">
                            <span class="font-weight-bold">Beliggenhet</span>
                            <p style="white-space: pre-line">{{$property_data->description}}</p>
                        </div>
                    @endif
                    <!-- <div class="col-md-12">Salgsoppgaven beskriver vesentlig og lovpålagt informasjon om
                                eiendommen
                            </div> -->
                    <!-- <div class="col-md-12"><button class="btn btn-info btn-lg mt-2">Se komplett salgsoppgave</button></div>
                            <div class="col-md-12"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" class="" target="_blank">Bestill komplett, utskriftsvennlig salgsoppgave</a></div> -->
                    <!-- <div class="col-md-12"><h2 class="u-t3">Gjestadtoppen 28, 2050 Jessheim</h2></div>
                            <div class="col-md-12"><img src="assets/images/staticmap.png" alt=""></div>!-->

                    <div class="col-md-12"><span class="font-weight-bold">Handelskode: </span> <span> 140424636</span>
                    </div>
                    <div class="col-md-12"><span class="font-weight-bold">Sist endret: </span> <span>
                            {{date("d.m.Y H:i", strtotime($property_data->created_at))}}</span></div>
                    <div class="col-md-12"><a href="{{url('customer-services')}}" class="u-strong">Rapporter annonse</a></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img src="assets/images/dnb-logo.jpg" class="img-fluid" style="max-width: 150px;" alt="">
                </div>
                @if(!$property_data['published-on'])
                    <p class="mt-3"> {{ $property_data->user->first_name }} {{ $property_data->user->last_name }}<br>
                        Eiendomsmegler</p>
                @endif

                @if($property_data->phone)
                    <div class="mb-2">
                        <span>Mobil: </span>
                        <span>
                            <a href="tel:+4746545247" class="u-select-all" data-controller="trackSendSMS">
                                {{$property_data->phone}}
                            </a>
                        </span>
                    </div>
                @endif
                @if(!$property_data['published-on'])
                    <div class="mb-2"><a href="{{route('public_profile',$property_data->ad->user->id)}}">Flere annonser fra annonsør</a></div>
                @endif
                @if(!$property_data->ad->is_mine())
                    <div class="mb-2"><a href="{{url('messages/new', $property_data->ad->id)}}">Send melding</a></div>
                @endif
                <h2 class="u-t3">Visning</h2>
                <div class="mb-2">Ta kontakt for å avtale visning</div>
                <div class="mb-2">Husk å bestille/laste ned salgsoppgave så du kan stille godt forberedt på visning.
                </div>
                <div class="mt-3 mb-3">
                    <h5>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">{{$property_data->street_address}}</font>
                        </font><br>
                    </h5>
                </div>
                <div style="width: 306px; height: 153px;">
                    {!! Mapper::render() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="right-ad pull-right">
        <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
    </div>
</main>

@endsection
