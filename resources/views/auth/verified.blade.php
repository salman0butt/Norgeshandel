@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Welcome')}}</div>
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{__('Your Email has been verified successfully')}}
                        </div>
                        <a href="{{url('/')}}"> {{__('Clicking here')}}</a>
                        {{__('to proceed to your account')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
