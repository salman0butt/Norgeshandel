<style>
.cgrid .trailing-border img {
    min-height: 302px !important;
}
.cgrid .add-to-fav {
    top: 55px !important;
}
.cgrid .location {
    top: -10px !important;
    left: 7px;
}
.detail {
    width:100% !important;
}
</style>
<div class="left-ad float-left">
    <img src="{{asset('public/images/left-ad.png')}}" class="img-fluid" alt="">
</div>
<div class="dme-container pl-3 pr-3">
    <div class="row top-ad">
        <img src="{{asset('public/images/top-ad.png')}}" class="img-fluid m-auto" alt="">
    </div>
    <div class="row mt-4">
        <div class="col-md-12 bg-maroon-lighter pt-2 mb-3" style="">
            <h2 class="u-t2 p-2">&nbsp; Næringseiendom til leie</h2>
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
                <a href="#" class="dme-btn-rounded-back-only"><i class="fa fa-map-marker"></i> <span class="">Vis på kart</span></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="">
                <label for="sort-by" class="mb-1">Sortér på</label>
                <select name="sort-by" id="sort_by" class="dme-form-control">
                    <option @if(isset($sort) && $sort=='0') selected @endif value="0">Mest relevant</option>
                    <option @if(isset($sort) && $sort=='1') selected @endif value="1">Publisert</option>
                    <option @if(isset($sort) && $sort=='sqm-low-high') selected @endif value="sqm-low-high">square meter low-high</option>
                    <option @if(isset($sort) && $sort=='sqm-high-low') selected @endif value="sqm-high-low">square meter high-low</option>
                    <option @if(isset($sort) && $sort=='99') selected @endif value="99">Nærmest</option>
                </select>
            </div>
        </div>
    </div>
    {{-- <div style="display: block;margin: 0 auto; text-align:center;">
        <div id="imageLoader" style="display:none;margin-top:15%; padding-bottom: 15%">
            <img src="{{ asset('public\spinner.gif') }}" alt="spinner" id="imageLoader">
        </div>
    </div> --}}

    <div class="row pagination_data">
        <div class="col-md-12 outer-div">
            <div class="inner-div">
                {{$add_array->links()}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="<?php
            echo $col === 'grid' ? 'row' : '' ?>">

                @foreach ($add_array as $key => $value)

                    <?php

                    $property_commercial_property_for_rent = App\CommercialPropertyForRent::find($value->id);
                    $name = $property_commercial_property_for_rent->ad->company_gallery->first();
                    if (!empty($name)) {
                        $name = $property_commercial_property_for_rent->ad->company_gallery->first()->name_unique;
                        $path = \App\Helpers\common::getMediaPath($property_commercial_property_for_rent);
                        $full_path = $path . "" . $name;
                    } else {
                        $full_path = "";
                    }

                    ?>

                    <div
                        class="<?php echo $col === 'grid' ? 'col-sm-4 pr-0' : '' ?> <?php echo $col === 'grid' ? 'cgrid' : 'clist' ?>" style="position:relative">
                        <a href="{{url('/', $property_commercial_property_for_rent->ad->id)}}"
                           class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                            <div class="image-section <?php echo $col === 'grid' ? 'col-sm-12' : 'col-sm-4' ?>  p-2">
                                <div class="trailing-border box-image" style="background-image: url('@if(!empty($full_path)){{$full_path}}@else{{asset('public/images/placeholder.png')}}@endif');height: 174.93px; width:100%">
{{--                                    <img src="@if(!empty($full_path)){{$full_path}}@else{{asset('public/images/placeholder.png')}}@endif"--}}
{{--                                        alt="" class="img-fluid radius-8" style="height: 174.93px; width:100%">--}}
                                    @if($property_commercial_property_for_rent->ad && $property_commercial_property_for_rent->ad->status == 'sold' && $property_commercial_property_for_rent->ad->sold_at)
                                        <span class="badge badge-success" style="position: absolute;top: 16px;left: 16px;">UTLEID</span>
                                    @endif
                                </div>
                            </div>
                            <div class="detailed-section <?php echo $col === 'grid' ? 'col-sm-12' : 'col-sm-8' ?> p-2">
                                {{--<div class="week-status u-t5 text-muted" style="">Betalt plassering</div>--}}
                                {{-- <div class="add-to-fav"><span class="fa fa-heart text-muted"></span></div> --}}
                                <div class="{{$col=='grid'?'location':'text-left'}} u-t5 text-muted mt-2">
                                    @if($property_commercial_property_for_rent->street_address)
                                        <span title="{{$property_commercial_property_for_rent->street_address}}">{{Str::limit($property_commercial_property_for_rent->street_address,25)}},</span>
                                    @endif
                                    <span>{{$property_commercial_property_for_rent->zip_city ? Str::ucfirst(Str::lower($property_commercial_property_for_rent->zip_city)) : ''}}</span>
                                </div>
                                <div class="title color-grey mt-1">{{(Request()->get('view') && Request()->get('view') == 'grid') ? Str::limit($property_commercial_property_for_rent->heading,35) : $property_commercial_property_for_rent->heading}}</div>
                                <div class="mt-2">
                                    <div
                                        class="area font-weight-bold float-left color-grey">{{$property_commercial_property_for_rent->gross_area_from}}
                                        - {{$property_commercial_property_for_rent -> gross_area_to}} m²
                                    </div>
                                    <div class="clearfix"></div>
                                    @if($property_commercial_property_for_rent->use_area)
                                        <div class="area font-weight-bold float-left color-grey">{{$property_commercial_property_for_rent->use_area}}
                                            m²
                                        </div>
                                    @endif
                                    @if($property_commercial_property_for_rent->rent_per_meter_per_year)
                                        <div
                                            class="price font-weight-bold float-right color-grey">{{number_format($property_commercial_property_for_rent->rent_per_meter_per_year,0,""," ")}}
                                            kr
                                        </div>
                                    @endif
                                </div>
                                <br>
                                {{--<div class="detail u-t5 mt-3 float-left text-muted">Private--}}
                                    {{--<br>Kontor--}}
                                {{--</div>--}}
                                {{--<div class="dealer-logo float-right mt-3"><img--}}
{{--                                        src="{{asset('public/images/businesssale-logo.jpg')}}" alt="" class="img-fluid">--}}
                                {{--</div>--}}
                            </div>
                        </a>
                        <div>
                          @php $ad = $property_commercial_property_for_rent->ad;  @endphp
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
<div class="right-ad pull-right">
    <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
</div>
<script>
  $( document ).ready(function() {

        var urlParams = new URLSearchParams(location.search);
        $('#save_search').submit(function () {
            var param = urlParams;
            param.delete('page');
            $('#filter').val("property/commercial-property-for-rent/search?" + param.toString());
        });
   });
</script>
