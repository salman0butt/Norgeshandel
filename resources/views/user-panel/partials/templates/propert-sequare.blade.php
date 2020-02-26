<?php

if(isset($ad))
{
    $property = $ad->property;

    if($property !== null)
    {
        $media = $ad->company_gallery;

        if(count($media)>0)
        {
            $path = \App\Helpers\common::getMediaPath($media->first());
        }
        else
        {
            $path = asset('public/images/placeholder.png');
        }
    }

}
if($property !== null)
{

?>
<div class="col-md-4 col-sm-6" style="">
    <div class="realestate-blockk " style="">
        <a href="{{url('general/property/description', [$property->id, $ad->ad_type])}}" class="grid-box-ancor product-list-item">
            <div class="home-grid-box trailing-border" style="text-align:center;">
                <img src="{{$path}}" style="max-height: 302px;min-height:302px;width:100%;" class="img-fluid product-img" alt="">
                <div class="product-total-price">
                    Totalpris:
                    <?php
                    echo($ad->ad_type == 'property_for_rent' ? number_format($property->monthly_rent,0,""," ") : "");
                    echo($ad->ad_type == 'property_for_sale' ? number_format($property->total_price,0,""," ") : "");
                    echo($ad->ad_type == 'property_holiday_home_for_sale' ? number_format($property->asking_price,0,""," ") : "");
                    echo($ad->ad_type == 'property_flat_wishes_rented' ? number_format($property->max_rent_per_month,0,""," ") : "");
                    echo($ad->ad_type == 'property_commercial_for_sale' ? number_format($property->rental_income,0,""," ") : "");
                    echo($ad->ad_type == 'property_commercial_for_rent' ? number_format($property->rent_per_meter_per_year,0,""," ") : "");
                    echo($ad->ad_type == 'property_commercial_plots' ? number_format($property->asking_price,0,""," ") : "");
                    echo($ad->ad_type == 'property_business_for_sale' ? number_format($property->price,0,""," ") : "");
                    ?>
                    KR
                    <!-- Totalpris: 2011 111 KR -->
                </div>
                <div class="product-price"><img src="{{asset('public/images/Eiendom_ikon_white.svg')}}" width="23px;">
                    <?php
                    echo($ad->ad_type == 'property_for_rent' ? number_format($property->monthly_rent,0,""," ") : "");
                    echo($ad->ad_type == 'property_for_sale' ? number_format($property->asking_price,0,""," ") : "");
                    echo($ad->ad_type == 'property_holiday_home_for_sale' ? number_format($property->total_price,0,""," ") : "");
                    echo($ad->ad_type == 'property_flat_wishes_rented' ? number_format($property->max_rent_per_month,0,""," ") : "");
                    echo($ad->ad_type == 'property_commercial_for_sale' ? number_format($property->rental_income,0,""," ") : "");
                    echo($ad->ad_type == 'property_commercial_for_rent' ? number_format($property->rent_per_meter_per_year,0,""," ") : "");
                    echo($ad->ad_type == 'property_commercial_plots' ? number_format($property->asking_price,0,""," ") : "");
                    echo($ad->ad_type == 'property_business_for_sale' ? number_format($property->price,0,""," ") : "");
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
        @include('user-panel.partials.fav-heart-button', compact('ad'))
    </div>
</div>

<?php
}
?>
