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
<div class="col-md-4 col-sm-6 product-list-item pt-sm-1" style="">
    <div class="realestate-blockk " style="">
        <a href="{{url('/', $ad->id)}}" class="grid-box-ancor product-list-item">
            <div class="pt-2">
            <div class="home-grid-box trailing-border" style="text-align:center;">
                <img src="{{$path}}" style="max-height: 302px;min-height:302px;width:100%;" class="img-fluid product-img" alt="">


                    <?php
//                    echo($ad->ad_type == 'property_for_rent' ? number_format($property->monthly_rent,0,""," ") : "");
                    echo(($ad->ad_type == 'property_for_sale' && $property->total_price) ? '<div class="product-total-price">Totalpris: '.number_format($property->total_price,0,""," ").' KR</div>' : "");
                    echo(($ad->ad_type == 'property_holiday_home_for_sale' && $property->total_price) ?  '<div class="product-total-price">Totalpris: '.number_format($property->total_price,0,""," ").' KR</div>' : "");
//                    echo($ad->ad_type == 'property_flat_wishes_rented' ? number_format($property->max_rent_per_month,0,""," ") : "");
//                    echo($ad->ad_type == 'property_commercial_for_sale' ? number_format($property->rental_income,0,""," ") : "");
                    echo(($ad->ad_type == 'property_commercial_for_rent' && $property->rent_per_meter_per_year) ? '<div class="product-total-price">Totalpris: '.number_format($property->rent_per_meter_per_year,0,""," ").' KR</div>' : "");
                    echo(($ad->ad_type == 'property_commercial_plots' && $property->asking_price) ? '<div class="product-total-price">Totalpris: '.number_format($property->asking_price,0,""," ").' KR</div>' : "");
//                    echo($ad->ad_type == 'property_business_for_sale' ? number_format($property->price,0,""," ") : "");
                    ?>
                    <!-- Totalpris: 2011 111 KR -->
                <div class="product-price"><img src="{{asset('public/images/Eiendom_ikon_white.svg')}}" width="23px;">
                    <?php
                    echo(($ad->ad_type == 'property_for_rent' && $property->monthly_rent) ? number_format($property->monthly_rent,0,""," ").' KR' : "");
                    echo(($ad->ad_type == 'property_for_sale' && $property->asking_price) ? number_format($property->asking_price,0,""," ").' KR' : "");
                    echo(($ad->ad_type == 'property_holiday_home_for_sale' && $property->asking_price) ? number_format($property->asking_price,0,""," ").' KR' : "");
                    echo(($ad->ad_type == 'property_flat_wishes_rented' && $property->max_rent_per_month) ? number_format($property->max_rent_per_month,0,""," ").' KR' : "");
                    echo(($ad->ad_type == 'property_commercial_for_sale' && $property->value_rate) ? number_format($property->value_rate,0,""," ").' KR' : "");
                    echo($ad->ad_type == 'property_commercial_for_rent' ? $property->gross_area_from.' - '.$property->gross_area_to.' m²' : "");
                    echo(($ad->ad_type == 'property_commercial_plots' && $property->asking_price) ? number_format($property->asking_price,0,""," ").' KR' : "");
                    echo(($ad->ad_type == 'property_business_for_sale' && $property->price) ? number_format($property->price,0,""," ").' KR' : "");
                    ?>
                </div>
            </div>
            </div>

            <p class="product-location text-muted mb-0 my-2 u-d1">
                <?php
                echo($ad->ad_type == 'property_for_rent' ? Str::limit($property->street_address,40) : "");
                echo($ad->ad_type == 'property_for_sale' ? Str::limit($property->street_address,40) : "");
                echo($ad->ad_type == 'property_holiday_home_for_sale' ? Str::limit($property->street_address,40) : "");
                echo($ad->ad_type == 'property_commercial_for_sale' ? Str::limit($property->street_address,40) : "");
                echo($ad->ad_type == 'property_commercial_for_rent' ? Str::limit($property->street_address,40) : "");
                echo($ad->ad_type == 'property_commercial_plots' ? Str::limit($property->street_address,40) : "");
                echo($ad->ad_type == 'property_business_for_sale' ? Str::limit($property->street_address,40) : "");
                ?>
            </p>
            <p class="product-title u-t4">
                <?php
                echo($ad->ad_type == 'property_for_rent' ? Str::limit($property->heading,75) : "");
                echo($ad->ad_type == 'property_for_sale' ? Str::limit($property->headline,75) : "");
                echo($ad->ad_type == 'property_holiday_home_for_sale' ? Str::limit($property->ad_headline,75) : "");
                echo($ad->ad_type == 'property_flat_wishes_rented' ? Str::limit($property->headline,75) : "");
                echo($ad->ad_type == 'property_commercial_for_sale' ? Str::limit($property->headline,75) : "");
                echo($ad->ad_type == 'property_commercial_for_rent' ? Str::limit($property->heading,75): "");
                echo($ad->ad_type == 'property_commercial_plots' ? Str::limit($property->headline,75): "");
                echo($ad->ad_type == 'property_business_for_sale' ? Str::limit($property->headline,75) : "");

                ?>
            </p>
        </a>
        @include('user-panel.partials.fav-heart-button', compact('ad'))
    </div>
</div>

<?php
}
?>
