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
                    <h2 class="u-t2 p-2">&nbsp; Bedrifter til salgs </h2>
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
                            <option value="published" selected>Publisert</option>
                            <option value="priced-low-high">Pris lav-høy</option>
                            <option value="priced-high-low">Pris høy-lav</option>
                            <option value="99">Nærmest</option>
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
                <div class="col-md-12">
                    <div class="<?php
                    echo $col==='grid'?'row':'' ?> " id="">
                        
                        @foreach ($add_array as $key => $value)
                            <?php

                                $business_for_sale  = App\BusinessForSale::find($value->id);
                                $name               = $business_for_sale->media->first();
                                if($name != null)
                                {
                                    $name       =    $name->name_unique;
                                    $path       = \App\Helpers\common::getMediaPath($business_for_sale);
                                    $full_path  = $path."".$name; 
                                }
                                else
                                {
                                    $full_path  = "";
                                }

                            ?>
                    
                            <div class="<?php echo $col==='grid'?'col-sm-4 pr-0':'' ?>">
                                <a href="{{url('/business/for/sale/description', $value->id)}}" class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                                    <div class="image-section <?php echo $col==='grid'?'col-sm-12':'col-sm-4' ?>  p-2">
                                        <div class="trailing-border">
                                            <img src="{{$full_path}}" alt="" class="img-fluid radius-8">
                                        </div>
                                    </div>
                                    <div class="detailed-section <?php echo $col==='grid'?'col-sm-12':'col-sm-8' ?> p-2">
                                        <!-- <div class="week-status u-t5 stext-muted" style="">Strandvegen, 2380 Brumunddal</div>-->
                                        <!--<div class="u-t5 text-muted" style="">&nbsp;</div>-->
                                        <div class="location u-t5 text-muted mt-2">{{$business_for_sale->street_address}}</div>
                                        <div class="add-to-fav"><span class="fa fa-heart text-muted"></span></div>
                                        <div class="title color-grey">{{$business_for_sale->headline}}</div>
                                        <div class="mt-2">
                                            <div class="area font-weight-bold float-left color-grey">&nbsp;</div>
                                            <div class="price font-weight-bold float-right color-grey">{{$business_for_sale->price}} kr</div>
                                        </div>
                                        <br>
                                        <div class="detail u-t5 mt-3 float-left text-muted">Privat</div>
                                        <div class="dealer-logo float-right mt-3" ><img src="assets/images/businessplots-logo.png" alt="" class="img-fluid"></div>
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

                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).on('change', '#sort_by', function() {
                    
                    var url  = '{{url('business/for/sales/sorted/ad')}}';
                    var data = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {sending:data},
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
                    var url = '{{url('business/for/sale/ads')}}';
                    getDataPagination(page,sorting_value,url);
                });



            });
    </script>


@endsection