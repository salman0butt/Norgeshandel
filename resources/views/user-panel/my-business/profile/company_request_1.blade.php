@extends('layouts.landingSite')

@section('page_content')

    <main class="main">
        <div class="dme-container">
            <div class="breade-crumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('my-business')}}">Min handel </a></li>
                        <li class="breadcrumb-item"><a href="{{url('my-business/profile')}}">Min prifil </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Be om firmaprofil</li>
                    </ol>
                </nav>
            </div>            <!---- end breadcrumb----->
            <div class="panel row">
                <div class="col-md-12 pb-3">
                    <h3 class="font-weight-normal mt-3">Bli bedriftskunde hos NorgesHandel</h3>
                    <p class="u-mb16">
                        Annonserer du jevnlig på FINN på vegne av en bedrift ?<br>
                        Da lønner det seg å være bedriftskunde.
                    </p>
                    <p>
                        En bedriftsavtale gir deg fordeler som:
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="media__body">
                        <h3 class="u-strong u-t4 u-mb0"><span class="fa fa-check"></span>&nbsp; Betaling med faktura</h3>
                        <p class="u-caption">Få bedre oversikt med samlefaktura en gang i måneden</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="media__body">
                        <h3 class="u-strong u-t4 u-mb0"><span class="fa fa-check"></span>&nbsp; Firmaprofilering</h3>
                        <p class="u-caption">Vis frem bedriften på Norges største markedsplass</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="media__body">
                        <h3 class="u-strong u-t4 u-mb0"><span class="fa fa-check"></span>&nbsp; Lenke til bedriftens nettsider i annonsene</h3>
                        <p class="u-caption">Skap økt trafikk til egne nettsider</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="media__body">
                        <h3 class="u-strong u-t4 u-mb0"><span class="fa fa-check"></span>&nbsp; Dedikert kontaktperson i FINN</h3>
                        <p class="u-caption">Optimaliser annonseringen sammen med en som kjenner din bedrift</p>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-3 offset-md-3 pt-2 pb-5 text-center align-content-center">
                    <a href="{{url('my-business/profile/company_profile_form/property')}}" >
                        <div class="category-icon" style="margin-top: 15px;">
                            <img src="http://localhost/norgeshandel/public/images/Eiendom_ikon_maroon.svg" style="max-height: 180px;">
                        </div>
                        <div class="category-title color-grey col-12">Eiendom</div>
                    </a>
                </div>
                <div class="col-md-3 text-center pt-4 pb-5 text-center align-content-center">
                    <a href="{{url('my-business/profile/company_profile_form/job')}}" >
                        <div class="category-icon" style="width:245px;">
                            <img src="http://localhost/norgeshandel/public/images/Jobb_ikon_maroon.svg" style="max-height: 180px;">
                        </div>
                        <div class="category-title color-grey col-12">Jobb</div>
                    </a>
                </div>
            </div>
        </div>
    </main>

@endsection
