@extends('layouts.landingSite')
@section('page_content')

<?php 
    
        $facilities = array();
        if(isset($property_data->facilities) && !empty($property_data->facilities))
        {   

            $facilities = explode(",",rtrim($property_data->facilities, ","));

        }

        $name       = $property_data->media;
        // if($name != null)
        // {
        //     $name       =    $name->name_unique;
        //     $path       =    \App\Helpers\common::getMediaPath($property_data);
        //     $full_path  =    $path."".$name; 
        // }
        // else
        // {
        //     $full_path  = "";
        // }

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
                                <li class="breadcrumb-item active"><a href="#">Commercial Property For Sale</a></li>
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
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">

                        <?php $i = 0; ?>
                        @if($name->count() > 0)
                            @foreach($name as $key=>$val)
                                <?php 
                                    $unique_name  =  $val->name_unique;
                                    $path  =    \App\Helpers\common::getMediaPath($property_data);
                                    $full_path  = $path."". $unique_name; 
                                ?>
                        
                                    <div class="carousel-item <?php echo($i == 0 ? "active" : ""); ?>">
                                    <img class="d-block w-100" src="{{$full_path}}" alt="First slide">
                                    </div>
                                
                            <?php $i++ ?>
                            @endforeach
                          @else
                            <div class="carousel-item <?php echo($i == 0 ? "active" : ""); ?>">
                                <img class="d-block w-100" src="{{ asset('/public/uploads/banners/1280x720.png') }}" alt="First slide">
                            </div>
                            @endif

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <div class="single-realestate-caption" style="width:50%;margin:auto;margin-top: -20px;">Pen og koselig
                    stue med peisovn til vedfyring (2/19)</div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-8">
                <button class="dme-btn-outlined-blue" title="Lagre som favoritt"><i class="fa fa-heart mr-2"></i>Legg
                    til favoritt</button>
                <a href="#"><i class="fa fa-envelope" style="font-size: 25px; padding:7px 10px;"></i></a>
                <a href="#"><i class="fab fa-facebook" style="font-size: 25px; padding:7px 10px;"></i></a>
                <a href="#"><i class="fab fa-twitter" style="font-size: 25px; padding:7px 10px;"></i></a>
                <div class="row single-realestate-detail p-3">
                    <div class="col-md-12">
                        <div class="u-t3 mt-3">JESSHEIM SENTRUM</div>
                        <h1 class="u-t2">{{$property_data->headline}}</h1>
                    </div>
                    <div class="col-md-12 text-muted">{{$property_data->street_address}}</div>
                    <div class="col-md-12 mt-2">
                        <p>{{$property_data->description_simple}}</p>
                    </div>
                    <div class="col-md-12 font-weight-bold mt-3">Totalpris</div>
                    <div class="col-md-12 u-t3">{{$property_data->rental_income}} kr</div>
                    <!-- <div class="col-md-6"><span class="font-weight-bold">Fellesgjeld: </span><span>1 861 kr</span></div>
                        <div class="col-md-6"><span class="font-weight-bold">Omkostninger: </span><span>138 222 kr</span></div>
                        <div class="col-md-6"><span class="font-weight-bold">Totalpris: </span><span>5 390 083 kr</span></div>
                        <div class="col-md-6"><span class="font-weight-bold">Felleskost/mnd.: </span><span>4 260 kr</span></div>
                        <div class="col-md-6"><span class="font-weight-bold">Kommunale avg.: </span><span>8 490 kr per år</span></div> -->
                    <div class="clearfix"></div>
                    {{-- <div class="mt-2 col-md-12"></div> --}}
                    <div class="bg-light-grey radius-8 col-md-12 p-3">
                        <div class="row">
                            <div class="col-md-6"><span class="font-weight-bold">Type lokale </span>&nbsp;<span
                                    style="overflow-wrap: break-word;">{{rtrim($property_data->property_type,",")}}</span>
                            </div>
                            <div class="col-md-6"><span class="font-weight-bold">Bruksarea
                                </span>&nbsp;<span>{{$property_data->use_area}} m²</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Eieform </span>&nbsp;<span>Eier
                                    (Selveier)</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Etasje
                                </span>&nbsp;<span>{{$property_data->floors}}</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Bruttoareal
                                </span>&nbsp;<span>{{$property_data->gross_area_from}} -
                                    {{$property_data->gross_area_to}} m²</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Byggeår
                                </span>&nbsp;<span>{{$property_data->year_of_construction}}</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Primærrom
                                </span>&nbsp;<span>{{$property_data->primary_room}} m²</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Energimerking </span>&nbsp;<span>
                                    {{$property_data->energy_grades}} - {{$property_data->heating_character}} </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 more_details_section hide pl-0 pr-0">
                        <div class="col-md-12 pl-0 pr-0 mt-3">
                            <div class="bg-light-grey radius-8 col-md-12 p-3">
                                <div class="row p-2">
                                    <div class="col-md-12"><span class="font-weight-bold">Matrikkelinformasjon </div>
                                    <div class="col-md-12"><span class="">Kommunenr:
                                            {{$property_data->municipal_number}}</span></div>
                                    <div class="col-md-12"><span class="">Gårdsnr: {{$property_data->usage_number}}
                                        </span></div>
                                    <div class="col-md-12"><span class="">Bruksnr: {{$property_data->farm_number}}
                                        </span></div>
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
                    <!-- <div class="col-md-12"><p>Rimelige fellesutgifter med bla. fyring, varmtvann og TV-og Internett inkludert. To garasjeplasser i oppvarmet garasjeanlegg i kjeller samt bod.</p></div>
                        <div class="col-md-12">Salgsoppgaven beskriver vesentlig og lovpålagt informasjon om
                            eiendommen
                        </div> -->
                    <!-- <div class="col-md-12"><button class="btn btn-info btn-lg mt-2">Se komplett salgsoppgave</button></div>
                        <div class="col-md-12"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" class="" target="_blank">Bestill komplett, utskriftsvennlig salgsoppgave</a></div>
                        <div class="col-md-12"><h2 class="u-t3">Gjestadtoppen 28, 2050 Jessheim</h2></div>
                        <div class="col-md-12"><img src="assets/images/staticmap.png" alt=""></div> -->

                    <div class="col-md-12"><a href="#" class="u-strong">Rapporter annonse</a></div>
                    <div class="col-md-12"><span class="font-weight-bold">Handelskode: </span> <span> 140424636</span></div>
                    <div class="col-md-12"><span class="font-weight-bold">Oppdatert: </span>
                        <span>{{date("d.m.Y h:i", strtotime($property_data->created_at))}}</span></div>
                    <div class="col-md-12"><span class="font-weight-bold">Referanse: </span> <span>302190059</span>
                    </div>
                    <div class="col-md-12 u-d2">Annonsene kan være mangelfulle i forhold til lovpålagt opplysningsplikt.
                        Før bindende avtale inngås oppfordres interessenter til å innhente komplett informasjon fra
                        meglerforetaket, selger eller utleier.</div>
                </div>
            </div>
            <div class="col-md-4">
               <div style=" box-shadow: 0px 0px 2px 1px #ac304a; padding: 4px 10px; margin-bottom: 20px; border-radius: 5px;">
                        <div class="text-center">
                            <img src="assets/images/dnb-logo.jpg" class="img-fluid" style="max-width: 150px;" alt="">
                        </div>
                <p class="mt-3"> {{ $property_data->user->first_name }} {{ $property_data->user->last_name }}<br>
                    Eiendomsmegler</p>
                <div class="mb-2">
                    <span>Mobil: </span>
                    <span><a href="tel:+4746545247" class="u-select-all" data-controller="trackSendSMS">
                            {{$property_data->phone}}</a></span>
                </div>
                {{-- <button class="btn btn-info btn-lg mb-2">Se komplett salgsoppgave</button> --}}
                <div class="mb-2"><a href="/realestate/homes/search.html?orgId=-3">Flere annonser fra annonsør</a></div>
                <div class="mb-2"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" target="_blank"
                        rel="noopener external" data-controller="trackCustomerLink">Bestill komplett, utskriftsvennlig
                        salgsoppgave</a></div>
                        </div>
                <!-- <div class="mb-2"><a href="https://www.dnbeiendom.no/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Se komplett salgsoppgave</a></div>
                    <div class="mb-2"><a href="https://bud.dnbeiendom.no/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Gi bud</a></div> -->
                <h2 class="u-t3">Visning</h2>
                <div class="mb-2">Ta kontakt for å avtale visning</div>
                <div class="mb-2">Husk å bestille/laste ned salgsoppgave så du kan stille godt forberedt på visning.
                </div>
                <button class="dme-btn-maroon col-12 mb-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Se komplett salgsoppgave</font></font></button>
                <button class="dme-btn-maroon col-12 mb-2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Gi bud</font></font></button>
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
