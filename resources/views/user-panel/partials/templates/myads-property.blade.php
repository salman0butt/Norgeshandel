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
<div class="row bg-hover-maroon-lighter radius-8 p-sm-1">
    <a href="{{url('/', $ad->id)}}" class="image-section col-md-4 p-2">
        <div class="img-fluid radius-8 trailing-border" style="height: 160px;width: 100%;background-image: url('{{$path}}'); background-size: cover; background-position: center;"></div>
        {{--        <img src="{{$path}}" class="img-fluid radius-8 trailing-border" alt="" style="height: 160px;width: 100%;">--}}
        @if(!$ad->visibility)
            <span class="badge badge-primary" style="position: absolute;top: 16px;right: 16px;">skjult</span>
        @endif
        @if($ad->status == 'sold' && $ad->sold_at && $ad->ad_type != 'job')
            <span class="badge badge-success" style="position: absolute;top: 16px;left: 16px;">
                @if($ad->ad_type == 'property_for_rent' || $ad->ad_type == 'property_flat_wishes_rented' || $ad->ad_type == 'property_commercial_for_rent')
                    UTLEID
                @else
                    SOLGT
                @endif
            </span>
        @endif
         {{--<div class="product-total-price m-2">--}}
         <?php
         echo(($ad->ad_type == 'property_for_sale' && $property->total_price) ? '<div class="product-total-price m-2">Totalpris: '.number_format($property->total_price,0,""," ").' KR</div>' : "");
         echo(($ad->ad_type == 'property_holiday_home_for_sale' && is_numeric($property->total_price)) ?  '<div class="product-total-price m-2">Totalpris: '.number_format($property->total_price,0,""," ").' KR</div>' : "");
         echo(($ad->ad_type == 'property_commercial_for_rent' && $property->rent_per_meter_per_year) ? '<div class="product-total-price m-2">Totalpris: '.number_format($property->rent_per_meter_per_year,0,""," ").' KR</div>' : "");
         echo(($ad->ad_type == 'property_commercial_plots' && $property->asking_price) ? '<div class="product-total-price m-2">Totalpris: '.number_format($property->asking_price,0,""," ").' KR</div>' : "");
         ?>

        <div class="product-price m-2"><img src="{{asset('public/images/Eiendom_ikon_white.svg')}}" width="23px;">
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
    </a>
    <div class="detailed-section col-md-8 position-relative p-2">
        <form action="{{route('delete-property', $property->ad)}}" method="POST" onsubmit="javascript:return confirm('Vil du slette denne annonsen?')">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="link float-right" style="cursor: pointer;"><span class="fa fa-trash fa-lg text-muted"></span></button>
        </form>
        <p class="product-location text-muted mb-0 mt-2 u-d1">
            {{$property->street_address ? Str::limit($property->street_address,45).', ' : ''}}{{$property->zip_city ? Str::ucfirst(Str::lower($property->zip_city)) : ''}}
        </p>
        <p class="product-title u-t4">
            {{Str::limit($ad->getTitle(),100)}}
        </p>
        @if(!$ad->sold_at && $ad->status !='sold')
            <a href="
                @if($ad->ad_type == 'property_for_rent') {{ url('new/property/rent/ad/'.$property->id.'/edit')}}
            @elseif($ad->ad_type == 'property_for_sale') {{ url('new/property/sale/ad/'.$property->id.'/edit')}}
            @elseif($ad->ad_type == 'property_business_for_sale') {{ url('add/business/for/sale/'.$property->id.'/edit')}}
            @elseif($ad->ad_type == 'property_holiday_home_for_sale') {{ url('holiday/home/for/sale/'.$property->id.'/edit')}}
            @elseif($ad->ad_type == 'property_flat_wishes_rented') {{ url('new/flat/wishes/rented/'.$property->id.'/edit')}}
            @elseif($ad->ad_type == 'property_commercial_plots') {{ url('commercial/plots/'.$property->id.'/edit')}}
            @elseif($ad->ad_type == 'property_commercial_for_sale') {{ url('add/new/commercial/property/for/sale/'.$property->id.'/edit')}}
            @elseif($ad->ad_type == 'property_commercial_for_rent') {{ url('add/new/commercial/property/for/rent/'.$property->id.'/edit')}}
            @endif" style="color:#ac304a !important; padding: 4px !important;" class="dme-btn-outlined-blue mr-2 btn-sm p-0 edit-ad-button">@if($ad->status == 'saved') Fullfør annonsen @else Endre @endif</a>
        @endif

        <a style="color:#ac304a !important; padding: 4px !important;" href="{{url('/', $ad->id)}}" class="dme-btn-outlined-blue mr-2 btn-sm">Se annonse</a>
        @if($ad->status != 'saved')
        <a style="color:#ac304a !important; padding: 4px !important;" href="{{url('my-business/my-ads/'.$property->ad->id.'/statistics')}}" class="dme-btn-outlined-blue mr-2 btn-sm statistics-button">Se statistikk</a>
        @endif
        <a style="color:#ac304a !important; padding: 4px !important;" href="{{url('my-business/my-ads/'.$property->ad->id.'/options')}}" class="dme-btn-outlined-blue mr-2 btn-sm">Flere valg</a>
        {{--<div class="buttons position-absolute p-2" style="bottom: 0;right: 0">--}}
        {{--<a href="{{url('my-business/my-ads/'.$property->ad->id.'/options')}}" class="dme-btn-outlined-blue float-right">Flere valg</a>--}}
        {{--@if($property->ad->status=='saved')--}}
        {{--<a href="" class="dme-btn-outlined-blue float-right mr-2">Fullfør annonsen</a>--}}
        {{--@endif--}}
        {{--</div>--}}
    </div>
</div>

<?php
}
?>
