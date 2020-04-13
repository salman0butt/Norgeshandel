@extends('layouts.landingSite')
@section('page_content')

<?php
    $facilities = array();
    if(isset($property_data->facilities) && !empty($property_data->facilities))
    {
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
                                <li class="breadcrumb-item active"><a href="{{url('property/commercial-property-for-sale/search')}}">Næringseiendom til salgs</a></li>
                            </ol>
                        </div>
                        <div class="col-md-6 p-0">
                            <ul class="breadcrumb w-100   text-right d-block"
                                style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;">
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{($prev) ? url('/', $prev->id) : url('property/commercial-property-for-sale/search')}}"> &lt; Forrige </a>
                                </li>
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{url('property/commercial-property-for-sale/search')}}">Til søket</a>
                                </li>
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{($next) ? url('/', $next->id) : url('property/commercial-property-for-sale/search')}}"> Neste ></a>
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
                @php $ad = $property_data->ad;@endphp
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
                    @if($property_data->rental_income)
                        <div class="col-md-12 font-weight-bold mt-3">Totalpris</div>
                        <div class="col-md-12 u-t3">{{number_format($property_data->rental_income,0,""," ")}} kr</div>
                    @endif
                    <div class="clearfix"></div>
                    <div class="bg-light-grey radius-8 col-md-12 p-3">
                        <div class="row">
                            @php
                                $property_type = array();
                                $property_type = json_decode($property_data->property_type);
                            @endphp
                            <div class="col-md-12"><span class="font-weight-bold">Type lokale </span>&nbsp;<span
                                   >
                                 @if(count($property_type) > 0)
                                    <ul class="row">
                                        @foreach($property_type as $value)
                                            <li class="col-md-6">{{$value}}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </span>
                            </div>

                            @if($property_data->use_area)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Bruksarea</span>&nbsp;
                                    <span>{{$property_data->use_area}} m²</span>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <span class="font-weight-bold">Eieform </span>&nbsp;
                                <span>Eier (Selveier)</span>
                            </div>

                            @if($property_data->floors)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Etasje</span>&nbsp;
                                    <span>{{$property_data->floors}}</span>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <span class="font-weight-bold">Bruttoareal</span>&nbsp;
                                <span>{{$property_data->gross_area_from}} - {{$property_data->gross_area_to}} m²</span>
                            </div>

                            @if($property_data->year_of_construction)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Byggeår</span>&nbsp;
                                    <span>{{$property_data->year_of_construction}}</span>
                                </div>
                            @endif
                            @if($property_data->rennovated_year)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Renovert år</span>&nbsp;
                                    <span>{{$property_data->rennovated_year}}</span>
                                </div>
                            @endif

                            @if($property_data->primary_room)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Primærrom</span>&nbsp;
                                    <span>{{$property_data->primary_room}} m²</span>
                                </div>
                            @endif

                            @if($property_data->energy_grades || $property_data->heating_character)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Energimerking </span>&nbsp;
                                    <span>{{$property_data->energy_grades}} @if($property_data->energy_grades && $property_data->heating_character) - @endif {{$property_data->heating_character}} </span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-2 col-md-12 p-0">
                        @if($facilities)
                            <div class="col-md-12 p-0">
                                <div class="bg-light-grey radius-8 col-md-12 p-3">
                                    <div>
                                        <span class="font-weight-bold">Fasiliteter &nbsp;</span>
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
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if($property_data->location)
                        <div class="col-md-12 more_details_section hide pl-0 pr-0">
                            <div class="col-md-12 pl-0 pr-0 mt-3">
                                <div class="bg-light-grey radius-8 col-md-12 p-3">
                                    <div class="row">
                                        @if($property_data->location)
                                            <div class="col-md-6">
                                                <span class="font-weight-bold">Land</span>&nbsp;
                                                <span>{{$property_data->location}}</span>
                                            </div>
                                        @endif
                                        @if($property_data->use_area)
                                            <div class="col-md-6">
                                                <span class="font-weight-bold">Bruksareal</span>&nbsp;
                                                <span>{{$property_data->use_area}} m²</span>
                                            </div>
                                        @endif

                                        @if($property_data->land)
                                            <div class="col-md-6">
                                                <span class="font-weight-bold">Tomteareal</span>&nbsp;
                                                <span>{{$property_data->land}} m²</span>
                                            </div>
                                        @endif

                                        @if($property_data->number_of_office_space)
                                            <div class="col-md-6">
                                                <span class="font-weight-bold">Antall kontorplasser</span>&nbsp;
                                                <span>{{$property_data->number_of_office_space}}</span>
                                            </div>
                                        @endif

                                        @if($property_data->energy_grade)
                                            <div class="col-md-6">
                                                <span class="font-weight-bold">Energikarakter </span>&nbsp;
                                                <span>{{$property_data->energy_grade}}</span>
                                            </div>
                                        @endif

                                        @if($property_data->heating_character)
                                            <div class="col-md-6">
                                                <span class="font-weight-bold">Oppvarmingskarakter</span>&nbsp;
                                                <span>{{$property_data->heating_character}}</span>
                                            </div>
                                        @endif

                                        @if($property_data->value_rate)
                                            <div class="col-md-6">
                                                <span class="font-weight-bold">Verditakst</span>&nbsp;
                                                <span>{{number_format($property_data->value_rate,0,""," ")}} Kr</span>
                                            </div>
                                        @endif

                                        @if($property_data->loan_rate)
                                            <div class="col-md-6">
                                                <span class="font-weight-bold">Lånetakst</span>&nbsp;
                                                <span>{{number_format($property_data->loan_rate,0,""," ")}} Kr</span>
                                            </div>
                                        @endif

                                        @if($property_data->availiable_from)
                                            <div class="col-md-6">
                                                <span class="font-weight-bold">Ledig fra</span>&nbsp;
                                                <span>{{$property_data->availiable_from}}</span>
                                            </div>
                                        @endif

                                        @if($property_data->display_information)
                                            <div class="col-md-12">
                                                <span class="font-weight-bold">Visningsinformasjon</span>&nbsp;
                                                <span>{{$property_data->display_information}}</span>
                                            </div>
                                        @endif

                                        {{--<div class="col-md-12 pt-2"><span class="font-weight-bold">Matrikkelinformasjon </span></div>--}}

                                        @if($property_data->municipal_number)
                                            <div class="col-md-6">
                                                <span class="font-weight-bold">Kommunenr</span>
                                                <span>{{$property_data->municipal_number}}</span>
                                            </div>
                                        @endif

                                        @if($property_data->usage_number)
                                            <div class="col-md-6">
                                                <span class="font-weight-bold">Gårdsnr</span>
                                                <span>{{$property_data->usage_number}}</span>
                                            </div>
                                        @endif

                                        @if($property_data->farm_number)
                                            <div class="col-md-6">
                                                <span class="font-weight-bold">Bruksnr</span>
                                                <span>{{$property_data->farm_number}}</span>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" id="more_details" class="mt-2">
                            <svg width="12" height="12" viewBox="0 0 12 12">
                                <line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line>
                                <line x1="6" y1="0" x2="6" y2="12" stroke-width="2" stroke="currentColor"></line>
                            </svg> Flere detaljer
                        </a>
                        <div class="col-md-12">
                            <a href="#" id="less_details" class="mt-2 hide">
                                <svg width="12" height="12" viewBox="0 0 12 12">
                                    <line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line>
                                </svg> Færre detaljer
                            </a>
                        </div>
                    @endif
                    @if($property_data->description_simple)
                        <div class="col-md-12">
                            <span class="font-weight-bold">Beskrivelse</span>
                            <p style="white-space: pre-line">{{$property_data->description_simple}}</p>
                        </div>
                    @endif
                    @if($property_data->descripion_access)
                        <div class="col-md-12">
                            <span class="font-weight-bold">Adkomst</span>
                            <p style="white-space: pre-line">{{$property_data->descripion_access}}</p>
                        </div>
                    @endif
                    @if($property_data->standard_technica_information)
                        <div class="col-md-12">
                            <span class="font-weight-bold">Standard/Tekniske opplysninger</span>
                            <p style="white-space: pre-line">{{$property_data->standard_technica_information}}</p>
                        </div>
                    @endif

                    <div class="col-md-12"><a href="{{url('customer-services')}}" class="u-strong">Rapporter annonse</a></div>
                    <div class="col-md-12"><span class="font-weight-bold">Handel: </span> <span> {{$property_data->ad->id}}</span></div>
                    <div class="col-md-12"><span class="font-weight-bold">Oppdatert: </span>
                        <span>{{date("d.m.Y H:i", strtotime($property_data->created_at))}}</span></div>
                    <div class="col-md-12 u-d2">Annonsene kan være mangelfulle i forhold til lovpålagt opplysningsplikt.
                        Før bindende avtale inngås oppfordres interessenter til å innhente komplett informasjon fra
                        meglerforetaket, selger eller utleier.</div>
                </div>
            </div>
            <div class="col-md-4">
                @if($property_data->user && $property_data->user->roles->first() && $property_data->user->roles->first()->name != 'company')
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
                       @if($property_data->phone)
                        <div class="mb-2">
                            <span>Telefon: </span>
                            <span><a href="tel:+4746545247" class="u-select-all" data-controller="trackSendSMS">
                                    {{$property_data->phone}}</a></span>
                        </div>
                       @endif
                       @if(!$property_data['published-on'])
                           <div class="mb-2">
                               <a href="{{url('property/commercial-property-for-sale/search?user_id='.$property_data->ad->user->id)}}">Flere annonser fra annonsør</a>
                           </div>
                       @endif

                       @if($property_data->delivery_date || $property_data->from_clock || $property_data->clockwise_clock)
                           <div class="mb-2">
                               <span>Visning: </span>
                               <span>{{$property_data->delivery_date ? date('d-m-Y', strtotime($property_data->delivery_date)) : ''}} <br>{{$property_data->from_clock.($property_data->from_clock && $property_data->clockwise_clock ? ' - ' : '').$property_data->clockwise_clock}}</span>
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
                        @if($property_data->line_text && $property_data->link_for_information)
                            <div class="mb-2"><a href="{{$property_data->link_for_information}}" target="_blank">{{$property_data->line_text}}</a></div>
                        @endif
                    </div>
                @else
                    @php
                        $show_more_ad_url = url('property/commercial-property-for-sale/search?user_id='.$property_data->ad->user->id);
                        $property_published_on = $property_data['published-on'];
                    @endphp
                    @include('user-panel.partials.templates.landing_page_company_information')
                @endif
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

    <div class="right-ad pull-right">
        <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
    </div>
</main>
@endsection
