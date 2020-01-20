@extends('layouts.landingSite')

@section('page_content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12 text-center mt-5 mb-5">
            <div class="profile-icon">
                <img src="@if(Auth::user()->media!=null){{asset(\App\Helpers\common::getMediaPath(Auth::user()->media))}}@else {{asset('public/images/profile-placeholder.png')}} @endif" alt="Profile image" style="width:100px;height: 100px;border-radius: 50%;">
            </div>
            <div class="profile-name">
                <h2 class="text-muted">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h2>
            </div>
        </div>
        <div class="col-md-12">
            <a href="#" style="text-decoration: none">
                <div class="alert alert-warning"><i class="fas fa-shield-alt"></i> Vennligst bekreft identiteten
                    din ved å klikke her.
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <ul class="list-unstyled col-md-4">
            <li class="dme-btn-outlined-blue mb-1">
                <a href="{{url('my-business/my-ads')}}" style="text-decoration: none;">
                    <span class="font-weight-bold">Mine annonser</span>
                </a>
            </li>
            <li class="dme-btn-outlined-blue mb-1">
                <a href="#" style="text-decoration: none;">
                    <span class="font-weight-bold">Meldinger</span>
                </a>
            </li>
            <li class="dme-btn-outlined-blue mb-1">
                <a href="#" style="text-decoration: none;">
                    <span class="font-weight-bold">Vurderinger</span>
                </a>
            </li>
        </ul>
        <ul class="list-unstyled col-md-4">
            <li class="dme-btn-outlined-blue mb-1">
                <a href="{{url('my-business/favorites')}}" style="text-decoration: none;">
                    <span class="font-weight-bold">Favoritter</span>
                </a>
            </li>
            <li class="dme-btn-outlined-blue mb-1">
                <a href="#" style="text-decoration: none;">
                    <span class="font-weight-bold">Lagrede søk</span>
                </a>
            </li>
            <li class="dme-btn-outlined-blue mb-1">
                <a href="#" style="text-decoration: none;">
                    <span class="font-weight-bold">Firmaer jeg følger</span>
                </a>
            </li>
        </ul>
        <ul class="list-unstyled col-md-4">
            <li class="dme-btn-outlined-blue mb-1">
                <a href="{{url('my-business/cv')}}" style="text-decoration: none;">
                    <span class="font-weight-bold">Min CV</span>
                </a>
            </li>
            <li class="dme-btn-outlined-blue mb-1">
                <a href="{{url('my-business/profile')}}" style="text-decoration: none;">
                    <span class="font-weight-bold">Endre profil</span>
                </a>
            </li>
            <li class="dme-btn-outlined-blue mb-1">
{{--                <a href="{{url('my-business/job-preferences')}}" style="text-decoration: none;">--}}
                <a href="#" style="text-decoration: none;">
                    <span class="font-weight-bold">Mine jobb-preferanser</span>
                </a>
            </li>
            <li class="dme-btn-outlined-blue mb-1">
                <a href="#" style="text-decoration: none;">
                    <span class="font-weight-bold">Innstillinger for personvern</span>
                </a>
            </li>
            <li class="dme-btn-outlined-blue mb-1">
                <a href="#" style="text-decoration: none;">
                    <span class="font-weight-bold">Innstillinger</span>
                </a>
            </li>
            <li class="dme-btn-outlined-blue">
                <a href="{{url('logout')}}" style="text-decoration: none;">
                    <span class="font-weight-bold">Logg ut</span>
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection
