<article class="col-md-12 pl-0 pr-0 list-ad1 {{!$notification->read_at ? 'unread_notification' : ''}} mb-3">
    <a href="javascript:void(0);" data-href=
    "@if($notification->notifiable_type == \App\Models\Search::class) {{url('/'.$notification->notifiable->filter)}}&search_id={{$notification->notifiable->id}}
    @elseif($notification->notifiable_type == 'App\UserRatingReview' && $notification->type == 'ratings_reviews') {{url('rating')}}
    @else {{url('/', $notification->notifiable->id)}} @endif"
       class="notification_link" data-id="{{$notification->id}}">

        <div class="" style="max-width: 160px;display:block;width:23%;float:left;margin:5px;">
            <div class="">
                <span>
                <img class="img-thumbnail w-100" style="border-radius:10px;min-height:110px;max-height:110px;"
                     src="@if($notification->notifiable_type != 'App\UserRatingReview' && $notification->ad && $notification->ad->company_gallery->first()) {{App\Helpers\common::getMediaPath($notification->ad->company_gallery->first())}} @elseif($notification->notifiable && isset($notification->notifiable->ad) && $notification->notifiable->ad->company_gallery->first())  {{App\Helpers\common::getMediaPath($notification->notifiable->ad->company_gallery->first())}}  @else {{asset('public/images/placeholder.png')}} @endif"

                     alt="">
                </span>
            </div>
        </div>
        <br>
        <span class="" style="margin-top:5%;">
            <span class="status status--success u-mb0"
                  style="background:#AC304A;border-radius:5px;padding:1px 3px;color:white;">
                  {{ $notification->data }}
            </span>
        </span>
        <br>

        <?php
        $ad = $ad_title = $zip_city =  '';
        if($notification->notifiable_type == 'App\UserRatingReview'){
            if($notification->notifiable->ad && $notification->notifiable->ad->ad_type != 'job'){
                $ad_title = $notification->notifiable->ad->getTitle();
                $zip_city = $notification->notifiable->ad->property->zip_city;
            }
        }else{
            if(isset($notification->ad) && $notification->ad->ad_type == 'job'){
                $ad_title = $notification->ad->job->name;
                $zip_city = $notification->ad->job->zip_city;
            }
            if(isset($notification->ad) && $notification->ad->ad_type != 'job'){
                $ad_title = $notification->ad->getTitle();
                $zip_city = $notification->ad->property->zip_city;
            }
        }
        ?>
        <div class="" style="display:block;width:70%;float:left;margin-top: 0%;">
            @if($zip_city)
                <p class="mb-0">
                    {{$zip_city}}
                </p>
            @endif
            @if($ad_title)
                <h2 class="u-t3 u-mt8" style="margin-top:0px;">
                    <span class="">
                        {{Str::limit($ad_title,60)}}
                    </span>
                </h2>
            @endif

            <span class="u-stone timeago" style="margin-left:10px;" title="{{$notification->created_at}}">
                                            &nbsp;
            </span>
            <p class="u-stone u-t4 d-block pull-right w-100">
                <b>
                    @if($notification->notifiable_type==\App\Models\Search::class)
                        {{count($notification->notifiable->first()->unread_notifications)<1?"Ingen nye":count($notification->notifiable->first()->unread_notifications)." nye"}}
                    @else
                        {{$notification->read_at==null?'1 Nye':''}}
                    @endif
                </b>
            </p>
        </div>
    </a>
</article>