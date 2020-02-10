@extends('layouts.landingSite')
@section('page_content')


<?php 

            $facilities = array();
            if(isset($property_data->facilities) && !empty($property_data->facilities))
            {   

                $facilities = explode(",",rtrim($property_data->facilities, ","));

            }
            /* Zille Code commented by ameer hamza
            $name       = $property_data->media->first();
            if($name != null)
            {
                $name       =    $name->name_unique;
                $path       =    \App\Helpers\common::getMediaPath($property_data);
                $full_path  =    $path."".$name;
            }
            else
            {
                $full_path  = "";
            }
            */


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
                            <li class="breadcrumb-item active"><a href="#">Property</a></li>
                            <li class="breadcrumb-item active"><a href="#">Property For Rent</a></li>
                        </ol>
                    </div>
                    <div class="col-md-6 p-0">
                        <ul class="breadcrumb w-100   text-right d-block"
                            style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;">
                            <li class="breadcrumb-item active d-inline-block">@if(!empty($prev))<a href="#"> &lt;
                                    Forrige </a> @else <span class="text-muted">Forrige</span>@endif</li>
                            <li class="breadcrumb-item active d-inline-block"><a href="#">Til
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
                @php $name = $property_data->media; @endphp
                @include('user-panel.partials.landing_page_slider',compact('name'));
            </div>
            <div class="col-md-12 text-center">
                <div class="single-realestate-caption" style="width:50%;margin:auto;margin-top: -20px;">{{$property_data->heading}}</div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-8">
                @php $ad = $property_data->ad; @endphp
                @include('user-panel.partials.favorite-button',compact('ad'))

                <a href="#"><i class="fa fa-envelope" style="font-size: 25px; padding:7px 10px;"></i></a>
                <a href="#"><i class="fab fa-facebook" style="font-size: 25px; padding:7px 10px;"></i></a>
                <a href="#"><i class="fab fa-twitter" style="font-size: 25px; padding:7px 10px;"></i></a>
                <div class="row single-realestate-detail p-3">
                    <div class="col-md-12">

                        <div class="u-t3 mt-3">{{$property_data->local_area_name}}</div>
                        <h1 class="u-t2">{{$property_data->local_area_name}} | {{$property_data->number_of_bedrooms}}
                            soverom | {{$property_data->property_type}} | </h1>
                    </div>
                    <div class="col-md-12 text-muted">{{$property_data->street_address}}</div>
                    <div class="col-md-12 mt-2">
                        <p>{{$property_data->description}}</p>
                    </div>

                    <div class="col-md-12 font-weight-bold mt-3">Prisantydning</div>
                    <div class="col-md-12 u-t3">{{$property_data->asking_price}} Kr</div>
                    <div class="clearfix"></div>
                    {{-- <div class="mt-2 col-md-12"></div> --}}
                    <div class="bg-light-grey radius-8 col-md-12 p-3">
                        <div class="row">
                            <div class="col-md-12"><span class="font-weight-bold">Omkostninger
                                    :</span>&nbsp;<span>{{$property_data->expenses}} m²</span></div>
                            <div class="col-md-12"><span class="font-weight-bold">Totalpris
                                    :</span>&nbsp;<span>{{$property_data->total_price}} Kr</span></div>
                            <div class="col-md-12"><span class="font-weight-bold">Kommunale avg :.</span>&nbsp;<span>
                                    {{$property_data->Kommunale}} Kr</span></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12"></div>
                    <div class="bg-light-grey radius-8 col-md-12 p-3">
                        <div class="row">

                            <div class="col-md-6"><span class="font-weight-bold">Boligtype
                                </span>&nbsp;<span>{{$property_data->property_type}}</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Bruksarea </span>&nbsp;<span>115
                                    m²</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Eieform
                                </span>&nbsp;<span>{{$property_data->tenure}}</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Byggeår
                                </span>&nbsp;<span>{{$property_data->year}}</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Soverom
                                </span>&nbsp;<span>{{$property_data->number_of_bedrooms}}</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Energimerking
                                </span>&nbsp;<span>{{$property_data->energy_grade}} -
                                    {{ $property_data-> heating_character }} </span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Tomteareal
                                </span>&nbsp;<span>{{$property_data->land}} m²</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Bruttoareal </span>&nbsp;<span>
                                    {{$property_data->use_area}} </span></div>

                            <div class="col-md-12"><span class="font-weight-bold">Formuesverdi: </span>&nbsp;<span>
                                    {{$property_data->asset_value}} Kr</span></div>
                            <div class="col-md-12"><span class="font-weight-bold">Verditakst: </span>&nbsp;<span>
                                    {{$property_data->value_rate}} Kr</span></div>
                        </div>
                    </div>
                    <div class="col-md-12 more_details_section hide mt-2 mb-2 pl-0 pr-0">
                        <div class="col-md-12 pl-0 pr-0">
                            <div class="bg-light-grey radius-8 col-md-12 p-3">
                                <div class="row p-2">
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
                            </div>
                        </div>
                        <span class="font-weight-bold">Arealbeskrivelse</span>
                        <br>
                        <br>
                        <span class="font-weight-bold ">Matrikkelinformasjon</span>
                        <div class="col-md-12"><span class="">Kommunenr: </span>&nbsp;<span>
                                {{$property_data->municipality_number}}</span></div>
                        <div class="col-md-12"><span class="">Gårdsnr: </span>&nbsp;<span>
                                {{$property_data->farm_number}}</span></div>
                        <div class="col-md-12"><span class="">Bruksnr: </span>&nbsp;<span>
                                {{$property_data->usage_number}}</span></div>
                    </div>
                    <div class="col-md-12">
                        <a href="#" id="more_details" class="mt-2">
                            <svg width="12" height="12" viewBox="0 0 12 12">
                                <line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line>
                                <line x1="6" y1="0" x2="6" y2="12" stroke-width="2" stroke="currentColor"></line>
                            </svg> Flere detaljer
                        </a>
                        <a href="#" id="less_details" class="mt-2 hide">
                            <svg width="12" height="12" viewBox="0 0 12 12">
                                <line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line>
                            </svg> Færre detaljer
                        </a>
                    </div>

                    <!-- <div class="col-md-12"><p>{{ $property_data-> essential_information}}</p></div> -->
                    <!-- <div class="col-md-12">Salgsoppgaven beskriver vesentlig og lovpålagt informasjon om
                                eiendommen
                            </div> -->
                    <!-- <div class="col-md-12"><button class="btn btn-info btn-lg mt-2">Se komplett salgsoppgave</button></div> -->
                    <!-- <div class="col-md-12"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" class="" target="_blank">Bestill komplett, utskriftsvennlig salgsoppgave</a></div>
                            <div class="col-md-12"><h2 class="u-t3">Gjestadtoppen 28, 2050 Jessheim</h2></div>
                            <div class="col-md-12"><img src="assets/images/staticmap.png" alt=""></div> -->

                    <div class="col-md-12"><span class="font-weight-bold">Handelskode: </span> <span> 140424636</span>
                    </div>
                    <div class="col-md-12"><span class="font-weight-bold">Sist endret: </span>
                        <span>{{date("d.m.Y h:i", strtotime($property_data->created_at))}}</span></div>
                    <div class="col-md-12"><span class="font-weight-bold">Referanse: </span> <span>302190059</span>
                    </div>
                    <div class="col-md-12"><a href="#" class="u-strong">Rapporter annonse</a></div>
                    <div class="col-md-12 u-d2">Annonsene kan være mangelfulle i forhold til lovpålagt opplysningsplikt.
                        Før bindende avtale inngås oppfordres interessenter til å innhente komplett informasjon fra
                        meglerforetaket, selger eller utleier.</div>

                </div>
            </div>
            <div class="col-md-4">
                <div
                    style=" box-shadow: 0px 0px 2px 1px #ac304a; padding: 4px 10px; margin-bottom: 20px; border-radius: 5px;">
                    <div class="text-center">
                        <img src="assets/images/dnb-logo.jpg" class="img-fluid" style="max-width: 150px;" alt="">
                    </div>

                    <p class="mt-3">
                        {{ $property_data->user->first_name }} {{ $property_data->user->last_name }}<br>
                        Eiendomsmegler</p>
                    <div class="mb-2">
                        <span>Mobil: </span>
                        <span><a href="tel:+4746545247" class="u-select-all"
                                data-controller="trackSendSMS">{{ $property_data->phone }}</a></span>
                    </div>
                    {{-- <button class="btn btn-info btn-lg mb-2">Se komplett salgsoppgave</button> --}}
                    <div class="mb-2"><a href="/realestate/homes/search.html?orgId=-3">Flere annonser fra annonsør</a>
                    </div>
                </div>
                <!-- <div class="mb-2"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Bestill komplett, utskriftsvennlig
                                salgsoppgave</a></div>
                        <div class="mb-2"><a href="https://www.dnbeiendom.no/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Se komplett salgsoppgave</a></div>
                        <div class="mb-2"><a href="https://bud.dnbeiendom.no/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Gi bud</a></div> -->
                <h2 class="u-t3">Visning</h2>
                @if(!empty($property_data->deliver_date) || !empty($property_data->from_clock) ||
                !empty($property_data->clockwise) || !empty($property_data->clockwise) ||
                !empty($property_data->note))
                <div class="mb-2">
                    <span
                        style="font-weight:500"><?php echo (!empty($property_data->deliver_date) ? date("d.m.Y", strtotime($property_data->delivery_date)) : ""); ?></span>
                    <span
                        style="font-weight:500"><?php echo (!empty($property_data->from_clock) ?  $property_data->from_clock : ""); ?>
                    </span>
                    <span
                        style="font-weight:500"><?php echo (!empty($property_data->clockwise) ?  $property_data->clockwise : ""); ?>
                    </span>
                    <span
                        style="font-weight:500"><?php echo (!empty($property_data->note)            ?  $property_data->note : ""); ?></span>
                </div>
                @else
                <div class="mb-2" style="font-weight:500"><span>Ta kontakt for å avtale visning</span></div>
                @endif
                <div class="mb-2" style="font-weight:500">Husk å bestille/laste ned salgsoppgave så du kan stille godt
                    forberedt på visning.
                </div>
                <button class="dme-btn-maroon col-12 mb-2">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Se komplett salgsoppgave</font>
                    </font>
                </button>
                <button class="dme-btn-maroon col-12 mb-2">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Gi bud</font>
                    </font>
                </button>
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

    <div class="row">


            
        <div class="right-ad pull-right">
            <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
        </div>
    </div>
</main>

@endsection
