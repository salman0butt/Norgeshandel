@extends('layouts.landingSite')

@section('page_content')
@section('main_title')
    NorgesHandel - Property For Sale
@endsection

<?php

    $facilities = array();
    if (isset($property_data->facilities) && !empty($property_data->facilities)) {
        $facilities = json_decode($property_data->facilities);
        if (is_null($facilities)){
            $facilities = explode(",",rtrim($property_data->facilities, ","));
        }
    }

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
                            <ol class="breadcrumb w-100"
                                style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">NorgesHandel </a></li>
                                <li class="breadcrumb-item active"><a href="{{url('property/realestate')}}">Eiendom</a></li>
                                <li class="breadcrumb-item active"><a href="{{url('property/property-for-sale/search')}}">Bolig til Salgs</a></li>
                            </ol>
                        </div>
                        <div class="col-md-6 p-0">
                            <ul class="breadcrumb w-100   text-right d-block"
                                style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;">
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{($prev) ? url('/', $prev->id) : url('property/property-for-sale/search')}}"> &lt; Forrige </a>
                                </li>
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{url('property/property-for-sale/search')}}">Til søket</a>
                                </li>
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{($next) ? url('/', $next->id) : url('property/property-for-sale/search')}}"> Neste ></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('user-panel.partials.landing_page_slider',compact('name'))
                    @if($property_data->video)
                        <div style="position: absolute;bottom: 0;right: 30px;">
                            <button class="btn btn-light radius-8 video-button" onclick="window.open('{{$property_data->video}}', '_blank');" style="color: #ac304a; background: white">
                                <i class="far fa-play-circle fa-lg pr-1"></i>Video</button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-8">
                    @php $ad = $property_data->ad; @endphp
                        @include('user-panel.partials.favorite-button',compact('ad'))
              
                    <div class="row single-realestate-detail p-3">
                        <div class="col-md-12">

                            <div class="u-t3 mt-3">{{$property_data->local_area_name}}</div>
                            <h1 class="u-t2">{{$property_data->headline}}</h1>
                            {{--<h1 class="u-t2">{{$property_data->local_area_name}}--}}
                                {{--| {{$property_data->number_of_bedrooms}}--}}
                                {{--soverom | {{$property_data->property_type}} | </h1>--}}
                        </div>
                        <div class="col-md-12 text-muted">{{$property_data->street_address ? $property_data->street_address.', ' : ''}}
                            <span>
                                @if($property_data->zip_code)
                                    {{$property_data->zip_code}}
                                    {{$property_data->zip_city ? Str::ucfirst(Str::lower($property_data->zip_city)) : ''}}
                                @endif
                            </span>
                        </div>
                        <div class="col-md-12 font-weight-bold mt-3">Prisantydning</div>
                        <div class="col-md-12 u-t3">{{number_format($property_data->asking_price,0,""," ")}} Kr</div>
                        <div class="clearfix"></div>
                        {{-- <div class="mt-2 col-md-12"></div> --}}
                        <div class="bg-light-grey radius-8 col-md-12 p-3">
                            <div class="row">
                                <div class="col-md-12"><span class="font-weight-bold">Omkostninger
                                    :</span>&nbsp;<span>{{number_format($property_data->expenses,0,""," ")}} Kr</span></div>
                                <div class="col-md-12"><span class="font-weight-bold">Totalpris
                                    :</span>&nbsp;<span>{{number_format($property_data->total_price,0,""," ")}} Kr</span></div>
                                @if($property_data->Kommunale)
                                    <div class="col-md-12">
                                        <span class="font-weight-bold">Kommunale avg :.</span>&nbsp;
                                        <span>{{number_format($property_data->Kommunale,0,""," ")}} Kr</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12"></div>
                        <div class="bg-light-grey radius-8 col-md-12 p-3">
                            <div class="row">

                                <div class="col-md-6"><span class="font-weight-bold">Boligtype
                                </span>&nbsp;<span>{{$property_data->property_type}}</span></div>
                                <div class="col-md-6"><span class="font-weight-bold">Bruksareal </span>&nbsp;<span>{{$property_data->use_area}} m²</span></div>
                                <div class="col-md-6"><span class="font-weight-bold">Eieform
                                </span>&nbsp;<span>{{$property_data->tenure}}</span></div>
                                <div class="col-md-6"><span class="font-weight-bold">Byggeår
                                </span>&nbsp;<span>{{$property_data->year}}</span></div>
                                <div class="col-md-6"><span class="font-weight-bold">Soverom
                                </span>&nbsp;<span>{{$property_data->number_of_bedrooms}}</span></div>

                                @if($property_data->energy_grade)
                                    <div class="col-md-6"><span class="font-weight-bold">Energimerking</span>&nbsp;
                                        <span>{{$property_data->energy_grade}} - {{ $property_data-> heating_character }} </span>
                                    </div>
                                @endif

                                @if($property_data->land)
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Tomteareal</span>&nbsp;
                                        <span>{{$property_data->land}} m²</span>
                                    </div>
                                @endif
                                @if($property_data->Base)
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Bruttoareal </span>&nbsp;
                                        <span>{{$property_data->Base}} m² </span>
                                    </div>
                                @endif

                                <div class="col-md-6"><span class="font-weight-bold">Formuesverdi </span>&nbsp;<span>
                                    {{number_format($property_data->asset_value,0,""," ")}} Kr</span></div>

                                @if($property_data->value_rate)
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Verditakst: </span>&nbsp;
                                        <span>{{$property_data->value_rate}} Kr</span>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Primærrom </span>&nbsp;
                                    <span>{{$property_data->primary_room}} m² </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 more_details_section hide mt-2 mb-2 pl-0 pr-0">
                            @if($property_data->municipality_number)
                            <div class="col-md-12 pl-0 pr-0">
                                <div class="bg-light-grey radius-8 col-md-12 p-3">
                                    <div>
                                        @if(count($facilities))
                                            <span class="font-weight-bold">Fasiliteter</span>
                                            <ul class="row">
                                                @foreach($facilities as $key=>$val)
                                                    <li class="col-6">
                                                        <?php
                                                        if ($val != "") {
                                                            echo ucfirst(strtolower(str_replace('-', ' ', str_replace('_', ' ', $val))));
                                                        }
                                                        ?>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        <div class="row">
                                            @if($property_data->local_area_name)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Navn på lokalområde:</span>&nbsp;
                                                    <span>{{$property_data->local_area_name}}</span>
                                                </div>
                                            @endif
                                            @if($property_data->renovated_year)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Renovert år:</span>&nbsp;
                                                    <span>{{$property_data->renovated_year}}</span>
                                                </div>
                                            @endif
                                            @if($property_data->number_of_rooms)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Antall rom:</span>&nbsp;
                                                    <span>{{$property_data->number_of_rooms}}</span>
                                                </div>
                                            @endif
                                            @if($property_data->floor)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Etasje:</span>&nbsp;
                                                    <span>{{$property_data->floor}}</span>
                                                </div>
                                            @endif

                                            @if($property_data->housing_team)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Borettslagets navn:</span>&nbsp;
                                                    <span>{{$property_data->housing_team}}</span>
                                                </div>
                                            @endif

                                            @if($property_data->owner_of_housing)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Borettslagets eier:</span>&nbsp;
                                                    <span>{{$property_data->owner_of_housing}}</span>
                                                </div>
                                            @endif

                                            @if($property_data->housing_type_org_number)
                                                <div class="col-md-12">
                                                    <span class="font-weight-bold">Borettslagets org.nummer:</span>&nbsp;
                                                    <span>{{$property_data->housing_type_org_number}}</span>
                                                </div>
                                            @endif

                                            @if($property_data->housing_cooperative_share_number)
                                                <div class="col-md-12">
                                                    <span class="font-weight-bold">Borettslagets andelsnummer:</span>&nbsp;
                                                    <span>{{$property_data->housing_cooperative_share_number}}</span>
                                                </div>
                                            @endif

                                            @if($property_data->holiday_year)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Festeår:</span>&nbsp;
                                                    <span>{{$property_data->holiday_year}}</span>
                                                </div>
                                            @endif

                                            @if($property_data->party_fee)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Festeavgift:</span>&nbsp;
                                                    <span>{{number_format($property_data->party_fee,0,""," ")}} Kr</span>
                                                </div>
                                            @endif

                                            @if($property_data->rent_shared_cost)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Husleie/felleskost:</span>&nbsp;
                                                    <span>{{number_format($property_data->rent_shared_cost,0,""," ")}} Kr</span>
                                                </div>
                                            @endif

                                            @if($property_data->shared_costs_include)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Felleskostnader inkluderer:</span>&nbsp;
                                                    <span>{{$property_data->shared_costs_include}}</span>
                                                </div>
                                            @endif

                                            @if($property_data->common_costs_after_interest_free_period)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Felleskostnader etter avdragsfri periode:</span>&nbsp;
                                                    <span>{{number_format($property_data->common_costs_after_interest_free_period,0,""," ")}} Kr</span>
                                                </div>
                                            @endif

                                            @if($property_data->asset_value)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Formuesverdi:</span>&nbsp;
                                                    <span>{{number_format($property_data->asset_value,0,""," ")}} Kr</span>
                                                </div>
                                            @endif

                                            @if($property_data->percentage_of_public_debt)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Andel fellesgjeld:</span>&nbsp;
                                                    <span>{{number_format($property_data->percentage_of_public_debt,0,""," ")}} Kr</span>
                                                </div>
                                            @endif

                                            @if($property_data->value_rate)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Verditakst:</span>&nbsp;
                                                    <span>{{number_format($property_data->value_rate,0,""," ")}} Kr</span>
                                                </div>
                                            @endif

                                            @if($property_data->loan_rate)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Lånetakst:</span>&nbsp;
                                                    <span>{{number_format($property_data->loan_rate,0,""," ")}} Kr</span>
                                                </div>
                                            @endif

                                            @if($property_data->percentage_of_common_wealth)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Andel fellesformue:</span>&nbsp;
                                                    <span>{{number_format($property_data->percentage_of_common_wealth,0,""," ")}} Kr</span>
                                                </div>
                                            @endif

                                            @if($property_data->muncipal_fees_per_year)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Kommunale avgifter pr. år:</span>&nbsp;
                                                    <span>{{number_format($property_data->muncipal_fees_per_year,0,""," ")}} Kr</span>
                                                </div>
                                            @endif

                                            @if($property_data->pre_empt_right)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Forkjøpsrett:</span>&nbsp;
                                                    <span>{{$property_data->pre_empt_right}}</span>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endif
                            <br>
                            <span class="font-weight-bold col-md-12">Matrikkelinformasjon</span>
                                <div class="row pl-3">
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Kommunenr: </span>
                                        <span>{{$property_data->municipality_number}}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Gårdsnr: </span>
                                        <span>{{$property_data->farm_number}}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Bruksnr: </span>
                                        <span>{{$property_data->usage_number}}</span>
                                    </div>
                                    @if($property_data->party_number)
                                        <div class="col-md-6">
                                            <span class="font-weight-bold">Festenummer: </span>
                                            <span>{{$property_data->party_number}}</span>
                                        </div>
                                    @endif
                                    @if($property_data->section_number)
                                        <div class="col-md-6">
                                            <span class="font-weight-bold">Seksjonsnummer: </span>
                                            <span>{{$property_data->section_number}}</span>
                                        </div>
                                    @endif
                                    @if($property_data->apartment_number)
                                        <div class="col-md-6">
                                            <span class="font-weight-bold">Leilighetsnummer: </span>
                                            <span>{{$property_data->apartment_number}}</span>
                                        </div>
                                    @endif
                                </div>

                        </div>

                        <div class="col-md-12">
                            <a href="#" id="more_details" class="mt-2">
                                <svg width="12" height="12" viewBox="0 0 12 12">
                                    <line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line>
                                    <line x1="6" y1="0" x2="6" y2="12" stroke-width="2" stroke="currentColor"></line>
                                </svg>
                                Flere detaljer
                            </a>
                            <a href="#" id="less_details" class="mt-2 hide">
                                <svg width="12" height="12" viewBox="0 0 12 12">
                                    <line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line>
                                </svg>
                                Færre detaljer
                            </a>
                        </div>
                        @if($property_data->description2)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Beskrivelse</span>
                                <p style="white-space: pre-line">{{$property_data->description2}}</p>
                            </div>
                        @endif
                        @if($property_data->area_description)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Arealbeskrivelse</span>
                                <p style="white-space: pre-line">{{$property_data->area_description}}</p>
                            </div>
                        @endif
                        @if($property_data->access)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Adkomst</span>
                                <p style="white-space: pre-line">{{$property_data->access}}</p>
                            </div>
                        @endif
                        @if($property_data->location)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Beliggenhet</span>
                                <p style="white-space: pre-line">{{$property_data->location}}</p>
                            </div>
                        @endif
                        @if($property_data->character)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Beskaffenhet</span>
                                <p style="white-space: pre-line">{{$property_data->character}}</p>
                            </div>
                        @endif
                        @if($property_data->joint_debt_costs)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Mer info om felleskostander</span>
                                <p style="white-space: pre-line">{{$property_data->joint_debt_costs}}</p>
                            </div>
                        @endif
                        @if($property_data->essential_information)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Andre opplysninger</span>
                                <p style="white-space: pre-line">{{$property_data->essential_information}}</p>
                            </div>
                        @endif

                    <!-- <div class="col-md-12"><p>{{ $property_data-> essential_information}}</p></div> -->
                        <!-- <div class="col-md-12">Salgsoppgaven beskriver vesentlig og lovpålagt informasjon om
                                    eiendommen
                                </div> -->
                        <!-- <div class="col-md-12"><button class="btn btn-info btn-lg mt-2">Se komplett salgsoppgave</button></div> -->
                        <!-- <div class="col-md-12"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" class="" target="_blank">Bestill komplett, utskriftsvennlig salgsoppgave</a></div>
                                <div class="col-md-12"><h2 class="u-t3">Gjestadtoppen 28, 2050 Jessheim</h2></div>
                                <div class="col-md-12"><img src="assets/images/staticmap.png" alt=""></div> -->

                        <div class="col-md-12"><span class="font-weight-bold">Handelskode: </span>
                            <span> 140424636</span>
                        </div>
                        <div class="col-md-12"><span class="font-weight-bold">Sist endret: </span>
                            <span>{{date("d.m.Y H:i", strtotime($property_data->created_at))}}</span></div>
                        <div class="col-md-12"><span class="font-weight-bold">Referanse: </span> <span>302190059</span>
                        </div>
                        <div class="col-md-12"><a href="#" class="u-strong">Rapporter annonse</a></div>
                        <div class="col-md-12 u-d2">Annonsene kan være mangelfulle i forhold til lovpålagt
                            opplysningsplikt.
                            Før bindende avtale inngås oppfordres interessenter til å innhente komplett informasjon fra
                            meglerforetaket, selger eller utleier.
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    @if($property_data->user && $property_data->user->roles->first() && $property_data->user->roles->first()->name != 'company')
                        <div style=" box-shadow: 0px 0px 2px 1px #ac304a; padding: 4px 10px; margin-bottom: 20px; border-radius: 5px;">
                            <p class="mt-3"> {{ $property_data->user->first_name }} {{ $property_data->user->last_name }}</p>
                            @if(!$property_data->ad->is_mine())
                                <div class="mb-2"><a href="{{url('messages/new', $property_data->ad->id)}}">Send melding</a></div>
                            @endif
                            @if($property_data->phone)
                                <div class="mb-2">
                                    <a data-toggle="collapse" href="#collapseExample">Mobil </a>
                                    <p class="collapse" id="collapseExample"><a href="{{ $property_data->phone }}" class="u-select-all"
                                             data-controller="trackSendSMS">{{ $property_data->phone }}</a></p>
                                </div>
                            @endif
                            @if($property_data->deliver_date)
                                <div class="mb-2">
                                    <span>Visning: </span>
                                    <span>{{date('d-m-Y', strtotime($property_data->deliver_date))}} {{$property_data->from_clock.($property_data->from_clock && $property_data->clockwise ? ' - ' : '').$property_data->clockwise}} {{$property_data->note1 ? $property_data->note1 : ''}}</span>
                                </div>
                            @endif
                            @if(!$property_data->ad->is_mine())
                                <div class="mb-2">
                                    <a href="{{url('messages/new', $property_data->ad->id)}}">Visning etter avtale</a>
                                </div>
                            @endif
                            {{-- <button class="btn btn-info btn-lg mb-2">Se komplett salgsoppgave</button> --}}
                            <div class="mb-2">
                                <a href="{{route('public_profile',$property_data->ad->user->id)}}">Flere annonser fra
                                    annonsør</a>
                            </div>
                        </div>
                    @else
                        <div style=" box-shadow: 0px 0px 2px 1px #ac304a; padding: 4px 10px; margin-bottom: 20px; border-radius: 5px;">
                            <div class="text-center">
                                <img src="assets/images/dnb-logo.jpg" class="img-fluid" style="max-width: 150px;" alt="">
                            </div>

                            <p class="mt-3">
                                {{ $property_data->user->first_name }} {{ $property_data->user->last_name }}
                                <br>
                                Eiendomsmegler
                            </p>
                            @if($property_data->phone)
                                <div class="mb-2">
                                    <span>Mobil: </span>
                                    <span><a href="tel:+4746545247" class="u-select-all"
                                             data-controller="trackSendSMS">{{ $property_data->phone }}</a>
                                    </span>
                                </div>
                            @endif
                            {{-- <button class="btn btn-info btn-lg mb-2">Se komplett salgsoppgave</button> --}}
                            <div class="mb-2"><a href="{{route('public_profile',$property_data->ad->user->id)}}">Flere annonser fra
                                    annonsør</a></div>
                            @if(!$property_data->ad->is_mine())
                                <div class="mb-2"><a href="{{url('messages/new', $property_data->ad->id)}}">Send melding</a></div>
                            @endif
                        </div>
                        <h2 class="u-t3">Visning</h2>
                        @if(!empty($property_data->deliver_date) || !empty($property_data->from_clock) ||
                        !empty($property_data->clockwise) || !empty($property_data->clockwise) ||
                        !empty($property_data->note))
                            <div class="mb-2">
                            <span style="font-weight:500"><?php echo(!empty($property_data->deliver_date) ? date("d.m.Y", strtotime($property_data->delivery_date)) : ""); ?></span>
                                <span style="font-weight:500"><?php echo(!empty($property_data->from_clock) ? $property_data->from_clock : ""); ?></span>
                                <span style="font-weight:500"><?php echo(!empty($property_data->clockwise) ? $property_data->clockwise : ""); ?></span>
                                <span style="font-weight:500"><?php echo(!empty($property_data->note) ? $property_data->note : ""); ?></span>
                            </div>
                        @else
                            <div class="mb-2" style="font-weight:500"><span>Ta kontakt for å avtale visning</span></div>
                        @endif
                    @endif

                    <!-- <div class="mb-2"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Bestill komplett, utskriftsvennlig
                                    salgsoppgave</a></div>
                            <div class="mb-2"><a href="https://www.dnbeiendom.no/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Se komplett salgsoppgave</a></div>
                            <div class="mb-2"><a href="https://bud.dnbeiendom.no/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Gi bud</a></div> -->

                    <div class="mb-2" style="font-weight:500">Husk å bestille/laste ned salgsoppgave så du kan stille
                        godt forberedt på visning.
                    </div>
                    @if($property_data && $property_data->ad && $property_data->ad->sales_information->count() > 0)
                        <button onclick="window.open('{{\App\Helpers\common::getMediaPath($property_data->ad->sales_information->first())}}', '_blank');" class="dme-btn-maroon col-12 mb-2">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    Se komplett salgsoppgave
                                </font>
                            </font>
                        </button>
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

                    {{-- <button class="dme-btn-outlined-blue col-12">Gi bud</button> --}}
                    {{-- <a href="https://hjelpesenter.finn.no/hc/no/articles/203012092" target="_blank"
                        rel="noopener external">Les mer om elektronisk budgiving</a> --}}
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
