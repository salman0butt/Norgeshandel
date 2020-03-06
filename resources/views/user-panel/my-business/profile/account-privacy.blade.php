@extends('layouts.landingSite')
<?php $countries = countries(); ?>

@section('page_content')
    <main class="public_profile">
        <div class="dme-container pt-4">
            <div class="col-md-12">
                @include('user-panel.my-business.profile.account-setting-header')
                <h4 class="pt-3">Les om personvern</h4><br>
                <div class="row col-md-12 pl-0">
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
                <div class="row col-md-12 pl-0">
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
                    {{--<div class="custom-control custom-switch">--}}
                        {{--<input type="checkbox" class="custom-control-input status" id="user_1" checked>--}}
                        {{--<label class="custom-control-label" for="user_1"></label>--}}
                    {{--</div>--}}
                    <p>Hvis du sletter Schibsted-kontoen din, slettes all data og de vil da ikke være tilgjengelig for
                        nedlasting, inkludert nettstedene og tjenestene som er koblet til Schibsted-kontoen din, og
                        eventuelle data knyttet til dem. <a href="#">Les mer</a></p><br>
                </div>
            </div>

        </div>
    </main>
@endsection
