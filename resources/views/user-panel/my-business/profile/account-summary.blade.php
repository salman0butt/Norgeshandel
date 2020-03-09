@extends('layouts.landingSite')
<?php $countries = countries(); ?>
<style>
    .left {
        width: 250px;
    }

    tr {
        line-height: 40px;
    }

    .l-break {
        display: block;
    }

    .toggle.ios,
    .toggle-on.ios,
    .toggle-off.ios {
        border-radius: 20px;
    }

    .toggle.ios .toggle-handle {
        border-radius: 20px;
    }

    .site-header .site-logo {
        margin: 0;
        padding: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
        width: 3em;
        height: 3em;
        border-radius: 100%;
        text-align: center;
        border: 1px solid #979797;
        background-color: #f8f8f8;
        color: #b6b6b6;
        text-transform: uppercase;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
    }

</style>
@section('page_content')
    <main class="public_profile">
        <div class="dme-container pt-4">
            <div class="col-md-12">
                @include('user-panel.my-business.profile.account-setting-header')
                <div class="main-content">

                    <div class="col-md-12 pl-0">
                        <div>
                            <h4>Oversikt</h4><br>
                            <div class="summary-box first">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="left">Om deg</td>
                                        <td class="right">Ikke gitt</td>
                                    </tr>
                                    <tr>
                                        <td class="left"></td>
                                        <td class="right"><a href="{{url('/account/setting')}}">Endre profil</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                            <div class="summary-box">
                                <h4>Sikkerhet</h4><br>
                                <div class="summary-box first">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td class="left">Passord</td>
                                            <td class="right"><a href="{{url('account/chnagepassword')}}">Endre passord</a></td>
                                        </tr>
                                        <tr>
                                            <td class="left">Logg ut fra alle enheter</td>
                                            <td class="right"><a href="#"><a href="#">Logg ut</a></a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                </div>
                                <div class="summary-box">
                                    <h4>E-post og telefonnummer</h4><br>
                                    <div class="summary-box first">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td class="left">E-post</td>
                                                <td class="right">{{Auth::user()->email}}<span
                                                            class="text-muted">(Primær)</span> <span class="l-break"><a
                                                                href="#">Behandle e-postadresse</a></span></td>
                                            </tr>
                                            <tr>
                                                <td class="left">Telefonnummer</td>
                                                <td class="right"><span class="l-break"><a
                                                                href="{{url('account/phones')}}">Behandle telefonnummer</a></span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                    </div>
                                </div>

                                <div class="summary-box">
                                    <h4>Lagrede betalingsmåter</h4><br>
                                    <div class="summary-box first">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td class="left">Kort</td>
                                                <td class="right"><a href="#">Legg til kort</a></td>
                                            </tr>
                                            <tr>
                                                <td class="left">Strex telefonnummer</td>
                                                <td class="right"><a href="#">Legg til telefonnummer</a></td>
                                            </tr>
                                            <tr>
                                                <td class="left">Klarna faktura leveringsmåte</td>
                                                <td class="right"><a href="#">Legg til fakturaadresse eller
                                                        epost</a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                    </div>
                                    <div class="summary-box">
                                        <h4>Mine nettsteder og tjenester</h4>
                                        <p>
                                            Dette er nettstedene og tjenestene som er tilknyttet Schibsted-kontoen din.
                                        </p><br>
                                        <div class="site-container">
                                            <div class="site-header">
                                                <div class="site-logo" style="display:block;float:left;">N</div>
                                                <h3 class="site-name" style="display:block;float:left;">
                                                    &nbsp;Norgeshandel.no</h3>
                                                <div class="text-right">
                                                    <a href="#">Fjern</a>
                                                </div>
                                            </div>
                                            <div class="site-services" style="clear:both;margin-left:60px;">
                                                Norgeshandel.no</div>
                                        </div><br><br>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
