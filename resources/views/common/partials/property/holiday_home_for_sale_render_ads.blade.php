            
<?php 


if(isset($filtering))
{
    $col = (strpos($filtering,'grid') !== false ? "grid":"list");
}
else
{
    $col = 'list';  
}

?>

<div class="col-md-12 outer-div">
    <div class="inner-div">{{ $add_array->links() }}</div>
</div>

<div class="col-md-12">

<div class="<?php echo $col==='grid'?'row':'' ?>">
      
      @foreach ($add_array as $key => $value)

        <?php
            
            $property_holiday_home_for_sale = App\PropertyHolidaysHomesForSale::find($value->id);

            $name       = $property_holiday_home_for_sale->media->first();
            
            if(!empty($name))
            {
                $name = $property_holiday_home_for_sale->media->first()->name_unique;
                $path       = \App\Helpers\common::getMediaPath($property_holiday_home_for_sale);
                $full_path  = $path."".$name; 
            }
            else
            {
                $full_path  = "";
            }

        ?>  

            <div class="<?php echo $col==='grid'?'col-sm-4 pr-0':'' ?>">
                <a href="{{url('/holiday/home/for/sale/description', $value->id)}}" class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                    <div class="image-section <?php echo $col==='grid'?'col-sm-12':'col-sm-4' ?>  p-2">
                        <div class="trailing-border">
                            <img src="{{$full_path}}" alt="" class="img-fluid radius-8">
                        </div>
                    </div>
                    <div class="detailed-section <?php echo $col==='grid'?'col-sm-12':'col-sm-8' ?> p-2">
                        <div class="u-t5 text-muted" style=""></div>
                        <div class="add-to-fav"><span class="fa fa-heart text-muted"></span></div>
                        <div class="location u-t5 text-muted mt-2">{{ $property_holiday_home_for_sale -> street_address}}</div>
                        <div class="title color-grey">{{ $property_holiday_home_for_sale -> ad_headline}}</div>
                        <div class="mt-2">
                            <div class="area font-weight-bold float-left color-grey">{{ $property_holiday_home_for_sale ->  primary_room }} m²</div>
                            <div class="price font-weight-bold float-right color-grey"> {{  $property_holiday_home_for_sale ->  asking_price  }} kr</div>
                        </div>
                        <br>
                        <div class="location u-t5 text-muted">{{  $property_holiday_home_for_sale ->  local_area_name  }}</div>
                        <div class="location u-t5 text-muted"><span>TotalPris:</span><span>{{  $property_holiday_home_for_sale ->  total_price  }}</span></div>
                        <div class="location u-t5 text-muted"><span>{{  $property_holiday_home_for_sale ->  ownership_type  }}</span>  • <span>{{  $property_holiday_home_for_sale ->  property_type  }}</span></div>
                        <div class="dealer-logo float-right mt-3" ><img src="{{asset('public/images/dealer-logo.png')}} " alt="" class="img-fluid"></div>
                        
                    </div>
                </a>
            </div>

      @endforeach

</div>

</div>
<div class="col-md-12 outer-div">
    <div class="inner-div">{{ $add_array->links() }}</div>
</div>