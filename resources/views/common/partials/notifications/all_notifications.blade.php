@extends('layouts.landingSite')

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
                    <a class="m-2" href="{{ url('/setting') }}">Innstillinger</a>
                </div>
                <div class="row">
                    @php($count = 0)
                    @if(is_countable($searches) && count($searches) > 0)
                        @foreach ($searches as $search)
                            <article class="col-md-12 pl-0 pr-0 list-ad">
                                <a href="{{url('/'.$search->filter)}}">
                                    <div class="ads__unit__img"
                                         style="max-width: 160px;display:block;width:23%;float:left; margin:5px;">
                                        <div class="ads__unit__img__ratio">
                                            <span>
                                            <img class="img-thumbnail w-100" style="border-radius:10px;"
                                                 src="{{asset('http://localhost/norgeshandel/public/images/placeholder.png')}}"
                                                 alt="">
                                            </span>
                                        </div>
                                    </div>
                                    <br>
                                    <span class="ads__unit__content__details" style="margin-top:5%;">
                                        <span class="status status--success u-mb0" style="background:#AC304A;border-radius:5px;padding:1px 3px;color:white;">Treff i lagret søk</span>
                                            <span class="u-stone timeago" style="margin-left:10px;" title="time">
                                            &nbsp;
                                            </span>
                                        </span>
                                        <div class="ads__unit__content" style="display:block;width:70%;float:left;">
                                            <h2 class="u-t3 u-mt8" style="margin-top:10px;">
                                            <span class="">{{$search->name}}</span>
                                            </h2>
                                            <p class="u-stone u-t4">
                                                <b>
                                                {{count($search->unread_notifications)<1?"Ingen nye":count($search->unread_notifications)." nye"}}</b>
                                            </p>
                                        </div>
                                </a>
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
    <script>
        $(document).ready(function () {
            $(".timeago").timeago();
        })
    </script>

@endsection
@section('script')
    <script src="{{asset('public/js/time-ago-in-words.min.js')}}"></script>
@endsection
