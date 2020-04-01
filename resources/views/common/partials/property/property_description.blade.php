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
                    <!-- <div class="col-md-12 mt-2"><p>{{$property_data->description}}</p></div> -->
                        @if (!empty($property_data->monthly_rent))
                            <div class="col-md-12 font-weight-bold mt-3">Månedsleie</div>
                            <div class="col-md-12 u-t3">{{number_format($property_data->monthly_rent,0,""," ")}}Kr
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
                                        <span>{{$property_data->area_of_use}}</span>
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
                            </div>
                        </div>

                        <!-- <a href="#" class="mt-2"><svg width="12" height="12" viewBox="0 0 12 12"><line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line><line x1="6" y1="0" x2="6" y2="12" stroke-width="2" stroke="currentColor"></line></svg> Flere detaljer</a> -->
                        <div class="mt-2 col-md-12"></div>
                        @if($facilities)
                            <div class="col-md-12">
                                <div class="bg-light-grey radius-8 col-md-12 p-3">
                                    <div class="">
                                        <span class="font-weight-bold">Fasiliteter &nbsp;</span>
                                        <ul>
                                            @foreach($facilities as $key=>$val)
                                                <li>
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
                                <p style="white-space: pre-line">{{$property_data->description}}</p>
                            </div>
                        @endif
                        <div class="col-md-12"><a href="{{url('customer-services')}}" class="u-strong">Rapporter annonse</a></div>
                        <div class="col-md-12"><span class="font-weight-bold">Handel: </span>
                            <span> {{$property_data->ad ? $property_data->ad->id : ''}}</span></div>
                        <div class="col-md-12"><span class="font-weight-bold">Oppdatert: </span>
                            <span>{{date("d.m.Y H:i", strtotime($property_data->created_at))}}</span></div>
                        <div class="col-md-12"><span class="font-weight-bold">Referanse: </span> <span>302190059</span>
                        </div>
                        <div class="col-md-12 u-d2">Annonsene kan være mangelfulle i forhold til lovpålagt
                            opplysningsplikt.
                            Før bindende avtale inngås oppfordres interessenter til å innhente komplett informasjon fra
                            meglerforetaket, selger eller utleier.
                        </div>
                    </div>
                </div>
                @if($property_data->user && $property_data->user->roles->first() && $property_data->user->roles->first()->name != 'company')
                    <div class="col-md-4">
                        <div
                            style=" box-shadow: 0px 0px 2px 1px #ac304a; padding: 4px 10px; margin-bottom: 20px; border-radius: 5px;">
                            <p class="mt-3"> {{ $property_data->user->first_name }} {{ $property_data->user->last_name }}</p>
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
                            @if($property_data->delivery_date)
                                <div class="mb-2">
                                    <span>Visning: </span>
                                    <span>{{date('d-m-Y', strtotime($property_data->delivery_date))}} {{$property_data->from_clock.($property_data->from_clock && $property_data->clockwise_clock ? ' - ' : '').$property_data->clockwise_clock}}</span>
                                </div>
                            @endif
                            @if(!$property_data->ad->is_mine())
                                <div class="mb-2">
                                    <a href="{{url('messages/new', $property_data->ad->id)}}">Visning etter avtale</a>
                                </div>
                            @endif
                            {{-- <button class="btn btn-info btn-lg mb-2">Se komplett salgsoppgave</button> --}}
                            <div class="mb-2">
                                <a href="{{route('public_profile',$property_data->ad->user->id)}}">Flere annonser fra annonsør</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-4">
                        <div
                            style=" box-shadow: 0px 0px 2px 1px #ac304a; padding: 4px 10px; margin-bottom: 20px; border-radius: 5px;">
                            <div class="text-center">
                                <img src="assets/images/dnb-logo.jpg" class="img-fluid" style="max-width: 150px;"
                                     alt="">
                            </div>
                            <p class="mt-3">
                            <span>
                                {{ $property_data->user->first_name }} {{ $property_data->user->last_name }}
                            </span>
                                <br>Eiendomsmegler
                            </p>

                            <!-- <div class="mb-2">
                                        <span>Mobil: </span>
                                        <span><a href="tel:+4746545247" class="u-select-all" data-controller="trackSendSMS">  465 45 247</a></span>
                                    </div> -->
                            <!-- <button class="btn btn-info btn-lg mb-2">Se komplett salgsoppgave</button> -->
                            <div class="mb-2"><a href="{{route('public_profile',$property_data->ad->user->id)}}">Flere annonser fra
                                    annonsør</a></div>
                            @if(!$property_data->ad->is_mine())
                                <div class="mb-2"><a href="{{url('messages/new', $property_data->ad->id)}}">Send
                                        melding</a></div>
                            @endif
                        <!-- <div class="mb-2"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Bestill komplett, utskriftsvennlig
                            salgsoppgave</a></div>
                        <div class="mb-2"><a href="https://www.dnbeiendom.no/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Se komplett salgsoppgave</a></div>
                        <div class="mb-2"><a href="https://bud.dnbeiendom.no/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Gi bud</a></div> -->
                            <h2 class="u-t3">Visning</h2>
                            @if(!empty($property_data->delivery_date) || !empty($property_data->from_clock) ||
                            !empty($property_data->clockwise_clock) || !empty($property_data->clockwise_clock) ||
                            !empty($property_data->note))
                                <div class="mb-2">
                                    <span><?php echo(!empty($property_data->delivery_date) ? date("d.m.Y", strtotime($property_data->delivery_date)) : ""); ?></span>
                                    <span><?php echo(!empty($property_data->from_clock) ? $property_data->from_clock : ""); ?>
                                    - </span>
                                    <span><?php echo(!empty($property_data->clockwise_clock) ? $property_data->clockwise_clock : ""); ?>
                                </span>
                                    <span><?php echo(!empty($property_data->note) ? $property_data->note : ""); ?>
                                </span>
                                </div>
                            @else
                                <div class="mb-2"><span>Ta kontakt for å avtale visning</span></div>
                            @endif

                            <div class="mb-2">Husk å bestille/laste ned salgsoppgave så du kan stille godt forberedt på
                                visning.
                            </div>


                            <div class="mt-3 mb-3">
                                <h5><span class="db_zip_code"></span><br>
                                </h5>

                            </div>
                            <div style="width: 306px;height:153px;">
                                {!! Mapper::render() !!}
                            </div>
                        </div>

                    </div>
                @endif


            </div>
        </div>

        <div class="row">

            <div class="right-ad pull-right">
                <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
            </div>
        </div>
    </main>

@endsection
