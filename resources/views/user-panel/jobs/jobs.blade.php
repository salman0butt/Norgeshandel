@extends('layouts.landingSite')
   <style>
        ul {
            list-style: none;
            padding-left: 5px !important;
        }

    </style>
@section('page_content')
<main class="dme-wrapper">
    <div class="left-ad float-left">
        <img src="{{asset('public/images/left-ad.png')}}" class="img-fluid" alt="">
    </div>
    <div class="dme-container pl-3 pr-3">
        <div class="row top-ad">
            <img src="{{asset('public/images/top-ad.png')}}" class="img-fluid m-auto" alt="">
        </div>
        <div class="row mt-4">
            <div class="col-md-12 bg-maroon-lighter pt-2 mb-3" style="">
                <img src="{{asset('public/images/Jobb_ikon_maroon.svg')}}" style="max-width: 50px;" class="pt-1 pb-2 float-left">
                <h2 class="u-t2 p-2">&nbsp; Jobb</h2>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="row">
                    <div class="input-group search-box position-relative">
                        <input type="text" name="search" id="search" class="form-control search-control"
                               placeholder="Søk her..." autocomplete="off" value="">
{{--                               placeholder="Søk her..." autocomplete="off" value="{{$search}}">--}}
                        <label for="search"><span class="input-group-addon">
                        <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" height="32"
                             width="32">
                        <path fill="currentColor" fill-rule="evenodd" d="M22.412
                            21.198l-.558.656-.656.558a10.449 10.449 0 0 1-6.754 2.476C8.685
                            24.888 4 20.203 4 14.444 4 8.685 8.685 4 14.444 4c5.759 0 10.445
                            4.685 10.445 10.444 0 2.473-.88 4.872-2.477 6.754zm1.524
                            1.294a12.393 12.393 0 0 0 2.953-8.048C26.889 7.571 21.317 2 14.444 2
                            7.572 2 2 7.571 2 14.444c0 6.873 5.572 12.444 12.444 12.444 3.069 0
                            5.878-1.11 8.048-2.952L28.556 30 30 28.555l-6.064-6.063z"></path>
                        </svg>
                        </span>
                        </label>
                        <div class="suggestions" id="suggestions"
                             style="position:absolute;top:35px;width:100%;height:auto;z-index: 1;background-color: rgba(236,223,226,0.9);box-shadow: 0 0 5px rgba(0,0,0,0.3);">
                            @if (isset($result) )
                                @include('user-panel.partials.global-search-inner')
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <ul class="product-sub-cat-list pl-3 pt-3 col-md-12">
                        <li class="col-sm-4 pl-0 pr-0" style="width: 200px;margin-right: 5px;">
<!--                            --><?php //$filters = [];?>
                            <a href="{{route('search')}}" class="nav-link dme-btn-outlined-blue">Alle stillinger ({{$ads->count()}})</a>
                        </li>
                        <li class="col-sm-4 pl-0 pr-0" style="width: 200px;margin-right: 5px;">
                            <?php $array = ['job_type'=>'management'];?>
                            <a href="{{route('search', $array)}}" class="nav-link dme-btn-outlined-blue">Lederstillinger ({{$management_jobs->count()}})</a>
                        </li>
                        <?php $filters = ['job_type'=>[]]; ?>
                        <li class="col-sm-4 pl-0 pr-0" style="width: 200px;">
                            <a href="{{ url('/companies') }}" class="nav-link dme-btn-outlined-blue">Bedriftsprofiler ({{$companies->count()}})</a>
                        </li>
                    </ul>
                </div>
                <!--                ended row-->
            </div>
            <!--            ended col-->
            <div class="col-md-4 pr-5">
                @include('user-panel.partials.searches-history')
            </div>
            <!--            ended col-->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <section class="panel panel--info u-pa32 maroon-box text-center">
                            <h2 class="u-t3 u-mb16">Synliggjør deg, legg inn din CV?</h2>
                         <br>
                            <div class="">
                                <a href="{{ url('/my-business/cv') }}" class="dme-btn-outlined-blue">Legg inn CV</a>
                            </div>
                            <br>
                            @if(!Auth::check())
                            <p>Har du allerede en CV hos oss? <a href="{{ url('/login') }}">Logg inn og se den her.</a></p>
                            @else
                            <p>Har du allerede en CV hos oss? <a href="{{ url('/my-business/cv#preview') }}">og se den her.</a></p>
                            @endif
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!--        ended row-->
        <div class="row mt-5 home-grid">
            <div class="col-md-12">
                <h2 class="u-t3 mb-4">Anbefalinger til deg</h2>
            </div>
        @if($ads)
            @foreach($ads as $ad)
                <?php $job = $ad->job; ?>
                @if($job != null)
                    @include('user-panel.partials.templates.job-sequare')
                @endif
            @endforeach
            @endif
        </div>
        <!--        ended row-->
    </div>
    <!--    ended container-->
    <div class="right-ad pull-right">
        <img src="{{asset('public/images/right-ad.png')}}" class="img-fluid" alt="">
    </div>
</main>
@endsection
