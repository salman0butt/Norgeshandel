@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <h4 class="p-4" style="padding-bottom: 0px !important;">{{ __('Glemt passordet ditt?') }}</h4>

                <div class="card-body p-4" style="padding-top: 0px !important;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                            <label for="email" class="col-md-6 col-form-label">{{ __('E-post') }}</label>
                        <div class="form-group row">


                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block" style="background-color:#AC304A;">
                                    {{ __('Tilbakestill passord') }}
                                </button>
                            {{-- <a href="#" class="btn btn-primary btn-block"  style="background-color:#AC304A;">Back to home</a> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="c-layout__footer">
    <div class="c-layout__container">


<footer class="media mvm">
    <div class="img">
                    <a href="{{ url('/') }}" class="subtle nowrap">
                « Tilbake til Norgeshandel
            </a>
            </div>
    <div class="bd alright">
        <a href="#" class="nowrap subtle mls" target="_blank">Hjelp</a>&nbsp;
        <a href="#" class="nowrap subtle mls">Betingelser</a>&nbsp;
        <a href="#" class="nowrap subtle mls">Personvernerklæring</a>&nbsp;
        <a href="#" class="nowrap subtle mls" target="_blank">Om Norges Handel</a>
    </div>
</footer>
<style>
    .alright a {
        padding:5px 10px;
        float: right;
    }
    a {
        color: #AC304A;
    }
</style>

    </div><!-- / .c-layout__container -->
</div>

        </div>
    </div>
</div>
@endsection
