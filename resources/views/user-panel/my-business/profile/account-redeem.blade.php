@extends('layouts.landingSite')
<?php $countries = countries(); ?>

@section('page_content')
    <main class="public_profile">
        <div class="dme-container pt-4">
            <div class="col-md-12">
                @include('user-panel.my-business.profile.account-setting-header')
                <h3>Rabattkoder</h3><br>
                <div class="col-md-6 pl-0">
                    <label for="Kupongkode">Kupongkode</label>
                    <input type="text" class="dme-form-control"><br>
                    <input type="submit" class="dme-btn-outlined-blue mt-3" value="Løs inn rabattkode">
                </div>
                <br><br>
            </div>

        </div>
    </main>
@endsection
