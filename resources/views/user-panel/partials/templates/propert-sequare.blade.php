<?php

    if(isset($ad))
    {
        if($ad->ad_type == 'property_for_rent')
        {
            $property = $ad->propertyForRent;
        }
        else if($ad->ad_type == 'property_for_sale')
        {
            $property = $ad->propertyForSale;
        }
        else if($ad->ad_type == 'property_holiday_home_for_sale')
        {
            $property = $ad->propertyHolydaysHomesForSale;
        }
        else if($ad->ad_type == 'property_flat_wishes_rented')
        {
            $property = $ad->propertyFlatWishesRented;
        }
        
        $media = $property->media;

        if(count($media)>0)
        {
            $path = \App\Helpers\common::getMediaPath($media->first());
        }
        else
        {
            $path = "";
        }
            
    
    }

?>

        <div class="col-md-4 col-sm-6" style="">
            <div class="realestate-blockk " style="">
                <a href="#" class="grid-box-ancor">
                <div class="home-grid-box trailing-border" style="text-align:center;">
                    <div href="#" class="favorite-icon-outer">
                        <div class="favorite-icon fa fa-heart"></div>
                    </div>
                    <img src="{{$path}}" style="max-height: 200px;" class="img-fluid product-img" alt="">
                    <div class="product-total-price">
                        Totalpris:
                        <?php 
                            echo($ad->ad_type == 'property_for_rent' ? $property->monthly_rent : ""); 
                            echo($ad->ad_type == 'property_for_sale' ? $property->asking_price : ""); 
                            echo($ad->ad_type == 'property_holiday_home_for_sale' ? $property->asking_price : ""); 
                            echo($ad->ad_type == 'property_flat_wishes_rented' ? $property->max_rent_per_month : "");
                        ?>
                        KR
                        <!-- Totalpris: 2011 111 KR -->
                    </div>
                    <div class="product-price"><img src="{{asset('public/images/Jobb_ikon_white.svg')}}" width="23px;"> 
                        <?php 
                            echo($ad->ad_type == 'property_for_rent' ? $property->monthly_rent : ""); 
                            echo($ad->ad_type == 'property_for_sale' ? $property->total_price : ""); 
                            echo($ad->ad_type == 'property_holiday_home_for_sale' ? $property->total_price : ""); 
                            echo($ad->ad_type == 'property_flat_wishes_rented' ? $property->max_rent_per_month : "");
                        ?> 
                        KR
                    </div>
                </div>
                <p class="product-location text-muted mb-0 mt-2 u-d1">
                    <?php 
                        echo($ad->ad_type == 'property_for_rent' ? $property->street_address : ""); 
                        echo($ad->ad_type == 'property_for_sale' ? $property->street_address : ""); 
                        echo($ad->ad_type == 'property_holiday_home_for_sale' ? $property->street_address : ""); 
                    ?> 
                </p>
                <p class="product-title u-t4">
                    <?php 
                        echo($ad->ad_type == 'property_for_rent' ? $property->heading : ""); 
                        echo($ad->ad_type == 'property_for_sale' ? $property->headline : ""); 
                        echo($ad->ad_type == 'property_holiday_home_for_sale' ? $property->ad_headline : ""); 
                        echo($ad->ad_type == 'property_flat_wishes_rented' ? $property->headline : "");
                    ?> 
                </p>
                </a>
            </div>
        </div>
