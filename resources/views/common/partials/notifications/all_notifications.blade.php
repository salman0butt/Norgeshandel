@extends('layouts.landingSite')
​
​
@section('page_content')
<style>
    article.col-md-12.pl-0.pr-0.list-ad:hover {
        background: #ac304a1a;
        border-radius: 10px;
    }
</style>
<div class="container">
    <main class="pageholder ">
        <div id="page-results" tabindex="-1" data-controller="trackNotificationShow" data-notification-count="2">
            <h1 class="u-screen-reader-only">Varslinger</h1>
            <div class="panel text-right pb-5">
                <a href="#" class="m-2">Merk alt som lest</a>
                <a class="m-2" href="#">Innstillinger</a>
            </div>
            <div class="row">
                @foreach ($ids as $key => $value)

                        <?php 
                            $t=time();
                            App\Notification::where('id', $value['id'])
                            ->update(['read_at' => date("Y-m-d h:m:i",$t)]);
                            $notification_type = App\Notification::where('notifiable_id',$value['notifiable_id'])->first(['type','created_at']);
                    
                            $notification      = $notification_type->type::find($value['notifiable_id']);
                            $name              = $notification->media->first();
                            if($name != null)
                            {
                                $name       =    $name->name_unique;
                                $path       = \App\Helpers\common::getMediaPath($notification);
                                $full_path  = $path."".$name; 
                            }
                            else
                            {
                                $full_path  = "";
                            }

                        ?>

                    <article class="col-md-12 pl-0 pr-0 list-ad">
                        <div class="ads__unit__img"
                            style="max-width: 160px;display:block;width:23%;float:left; margin:5px;">
                            <div class="ads__unit__img__ratio">
                                <span><a href="{{url('/property/description', $value['notifiable_id'])}}">
                                    <img class="img-thumbnail w-100" style="border-radius:10px;"
                                    src="{{$full_path}}"
                                    alt="">
                                </span>
                            </div>
                        </div>
                        <br>
                        <span class="ads__unit__content__details" style="margin-top:5%;">
                            <span class="status status--success u-mb0"
                                style="background:#AC304A;border-radius:5px;padding:1px 3px;color:white;">Treff i lagret
                                søk</span>
                            <span class="u-stone" style="margin-left:10px;">
                        
                                <?php
                                  
                                    echo $notification_type->created_at->diffForHumans(); 
                                ?>
                             
                            </span>
                        </span>
                        <div class="ads__unit__content" style="display:block;width:70%;float:left;">
                            <h2 class="ads__unit__content__title u-t3 u-mt8" style="margin-top:10px;">
                                <span class="ads__unit__link">
                                    <?php
                                        if($notification_type->type == "App\PropertyForRent")
                                        {
                                            echo $notification -> heading;
                                        }
                                        else if($notification_type->type  == "App\PropertyForSale")
                                        {
                                            echo $notification -> headline;
                                        }
                                        else if($notification_type->type  == "App\PropertyHolidaysHomesForSale")
                                        {
                                            echo $notification -> ad_headline;
                                        }
                                        else if($notification_type->type  == "App\FlatWishesRented")
                                        {
                                            echo $notification -> headline;
                                        }
                                        else if($notification_type->type  == "App\CommercialPropertyForSale")
                                        {
                                            echo $notification -> headline;
                                        }
                                        else if($notification_type->type  == "App\CommercialPropertyForRent")
                                        {
                                            echo $notification -> heating_character;
                                        }
                                        else if($notification_type->type  == "App\CommercialPlot")
                                        {
                                            echo $notification -> headline;
                                        }
                                        else
                                        {
                                            echo $notification_type -> headline;
                                        }

                                    ?>
                                </span>
                            </h2>
    ​
                            <p class="u-stone u-t4"><b>10 nye</b></p>
                        </div>
                    </article>
                @endforeach
            </div>
            <div data-controller="newnotificationscountreset"></div>
        </div>
    </main>
​
</div>
​
    <script>
        $(document).ready(function(){
            $(".nav-container").hide();
        })
    </script>

@endsection