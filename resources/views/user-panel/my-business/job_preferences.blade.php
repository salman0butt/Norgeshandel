@extends('layouts.landingSite')
@section('page_content')

<main class="job-preferences">
    <div class="dme-container">
        <div class="breade-crumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('my-business')}}">Min handel </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mine jobb-preferanser</li>
                </ol>
            </nav>
        </div>
        <!---- end breadcrumb----->
        <div class="panel u-mb32" id="main-content">
            <h2 class="mb-5">Mine jobb-preferanser</h2>
            <p class="u-mb16" style="font-weight:600;">Hva er drømmejobben din?</p>
            <p class="u-mb16">Vi ønsker å hjelpe deg å finne drømmejobben, slik at du slipper å aktivt lete
                etter den selv. Anbefalinger vi gir deg er basert på <a href="#"
                    target="_blank">selskaper du følger</a> og dine
                jobbpreferanser.</p>
            <p><em>Her kan du endre dine innstillinger. Det kan være lurt å oppdatere eller legge til ny
                    informasjon med jevne mellomrom, slik at det du mottar alltid vil være relevant og
                    interessant.</em></p>
        </div>
        <div class="panel">
            <div class="u-mb32 form-group">
                <div class="input input--text u-mb8"><label for="keywords-input" class="u-t5">Hva vil du jobbe med?</label>
                    <div class="u-position-relative" style="display: block;"><input id="keywords-input" type="text"
                            placeholder="Stillingstittel eller nøkkelord" role="combobox" aria-autocomplete="list"
                            aria-expanded="false" autocomplete="off" value="" class="dme-form-control">
                    </div>
                
                </div>
            </div>
            <div class="u-mb32 form-group">
                <div class="input input--text u-mb8"><label for="geo-region-input" class="u-t5">Hvor vil du jobbe?</label>
                    <div class="u-position-relative" style="display: block;"><input id="geo-region-input" type="text"
                            placeholder="Oslo, Bergen, Trondheim" role="combobox" aria-autocomplete="list"
                            aria-expanded="false" autocomplete="off" value="" class="dme-form-control">
                    </div>
                  
                </div>
            </div>
            <div class="u-mb32 form-group"><label>Hva ønsker du informasjon om?</label>
                <div class="input-toggle"><input id="notification_option_3" type="checkbox"
                        class="mrs"><label class="" for="notification_option_3">Nyheter om
                        bedriften</label></div>
                <div class="input-toggle"><input id="notification_option_2" type="checkbox" class="mrs"
                        class="mrs"><label class="" for="notification_option_2">Arrangementer</label>
                </div>
            </div>
        </div>
        <div class="panel u-d1 u-stone">
            <p class="u-t5">All informasjon du gir fra deg i forbindelse med "Følg"-tjenesten er
                konfidensiell, og deles ikke med andre enn de bedriftene du følger.</p>
            <p class="u-t5">Denne informasjonen vil danne grunnlaget for din kandidatprofil på FINN.no, og er uavhengig
                av de
                enkelte bedriftene du følger.</p>
        </div>
    </div>
</main>
@endsection
