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
        <div class="col-md-12">
            @include('user-panel.my-business.profile.account-setting-header')
            <br>
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
