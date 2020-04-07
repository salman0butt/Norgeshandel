@extends('layouts.landingSite')
@section('page_content')

    <?php
        $facilities = array();
        if(isset($property_data->facilities) && !empty($property_data->facilities)){
            $facilities = explode(",",rtrim($property_data->facilities, ","));
        }
        $name       = $property_data->ad->company_gallery;
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
                                <li class="breadcrumb-item active"><a href="{{url('property/commercial-property-for-rent/search')}}">Næringseiendom til leie</a></li>
                            </ol>
                        </div>
                        <div class="col-md-6 p-0">
                            <ul class="breadcrumb w-100 text-right d-block"
                                style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;">
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{($prev) ? url('/', $prev->id) : url('property/commercial-property-for-rent/search')}}"> &lt; Forrige </a>
                                </li>
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{url('property/commercial-property-for-rent/search')}}">Til søket</a>
                                </li>
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{($next) ? url('/', $next->id) : url('property/commercial-property-for-rent/search')}}"> Neste ></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12">
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
                            <h1 class="u-t2">{{$property_data->heading}}</h1>
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
                        @php
                            $property_type = array();
                            $property_type = json_decode($property_data->property_type);
                        @endphp
                        <div class="col-md-6"><span class="font-weight-bold">Type lokale </span>&nbsp;<span>
                                @if(is_countable($property_type))
                                    <ul>
                                        @foreach($property_type as $value)
                                             <li>{{$value}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </span> </div>
                        <div class="col-md-6"><span class="font-weight-bold">Areal </span>&nbsp;<span>{{$property_data->gross_area_from}} - {{$property_data->gross_area_to}} m²</span></div>

                        @if($property_data->number_of_office_space)
                            <div class="col-md-6"><span class="font-weight-bold">Ant kontorplasser </span>&nbsp;<span>{{$property_data->number_of_office_space}}</span></div>
                        @endif

                        @if($property_data->floors)
                            <div class="col-md-6"><span class="font-weight-bold">Etasje </span>&nbsp;<span>{{ $property_data->floors }}</span></div>
                        @endif

                        @if($property_data->number_of_parking_space)
                            <div class="col-md-6"><span class="font-weight-bold">Ant p-plasser </span>&nbsp;<span>{{$property_data->number_of_parking_space}}</span></div>
                        @endif

                        @if($property_data->year_of_construction)
                            <div class="col-md-6"><span class="font-weight-bold">Byggeår </span>&nbsp;<span>{{ $property_data->year_of_construction }}</span></div>
                        @endif

                        @if($property_data->rennovated_year)
                            <div class="col-md-6"><span class="font-weight-bold">Renovert år </span>&nbsp;<span>{{ $property_data->rennovated_year }}</span></div>
                        @endif

                        @if($property_data->availiable_from)
                            <div class="col-md-12"><span class="font-weight-bold">Overtakelse </span>&nbsp;<span>
                                    <?php echo  (!empty($property_data->availiable_from) ? date("d.m.Y H:i", strtotime($property_data->availiable_from)) : "");  ?>
                            </span></div>
                        @endif

                        @if($property_data->countrty)
                            <a href="#" id="more_details" class="mt-2 col-12 pl-0">
                                <svg width="12" height="12" viewBox="0 0 12 12">
                                    <line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line>
                                    <line x1="6" y1="0" x2="6" y2="12" stroke-width="2" stroke="currentColor"></line>
                                </svg> Flere detaljer
                            </a>
                            <a href="#" id="less_details" class="mt-2 hide  col-12 pl-0">
                                <svg width="12" height="12" viewBox="0 0 12 12">
                                    <line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line>
                                </svg> Færre detaljer
                            </a>
                        @endif

                        <div class="row more_details_section single-realestate-detail hide" style="padding-left: 15px">
                            @if($property_data->countrty)
                                <div class="col-md-6"><span class="font-weight-bold">Land </span>&nbsp;<span>{{ $property_data->countrty }}</span></div>
                            @endif

                            @if($property_data->municipal_number)
                                <div class="col-md-6"><span class="font-weight-bold">Kommunenummer </span>&nbsp;<span>{{ $property_data->municipal_number }}</span></div>
                            @endif

                            @if($property_data->usage_number)
                                <div class="col-md-6"><span class="font-weight-bold">Bruksnummer </span>&nbsp;<span>{{ $property_data->usage_number }}</span></div>
                            @endif

                            @if($property_data->farm_number)
                                <div class="col-md-6"><span class="font-weight-bold">Gårdsnummer </span>&nbsp;<span>{{ $property_data->farm_number }}</span></div>
                            @endif

                            @if($property_data->use_area)
                                <div class="col-md-6"><span class="font-weight-bold">Bruksareal </span>&nbsp;<span>{{ $property_data->use_area.' m²'}}</span></div>
                            @endif

                            @if($property_data->land)
                                <div class="col-md-6"><span class="font-weight-bold">Tomteareal </span>&nbsp;<span>{{ $property_data->land.' m²'}}</span></div>
                            @endif

                            @if($property_data->energy_grade)
                                <div class="col-md-6"><span class="font-weight-bold">Energikarakter </span>&nbsp;<span>{{ $property_data->energy_grade }}</span></div>
                            @endif

                            @if($property_data->heating_character)
                                <div class="col-md-6"><span class="font-weight-bold">Oppvarmingskarakter </span>&nbsp;<span>{{ $property_data->heating_character }}</span></div>
                            @endif

                            @if($property_data->rent_per_meter_per_year)
                                <div class="col-md-6"><span class="font-weight-bold">Husleie per m² per år </span>&nbsp;<span>{{ number_format($property_data->rent_per_meter_per_year,0,""," ").' Kr'}}</span></div>
                            @endif

                            @if($property_data->display_information)
                                <div class="col-md-12"><span class="font-weight-bold">Visningsinformasjon </span><span>{{ $property_data->display_information }}</span></div>
                            @endif
                        </div>

                        @if(count($facilities))
                            <div class="col-md-12 more_details_section">
                                <span class="font-weight-bold">Fasiliteter</span>
                                <ul>
                                    @foreach($facilities as $key=>$val)
                                        <li>
                                            <?php
                                                if($val != "")
                                                {
                                                    echo $val;
                                                }
                                            ?>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if($property_data->last_description)
                            <div class="col-md-12"><span class="font-weight-bold">Beskrivelse</span></div>
                            <div class="col-md-12"><p style="white-space: pre-line">{{$property_data->last_description}}</p></div>
                        @endif
                        @if($property_data->location_description)
                            <div class="col-md-12"><span class="font-weight-bold">Beliggenhet</span></div>
                            <div class="col-md-12"><p style="white-space: pre-line">{{$property_data->location_description}}</p></div>
                        @endif
                        @if($property_data->venue_description)
                            <div class="col-md-12"><span class="font-weight-bold">Adkomst</span></div>
                            <div class="col-md-12"><p style="white-space: pre-line">{{$property_data->venue_description}}</p></div>
                        @endif
                        @if($property_data->standard_technical_information)
                            <div class="col-md-12"><span class="font-weight-bold">Standard/Tekniske opplysninger</span></div>
                            <div class="col-md-12"><p style="white-space: pre-line">{{$property_data->standard_technical_information}}</p></div>
                        @endif

                        {{--<div style="width: 500px; height: 300px;">--}}
                            {{--{!! Mapper::render() !!}--}}
                        {{--</div>--}}

                        <div class="col-md-12"><img src="assets/images/staticmap.png" alt=""></div>
                        <div class="col-md-12"><a href="{{url('customer-services')}}" class="u-strong">Rapporter annonse</a></div>
                        <div class="col-md-12"><span class="font-weight-bold">Handel: </span> <span> {{$property_data->ad->id}} </span></div>
                        <div class="col-md-12"><span class="font-weight-bold">Oppdatert: </span> <span>{{date("d.m.Y H:i", strtotime($property_data->created_at))}}</span></div>
                        <div class="col-md-12 u-d1">Annonsene kan være mangelfulle i forhold til lovpålagt opplysningsplikt. Før bindende avtale inngås oppfordres interessenter til å innhente komplett informasjon fra meglerforetaket, selger eller utleier.</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        {{-- <img src="assets/images/dnb-logo.jpg" class="img-fluid" style="max-width: 150px;" alt=""> --}}
                    </div>
                    @if(!$property_data['published-on'])
                        <center>
                        <img src="@if($property_data->user->media!=null){{asset(\App\Helpers\common::getMediaPath($property_data->user->media))}}@else {{asset('public/images/profile-placeholder.png')}} @endif"
                        alt="Profile image" style="width:100px;">
                           
                                <p class="mt-3"> {{ $property_data->user->username ? $property_data->user->username : 'NH-Bruker' }}</p>
                         </center>
                    @endif
                    @if($property_data->phone)
                        <div class="mb-2">
                            <span>Telefon : </span>
                            <span><a href="tel:{{$property_data->phone}}" class="u-select-all" data-controller="trackSendSMS">  {{$property_data->phone}}</a></span>
                        </div>
                    @endif
                    {{--<div class="mb-2">--}}
                        {{--<span>Telefon: </span>--}}
                        {{--<span><a href="tel:{{$property_data->phone}}" class="u-select-all" data-controller="trackSendSMS">  {{$property_data->phone}}</a></span>--}}
                    {{--</div>--}}

                    @if(!$property_data['published-on'])
                        <div class="mb-2">
                            <a href="{{url('property/commercial-property-for-rent/search?user_id='.$property_data->ad->user->id)}}">Flere annonser fra annonsør</a>
                        </div>
                    @endif
                    {{--<div class="mb-2"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Bestill komplett, utskriftsvennlig--}}
                            {{--salgsoppgave</a></div>--}}
                    @if(!$property_data->ad->is_mine())
                        <div class="mb-2"><a href="{{url('messages/new', $property_data->ad->id)}}">Send melding</a></div>
                    @endif

                    <h2 class="u-t3">Visning</h2>
                    <div class="mb-2">Ta kontakt for å avtale visning</div>
                    <div class="mb-2">Husk å bestille/laste ned salgsoppgave så du kan stille godt forberedt på visning.</div>
                    @if($property_data && $property_data->ad && $property_data->ad->pdf->count() > 0)
                        <button onclick="window.open('{{\App\Helpers\common::getMediaPath($property_data->ad->pdf->first())}}', '_blank');" class="dme-btn-maroon col-12 mb-2">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    PDF
                                </font>
                            </font>
                        </button>
                    @endif
                    @if($property_data->link && $property_data->link_for_information)
                        <div class="mb-2"><a href="{{$property_data->link_for_information}}" target="_blank">{{$property_data->link}}</a></div>
                    @endif
                    {{-- <a href="https://hjelpesenter.finn.no/hc/no/articles/203012092" target="_blank" rel="noopener external">Les mer om elektronisk budgiving</a> --}}
                </div>
            </div>
        </div>

        <div class="right-ad pull-right">
            <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
        </div>
    </main>
@endsection
