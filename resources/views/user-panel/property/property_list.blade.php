@extends('layouts.landingSite')
<style>
  ul {
            list-style: none;
            padding-left: 5px !important;
        }
</style>
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
                                <a href="{{url('property/property-for-sale/search')}}">Bolig til salgs <span class="u-stone">(<?php echo App\PropertyForSale::get()->count(); ?>)</span></a>
                            </li>
                            <!-- <li class="dme-btn-outlined-blue" style="">
                                <a href="new-buildings.php?grid">Nye boliger <span class="u-stone">(19 416)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="plots.php?grid">Tomter <span class="u-stone">(1 575)</span></a>
                            </li> -->
                            <li class="dme-btn-outlined-blue" style="">
                                <a href=" {{url('holiday/home/for/sale/ads')}}">Fritidsbolig til salgs <span class="u-stone">(<?php echo App\PropertyHolidaysHomesForSale::get()->count(); ?>)</span></a>
                            </li>
                            <!-- <li class="dme-btn-outlined-blue" style="">
                                <a href="leisureplots.php?grid">Fritidstomter <span class="u-stone"></span></a>
                            </li> -->
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('property/for/rent')}}">Bolig til leie <span class="u-stone">(<?php echo App\PropertyForRent::get()->count(); ?>)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('property/flat/wishes/rented')}}">Bolig ønskes leid <span class="u-stone">(<?php echo App\FlatWishesRented::get()->count(); ?>)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('commercial/property/for/sale/ads')}}">Næringseiendom til salgs <span class="u-stone">(<?php echo App\CommercialPropertyForSale::get()->count(); ?>)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('commercial/property/for/rent/ads')}}">Næringseiendom til leie <span class="u-stone">(<?php echo App\CommercialPropertyForRent::get()->count(); ?>)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('commercial/plots/ads')}}">Næringstomter <span class="u-stone">(<?php echo App\CommercialPlot::get()->count(); ?>)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('business/for/sale/ads')}}">Bedrifter til salgs <span class="u-stone">(<?php echo App\BusinessForSale::get()->count(); ?>)</span></a>
                            </li>
                        </ul>
                    </div>
                    <!--                ended row-->
                </div>
                <!--            ended col-->
                <div class="col-md-4 pr-5">
                    @include('user-panel.partials.searches-history')
                </div>
                <!--            ended col-->
            </div>
            <!--        ended row-->
            <div class="row mt-5 home-grid">
                @if($ads)
                    <div class="col-md-12">
                        <h2 class="u-t3 mb-4">Anbefalinger til deg</h2>
                    </div>
                    @foreach($ads as $ad)

                        @include('user-panel.partials.templates.propert-sequare')

                    @endforeach
                @endif
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
