<div id="carouselExampleIndicators" class="carousel slide carouselExampleIndicators" data-ride="carousel">
    <ol class="carousel-indicators mb-5">
        @if($name->count() > 0)
            @foreach($name as $key=>$val)
                <li data-target="#carouselExampleIndicators" data-slide-to="0" @if($key == 0) class="active" @endif></li>
            @endforeach
        @else
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        @endif
    </ol>
    <div class="carousel-inner">
        <?php $i = 0; ?>
        @if($name->count() > 0)
            @foreach($name as $key=>$val)
                <?php
                if(isset($property_data)){
                    $obj = $property_data;
                }
                $unique_name  =  $val->name_unique;
                $path  =    \App\Helpers\common::getMediaPath($obj);
                $file_path = 'public/uploads/' . date('Y', strtotime($obj->updated_at)) . '/' . date('m', strtotime($obj->updated_at)) . '/';
                $full_path  = $path."". $unique_name;
                ?>
                <div class="carousel-item <?php echo($i == 0 ? "active" : ""); ?>">
                    @if(!file_exists($file_path.$unique_name))
                        <img class="d-block w-100" src="{{ asset('/public/uploads/banners/1280x720.png') }}" alt="First slide">
                    @else
                        <img class="d-block w-100" src="{{$full_path}}" alt="First slide">
                    @endif
                    <div class="single-realestate-caption text-center carousel_image_slide_text" style="width:50%;margin:auto;margin-top: -20px;">
                       {{$val->title ? $val->title : ''}} ({{($key+1).'/'.$name->count()}})
                    </div>
                </div>

                <?php $i++ ?>
            @endforeach
        @else
            <div class="carousel-item <?php echo($i == 0 ? "active" : ""); ?>">
                <img class="d-block w-100" src="{{ asset('/public/uploads/banners/1280x720.png') }}" alt="First slide">
            </div>
        @endif

    </div>

    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

{{--<div class="single-realestate-caption text-center" style="width:50%;margin:auto;margin-top: -20px;">{{$val->title}}</div>--}}
