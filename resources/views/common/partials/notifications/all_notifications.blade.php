@extends('layouts.landingSite')

@section('page_content')
    <style>
        article.col-md-12.pl-0.pr-0.list-ad:hover {
            background: #ac304a1a;
            border-radius: 10px;
        }
    </style>
    @php($user = \Illuminate\Support\Facades\Auth::user())
    @php($notifications = $user->notifications);
    <div class="container">
        <main class="pageholder ">
            <div id="page-results" tabindex="-1" data-controller="trackNotificationShow" data-notification-count="2">
                <h1 class="u-screen-reader-only">Varslinger</h1>
                <div class="panel text-right pb-5">
                    <a href="#" class="m-2">Merk alt som lest</a>
                    <a class="m-2" href="{{ url('/setting') }}">Innstillinger</a>
                </div>
                <div class="row">
                    @php($count = 0)
                    @if(is_countable($notifications) && count($notifications) > 0)
                        @foreach ($notifications as $notification)
                            @if(empty($notification->notifiable))
                                @continue;
                            @endif
                        @php($count++)
                            <article class="col-md-12 pl-0 pr-0 list-ad">
                                <div class="ads__unit__img"
                                     style="max-width: 160px;display:block;width:23%;float:left; margin:5px;">
                                    <div class="ads__unit__img__ratio">
                                <span>
                                    <a href="">
                                    <img class="img-thumbnail w-100" style="border-radius:10px;"
                                         src="{{asset('http://localhost/norgeshandel/public/images/placeholder.png')}}"
                                         alt="">
                                    </a>
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

                                echo $notification->created_at->diffForHumans();
                                ?>

                            </span>
                        </span>
                                <div class="ads__unit__content" style="display:block;width:70%;float:left;">
                                    <h2 class="ads__unit__content__title u-t3 u-mt8" style="margin-top:10px;">
                                <span class="ads__unit__link">
                                    tiile
                                </span>
                                    </h2>
                                    ​
                                    <p class="u-stone u-t4"><b>10 nye</b></p>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <div style="display:block;text-align:center;margin:0 auto;margin-top:50px;">
                            <h1 class="text-center text-muted">Ingen varsler å vise</h1>
                        </div>
                    @endif
                </div>
                <div data-controller="newnotificationscountreset"></div>
            </div>
        </main>
        ​
    </div>
    ​
    {{-- <script>
        $(document).ready(function(){
            $(".nav-container").hide();
        })
    </script> --}}

@endsection
