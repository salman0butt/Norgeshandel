<style>
.cgrid .trailing-border img {
    min-height: 302px !important;
}
/*.cgrid .add-to-fav {
    top: 55px !important;
}*/
.cgrid .location {
    top: -5px !important;
    left: 10px !important;
}
</style>
        @php $banner_ad_category = 'real-estate-sub'; @endphp
        <div class="left-ad float-left" id="left_banner_ad">
            @include('user-panel.banner-ads.left-banner')
        </div>
<div id="property_for_sale_inner_page" class="dme-container pl-3 pr-3">
        <div class="row top-ad" id="top_banner_ad">
            @include('user-panel.banner-ads.top-banner')
        </div>
    <div class="row mt-4">
        <div class="col-md-12 bg-maroon-lighter pt-2 mb-3" style="">
            <h2 class="u-t2 p-2">&nbsp; Bolig til salgs </h2>
        </div>
        <div class="col-md-12">
            @include('common.partials.flash-messages')
            <div class="hits fa-pull-right"><span class="font-weight-bold">{{$clicks}}</span> treff på <span
                    class="font-weight-bold">{{$add_array->total()}}</span> annonser
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-4 pt-4" id="mobile-view-filter-left">
              @include('user-panel.inner_saved_search')
        </div>
        <div class="col-md-4 pt-4" id="mobile-view-filter-right">
            <div class="pt-3 float-left" style="min-width: 53px;">
                @include('user-panel.partials.change-view-btn')
            </div>
            <div class="pt-3 float-left">
                <a href="{{ url('/map/property?property_type=property_for_sale') }}" class="dme-btn-rounded-back-only" target="_blank"><i class="fa fa-map-marker"></i> <span class="">Vis på kart</span></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="">
                <label for="sort_by" class="mb-1">Sortér på</label>
                <select name="sort-by" id="sort_by" class="dme-form-control">
                    <option value="most_relevant" @if(isset($sort) && $sort=="most_relevant" ) selected @endif>Mest relevant</option>
                    <option @if((isset($sort) && $sort=='published') || !isset($sort)) selected @endif value="published">Publisert</option>
                    <option @if(isset($sort) && $sort=='priced-low-high') selected @endif value="priced-low-high">Prisant lav-høy</option>
                    <option @if(isset($sort) && $sort=='priced-high-low') selected @endif value="priced-high-low">Prisant høy-lav</option>
                    <option @if(isset($sort) && $sort=='p-rom-area-low-high') selected @endif value="p-rom-area-low-high">P-ROM Areal lav-høy</option>
                    <option @if(isset($sort) && $sort=='p-rom-area-high-low') selected @endif value="p-rom-area-high-low">P-ROM Areal høy-lav</option>
                    <option @if(isset($sort) && $sort=='total-price-low-high') selected @endif value="total-price-low-high">Tot pris lav-høy</option>
                    <option @if(isset($sort) && $sort=='total-price-high-low') selected @endif value="total-price-high-low">Tot pris høy-lav</option>
                    <option @if(isset($sort) && $sort=='99') selected @endif value="99">Nærmest</option>
                </select>
            </div>
        </div>
    </div>
    <div style="display: block;margin: 0 auto; text-align:center;">
        {{-- <div id="imageLoader" style="display:none;margin-top:15%; padding-bottom: 15%">
            <img src="{{ asset('public\spinner.gif') }}" alt="spinner" id="imageLoader">
        </div> --}}
        <div class="row pagination_data">
            <div class="col-md-12 outer-div">
                <div class="inner-div">{{ $add_array->links() }}</div>
            </div>
            @if(count($add_array)<1)
                <div class="alert alert-warning col-md-6 offset-md-3">Ingen innlegg funnet!</div>
            @endif
            <div class="col-md-12">
                <div class="pl-0 pr-0 <?php
                echo $col === 'grid' ? 'row' : '' ?> order_specific_result" id="">
                    @foreach ($add_array as $key => $value)
                        <?php
                        $property_for_sale = App\PropertyForSale::find($value->id);
                        if ($property_for_sale):
                        $property_for_sale_collection = $property_for_sale->ad->company_gallery->first();
                        if (!empty($property_for_sale_collection)) {
                            $path = \App\Helpers\common::getMediaPath($property_for_sale_collection);
                            $full_path_photos = $path;
                        } else {
                            $full_path_photos = "";
                        }
                        $image_path = !empty($full_path_photos)? $full_path_photos : asset('public/images/placeholder.png');
                        ?>
                        <div class="product-list-mobile <?php echo $col === 'grid' ? 'col-sm-6 col-md-4 col-12 pr-0' : '' ?> <?php echo $col === 'grid' ? 'cgrid' : 'clist' ?>" style="position: relative">
                            <a href="{{url('/', $property_for_sale->ad->id)}}"
                               class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                                <div
                                    class="image-section <?php echo $col === 'grid' ? 'col-sm-12' : 'col-xs-4 col-sm-4 col-md-4' ?>  p-2">
                                    <div class="trailing-border box-image"
                                         style="background-image: url('{{$image_path}}');height: 175px; width:100%"
                                    >
{{--                                        <img src="@if(!empty($full_path_photos)){{$full_path_photos}}@else{{asset('public/images/placeholder.png')}}@endif"--}}
{{--                                            alt="" class="img-fluid radius-8 w-100 list-h" style="height: 174.93px; width:100%">--}}
                                        @if($property_for_sale->ad && $property_for_sale->ad->status == 'sold' && $property_for_sale->ad->sold_at)
                                            <span class="badge badge-success" style="position: absolute;top: 16px;left: 16px;">SOLGT</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="detailed-section <?php echo $col === 'grid' ? 'col-sm-12' : 'col-xs-8 col-sm-8 col-md-8' ?> p-2">
                                    {{--<div class="week-status u-t5 text-muted" style="">Betalt plassering</div>--}}
                                    <div class="{{$col=='grid'?'location':'text-left'}} u-t5 text-muted mt-2">
                                        @if($property_for_sale->street_address)
                                            <span title="{{$property_for_sale->street_address}}">{{Str::limit($property_for_sale->street_address,25)}},</span>
                                        @endif
                                        <span>{{$property_for_sale->zip_city ? Str::ucfirst(Str::lower($property_for_sale->zip_city)) : ''}}</span>
                                    </div>

                                    <div class="title color-grey">{{(Request()->get('view') && Request()->get('view') == 'grid' ? Str::limit($property_for_sale->headline,35) :  $property_for_sale->headline) }}</div>
                                    <div class="mt-2">
                                        <div
                                            class="area font-weight-bold float-left color-grey">{{$property_for_sale->primary_room}}
                                            m²
                                        </div>
                                        <div
                                            class="price font-weight-bold float-right color-grey">{{$property_for_sale->asking_price ? number_format($property_for_sale->asking_price,0,""," ") : ''}}
                                            kr
                                        </div>
                                    </div>
                                    <br>

                                    <div class="detail u-t5 mt-3 float-left text-muted col-md-12 ttt">
                                        <p>
                                            <span class="tst pl-0"> {{$property_for_sale->tenure}} </span>
                                            <span class="tst"> {{$property_for_sale->property_type}} </span>
                                            <span style="padding-left:10px;"> {{$property_for_sale-> number_of_bedrooms}} </span>
                                            soverom
                                        </p>
                                    </div>
                                    @if($property_for_sale->ad->company_id && $property_for_sale->ad->company && $property_for_sale->ad->company->company_logo->first())
                                        <div class="dealer-logo float-right mt-3"><img src="{{\App\Helpers\common::getMediaPath($property_for_sale->ad->company->company_logo->first())}} " alt="" class="img-fluid"></div>
                                    @endif
                                    {{--<div class="dealer-logo float-right mt-3"><img src="{{asset('public/images/dealer-logo.png')}} " alt="" class="img-fluid"></div>--}}
                                </div>
                            </a>
                            <div>
                                @php $ad = $property_for_sale->ad;  @endphp
                                @include('user-panel.partials.fav-heart-button', compact('ad'))
                            </div>

                        </div>
                        <?php endif; ?>
                    @endforeach
                </div>
            </div>
            <div class="col-md-12 outer-div">
                <div class="inner-div">{{ $add_array->links() }}</div>
            </div>
        </div>
        <script>
            var wrapper = document.getElementById('dme-wrapper');
            if (wrapper == null){
               document.getElementById("left_banner_ad").style.display = "none";
               document.getElementById("property_for_sale_inner_page").style.display = "none";
                location.reload();
            }
        </script>
    </div>
    <!--    ended container-->
    <div class="right-ad pull-right" id="right_banner_ad">
        @include('user-panel.banner-ads.right-banner')
    </div>
</div>
<script>
   $( document ).ready(function() {
        var urlParams = new URLSearchParams(location.search);
        $('#save_search').submit(function () {
            var param = urlParams;
            param.delete('page');
            $('#filter').val("property/property-for-sale/search?" + param.toString());
        });
   });
</script>
