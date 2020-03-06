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
            <h3>Schibsted</h3><br>

            @include('common.partials.flash-messages')
            <form action="{{route('users.update', \Illuminate\Support\Facades\Auth::id())}}" method="post" id="changePasswordFrm" method="post" autocomplete="off">
                {{method_field('PUT')}}
                {{csrf_field()}}
                <input type="hidden" name="profile_submit_type" value="change-password">
                <div class="form-group col-md-6 pl-0">
                    <label title="Du må fylle ut ditt nåværende passord">
                        Ditt gamle passord
                        <input type="password" name="old_password" id="old_password" tabindex="1" required="required"
                            autofocus="autofocus" spellcheck="false" autocorrect="off" class="dme-form-control col-md-12" autocomplete="new-password">
                        <span class="errors" data-errors-for="old_password"></span>
                    </label>
                </div>
                <div class="form-group col-md-5 pl-0">
                    <label title="Minst 8 tegn">
                        Nytt passord for innlogging i Schibsted
                        <small class="field-info">minst 8 tegn</small>
                        <input type="password" name="password" id="password" required="required" autocorrect="off"
                            spellcheck="false" class="dme-form-control" minlength="8">
                        <span class="errors" data-errors-for="password"></span>
                    </label>
                </div>
                <div id="password-meter"><span></span></div>
                <div class="form-group col-md-6 pl-0">
                    <label title="Minst 8 tegn">
                        Bekreft nytt passord
                        <input type="password" name="verify_password" id="verify_password" required="required"
                            autocorrect="off" spellcheck="false" class="dme-form-control" minlength="8">
                        <span class="errors" data-errors-for="verify_password"></span>
                    </label>
                </div>
                <input type="submit" value="Lagre endringer" class="dme-btn-outlined-blue ml-3">
            </form>
        </div>
</main>
@endsection
