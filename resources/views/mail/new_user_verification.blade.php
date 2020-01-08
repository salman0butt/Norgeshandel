@extends('layouts.landingSite')
@section('page_content')
    <main class="dme-wrepper">
        <div class="container">
            <div style="min-height: 350px;" class="row">
            <div class="col-md-6 offset-md-3 text-center align-self-center">
                <div class="">
                    <img src="{{ asset('public/images/NorgesHondel-logo.png')}}" alt="NorgesHandel" style="max-width: 200px;" class="light-logo img-fluid">
                    <h3 class="u-t3 pt-3">
                        Velkommen
                    </h3>
                    <p>
                        Du er registrert hos NorgesHandel, vennligst <a href="{{url('login')}}">klikk her for å logge inn</a> eller gå til
                        <a href="{{url('/')}}">hjemmesiden.</a>
                    </p>
                </div>
            </div>
            </div>
        </div>
    </main>
@endsection
