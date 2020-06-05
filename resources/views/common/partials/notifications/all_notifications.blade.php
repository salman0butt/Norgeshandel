@extends('layouts.landingSite')
@section('page_content')
    <style>
        article.col-md-12.pl-0.pr-0.list-ad1:hover {
            background: #ac304a1a;
            border-radius: 10px;
        }
    </style>
    <div class="container">
        <main class="pageholder">
            <div id="page-results" tabindex="-1" data-controller="trackNotificationShow" data-notification-count="2">
                <h1 class="u-screen-reader-only">Varslinger</h1>
                <div class="panel text-right pb-5">
                    <a href="{{url('notifications-read-all')}}" class="m-2">Merk alt som lest</a>
                    <a class="m-2" href="{{ url('/setting') }}">Innstillinger</a>
                </div>
                <div class="row">
                    @php($count = 0)
                    @php($added = array())
                    @if(is_countable($notifications) && count($notifications) > 0)
                        @foreach ($notifications as $key=>$notif)
                            @php($addable = $notif->notifiable_type.'-'.$notif->notifiable_id)
                            @if(!in_array($addable, $added) && !empty($notif->notifiable))
                                <article class="col-md-12 pl-0 pr-0 list-ad1">
                                    <a href="
                                        @if($notif->notifiable_type == \App\Models\Search::class)
                                    {{url('/'.$notif->notifiable->filter)}}&search_id={{$notif->notifiable->id}}
                                    @elseif($notif->notifiable_type == 'App\UserRatingReview')
                                    {{url('/', $notif->notifiable->ad_id)}}
                                    @else
                                    {{url('/', $notif->notifiable->id)}}
                                    @endif" >

                                        <div class="" style="max-width: 160px;display:block;width:23%;float:left;margin:5px;">
                                            <div class="">
                                            <span>
                                            <img class="img-thumbnail w-100" style="border-radius:10px;min-height:110px;max-height:110px;"
                                                 src="@if($notif->notifiable_type != 'App\UserRatingReview' && $notif->ad && $notif->ad->company_gallery->first()) {{App\Helpers\common::getMediaPath($notif->ad->company_gallery->first())}} @elseif($notif->notifiable && isset($notif->notifiable->ad) && $notif->notifiable->ad->company_gallery->first())  {{App\Helpers\common::getMediaPath($notif->notifiable->ad->company_gallery->first())}}  @else {{asset('public/images/placeholder.png')}} @endif"

                                                 alt="">
                                            </span>
                                            </div>
                                        </div>
                                        <br>
                                        <span class="" style="margin-top:5%;">
                                            <span class="status status--success u-mb0"
                                                  style="background:#AC304A;border-radius:5px;padding:1px 3px;color:white;">
                                                  {{ $notif->data }}
                                            </span>
                                        </span>

                                        <?php
                                            $ad = $ad_title = $zip_city =  '';
                                            if($notif->notifiable_type == 'App\UserRatingReview'){
                                                if($notif->notifiable->ad && $notif->notifiable->ad->ad_type != 'job'){
                                                    $ad_title = $notif->notifiable->ad->getTitle();
                                                    $zip_city = $notif->notifiable->ad->property->zip_city;
                                                }
                                            }else{
                                                if(isset($notif->ad) && $notif->ad->ad_type == 'job'){
                                                    $ad_title = $notif->ad->job->name;
                                                    $zip_city = $notif->ad->job->zip_city;
                                                }
                                                if(isset($notif->ad) && $notif->ad->ad_type != 'job'){
                                                    $ad_title = $notif->ad->getTitle();
                                                    $zip_city = $notif->ad->property->zip_city;
                                                }
                                            }
                                        ?>
                                        <div class="" style="display:block;width:70%;float:left;margin-top: 0%;">
                                            @if($zip_city)
                                                <p class="mb-0">
                                                    {{$zip_city}}
                                                    {{-- {{isset($notif->ad) && isset($notif->ad->property) && $notif->notifiable_type != 'App\UserRatingReview' ? $notif->ad->property->zip_city : ''}}--}}
                                                </p>
                                            @endif
                                            @if($ad_title)
                                                <h2 class="u-t3 u-mt8" style="margin-top:0px;">
                                                    <span class="">
                                                        {{Str::limit($ad_title,60)}}
                                                        {{--<h5>{{ $notif->ad && isset($notif->ad->property) && $notif->notifiable_type != 'App\UserRatingReview' ? $notif->ad->getTitle() : ''}}</h5>--}}
                                                        {{--<h5 class="mt-4">{{ $notif->notifiable_type == 'App\UserRatingReview' &&  $notif->notifiable->ad && isset($notif->notifiable->ad->property) ? $notif->notifiable->ad->getTitle() : ''}}</h5>--}}
                                                    </span>
                                                </h2>
                                            @endif

                                            <span class="u-stone timeago" style="margin-left:10px;" title="{{$notif->created_at}}">
                                            &nbsp;
                                            </span>
                                            <p class="u-stone u-t4 d-block pull-right w-100">
                                                <b>
                                                    @if($notif->notifiable_type==\App\Models\Search::class)
                                                        {{count($notif->notifiable->first()->unread_notifications)<1?"Ingen nye":count($notif->notifiable->first()->unread_notifications)." nye"}}
                                                    @else
                                                        {{$notif->read_at==null?'1 Nye':''}}
                                                    @endif
                                                </b>
                                            </p>
                                        </div>
                                    </a>
                                </article>
                                 @php(array_push($added, $addable))
                            @endif
                        @endforeach
                    @else
                        <div style="display:block;text-align:center;margin:0 auto;margin-top:50px;">
                            <h1 class="text-center text-muted">Ingen varsler å vise</h1>
                        </div>
                    @endif
                </div>

                <div data-controller="newnotificationscountreset">

                </div>
            </div>
        </main>

    </div>

    <script>
        $(document).ready(function () {
            $(".timeago").timeago();
        })
    </script>

@endsection
@section('script')
    <script src="{{asset('public/js/time-ago-in-words.min.js')}}"></script>
@endsection
