
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
                                <li class="breadcrumb-item active"><a href="#">Property</a></li>
                                <li class="breadcrumb-item active"><a href="#">Commercial Plots</a></li>
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
                            <!-- <div class="u-t3 mt-3">JESSHEIM SENTRUM</div> -->
                            <h1 class="u-t2">{{$property_data->headline}}</h1>
                        </div>
                        <div class="col-md-12 text-muted">{{$property_data->street_address ? $property_data->street_address.', ' : ''}}<span class="db_zip_code">{{$property_data->zip_code}}</span></div>

                        @if($property_data->location_description)
                            <div class="col-md-12 mt-2"><p>{{$property_data->location_description}}</p></div>
                        @endif
                        <!-- <div class="col-md-12 font-weight-bold mt-3">Prisantydning</div>
                        <div class="col-md-12 u-t3">5 250 000 kr</div> -->
                        <!-- <div class="col-md-6"><span class="font-weight-bold">Fellesgjeld: </span><span>1 861 kr</span></div>
                        <div class="col-md-6"><span class="font-weight-bold">Omkostninger: </span><span>138 222 kr</span></div> -->
                        <div class="col-md-6"><span class="font-weight-bold">Boligtype: </span><span>{{$property_data->plot_type}}</span></div>

                        @if($property_data->plot_size)
                            <div class="col-md-6"><span class="font-weight-bold">Tomteareal: </span><span>{{$property_data->plot_size}} m² (eiet)</span></div>
                        @endif
                        <div class="col-md-12"><a href="#" class="u-strong">Pris på lån</a></div>
                        <div class="col-md-12"><a href="#" class="u-strong">Pris på forsikring</a></div>
                        <!-- <div class="col-md-6"><span class="font-weight-bold">Kommunale avg.: </span><span>8 490 kr per år</span></div> -->
                        <div class="clearfix"></div>
                        <!-- <div class="mt-2 col-md-12"></div>
                        <div class="col-md-6"><span class="font-weight-bold">Boligtype </span>&nbsp;<span>Leilighet</span></div>
                        <div class="col-md-6"><span class="font-weight-bold">Bruksarea </span>&nbsp;<span>l115 m²</span></div>
                        <div class="col-md-6"><span class="font-weight-bold">Eieform </span>&nbsp;<span>Eier (Selveier)</span></div>
                        <div class="col-md-6"><span class="font-weight-bold">Etasje </span>&nbsp;<span>3</span></div>
                        <div class="col-md-6"><span class="font-weight-bold">Soverom </span>&nbsp;<span>3</span></div>
                        <div class="col-md-6"><span class="font-weight-bold">Byggeår </span>&nbsp;<span>2015</span></div>
                        <div class="col-md-6"><span class="font-weight-bold">Primærrom </span>&nbsp;<span>97 m²</span></div>
                        <div class="col-md-6"><span class="font-weight-bold">Energimerking </span>&nbsp;<span> C - mørkegrønn</span></div> -->

                        <div class="col-md-12">
                            <a href="#" class="mt-2"><svg width="12" height="12" viewBox="0 0 12 12"><line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line><line x1="6" y1="0" x2="6" y2="12" stroke-width="2" stroke="currentColor"></line></svg> Flere detaljer</a>
                        </div>


                        <div style="width: 500px; height: 300px;">
                            {!! Mapper::render() !!}
                        </div>
                        <!-- <div class="col-md-12"><p>Rimelige fellesutgifter med bla. fyring, varmtvann og TV-og Internett inkludert. To garasjeplasser i oppvarmet garasjeanlegg i kjeller samt bod.</p></div>
                        <div class="col-md-12">Salgsoppgaven beskriver vesentlig og lovpålagt informasjon om
                            eiendommen
                        </div> -->
                        <!-- <div class="col-md-12"><button class="btn btn-info btn-lg mt-2">Se komplett salgsoppgave</button></div>
                        <div class="col-md-12"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" class="" target="_blank">Bestill komplett, utskriftsvennlig salgsoppgave</a></div>
                        <div class="col-md-12"><h2 class="u-t3">Gjestadtoppen 28, 2050 Jessheim</h2></div>
                        <div class="col-md-12"><img src="assets/images/staticmap.png" alt=""></div> -->
                        <div class="col-md-12"><a href="#" class="u-strong">Rapporter annonse</a></div>
                        <div class="col-md-12"><span class="font-weight-bold">Handel: </span> <span> 140424636</span></div>
                        <div class="col-md-12"><span class="font-weight-bold">Oppdatert: </span> <span>{{date("d.m.Y h:i", strtotime($property_data->created_at))}}</span></div>
                        <div class="col-md-12"><span class="font-weight-bold">Referanse: </span> <span>302190059</span></div>
                        <div class="col-md-12 u-d1">Annonsene kan være mangelfulle i forhold til lovpålagt opplysningsplikt. Før bindende avtale inngås oppfordres interessenter til å innhente komplett informasjon fra meglerforetaket, selger eller utleier.</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <img src="assets/images/dnb-logo.jpg" class="img-fluid" style="max-width: 150px;" alt="">
                    </div>
                    <p class="mt-3">  {{ $property_data->user->first_name }} {{ $property_data->user->last_name }}<br>
                        Eiendomsmegler</p>
                    <div class="mb-2">
                        <span>Mobil: </span>
                        <span><a href="tel:{{$property_data->contact}}" class="u-select-all" data-controller="trackSendSMS">  {{$property_data->contact}} </a></span>
                    </div>
                    <button class="btn btn-info btn-lg mb-2">Se komplett salgsoppgave</button>
                    <div class="mb-2"><a href="{{route('public_profile',$property_data->ad->user->id)}}">Flere annonser fra annonsør</a></div>
                    <div class="mb-2"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Bestill komplett, utskriftsvennlig
                            salgsoppgave</a></div>
                    @if(!$property_data->ad->is_mine())
                        <div class="mb-2"><a href="{{url('messages/new', $property_data->ad->id)}}">Send melding</a></div>
                    @endif

                <!-- <div class="mb-2"><a href="https://www.dnbeiendom.no/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Se komplett salgsoppgave</a></div>
                    <div class="mb-2"><a href="https://bud.dnbeiendom.no/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Gi bud</a></div> -->
                    <h2 class="u-t3">Visning</h2>
                    <div class="mb-2">Ta kontakt for å avtale visning</div>
                    <div class="mb-2">Husk å bestille/laste ned salgsoppgave så du kan stille godt forberedt på visning.</div>
                    <button class="dme-btn-outlined-blue col-12">Gi bud</button>
                    {{-- <a href="#" target="_blank" rel="noopener external">Les mer om elektronisk budgiving</a> --}}
                </div>
            </div>
        </div>

        <div class="right-ad pull-right">
            <img src="assets/images/right-ad.png" class="img-fluid" alt="">
        </div>
    </main>


@endsection
