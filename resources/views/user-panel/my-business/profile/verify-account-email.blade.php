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
            <h4>Bekreftelse av e-post</h4><br>
            @include('common.partials.flash-messages')
            <div class="row mb-4">
                <div>
                    <img src="{{asset('public/images/gif-mail.gif')}}" alt="">
                    <p class="pt-3">
                        For å bekrefte at du registrerte deg med korrekt e-postadresse har vi sendt en e-post til
                        <br>
                        <span class="email font-weight-bold">{{Request()->get('email')}}</span>
                    </p>
                    <p>Gå til e-posten din og klikk på lenken for å bekrefte e-postadressen.</p>
                    <a href="#" class="code-verify" id="code-verify">Fungerer ikke linken?</a>
                </div>
                {{--<div class="col-12">--}}
                    {{--<h6>Er du sikker på at du vil slette  {{request()->get('email')}}?</h6>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</main>
@endsection
