@extends('layouts.landingSite')
@section('page_content')

    <?php
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
                                <li class="breadcrumb-item active"><a href="{{url('property/commercial-plots/search')}}">Næringstomt</a></li>
                            </ol>
                        </div>
                        <div class="col-md-6 p-0">
                            <ul class="breadcrumb w-100   text-right d-block"
                                style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;">
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{($prev) ? url('/', $prev->id) : url('property/commercial-plots/search')}}"> &lt; Forrige </a>
                                </li>
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{url('property/commercial-plots/search')}}">Til søket</a>
                                </li>
                                <li class="breadcrumb-item active d-inline-block">
                                    <a href="{{($next) ? url('/', $next->id) : url('property/commercial-plots/search')}}"> Neste ></a>
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
                            <!-- <div class="u-t3 mt-3">JESSHEIM SENTRUM</div> -->
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
                        @if($property_data->asking_price)
                            <div class="col-md-12 font-weight-bold mt-3">Prisantydning</div>
                            <div class="col-md-12 u-t3">{{number_format($property_data->asking_price,0,""," ")}} Kr</div>
                        @endif
                        <div class="col-md-6"><span class="font-weight-bold">Boligtype: </span><span>{{$property_data->plot_type}}</span></div>
                        <div class="col-md-6"><span class="font-weight-bold">Land: </span><span>{{$property_data->country}}</span></div>

                        @if($property_data->plot_size)
                            <div class="col-md-6"><span class="font-weight-bold">Tomteareal: </span><span>{{$property_data->plot_size}} m² (eiet)</span></div>
                        @endif

                        @if($property_data->municipal_number)
                            <div class="col-md-6"><span class="font-weight-bold">Kommunenummer: </span><span>{{$property_data->municipal_number}}</span></div>
                        @endif

                        @if($property_data->usage_number)
                            <div class="col-md-6"><span class="font-weight-bold">Bruksnummer: </span><span>{{$property_data->usage_number}}</span></div>
                        @endif

                        @if($property_data->farm_number)
                            <div class="col-md-6"><span class="font-weight-bold">Gårdsnummer: </span><span>{{$property_data->farm_number}}</span></div>
                        @endif


                        @if($property_data->verditakst)
                            <div class="col-md-6"><span class="font-weight-bold">Verditakst: </span><span>{{number_format($property_data->verditakst,0,""," ").' Kr'}}</span></div>
                        @endif

                        @if($property_data->display_information)
                            <div class="col-md-12"><span class="font-weight-bold">Visningsinformasjon: </span><span>{{$property_data->display_information}}</span></div>
                        @endif

                        @if($property_data->owned_plot_facilities)
                            <div class="col-md-12"><span class="font-weight-bold">Eiet tomt </span></div>
                        @endif

                        @if($property_data->description)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Beskrivelse</span>
                                <p style="white-space: pre-line">{{$property_data->description}}</p>
                            </div>
                        @endif
                        @if($property_data->location_description)
                            <div class="col-md-12">
                                <span class="font-weight-bold">Beliggenhet</span>
                                <p style="white-space: pre-line">{{$property_data->location_description}}</p>
                            </div>
                        @endif
                        <div class="clearfix"></div>
                        {{--<div style="width: 500px; height: 300px;">--}}
                            {{--{!! Mapper::render() !!}--}}
                        {{--</div>--}}
                        <div class="col-md-12"><a href="{{url('customer-services')}}" class="u-strong">Rapporter annonse</a></div>
                        <div class="col-md-12"><span class="font-weight-bold">Handel: </span> <span> {{$property_data->ad->id}}</span></div>
                        <div class="col-md-12"><span class="font-weight-bold">Oppdatert: </span> <span>{{date("d.m.Y H:i", strtotime($property_data->created_at))}}</span></div>
                        <div class="col-md-12 u-d1">Annonsene kan være mangelfulle i forhold til lovpålagt opplysningsplikt. Før bindende avtale inngås oppfordres interessenter til å innhente komplett informasjon fra meglerforetaket, selger eller utleier.</div>
                    </div>
                </div>
                <div class="col-md-4">
                    @if($property_data->user && $property_data->user->roles->first() && $property_data->user->roles->first()->name != 'company')
                        <div style=" box-shadow: 0px 0px 2px 1px #ac304a; padding: 4px 10px; margin-bottom: 20px; border-radius: 5px;">
                        @if(!$property_data->published_on)
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
                                <span>Telefon : </span>
                                <span><a href="tel:{{$property_data->phone}}" class="u-select-all" data-controller="trackSendSMS">  {{$property_data->phone}} </a></span>
                            </div>
                        @endif
                        @if(!$property_data->published_on)
                            <div class="mb-2">
                                <a href="{{url('property/commercial-plots/search?user_id='.$property_data->ad->user->id)}}">Flere annonser fra annonsør</a>
                            </div>
                        @endif

                        @if(!$property_data->ad->is_mine())
                            <div class="mb-2"><a href="{{url('messages/new', $property_data->ad->id)}}">Send melding</a></div>
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
                        @if($property_data->link && $property_data->text_for_information)
                            <div class="mb-2"><a href="{{$property_data->text_for_information}}" target="_blank">{{$property_data->link}}</a></div>
                        @endif
                        </div>
                    @else
                        @php
                            $show_more_ad_url = url('property/commercial-plots/search?user_id='.$property_data->ad->user->id);
                            $property_published_on = $property_data->published_on;
                        @endphp
                        @include('user-panel.partials.templates.landing_page_company_information')
                    @endif

            </div>
            <div style="width: 306px; height: 153px;">
                {!! Mapper::render() !!}
            </div>
        </div>
        </div>

        <div class="right-ad pull-right">
            <img src="assets/images/right-ad.png" class="img-fluid" alt="">
        </div>
    </main>


@endsection
