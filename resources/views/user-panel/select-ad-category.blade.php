@extends('layouts.landingSite')

@section('page_content')
    <main class="select-ad-category">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-4 text-center">Hva skal du annonsere?</h2>
                    <div class="row">
                        <div class="col-sm-4 offset-sm-2 pt-2 text-center align-content-center">
                            <a href="#" class="category" data-dme-toggle="collapse" data-dme-target="home">
                                <div class="category-icon" style="margin-top: 15px;">
                                    <img src="{{asset('public/images/Eiendom_ikon_maroon.svg')}}" style="max-height: 180px;">
                                </div>
                                <div class="category-title color-grey col-12">Eiendom</div>
                            </a>
                        </div>
                        <div class="col-sm-4 text-center pt-4 text-center align-content-center">
                            <a href="" class="category nav nav-pills" data-dme-toggle="collapse" data-dme-target="job">
                                <div class="category-icon" style="width:245px;">
                                    <img src="{{asset('public/images/Jobb_ikon_maroon.svg')}}" style="max-height: 180px;">
                                </div>
                                <div class="category-title color-grey col-12">Jobb</div>
                            </a>
                        </div>
                    </div>
                    <hr class="col-6">
                    <ul class="sub-cat-list pl-3 dme-collapse" id="home">
                        <li class="" style="">
                            <a href="{{url('/new/property/rent/ad')}}">Bolig til leie
                                <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                            </a>
                            <hr class="col-6">
                        </li>
                        <li class="" style="">
                            <a href="{{url('new/property/sale/ad')}}">Bolig til salgs
                                <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                            </a>
                            <hr class="col-6">
                        </li>
                        <li class="" style="">
                            <a href="{{url('/new/flat/wishes/rented')}}">Bolig ønskes leid
                                <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                            </a>
                            <hr class="col-6">
                        </li>
                        <li class="" style="">
                            <a href="{{url('holiday/home/for/sale')}}">Fritidsbolig til salgs
                                <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                            </a>
                            <hr class="col-6">
                        </li>
                        <!-- <a href="{{url('/add/new/realestate/business/plot')}}">Bolig- og fritidstomt til salgs
                            <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                        </a> -->
                        <!-- <hr class="col-6"> -->
                        </li>
                        <li class="" style="">
                            <a href="{{url('/add/new/commercial/property/for/sale')}}">Næringseiendom til salgs
                                <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                            </a>
                            <hr class="col-6">
                        </li>
                        <li class="" style="">
                            <a href="{{url('/add/new/commercial/property/for/rent')}}">Næringseiendom til leie
                                <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                            </a>
                            <hr class="col-6">
                        </li>
                        <li class="" style="">
                            <a href="{{url('/commercial/plots')}}">Næringstomt
                                <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                            </a>
                            <hr class="col-6">
                        </li>
                        <li class="" style="">
                            <a href="{{url('/business/for/sale')}}">Bedrifter til salgs
                                <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                            </a>
                            <hr class="col-6">
                        </li>
                    </ul>
                    <!--                -->
                    <ul class="sub-cat-list pl-3 dme-collapse" id="job">
                        <li class="" style="">
                            <a href="{{url('/new/job/full_time')}}">Heltidsstilling
                                <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                            </a>
                            <hr class="col-6">
                        </li>
                        <li class="" style="">
                            <a href="{{url('/new/job/part_time')}}">Deltidsstilling
                                <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                            </a>
                            <hr class="col-6">
                        </li>
                        <li class="" style="">
                            <a href="{{url('/new/job/management')}}">Lederstilling
                                <p class="text-muted">Omnesque necessitatibus pro no, vix enim dicant et, nam ut patrioque percipitur. At euismod recteque</p>
                            </a>
                            <hr class="col-6">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-8 offset-md-2 text-center bg-maroon-lighter radius-8 p-5">
                    <h4>Annonsere som bedrift eller forhandler?</h4>
                    <p>Har du et organisasjonsnummer og annonserer jevnlig på Handel?</p>
                    <p>Da gir en bedriftsavtale deg flere fordeler.</p>
                    <a href="{{ url('my-business/profile/select_company_profile_type') }}" class="dme-btn-outlined-blue mt-2">Bli bedriftskunde </a>
                </div>
            </div>
        </div>
    </main>
@endsection
