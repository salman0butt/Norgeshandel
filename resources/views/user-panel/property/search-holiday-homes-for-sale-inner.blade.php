<div class="left-ad float-left">
    <img src="{{asset('public/images/left-ad.png')}}" class="img-fluid" alt="">
</div>
<div class="dme-container pl-3 pr-3">
    <div class="row top-ad">
        <img src="{{asset('public/images/top-ad.png')}}" class="img-fluid m-auto" alt="">
    </div>
    <div class="row mt-4">
        <div class="col-md-12 bg-maroon-lighter pt-2 mb-3" style="">
            <h2 class="u-t2 p-2">&nbsp; Fritidsbolig til salgs</h2>
        </div>
        <div class="col-md-12">
            <div class="hits fa-pull-right"><span class="font-weight-bold">36 331</span> treff på <span
                    class="font-weight-bold">21 190 </span>annonser
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
                <a href="#" class="dme-btn-rounded-back-only"><i class="fa fa-map-marker"></i> <span class="">Vis på kart</span></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="">
                <label for="sort-by" class="mb-1">Sortér på</label>
                <select name="sort-by" id="sort_by" class="dme-form-control">

                    <option @if(isset($sort) && $sort=='most-relevant') selected @endif value="most-relevant">Mest relevant</option>
                    <option @if(isset($sort) && $sort=='published') selected @endif value="published">Publisert</option>
                    <option @if(isset($sort) && $sort=='priced-low-high') selected @endif value="priced-low-high">Prisant lav-høy</option>
                    <option @if(isset($sort) && $sort=='priced-high-low') selected @endif value="priced-high-low">Prisant høy-lav</option>
                    <option @if(isset($sort) && $sort=='housing_area_low_high') selected @endif value="housing_area_low_high">Boa lav-høy</option>
                    <option @if(isset($sort) && $sort=='housing_area_high_low') selected @endif value="housing_area_high_low">Boa høy-lav</option>
                    <option @if(isset($sort) && $sort=='nearest') selected @endif value="nearest">Nærmest</option>

                </select>
            </div>
        </div>
    </div>
    <div style="display: block;margin: 0 auto; text-align:center;">
        <div id="imageLoader" style="display:none;margin-top:15%; padding-bottom: 15%">
            <img src="{{ asset('public\spinner.gif') }}" alt="spinner" id="imageLoader">
        </div>
    </div>
    <div class="row pagination_data">
        <div class="col-md-12 outer-div">
            <div class="inner-div">{{ $add_array->links() }}</div>
        </div>
        <div class="col-md-12" id="order_specific_result">
            <div class="<?php
            echo $col === 'grid' ? 'row' : '' ?>">

                @foreach ($add_array as $key => $value)

                    <?php

                    $property_holiday_home_for_sale = App\PropertyHolidaysHomesForSale::find($value->id);
                    $name = $property_holiday_home_for_sale->ad->company_gallery->first();
                    if (!empty($name)) {
                        $name = $property_holiday_home_for_sale->ad->company_gallery->first()->name_unique;
                        $path = \App\Helpers\common::getMediaPath($property_holiday_home_for_sale);
                        $full_path = $path . "" . $name;
                    } else {
                        $full_path = "";
                    }

                    ?>

                    <div
                        class="<?php echo $col === 'grid' ? 'col-sm-4 pr-0' : '' ?> <?php echo $col === 'grid' ? 'cgrid' : 'clist' ?>" style="position:relative">
                        <a href="{{url('/holiday/home/for/sale/description', $value->id)}}"
                           class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                            <div class="image-section <?php echo $col === 'grid' ? 'col-sm-12' : 'col-sm-4' ?>  p-2">

                                <div class="trailing-border">
                                    <img
                                        src="@if(!empty($full_path)){{$full_path}}@else{{asset('public/images/placeholder.png')}}@endif"
                                        alt="" class="img-fluid radius-8"
                                        style="min-height:207px;max-height:207px;width:100%;">
                                </div>
                            </div>
                            <div
                                class="detailed-section <?php echo $col === 'grid' ? 'col-sm-12' : 'col-sm-8' ?> p-2">
                                <div class="u-t5 text-muted" style=""></div>
                                {{-- <div class="add-to-fav"><span class="fa fa-heart text-muted"></span></div> --}}
                                <div
                                    class="location u-t5 text-muted mt-2">{{ $property_holiday_home_for_sale -> street_address}}</div>
                                <div
                                    class="title color-grey">{{ $property_holiday_home_for_sale -> ad_headline}}</div>
                                <div class="mt-2">
                                    <div
                                        class="area font-weight-bold float-left color-grey">{{ $property_holiday_home_for_sale ->  primary_room }}
                                        m²
                                    </div>
                                    <div
                                        class="price font-weight-bold float-right color-grey"> {{  $property_holiday_home_for_sale ->  asking_price  }}
                                        kr
                                    </div>
                                </div>
                                <br>
                                <div
                                    class="loca u-t5 text-muted">{{  $property_holiday_home_for_sale ->  local_area_name  }}</div>
                                <div class="loca u-t5 text-muted">
                                    <span>TotalPris:</span><span>{{  $property_holiday_home_for_sale ->  total_price  }}</span>
                                </div>
                                <div class="loca u-t5 text-muted">
                                    <span>{{  $property_holiday_home_for_sale ->  ownership_type  }}</span> •
                                    <span>{{  $property_holiday_home_for_sale ->  property_type  }}</span></div>
                                <div class="dealer-logo float-right mt-3"><img
                                        src="{{asset('public/images/dealer-logo.png')}} " alt=""
                                        class="img-fluid"></div>

                            </div>
                        </a>
                        <div>
                          @php $ad = $property_holiday_home_for_sale->ad;  @endphp
                          @include('user-panel.partials.fav-heart-button', compact('ad'))
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
        <div class="col-md-12 outer-div">
            <div class="inner-div">{{ $add_array->links() }}</div>
        </div>
    </div>
    <!--    ended container-->
    <div class="right-ad pull-right">
        <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
    </div>
    <script>
            var wrapper = document.getElementById('dme-wrapper');
            if (wrapper == null){
                location.reload();
            }
    </script>
</div>
<script>
   $( document ).ready(function() {
        var urlParams = new URLSearchParams(location.search);
        $('#save_search').submit(function () {
            var param = urlParams;
            param.delete('page');
            $('#filter').val("property/holiday-homes-for-sale/search?" + param.toString());
        });
   });

</script>
