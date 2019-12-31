@extends('layouts.landingSite')
@section('page_content')
<main class="dme-wrepper">
        <div class="left-ad float-left">
            <img src="{{asset('public/images/left-ad.png')}}" class="img-fluid" alt="">
        </div>
        <div class="dme-container pl-3 pr-3">
            <div class="row top-ad">
                <img src="{{asset('public/images/top-ad.png')}}" class="img-fluid m-auto" alt="">
            </div>
            <div class="row mt-4">
                <div class="col-md-12 bg-maroon-lighter pt-2 mb-3" style="">
                    <img src="{{asset('public/images/Jobb_ikon_maroon.svg')}}" style="max-width: 50px;" class="pt-2 pb-2 float-left">
                    <h2 class="u-t2 p-2">&nbsp; Eiendom</h2>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <ul class="product-sub-cat-list pl-3">
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('property/for/sale')}}">Bolig til salgs <span class="u-stone">(16 853)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="new-buildings.php?grid">Nye boliger <span class="u-stone">(19 416)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="plots.php?grid">Tomter <span class="u-stone">(1 575)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href=" {{url('holiday/home/for/sale/ads')}}">Fritidsbolig til salgs <span class="u-stone">(3 907)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="leisureplots.php?grid">Fritidstomter <span class="u-stone">(1 288)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('property/for/rent')}}">Bolig til leie <span class="u-stone">(9 993)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('property/flat/wishes/rented')}}">Bolig ønskes leid <span class="u-stone">(714)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('commercial/property/for/sale/ads')}}">Næringseiendom til salgs <span class="u-stone">(600)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('commercial/property/for/rent/ads')}}">Næringseiendom til leie <span class="u-stone">(3 103)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('commercial/plots/ads')}}">Næringstomter <span class="u-stone">(125)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('business/for/sale/ads')}}">Bedrifter til salgs <span class="u-stone">(105)</span></a>
                            </li>
                        </ul>
                    </div>
                    <!--                ended row-->
                </div>
                <!--            ended col-->
                <div class="col-md-4 pr-5">
                    <h2 class="u-t4">Lagrede søk</h2>
                    <p class="u-d1"><a href="#">Logg inn</a> for å vise dine lagrede søk</p>

                    <h2 class="u-t4">Siste søk</h2>
                    <p class="u-d1"><a href="#">Logg inn</a> for å vise dine siste søk her</p>
                    <!--                <a href="#" class="d-block mt-2 mb-2 u-d1">Bolig til salgs</a>-->
                    <!--                <a href="#" class="d-block mt-2 mb-2 u-d1">Antikviteter og kunst, Torget</a>-->
                    <!--                <a href="#" class="d-block mt-2 mb-2 u-d1">Næringstomter</a>-->
                    <!--                <a href="#" class="d-block mt-2 mb-2 u-d1 font-weight-bold">Tøm lista</a>-->
                </div>
                <!--            ended col-->
            </div>
            <!--        ended row-->
            <div class="row mt-5 home-grid">
                <div class="col-md-12">
                    <h2 class="u-t3 mb-4">Anbefalinger til deg</h2>
                </div>
                <?php
                for ($i = 0; $i < 6; $i++):
                    ?>
                    <div class="col-md-4 col-sm-6">
                        <a href="#" class="grid-box-ancor">
                            <div class="home-grid-box">
                                <div href="#" class="favorite-icon-outer">
                                    <div class="favorite-icon fa fa-heart"></div>
                                </div>
                                
                                <img src="{{asset('public/images/home-grid-box')}}<?php echo $i + 1; ?>.jpg"
                                     class="img-fluid product-img" alt="">
                                <div class="product-total-price">Totalpris: SEK 2011 111 KR</div>
                                <div class="product-price"><span class="fa fa-home"></span> 1 120 000 KR</div>
                            </div>
                            <p class="product-location text-muted mb-0 mt-2 u-d1">Kristiansand S</p>
                            <p class="product-title u-t4">Vennesla/Moseidmoen -2- Roms leilighe...</p>
                        </a>
                    </div>

                <?php endfor; ?>
            </div>
            <!--        ended row-->
        </div>
        <!--    ended container-->
        <div class="right-ad pull-right">
            <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
        </div>
    </main>
    <!--ended main wrapper-->
    @endsection