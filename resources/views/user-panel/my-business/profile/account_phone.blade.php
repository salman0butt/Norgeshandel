@extends('layouts.landingSite')
<?php $countries = countries(); ?>
<style>
    input {
        max-width: 350px;
    }

</style>
@section('page_content')
<main class="public_profile">
    <div class="dme-container pt-4">
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
                <a class="nav-link" id="Innløse-tab" data-toggle="tab" href="#Innløse" role="tab"
                    aria-controls="Innløse" aria-selected="false">Innløse</a>
            </li>
        </ul>
        <br>
        <div class="col-md-12">
            <h4>Behandle telefonnummer</h4><br>
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <div>
                            <form action="#" id="addPhoneFrm" class="feedback" method="post" novalidate="novalidate">
                                <label><span>Land </span><br><select name="country_code" id="phoneCountryCode"
                                        class="dme-form-control" style="width: 350px;">
                                        <option value="NO" selected="selected">Norge (+47)</option>
                                        <option value="SE">Sverige (+46)</option>
                                        <option value="FI">Suomi (+358)</option>
                                    </select></label>
                                <label><span>Nytt telefonnummer </span><input type="tel" name="phone_number"
                                        required="required" autofocus="autofocus" id="phonePhoneNumber" class="dme-form-control"></label>
                                <p>Du kan skrive inn både mobilnummere og fasttelefoner.</p>
                                <input type="submit" value="Legg til nytt telefonnummer" class="dme-btn-outlined-blue">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="list">
                        <h4>Dine telefonnummer</h4>
                        <hr>
                        <ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection
