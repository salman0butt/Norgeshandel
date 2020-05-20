@extends('layouts.landingSite')

@section('page_content')
<style>
hr {
    margin-left: 0px !important;
    margin-right:0px !important;
}
</style>
    <main class="select-ad-category">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-4 text-center">Hva skal du annonsere?</h2>
                    <div class="row">
                        @if(!Auth::user()->hasRole('agent') || (Auth::user()->hasRole('agent') && Auth::user()->created_by_company && Auth::user()->created_by_company->company_type == "Eiendom"))
                            <div class="col-sm-4 offset-sm-2 pt-2 text-center align-content-center @if((Auth::user()->hasRole('agent') && Auth::user()->created_by_company && Auth::user()->created_by_company->company_type == "Eiendom")) m-auto @endif">
                                <a href="#" class="category" data-dme-toggle="collapse" data-dme-target="home">
                                    <div class="category-icon" style="margin-top: 15px;">
                                        <img src="{{asset('public/images/Eiendom_ikon_maroon.svg')}}" style="max-height: 180px;">
                                    </div>
                                    <div class="category-title color-grey col-12">Eiendom</div>
                                </a>
                            </div>
                        @endif

                        @if(!Auth::user()->hasRole('agent') || (Auth::user()->hasRole('agent') && Auth::user()->created_by_company && Auth::user()->created_by_company->company_type == "Jobb"))
                            <div class="col-sm-4 text-center pt-4 text-center align-content-center @if((Auth::user()->hasRole('agent') && Auth::user()->created_by_company && Auth::user()->created_by_company->company_type == "Jobb")) m-auto @endif">
                                <a href="" class="category nav nav-pills" data-dme-toggle="collapse" data-dme-target="job">
                                    <div class="category-icon" style="width:245px;">
                                        <img src="{{asset('public/images/Jobb_ikon_maroon.svg')}}" style="max-height: 180px;">
                                    </div>
                                    <div class="category-title color-grey col-12">Jobb</div>
                                </a>
                            </div>
                        @endif
                    </div>
                    <center><hr class="col-6"></center>
                    <ul class="sub-cat-list pl-3 dme-collapse" id="home">
                        <li class="" style="">
                       
                        <div class="row">
                            <a href="{{url('/new/property/property-for-rent')}}" class="col-md-8">Bolig til leie</a><p class="text-muted col-md-4">Gratis</p>
                            </div>
                            <hr class="col-md-9">
                  
                        </li>
                        <li class="" style="">
                        <div class="row">
                            <a href="{{url('new/property/property-for-sale')}}" class="col-md-8">Bolig til salgs
                            </a>
                                <p class="text-muted col-md-4">990 Kr</p>
                            </div>
                            <hr class="col-md-9">
                        </li>
                        <li class="" style="">
                        <div class="row">
                            <a href="{{url('/new/property/property-for-flat-wishes-rented')}}" class="col-md-8">Bolig ønskes leid
                            </a>
                                <p class="text-muted col-md-4">Gratis</p>
                            </div>
                            <hr class="col-md-9">
                        </li>
                        <li class="" style="">
                        <div class="row">
                            <a href="{{url('new/property/property-for-holiday-homes-for-sale')}}" class="col-md-8">Fritidsbolig til salgs</a>
                                <p class="text-muted col-md-4">990 Kr</p>
                            </div>
                            <hr class="col-md-9">
                        </li>
                        <!-- <a href="{{url('/add/new/realestate/business/plot')}}">Bolig- og fritidstomt til salgs
                            <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                        </a> -->
                        <!-- <hr class="col-6"> -->
                        </li>
                        <li class="" style="">
                        <div class="row">
                            <a href="{{url('/new/property/commercial-property-for-sale')}}" class="col-md-8">Næringseiendom til salgs
                            </a>
                                <p class="text-muted col-md-4">1490 Kr</p>
                            </div>
                            <hr class="col-md-9">
                        </li>
                        <li class="" style="">
                        <div class="row">
                            <a href="{{url('/new/property/commercial-property-for-rent')}}" class="col-md-8">Næringseiendom til leie</a>
                                <p class="text-muted col-md-4">1490 Kr</p>
                            </div>
                            <hr class="col-md-9">
                        </li>
                        <li class="" style="">
                        <div class="row">
                            <a href="{{url('/new/property/commercial-plots')}}" class="col-md-8">Næringstomt
                            </a>
                                <p class="text-muted" class="col-md-4" style="margin-left: 2.5%;">1490 Kr</p>
                            </div>
                            <hr class="col-md-9">
                        </li>
                        <li class="" style="">
                        <div class="row">
                            <a href="{{url('/new/property/business-for-sale')}}" class="col-md-8">Bedrifter til salgs
                            </a>
                                <p class="text-muted col-md-4">1490 Kr</p>
                            </div>
                            <hr class="col-md-9">
                        </li>
                    </ul>
                    <!--                -->
                    <ul class="sub-cat-list pl-3 dme-collapse" id="job">
                        <li class="" style="">
                        <div class="row">
                            <a href="{{url('/new/job/full_time')}}" class="col-md-8">Heltidsstilling
                            </a>
                                <p class="text-muted col-md-4">1990 Kr</p>
                            </div>
                            <hr class="col-md-9">
                        </li>
                        <li class="" style="">
                          <div class="row">
                            <a href="{{url('/new/job/part_time')}}" class="col-md-8">Deltidsstilling
                            </a>
                                <p class="text-muted col-md-4">1490 Kr</p>
                              </div>
                            <hr class="col-md-9">
                        </li>
                        <li class="" style="">
                          <div class="row">
                            <a href="{{url('/new/job/management')}}" class="col-md-8">Lederstilling
                            </a>
                                <p class="text-muted col-md-4">1990 Kr</p>
                              </div>
                            <hr class="col-md-9">
                        </li>
                    </ul>
                </div>
            </div>
            @if(!Auth::user()->created_by_company_id)
                <div class="row mb-3">
                    <div class="col-md-8 offset-md-2 text-center bg-maroon-lighter radius-8 p-5">
                        <h4>For bedriftsavtale?</h4><br>
                        <a href="{{ url('my-business/profile/select_company_profile_type') }}" class="dme-btn-outlined-blue mt-2">Bli bedriftskunde </a>
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection
