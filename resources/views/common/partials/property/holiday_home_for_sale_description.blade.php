@extends('layouts.landingSite')
    @section('page_content')

        <?php 

            if(isset($property_data->facilities) && !empty($property_data->facilities))
            {   

                $facilities = explode(",",rtrim($property_data->facilities, ","));

            }

            $name       =    $property_data->media->first();
            if($name != null)
            {
                $name       =    $name->name_unique;
                $path       = \App\Helpers\common::getMediaPath($property_data);
                $full_path  = $path."".$name; 
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
                                <div class="u-t3 mt-3">{{$property_data->ad_headline}}</div>
                                <h1 class="u-t2">{{$property_data->street_address}}</h1>
                            </div>
                            <!-- <div class="col-md-12 text-muted"></div>
                            <div class="col-md-12 mt-2"><p></p></div> -->
                            <div class="col-md-12 font-weight-bold mt-3">Prisantydning</div>
                            <div class="col-md-12 u-t3">{{$property_data->asking_price}} Kr</div>
                            <div class="clearfix"></div>
                            <div class="mt-2 col-md-12"></div>
                            <div class="col-md-12"><span class="font-weight-bold">Omkostninger :</span>&nbsp;<span>{{$property_data->cost}} Kr</span></div>
                            <div class="col-md-12"><span class="font-weight-bold">Totalpris :</span>&nbsp;<span>{{$property_data->total_price}} Kr</span></div>
                            <!-- <div class="col-md-6"><span class="font-weight-bold">Etasje :</span>&nbsp;<span></span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Kommunale avg :.</span>&nbsp;<span></span></div> -->
                            
                            <div class="col-md-12"><a href="#" class="u-strong">Pris på lån</a></div>
                            <div class="col-md-12"><a href="#" class="u-strong">Pris på forsikring</a></div>

                            <div class="clearfix"></div>
                            <div class="mt-2 col-md-12"></div>
                            <div class="col-md-6"><span class="font-weight-bold">Beliggenhet: </span>&nbsp;<span>{{$property_data->location}} </span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Primærrom: </span>&nbsp;<span>{{$property_data->primary_room}} m²</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Boligtype: </span>&nbsp;<span>{{$property_data->property_type}}</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Bruksareal: </span>&nbsp;<span>{{$property_data->use_area}} m²</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Eieform: </span>&nbsp;<span>{{$property_data->ownership_type}}</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Byggeår: </span>&nbsp;<span>{{$property_data->year_of_construction}}</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Soverom: </span>&nbsp;<span>{{$property_data->number_of_bedrooms}} m²</span></div>
                            <div class="col-md-6"><span class="font-weight-bold">Energimerking: </span>&nbsp;<span>{{$property_data->energy_grade}}</span></div>
                        
                            <a href="#" id="more_details" class="mt-2">
                                <svg width="12" height="12" viewBox="0 0 12 12"><line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line><line x1="6" y1="0" x2="6" y2="12" stroke-width="2" stroke="currentColor"></line></svg> Flere detaljer
                            </a>
                            <a href="#" id="less_details" class="mt-2 hide">
                                <svg width="12" height="12" viewBox="0 0 12 12"><line x1="0" y1="6" x2="12" y2="6" stroke-width="2" stroke="currentColor"></line></svg> Færre detaljer
                            </a>
                            <div class="col-md-12 more_details_section hide">
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

                            <div class="col-md-12 more_details_section hide">
                                <span class="font-weight-bold">Matrikkelinformasjon</span>
                                <div class="col-md-12"><span class="font-weight-bold">Kommunenr: </span> <span> {{$property_data -> muncipal_number}}</span></div>
                                <div class="col-md-12"><span class="font-weight-bold">Gårdsnr: </span> <span> {{$property_data -> farm_number }}</span></div>
                                <div class="col-md-12"><span class="font-weight-bold">Bruksnr: </span> <span> {{$property_data -> usage_number }}</span></div>
                            </div>



                            <div class="col-md-12"><span class="font-weight-bold">Beskrivelse</span><p>{{ $property_data-> description }}</p></div>
                            <div class="col-md-12"><span class="font-weight-bold">Vesentlige opplysninger</span><p>{{ $property_data-> essential_information }}</p></div>
                
                            <!-- <div class="col-md-12">Salgsoppgaven beskriver vesentlig og lovpålagt informasjon om
                                eiendommen
                            </div> -->
                            <!-- <div class="col-md-12"><button class="btn btn-info btn-lg mt-2">Se komplett salgsoppgave</button></div> -->
                            <!-- <div class="col-md-12"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" class="" target="_blank">Bestill komplett, utskriftsvennlig salgsoppgave</a></div>
                            <div class="col-md-12"><h2 class="u-t3">Gjestadtoppen 28, 2050 Jessheim</h2></div>
                            <div class="col-md-12"><img src="assets/images/staticmap.png" alt=""></div> -->
                          
                            <div class="col-md-12"><span class="font-weight-bold">FINN-kode: </span> <span> 140424636</span></div>
                            <div class="col-md-12"><span class="font-weight-bold">Sist endret: </span> <span>{{date("d.m.Y h:i", strtotime($property_data->created_at))}}</span></div>                            <div class="col-md-12"><span class="font-weight-bold">Referanse: </span> <span>302190059</span></div>
                            <div class="col-md-12"><a href="#" class="u-strong">Rapporter annonse</a></div>
                            <div class="col-md-12 u-d1">Annonsene kan være mangelfulle i forhold til lovpålagt opplysningsplikt. Før bindende avtale inngås oppfordres interessenter til å innhente komplett informasjon fra meglerforetaket, selger eller utleier.</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <img src="assets/images/dnb-logo.jpg" class="img-fluid" style="max-width: 150px;" alt="">
                        </div>
                        <p class="mt-3"> {{ $property_data->user->first_name }} {{ $property_data->user->last_name }} <br>
                            Eiendomsmegler</p>
                        <div class="mb-2">
                            <span>Mobil: </span>
                            <span><a href="tel:+4746545247" class="u-select-all" data-controller="trackSendSMS">{{$property_data -> phone}}</a></span>
                        </div>
                        <button class="btn btn-info btn-lg mb-2">Se komplett salgsoppgave</button>
                        <div class="mb-2"><a href="/realestate/homes/search.html?orgId=-3">Flere annonser fra annonsør</a></div>
                        <!-- <div class="mb-2"><a href="https://www.dnbeiendom.no/Autoprospekt/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Bestill komplett, utskriftsvennlig
                                salgsoppgave</a></div>
                        <div class="mb-2"><a href="https://www.dnbeiendom.no/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Se komplett salgsoppgave</a></div>
                        <div class="mb-2"><a href="https://bud.dnbeiendom.no/302190059" target="_blank" rel="noopener external" data-controller="trackCustomerLink">Gi bud</a></div> -->
                        <h2 class="u-t3">Visning</h2>
                        @if(!empty($property_data->delivery_date) || !empty($property_data->from_clock) || !empty($property_data->clockwise_clock) || !empty($property_data->clockwise_clock) || !empty($property_data->note))
                            <div class="mb-2">
                                <span><?php echo (!empty($property_data->delivery_date) ? date("d.m.Y", strtotime($property_data->delivery_date)) : ""); ?></span> 
                                <span><?php echo (!empty($property_data->from_clock) ?  $property_data->from_clock ."pm,": ""); ?> </span> 
                                <span><?php echo (!empty($property_data->clockwise_clock) ?  $property_data->clockwise_clock. "pm" : ""); ?> </span>
                                <span><?php echo (!empty($property_data->note)            ?  $property_data->note : ""); ?></span> 
                            </div>
                        @else   
                            <div class="mb-2"><span>Ta kontakt for å avtale visning</span></div>
                        @endif
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

        <script type="text/javascript">
        
            $(document).ready(function(){
                
                $("#more_details").click(function(e){
                    
                    e.preventDefault();
                    $(".more_details_section").removeClass('hide');
                    $("#more_details").addClass('hide');
                    $("#less_details").removeClass('hide');
                    
                });
                
                $("#less_details").click(function(e){
                    
                    e.preventDefault();
                    $(".more_details_section").addClass('hide');
                    $("#more_details").removeClass('hide');
                    $("#less_details").addClass('hide');
                    
                });
                

            });
        
        </script>

    @endsection