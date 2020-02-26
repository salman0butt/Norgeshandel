<?php
if (isset($ad)) {
    $property = "";
    if ($ad->ad_type == 'property_for_rent') {
        $property = $ad->propertyForRent;
    } else if ($ad->ad_type == 'property_for_sale') {
        $property = $ad->propertyForSale;
    } else if ($ad->ad_type == 'property_holiday_home_for_sale') {
        $property = $ad->propertyHolydaysHomesForSale;
    } else if ($ad->ad_type == 'property_flat_wishes_rented') {
        $property = $ad->propertyFlatWishesRented;
    } else if ($ad->ad_type == 'property_commercial_for_sale') {
        $property = $ad->propertyCommercialPropertyForSale;
    } else if ($ad->ad_type == 'property_commercial_for_rent') {
        $property = $ad->propertyCommercialPropertyForRent;
    } else if ($ad->ad_type == 'property_commercial_plots') {
        $property = $ad->propertyCommercialPlot;
    } else if ($ad->ad_type == 'property_business_for_sale') {
        $property = $ad->propertyBusinessForSale;
    }
    if ($property !== null) {
        $media = $property->ad->company_gallery;
        if (count($media) > 0) {
            $path = \App\Helpers\common::getMediaPath($media->first());
        } else {
            $path = asset('public/images/placeholder.png');
        }
    }
}
if($property !== null)
{
?>
{{--<a href="{{url('general/property/description', [$property->id, $ad->ad_type])}}" class="row bg-hover-maroon-lighter radius-8 p-2">--}}
<div class="col-sm-12 pr-0">
    <div class="row product-list-item mr-1 p-sm-1 mt-3">
        <div class="image-section image-section col-sm-4  p-2">
            <a href="{{url('general/property/description', [$property->id, $ad->ad_type])}}" style="display: block;" class="trailing-border">

                <img src="{{$path}}" class="img-fluid radius-8 trailing-border" style=" margin: 2px; max-height: 200px;"
                     alt="">
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
                <div class="product-price"><img src="{{asset('public/images/Eiendom_ikon_white.svg')}}"
                                                    width="23px;">
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
            </a>
        </div>
        <div class="detailed-section col-md-8 position-relative p-2">
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
        </div>
        @include('user-panel.partials.fav-heart-button', compact('ad'))
    </div>
</div>
<?php
}
?>
