@extends('layouts.landingSite')
<style>
  ul {
       list-style: none;
        padding-left: 5px !important;
    }
    .pagination {
        float:right;
        margin-top:10px;
        margin-bottom:10px;
    }
    .clear-fix {
        clear: both;
    }
</style>
@section('page_content')
<main class="dme-wrapper">
        @php $banner_ad_category = 'real-estate-main'; @endphp
        <div class="left-ad float-left" id="left_banner_ad">
            @include('user-panel.banner-ads.left-banner')
        </div>
        <div class="dme-container pl-3 pr-3">
            <div class="row top-ad" id="top_banner_ad">
                @include('user-panel.banner-ads.top-banner')
            </div>
            <div class="row mt-4">
                <div class="col-md-12 bg-maroon-lighter pt-2 mb-3" style="">
                    <img src="{{asset('public/images/Jobb_ikon_maroon.svg')}}" style="max-width: 50px;" class="pt-2 pb-2 float-left">
                    <h2 class="u-t2 p-2">&nbsp; Eiendom</h2>
                </div>
                <?php $date = Date('y-m-d',strtotime('-7 days')); ?>
                <div class="col-md-8">
                    <div class="row">
                        <ul class="product-sub-cat-list pl-3" id="property-category">
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('property/property-for-sale/search')}}">Bolig til salgs <span class="u-stone">
                                        (<?php echo \App\Models\Ad::where('ad_type','property_for_sale')->where(function ($query) use ($date){
                                            $query->where('status', 'published')
                                                ->orwhereDate('sold_at','>',$date);
                                        })->where('visibility', 1)->count();?>)</span></a>
                            </li>
                            <!-- <li class="dme-btn-outlined-blue" style="">
                                <a href="new-buildings.php?grid">Nye boliger <span class="u-stone">(19 416)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="plots.php?grid">Tomter <span class="u-stone">(1 575)</span></a>
                            </li> -->
                            <li class="dme-btn-outlined-blue" style="">
                                <a href=" {{url('property/holiday-homes-for-sale/search')}}">Fritidsbolig til salgs <span class="u-stone">
                                        (<?php echo \App\Models\Ad::where('ad_type','property_holiday_home_for_sale')->where(function ($query) use ($date){
                                            $query->where('status', 'published')
                                                ->orwhereDate('sold_at','>',$date);
                                        })->where('visibility', 1)->count();// echo App\PropertyHolidaysHomesForSale::get()->count(); ?>)</span></a>
                            </li>
                            <!-- <li class="dme-btn-outlined-blue" style="">
                                <a href="leisureplots.php?grid">Fritidstomter <span class="u-stone"></span></a>
                            </li> -->
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('property/property-for-rent/search')}}">Bolig til leie <span class="u-stone">
                                        (<?php echo \App\Models\Ad::where('ad_type','property_for_rent')->where(function ($query) use ($date){
                                            $query->where('status', 'published')
                                                ->orwhereDate('sold_at','>',$date);
                                        })->where('visibility', 1)->count();// echo App\PropertyForRent::get()->count(); ?>)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('property/flat-wishes-rented/search')}}">Bolig ønskes leid <span class="u-stone">
                                        (<?php echo \App\Models\Ad::where('ad_type','property_flat_wishes_rented')->where(function ($query) use ($date){
                                            $query->where('status', 'published')
                                                ->orwhereDate('sold_at','>',$date);
                                        })->where('visibility', 1)->count();// echo App\FlatWishesRented::get()->count(); ?>)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('property/commercial-property-for-sale/search')}}">Næringseiendom til salgs <span class="u-stone">
                                        (<?php echo \App\Models\Ad::where('ad_type','property_commercial_for_sale')->where(function ($query) use ($date){
                                            $query->where('status', 'published')
                                                ->orwhereDate('sold_at','>',$date);
                                        })->where('visibility', 1)->count(); // echo App\CommercialPropertyForSale::get()->count(); ?>)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('property/commercial-property-for-rent/search')}}">Næringseiendom til leie <span class="u-stone">
                                        (<?php echo \App\Models\Ad::where('ad_type','property_commercial_for_rent')->where(function ($query) use ($date){
                                            $query->where('status', 'published')
                                                ->orwhereDate('sold_at','>',$date);
                                        })->where('visibility', 1)->count(); //echo App\CommercialPropertyForRent::get()->count(); ?>)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('property/commercial-plots/search')}}">Næringstomter <span class="u-stone">
                                        (<?php echo \App\Models\Ad::where('ad_type','property_commercial_plots')->where(function ($query) use ($date){
                                            $query->where('status', 'published')
                                                ->orwhereDate('sold_at','>',$date);
                                        })->where('visibility', 1)->count();// echo App\CommercialPlot::get()->count(); ?>)</span></a>
                            </li>
                            <li class="dme-btn-outlined-blue" style="">
                                <a href="{{url('property/business-for-sale/search')}}">Bedrifter til salgs <span class="u-stone">
                                        (<?php echo \App\Models\Ad::where('ad_type','property_business_for_sale')->where(function ($query) use ($date){
                                            $query->where('status', 'published')
                                                ->orwhereDate('sold_at','>',$date);
                                        })->where('visibility', 1)->count(); //echo App\BusinessForSale::get()->count(); ?>)</span></a>
                            </li>
                        </ul>
                    </div>
                    <!--                ended row-->
                </div>
                <!--            ended col-->
                <div class="col-md-4 pr-5 pt-2 bg-maroon-lighter maroon-box radius-8" id="box-searches">
                    @include('user-panel.partials.searches-history')
                </div>
                <!--            ended col-->
            </div>
        
            <!--        ended row-->
                <div class="col-md-12">
                        <h2 class="u-t3 mt-2" id="cat-title">Anbefalinger til deg</h2>
                    </div>
            <div class="row mt-5 home-grid">
                @if($ads && is_countable($ads) && count($ads)>0)
    
                    @foreach($ads as $ad)
                        @include('user-panel.partials.templates.propert-sequare')
                    @endforeach
                @else
                    <div class="col-md-6 offset-md-3 alert alert-warning">Ingen annonser funnet!</div>
                @endif
            </div>
            <div class="pagination">
                {{ $ads->links() }}
            </div>
            <div class="clear-fix"></div>
            <!--        ended row-->
        </div>
        <!--    ended container-->
       <div class="right-ad pull-right" id="right_banner_ad">
            @include('user-panel.banner-ads.right-banner')
        </div>
    </main>
    <!--ended main wrapper-->
    @endsection
