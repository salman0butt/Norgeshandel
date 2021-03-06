@extends('layouts.landingSite')
@section('page_content')
    <?php
    $facilities = array();
    if (isset($property_data->facilities) && !empty($property_data->facilities)) {
        $facilities = json_decode($property_data->facilities);
        if (is_null($facilities)) {
            $facilities = explode(",", rtrim($property_data->facilities, ","));
        }
    }
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
                            <ol class="breadcrumb w-100 "
                                style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">NorgesHandel </a></li>
                                <li class="breadcrumb-item active"><a href="{{url('property/realestate')}}">Eiendom</a></li>
                                <li class="breadcrumb-item active"><a href="{{url('property/property-for-rent/search')}}">Bolig til leie</a></li>
                            </ol>
                        </div>
                        <div class="col-md-6 p-0">
                            <ul class="breadcrumb w-100 text-right d-block"
                                style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;">
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{($prev) ? url('/', $prev->id) : url('property/property-for-rent/search')}}"> &lt; Forrige </a>
                                </li>
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{url('property/property-for-rent/search')}}">Til søket</a>
                                </li>
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{($next) ? url('/', $next->id) : url('property/property-for-rent/search')}}"> Neste ></a>
                                </li>
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
                            <!-- <div class="u-t3 mt-3">JESSHEIM SENTRUM</div> -->
                            <h1 class="u-t2">{{$property_data->heading}}</h1>
                        </div>
                        <div class="col-md-12 text-muted">{{$property_data->street_address ? $property_data->street_address.', ' : ''}}
                            <span>
                                @if($property_data->zip_code)
                                    {{$property_data->zip_code}}
                                    {{$property_data->zip_city ? Str::ucfirst(Str::lower($property_data->zip_city)) : ''}}
                                @endif
                            </span>
                        </div>
                       
                        {{-- {{ dd($property_data->user->avatar) }} --}}
                    <!-- <div class="col-md-12 mt-2"><p>{{$property_data->description}}</p></div> -->
                        @if (!empty($property_data->monthly_rent))
                            <div class="col-md-12 font-weight-bold mt-3">Månedsleie</div>
                            <div class="col-md-12 u-t3">{{number_format($property_data->monthly_rent,0,""," ")}} Kr
                            </div>
                        @endif
                        @if($property_data->include_in_rent || $property_data->deposit)
                            <div class="bg-light-grey radius-8 col-md-12 p-3">
                                <div class="row">
                                    @if (!empty($property_data->include_in_rent))
                                        <div class="col-md-12 mt-3">
                                            <span class="font-weight-bold">Inkluderer: </span>
                                            <span>{{$property_data->include_in_rent}}</span>
                                        </div>
                                    @endif
                                    @if (!empty($property_data->deposit))
                                        <div class="col-md-12 ">
                                            <span class="font-weight-bold">Depositum: </span>
                                            <span>{{number_format($property_data->deposit,0,""," ")}}</span>
                                            Kr
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class=" clearfix"></div>
                        <div class="col-md-12"></div>
                        <div class="bg-light-grey radius-8 col-md-12 p-3">
                            <div class="row">
                                @if (!empty($property_data->primary_rom))
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Primærrom</span>
                                        <span>{{$property_data->primary_rom}} m²</span>
                                    </div>
                                @endif
                                @if (!empty($property_data->number_of_bedrooms))
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Soverom</span>
                                        <span>{{$property_data->number_of_bedrooms}}</span>
                                    </div>
                                @endif
                                @if (!empty($property_data->gross_area))
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Bruttoareal</span>
                                        <span>{{$property_data->gross_area}} m²</span>
                                    </div>
                                @endif
                                @if (!empty($property_data->floor))
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Etasje</span>
                                        <span>{{$property_data->floor}}</span>
                                    </div>
                                @endif
                                @if (!empty($property_data->area_of_use))
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Bruksareal</span>&nbsp;
                                        <span>{{$property_data->area_of_use}} m²</span>
                                    </div>
                                @endif
                                @if (!empty($property_data->property_type))
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Boligtype</span>&nbsp;
                                        <span>{{$property_data->property_type}}</span>
                                    </div>
                                @endif
                                @if (!empty($property_data->furnishing))
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Møblering</span>&nbsp;
                                        <span>{{$property_data->furnishing}}</span>
                                    </div>
                                @endif
                                @if (!empty($property_data->energy_label_class))
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Energikarakter</span>&nbsp;
                                        <span>{{$property_data->energy_label_class}}</span>
                                    </div>
                                @endif
                                    @if (!empty($property_data->energy_label_color))
                                        <div class="col-md-6">
                                            <span class="font-weight-bold">Oppvarmingskarakter</span>&nbsp;
                                            <span>{{$property_data->energy_label_color}}</span>
                                        </div>
                                    @endif

                                @if (!empty($property_data->rented_from))
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Leieperiode</span>
                                        <span>{{ date("d.m.Y", strtotime($property_data-> rented_from)) }} -
                                            {{ date("d.m.Y", strtotime($property_data-> rented_to)) }}</span>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Dyrehold tillatt</span>
                                    <span>{{$property_data->facilities2 ? 'Ja' : 'Nei'}}</span>
                                </div>
                            </div>
                        </div>

                        <!-- <a href="#" class="mt-2"><svg width="12" height="12" viewBox="0 0 12 12"><line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line><line x1="6" y1="0" x2="6" y2="12" stroke-width="2" stroke="currentColor"></line></svg> Flere detaljer</a> -->
                        <div class="mt-2 col-md-12"></div>
                        @if($facilities)
                            <div class="col-md-12">
                                <div class="bg-light-grey radius-8 col-md-12 p-3">
                                    <div class="">
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

                        @if($property_data->description)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Beskrivelse</span>
                                <p style="white-space: pre-line">@php echo $property_data->description; @endphp</p>
                            </div>
                        @endif
                        <div class="col-md-12"><a href="{{url('customer-services')}}" class="u-strong">Rapporter annonse</a></div>
                        <div class="col-md-12"><span class="font-weight-bold">Handel: </span>
                            <span> {{$property_data->ad ? $property_data->ad->id : ''}}</span></div>
                        <div class="col-md-12"><span class="font-weight-bold">Oppdatert: </span>
                            <span>{{date("d.m.Y H:i", strtotime($property_data->updated_at))}}</span></div>
                        <div class="col-md-12 u-d2">Annonsene kan være mangelfulle i forhold til lovpålagt
                            opplysningsplikt.
                            Før bindende avtale inngås oppfordres interessenter til å innhente komplett informasjon fra
                            meglerforetaket, selger eller utleier.
                        </div>
                    </div>
                </div>
                @if($property_data->user && ($property_data->user->roles->first() && $property_data->user->roles->first()->name != 'company' && $property_data->user->roles->first()->name != 'agent'))
                    <div class="col-md-4">
                        <div style=" box-shadow: 0px 0px 2px 1px #ac304a; padding: 4px 10px; margin-bottom: 20px; border-radius: 5px;">
                     @if(!$property_data->published_on)
                    <center>
                        <img src="@if($property_data->user->media!=null){{asset(\App\Helpers\common::getMediaPath($property_data->user->media))}}@else {{asset('public/images/profile-placeholder.png')}} @endif"
                        alt="Profile image" style="width:100px;">
                        <p class="mt-3"> {{ $property_data->user->username ? $property_data->user->username : 'NH-Bruker' }}</p>
                    </center>
                         @endif
                            @if(!$property_data->ad->is_mine())
                                <div class="mb-2"><a href="{{url('messages/new', $property_data->ad->id)}}">Send
                                        melding</a></div>
                            @endif
                            @if($property_data->phone)
                                <div class="mb-2">
                                    <a data-toggle="collapse" href="#collapseExample">Mobil </a>
                                    <p class="collapse" id="collapseExample"><a href="{{ $property_data->phone }}"
                                                                                class="u-select-all"
                                                                                data-controller="trackSendSMS">{{ $property_data->phone }}</a>
                                    </p>
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
                            @if(!$property_data->published_on)
                                <div class="mb-2">
                                    <a href="{{url('property/property-for-rent/search?user_id='.$property_data->ad->user->id)}}">Flere annonser fra annonsør</a>
                                </div>
                            @endif
                        </div>
                         <div style="width: 100%; height: 306px;">
                           <a href="{{ url('/map?lat='.$property_data->latitude.'&long='.$property_data->longitude) }}" target="_blank"><h5 class="text-muted">{{ $property_data->full_address }}</h5></a>
                          <a href="{{ url('/map?lat='.$property_data->latitude.'&long='.$property_data->longitude) }}" id="click-map" target="_blank"><div id="map" style="height: 100%; width: 100%;"></div></a>
                        </div>
                    </div>
                @else
                    <div class="col-md-4">
                        @php
                            $show_more_ad_url = url('property/property-for-rent/search?company_id='.$property_data->ad->company_id);
                            $property_published_on = $property_data->published_on;
                        @endphp
                        @include('user-panel.partials.templates.landing_page_company_information')

                        <div style=" box-shadow: 0px 0px 2px 1px #ac304a; padding: 4px 10px;margin-bottom: 20px; border-radius: 5px;">

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

                            <div class="mb-2">Husk å bestille/laste ned salgsoppgave så du kan stille godt forberedt på
                                visning.
                            </div>
                        </div>
                        <div style="width: 100%; height: 306px;">
                             <a href="{{ url('/map?lat='.$property_data->latitude.'&long='.$property_data->longitude) }}" target="_blank"><h5 class="text-muted">{{ $property_data->full_address }}</h5></a>
                         <a href="{{ url('/map?lat='.$property_data->latitude.'&long='.$property_data->longitude) }}" id="click-map" target="_blank"><div id="map" style="height: 100%; width: 100%;"></div></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
           <div class="right-ad pull-right" id="right_banner_ad">
             @include('user-panel.banner-ads.right-banner')
            </div>
        </div>
    </main>
@endsection
@php $map_obj = $property_data @endphp
@include('common.partials.description_map',compact('map_obj'))