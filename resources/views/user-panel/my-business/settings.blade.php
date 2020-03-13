@extends('layouts.landingSite')

@section('page_content')
<style>
    .ts {
        display: block;
        float: left;
        margin: 5px;
    }

    .u-mv32 h3 {
        font-weight: 400;
    }

    .u-mv64 h2 {
        font-weight: 400;
    }

</style>
<div class="dme-container">
    <main class="pageholder">
        {{-- <div class="panel">
    <nav aria-label="Her er du">
        <ul class="breadcrumbs" role="presentation">
            <li><a href="#">Min FINN</a> / &nbsp; </li> 
            <li><span aria-current="page"> Innstillinger</span></li>
        </ul>
    </nav>
</div> --}}
        <div id="content-start">
            <div class="u-mb32 mt-5 mb-5">
                <h1>Innstillinger</h1>
            </div>
            <form method="POST" action="{{route('store_notifications_setting')}}">
                @csrf
                <div class="form-group u-mv32">
                    <h2>Varsler</h2>
                    <fieldset class="form-std__fieldset mt-4">
                        <div class="form-grid u-ml0">
                            <div data-controller="notificationsetting"
                                 class="ts form-grid__unit input-toggle form-grid__unit--g0">
                                <input type="checkbox" id="check_web_NEW_AD_ON_FOLLOW_COMPANY" data-channel="web"
                                       checked="checked" data-type="NEW_AD_ON_FOLLOW_COMPANY">
                                <label for="check_web_NEW_AD_ON_FOLLOW_COMPANY">Varsler for nye annonser</label>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="form-group u-mv32">
                    <fieldset class="form-std__fieldset">
                        <legend>
                            <h2 class="omgnew">Favoritter</h2>
                        </legend>
                        <div data-controller="favoriteNotification" data-medium="Push" data-product="PriceReduced"
                             class="input-toggle">
                            <input type="checkbox" id="fav_price_subscribe" checked="checked">
                            <label for="fav_price_subscribe">Pris endret</label>
                        </div>
                        <div data-controller="favoriteNotification" data-medium="Email"
                             data-product="DisposedRecommendation" class="input-toggle">
                            <input type="checkbox" id="fav_disposed_subscribe" checked="checked">
                            <label for="fav_disposed_subscribe">Solgt</label>
                        </div>
                    </fieldset>
                </div>
                <div class="form-group mt-4 mb-5">
                    <h2>Meldinger</h2>
                    <div data-controller="notificationsetting" class="input-toggle">
                        <input type="checkbox" id="check_email_NEW_MESSAGE_IN_INBOX" data-channel="email" checked="checked"
                               data-type="NEW_MESSAGE_IN_INBOX">
                        <label for="check_email_NEW_MESSAGE_IN_INBOX">Send kopi på mail for melding til Norges
                            handel</label>
                    </div>
                </div>
                <div class="form-group u-mv32">
                    <p>
                        <a href="#">Endre varsler</a>
                    </p>
                </div>
            </form>

        </div>
    </main>
</div>
​


@endsection
