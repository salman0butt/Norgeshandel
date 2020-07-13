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
            <h2 class="u-t2 p-2">&nbsp; Bolig ønskes leid </h2>
        </div>
        <div class="col-md-12">
            <div class="hits fa-pull-right"><span class="font-weight-bold">{{number_format($add_array->total(),0,""," ")}}</span> treff
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
                <a href="{{ url('/map/property?property_type=flat_wishes_rented') }}" class="dme-btn-rounded-back-only" target="_blank"><i class="fa fa-map-marker"></i> <span class="">Vis på kart</span></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="">
                <label for="sort-by" class="mb-1">Sortér på</label>
                <select name="sort-by" id="sort_by" class="dme-form-control">
                    <option value="most_relevant" @if(isset($sort) && $sort=="most_relevant" ) selected @endif>Mest relevant</option>
                    <option @if((isset($sort) && $sort=='published') || !isset($sort)) selected @endif value="published">Publisert</option>
                    <option @if(isset($sort) && $sort=='priced_low_high') selected @endif value="priced_low_high">Max leie lav-høy</option>
                    <option @if(isset($sort) && $sort=='priced_high_low') selected @endif value="priced_high_low">Max leie høy-lav</option>
                    <option @if(isset($sort) && $sort=='time_from') selected @endif value="time_from">Tidspunkt fra</option>
                    <option @if(isset($sort) && $sort=='99') selected @endif value="99">Nærmest</option>

                </select>
            </div>
        </div>
    </div>


    <div class="row pagination_data">
        <div class="col-md-12 outer-div">
            <div class="inner-div">{{ $add_array->links() }}</div>
        </div>
        @if(count($add_array)<1)
            <div class="alert alert-warning col-md-6 offset-md-3">Ingen innlegg funnet!</div>
        @endif
        <div class="col-md-12">
            <div class="<?php
            echo $col === 'grid' ? 'row' : '' ?> order_specific_result" id="">
                @foreach ($add_array as $key => $value)
                    <?php
                    $property_for_flat_wishes_rented = App\FlatWishesRented::find($value->id);
                    $name = $property_for_flat_wishes_rented->ad->company_gallery->first();
                    if ($name != null) {
                        $path = \App\Helpers\common::getMediaPath($name);
                        $full_path = $path;
                    } else {
                        $full_path = "";
                    }
                    ?>
                    <div
                        class="product-list-mobile <?php echo $col === 'grid' ? 'col-sm-4 pr-0' : '' ?> <?php echo $col === 'grid' ? 'cgrid' : 'clist' ?>" style="position:relative">
                        <a href="{{url('/', $property_for_flat_wishes_rented->ad->id)}}"
                           class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                            <div class="image-section <?php echo $col === 'grid' ? 'col-sm-12' : 'col-sm-4' ?>  p-2">
                                <div class="trailing-border box-image" style="background-image: url('@if(!empty($full_path)){{$full_path}}@else{{asset('public/images/placeholder.png')}}@endif'); height: 174.93px; width:100%">
{{--                                    <img src="@if(!empty($full_path)){{$full_path}}@else{{asset('public/images/placeholder.png')}}@endif"--}}
{{--                                        alt="" class="img-fluid radius-8" style="height: 174.93px; width:100%">--}}
                                    @if($property_for_flat_wishes_rented->ad && $property_for_flat_wishes_rented->ad->status == 'sold' && $property_for_flat_wishes_rented->ad->sold_at)
                                        <span class="badge badge-success" style="position: absolute;top: 16px;left: 16px;">UTLEID</span>
                                    @endif
                                </div>
                            </div>
                            <div class="detailed-section <?php echo $col === 'grid' ? 'col-sm-12' : 'col-sm-8' ?> p-2">

                                {{-- Request()->get('view') <div class="add-to-fav"><span class="fa fa-heart text-muted"></span></div> --}}
                                <div class="title color-grey">{{(Request()->get('view') && Request()->get('view') == 'grid') ? Str::limit($property_for_flat_wishes_rented->headline,35) : $property_for_flat_wishes_rented->headline}}</div>
                                @if($property_for_flat_wishes_rented->max_rent_per_month)
                                    <div class="mt-2">
{{--                                        @if($property_for_flat_wishes_rented->description)--}}
                                            {{--<div class="area float-left color-grey" title="{{$property_for_flat_wishes_rented->description}}">{{Str::limit($property_for_flat_wishes_rented->description,70)}}</div>--}}
                                        {{--@endif--}}
                                        @if($property_for_flat_wishes_rented->max_rent_per_month)
                                            <div class="price font-weight-bold float-right color-grey">{{number_format($property_for_flat_wishes_rented->max_rent_per_month,0,""," ")}} kr</div>
                                        @endif
                                    </div>
                                @endif
                                <div
                                    class="detail u-t5 mt-3 float-left text-muted">{{rtrim($property_for_flat_wishes_rented->property_type,",")}}</div>

                                @if($property_for_flat_wishes_rented->ad->company_id && $property_for_flat_wishes_rented->ad->company && $property_for_flat_wishes_rented->ad->company->company_logo->first())
                                    <div class="dealer-logo float-right mt-3"><img src="{{\App\Helpers\common::getMediaPath($property_for_flat_wishes_rented->ad->company->company_logo->first())}} " alt="" class="img-fluid"></div>
                                @endif
                                {{--<div class="dealer-logo float-right mt-3"><img src="assets/images/dealer-logo.png" alt="" class="img-fluid"></div>--}}
                            </div>
                        </a>
                        <div>
                          @php $ad = $property_for_flat_wishes_rented->ad;  @endphp
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
            $('#filter').val("property/flat-wishes-rented/search?" + param.toString());
        });
   });

</script>
