@extends('layouts.landingSite')
<?php $countries = countries(); ?>

@section('style')
    <style>
        .numberCircle {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            padding: 5px;
            background: #233871;
            border: 2px solid #666;
            color: white;
            text-align: center;
            font-size: 22px;
            font-weight: 600;
        }
    </style>
@endsection
@section('page_content')
    <main class="public_profile">
        <div class="dme-container pt-4">
            <div class="breade-crumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">NorgesHandel </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
                    </ol>
                </nav>
            </div>
            <div class="row ml-0 mr-0 mt-3 p-4 bg-maroon-lighter radius-8">
                <div role="heading" class="col-md-3">
                    <div class="avatar">
                            <img
                                src="@if(isset($user) && $user->media!=null){{asset(\App\Helpers\common::getMediaPath($user->media, '150x150'))}}@else {{asset('public/admin/images/users/1.jpg')}} @endif"
                                id="cv_profile_image"
                                style="width:150px;height:150px;border-radius: 50%;" alt="">
                    </div>
                </div>

                <div class="col-md-9 align-self-center">
                    <div class="username"><span style="font-size: 26px">{{$user->username}}</span>
                        {{--<span class="text-muted">({{$user->username}})</span>--}}
                    </div>
                    <div class="small age">Medlem siden {{$user->created_at->year}}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 pt-4 pb-4">
                    <div class="panel" aria-labelledby="profile-summary-header">
                        <h3 class="summary font-weight-normal">Sammendrag</h3>
                        @if($ratings->count())

                            @php
                                $avg = $user->received_ratings->count() > 0 ? $user->received_ratings->avg('general_ratings') : '0';
                                $communication_ratings_avg = $user->received_ratings->count() > 0 ? $user->received_ratings->avg('communication_ratings') : '0';
                                $delivery_ratings_avg = $user->received_ratings->count() > 0 ? $user->received_ratings->avg('delivery_ratings') : '0';
                                $description_ratings_avg = $user->received_ratings->count() > 0 ? $user->received_ratings->avg('description_ratings') : '0';
                                $payment_ratings_avg = $user->received_ratings->count() > 0 ? $user->received_ratings->avg('payment_ratings') : '0';
                            @endphp
                            @if($user->notification_meta('show_ratings_reviews') && $user->notification_meta('show_ratings_reviews')->value == 1)
                                <div class="p-3 bg-maroon-lighter radius-8">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="numberCircle">{{$avg}}</div>
                                        </div>
                                        <div class="col-9 pl-0">
                                            <h6 class="mb-0">Urmerket</h6>
                                            <p>{{$user->received_ratings->count()}} vurderinger</p>
                                        </div>

                                        @if($communication_ratings_avg >= 6)
                                            <div class="col-3">
                                                <img src="{{asset('public/images/Very-good-communication-icon.png')}}" width="23px" class="float-right">
                                            </div>
                                            <div class="col-9 pl-0">
                                                <p class="mb-1">Veldig good kommunikasjon</p>
                                            </div>
                                        @endif

                                        @if($delivery_ratings_avg >= 6)
                                            <div class="col-3">
                                                <img src="{{asset('public/images/Seamless-delivery-icon.png')}}" width="23px" class="float-right">
                                            </div>
                                            <div class="col-9 pl-0">
                                                <p class="mb-1">Problemfri overlevering</p>
                                            </div>
                                        @endif

                                        @if($description_ratings_avg >= 6)
                                            <div class="col-3">
                                                <img src="{{asset('public/images/Exact-description-icon.png')}}" width="23px" class="float-right">
                                            </div>
                                            <div class="col-9 pl-0">
                                                <p class="mb-1">Nøyaktig beskrivelse</p>
                                            </div>
                                        @endif

                                        @if($payment_ratings_avg >= 6)
                                            <div class="col-3">
                                                <img src="{{asset('public/images/Hassle-free-payment-icon.png')}}" width="23px" class="float-right">
                                            </div>
                                            <div class="col-9 pl-0">
                                                <p class="mb-1">Problemfri betaling</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-md-8 pt-4 pb-4">
                    <div class="panel" aria-labelledby="review-list-header">
                        <h3 class="font-weight-normal">Vurderinger</h3>
                        <div class="ratings ratings-section">
                            @if($ratings->count() > 0)
                                @if($user->notification_meta('show_ratings_reviews') && $user->notification_meta('show_ratings_reviews')->value == 1)
                                    @include('user-panel.my-business.public-user-rating-inner')
                                @else
                                    Bruker skjule anmeldelser og rangeringer.
                                @endif
                            @else
                                Brukeren har ikke fått noen vurderinger
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 pt-4 pb-4">
                    <div class="panel" aria-labelledby="profile-summary-header">
                        <h3 class="summary font-weight-normal">Aktive annonser</h3>
                        <div class="about small">({{$count_active_ads}}) annonser</div>
                    </div>
                </div>
                <div class="col-md-8 pt-4 pb-4">
                    <div class="public-user-ads-section">
                        @include('user-panel.my-business.public-user-ads-inner')
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
