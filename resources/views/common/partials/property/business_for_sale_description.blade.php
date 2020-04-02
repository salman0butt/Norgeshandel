@extends('layouts.landingSite')
    @section('page_content')

        <?php
            $name = $property_data->ad->company_gallery;
        ?>

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
                            <li class="breadcrumb-item active"><a href="{{url('property/business-for-sale/search')}}">Bedrifter til salgs</a></li>
                        </ol>
                    </div>
                    <div class="col-md-6 p-0">
                        <ul class="breadcrumb w-100   text-right d-block"
                            style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;">
                            <li class="breadcrumb-item active d-inline-block">
                                <a href="{{($prev) ? url('/', $prev->id) : url('property/business-for-sale/search')}}"> &lt; Forrige </a>
                            </li>
                            <li class="breadcrumb-item active d-inline-block">
                                <a href="{{url('property/business-for-sale/search')}}">Til søket</a>
                            </li>
                            <li class="breadcrumb-item active d-inline-block">
                                <a href="{{($next) ? url('/', $next->id) : url('property/business-for-sale/search')}}"> Neste ></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

            <div class="row">
                <div class="col-md-12">
                    @php $obj = $property_data; @endphp
                    @include('user-panel.partials.landing_page_slider',compact('name'))
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-8">
                    @php $ad = $property_data->ad; @endphp
                    @include('user-panel.partials.favorite-button',compact('ad'))
                    <div class="row single-realestate-detail p-3">
                        <div class="col-md-12">
                            {{--<div class="u-t3 mt-3">JESSHEIM SENTRUM</div>--}}
                            <h1 class="u-t2">{{$property_data->headline}}</h1>
                        </div>
                        <div class="col-md-12 text-muted">
                            {{$property_data->street_address ? $property_data->street_address.', ' : ''}}
                            <span>
                                @if($property_data->zip_code)
                                    {{$property_data->zip_code}}
                                    {{$property_data->zip_city ? Str::ucfirst(Str::lower($property_data->zip_city)) : ''}}
                                @endif
                            </span>
                        </div>
                        @if($property_data->price)
                        <div class="col-md-12 font-weight-bold mt-3">Pris</div>
                        <div class="col-md-12 u-t3">{{number_format($property_data->price,0,""," ")}} Kr</div>
                        @endif
                        <div class="bg-light-grey radius-8 col-md-12 p-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Bransje:</span>&nbsp;
                                    <span>{{$property_data->industry}} {{$property_data->alternative_industry}}</span>
                                </div>

                                @if($property_data->company_name)
                                    <div class="col-md-12">
                                        <span class="font-weight-bold">Navn på selskapet:</span>&nbsp;
                                        <span>{{$property_data->company_name}}</span>
                                    </div>
                                @endif
                                @if($property_data->organiztion_number)
                                    <div class="col-md-12">
                                        <span class="font-weight-bold">Organisasjonsnummer:</span>&nbsp;
                                        <span>{{$property_data->organiztion_number}}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{--<div class="col-md-12"><span class="font-weight-bold">Bransje: </span><span>{{$property_data->industry}} {{$property_data->alternative_industry}}</span></div>--}}
                        @if($property_data->description)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Beskrivelse</span>
                                <p style="white-space: pre-line">{{$property_data->description}}</p>
                            </div>
                        @endif

                        <div style="width: 500px; height: 300px;">
                            {!! Mapper::render() !!}
                        </div>


                        <div class="col-md-12"><a href="{{url('customer-services')}}" class="u-strong">Rapporter annonse</a></div>
                        <div class="col-md-12"><span class="font-weight-bold">Handel: </span> <span> 140424636</span></div>
                        <div class="col-md-12"><span class="font-weight-bold">Oppdatert: </span> <span>{{date("d.m.Y H:i", strtotime($property_data->created_at))}}</span></div>
                        <div class="col-md-12"><span class="font-weight-bold">Referanse: </span> <span>302190059</span></div>
                        <div class="col-md-12 u-d1">Annonsene kan være mangelfulle i forhold til lovpålagt opplysningsplikt. Før bindende avtale inngås oppfordres interessenter til å innhente komplett informasjon fra meglerforetaket, selger eller utleier.</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <img src="assets/images/dnb-logo.jpg" class="img-fluid" style="max-width: 150px;" alt="">
                    </div>
                    @if(!$property_data->published_on)
                        <p class="mt-3">   {{ $property_data->user->first_name }} {{ $property_data->user->last_name }}<br>
                            Eiendomsmegler</p>
                    @endif
                    @if($property_data->phone)
                        <div class="mb-2">
                            <span>Telefon: </span>
                            <span><a href="{{$property_data->phone}}" class="u-select-all" data-controller="trackSendSMS"> {{$property_data->phone}}</a></span>
                        </div>
                    @endif

                    @if($property_data && $property_data->ad && $property_data->ad->pdf->count() > 0)
                        <button onclick="window.open('{{\App\Helpers\common::getMediaPath($property_data->ad->pdf->first())}}', '_blank');" class="dme-btn-maroon col-12 mb-2">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    PDF
                                </font>
                            </font>
                        </button>
                    @endif
                    @if($property_data->offer_url)
                        <button onclick="window.open('{{$property_data->offer_url}}', '_blank');" class="dme-btn-maroon col-12 mb-2"><font style="vertical-align: inherit;"><font
                                        style="vertical-align: inherit;">Gi bud</font></font></button>
                    @endif
                    @if(!$property_data->published_on)
                        <div class="mb-2">
                            <a href="{{url('property/business-for-sale/search?user_id='.$property_data->ad->user->id)}}">Flere annonser fra annonsør</a>
                        </div>
                    @endif
                    <div class="mb-2"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Bestill komplett, utskriftsvennlig
                            salgsoppgave</a></div>
                    @if(!$property_data->ad->is_mine())
                        <div class="mb-2"><a href="{{url('messages/new', $property_data->ad->id)}}">Send melding</a></div>
                    @endif
                    <h2 class="u-t3">Visning</h2>
                    <div class="mb-2">Ta kontakt for å avtale visning</div>
                    <div class="mb-2">Husk å bestille/laste ned salgsoppgave så du kan stille godt forberedt på visning.</div>
                    @if($property_data->link && $property_data->link_for_information)
                        <div class="mb-2"><a href="{{$property_data->link_for_information}}" target="_blank">{{$property_data->link}}</a></div>
                    @endif
                </div>
            </div>
        </div>

        <div class="right-ad pull-right">
            <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
        </div>
    </main>

@endsection
