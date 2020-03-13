@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Velkommen til Norges Handel')}}</div>
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{__('Sjekk din e-post for verifisering.')}} <br> <a href="{{url('/')}}">Velkommen til Norges Handel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
