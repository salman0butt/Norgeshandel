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
            @include('common.partials.flash-messages')
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <div>
                            <form action="{{route('store-user-contact-no')}}" id="addPhoneFrm" class="feedback" method="post" novalidate="novalidate">
                                @csrf @method('POST')
                                <label>
                                    <span>Land </span><br>
                                    <select name="country_code" id="phoneCountryCode" class="dme-form-control" style="width: 350px;">
                                        <option value="+47" selected="selected">Norge (+47)</option>
                                        <option value="+46">Sverige (+46)</option>
                                        <option value="+358">Suomi (+358)</option>
                                    </select>
                                </label>
                                <label>
                                    <span>Nytt telefonnummer </span>
                                    <input type="tel" name="phone_number" autofocus="autofocus" id="phonePhoneNumber" class="dme-form-control">
                                </label>
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
                        <ul class="list-unstyled pl-0">
                            @if(Auth::user()->contact_no_meta->count() > 0)
                                @foreach(Auth::user()->contact_no_meta as $user_contact_no)
                                    <li>
                                        <span class="float-left mb-2"> {{$user_contact_no->value}}</span>
                                        <span class="float-right mb-2">
                                            <a href="#" type="submit" class="dme-btn-outlined-blue btn-sm" style="padding: 0 5px !important;">bekreft</a>
                                            <a href="{{url('/account/deletephone?phone='.$user_contact_no->value)}}" type="submit" class="dme-btn-outlined-blue btn-sm" style="padding: 0 5px !important;">slett</a>
                                        </span>
                                    </li>
                                    <div class="clearfix"></div>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection
