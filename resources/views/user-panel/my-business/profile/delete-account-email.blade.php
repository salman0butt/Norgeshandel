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
            <h4>Slett e-post</h4><br>
            @include('common.partials.flash-messages')
            <div class="row">
                <div class="col-12">

                    <h6>Er du sikker på at du vil slette  {{request()->get('email')}}?</h6>
                </div>
                <div class="col-3 m-auto py-5">
                    <a href="{{url('/account/deleteemail?email='.request()->get('email').'&delete_email=yes')}}" type="submit" class="dme-btn-outlined-blue mb-3 text-center" style="width: 223px">Slett e-post</a>
                    <a href="{{url('account/emails')}}" type="submit" class="dme-btn-outlined-blue text-center" style="width: 223px">Behold e-posten </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
