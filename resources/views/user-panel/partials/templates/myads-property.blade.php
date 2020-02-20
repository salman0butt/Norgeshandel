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
            $path = asset('public/images/image-placeholder.jpg');
        }
    }
}
if($property !== null)
{

?>
{{--<a href="{{url('general/property/description', [$property->id, $ad->ad_type])}}" class="row bg-hover-maroon-lighter radius-8 p-2">--}}
<div class="row bg-hover-maroon-lighter radius-8 p-sm-1">
    <a href="{{url('general/property/description', [$property->id, $ad->ad_type])}}" class="image-section col-md-4 p-2">
        <img src="{{$path}}" class="img-fluid radius-8 trailing-border"
             alt="">
         <div class="product-total-price m-2">
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
        <div class="product-price m-2"><img src="{{asset('public/images/Eiendom_ikon_white.svg')}}" width="23px;">
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
    <div class="detailed-section col-md-8 position-relative p-2">
{{--        <form action=" @if($ad->ad_type == 'property_for_rent') {{ url('property/for/rent/ad/'.$property->id)}}  @elseif($ad->ad_type == 'property_for_sale') {{ url('property/for/sale/ad/'.$property->id)}} @elseif($ad->ad_type == 'property_holiday_home_for_sale') {{ url('holiday/home/for/sale/'.$property->id)}} @elseif($ad->ad_type == 'property_flat_wishes_rented') {{ url('flat/wishes/rented/'.$property->id)}} @endif" method="POST" onsubmit="javascript:return confirm('Vil du slette denne annonsen?')">--}}
        <form action="{{route('delete-property', $property->ad)}}" method="POST" onsubmit="javascript:return confirm('Vil du slette denne annonsen?')">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="link float-right" style="cursor: pointer;"><span class="fa fa-trash-alt text-muted"></span></button>
        </form>
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
        <a href="@if($ad->ad_type == 'property_for_rent') {{ url('property/for/rent/ad/'.$property->id.'/edit')}} @elseif($ad->ad_type == 'property_holiday_home_for_sale') {{ url('holiday/home/for/sale/'.$property->id.'/edit')}} @elseif($ad->ad_type == 'property_flat_wishes_rented') {{ url('flat/wishes/rented/'.$property->id.'/edit')}} @elseif($ad->ad_type == 'property_for_sale') {{ url('new/property/sale/ad/'.$property->id.'/edit')}} @endif" style="color:#ac304a !important;" class="dme-btn-outlined-blue mr-2">rediger legg til</a>
        <div class="buttons position-absolute p-2" style="bottom: 0;right: 0">
            <a href="" class="dme-btn-outlined-blue float-right">Flere valg</a>
            @if($property->ad->status=='saved')
                <a href="" class="dme-btn-outlined-blue float-right mr-2">Fullfør annonsen</a>
            @endif
        </div>
    </div>
</div>

<?php
}
?>
