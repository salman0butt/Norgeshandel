@extends('layouts.landingSite')
@section('page_content')

<?php
            $facilities = array();
            if(isset($property_data->facilities) && !empty($property_data->facilities))
            {
                $facilities = explode(",",rtrim($property_data->facilities, ","));
            }
            $name       =    $property_data->ad->company_gallery;

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
                                <li class="breadcrumb-item active"><a href="#">Holiday Home For Sales</a></li>
                            </ol>
                        </div>
                        <div class="col-md-6 p-0">
                            <ul class="breadcrumb w-100   text-right d-block"
                                style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;">
                                <li class="breadcrumb-item active d-inline-block">@if(!empty($prev))<a
                                        href="#"> &lt; Forrige </a> @else <span
                                        class="text-muted">Forrige</span>@endif</li>
                                <li class="breadcrumb-item active d-inline-block"><a href="#">Til
                                        søket</a></li>
                                <li class="breadcrumb-item active d-inline-block">@if(!empty($next))<a
                                        href="#"> Neste ></a> @else <span
                                        class="text-muted">Neste</span>@endif</li>
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

                <a href="#"><i class="fa fa-envelope" style="font-size: 25px; padding:7px 10px;"></i></a>
                <a href="#"><i class="fab fa-facebook" style="font-size: 25px; padding:7px 10px;"></i></a>
                <a href="#"><i class="fab fa-twitter" style="font-size: 25px; padding:7px 10px;"></i></a>
                <div class="row single-realestate-detail p-3">
                    <div class="col-md-12">
                        <div class="u-t3 mt-3">{{$property_data->ad_headline}}</div>
                    </div>
                    <div class="col-md-12 text-muted">{{$property_data->street_address ? $property_data->street_address.', ' : ''}}
                        <span>
                            @if($property_data->zip_code)
                                {{$property_data->zip_code}}
                                {{$property_data->zip_city ? $property_data->zip_city : ''}}
                            @endif
                        </span>
                    </div>

                    <!-- <div class="col-md-12 text-muted"></div>
                            <div class="col-md-12 mt-2"><p></p></div> -->
                    <div class="col-md-12 font-weight-bold mt-3">Prisantydning</div>
                    <div class="col-md-12 u-t3">{{$property_data->asking_price}} Kr</div>
                    <div class="clearfix"></div>
                    <div class="mt-2 col-md-12"></div>
                    <div class="bg-light-grey radius-8 col-md-12 p-3">
                        <div class="row">

                            @if($property_data->cost)
                                <div class="col-md-12">
                                    <span class="font-weight-bold">Omkostninger:</span>&nbsp;
                                    <span>{{$property_data->cost}} Kr</span>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <span class="font-weight-bold">Totalpris:</span>&nbsp;
                                <span>{{$property_data->total_price}} Kr</span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6"><span class="font-weight-bold">Etasje :</span>&nbsp;<span></span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Kommunale avg :.</span>&nbsp;<span></span></div> -->

                    <div class="col-md-12"><a href="#" class="u-strong">Pris på lån</a></div>
                    <div class="col-md-12"><a href="#" class="u-strong">Pris på forsikring</a></div>

                    <div class="clearfix"></div>
                    {{-- <div class="mt-2 col-md-12"></div> --}}
                    <div class="bg-light-grey radius-8 col-md-12 p-3">
                        <div class="row">

                            <div class="col-md-6">
                                <span class="font-weight-bold">Beliggenhet:</span>&nbsp;
                                <span>{{$property_data->location}} </span>
                            </div>

                            <div class="col-md-6">
                                <span class="font-weight-bold">Primærrom:</span>&nbsp;
                                <span>{{$property_data->primary_room}} m²</span>
                            </div>

                            <div class="col-md-6">
                                <span class="font-weight-bold">Boligtype:</span>&nbsp;
                                <span>{{$property_data->property_type}}</span>
                            </div>

                            <div class="col-md-6">
                                <span class="font-weight-bold">Bruksareal:</span>&nbsp;
                                <span>{{$property_data->use_area}} m²</span>
                            </div>

                            @if($property_data->ownership_type)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Eieform:</span>&nbsp;
                                    <span>{{$property_data->ownership_type}}</span>
                                </div>
                            @endif

                            @if($property_data->year_of_construction)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Byggeår:</span>&nbsp;
                                    <span>{{$property_data->year_of_construction}}</span>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <span class="font-weight-bold">Soverom:</span>&nbsp;
                                <span>{{$property_data->number_of_bedrooms}} m²</span>
                            </div>

                            @if($property_data->energy_grade)
                                <div class="col-md-6">
                                    <span class="font-weight-bold">Energimerking:</span>&nbsp;
                                    <span>{{$property_data->energy_grade}}</span>
                                </div>
                            @endif

                        </div>
                    </div>
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
                    <div class="col-md-12 more_details_section hide">
                        <div class="col-md-12 pl-0 pr-0">
                            <div class="bg-light-grey radius-8 col-md-12 p-3">
                                <div class="row p-2">

                                    <span class="font-weight-bold">Facilities</span>
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


                                <div class="col-md-12 more_details_section hide pl-0">
                                    @if($property_data->muncipal_number || $property_data->farm_number || $property_data->usage_number)
                                        <span class="font-weight-bold">Matrikkelinformasjon</span>
                                    @endif

                                    @if($property_data->muncipal_number)
                                        <div class="col-md-12">
                                            <span class="font-weight-bold">Kommunenr: </span>
                                            <span>{{$property_data->muncipal_number}}</span>
                                        </div>
                                    @endif

                                    @if($property_data->farm_number)
                                        <div class="col-md-12">
                                            <span class="font-weight-bold">Gårdsnr: </span>
                                            <span>{{$property_data->farm_number }}</span>
                                        </div>
                                    @endif

                                    @if($property_data->usage_number)
                                        <div class="col-md-12">
                                            <span class="font-weight-bold">Bruksnr: </span>
                                            <span>{{$property_data->usage_number }}</span>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                    @if($property_data->description)
                        <div class="col-md-12">
                            <span class="font-weight-bold">Beskrivelse</span>
                            <p>{{ $property_data->description }}</p>
                        </div>
                    @endif

                    @if($property_data->essential_information)
                        <div class="col-md-12">
                            <span class="font-weight-bold">Vesentlige opplysninger</span>
                            <p>{{ $property_data->essential_information }}</p>
                        </div>
                    @endif

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
                        <span>{{date("d.m.Y H:i", strtotime($property_data->created_at))}}</span></div>
                    <div class="col-md-12"><span class="font-weight-bold">Referanse: </span> <span>302190059</span>
                    </div>
                    <div class="col-md-12"><a href="#" class="u-strong">Rapporter annonse</a></div>
                    <div class="col-md-12 u-d2">Annonsene kan være mangelfulle i forhold til lovpålagt opplysningsplikt.
                        Før bindende avtale inngås oppfordres interessenter til å innhente komplett informasjon fra
                        meglerforetaket, selger eller utleier.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img src="assets/images/dnb-logo.jpg" class="img-fluid" style="max-width: 150px;" alt="">
                </div>
                <p class="mt-3"> {{ $property_data->user->first_name }} {{ $property_data->user->last_name }} <br>
                    Eiendomsmegler</p>
                @if($property_data->phone)
                    <div class="mb-2">
                        <span>Mobil: </span>
                        <span><a href="tel:+4746545247" class="u-select-all"
                                data-controller="trackSendSMS">{{$property_data->phone}}</a></span>
                    </div>
                @endif
                <button class="btn btn-info btn-lg mb-2">Se komplett salgsoppgave</button>
                <div class="mb-2"><a href="{{route('public_profile',$property_data->ad->user->id)}}">Flere annonser fra annonsør</a></div>
                @if(!$property_data->ad->is_mine())
                    <div class="mb-2"><a href="{{url('messages/new', $property_data->ad->id)}}">Send melding</a></div>
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
                    <span><?php echo (!empty($property_data->delivery_date) ? date("d.m.Y", strtotime($property_data->delivery_date)) : ""); ?></span>
                    <span><?php echo (!empty($property_data->from_clock) ?  $property_data->from_clock : ""); ?>
                    </span>
                    <span><?php echo (!empty($property_data->clockwise) ?  $property_data->clockwise : ""); ?>
                    </span>
                    <span><?php echo (!empty($property_data->note)            ?  $property_data->note : ""); ?></span>
                </div>
                @else
                <div class="mb-2"><span>Ta kontakt for å avtale visning</span></div>
                @endif
                <div class="mb-2">Husk å bestille/laste ned salgsoppgave så du kan stille godt forberedt på visning.
                </div>
                <button class="dme-btn-outlined-blue col-12">Gi bud</button>
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

<script type="text/javascript">
    $(document).ready(function () {

        $("#more_details").click(function (e) {

            e.preventDefault();
            $(".more_details_section").removeClass('hide');
            $("#more_details").addClass('hide');
            $("#less_details").removeClass('hide');

        });

        $("#less_details").click(function (e) {

            e.preventDefault();
            $(".more_details_section").addClass('hide');
            $("#more_details").removeClass('hide');
            $("#less_details").addClass('hide');

        });


    });

</script>

@endsection
