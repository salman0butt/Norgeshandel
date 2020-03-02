<div class="left-ad float-left">
    <img src="{{asset('public/images/left-ad.png')}}" class="img-fluid" alt="">
</div>
<div class="dme-container pl-3 pr-3">
    <div class="row top-ad">
        <img src="{{asset('public/images/top-ad.png')}}" class="img-fluid m-auto" alt="">
    </div>
    <div class="row mt-4">
        <div class="col-md-12 bg-maroon-lighter pt-2 mb-3" style="">
            <h2 class="u-t2 p-2">&nbsp; Næringstomter</h2>
        </div>
        <div class="col-md-12">
            <div class="hits fa-pull-right"><span class="font-weight-bold">36 331</span> treff på <span
                    class="font-weight-bold">21 190 </span>annonser
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-4 pt-4">
            <!--                    <button class="dme-btn-outlined-blue">Lagre søk</button>-->
        </div>
        <div class="col-md-4 pt-4">
            <div class="pt-3 float-left" style="min-width: 53px;">
                <a href="?<?php echo $col === 'grid' ? 'list' : 'grid' ?>" class="dme-btn-rounded-back-only"><i
                        class="<?php echo $col === 'grid' ? 'fa fa-list' : 'fa fa-th' ?>"></i></a>
            </div>
            <div class="pt-3 float-left">
                <a href="#" class="dme-btn-rounded-back-only"><i class="fa fa-map-marker"></i> <span class="">Vis på kart</span></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="">
                <label for="sort-by" class="mb-1">Sortér på</label>
                <select name="sort-by" id="sort_by" class="dme-form-control">
                    <option value="most-relevant">Mest relevant</option>
                    <option value="published" selected="">Publisert</option>
                    <option value="priced-low-high">Pris lav-høy</option>
                    <option value="priced-high-low">Pri høy-lav</option>
                    <option value="area_low_high">Areal lav-høy</option>
                    <option value="area_high_low">Areal høy-lav</option>
                    <option value="nearest">Nærmest</option>
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
            <div class="inner-div">
                {{$add_array->links()}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="<?php
            echo $col === 'grid' ? 'row' : '' ?>">
                @foreach ($add_array as $key => $value)
                    <?php
                    $commercial_plot = App\CommercialPlot::find($value->id);
                    $name = $commercial_plot->ad->company_gallery;
                    if (!$name->isEmpty()) {
                        $name = $commercial_plot->ad->company_gallery->first()->name_unique;
                        $path = \App\Helpers\common::getMediaPath($commercial_plot);
                        $full_path = $path . "" . $name;
                    } else {
                        $full_path = "";
                    }
                    ?>

                    <div
                        class="<?php echo $col === 'grid' ? 'col-sm-4 pr-0' : '' ?> <?php echo $col === 'grid' ? 'cgrid' : 'clist' ?>" style="position:relative">
                        <a href="{{url('/commercial/plots/ads/description', $value->id)}}"
                           class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                            <div class="image-section <?php echo $col === 'grid' ? 'col-sm-12' : 'col-sm-4' ?>  p-2">
                                <div class="trailing-border">
                                    <img
                                        src="@if(!empty($full_path)){{$full_path}}@else{{asset('public/images/placeholder.png')}}@endif"
                                        alt="" class="img-fluid radius-8" style="min-height:207px;width:100%;">
                                </div>
                            </div>
                            <div class="detailed-section <?php echo $col === 'grid' ? 'col-sm-12' : 'col-sm-8' ?> p-2">
                                <div class="week-status u-t5 text-muted"
                                     style="">{{$commercial_plot->street_address}}</div>
                                {{-- <div class="add-to-fav"><span class="fa fa-heart text-muted"></span></div> --}}
                                <div class="u-t5 text-muted mt-2">Christian Krohgs gate 16, 0186 Oslo</div>
                                <div class="title color-grey">{{$commercial_plot->headline}}</div>
                                <div class="mt-2">
                                    <div
                                        class="area font-weight-bold float-left color-grey">{{$commercial_plot->plot_size}}
                                        m²
                                    </div>
                                    <div
                                        class="price font-weight-bold float-right color-grey">{{$commercial_plot->asking_price}}
                                        kr
                                    </div>
                                </div>
                                <br>
                                <div class="detail u-t5 mt-3 float-left text-muted">Innlandet Næringsmegling AS</div>
                                <div class="dealer-logo float-right mt-3"><img
                                        src="{{asset('public/images/dealer-logo.png')}} " alt="" class="img-fluid">
                                </div>
                            </div>
                        </a>
                        <div>
                          @php $ad = $commercial_plot->ad;  @endphp
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
</div>
<!--    ended container-->
<div class="right-ad pull-right">
    <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
</div>
