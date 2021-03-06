@extends('layouts.landingSite')

@section('page_content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12 text-center mt-5 mb-5">
            <div class="profile-icon">
                <img src="@if(Auth::user()->media != null){{asset(\App\Helpers\common::getMediaPath(Auth::user()->media))}}@else {{asset('public/images/profile-placeholder.png')}} @endif" alt="Profile image" style="width:100px;height: 100px;border-radius: 50%;">
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
                <a href="{{ url('/messages') }}" style="text-decoration: none;">
                    <span class="font-weight-bold">Meldinger</span>
                </a>
            </li>
            <li class="dme-btn-outlined-blue mb-1">
                <a href="{{ url('/rating') }}" style="text-decoration: none;">
                    <span class="font-weight-bold">Vurderinger</span>
                </a>
            </li>
            <li class="dme-btn-outlined-blue mb-1">
                <a href="{{url('my-business/buy-ads')}}" style="text-decoration: none;">
                    <span class="font-weight-bold">Gi din omtale</span>
                </a>
            </li>

            <li class="dme-btn-outlined-blue mb-1">
                <a href="{{url('my-business/packages')}}" style="text-decoration: none;">
                    <span class="font-weight-bold">Pakker</span>
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
                <a href="{{url('my-business/savedsearches')}}" style="text-decoration: none;">
                    <span class="font-weight-bold">Lagrede søk</span>
                </a>
            </li>
            <li class="dme-btn-outlined-blue mb-1">
                <a href="{{url('my-business/following')}}" style="text-decoration: none;">
                    <span class="font-weight-bold">Firmaer jeg følger</span>
                </a>
            </li>

            @if(Auth::user()->hasRole('company'))
                <li class="dme-btn-outlined-blue mb-1">
                    <a href="{{route('applied-jobs.index')}}" style="text-decoration: none;">
                        <span class="font-weight-bold">Mottatte søknader</span>
                    </a>
                </li>
                <li class="dme-btn-outlined-blue mb-1">
                    <a href="{{route('cv-list')}}" style="text-decoration: none;">
                        <span class="font-weight-bold">CV liste</span>
                    </a>
                </li>
            @endif

            <li class="dme-btn-outlined-blue mb-1">
                <a href="{{route('apply-jobs-list')}}" style="text-decoration: none;">
                    <span class="font-weight-bold">Mine søkte jobber</span>
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
                <a href="{{url('my-business/job-preferences')}}" style="text-decoration: none;">
{{--                <a href="{{ url('/job-pref') }}" style="text-decoration: none;">--}}
                    <span class="font-weight-bold">Mine jobb-preferanser</span>
                </a>
            </li>
            <li class="dme-btn-outlined-blue mb-1 d-none">
                <a href="#" style="text-decoration: none;">
                    <span class="font-weight-bold">Innstillinger for personvern</span>
                </a>
            </li>
            <li class="dme-btn-outlined-blue mb-1">
                <a href="{{ url('/setting') }}" style="text-decoration: none;">
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
