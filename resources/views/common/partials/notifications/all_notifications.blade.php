@extends('layouts.landingSite')
@section('page_content')


    <main class="dme-wrepper">
        <div class="left-ad float-left">
            <img src="{{asset('public/images/left-ad.png')}}" class="img-fluid" alt="">
        </div>
        <div class="dme-container pl-3 pr-3">
            <div class="row top-ad">
                <img src="{{asset('public/images/top-ad.png')}}" class="img-fluid m-auto" alt="">
            </div>
            <div class="row mt-4">
                <div class="col-md-12 bg-maroon-lighter pt-2 mb-3" style="">
                    <h2 class="u-t2 p-2">&nbsp; varslinger</h2>
                </div>
                <div class="col-md-12">
                    <!-- <div class="hits fa-pull-right"><span class="font-weight-bold">36 331</span> treff på <span class="font-weight-bold">21 190 </span>annonser</div> -->
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-4 pt-4">
                    <!--                    <button class="dme-btn-outlined-blue">Lagre søk</button>-->
                </div>
                <div class="col-md-4 pt-4">
               
                </div>
                <div class="col-md-4">
                 
                </div>
            </div>
            <div style="display: block;margin: 0 auto; text-align:center;">
                 <div id="imageLoader" style="display:none;margin-top:15%; padding-bottom: 15%">
                   <img src="{{ asset('public\spinner.gif') }}" alt="spinner" id="imageLoader">
                 </div>
            </div>
           
            <div class="row">
                @foreach ($ids as $key => $value)
                        <div class="col-md-12">                            
                            
                                <?php 
                                    $t=time();
                                    App\Notification::where('id', $value['id'])
                                    ->update(['read_at' => date("Y-m-d h:m:i",$t)]);
                                    $notification_type = App\Notification::where('notifiable_id',$value['notifiable_id'])->first(['type'])->type;
                                    $notification      = $notification_type::find($value['notifiable_id']);
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
                                <div class="col-md-4">
                                    <span><a href="{{url('/property/description', $value['notifiable_id'])}}"><img src="{{$full_path}}" alt="" class="" style="height: auto;width: 44%;"></a></span>
                                </div>
                                <div class="col-md-4">
                                 
                                </div>
                                <div class="col-md-4">
                                   
                                </div>
                        </div>
                    @endforeach
                </div>
            </div>
           
        </div>
        <!--    ended container-->
        <div class="right-ad pull-right">
            <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
        </div>
    </main>

    <script>
        $(document).ready(function(){
            $(".nav-container").hide();
        })
    </script>

@endsection