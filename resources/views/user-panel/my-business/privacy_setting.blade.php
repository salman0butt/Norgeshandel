@extends('layouts.landingSite') 

@section('page_content')
<style>
.expansion-panel {
    --reach-dialog: 1;
font-family: Finntype, Arial, Helvetica, sans-serif;
font-size: 16px;
line-height: 22px;
color: #474445;
box-sizing: inherit;
background-color: #ecdfe2;
border-radius: 8px;
margin: 5px;
margin-bottom:16px;
padding:10px;
}
button:focus {
    outline: none;
}
.expansion-panel__clicktarget {
    --reach-dialog: 1;
box-sizing: inherit;
margin: 0;
overflow: visible;
text-transform: none;
font: inherit;
-webkit-appearance: button;
padding: 16px;
background: transparent;
width: 100%;
display: flex;
flex: 1 1 auto;
text-align: left;
cursor: pointer;
border: 0;
outline: none;
font-size: 16px;
line-height: 22px;
}
.expansion-panel__summary {
    --reach-dialog: 1;
text-transform: none;
font: inherit;
text-align: left;
cursor: pointer;
font-size: 16px;
line-height: 22px;
box-sizing: inherit;
padding-right: 16px;
width: 100%;
color: #474445;
}
.expansion-panel__clicktarget .expansion-panel__summary h3 {
    font-weight:100 !important;
}
</style>
<main class="job-preferences">
    <div class="dme-container">
        <div class="breade-crumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('my-business')}}">Min handel </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Innstillinger for personvern</li>
                </ol>
            </nav>
        </div>
        <div id="user-consents-container" class="pageholder">
            <main style="margin-top: 30px;">
                <h2>Innstillinger for personvern</h2>
                <p class="panel">
                    Nye regler for personvern gir deg bedre kontroll over sporene du legger igjen på nett, og hva FINN og andre kan bruke dine data til. Bra, ikke sant?
                </p>
                <p class="panel">
                    Vi lover å være åpne om hva vi gjør, og alltid fokusere på det som hjelper deg.
                </p>

                <section data-reactroot="">
                    <h3 style="font-weight:400">Dine innstillinger</h3>
                    <div id="user-consents">
                        <div class="expansion-panel expansion-panel--open">
                            <button type="button" class="expansion-panel__clicktarget expansion-panel__clicktarget1"  aria-expanded="false">
                             
                                <div class="expansion-panel__summary">
                                    <h3>Personlig tilpasset FINN</h3>
                                    <p class="u-mb0">Vi foreslår FINN-innhold tilpasset din interesse</p>
                                </div>
                                  <i class="fas fa-chevron-up"></i>
                            </button>
                            <div class="expansion-panel__details expansion-panel__details1">
                                <p class="preserve-newline-formatting">Vi viser deg relevante FINN-annonser du ikke har sett, og tilpasser FINN etter din bruk. For å gjøre dette lagrer vi søkehistorikken din hos oss. Dataene blir ikke delt med andre.</p>
                                <p class="input-toggle">
                                    <input type="checkbox" id="toggle-tilpasset-innhold" checked="">
                                    <label for="toggle-tilpasset-innhold">Ja, det er greit</label>
                                </p><a href="#">Les mer</a>
                            </div>
                        </div>
                        <div class="expansion-panel">
                            <button type="button" class="expansion-panel__clicktarget expansion-panel__clicktarget2" aria-expanded="false">
                                <div class="expansion-panel__summary">
                                    <h3>Motta viktig informasjon fra FINN</h3>
                                    <p class="u-mb0">Du får viktige beskjeder fra FINN</p>
                                </div>
                                  <i class="fas fa-chevron-up"></i>
                            </button>
                            <div class="expansion-panel__details expansion-panel__details2">
                                <p class="preserve-newline-formatting">Du får varsling, melding eller e-post når vi har viktig informasjon til deg: Påminnelser og tips om annonsene dine, innhold du følger, eller endringer vi gjør på FINN. For å gjøre dette bruker vi kontaktinformasjon knyttet til FINN-brukeren din.</p>
                                <p class="input-toggle">
                                    <input type="checkbox" id="toggle-viktig-informasjon-fra-finn" checked="">
                                    <label for="toggle-viktig-informasjon-fra-finn">Ja, det er greit
                                    </label>
                                </p><a href="#">Les
                                    mer</a>
                            </div>
                        </div>
                    </div>
                    <div id="spid-consents" data-is-logged-in="true">
                        <div class="expansion-panel">
                            <button type="button" class="expansion-panel__clicktarget expansion-panel__clicktarget3" aria-expanded="false">
                                <div class="expansion-panel__summary">
                                    <h3 class="u-mb0">Smart reklame</h3>
                                </div>
                                  <i class="fas fa-chevron-up"></i>
                            </button>
                            <div class="expansion-panel__details expansion-panel__details3">
                                <p>Vi kan bruke informasjon om hva du ser på, hvor du befinner deg og hvilken målgruppe du er i for å gjøre reklamen mer relevant for dine interesser. Takker du nei vil du fortsatt få reklame, men den vil være tilfeldig.</p>
                                <p>Schibsted Norge er behandlingsansvarlig for påloggingsløsning og målrettet reklame.
                                </p><a class="button button--cta u-mt16" href="#">Gå til Schibsted Norge</a>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <h3 style="font-weight:400 !important;">Administrer dine data</h3>
                    <div id="takeout-panel">
                        <div class="expansion-panel">
                            <button type="button" class="expansion-panel__clicktarget expansion-panel__clicktarget4" aria-expanded="false">
                                <div class="expansion-panel__summary">
                                    <h3 class="u-mb0">Last ned dine data</h3>
                                </div>
                                  <i class="fas fa-chevron-up"></i>
                            </button>
                            <div class="expansion-panel__details expansion-panel__details4">
                                <p>Med GDPR-forordningen (General Data Protection Regulation) har du rett til å vite hva selskaper vet om deg. Det inkluderer informasjon du har delt med dem og data de har samlet om din aktivitet. Her kan du laste ned en oversikt over alle dine data FINN.no har lagret.</p><a class="button button--cta u-mt16" href="#">Last ned data</a>
                            </div>
                        </div>
                    </div>
                    <div id="delete-panel">
                        <div class="expansion-panel">
                            <button type="button" class="expansion-panel__clicktarget expansion-panel__clicktarget5" aria-expanded="false">
                                <div class="expansion-panel__summary">
                                    <h3 class="u-mb0">Slett meg permanent</h3>
                                </div>
                                  <i class="fas fa-chevron-up"></i>
                            </button>
                            <div class="expansion-panel__details expansion-panel__details5">
                                <ul>
                                    <li>Alt du har lagt inn på FINN går tapt for alltid</li>
                                    <li class="u-mt8">Du vil ikke kunne logge inn på tjenesten</li>
                                    <li class="u-mt8">Du kan ikke angre i ettertid</li>
                                </ul>
                                <button type="button" class="button dme-btn-outlined-blue">Slett min FINN-bruker</button>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>

    </div>
</main>
<script>
$(document).ready(function(){
    $(".expansion-panel__details1").hide();
    $(".expansion-panel__details2").hide();
    $(".expansion-panel__details3").hide();
    $(".expansion-panel__details4").hide();
    $(".expansion-panel__details5").hide();

  $(".expansion-panel__clicktarget1").click(function(){
    $(this).find("i").toggleClass("fa-chevron-up fa-chevron-down");
    $(".expansion-panel__details1").toggle();  
  });
   $(".expansion-panel__clicktarget2").click(function(){
    $(this).find("i").toggleClass("fa-chevron-up fa-chevron-down");
    $(".expansion-panel__details2").toggle();
  });
   $(".expansion-panel__clicktarget3").click(function(){
      $(this).find("i").toggleClass("fa-chevron-up fa-chevron-down");
    $(".expansion-panel__details3").toggle();
  });
   $(".expansion-panel__clicktarget4").click(function(){
    $(this).find("i").toggleClass("fa-chevron-up fa-chevron-down");  
    $(".expansion-panel__details4").toggle();
  });
   $(".expansion-panel__clicktarget5").click(function(){
   $(this).find("i").toggleClass("fa-chevron-up fa-chevron-down");
    $(".expansion-panel__details5").toggle();
  });
});
</script>
@endsection