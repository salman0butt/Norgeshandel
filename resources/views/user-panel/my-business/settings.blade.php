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
        <div id="content-start" style="padding: 0px 20px;" class="setting-page">
            <div class="u-mb32 mt-5 mb-5">
                <h1>Innstillinger</h1>
                @include('common.partials.flash-messages')
            </div>
            <form method="POST" id="notification_setting" action="{{route('store_notifications_setting')}}">
                @csrf
                <div class="form-group u-mv32">
                    <h2>Varsler</h2>
                    <fieldset class="form-std__fieldset mt-3">
                        <div class="form-grid u-ml0">
                            <div data-controller="notificationsetting"
                                 class="ts form-grid__unit input-toggle form-grid__unit--g0">
                                <input type="checkbox" id="check_web_NEW_AD_ON_FOLLOW_COMPANY" data-channel="web"
                                       data-type="NEW_AD_ON_FOLLOW_COMPANY" name="notification_new_ad" value="1" {{Auth::user()->notification_meta('notification_new_ad') && Auth::user()->notification_meta('notification_new_ad')->value ? 'checked' : ''}}>
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
                            <input type="checkbox" id="fav_price_subscribe" name="notification_price_changed" value="1"  {{Auth::user()->notification_meta('notification_price_changed') && Auth::user()->notification_meta('notification_price_changed')->value ? 'checked' : ''}}>
                            <label for="fav_price_subscribe">Pris endret</label>
                        </div>
                        <div data-controller="favoriteNotification" data-medium="Email"
                             data-product="DisposedRecommendation" class="input-toggle">
                            <input type="checkbox" id="fav_disposed_subscribe" name="notification_ad_sold" value="1"  {{Auth::user()->notification_meta('notification_ad_sold') && Auth::user()->notification_meta('notification_ad_sold')->value ? 'checked' : ''}}>
                            <label for="fav_disposed_subscribe">Solgt</label>
                        </div>
                    </fieldset>
                </div>
                <div class="form-group mt-4 mb-5">
                    <h2>Meldinger</h2>
                    <div data-controller="notificationsetting" class="input-toggle">
                        <input type="checkbox" id="check_email_NEW_MESSAGE_IN_INBOX" data-channel="email"
                               data-type="NEW_MESSAGE_IN_INBOX" name="notification_email" value="1"  {{Auth::user()->notification_meta('notification_email') && Auth::user()->notification_meta('notification_email')->value ? 'checked' : ''}}>
                        <label for="check_email_NEW_MESSAGE_IN_INBOX">Send kopi på mail for melding til Norges
                            handel</label>
                    </div>
                </div>
                <div class="form-group mt-4 mb-5">
                    <h2>Vurderinger og rangeringer</h2>
                    <div data-controller="notificationsetting" class="input-toggle">
                        <input type="checkbox" id="show_review_ratings" data-channel="email"
                               data-type="show_review_ratings" name="show_ratings_reviews" value="1"  {{Auth::user()->notification_meta('show_ratings_reviews') && Auth::user()->notification_meta('show_ratings_reviews')->value ? 'checked' : ''}}>
                        <label for="show_review_ratings">Vis anmeldelser og rangeringer på offentlig vis</label>
                    </div>
                </div>
                <div class="form-group u-mv32">
                    <p>
                        <a href="javascript:$('#notification_setting').submit();">Endre varsler</a>
                    </p>
                </div>
            </form>

        </div>
    </main>
</div>
@endsection