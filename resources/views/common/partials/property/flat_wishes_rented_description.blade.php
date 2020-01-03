@extends('layouts.landingSite')
    @section('page_content')

        <?php 

            // if(isset($property_data->facilities) && !empty($property_data->facilities))
            // {   

            //     $facilities = explode(",",rtrim($property_data->facilities, ","));

            // }
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
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{$full_path}}" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="single-realestate-caption" style="width:50%;margin:auto;margin-top: -20px;">Pen og koselig stue med peisovn til vedfyring (2/19)</div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-8">
                        <button class="dme-btn-outlined-blue" title="Lagre som favoritt"><i class="fa fa-heart mr-2"></i>Legg til favoritt</button>
                        <a href="#"><i class="fa fa-envelope" style="font-size: 25px; padding:7px 10px;"></i></a>
                        <a href="#"><i class="fab fa-facebook" style="font-size: 25px; padding:7px 10px;"></i></a>
                        <a href="#"><i class="fab fa-twitter" style="font-size: 25px; padding:7px 10px;"></i></a>
                        <div class="row single-realestate-detail p-3">
                            <div class="col-md-12">
                                <!-- <div class="u-t3 mt-3">JESSHEIM SENTRUM</div> -->
                                <h1 class="u-t2">{{$property_data->headline}}</h1>
                            </div>
                            <div class="col-md-12 text-muted"> </div>
                            <!-- <div class="col-md-12 mt-2"><p>{{$property_data->description}}</p></div> -->
                            <div class="col-md-12 font-weight-bold mt-3">Maks månedsleie</div>
                            <div class="col-md-12 u-t3">{{$property_data->max_rent_per_month}} Kr</div>
                            <div class="clearfix"></div>
                            <div class="mt-2 col-md-12"></div>
                            <div class="col-md-12"><span class="font-weight-bold">Boligtype: </span>&nbsp;<span> {{rtrim($property_data->property_type,",")}} </span></div>
                            <div class="col-md-12"><span class="font-weight-bold">Ønsket område: </span>&nbsp;<span>{{rtrim($property_data->region)}}</span></div>
                            <div class="col-md-12"><span class="font-weight-bold">Antall beboere:</span>&nbsp;<span>{{rtrim($property_data->number_of_tenants)}}</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Ønskes fra: </span>&nbsp;<span> {{date("d.m.Y", strtotime($property_data->wanted_from))}}</span></div>
                        

                            <!-- <a href="#" class="mt-2"><svg width="12" height="12" viewBox="0 0 12 12"><line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line><line x1="6" y1="0" x2="6" y2="12" stroke-width="2" stroke="currentColor"></line></svg> Flere detaljer</a> -->

                            
                            <div class="col-md-12">
                            <p>{{$property_data->description}}</p></div>
                            <!-- <div class="col-md-12">Salgsoppgaven beskriver vesentlig og lovpålagt informasjon om
                                eiendommen
                            </div> -->
                            <!-- <div class="col-md-12"><button class="btn btn-info btn-lg mt-2">Se komplett salgsoppgave</button></div>
                            <div class="col-md-12"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" class="" target="_blank">Bestill komplett, utskriftsvennlig salgsoppgave</a></div> -->
                            <!-- <div class="col-md-12"><h2 class="u-t3">Gjestadtoppen 28, 2050 Jessheim</h2></div>
                            <div class="col-md-12"><img src="assets/images/staticmap.png" alt=""></div>!-->
                            
                            <div class="col-md-12"><span class="font-weight-bold">FINN-kode: </span> <span> 140424636</span></div>
                            <div class="col-md-12"><span class="font-weight-bold">Sist endret: </span> <span> {{date("d.m.Y h:i", strtotime($property_data->created_at))}}</span></div>
                            <div class="col-md-12"><a href="#" class="u-strong">Rapporter annonse</a></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <img src="assets/images/dnb-logo.jpg" class="img-fluid" style="max-width: 150px;" alt="">
                        </div>
                        <p class="mt-3"> {{ $property_data->user->first_name }} {{ $property_data->user->last_name }}<br>
                            Eiendomsmegler</p>
                        <div class="mb-2">
                            <span>Mobil: </span>
                            <span><a href="tel:+4746545247" class="u-select-all" data-controller="trackSendSMS"> {{$property_data->phone}}</a></span>
                        </div>
                        <!-- <button class="btn btn-info btn-lg mb-2">Se komplett salgsoppgave</button> -->
                        <div class="mb-2"><a href="/realestate/homes/search.html?orgId=-3">Flere annonser fra annonsør</a></div>
                        <!-- <div class="mb-2"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Bestill komplett, utskriftsvennlig
                                salgsoppgave</a></div>
                        <div class="mb-2"><a href="https://www.dnbeiendom.no/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Se komplett salgsoppgave</a></div>
                        <div class="mb-2"><a href="https://bud.dnbeiendom.no/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Gi bud</a></div> -->
                        <h2 class="u-t3">Visning</h2>
                        <div class="mb-2">Ta kontakt for å avtale visning</div>
                        <div class="mb-2">Husk å bestille/laste ned salgsoppgave så du kan stille godt forberedt på visning.</div>
                        <button class="dme-btn-outlined-blue col-12">Gi bud</button>
                        <a href="https://hjelpesenter.finn.no/hc/no/articles/203012092" target="_blank" rel="noopener external">Les mer om elektronisk budgiving</a>
                    </div>
                </div>
            </div>

            <div class="right-ad pull-right">
                <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
            </div>
        </main>

    @endsection