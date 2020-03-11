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
            <h4>Administrasjon av e-post</h4><br>
            @include('common.partials.flash-messages')
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <div>
                            <form action="{{route('store-user-emails')}}" id="email_management" class="feedback" method="post">
                                @csrf @method('POST')
                                <label>
                                    <span>Legg til en e-post </span>
                                    <input type="tel" name="email" required="required" autofocus="autofocus" id="email" class="dme-form-control">
                                </label>
                                <label>
                                    <span>Bekreft ny e-post </span>
                                    <input type="tel" name="confirm_email" required="required" autofocus="autofocus" id="confirm_email" class="dme-form-control">
                                </label>
                                <p class="d-none email-error-message" style="color: red">Du må fylle ut en gyldig e-postadresse</p>

                                <input type="submit" value="Legg til ny e-post" class="dme-btn-outlined-blue">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="list">
                        <h4>Dine e-postadresser</h4>
                        <hr>
                        <ul class="list-unstyled pl-0">
                            <li><p class="font-weight-bold">{{Auth::user()->email}}</p></li>
                            @if(Auth::user()->email_meta->count() > 0)
                                @foreach(Auth::user()->email_meta as $user_email)
                                    <li>
                                        <span class="float-left mb-2"> {{$user_email->value}}</span>
                                        <span class="float-right mb-2">
                                            @if(\App\Helpers\common::is_account_setting_alt_email_verified($user_email))
                                                <a href="#" type="submit" class="dme-btn-outlined-blue btn-sm" style="padding: 0 5px !important;">bruk</a>
                                            @else
                                                <a href="{{url('/account/verifyemail?email='.$user_email->value)}}" type="submit" class="dme-btn-outlined-blue btn-sm" style="padding: 0 5px !important;">bekreft</a>
                                            @endif
                                            <a href="{{url('/account/deleteemail?email='.$user_email->value)}}" type="submit" class="dme-btn-outlined-blue btn-sm" style="padding: 0 5px !important;">slett</a>
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
    </div>
</main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('keyup', 'input[name="confirm_email"]', function () {

                $('#email_management input[type="submit"]').css('pointer-events', 'auto');
                $('#email_management .email-error-message').addClass('d-none');

                var email = $('input[name="email"]').val();
                var confirm_email = $(this).val();

                if(email != confirm_email){
                    $('#email_management .email-error-message').removeClass('d-none');
                    $('#email_management input[type="submit"]').css('pointer-events', 'none');
                }

            })
        });
    </script>
@endsection
