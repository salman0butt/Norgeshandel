@extends('layouts.landingSite')
<?php $countries = countries(); ?>

@section('page_content')
    <main class="public_profile">
        <div class="dme-container pt-4">
            <div class="col-md-12">
                @include('user-panel.my-business.profile.account-setting-header')
                <br>
                <h3 class="text-center">Betalingshistorikk</h3>
                <p class="text-center">Din betalingshistorikk inneholder alle dine reserverte og gjennomførte ordre. Du
                    kan klikke deg inn på hver ordre får å se bekreftelsen eller kvitteringen.</p>
                <br>
                <h4 class="text-center">Reserverte transaksjoner</h4> <br>
                <p class="text-center">Du har ingen reserverte transaksjoner</p><br>
                <h4 class="text-center">Gjennomførte transaksjoner</h4> <br>
                <p class="text-center">Du har ingen gjennomførte transaksjoner</p><br>
            </div>

        </div>
    </main>
@endsection
