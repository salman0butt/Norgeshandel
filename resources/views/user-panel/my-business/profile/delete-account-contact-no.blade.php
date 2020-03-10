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
            <h4>Slett telefonnummer</h4><br>
            @include('common.partials.flash-messages')
            <div class="row">
                <div class="col-12">

                    <h6>Er du sikker på at du vil slette  {{'+'.request()->get('phone')}}?</h6>
                </div>
                <div class="col-3 m-auto py-5">
                    <a href="{{url('/account/deletephone?phone='.request()->get('phone').'&delete_phone=yes')}}" type="submit" class="dme-btn-outlined-blue mb-3 text-center" style="width: 223px">Ta bort nummeret</a>
                    <a href="{{url('account/phones')}}" type="submit" class="dme-btn-outlined-blue text-center" style="width: 223px">Behold nummeret</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
