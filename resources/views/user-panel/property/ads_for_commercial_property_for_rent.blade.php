@extends('layouts.landingSite')
@section('page_content')
    
    <?php 
        
        $col='list';
        if(isset($_GET)){
            if(isset($_GET['grid'])){
                $col = 'grid';
        }}

    ?>

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
                    <h2 class="u-t2 p-2">&nbsp; Næringseiendom til leie</h2>
                </div>
                <div class="col-md-12">
                    <div class="hits fa-pull-right"><span class="font-weight-bold">36 331</span> treff på <span class="font-weight-bold">21 190 </span>annonser</div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-4 pt-4">
                    <!--                    <button class="dme-btn-outlined-blue">Lagre søk</button>-->
                </div>
                <div class="col-md-4 pt-4">
                    <div class="pt-3 float-left" style="min-width: 53px;">
                        <a href="?<?php echo $col==='grid'?'list':'grid' ?>" class="dme-btn-rounded-back-only"><i class="<?php echo $col==='grid'?'fa fa-list':'fa fa-th' ?>"></i></a>
                    </div>
                    <div class="pt-3 float-left">
                        <a href="#" class="dme-btn-rounded-back-only"><i class="fa fa-map-marker"></i> <span class="">Vis på kart</span></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="">
                        <label for="sort-by" class="mb-1">Sortér på</label>
                        <select name="sort-by" id="sort_by" class="dme-form-control">
                            <option value="0">Mest relevant</option>
                            <option value="1" selected>Publisert</option>
                            <option value="sqm-low-high">square meter low-high</option>
                            <option value="sqm-high-low">square meter high-low</option>
                            <option value="99">Nærmest</option>
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
                    echo $col==='grid'?'row':'' ?>">
                      
                        @foreach ($add_array as $key => $value)      

                            <?php
                                    
                                    $property_commercial_property_for_rent = App\CommercialPropertyForRent::find($value->id);
                                    $name       = $property_commercial_property_for_rent->media->first();
                                    if(!empty($name))
                                    {
                                        $name = $property_commercial_property_for_rent->media->first()->name_unique;
                                        $path       = \App\Helpers\common::getMediaPath($property_commercial_property_for_rent);
                                        $full_path  = $path."".$name; 
                                    }
                                    else
                                    {
                                        $full_path  = "";
                                    }
                                    
                            ?>

                            <div class="<?php echo $col==='grid'?'col-sm-4 pr-0':'' ?> <?php echo $col==='grid'?'cgrid':'clist' ?>">
                                <a href="{{url('/commercial/property/for/rent/description', $value->id)}}" class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                                    <div class="image-section <?php echo $col==='grid'?'col-sm-12':'col-sm-4' ?>  p-2">
                                        <div class="trailing-border">
                                            <img src="{{$full_path}}" alt="" class="img-fluid radius-8">
                                        </div>
                                    </div>
                                    <div class="detailed-section <?php echo $col==='grid'?'col-sm-12':'col-sm-8' ?> p-2">
                                                                                <div class="week-status u-t5 text-muted" style="">Betalt plassering</div>
                                        <div class="add-to-fav"><span class="fa fa-heart text-muted"></span></div>
                                        <div class="location u-t5 text-muted mt-2">{{$property_commercial_property_for_rent->street_address}}</div>
                                        <div class="title color-grey">{{$property_commercial_property_for_rent->heading}}</div>
                                        <div class="mt-2">
                                            <div class="area font-weight-bold float-left color-grey">{{$property_commercial_property_for_rent->gross_area_from}} - {{$property_commercial_property_for_rent -> gross_area_to}} m²</div></br>
                                            <div class="area font-weight-bold float-left color-grey">{{$property_commercial_property_for_rent->use_area}} m²</div>
                                            <div class="price font-weight-bold float-right color-grey">{{$property_commercial_property_for_rent->rent_per_meter_per_year}} kr</div>
                                        </div>
                                        <br>
                                        <div class="detail u-t5 mt-3 float-left text-muted">Private
                                            <br>Kontor</div>
                                        <div class="dealer-logo float-right mt-3" ><img src="{{asset('public/images/businesssale-logo.jpg')}}" alt="" class="img-fluid"></div>
                                    </div>
                                </a>
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
    </main>

    <script>
            $(document).ready(function(){
                     //spinner start here
                  $(document).ajaxStart(function(){
                        $("#imageLoader").css("display", "block");
                        $(".pagination_data").css("display", "none");
                        });

                        $(document).ajaxComplete(function(){
                        $("#imageLoader").css("display", "none");
                        $(".pagination_data").css("display", "block");
                    });
                //spinner ends here
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).on('change', '#sort_by', function() {
                    
                    var url  = '{{url('property/commercial/for/rent/sorted/ad')}}';
                    var data = $(this).val();

                    var stylings = window.location.href.split('?', 2)[1];
                    if (typeof stylings == 'undefined')
                    {
                        stylings = "";
                    }


                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {sending:data,stylings:stylings},
                        dataType: "json",
                        success: function(data){
                           $(".pagination_data").html(data['success']);
                        }
                    });
                });

                //pagination
                $(document).on('click', '.pagination a',function(event)
                {
                    event.preventDefault();
                    $('li').removeClass('active');
                    $(this).parent('li').addClass('active');
        
                    var myurl = $(this).attr('href');
                    var page=$(this).attr('href').split('page=')[1];
                   
                    var sorting_value = $("#sort_by").val();
                    var url = '{{url('commercial/property/for/rent/ads')}}';
                    var stylings = window.location.href.split('?', 2)[1];
                    if (typeof stylings == 'undefined')
                    {
                        stylings = "";
                    }
                    getDataPagination(page,sorting_value,url,stylings);

                });


            });

    </script>  




@endsection