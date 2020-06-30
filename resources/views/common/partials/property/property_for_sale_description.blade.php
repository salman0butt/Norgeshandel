@extends('layouts.landingSite')
@section('main_title')
    NorgesHandel - Property For Sale
@endsection
@section('page_content')

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
        @php $banner_ad_category = 'property-landing'; @endphp
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
                            <ol class="breadcrumb w-100"
                                style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">NorgesHandel </a></li>
                                <li class="breadcrumb-item active"><a href="{{url('property/realestate')}}">Eiendom</a></li>
                                <li class="breadcrumb-item active"><a href="{{url('property/property-for-sale/search')}}">Bolig til salgs</a></li>
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
                        <div style="position: absolute;bottom: 0;left: 30px;">
                            <a data-fslightbox="gallery1" href="{{$property_data->video}}" class="btn btn-light radius-8 video-button" style="color: #ac304a; background: white">
                                <i class="far fa-play-circle fa-lg pr-1"></i>Video</a>
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
                                        <span>{{number_format($property_data->value_rate,0,""," ")}} Kr</span>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Primærrom </span>&nbsp;
                                    <span>{{$property_data->primary_room}} m² </span>
                                </div>
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Eierskifteforsikring </span>&nbsp;
                                    <span>{{$property_data->facilities4 ? 'Ja' : 'Nei'}} </span>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-12 more_details_section hide mt-2 mb-2 pl-0 pr-0">
                            @if($property_data->municipality_number)
                            <div class="col-md-12 pl-0 pr-0">
                                <div class="bg-light-grey radius-8 col-md-12 p-3">
                                    @if($property_data->approved_rental_part)
                                        <div class = "row">
                                            <div class="col-md-6">
                                                <span class="font-weight-bold">Godkjent utleiedel </span>&nbsp;
                                            </div>
                                        </div>
                                    @endif
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
                                            @if($property_data->costs_include)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Omkostninger inkluderer:</span>&nbsp;
                                                    <span>{{$property_data->costs_include}}</span>
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

                                            @if($property_data->facilities3)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Borettslaget har sikringsordning</span>&nbsp;
                                                </div>
                                            @endif

                                            @if($property_data->facilities2)
                                                <div class="col-md-6">
                                                    <span class="font-weight-bold">Eiet tomt</span>&nbsp;
                                                </div>
                                            @endif

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
                                </div>
                            </div>
                            @endif

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
                                <p style="white-space: pre-line">@php echo $property_data->description2; @endphp</p>
                            </div>
                        @endif
                        @if($property_data->area_description)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Arealbeskrivelse</span>
                                <p style="white-space: pre-line">@php echo $property_data->area_description; @endphp</p>
                            </div>
                        @endif
                        @if($property_data->access)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Adkomst</span>
                                <p style="white-space: pre-line">@php echo $property_data->access; @endphp</p>
                            </div>
                        @endif
                        @if($property_data->location)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Beliggenhet</span>
                                <p style="white-space: pre-line">@php echo $property_data->location; @endphp</p>
                            </div>
                        @endif
                        @if($property_data->character)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Beskaffenhet</span>
                                <p style="white-space: pre-line">@php echo $property_data->character; @endphp</p>
                            </div>
                        @endif
                        @if($property_data->joint_debt_costs)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Mer info om felleskostander</span>
                                <p style="white-space: pre-line">@php echo $property_data->joint_debt_costs; @endphp</p>
                            </div>
                        @endif
                        @if($property_data->essential_information)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Andre opplysninger</span>
                                <p style="white-space: pre-line">@php echo $property_data->essential_information; @endphp</p>
                            </div>
                        @endif

                        <div class="col-md-12"><span class="font-weight-bold">Handel: </span>
                            <span> {{$property_data->ad->id}}</span>
                        </div>
                        <div class="col-md-12"><span class="font-weight-bold">Sist endret: </span>
                            <span>{{date("d.m.Y H:i", strtotime($property_data->updated_at))}}</span></div>
                        <div class="col-md-12"><a href="{{url('customer-services')}}" class="u-strong">Rapporter annonse</a></div>
                        <div class="col-md-12 u-d2">Annonsene kan være mangelfulle i forhold til lovpålagt
                            opplysningsplikt.
                            Før bindende avtale inngås oppfordres interessenter til å innhente komplett informasjon fra
                            meglerforetaket, selger eller utleier.
                        </div>

                    </div>
                </div>
                @php
                    $delivery_date = $from_clock = $clock_wise = $note = array();
                    if($property_data->secondary_deliver_date){
                        $delivery_date = json_decode($property_data->secondary_deliver_date);
                    }
                    if($property_data->secondary_from_clock){
                        $from_clock = json_decode($property_data->secondary_from_clock);
                    }
                    if($property_data->secondary_clockwise){
                        $clock_wise = json_decode($property_data->secondary_clockwise);
                    }
                    if($property_data->secondary_note1){
                        $note = json_decode($property_data->secondary_note1);
                    }
                @endphp

                <div class="col-md-4">
                    @if($property_data->user && $property_data->user->roles->first() && $property_data->user->roles->first()->name != 'company'  && $property_data->user->roles->first()->name != 'agent')
                        <div style=" box-shadow: 0px 0px 2px 1px #ac304a; padding: 4px 10px; margin-bottom: 20px; border-radius: 5px;">
                            @if(!$property_data['published-on'])
                            <center>
                                <img src="@if($property_data->user->media!=null){{asset(\App\Helpers\common::getMediaPath($property_data->user->media))}}@else {{asset('public/images/profile-placeholder.png')}} @endif"
                                alt="Profile image" style="width:100px;">
                                
                                        <p class="mt-3"> {{ $property_data->user->username ? $property_data->user->username : 'NH-Bruker' }}</p>
                            </center>
                            @else
                                <p class="mt-3">NH-Bruker</p>
                            @endif
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

                            @if($property_data->ad->visting_times->count() > 0)
                                <div class="mb-2">
                                    <span>Visning: </span>
                                    <span>{{$property_data->delivery_date ? date('d-m-Y', strtotime($property_data->delivery_date)) : ''}} {{$property_data->from_clock.($property_data->from_clock && $property_data->clockwise_clock ? ' - ' : '').$property_data->clockwise_clock}} <br>{{$property_data->note ? $property_data->note : ''}}</span>

                                    @foreach($property_data->ad->visting_times as $key=>$visting_time)
                                        <p>{{$visting_time->delivery_date ? date('d-m-Y', strtotime($visting_time->delivery_date)) : ''}}
                                            {{($visting_time->time_start)}}
                                            {{($visting_time->time_end)}}
                                            <br> {{($visting_time->note)}}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
              
                            @if(!$property_data->ad->is_mine())
                                <div class="mb-2">
                                    <a href="{{url('messages/new', $property_data->ad->id)}}">Visning etter avtale</a>
                                </div>
                            @endif
                            @if(!$property_data['published-on'])
                                <div class="mb-2">
                                    <a href="{{url('property/property-for-sale/search?user_id='.$property_data->ad->user->id)}}">Flere annonser fra annonsør</a>
                                </div>
                            @endif
                           
                        </div>
                    @else
                        @php
                            $show_more_ad_url = url('property/property-for-sale/search?company_id='.$property_data->ad->company_id);
                            $property_published_on = $property_data['published-on'];
                        @endphp
                        @include('user-panel.partials.templates.landing_page_company_information')
                        <div style=" box-shadow: 0px 0px 2px 1px #ac304a; padding: 4px 10px; margin-bottom: 20px; border-radius: 5px;">
                            <h2 class="u-t3">Visning</h2>
                            @if($property_data->ad->visting_times->count() > 0)
                                <div class="mb-2">
                                    @foreach($property_data->ad->visting_times as $key=>$visting_time)
                                        <p>{{$visting_time->delivery_date ? date('d-m-Y', strtotime($visting_time->delivery_date)) : ''}}
                                            {{($visting_time->time_start)}}
                                            {{($visting_time->time_end)}}
                                            <br> {{($visting_time->note)}}
                                        </p>

                                    @endforeach
                                </div>
                            @else
                                <div class="mb-2"><span>Ta kontakt for å avtale visning</span></div>
                            @endif
                            <div class="mb-2" style="font-weight:500">Husk å bestille/laste ned salgsoppgave så du kan stille
                                godt forberedt på visning.
                            </div>
                        </div>
                    @endif

                    @if($property_data->user && $property_data->user->roles->first() && $property_data->user->roles->first()->name != 'company')
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
                    @endif
{{-- 
                    <div class="mt-3 mb-3">
                        <h5>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{$property_data->street_address}}</font>
                            </font><br>
                        </h5>
                    </div> --}}
                    <div style="width: 306px; height: 306px;">
                      <a href="{{ url('/map?lat='.$property_data->latitude.'&long='.$property_data->longitude) }}" target="_blank"><h5 class="text-muted">{{ $property_data->full_address }}</h5></a>
                          <a href="{{ url('/map?lat='.$property_data->latitude.'&long='.$property_data->longitude) }}" id="click-map" target="_blank"><div id="map" style="height: 100%; width: 100%;"></div></a>
                    </div>

                </div>
            </div>
        </div>

        <div class="right-ad pull-right" id="right_banner_ad">
             @include('user-panel.banner-ads.right-banner')
        </div>
    </main>
@endsection
@php $map_obj = $property_data @endphp
@include('common.partials.description_map',compact('map_obj'))