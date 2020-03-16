<style>
.cgrid .trailing-border img {
    min-height: 302px !important;
}
.cgrid .add-to-fav {
    top: 55px !important;
}
.cgrid .location {
    top: -341px !important;
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
            <h2 class="u-t2 p-2">&nbsp; Bolig til salgs </h2>
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
                    <option @if(isset($sort) && $sort=='0') selected @endif value="0">Mest relevant</option>
                    <option @if(isset($sort) && $sort=='published') selected @endif value="published">Publisert</option>
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
        <div id="imageLoader" style="display:none;margin-top:15%; padding-bottom: 15%">
            <img src="{{ asset('public\spinner.gif') }}" alt="spinner" id="imageLoader">
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
                        $property_for_sale = App\PropertyForSale::find($value->id);
                        if ($property_for_sale):
                        $property_for_sale_collection = $property_for_sale->ad->company_gallery->first();
                        if (!empty($property_for_sale_collection)) {
                            $path = \App\Helpers\common::getMediaPath($property_for_sale);
                            $name = $property_for_sale_collection->name_unique;
                            $full_path_photos = $path . "" . $name;
                        } else {
                            $full_path_photos = "";
                        }
                        ?>
                        <div class="<?php echo $col === 'grid' ? 'col-sm-4 pr-0' : '' ?> <?php echo $col === 'grid' ? 'cgrid' : 'clist' ?>" style="position: relative">
                            <a href="{{url('/property/for/sale/description', $value->id)}}"
                               class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                                <div
                                    class="image-section <?php echo $col === 'grid' ? 'col-sm-12' : 'col-sm-4' ?>  p-2">
                                    <div class="trailing-border">
                                        <img
                                            src="@if(!empty($full_path_photos)){{$full_path_photos}}@else{{asset('public/images/placeholder.png')}}@endif"
                                            alt="" class="img-fluid radius-8 w-100 list-h" style="height: 174.93px; width:100%">
                                    </div>
                                </div>
                                <div class="detailed-section <?php echo $col === 'grid' ? 'col-sm-12' : 'col-sm-8' ?> p-2">
                                    {{--<div class="week-status u-t5 text-muted" style="">Betalt plassering</div>--}}
                                    @if($property_for_sale->street_address)
                                        <div class="{{$col=='grid'?'location':'text-left'}} u-t5 text-muted mt-2" title="{{$property_for_sale->street_address}}">
                                            {{Str::limit($property_for_sale->street_address,35)}}
{{--                                            <span class="search-property-db-zipcode">{{$property_for_sale->zip_code ? $property_for_sale->zip_code : ''}}</span>--}}
                                        </div>
                                    @endif
                                    <div class="title color-grey">{{$property_for_sale->headline}}</div>
                                    <div class="mt-2">
                                        <div
                                            class="area font-weight-bold float-left color-grey">{{$property_for_sale->primary_room}}
                                            m²
                                        </div>
                                        <div
                                            class="price font-weight-bold float-right color-grey">{{$property_for_sale->total_price}}
                                            kr
                                        </div>
                                    </div>
                                    <br>

                                    <div class="detail u-t5 mt-3 float-left text-muted col-md-12 ttt">
                                        <p>
                                            <span class="tst"> {{$property_for_sale->tenure}} </span>
                                            <span class="tst"> {{$property_for_sale->property_type}} </span>
                                            <span style="padding-left:10px;"> {{$property_for_sale-> number_of_bedrooms}} </span>
                                            soverom
                                        </p>
                                    </div>
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
                location.reload();
            }
        </script>
    </div>
    <!--    ended container-->
    <div class="right-ad pull-right">
        <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid">
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