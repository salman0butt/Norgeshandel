<style>
.cgrid .trailing-border img {
    min-height: 302px !important;
}
.cgrid .add-to-fav {
    top: 55px !important;
}
.cgrid .location {
    top: -5px !important;
    left: 10px;
}
</style>
   @php $banner_ad_category = 'real-estate-sub'; @endphp
        <div class="left-ad float-left" id="left_banner_ad">
            @include('user-panel.banner-ads.left-banner')
        </div>
<div class="dme-container pl-3 pr-3">
     <div class="row top-ad" id="top_banner_ad">
            @include('user-panel.banner-ads.top-banner')
        </div>
    <div class="row mt-4">
        <div class="col-md-12 bg-maroon-lighter pt-2 mb-3" style="">
            <h2 class="u-t2 p-2">&nbsp; Bedrifter til salgs </h2>
        </div>
        <div class="col-md-12">
            <div class="hits fa-pull-right"><span class="font-weight-bold">{{number_format($add_array->total(),0,""," ")}}</span> treff
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-4 pt-4">
            @include('user-panel.inner_saved_search')
        </div>
        <div class="col-md-4 pt-4">
            <div class="pt-3 float-left" style="min-width: 53px;">
                @include('user-panel.partials.change-view-btn')
            </div>
            <div class="pt-3 float-left">
                <a href="{{ url('/map/property?property_type=Business_for_sale') }}" class="dme-btn-rounded-back-only" target="_blank"><i class="fa fa-map-marker"></i> <span class="">Vis på kart</span></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="">
                <label for="sort-by" class="mb-1">Sortér på</label>
                <select name="sort-by" id="sort_by" class="dme-form-control">
                    <option value="most_relevant" @if(isset($sort) && $sort=="most_relevant" ) selected @endif>Mest relevant</option>
                    <option @if((isset($sort) && $sort=='published') || !isset($sort)) selected @endif value="published">Publisert</option>
                    <option @if(isset($sort) && $sort=='priced-low-high') selected @endif value="priced-low-high">Pris lav-høy</option>
                    <option @if(isset($sort) && $sort=='priced-high-low') selected @endif value="priced-high-low">Pris høy-lav</option>
                    <option @if(isset($sort) && $sort=='99') selected @endif value="99">Nærmest</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row pagination_data">
        <div class="col-md-12 outer-div">
            <div class="inner-div">
                {{$add_array->links()}}
            </div>
        </div>
        @if(count($add_array)<1)
            <div class="alert alert-warning col-md-6 offset-md-3">Ingen innlegg funnet!</div>
        @endif
        <div class="col-md-12">
            <div class="<?php
            echo $col === 'grid' ? 'row' : '' ?> " id="">

                @foreach ($add_array as $key => $value)
                    <?php

                    $business_for_sale = App\BusinessForSale::find($value->id);
                    $name = $business_for_sale->ad->company_gallery->first();
                    if ($name != null) {
                        $path = \App\Helpers\common::getMediaPath($name);
                        $full_path = $path;
                    } else {
                        $full_path = "";
                    }

                    ?>

                    <div
                        class="<?php echo $col === 'grid' ? 'col-sm-4 pr-0' : '' ?> <?php echo $col === 'grid' ? 'cgrid' : 'clist' ?>" style="position:relative">
                        <a href="{{$business_for_sale->ad && $business_for_sale->ad->id ? url('/', $business_for_sale->ad->id) : ''}}"
                           class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                            <div class="image-section <?php echo $col === 'grid' ? 'col-sm-12' : 'col-sm-4' ?>  p-2">
                                <div class="trailing-border box-image" style="background-image: url('@if(!empty($full_path)){{$full_path}}@else{{asset('public/images/placeholder.png')}}@endif');height: 174.93px; width:100%">
{{--                                    <img src="@if(!empty($full_path)){{$full_path}}@else{{asset('public/images/placeholder.png')}}@endif"--}}
{{--                                        alt="" class="img-fluid radius-8" style="height: 174.93px; width:100%">--}}
                                    @if($business_for_sale->ad && $business_for_sale->ad->status == 'sold' && $business_for_sale->ad->sold_at)
                                        <span class="badge badge-success" style="position: absolute;top: 16px;left: 16px;">SOLGT</span>
                                    @endif
                                </div>
                            </div>
                            <div class="detailed-section <?php echo $col === 'grid' ? 'col-sm-12' : 'col-sm-8' ?> p-2">
                                <!-- <div class="week-status u-t5 stext-muted" style="">Strandvegen, 2380 Brumunddal</div>-->
                                <!--<div class="u-t5 text-muted" style="">&nbsp;</div>-->
                                <div class="{{$col=='grid'?'location':'text-left'}} u-t5 text-muted mt-2">
                                    @if($business_for_sale->street_address)
                                        <span title="{{$business_for_sale->street_address}}">{{Str::limit($business_for_sale->street_address,25)}},</span>
                                    @endif
                                    <span>{{$business_for_sale->zip_city ? Str::ucfirst(Str::lower($business_for_sale->zip_city)) : ''}}</span>
                                </div>
                                {{-- <div class="add-to-fav"><span class="fa fa-heart text-muted"></span></div> --}}
                                <div class="title color-grey">{{(Request()->get('view') && Request()->get('view') == 'grid') ? Str::limit($business_for_sale->headline,35) : $business_for_sale->headline}}</div>
                                @if($business_for_sale->price)
                                    <div class="mt-2">
                                        <div class="area font-weight-bold float-left color-grey">&nbsp;</div>
                                        <div class="price font-weight-bold float-right color-grey">{{number_format($business_for_sale->price    ,0,""," ")}} kr</div>
                                    </div>
                                    <br>
                                @endif
                                @if($business_for_sale->ad->company_id && $business_for_sale->ad->company && $business_for_sale->ad->company->company_logo->first())
                                    <div class="dealer-logo float-right mt-3"><img src="{{\App\Helpers\common::getMediaPath($business_for_sale->ad->company->company_logo->first())}} " alt="" class="img-fluid"></div>
                                @endif
                            </div>
                        </a>
                        <div>
                          @php $ad = $business_for_sale->ad;  @endphp
                          @include('user-panel.partials.fav-heart-button', compact('ad'))
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
        <div class="col-md-12 outer-div">
            <div class="inner-div">
                {{$add_array->links()}}
            </div>
        </div>
    </div>
    <script>
        var wrapper = document.getElementById('dme-wrapper');
        if (wrapper == null){
            location.reload();
        }
    </script>
</div>
<!--    ended container-->
 <div class="right-ad pull-right" id="right_banner_ad">
    @include('user-panel.banner-ads.right-banner')
</div>
<script>
   $( document ).ready(function() {
        var urlParams = new URLSearchParams(location.search);
        $('#save_search').submit(function () {
            var param = urlParams;
            param.delete('page');
            $('#filter').val("property/business-for-sale/search?" + param.toString());
        });
   });
</script>
