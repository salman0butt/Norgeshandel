@extends('layouts.landingSite')
<?php $countries = countries(); ?>
<style>

</style>
@section('page_content')
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
                <a class="nav-link" id="Innløse-tab" data-toggle="tab" href="#Innløse" role="tab"
                    aria-controls="Innløse" aria-selected="false">Innløse</a>
            </li>
        </ul>
<br>
        <div class="col-md-12">
        <h3>Endre profil</h3><br>
        <div id="message">
            <div class="content"></div>
            <div class="close"><i class="icon-cancel-circle"></i></div>
        </div>
        <span>Alle felter merket med <strong>*</strong> er påkrevde felter.</span><br>
        <form action="#" id="settingsFrm" class="feedback" novalidate="novalidate" method="post" style="margin-left:15px;">
            
            <div class="profile-segment first">
                <div class="row clearfix inline-error">
                    <div class="clearfix">
                        <label>
                            Fornavn
                            <input type="text" name="user[name][given_name]" id="given_name" class="dme-form-control">
                        </label>
                        <label>
                            Etternavn
                            <input type="text" name="user[name][family_name]" id="family_name" class="dme-form-control">
                        </label>
                    </div>
                    <div class="clearfix">
                        
                        
                    </div>
                    <ul class="error-container"></ul>
                </div>
                <div class="row clearfix inline-error">
                    <label>
                        Visningsnavn*
                        <input type="text" name="user[display_name]" id="display_name" required="required" class="dme-form-control" value="maxaman945">
                        
                    </label>
                    <ul class="error-container"></ul>
                </div>
                                <div class="row clearfix inline-error">
                    <label class="clearfix">
                        Fødselsdag
                    </label>
                </div>
                <div class="row clearfix form-group">
                                            <input type="text" name="user[birthday][day]" maxlength="2" value="" placeholder="DD" pattern="[0-9]{2}" id="birthday_day" class="regular dme-form-control col-md-2">
                        <input type="text" name="user[birthday][month]" maxlength="2" value="" placeholder="MM" pattern="[0-9]{2}" id="birthday_month" class="regular dme-form-control col-md-2 ml-1 mr-1">
                        <input type="text" name="user[birthday][year]" maxlength="4" value="" placeholder="YYYY" pattern="[0-9]{4}" id="birthday_year" class="regular dme-form-control col-md-2">
                                        <br>
                    
                    <ul class="error-container"></ul>
                </div>
                <p class="example">Eksempel: 14-07-1983</p>
                <div class="row clearfix inline-error">
                    <label>
                        Kjønn
                        <select name="user[gender]" class="dme-form-control" id="UserUserGender"><option value="">Velg</option><option value="male">Mann</option><option value="female">Kvinne</option><option value="other">Andre</option><option value="withheld">Ønsker ikke å oppgi</option></select>
                        
                    </label>
                    <ul class="error-container"></ul>
                </div>
                <ul class="error-container"></ul>
            </div>
            <div class="profile-segment">
                <h4>Adresse</h4>
                                            <fieldset>
                <div class="row clearfix">
            <label>
                Gateadresse
                <input type="text" name="user[addresses][home][street_address]" id="street_address_home" class="dme-form-control">
                
            </label>
        </div>
        <div class="row clearfix">
            <div class="clearfix">
                <label>
                    Postnummer
                    <input type="text" name="user[addresses][home][postal_code]" id="postal_code_home" class="zipcode dme-form-control" pattern="[0-9]*">
                </label>
                <label>
                    Poststed
                    <input type="text" name="user[addresses][home][locality]" id="locality_home" class="locality dme-form-control">
                </label>
            </div>
            <div class="clearfix">
                
                
            </div>
            <ul class="error-container"></ul>
        </div>
        <div class="row clearfix">
            <label>
                Land
                <select name="user[addresses][home][country]" class="country dme-form-control" id="UserUserAddressesHomeCountry"><option value=""></option><option value="NO">Norge</option><option value="SE">Sverige</option><option value="AR">Argentina</option><option value="BE">Belgique</option><option value="BY">Biełaruś</option><option value="BO">Bolivia</option><option value="BR">Brasil</option><option value="CL">Chile</option><option value="CO">Colombia</option><option value="DK">Danmark</option><option value="DE">Deutschland</option><option value="DO">Dominicana</option><option value="IE">Éire</option><option value="GR">Elláda</option><option value="ES">España</option><option value="FR">France</option><option value="GT">Guatemala</option><option value="ID">Indonesia</option><option value="IT">Italia</option><option value="IS">Ísland</option><option value="LU">Lëtzebuerg</option><option value="MA">al-Maghrib</option><option value="HU">Magyarország</option><option value="MY">Malaysia</option><option value="MX">México</option><option value="NL">Nederland</option><option value="AT">Österreich</option><option value="PL">Polska</option><option value="PT">Portugal</option><option value="RU">Rossiya</option><option value="CH">Schweiz</option><option value="FI">Suomi</option><option value="TN">Tūnis</option><option value="GB">United Kingdom</option><option value="US">USA</option><option value="VN">Việt Nam</option></select>
                
            </label>
        </div>
        <input type="hidden" name="user[addresses][home][street_entrance]" id="street_entrance_home" value="">
        <input type="hidden" name="user[addresses][home][street_number]" id="street_number_home" value="">
        <input type="hidden" name="user[addresses][home][type]" id="type_home" value="home">
    </fieldset>
                            </div>
            <div class="profile-segment"><br>
                <h4>Diverse</h4><br>
                <div class="row clearfix">
                    <label>
                        Språk
                        <select name="user[locale]" id="locale" class="dme-form-control" title="Vennligst velg språk"><option value="nb_NO" selected="selected">Norsk</option><option value="sv_SE">Svenska</option><option value="fi_FI">Suomi</option><option value="en_US">English</option></select>
                        
                    </label>
                </div>
            </div><br>
            <div class="row">
                <input type="submit" value="Lagre endringer" class="dme-btn-outlined-blue">
            </div>

</form>
    </div>

    </div>
</main>
@endsection
