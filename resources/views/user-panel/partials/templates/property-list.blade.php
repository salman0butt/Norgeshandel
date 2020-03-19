<?php
if (isset($ad)) {
    $property = $ad->property;
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
{{--<a href="{{url('/', $ad->id)}}" class="row bg-hover-maroon-lighter radius-8 p-2">--}}
<div class="col-sm-12 pr-0 end_fav_item" data-name="{{$ad->getTitle()}}">
    <div class="row product-list-item mr-1 p-sm-1 mt-3">
        <div class="image-section image-section col-sm-4  p-2">
            <a href="{{url('/', $ad->id)}}" style="display: block;" class="trailing-border">

                <img src="{{$path}}" class="img-fluid radius-8 trailing-border" style=" margin: 2px; height: 130px; width: 100%"
                     alt="">
                {{--<div class="product-total-price">--}}
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

                    <?php /* Totalpris:
                    echo($ad->ad_type == 'property_for_rent' ? number_format($property->monthly_rent,0,""," ") : "");
                    echo($ad->ad_type == 'property_for_sale' ? number_format($property->total_price,0,""," ") : "");
                    echo($ad->ad_type == 'property_holiday_home_for_sale' ? number_format($property->asking_price,0,""," ") : "");
                    echo($ad->ad_type == 'property_flat_wishes_rented' ? number_format($property->max_rent_per_month,0,""," ") : "");
                    echo($ad->ad_type == 'property_commercial_for_sale' ? number_format($property->rental_income,0,""," ") : "");
                    echo($ad->ad_type == 'property_commercial_for_rent' ? number_format($property->rent_per_meter_per_year,0,""," ") : "");
                    echo($ad->ad_type == 'property_commercial_plots' ? number_format($property->asking_price,0,""," ") : "");
                    echo($ad->ad_type == 'property_business_for_sale' ? number_format($property->price,0,""," ") : "");
                    KR */ ?>

                    <!-- Totalpris: 2011 111 KR -->
                {{--</div>--}}
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
                    <?php /*
                    echo($ad->ad_type == 'property_for_rent' ? number_format($property->monthly_rent,0,""," ") : "");
                    echo($ad->ad_type == 'property_for_sale' ? number_format($property->asking_price,0,""," ") : "");
                    echo($ad->ad_type == 'property_holiday_home_for_sale' ? number_format($property->total_price,0,""," ") : "");
                    echo($ad->ad_type == 'property_flat_wishes_rented' ? number_format($property->max_rent_per_month,0,""," ") : "");
                    echo($ad->ad_type == 'property_commercial_for_sale' ? number_format($property->rental_income,0,""," ") : "");
                    echo($ad->ad_type == 'property_commercial_for_rent' ? number_format($property->rent_per_meter_per_year,0,""," ") : "");
                    echo($ad->ad_type == 'property_commercial_plots' ? number_format($property->asking_price,0,""," ") : "");
                    echo($ad->ad_type == 'property_business_for_sale' ? number_format($property->price ,0,""," "): "");
                    KR */?>

                </div>
            </a>
        </div>
        <div class="detailed-section col-md-8 position-relative p-2">
            <p class="product-location text-muted mb-0 mt-2 u-d1">
            {{$property->street_address ? Str::limit($property->street_address,40) : ''}}
<!--                --><?php
//                echo($ad->ad_type == 'property_for_rent' ? $property->street_address : "");
//                echo($ad->ad_type == 'property_for_sale' ? $property->street_address : "");
//                echo($ad->ad_type == 'property_holiday_home_for_sale' ? $property->street_address : "");
//                echo($ad->ad_type == 'property_commercial_for_sale' ? $property->street_address : "");
//                echo($ad->ad_type == 'property_commercial_for_rent' ? $property->street_address : "");
//                echo($ad->ad_type == 'property_commercial_plots' ? $property->street_address : "");
//                echo($ad->ad_type == 'property_business_for_sale' ? $property->street_address : "");
//                ?>
            </p>
            <p class="product-title u-t4">
            {{Str::limit($ad->getTitle(),40)}}
<!--                --><?php
//                echo($ad->ad_type == 'property_for_rent' ? $property->heading : "");
//                echo($ad->ad_type == 'property_for_sale' ? $property->headline : "");
//                echo($ad->ad_type == 'property_holiday_home_for_sale' ? $property->ad_headline : "");
//                echo($ad->ad_type == 'property_flat_wishes_rented' ? $property->headline : "");
//                echo($ad->ad_type == 'property_commercial_for_sale' ? $property->headline : "");
//                echo($ad->ad_type == 'property_commercial_for_rent' ? $property->heading : "");
//                echo($ad->ad_type == 'property_commercial_plots' ? $property->headline : "");
//                echo($ad->ad_type == 'property_business_for_sale' ? $property->headline : "");
//                ?>
            </p>
        </div>
        @include('user-panel.partials.fav-heart-button', compact('ad'))
    </div>
</div>
<?php
}
?>
