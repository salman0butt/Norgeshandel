@extends('layouts.landingSite')

@section('page_content')
    <main class="dme-wrapper">
        <div class="left-ad float-left">
            <img src="assets/images/left-ad.png" class="img-fluid" alt="">
        </div>

        <div class="dme-container pl-3 pr-3">
            <div class="breade-crumb">
                <nav aria-label="breadcrumb">
                    <div class="row">
                        <div class="col-md-12 p-0">
                            <ol class="breadcrumb w-100"
                                style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;margin-bottom:0px;">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">NorgesHandel</a></li>
                                <li class="breadcrumb-item active"><a href="#">Jobb</a></li>
                                <li class="breadcrumb-item active"><a href="#">Bedriftsprofiler</a></li>
                            </ol>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="row mt-4">
                <div class="col-md-12 bg-maroon-lighter pt-2 mb-3" style="">
                    <img src="{{ asset('public/images/Jobb_ikon_maroon.svg') }}" style="max-width: 50px;"
                         class="pt-1 pb-2 float-left">
                    <h2 class="u-t2 p-2">&nbsp; Jobb</h2>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-8 offset-md-2">
                    <div class="row">
                        <div class="input-group search-box col-md-12">
                            <input type="text" name="search" class="form-control search-control"
                                   placeholder="Stilling, nøkkelord eller firmanavn" autofocus="">
                            <span class="input-group-addon">
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
                        </div>
                    </div>
                </div>
                <!--            ended col-->
            </div>
            <div class="row mt-4">
                <div class="col-md-12 ">
                    @if($companies && is_countable($companies) && count($companies) > 0)
                        @foreach($companies as $company)
                            <a href="{{ url('/single-company/'.$company->id) }}" class="">
                                <div class="row hover-border text-muted mt-2 mb-2 company">
                                    <div class="col-md-3">
                                        <div class="p-2 text-center company-image">
                                            <img
                                                src="{{\App\Helpers\common::getMediaPath($company->company_logo->first())}}"
                                                alt="" class="img-fluid align-middle">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="p-1">
                                            <div class="company-title">
                                                <h3>{{ $company->emp_name }}</h3>
                                            </div>
                                            <div class="company-detail">
                                                <p>{!! $company->emp_company_information !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="col-md-6 offset-md-3 alert alert-warning">Ingen selskaper funnet!</div>
                    @endif
                    {{-- <a href="http://digitalmedieexpert.no/NorgesHandel/single-company.php" class="">
                        <div class="row hover-border text-muted mt-2 mb-2 company">
                            <div class="col-md-3">
                                <div class="p-2 text-center company-image">
                                    <img src="assets/images/ak-maskiner.png" alt="" class="img-fluid align-middle">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="p-1">
                                    <div class="company-title">
                                        <h3>A-K maskiner AS</h3>
                                    </div>
                                    <div class="company-detail">
                                        <p>A-K maskiner AS er landets ledende private leverandør av maskiner og redskaper
                                            til landbruksbransjen. Vi er organisert som en landsdekkende kjede med 40 salgs-
                                            og servicepunkter med 250 medarbeidere.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="http://digitalmedieexpert.no/NorgesHandel/single-company.php" class="">
                        <div class="row hover-border text-muted mt-2 mb-2 company">
                            <div class="col-md-3">
                                <div class="p-2 text-center company-image">
                                    <img src="assets/images/abb.png" alt="" class="img-fluid align-middle">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="p-1">
                                    <div class="company-title">
                                        <h3>ABAX AS</h3>
                                    </div>
                                    <div class="company-detail">
                                        <p>Vi er et internasjonalt selskap, og for å holde vår sterke posisjon i et av
                                            verdens raskest voksende markeder, er vår bedriftsmodell basert på tre viktige
                                            elementer: "People, technology and services".</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="http://digitalmedieexpert.no/NorgesHandel/single-company.php" class="">
                        <div class="row hover-border text-muted mt-2 mb-2 company">
                            <div class="col-md-3">
                                <div class="p-2 text-center company-image">
                                    <img src="assets/images/abb-personell.jpg" alt="" class="img-fluid align-middle">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="p-1">
                                    <div class="company-title">
                                        <h3>ABC Personell Vikar Og Rekrutteringsbyrå AS</h3>
                                    </div>
                                    <div class="company-detail">
                                        <p>Vi rekrutterer effektivt til vikariater og faste stillinger! Vi ønsker svært
                                            gjerne å komme i kontakt med deg om du vurderer ny jobb! Her kan du se noen av
                                            oppdragene vi arbeider med for tiden.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="http://digitalmedieexpert.no/NorgesHandel/single-company.php" class="">
                        <div class="row hover-border text-muted mt-2 mb-2 company">
                            <div class="col-md-3">
                                <div class="p-2 text-center company-image">
                                    <img src="assets/images/accountor-as.jpg" alt="" class="img-fluid align-middle">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="p-1">
                                    <div class="company-title">
                                        <h3>ACCOUNTOR AS</h3>
                                    </div>
                                    <div class="company-detail">
                                        <p>Accountor er Nord-Europas største regnskaps- og rådgivningskjede med 2,300
                                            profesjonelle som betjener over 35,000 kunder i 7 land. Vi gjør din bedrift mer
                                            lønnsom med vår lidenskap for resultater!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="http://digitalmedieexpert.no/NorgesHandel/single-company.php" class="">
                        <div class="row hover-border text-muted mt-2 mb-2 company">
                            <div class="col-md-3">
                                <div class="p-2 text-center company-image">
                                    <img src="assets/images/af-grouppen.png" alt="" class="img-fluid align-middle">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="p-1">
                                    <div class="company-title">
                                        <h3>AF Gruppen</h3>
                                    </div>
                                    <div class="company-detail">
                                        <p>AF er et ledende entreprenør- og industrikonsern i Norge med virksomhet innen
                                            Anlegg, Bygg, Eiendom, Offshore, Miljø og Energi. Vi trenger deg som er
                                            nysgjerrig og liker å jobbe i team.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="http://digitalmedieexpert.no/NorgesHandel/single-company.php" class="">
                        <div class="row hover-border text-muted mt-2 mb-2 company">
                            <div class="col-md-3">
                                <div class="p-2 text-center company-image">
                                    <img src="assets/images/abb.png" alt="" class="img-fluid align-middle">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="p-1">
                                    <div class="company-title">
                                        <h3>ABB AS</h3>
                                    </div>
                                    <div class="company-detail">
                                        <p>ABB er et ledende teknologiselskap som baner vei for det grønne skiftet og den
                                            fjerde industrielle revolusjon. Vil du være med å skape fremtiden sammen med
                                            oss?</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="http://digitalmedieexpert.no/NorgesHandel/single-company.php" class="">
                        <div class="row hover-border text-muted mt-2 mb-2 company">
                            <div class="col-md-3">
                                <div class="p-2 text-center company-image">
                                    <img src="assets/images/aker-biomarine.jpg" alt="" class="img-fluid align-middle">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="p-1">
                                    <div class="company-title">
                                        <h3>AKER BIOMARINE</h3>
                                    </div>
                                    <div class="company-detail">
                                        <p>Aker BioMarine is a leading biotechnology company developing krill-derived
                                            products for consumer health and wellness and animal nutrition. Our mission is
                                            to improve human and planetary health!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a> --}}
                </div>
            </div>
        </div>
        <!--    ended container-->
        <div class="right-ad pull-right">
            <img src="assets/images/right-ad.png" class="img-fluid" alt="">
        </div>
    </main>



@endsection
