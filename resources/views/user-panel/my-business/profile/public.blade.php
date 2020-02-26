@extends('layouts.landingSite')
<?php $countries = countries(); ?>
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
                        <h3 class="summary font-weight-normal">Sammendrag12</h3>
                        <div class="about small">{{$user->about_me}}</div>
                    </div>
                </div>
                <div class="col-md-8 pt-4 pb-4">
                    <div class="panel" aria-labelledby="review-list-header">
                        <h3 class="font-weight-normal">Vurderinger</h3>
                        <div class="ratings">
                            <span>Brukeren har ikke fått noen vurderinger</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 pt-4 pb-4">
                    <div class="panel" aria-labelledby="profile-summary-header">
                        <h3 class="summary font-weight-normal">Aktive annonser</h3>
                        <div class="about small">({{count($active_ads)}}) annonser</div>
                    </div>
                </div>
                <div class="col-md-8 pt-4 pb-4">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div style="float: right">
                                {{$active_ads->links()}}
                            </div>
                        </div>
                    </div>
                    @foreach($active_ads as $ad)
                    <?php $ad = \App\Models\Ad::find($ad->id);?>
                        @if($ad->ad_type=='job')
                            @include('user-panel.partials.templates.job-list')
                        @else
                            @include('user-panel.partials.templates.propert-sequare')
                        @endif
                    @endforeach
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div style="float: right">
                                {{$active_ads->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
