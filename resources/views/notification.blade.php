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
                <a class="m-2" href="#">Innstillinger</a>
            </div>
            <div class="row">
                <article class="col-md-12 pl-0 pr-0 list-ad">
                    <div class="ads__unit__img"
                        style="max-width: 160px;display:block;width:23%;float:left; margin:5px;">
                        <div class="ads__unit__img__ratio">
                            <img class="img-thumbnail w-100" style="border-radius:10px;"
                                src="https://images.finncdn.no/dynamic/480w/2019/11/vertical-5/28/2/164/396/282_1962659937.jpg"
                                alt="">
                        </div>
                    </div>
                    <br>
                    <span class="ads__unit__content__details" style="margin-top:5%;">
                        <span class="status status--success u-mb0"
                            style="background:#AC304A;border-radius:5px;padding:1px 3px;color:white;">Treff i lagret
                            søk</span>
                        <span class="u-stone" style="margin-left:10px;">
                            <time datetime="2020-01-28T04:52:52.105Z">1 time siden</time>
                        </span>
                    </span>
                    <div class="ads__unit__content" style="display:block;width:70%;float:left;">
                        <h2 class="ads__unit__content__title u-t3 u-mt8" style="margin-top:10px;">
                            <a data-controller="handleNotificationClick" data-notification-group-key="38366367"
                                data-notification-type="NEW_AD_ON_SAVED_SEARCH" href="#" class="ads__unit__link">
                                'house doctor', Møbler og interiør, Torget
                            </a>
                        </h2>

                        <p class="u-stone u-t4"><b>10 nye</b></p>
                    </div>
                </article>
                <article class="col-md-12 pl-0 pr-0 list-ad">
                    <div class="ads__unit__img"
                        style="max-width: 160px;display:block;width:23%;float:left; margin:5px;">
                        <div class="ads__unit__img__ratio">
                            <img class="img-thumbnail w-100" style="border-radius:10px;"
                                src="https://images.finncdn.no/dynamic/480w/2019/11/vertical-5/28/2/164/396/282_1962659937.jpg"
                                alt="">
                        </div>
                    </div>
                    <br>
                    <span class="ads__unit__content__details" style="margin-top:5%;">
                        <span class="status status--success u-mb0"
                            style="background:#AC304A;border-radius:5px;padding:1px 3px;color:white;">Treff i lagret
                            søk</span>
                        <span class="u-stone" style="margin-left:10px;">
                            <time datetime="2020-01-28T04:52:52.105Z">1 time siden</time>
                        </span>
                    </span>
                    <div class="ads__unit__content" style="display:block;width:70%;float:left;">
                        <h2 class="ads__unit__content__title u-t3 u-mt8" style="margin-top:10px;">
                            <a data-controller="handleNotificationClick" data-notification-group-key="38366367"
                                data-notification-type="NEW_AD_ON_SAVED_SEARCH" href="#" class="ads__unit__link">
                                'house doctor', Møbler og interiør, Torget
                            </a>
                        </h2>

                        <p class="u-stone u-t4"><b>10 nye</b></p>
                    </div>
                </article>
                <article class="col-md-12 pl-0 pr-0 list-ad">
                    <div class="ads__unit__img"
                        style="max-width: 160px;display:block;width:23%;float:left; margin:5px;">
                        <div class="ads__unit__img__ratio">
                            <img class="img-thumbnail w-100" style="border-radius:10px;"
                                src="https://images.finncdn.no/dynamic/480w/2019/11/vertical-5/28/2/164/396/282_1962659937.jpg"
                                alt="">
                        </div>
                    </div>
                    <br>
                    <span class="ads__unit__content__details" style="margin-top:5%;">
                        <span class="status status--success u-mb0"
                            style="background:#AC304A;border-radius:5px;padding:1px 3px;color:white;">Treff i lagret
                            søk</span>
                        <span class="u-stone" style="margin-left:10px;">
                            <time datetime="2020-01-28T04:52:52.105Z">1 time siden</time>
                        </span>
                    </span>
                    <div class="ads__unit__content" style="display:block;width:70%;float:left;">
                        <h2 class="ads__unit__content__title u-t3 u-mt8" style="margin-top:10px;">
                            <a data-controller="handleNotificationClick" data-notification-group-key="38366367"
                                data-notification-type="NEW_AD_ON_SAVED_SEARCH" href="#" class="ads__unit__link">
                                'house doctor', Møbler og interiør, Torget
                            </a>
                        </h2>

                        <p class="u-stone u-t4"><b>10 nye</b></p>
                    </div>
                </article>
            </div>
            <div data-controller="newnotificationscountreset"></div>
        </div>
    </main>

</div>

@endsection
