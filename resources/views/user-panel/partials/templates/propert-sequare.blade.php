<?php

    if(isset($ad))
    {
        $property = "";
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
        else if($ad->ad_type == 'property_commercial_for_sale')
        {
            $property = $ad->propertyCommercialPropertyForSale;
        }
        else if($ad->ad_type == 'property_commercial_for_rent')
        {
            $property = $ad->propertyCommercialPropertyForRent;
        }
        else if($ad->ad_type == 'property_commercial_plots')
        {
            $property = $ad->propertyCommercialPlot;
        }
        else if($ad->ad_type == 'property_business_for_sale')
        {
            $property = $ad->propertyBusinessForSale;
        }


        if($property !== null)
        {
            $media = $property->media;

            if(count($media)>0)
            {
                $path = \App\Helpers\common::getMediaPath($media->first());
            }
            else
            {
                $path = asset('public/images/image-placeholder.jpg');
            }
        }

    }
        if($property !== null)
        {

?>



        <div class="col-md-4 col-sm-6
" style="">
            <div class="realestate-blockk " style="">
                <a href="{{url('general/property/description', [$property->id, $ad->ad_type])}}" class="grid-box-ancor product-list-item">
                    <div class="home-grid-box trailing-border" style="text-align:center;">
                        <div href="#" class="favorite-icon-outer">
                            <div class="favorite-icon fa fa-heart"></div>
                        </div>
                        <img src="{{$path}}" style="max-height: 302px;min-height:302px;width:100%;" class="img-fluid product-img" alt="">
                        <div class="product-total-price">
                            Totalpris:
                            <?php
                                echo($ad->ad_type == 'property_for_rent' ? $property->monthly_rent : "");
                                echo($ad->ad_type == 'property_for_sale' ? $property->asking_price : "");
                                echo($ad->ad_type == 'property_holiday_home_for_sale' ? $property->asking_price : "");
                                echo($ad->ad_type == 'property_flat_wishes_rented' ? $property->max_rent_per_month : "");
                                echo($ad->ad_type == 'property_commercial_for_sale' ? $property->rental_income : "");
                                echo($ad->ad_type == 'property_commercial_for_rent' ? $property->rent_per_meter_per_year : "");
                                echo($ad->ad_type == 'property_commercial_plots' ? $property->asking_price : "");
                                echo($ad->ad_type == 'property_business_for_sale' ? $property->price : "");
                            ?>
                            KR
                            <!-- Totalpris: 2011 111 KR -->
                        </div>
                        <div class="product-price"><img src="{{asset('public/images/Eiendom_ikon_white.svg')}}" width="23px;">
                            <?php
                                echo($ad->ad_type == 'property_for_rent' ? $property->monthly_rent : "");
                                echo($ad->ad_type == 'property_for_sale' ? $property->total_price : "");
                                echo($ad->ad_type == 'property_holiday_home_for_sale' ? $property->total_price : "");
                                echo($ad->ad_type == 'property_flat_wishes_rented' ? $property->max_rent_per_month : "");
                                echo($ad->ad_type == 'property_commercial_for_sale' ? $property->rental_income : "");
                                echo($ad->ad_type == 'property_commercial_for_rent' ? $property->rent_per_meter_per_year : "");
                                echo($ad->ad_type == 'property_commercial_plots' ? $property->asking_price : "");
                                echo($ad->ad_type == 'property_business_for_sale' ? $property->price : "");
                            ?>
                            KR
                        </div>
                    </div>
                    <p class="product-location text-muted mb-0 mt-2 u-d1">
                        <?php
                            echo($ad->ad_type == 'property_for_rent' ? $property->street_address : "");
                            echo($ad->ad_type == 'property_for_sale' ? $property->street_address : "");
                            echo($ad->ad_type == 'property_holiday_home_for_sale' ? $property->street_address : "");
                            echo($ad->ad_type == 'property_commercial_for_sale' ? $property->street_address : "");
                            echo($ad->ad_type == 'property_commercial_for_rent' ? $property->street_address : "");
                            echo($ad->ad_type == 'property_commercial_plots' ? $property->street_address : "");
                            echo($ad->ad_type == 'property_business_for_sale' ? $property->street_address : "");
                        ?>
                    </p>
                    <p class="product-title u-t4">
                        <?php
                            echo($ad->ad_type == 'property_for_rent' ? $property->heading : "");
                            echo($ad->ad_type == 'property_for_sale' ? $property->headline : "");
                            echo($ad->ad_type == 'property_holiday_home_for_sale' ? $property->ad_headline : "");
                            echo($ad->ad_type == 'property_flat_wishes_rented' ? $property->headline : "");
                            echo($ad->ad_type == 'property_commercial_for_sale' ? $property->headline : "");
                            echo($ad->ad_type == 'property_commercial_for_rent' ? $property->heading : "");
                            echo($ad->ad_type == 'property_commercial_plots' ? $property->headline : "");
                            echo($ad->ad_type == 'property_business_for_sale' ? $property->headline : "");

                        ?>
                    </p>
                </a>
            </div>
        </div>

<?php
        }
?>
