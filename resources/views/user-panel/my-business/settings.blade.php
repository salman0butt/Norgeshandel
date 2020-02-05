@extends('layouts.landingSite')

@section('page_content')
<style>
.ts {
    display: block;
    float:left;
    margin:5px;
}
.u-mv32 h3 {
    font-weight:400;
}
.u-mv64 h2 {
    font-weight:400;
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

    <div class="form-group u-mv32">
        <h2>Varslinger</h2>
                <fieldset class="form-std__fieldset">
                    <legend><h3>Nye annonser fra firma jeg følger</h3></legend>
                    <div class="form-grid u-ml0">
                        <div data-controller="notificationsetting" class="ts form-grid__unit input-toggle form-grid__unit--g0">
                            <input type="checkbox" id="check_web_NEW_AD_ON_FOLLOW_COMPANY" data-channel="web" checked="checked" data-type="NEW_AD_ON_FOLLOW_COMPANY">

                            <label for="check_web_NEW_AD_ON_FOLLOW_COMPANY">På FINN</label>
                        </div>

                        <div data-controller="notificationsetting" class="ts form-grid__unit input-toggle form-grid__unit--g0">
                            <input type="checkbox" id="check_email_NEW_AD_ON_FOLLOW_COMPANY" data-channel="email" checked="checked" data-type="NEW_AD_ON_FOLLOW_COMPANY">
                            <label for="check_email_NEW_AD_ON_FOLLOW_COMPANY">E-post</label>
                        </div>

                        <div data-controller="notificationsetting" class="ts form-grid__unit input-toggle form-grid__unit--g0">
                            <input type="checkbox" id="check_app_NEW_AD_ON_FOLLOW_COMPANY" data-channel="app" checked="checked" data-type="NEW_AD_ON_FOLLOW_COMPANY">
                            <label for="check_app_NEW_AD_ON_FOLLOW_COMPANY">App-varsling</label>
                        </div>
                    </div>
                </fieldset>
    </div>

    <div class="form-group u-mv32">
        <fieldset class="form-std__fieldset">
            <legend><h3 class="omgnew">Favoritter på Torget</h3></legend>
                <div data-controller="favoriteNotification" data-medium="Push" data-product="PriceReduced" class="input-toggle">
                    <input type="checkbox" id="fav_price_subscribe" checked="checked">
                    <label for="fav_price_subscribe">Varsle meg i appen når pris blir satt ned</label>
                </div>
                <div data-controller="favoriteNotification" data-medium="Email" data-product="DisposedRecommendation" class="input-toggle">
                    <input type="checkbox" id="fav_disposed_subscribe" checked="checked">
                    <label for="fav_disposed_subscribe">Varsle meg på e-post når en favoritt er markert som solgt</label>
                </div>
        </fieldset>
    </div>

    <div class="form-group u-mv32">
        <h3>Nye annonser fra lagrede søk</h3>
        <p>
            <a href="#">Endre varslinger for lagrede søk</a>
        </p>
    </div>

    <div class="form-group u-mv32">
        <h3>Varslinger i nettleseren</h3>
        <p>Få varslinger direkte i nettleseren, også når FINN er lukket. <a href="#">Les om varslinger på Hjelpesenteret.</a></p>
        <p data-controller="pushSubscribe"><button style="min-width: 220px;" class="button dme-btn-outlined-blue">Slå på for denne enheten</button></p>
    </div>

        <div class="form-group u-mv64 mt-5 mb-5">
            <h2>Innstillinger for meldinger</h2>
            <div data-controller="notificationsetting" class="input-toggle">
                <input type="checkbox" id="check_email_NEW_MESSAGE_IN_INBOX" data-channel="email" checked="checked" data-type="NEW_MESSAGE_IN_INBOX">
                <label for="check_email_NEW_MESSAGE_IN_INBOX">Jeg ønsker kopi av meldinger på FINN.no til e-post.</label>
            </div>
        </div>

</div>
</main>
</div>
​


@endsection