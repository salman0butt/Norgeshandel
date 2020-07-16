@extends('layouts.landingSite')

@section('page_content')
<style>
    .sidebar li {
        list-style: none;
        padding: 10px 15px;
        width: 100%;
    }

    .sidebar li a {
        width: 100%;
        font-size: 14px;
    }

    .sidebar .active {
        background: #ac304a;
    }

    .sidebar .active a {
        color: #ffffff !important;
    }

    .recent-articles ul,
    .related-articles ul {
        padding-left: 0px;
    }

    .recent-articles li,
    .related-articles li {
        list-style: none;
        margin: 10px;
    }

</style>

<div class="dme-container u-mb32" style="margin-top:3%;" id="cookie-page">

    <div class="breade-crumb">
        <nav aria-label="breadcrumb">
            <div class="row pl-3 pr-3">
                <div class="col-md-12 p-0">
                    <ol class="breadcrumb w-100" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">NorgesHandel.no hjelpesenter </a></li>
                        <li class="breadcrumb-item active"><a href="#">Trygg på NorgesHandel.no</a></li>
                        <li class="breadcrumb-item active"><a href="#">Personvern</a></li>
                    </ol>
                </div>
            </div>
        </nav>
    </div>

    <div class="article-container row" style="margin-top:2%;" id="article-container">
        {{-- <section class="article-sidebar col-md-3">
            <section class="section-articles collapsible-sidebar">
                <h6 class="collapsible-sidebar-title sidenav-title">Artikler i denne seksjonen</h6>
                <ul class="sidebar" style="padding-left: 15px;">

                    <li id="art-305274" class="active mt-4">
                        <a href="#" class="sidenav-item">Personvernerklæring</a>
                    </li>

                    <li id="art-360001156689">
                        <a href="#" class="sidenav-item ">Dine data, dine valg! GDPR - hva er det?</a>
                    </li>

                    <li id="art-211889165">
                        <a href="#" class="sidenav-item ">Ofte stilte spørsmål om personvern på Norgeshandel</a>
                    </li>

                    <li id="art-360001007985">
                        <a href="#" class="sidenav-item ">Endringslogg for personvernerklæringen</a>
                    </li>

                    <li id="art-360006266280">
                        <a href="#" class="sidenav-item">Behandling av personopplysninger ved registrert interesse for
                            Kommer for salg-boligannonser</a>
                    </li>

                    <li id="art-115004085465">
                        <a href="#" class="sidenav-item">Behandling av personopplysninger ved søk på stilling gjennom
                            Norgeshandel</a>
                    </li>

                    <li id="art-211876885">
                        <a href="#" class="sidenav-item current-article">Lokal lagring av data og
                            informasjonskapsler</a>
                    </li>

                    <li id="art-208689765">
                        <a href="#" class="sidenav-item ">Oversikt over informasjonskapsler på Norgeshandel </a>
                    </li>

                    <li id="art-305294">
                        <a href="#" class="sidenav-item ">Er det trygt å bruke “Forbli innlogget” funksjonen?</a>
                    </li>

                    <li id="art-115004632729">
                        <a href="#" class="sidenav-item ">Hvorfor blir jeg automatisk logget ut av Norgeshandel?</a>
                    </li>

                </ul>

            </section>
        </section> --}}

        <article class="article col-md-12">
            <header class="article-header">
                <h3 title="Lokal lagring av data og informasjonskapsler" class="article-title" style="font-weight:400;">
                    Lokal lagring av data og informasjonskapsler</h3>
            </header>
            <section class="article-info mb-5">
                <div class="article-content">
                    <div class="article-body">
                        <h4 class="mt-5" style="font-weight:400;">1.PERSONVERN</h4>
                        <p><span>Datavern er svært viktig for Norgeshandel og vi vil være åpne om hvordan vi behandler
                                personopplysningene dine.
                                Vi har utarbeidet en policy for hvordan personopplysningene dine skal behandles og
                                beskyttes.</span></p>

                        <h4 style="font-weight:400;color:red">2.HVEM KONTROLLERER DINE PERSONLIGE DATA?</h4>
                        <br>

                        <h4 style="font-weight:400;">3.HVILKE TYPER PERSONOPPLYSNINGER BEHANDLER VI?</h4>

                        <p><span style="font-weight: 400;">Vi vil behandle alle opplysninger du gir oss, inkludert
                                følgende kategorier:<br>
                                - kontaktinformasjon som f.eks. navn, adresse, e-mailadresse og telefonnummer<br>
                                - IP adresse<br>
                                - hvilke annonser/ annonse kategorier du har klikket på<br>
                                - annonserings historikk<br>
                                <br>
                                - hvordan du navigerte og klikket på nettstedet
                            </span></p>
                        <h4 style="font-weight:400;">4.HVORFOR BRUKER VI PERSONOPPLYSNINGENE DINE?</h4>

                        <p><span style="font-weight: 400;">Vi vil bruke personopplysningene dine til å håndtere betaling
                                for annonser online.<br>
                                Vi vil også bruke opplysningene dine til å håndtere klager.<br>
                                Personopplysningene dine blir brukt til å identifisere deg og bekrefte at du er myndig
                                og kan annonsere på vår nettside.<br>
                            </span></p>
                        <h5 style="font-weight:400;margin:20px 0;">4.1 Direkte markedsføring</h5>
                        <p><span style="font-weight: 400;">Vi vil bruke personopplysningene dine til å sende deg tilbud
                                og invitasjoner via e-mail og tekstmeldinger om du har gitt ditt samtykke.
                                For å optimalisere din opplevelse av Norgeshandel vil vi gi deg relevant informasjon,
                                anbefale løsninger (gjelder bedrifter). Alle disse flotte tjenestene er basert på
                                tidligere kjøp, hva du har klikket på og informasjon du har gitt oss.
                            </span></p>

                        <h5 style="font-weight:400;margin:20px 0;">4.2 Kundeservice</h5>

                        <p>Vi vil bruke personopplysningene dine til å håndtere forespørslene dine, og til å behandle
                            klager og teknisk støtte via e-mail, vår chat-funksjon, og sosiale medier.<br>
                            Vi kan også kontakte deg dersom det er et problem med publisering av en annonse.
                        </p>
                        <h5 style="font-weight:400;margin:20px 0;">4.3 Utvikling og forbedring</h5>

                        <p>Vi vil bruke opplysningene til å evaluere, utvikle og forbedre tjenestene, produktene og
                            systemene for alle kundene våre. For å gjøre dette vil vi ikke analysere opplysningene på
                            individuell basis. All databehandling vil bli utført på pseudonymiserte opplysninger.<br>
                            Dette inkluderer analyser for å gjøre tjenestene våre mer brukervennlige, som for eksempel
                            ved å modifisere brukergrensesnittet for å forenkle informasjonsstrømmen, eller for å belyse
                            momenter som kundene ofte bruker i våre digitale kanaler, og for å forbedre IT-systemer slik
                            at vi kan øke sikkerheten for besøkende og kunder generelt.<br>
                            Analysene brukes også til å utvikle og hele tiden forbedre logistikkflyten av varer ved å
                            forutse kjøp, varebeholdning og leveringer i tillegg til ressurskapasiteten vår fra et
                            bærekraftig ståsted, ved å forenkle kjøp og levering.
                        </p>

                        <h5 style="font-weight:400;margin:20px 0;">4.4 Oppfyllelse av rettslige forpliktelser</h5>

                        <p>Vi vil bruke personopplysningene dine til å overholde forpliktelser i lover, rettskjennelser
                            og myndighetenes bestemmelser.<br>
                            Dette inkluderer å bruke personopplysningene dine for å samle inn og verifisere
                            regnskapsdata for å overholde regnskapsføringsregler.</p>

                        <h5 style="font-weight:400;margin:20px 0;">4.5 Forebygging av misbruk og kriminalitet</h5>

                        <p>Vi vil bruke personopplysningene dine til forvaltning av skadeforebygging, ved å forsikre oss
                            om at vilkårene følges og for å avsløre og forebygge misbruk av våre tjenester.<br>
                            Personopplysningene dine vil brukes til å forhindre og etterforske misbruk av våre tjenester
                            online, tap og svindel, ved å analysere online shopping-atferd.
                        </p>

                        <h4 class="mt-5" style="font-weight:400;">5.HVA ER DET JURIDISKE GRUNNLAGET FOR BEHANDLINGEN AV
                            PERSONOPPLYSNINGENE DINE?<br>Kjøp online</h4>
                        <p><span style="font-weight: 400;">Behandlingen av personopplysningene dine er nødvendig for at
                                Norgeshandel skal kunne utføre tjenester som å håndtere og publisere annonser.</span>
                        </p>

                        <h5 style="font-weight:400;margin:20px 0;">5.1 Direkte markedsføring</h5>

                        <p><span style="font-weight: 400;">Behandlingen av personopplysningene dine er basert på de
                                legitime interessene til Norgeshandel.</span></p>
                        <p><span style="font-weight: 400;"></span></p>


                        <h5 style="font-weight:400;margin:20px 0;">5.2 Kundeservice</h5>

                        <p><span style="font-weight: 400;">Behandlingen av personopplysningene dine er basert på de
                                legitime interessene til Norgeshandel.</span></p>

                        <h5 style="font-weight:400;margin:20px 0;">5.3 Utvikling og forbedring</h5>

                        <p><span style="font-weight: 400;">Behandlingen av personopplysningene dine er basert på de
                                legitime interessene til Norgeshandel.</span></p>

                        <h5 style="font-weight:400;margin:20px 0;">5.4 Oppfyllelse av rettslige forpliktelser</h5>

                        <p><span style="font-weight: 400;">Behandlingen av personopplysningene dine er nødvendig for at
                                Norgeshandel skal kunne oppfylle sine rettslige forpliktelser.</span></p>

                        <h5 style="font-weight:400;margin:20px 0;">5.5 Forebygging av misbruk og kriminalitet</h5>

                        <p><span style="font-weight: 400;">Behandlingen av personopplysningene dine, for å forhindre
                                misbruk av våre tjenester, er basert på våre legitime interesser.</span></p>


                        <h4 style="font-weight:400;margin:20px 0px;">6.0 HVEM HAR TILGANG TIL PERSONOPPLYSNINGENE DINE?
                        </h4>

                        <p><span style="font-weight: 400;">
                                Opplysningene vi samler inn om deg lagres innen Det europeiske økonomiske
                                samarbeidsområde (“EØS”) men kan også overføres til og behandles i et land utenfor EØS.
                                Alle slike overføringer av personopplysninger utføres i samsvar med gjeldende
                                lovverk.<br>
                                Vi formidler/selger/bytter aldri opplysningene dine til tredjepart i
                                markedsføringsøyemed. Opplysninger som videresendes til tredjeparter vil kun brukes til
                                å tilby deg våre tjenester.<br>
                                "Opplysninger som videresendes til tredjeparter vil kun bli brukt til
                                - å tilby deg tjenestene som er nevnt ovenfor<br>
                                - kommunikasjonsbyråer som sender deg ordrebekreftelser<br>
                                - lager- og distribusjonsleverandører i forbindelse med leveringen av bestillingen
                                din<br>
                                - leverandører av betalingstjenester for betalingen din."<br>
                                Opplysninger som videresendes til tredjeparter vil kun bli brukt til å tilby deg
                                tjenesten som er nevnt ovenfor, til mediabyråer og tekniske leverandører for
                                distribusjon av fysisk og digital direkte markedsføring.<br>
                                Observer at mange av disse foretakene har en rett eller skyldighet til å behandle dine
                                personopplysninger.<br>
                                For overføringer utenfor EØS, vil Norgeshandel bruke standardkontraktsbestemmelser og
                                Privacy Shield som sikkerhetstiltak for land uten en adekvat avgjørelse fra
                                Europakommisjonen.

                            </span>
                        </p>

                        <h4 style="font-weight:400;margin:20px 0px;">7.0 Hvor lenge lagrer vi opplysningene dine?</h4>

                        <p><span style="font-weight: 400;">
                                Vi lagrer informasjonen i henhold til regnskapsføringsreglene i ditt land.<br>
                                Etter denne tidsperioden vil personopplysningene dine slettes.

                            </span>
                        </p>

                        <h4 style="font-weight:400;margin:20px 0px;">8.0 HVILKE RETTIGHETER HAR DU?</h4>
                        <h5 style="font-weight:400;margin:20px 0;">8.1 Rettighet til tilgang:</h5>

                        <p><span style="font-weight: 400;">Du har til enhver tid rett til å be om informasjon om
                                personopplysningene vi oppbevarer om deg. Kontakt Norgeshandel og du vil få tilsendt
                                personopplysningene dine via e-mail.</span></p>

                        <h5 style="font-weight:400;margin:20px 0;">8.2 Rett til korrigering:</h5>

                        <p><span style="font-weight: 400;">Du har rett til å be om korrigering av personopplysningene
                                dine dersom de ikke er korrekte, og dette inkluderer retten til å utfylle ufullstendige
                                personopplysninger.</span></p>

                        <h5 style="font-weight:400;margin:20px 0;">8.3 Rett til sletting:</h5>

                        <p><span style="font-weight: 400;">Du har rett til å slette hvilke som helst personopplysninger
                                behandlet av Norgeshandel når som helst, bortsett fra i følgende situasjoner:<br>
                                - du har en pågående sak hos Kundeservice<br>
                                - du mistenkes for eller har misbrukt våre tjenester i løpet av de siste fire årene<br>
                                - hvis du har utført et kjøp, vil vi beholde personopplysningene dine i forbindelse med
                                transaksjonen for å overholde bokføringsreglene
                            </span></p>

                        <h5 style="font-weight:400;margin:20px 0;">8.4 Din rett til å protestere på direkte
                            markedsføring:</h5>

                        <p><span style="font-weight: 400;">Du har rett til å protestere på direkte markedsføring,
                                inkludert profilanalyser utført med tanke på direkte markedsføringsformål.<br>
                                Du kan velge å ikke motta direkte markedsføring ved å følge instruksene i hver e-mail
                                med markedsføring.<br>
                                Når du gjør det, vil Norgeshandel ikke kunne sende deg flere tilbud via direkte
                                markedsføring eller informasjon basert på ditt samtykke.
                            </span></p>


                        <h5 style="font-weight:400;margin:20px 0;">8.5 Rett til å klage til en tilsynsmyndighet:</h5>

                        <p><span style="font-weight: 400;">Hvis du mener Norgeshandel har behandlet personopplysningene
                                dine på en måte som ikke er korrekt, kan du kontakte oss. Du har også rett til å klage
                                til en tilsynsmyndighet.
                            </span></p>

                        <h4 class="mt-5" style="font-weight:400;">9.INFORMASJONSKAPSLER</h4>

                        <p><span style="font-weight: 400;">En informasjonskapsel – cookie – er en liten tekstfil som
                                lagres på din datamaskin eller mobile enhet og hentes opp derfra ved senere besøk. Hvis
                                du bruker våre tjenester, antar vi at du godkjenner bruken av slike
                                informasjonskapsler.</span></p>

                        <h4 class="mt-5" style="font-weight:400;">10.Hvorfor bruker vi informasjonskapsler?</h4>

                        <p><span style="font-weight: 400;">Vi vil bruke informasjonskapsler til å lagre dine
                                favoritter.<br>
                                Vi bruker sesjonsinformasjonskapsler for eksempel når du bruker funksjonen for å
                                filtrere produkter og når du legger en vare i din favoritt eller under varsler.<br>
                                Vi bruker både førsteparts- og tredjepartsinformasjonskapsler og brukerdata i aggregert
                                og individuell form i analyseverktøy for å optimere nettstedet og presentere deg med
                                relevant markedsføringsmateriale.<br>
                                Noen informasjonskapsler fra tredjeparter blir kontrollert av tjenester som vises på
                                våre sider, men som vi ikke har kontroll over. De kontrolleres av tilbydere av sosiale
                                media, så som Facebook, Twitter, Instagram, slik at brukerne kan dele innhold på
                                nettstedet, og er indikert ved hjelp av deres respektive ikoner.<br>
                                Vi bruker også informasjonskapsler fra tredjeparter som sporer elementer over hele
                                nettstedet vårt for oss, for å tilby deg markedsføring på andre nettsteder/kanaler.
                            </span></p>

                        <h4 class="mt-5" style="font-weight:400;">11.Hvilke typer personopplysninger behandler vi?</h4>

                        <p><span style="font-weight: 400;">Vi vil kun knytte din informasjonskapsel-ID til
                                personopplysninger du har sendt inn, eller som har blitt samlet inn i forbindelse med
                                din kjøp.</span></p>


                        <h4 class="mt-5" style="font-weight:400;">12.Hvem har tilgang til personopplysningene dine?</h4>

                        <p><span style="font-weight: 400;">Opplysninger som videresendes til tredjeparter vil kun bli
                                brukt til å tilby deg tjenestene som er nevnt ovenfor, analyseverktøy for å innhente
                                statistikk for å optimere nettstedet vårt og presentere deg for relevant
                                materiale.</span></p>

                        <h4 class="mt-5" style="font-weight:400;">13.Hva er det juridiske grunnlaget for behandlingen av
                            personopplysningene dine?</h4>

                        <p><span style="font-weight: 400;">Vi vil kun knytte informasjonskapslene dine til
                                personopplysningene dine dersom du er kunde.<br>
                                Behandlingen av personopplysningene dine er basert på din godkjenning når du samtykker
                                til informasjonskapsler.
                            </span></p>


                        <h4 class="mt-5" style="font-weight:400;">14.Hvor lenge lagrer vi opplysningene dine?</h4>

                        <p><span style="font-weight: 400;">Norgeshandel lagrer ikke personopplysningene dine. Det er
                                enkelt å slette informasjonskapsler fra datamaskinen eller på den mobile enheten ved
                                hjelp av nettleseren. Se under “hjelp” i nettleseren for å finne instruksjoner for
                                hvordan du håndterer og sletter informasjonskapsler. Du kan velge å deaktivere
                                informasjonskapsler, eller å motta et varsel hver gang en ny informasjonskapsel blir
                                sendt til din datamaskin eller mobile enhet. Merk deg at du ikke vil kunne bruke alle
                                funksjoner hvis du slår av informasjonskapsler.
                            </span></p>


                    </div>
                </div>
            </section>
            {{-- 
            <footer>
  

                <div class="article-votes mt-5" align="center">
                    <span class="text-center">Var denne artikkelen nyttig?</span><br>
                    <div class="article-votes-controls" role="radiogroup"> <br> <br>
                        <a role="radio" rel="nofollow" class="dme-btn-outlined-blue article-vote article-vote-up"
                            title="Ja" href="#"><i class="fas fa-check"></i>&nbsp; Ja</a> &emsp;
                        <a role="radio" rel="nofollow" class="dme-btn-outlined-blue article-vote article-vote-down"
                            title="Nei" href="#"><i class="fas fa-times"></i>&nbsp; Nei</a><br>
                    </div>
                    <small class="article-votes-count">
                        <span class="article-vote-label mt-5">40 av 73 syntes dette var nyttig</span>
                    </small>
                </div><br> <br>


                <div class="article-more-questions" align="center">
                    Har du flere spørsmål? <a href="#">Send oss en henvendelse</a>
                </div>

            </footer>

            <section class="article-relatives row mt-3">
                <section class="recent-articles col-md-6">
                    <h4 class="recent-articles-title" style="font-weight:400">Nylig viste artikler</h4>
                    <ul>
                        <li><a href="#">Personvernerklæring</a></li>
                        <li><a href="#">Dine data,
                                dine valg! GDPR - hva er det?</a></li>
                        <li><a href="#">Hva
                                betyr statistikken på bedriftsannonsen?</a></li>
                        <li><a href="#">Åpningstider</a></li>
                        <li><a href="#">Nå skal alle bud registreres elektronisk</a></li>
                    </ul>
                </section>

                <section class="related-articles col-md-6">

                    <h4 class="related-articles-title" style="font-weight:400">Relaterte artikler</h4>

                    <ul>

                        <li>
                            <a href="#">Personvernerklæring</a>
                        </li>

                        <li>
                            <a href="#">Oversikt over informasjonskapsler på Norgeshandel </a>
                        </li>

                        <li>
                            <a href="#">Behandling av personopplysninger ved søk på stilling gjennom Norgeshandel</a>
                        </li>

                        <li>
                            <a href="#">Svindelforsøk på SMS/E-post</a>
                        </li>

                        <li>
                            <a href="#">Hva koster det å annonsere på Norgeshandel?</a>
                        </li>

                    </ul>
                </section>


            </section> --}}



        </article>

    </div>
    <br>



</div>

@endsection
