@extends('layouts.landingSite')
<?php $countries = countries(); ?>
<style>

</style>
@section('page_content')
    <main class="public_profile">
        <div class="dme-container pt-4">
            <div class="col-md-12">
                @include('user-panel.my-business.profile.account-setting-header')
                <h3 class="pt-4">Endre profil</h3><br>
                @include('common.partials.flash-messages')
                <div id="message">
                    <div class="content"></div>
                    <div class="close"><i class="icon-cancel-circle"></i></div>
                </div>
                <span>Alle felter merket med <strong>*</strong> er påkrevde felter.</span><br>
                <form action="{{route('users.update', $user->id)}}" method="post" style="margin-left:15px;">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <div class="profile-segment first">
                        <div class="row clearfix inline-error">
                            <div class="clearfix">
                                <label>
                                    Fornavn
                                    <input type="text" name="first_name" value="{{$user->first_name}}" id="given_name" class="dme-form-control">
                                </label>
                                <label>
                                    Etternavn
                                    <input type="text" name="last_name" value="{{$user->last_name}}" id="family_name" class="dme-form-control">
                                </label>
                            </div>
                            <div class="clearfix">


                            </div>
                            <ul class="error-container"></ul>
                        </div>
                        <div class="row clearfix inline-error">
                            <label>
                                Visningsnavn*
                                <input type="text" name="username" value="{{$user->username}}" id="display_name" class="dme-form-control" required>

                            </label>
                            <ul class="error-container"></ul>
                        </div>
                        <div class="row clearfix inline-error">
                            <label class="clearfix">
                                Fødselsdag
                                @php
                                    $day = $month = $year = '';
                                    if($user->birthday){
                                        $user_dob = explode('-',$user->birthday);
                                        $day = $user_dob[0] ?  $user_dob[0] : '';
                                        $month = $user_dob[1] ?  $user_dob[1] : '';
                                        $year = $user_dob[2] ?  $user_dob[2] : '';
                                    }
                                @endphp
                            </label>
                        </div>
                        <div class="row clearfix form-group">
                            <input type="text" name="dob_day" maxlength="2" value="{{$day}}" placeholder="DD" pattern="[0-9]{2}" id="birthday_day" class="regular dme-form-control col-md-2">
                            <input type="text" name="dob_month" maxlength="2" value="{{$month}}" placeholder="MM" pattern="[0-9]{2}" id="birthday_month" class="regular dme-form-control col-md-2 ml-1 mr-1">
                            <input type="text" name="dob_year" maxlength="4" value="{{$year}}" placeholder="YYYY" pattern="[0-9]{4}" id="birthday_year" class="regular dme-form-control col-md-2">
                            <br>

                            <ul class="error-container"></ul>
                        </div>
                        <p class="example">Eksempel: 14-07-1983</p>
                        <div class="row clearfix inline-error">
                            <label>
                                Kjønn
                                <select name="gender" class="dme-form-control" id="UserUserGender">
                                    <option value="">Velg</option>
                                    <option value="male" {{$user->gender == 'male' ? 'selected' : ''}}>Mann</option>
                                    <option value="female" {{$user->gender == 'female' ? 'selected' : ''}}>Kvinne</option>
                                    <option value="other"  {{$user->gender == 'other' ? 'selected' : ''}}>Andre</option>
                                    <option value="withheld"  {{$user->gender == 'withheld' ? 'selected' : ''}}>Ønsker ikke å oppgi</option>
                                </select>

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
                                    <input type="text" name="address" value="{{$user->address}}" id="street_address_home" class="dme-form-control">

                                </label>
                            </div>
                            <div class="row clearfix">
                                <div class="clearfix">
                                    <label>
                                        Postnummer
                                        <input type="text" name="zip"  value="{{$user->zip}}" id="postal_code_home" class="zipcode dme-form-control" pattern="[0-9]*">
                                    </label>
                                    <label>
                                        Poststed
                                        <input type="text" name="city" value="{{$user->city}}" id="locality_home" class="locality dme-form-control">
                                    </label>
                                </div>
                                <div class="clearfix">


                                </div>
                                <ul class="error-container"></ul>
                            </div>
                            <div class="row clearfix">
                                <label>
                                    @php
                                        $user_country = 'Norway';
                                        if($user->country){
                                            $user_country = $user->country;
                                        }
                                    @endphp
                                    Land
                                    <select name="country" class="country dme-form-control" id="UserUserAddressesHomeCountry">
                                        <option value="">Velg..</option>
                                        @foreach($countries as $key=>$ctry)
                                            <option value="{{$ctry['name']}}" {{($user_country == $ctry['name'] ? 'selected' : '')}}>{{$ctry['name']}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            {{--<input type="hidden" name="user[addresses][home][street_entrance]" id="street_entrance_home" value="">--}}
                            {{--<input type="hidden" name="user[addresses][home][street_number]" id="street_number_home" value="">--}}
                            {{--<input type="hidden" name="user[addresses][home][type]" id="type_home" value="home">--}}
                        </fieldset>
                    </div>
                    <div class="profile-segment"><br>
                        <h4>Diverse</h4><br>
                        <div class="row clearfix">
                            <label>
                                Språk
                                <select name="user_locale" id="locale" class="dme-form-control" title="Vennligst velg språk"><option value="nb_NO" selected="selected">Norsk</option><option value="sv_SE">Svenska</option><option value="fi_FI">Suomi</option><option value="en_US">English</option></select>

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
