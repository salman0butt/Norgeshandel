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
            <h3>Schibsted</h3><br>
            <form action="#" id="changePasswordFrm" method="post" novalidate="novalidate">
            <div class="form-group col-md-6">
                <label title="Du må fylle ut ditt nåværende passord">
                    Ditt gamle passord
                    <input type="password" name="old_password" id="old_password" tabindex="1" required="required"
                        autofocus="autofocus" spellcheck="false" autocorrect="off" class="dme-form-control col-md-12">
                    <span class="errors" data-errors-for="old_password"></span>
                </label>
                </div>
                <div class="form-group col-md-5">
                <label title="Minst 8 tegn">
                    Nytt passord for innlogging i Schibsted
                    <span class="field-info">minst 8 tegn</span>
                    <input type="password" name="password" id="password" required="required" autocorrect="off"
                        spellcheck="false" class="dme-form-control">
                    <span class="errors" data-errors-for="password"></span>
                </label>
                </div>
                <div id="password-meter"><span></span></div>
                <div class="form-group col-md-6">
                <label title="Minst 8 tegn">
                    Bekreft nytt passord
                    <input type="password" name="verify_password" id="verify_password" required="required"
                        autocorrect="off" spellcheck="false" class="dme-form-control">
                    <span class="errors" data-errors-for="verify_password"></span>
                </label>
                </div>
                <input type="submit" value="Lagre endringer" class="dme-btn-outlined-blue ml-3">
            </form>
        </div>
</main>
@endsection
