<html lang="nb">
<head>
    <title>NorgesHandel</title>
    <meta charset="UTF-8">
    <script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('public/js/bootstrap.bundle.js')}}"></script>
    <link rel="shortcut icon" href="{{asset('public/images/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!--    <script src="assets/js/fontawesome-all.min.js"></script>-->
    <!--    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">-->
    <link rel="stylesheet" href="{{asset('public/mediexpert.css')}}">
    <link rel="stylesheet" href="{{asset('public/mediexpert-mq.css')}}">
    <!--    incluedes   -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body class="bg-light-grey" cz-shortcut-listen="true">

<main class="" style="margin-top: 60px;margin-bottom: 20px;">
<div class="dme-container">
        <div class="row shadow">
            <div class="col-md-8 text-center bg-maroon-lighter p-5">
                <img src="{{asset('public/images/NorgesHondel-logo.png')}}" alt="" class="mb-3 mt-5">
                <p>Logg inn for å sende meldinger, lagre favoritter og søk. Du får også varsler når det skjer noe nytt!</p>
                <p>Problemer med innloggingen? Her kan du finne <a href="#">hjelp</a></p>
                <p>Tilbake til <a href="#">NorgesHandel</a></p>
            </div>
            <div class="col-md-4 bg-white pt-5 pb-3">
                <form method="POST" action="{{ route('login') }}" id="login_page" name="login_page">
                    @csrf

                    <h3>Logg inn</h3>
                    <div class="form-group ">
                        <label for="email" class="u-t5">Skriv inn din e-postadresse</label>
                        <div class="" style="">
                            <input id="email" type="email" class="dme-form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            Skriv inn din e-postadresse

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="password" class="u-t5">Passord</label>
                        <div class="" style="">
                            <input id="password" type="password" class="dme-form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="" href="{{ route('password.request') }}">
                            Glemt passord?
                        </a>
                    @endif
                    <div class="form-group ">
                        <div class="float-left mt-2">
                            <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" aria-label="Husk meg på denne enheten">Husk meg på denne enheten</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="dme-btn-outlined-blue">
                            Fortsett
                        </button>
                    </div>
                    <a href="{{route('register')}}" class="text-center">Opprette ny konto</a>
                </form>

            </div>
        </div>
    </div>
</main>


</body>
</html>
