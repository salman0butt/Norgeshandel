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
        <div class="inner-div">
            {{$add_array->links()}}
        </div>
    </div>
    <div class="col-md-12">
        <div class="<?php
        echo $col==='grid'?'row':'' ?>">
            @foreach ($add_array as $key => $value)
                    <?php
                                    
                        $property_commercial_property_for_rent = App\CommercialPropertyForRent::find($value->id);
                        $name       = $property_commercial_property_for_rent->media->first();
                        if(!empty($name))
                        {
                            $name = $property_commercial_property_for_rent->media->first()->name_unique;
                            $path       = \App\Helpers\common::getMediaPath($property_commercial_property_for_rent);
                            $full_path  = $path."".$name; 
                        }
                        else
                        {
                            $full_path  = "";
                        }
                        
                    ?>

                <div class="<?php echo $col==='grid'?'col-sm-4 pr-0':'' ?>">
                    <a href="{{url('/commercial/property/for/rent/description', $value->id)}}" class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                        <div class="image-section <?php echo $col==='grid'?'col-sm-12':'col-sm-4' ?>  p-2">
                            <div class="trailing-border">
                                <img src="{{$full_path}}" alt="" class="img-fluid radius-8">
                            </div>
                        </div>
                        <div class="detailed-section <?php echo $col==='grid'?'col-sm-12':'col-sm-8' ?> p-2">
                                                                    <div class="week-status u-t5 text-muted" style="">Betalt plassering</div>
                            <div class="add-to-fav"><span class="fa fa-heart text-muted"></span></div>
                            <div class="location u-t5 text-muted mt-2">{{$property_commercial_property_for_rent->street_address}}</div>
                            <div class="title color-grey">{{$property_commercial_property_for_rent->heading}}</div>
                            <div class="mt-2">
                                <div class="area font-weight-bold float-left color-grey">{{$property_commercial_property_for_rent->gross_area_from}} - {{$property_commercial_property_for_rent -> gross_area_to}} m²</div>
                                </br><div class="area font-weight-bold float-left color-grey">{{$property_commercial_property_for_rent->use_area}} m²</div>
                                <div class="price font-weight-bold float-right color-grey">{{$property_commercial_property_for_rent->rent_per_meter_per_year}} kr</div>
                            </div>
                            <br>
                            <div class="detail u-t5 mt-3 float-left text-muted">Private
                                <br>Kontor</div>
                            <div class="dealer-logo float-right mt-3" ><img src="{{asset('public/images/businesssale-logo.jpg')}}" alt="" class="img-fluid"></div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-12 outer-div">
        <div class="inner-div">
            {{$add_array->links()}}
        </div>
    </div>