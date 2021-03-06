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
        <div class="image-section image-section @if(Request::is('my-business/favorite-list/*')) col-sm-3 @else col-sm-4 @endif  p-2">
            <a href="{{url('/', $ad->id)}}" style="display: block;" class="trailing-border">

                <img src="{{$path}}" class="img-fluid radius-8 trailing-border" style="margin: 2px; height: 180px; width: 100%"
                     alt="">
                @if($ad && $ad->status == 'sold' && $ad->sold_at && $ad->ad_type != 'job')
                    <span class="badge badge-success" style="position: absolute;top: 8px;left: 8px;">
                        @if($ad->ad_type == 'property_for_rent' || $ad->ad_type == 'property_flat_wishes_rented' || $ad->ad_type == 'property_commercial_for_rent')
                            UTLEID
                        @else
                            SOLGT
                        @endif
                    </span>
                @endif
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
            </a>
        </div>
        <div class="detailed-section @if(Request::is('my-business/favorite-list/*')) col-md-9 @else col-md-8 @endif position-relative p-2">
            <p class="product-location text-muted mb-0 mt-2 u-d1">
            {{$property->street_address ? Str::limit($property->street_address,30).', ' : ''}}{{$property->zip_city ? Str::ucfirst(Str::lower($property->zip_city)) : ''}}
            </p>
            <p class="product-title u-t4">
                {{Str::limit($ad->getTitle(),40)}}
            </p>
            @if(Request::is('my-business/favorite-list/*'))
                <div>
                    @if($fav_item && $fav_item->id && !$fav_item->note)
                        <a style="color: black;background: #E0F0FD;border: #E0F0FD;" class="btn btn-info btn-sm plus_note_button" data-toggle="collapse" data-target="#note_{{$property->ad ? $property->ad->id : ''}}"><i class="fa fa-plus mr-2"></i>Skriv notat til deg selv</a>
                    @endif
                    <div id="note_{{$property->ad ? $property->ad->id : ''}}" class="{{$fav_item && $fav_item->id && !$fav_item->note ? 'collapse' : ''}}" style="background-color: #fff5cb; border-radius:10px">
                        <form class="p-3" id="note_form_{{$property->ad ? $property->ad->id : ''}}">
                            @method('POST') @csrf

                            <input type="hidden" name="id" value="{{$fav_item && $fav_item->id ? $fav_item->id : ''}}"/>
                            <textarea class="form-control bg-transparent border-0" name="note" {{$fav_item && $fav_item->id && $fav_item->note ? 'disabled' : ''}}>{{$fav_item && $fav_item->id ? $fav_item->note : ''}}</textarea>

                            <div class="mt-3 float-left d-none remove_button_area">
                                <a href="#" class="remove_note_button" style="color:red;">Slett</a>
                            </div>

                            <div class="mt-3 float-right {{$fav_item && $fav_item->id && $fav_item->note ? 'd-none' : ''}}">
                                <a class="btn btn-warning btn-sm close_button {{$fav_item && $fav_item->id && $fav_item->note ? 'close_button_for_note' : ''}}" @if($fav_item && $fav_item->id && !$fav_item->note) data-toggle="collapse" data-target="#note_{{$property->ad ? $property->ad->id : ''}}" @endif>Avbryt</a>
                                <input type="submit" value="Lagre" data-target="note_form_{{$property->ad ? $property->ad->id : ''}}" class="btn btn-success btn-sm submit_button">
                            </div>

                            <a href="#" data-toggle="modal" class="ad_note_link float-right pr-1 {{$fav_item && $fav_item->id && !$fav_item->note ? 'd-none' : ''}}"><span class="fa fa-pencil"></span></a>

                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        @include('user-panel.partials.fav-heart-button', compact('ad'))
    </div>
</div>
<?php
}
?>
