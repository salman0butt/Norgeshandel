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
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

</style>
@section('page_content')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<main class="public_profile">
    <div class="dme-container pt-4">
        <a href="{{ url('/') }}">« Tilbake til Norgeshandel.no</a><br><br>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="Konto-tab" data-toggle="tab" href="#Konto" role="tab"
                    aria-controls="Konto" aria-selected="true">Konto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="Personvern-tab" data-toggle="tab" href="#Personvern" role="tab"
                    aria-controls="Personvern" aria-selected="false">Personvern</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="Betalingshistorikk-tab" data-toggle="tab" href="#Betalingshistorikk" role="tab"
                    aria-controls="Betalingshistorikk" aria-selected="false">Betalingshistorikk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="Produkter-tab" data-toggle="tab" href="#Produkter" role="tab"
                    aria-controls="Produkter" aria-selected="false">Produkter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="Innløse-tab" data-toggle="tab" href="#Innløse" role="tab" aria-controls="Innløse" aria-selected="false">Innløse</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="Konto" role="tabpanel" aria-labelledby="Konto-tab">

                <div class="main-content">
                    <br>
                    <div class="col-md-12">
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
                                            <td class="right"><a href="#">Endre profil</a></td>
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
                                                <td class="right"><a href="#">Endre passord</a></td>
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
                                                    <td class="right">maxaman945@smlmail.net <span
                                                            class="text-muted">(Primær)</span> <span class="l-break"><a
                                                                href="#">Behandle e-postadresse</a></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="left">Logg ut fra alle enheter</td>
                                                    <td class="right"><a href="#"><a href="#">Logg ut</a></a></td>
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
            <div class="tab-pane fade" id="Personvern" role="tabpanel" aria-labelledby="Personvern-tab"><br>

                <h4 class="ml-2">Les om personvern</h4><br>
                <div class="row col-md-12">
                    <div class="col-sm-9">
                        <h6>Schibsteds dataomvisning</h6>
                        <p>Ta denne raske omvisningen for bedre å forstå hvordan vi håndterer data og hvilke
                            personvernvalg du har.</p>
                        <a href="#">Ta omvisningen <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                    <div class="col-md-3">
                        <img src="https://d3iwtia3ndepsv.cloudfront.net/core/3.27.1/images/account/privacy-settings/artboard-1.png"
                            alt="">
                    </div><br>
                </div><br><br>
                <div class="row col-md-12">
                    <div class="col-sm-9">
                        <h6>Les mer om personvern</h6>
                        <p>Vi har laget noen lettleselige artikler om det grunnleggende rundt data og personvern i
                            henhold til Schibsted-kontoen din.</p>
                        <a href="#">Se alle artiklene <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                    <div class="col-md-3">
                        <img src="https://d3iwtia3ndepsv.cloudfront.net/core/3.27.1/images/account/privacy-settings/artboard-1-copy.png"
                            alt="">
                    </div><br>
                </div>
                <hr>
                <h4>Personvernvalg</h4>
                <div class="content">
                    <a href="#">Innstillinger for smarte annonser <i class="fas fa-long-arrow-alt-right"></i></a>
                    <p>Juster hvilke områder av dataprofilen som skal brukes til å koble deg til smarte annonser. <a
                            href="#">Les mer</a></p><br>
                </div>
                <div class="content">
                    <a href="#">Last ned mine data <i class="fas fa-long-arrow-alt-right"></i></a>
                    <p>Med dette samles alle dataene fra nettsidene og tjenestene koblet til Schibsted-kontoen din i et
                        filarkiv som du kan laste ned og se i frakoblet modus. <a href="#">Les mer</a></p><br>
                </div>
                <div class="content">
                    <a href="#">Slett min konto <i class="fas fa-long-arrow-alt-right"></i></a>
                    <p>Hvis du sletter Schibsted-kontoen din, slettes all data og de vil da ikke være tilgjengelig for
                        nedlasting, inkludert nettstedene og tjenestene som er koblet til Schibsted-kontoen din, og
                        eventuelle data knyttet til dem. <a href="#">Les mer</a></p><br>
                </div>
                <div class="content">
                    <a href="#">Hjelp oss å bli bedre</a>&emsp;<input type="checkbox" checked data-toggle="toggle"
                        data-style="ios">
                    <p>Hvis du sletter Schibsted-kontoen din, slettes all data og de vil da ikke være tilgjengelig for
                        nedlasting, inkludert nettstedene og tjenestene som er koblet til Schibsted-kontoen din, og
                        eventuelle data knyttet til dem. <a href="#">Les mer</a></p><br>
                </div>
            </div>
            <div class="tab-pane fade" id="Betalingshistorikk" role="tabpanel" aria-labelledby="Betalingshistorikk-tab">
                <br>
                <h3 class="text-center">Betalingshistorikk</h3>
                <p class="text-center">Din betalingshistorikk inneholder alle dine reserverte og gjennomførte ordre. Du
                    kan klikke deg inn på hver ordre får å se bekreftelsen eller kvitteringen.</p>
                <br>
                <h4 class="text-center">Reserverte transaksjoner</h4> <br>
                <p class="text-center">Du har ingen reserverte transaksjoner</p><br>
                <h4 class="text-center">Gjennomførte transaksjoner</h4> <br>
                <p class="text-center">Du har ingen gjennomførte transaksjoner</p><br>
            </div>
            
            <div class="tab-pane fade" id="Produkter" role="tabpanel" aria-labelledby="Produkter-tab">
                <br>
                <h3>Produkter og abonnement</h3><br>
                <p>Du har ingen abonnement.</p>
            </div>
            <div class="tab-pane fade" id="Innløse" role="tabpanel" aria-labelledby="Innløse-tab">
                     <br>
                <h3>Rabattkoder</h3><br>
                <div class="col-md-6">
                <label for="Kupongkode">Kupongkode</label>
                <input type="text" class="dme-form-control"><br>
                <input type="submit" class="dme-btn-outlined-blue mt-3" value="Løs inn rabattkode">
                </div>
                <br><br>
            </div>
        </div>
    </div>
</main>
@endsection
