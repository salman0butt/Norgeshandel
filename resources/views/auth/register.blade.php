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

<main class="register-main" style="margin-top: 60px;margin-bottom: 20px;">
<div class="dme-container">
        <div class="row shadow">
            <div class="col-md-8 text-center bg-maroon-lighter p-5">
                <img src="{{asset('public/images/NorgesHondel-logo.png')}}" alt="" class="mb-3 mt-5 register-img">
                <p>Logg inn for å personalisere Norgeshandel, lagre søk, chat, varsler.</p>
                <p><a href="{{ url('/customer-services') }}" class="mr-4">Hjelp</a> Tilbake til <a href="{{ url('/') }}">NorgesHandel</a></p>
            </div>
            <div class="col-md-4 bg-white p-3" id="register_page">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h3>Registrer her</h3>
                    <div class="form-group hide">
                        <label for="first_name" class="u-t5">Fornavn</label>
                        <div class="" style="">
                            <input id="first_name" type="text" class="dme-form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" autofocus>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group hide">
                        <label for="last_name" class="u-t5">Etternavn</label>
                        <div class="" style="">
                            <input id="last_name" type="text" class="dme-form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" autofocus>

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group hide">
                        <label for="username" class="u-t5">Brukernavn</label>
                        <div class="" style="">
                            <input id="username" type="text" class="dme-form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="email" class="u-t5">E-post</label>
                        <div class="" style="">
                            <input id="email" type="email" class="dme-form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="u-t5">Passord</label>
                        <div class="">
                            <input id="password" type="password" class="dme-form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group hide">
                        <label for="password-confirm" class="u-t5">Bekreft passord</label>

                        <div class="">
                            <input id="password-confirm" type="password" class="dme-form-control" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="float-left mt-2">
                            <input id="radiuscheckbox" type="checkbox" name="radius" value="10000" data-geo-filter-checkbox="">
                            <label for="radiuscheckbox" aria-label="Husk meg på denne enheten">Husk meg på denne enheten</label>
                        </div>
                    </div>
                       
                    <div class="form-group">
                 <br>
                 <br>
                        <button type="submit" class="dme-btn-outlined-blue mt-3">
                            Fortsett
                        </button>
                    </div>
                    <a href="{{route('login')}}" class="text-center">Logg inn</a>
                </form>
            </div>
        </div>
    </div>
</main>


</body>
</html>
