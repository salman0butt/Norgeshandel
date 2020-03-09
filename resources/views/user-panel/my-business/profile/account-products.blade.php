@extends('layouts.landingSite')
<?php $countries = countries(); ?>

@section('page_content')
    <main class="public_profile">
        <div class="dme-container pt-4">
            <div class="col-md-12">
                @include('user-panel.my-business.profile.account-setting-header')
                <h3>Produkter og abonnement</h3><br>
                <p>Du har ingen abonnement.</p>
            </div>

        </div>
    </main>
@endsection
