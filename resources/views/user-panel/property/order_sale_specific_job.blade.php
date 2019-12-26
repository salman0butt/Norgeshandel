            
              <?php 


$col='list';
if(isset($_GET)){
    if(isset($_GET['grid'])){
        $col = 'grid';
}}


?>


<div class="col-md-12">

<div class="<?php echo $col==='grid'?'row':'' ?>">
      
      @foreach ($add_array as $key => $value)

          <div class="<?php echo $col==='grid'?'col-sm-4 pr-0':'' ?>">
              <a href="#" class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                  <div class="image-section <?php echo $col==='grid'?'col-sm-12':'col-sm-4' ?>  p-2">
                      <div class="trailing-border">
                      
                          <img src="{{ url('public/uploads/2019/11', [$value->name_unique]) }}" alt="" class="img-fluid radius-8">
                      </div>
                  </div>
                  <div class="detailed-section <?php echo $col==='grid'?'col-sm-12':'col-sm-8' ?> p-2">
                                        <div class="week-status u-t5 text-muted" style="">Ukens bolig</div>
                                        <div class="add-to-fav"><span class="fa fa-heart text-muted"></span></div>
                                        <div class="location u-t5 text-muted mt-2">{{$value->street_address }}, {{$value->local_area_name}}</div>
                                        <div class="title color-grey">{{$value->area_description}}</div>
                                        <div class="mt-2">
                                            <div class="area font-weight-bold float-left color-grey">{{$value->primary_room}} m²</div>
                                            <div class="price font-weight-bold float-right color-grey">{{$value->asking_price + $value->expenses}}  kr</div>
                                        </div>
                                        <br>
                                        <div class="detail u-t5 mt-3 float-left text-muted">{{$value->property_type }} • {{ $value->tenure }} •  {{ $value-> number_of_bedrooms}} soverom <br>DNB Eiendom AS</div>
                                        <div class="dealer-logo float-right mt-3" ><img src="assets/images/dealer-logo.png" alt="" class="img-fluid"></div>
                                    </div>
              </a>
          </div>

      @endforeach

      <?php
      // if($i==3):
          ?>
          <!-- <a href="#" style="text-decoration: none;" class="color-grey">
              <div class="col-sm-12 ad radius-8 bg-light-grey p-3">
                  <img src="{{asset('public/images/search-ad.jpg')}}" class="img-fluid radius-8">
                  <h2 class="m-3">Nå trenger du ikke å betale innskudd på hjemmet</h2>
                  <div class="float-right " style="height: 50px; margin-top: -50px;">
                  {{asset('public/images/ad-D.png')}}
                      <img src="{{asset('public/images/ad-D.png')}}" alt="" >
                  </div>
              </div> -->
          </a>
          <?php
      // endif;
  ?>
</div>

</div>