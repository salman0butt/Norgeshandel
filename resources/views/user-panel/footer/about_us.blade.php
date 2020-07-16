@extends('layouts.landingSite')

@section('page_content')
<style>
    .grid__unit {
        display: inline;
        float: left;
    }

</style>

<div class="dme-container u-mb32" style="margin-top:3%;" id="about-page">

    <div class="breade-crumb">
        <nav aria-label="breadcrumb">
            <div class="row pl-3 pr-3">
                <div class="col-md-12 p-0">
                    <ol class="breadcrumb w-100" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">NorgesHandel.no</a></li>
                        <li class="breadcrumb-item active"><a href="#">Om Norgeshandel</a></li>
                    </ol>
                </div>
            </div>
        </nav>
    </div>
    <div class="page_content mt-2">
        <h3 class="mb-4">Om Norgeshandel</h3>
        <p>Norgeshandel.no er nett side som er mer som en ide utviklet for både bedrifter og
            privatpersoner som vil selge eiendom eller publisere stillings annonser like enkelt eller
            kanskje enklere enn andre nettsider og ikke minst samtidig spare penger.</p>
        <p>Hvorfor betale mye når internett som portal er like tilgjengelig via oss med lave kostnader?</p>

        <div class="grid">
            <div class="grid__unit mr-5">
                <a href="{{ url('/my-business/profile/company_profile_form/property') }}" class="link link--dark">
                    <div class="media media--top u-mt8 u-mb8">
                        <div class="media__img u-secondary-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 45 35">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M33.716 15.894a.792.792 0 0 0-.795.79V30.42H30.33V19.953a.793.793 0 0 0-.795-.79H24.3a.792.792 0 0 0-.795.79V30.42H21.45v-1.824c0-1.873-1.534-3.396-3.42-3.396-.193 0-.414.027-.623.064a5.01 5.01 0 0 0-3.798-3.1v-5.481a.792.792 0 0 0-.795-.79h-.48l10.952-10.99 4.816 4.705c.228.224.57.29.866.168a.79.79 0 0 0 .49-.729V6.974h1.777v5.38c0 .21.086.414.237.562l3.042 2.978h-.798zm-8.62 14.52h3.643v-9.672h-3.643v9.672zm-5.237 0h-4.478s-1.648.007-2.638.007c-1.876 0-3.403-1.516-3.403-3.38 0-1.862 1.527-3.378 3.403-3.378 1.61 0 3.013 1.134 3.335 2.696l.172.837.827-.236c.261-.075.73-.18.953-.18 1.008 0 1.83.814 1.83 1.817v1.817zM37.013 16.12l-4.188-4.098V6.184a.792.792 0 0 0-.795-.79h-3.368a.792.792 0 0 0-.795.79v.978l-4.031-3.935a.799.799 0 0 0-1.123.008L9.863 16.128a.787.787 0 0 0-.169.86.796.796 0 0 0 .734.485h1.59v4.669c-2.41.35-4.268 2.41-4.268 4.9C7.75 29.776 9.99 32 12.743 32c.993 0 2.645-.007 2.642-.007h4.685V32h13.646a.792.792 0 0 0 .795-.79V17.473h1.944a.795.795 0 0 0 .735-.49.785.785 0 0 0-.177-.862z">
                                </path>
                            </svg>
                        </div>
                        <div class="media__body">
                            <div class="u-t3 u-mt4">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Eiendom</font>
                                </font>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="grid__unit">
                <a href="{{ url('/my-business/profile/company_profile_form/job') }}" class="link link--dark">
                    <div class="media media--top u-mt8 u-mb8">
                        <div class="media__img u-secondary-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="35" viewBox="0 0 45 35">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M34.625 26.896H10.374a.752.752 0 0 1-.755-.748v-9.644a20.942 20.942 0 0 0 9.752 4.115v1.683c0 .444.361.802.81.802h4.639c.447 0 .81-.358.81-.802V20.62a20.905 20.905 0 0 0 9.75-4.125v9.654c0 .413-.339.748-.755.748zM20.99 21.501h3.02v-3.302h-3.02V21.5zM10.374 10.854h24.251c.416 0 .756.335.756.748v2.802a19.285 19.285 0 0 1-9.752 4.59v-1.597a.806.806 0 0 0-.81-.802H20.18c-.448 0-.81.36-.81.802v1.6a19.343 19.343 0 0 1-9.75-4.584v-2.811c0-.413.338-.748.754-.748zm8.606-3.072a.18.18 0 0 1 .18-.178h6.68c.098 0 .179.08.179.178V9.25H18.98V7.782zM34.625 9.25h-6.987V7.782C27.638 6.8 26.832 6 25.84 6H19.16c-.992 0-1.8.8-1.8 1.782V9.25h-6.986C9.064 9.25 8 10.305 8 11.602v14.546c0 1.298 1.065 2.352 2.374 2.352h24.251c1.31 0 2.375-1.054 2.375-2.352V11.602c0-1.297-1.066-2.352-2.375-2.352z">
                                </path>
                            </svg>
                        </div>
                        <div class="media__body">
                            <div class="u-t3 u-mt4">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Jobb</font>
                                </font>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <br><br>
            <p> På Norgeshandel kan privat personer selv lage annonse for eiendom og publisere annonsen.
                Det gjelder både utleie og salg. Dette hjelper deg å selge din eiendom uten større kostnader.<br>
                @if(!Auth::check())
                <a href="{{ url('/login') }}">Logg inn</a>
                @endif
                </p>
            <p>Det er like enkelt for bedritfskunder, fordel for bedriftskunder hos Norgehandel er
                å ha bedriftsavtale.</p>
            <p>Norgeshandel tilbyr firmaprofilering, betaling med faktura, lenke til nettside i annonse. Tett
                dialog og oppfølging for våre bedriftskunder. Vi tilbyr også skreddersydde avtaler nettop for
                levere best mulig til våre kunder.</p>
                <a href="{{ url('/become-business') }}">Les mer</a>
        </div>
    </div>
    <br><br>
</div>

@endsection
