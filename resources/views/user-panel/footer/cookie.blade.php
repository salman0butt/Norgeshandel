@extends('layouts.landingSite')

@section('page_content')

<style>
.sidebar li {
    list-style:none;
    padding:10px 15px;
    width:100%;
}
.sidebar li a{
    width:100%;
    font-size:14px;
}
.sidebar .active {
    background: #ac304a;
}
.sidebar .active a {
    color: #ffffff !important;
}
.recent-articles ul, .related-articles ul {
    padding-left:0px;
}
.recent-articles li,.related-articles li {
    list-style:none;
    margin: 10px;
}

</style>

<div class="dme-container u-mb32" style="margin-top:3%;">

     <div class="breade-crumb">
            <nav aria-label="breadcrumb">
                <div class="row pl-3 pr-3">
                    <div class="col-md-12 p-0">
                        <ol class="breadcrumb w-100"
                            style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">NorgesHandel.no hjelpesenter </a></li>
                            <li class="breadcrumb-item active"><a href="#">Trygg på NorgesHandel.no</a></li>
                            <li class="breadcrumb-item active"><a href="#">Personvern</a></li>
                        </ol>   
                    </div>
                </div>
            </nav>
        </div>

        <div class="article-container row" style="margin-top:2%;" id="article-container">
            <section class="article-sidebar col-md-3">
                <section class="section-articles collapsible-sidebar">
                    <h6 class="collapsible-sidebar-title sidenav-title">Artikler i denne seksjonen</h6>
                    <ul class="sidebar" style="padding-left: 15px;">

                        <li id="art-305274" class="active mt-4">
                            <a href="#"
                                class="sidenav-item">Personvernerklæring</a>
                        </li>

                        <li id="art-360001156689">
                            <a href="#"
                                class="sidenav-item ">Dine data, dine valg! GDPR - hva er det?</a>
                        </li>

                        <li id="art-211889165">
                            <a href="#"
                                class="sidenav-item ">Ofte stilte spørsmål om personvern på Norgeshandel</a>
                        </li>

                        <li id="art-360001007985">
                            <a href="#"
                                class="sidenav-item ">Endringslogg for personvernerklæringen</a>
                        </li>

                        <li id="art-360006266280">
                            <a href="#"
                                class="sidenav-item ">Behandling av personopplysninger ved registrert interesse for
                                Kommer for salg-boligannonser</a>
                        </li>

                        <li id="art-115004085465">
                            <a href="#"
                                class="sidenav-item ">Behandling av personopplysninger ved søk på stilling gjennom
                                Norgeshandel</a>
                        </li>

                        <li id="art-211876885">
                            <a href="#"
                                class="sidenav-item current-article">Lokal lagring av data og informasjonskapsler</a>
                        </li>

                        <li id="art-208689765">
                            <a href="#"
                                class="sidenav-item ">Oversikt over informasjonskapsler på Norgeshandel </a>
                        </li>

                        <li id="art-305294">
                            <a href="#"
                                class="sidenav-item ">Er det trygt å bruke “Forbli innlogget” funksjonen?</a>
                        </li>

                        <li id="art-115004632729">
                            <a href="#"
                                class="sidenav-item ">Hvorfor blir jeg automatisk logget ut av Norgeshandel?</a>
                        </li>

                    </ul>

                </section>
            </section>

            <article class="article col-md-9">
                <header class="article-header">
                    <h3 title="Lokal lagring av data og informasjonskapsler" class="article-title" style="font-weight:400;">
                        Lokal lagring av data og informasjonskapsler</h3> </header>
        <section class="article-info">
                    <div class="article-content">
                        <div class="article-body">
                                <h4 class="mt-5" style="font-weight:400;">Hva er lokal lagring av data og informasjonskapsler (cookies)?</h4>
                            <p><em><span>Lokal lagring av data og informasjonskapsler (ofte
                                        kalt cookies) </span></em><span style="font-weight: 400;">innebærer at ulike
                                    typer data lagres lokalt på din enhet via nettleseren din. Slike lokalt lagrede data
                                    kan for eksempel inneholde brukerinnstillinger, informasjon om hvordan du har surfet
                                    på våre nettsider, hvilken nettleser du bruker, hvilke annonser du har blitt vist og
                                    tilsvarende atferd hos nettsteder vi har et samarbeid med. </span></p>
                            <p><span style="font-weight: 400;">I Norgeshandel bruker vi for eksempel informasjonskapsler til å
                                    lagre hva du søkte på i flysøket. Dette gjør det enklere for deg å gjøre nye søk
                                    senere, da avreisested og antall reisende vil være forhåndsutfylt.</span></p>
                            <p><span style="font-weight: 400;">Ved å benytte Norgeshandel.no samtykker du i at vi kan sette
                                    informasjonskapsler i din nettleser.</span></p>
                            <h1>
                                <h3 style="font-weight:400;">Lokal lagring og informasjonskapsler (cookies)</h3>
                            </h1>
                            <h2>
                                <h4 style="font-weight:400;font-size:16px;margin:20px 0;">Typer av lokal lagring</h4>
                            </h2>
                            <p><span style="font-weight: 400;">Det Norgeshandeles forskjellig typer av informasjonskapsler, som
                                    kan deles inn på forskjellige måter.</span></p>
                            <ol>
                                <li><strong style="font-weight:600;">Etter utløpstid</strong>
                                    <ol>
                                        <li><span style="font-weight: 400;"><em>Sesjonslagring</em> - inneholder kun
                                                data fra ditt nåværende besøk. Når du avslutter besøket (sesjonen) vil
                                                data bli slettet fra din enhet. Når du for eksempel stenger alle åpne
                                                nettleservinduer eller slår enheten helt av, vil den sesjonsbaserte
                                                dataen slettes automatisk.</span></li>
                                        <li><span style="font-weight: 400;"><em>Vedvarende lagring</em> - denne
                                                informasjonen forblir lagret etter at du avslutter din sesjon, inntil en
                                                bestemt dato. Den varierer med formålet, og kan være i morgen, neste
                                                uke, eller neste år. Vedvarende lagring kan slettes manuelt i
                                                nettleseren din.<br></span><span style="font-weight: 400;"></span></li>
                                    </ol>
                                </li>
                                <li><strong style="font-weight:600;">Etter hvilket domene de tilhører</strong>
                                    <ol>
                                        <li><span style="font-weight: 400;"><em>Førstepart</em> - plasseres av den som
                                                driver nettstedet du er på. Dette er lokal lagring Norgeshandel setter selv,
                                                blant annet for at nettsiden skal fungere og for at du som bruker skal
                                                få en best mulig opplevelse.</span></li>
                                        <li><span style="font-weight: 400;">T<em>redjepart</em> - settes av andre enn
                                                den som driver nettstedet. Dette kan for eksempel være annonsører som
                                                ønsker å måle effekten av annonser.<br></span></li>
                                    </ol>
                                </li>
                            </ol>
                            <p><strong>
                                    <h4><br></h4>
                                </strong>
                                <strong>
                                    <h4 style="font-weight:400;">Andre teknologier som ligner</h4>
                                </strong>
                            </p>
                            <p><span style="font-weight: 400;">Vi kan også bruke nettbøyer/pikseletikketter for å
                                    forenkle bannerannonsering på våre nettsider. Dette er filer som kommer fra vårt
                                    annonsenettverk og vår trafikkleverandør, og som sporer aktiviteten på ulike
                                    nettsteder. Filene lar annonsesystemet kjenne igjen informasjonskapsler og hvilken
                                    enhet du er på, for å forstå hvilke annonser som skal vises og hvilke som har vært
                                    vist.</span></p>
                            <h2>
                                <h5 style="font-weight:400;">Hvorfor bruker Norgeshandel lokal lagring av data?</h5>
                            </h2>
                            <p><span style="font-weight: 400;">Vi bruker lokal lagring av data for å gi deg relevant
                                    informasjon når du besøker nettstedet vårt. For eksempel kan vi lagre historikken
                                    over hvilke annonser du har sett i din nettleser, og se hvilke kategorier du har
                                    vist interesse for den siste uken. </span></p>
                            <p><span style="font-weight: 400;">Vi bruker også lokal lagring for å forenkle og forbedre
                                    våre tjenester, gi deg relevant informasjon når du besøker tjenestene våre, måle
                                    trafikk og for å samle statistikk.</span></p>
                            <p><span style="font-weight: 400;">I tillegg kan vi bruke informasjonskapsler fra
                                    tredjeparter for å måle og analysere bruken av nettsidene og se atferdsmønstre for
                                    å:</span></p>
                            <ol>
                                <li style="font-weight: 400;"><span style="font-weight: 400;">Sette sammen målgrupper
                                        til markedsføringsformål, </span></li>
                                <li style="font-weight: 400;"><span style="font-weight: 400;">Forenkle annonsestyring.
                                    </span></li>
                                <li style="font-weight: 400;"><span style="font-weight: 400;">Forbedre funksjonaliteten
                                        på nettsidene.</span></li>
                            </ol>
                                <h5 style="font-weight:400;margin:20px 0;">Hva med informasjonskapsler fra annonsører og andre tredjeparter?</h5>
                            <p><span style="font-weight: 400;">Når du bruker våre tjenester kan annonsører og andre
                                    tredjeparter plassere informasjonskapsler for å måle og analysere effekten på
                                    annonsering. Vi har utarbeidet strenge retningslinjer for hvordan slike aktører kan
                                    samle inn og bruke data om våre besøkende. Retningslinjene bestemmer at tredjeparter
                                    ikke skal samle inn data på våre nettsider for å bygge profiler, interessegrupper
                                    eller på andre måter spore atferd for å målrette annonser på nettsteder utenfor
                                    Schibsted. Data kan kun samles inn for å analysere og måle effekten av
                                    annonseringen, for eksempel ved å telle antall annonsevisninger, klikk og hvor mange
                                    som går videre (konvertering).</span></p>
                         
                                <h4 style="font-weight:400;margin:20px 0;">Hvordan kan jeg styre cookies fra annonsører og andre tredjeparter?</h4>
                       
                            <p>Listen nedenfor består av de vanligste annonseverktøyene. I tillegg vil det være ulike
                                tredjepartsverktøy avhengig av hvilke annonser som lastes på sidene våre. Schibsted
                                krever at alle disse begrenser sin bruk av data i tråd med vår&nbsp;<a
                                    href="#">Data policy for
                                    annonsører</a>. En rekke aktører lar deg også sette innstillinger som begrenser
                                dataene som brukes for å vise deg annonser på sider som&nbsp;<a
                                    href="#">youronlinechoices.com</a>&nbsp;og&nbsp;<a
                                    href="#">youradchoices.com</a>.</p>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h4><strong>Navn</strong></h4>
                                        </td>
                                        <td>
                                            <h4><strong>Mulighet for deaktivering</strong></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>AppNexus</td>
                                        <td><a href="https://www.appnexus.com/en/company/platform-privacy-policy#choices"
                                                target="_blank"
                                                rel="noopener">https://www.appnexus.com/en/company/platform-privacy-policy#choices</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Adform</td>
                                        <td><a href="http://site.adform.com/privacy-policy/en/" target="_blank"
                                                rel="noopener">http://site.adform.com/privacy-policy/en/</a></td>
                                    </tr>
                                    <tr>
                                        <td>Google DoubleClick&nbsp; &nbsp; &nbsp;&nbsp;</td>
                                        <td><a href="https://support.google.com/ads/answer/2662922?hl=no"
                                                target="_blank"
                                                rel="noopener">https://support.google.com/ads/answer/2662922?hl=no</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Audience Science</td>
                                        <td><a href="https://www.audiencescience.com/privacy/" target="_blank"
                                                rel="noopener">https://www.audiencescience.com/privacy/</a></td>
                                    </tr>
                                    <tr>
                                        <td>C3 Metrics</td>
                                        <td><a href="https://c3tag.com/" target="_blank"
                                                rel="noopener">https://c3tag.com/</a></td>
                                    </tr>
                                    <tr>
                                        <td>Criteo</td>
                                        <td><a href="http://www.criteo.com/privacy/" target="_blank"
                                                rel="noopener">http://www.criteo.com/privacy/</a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4 style="font-weight:400;margin:20px 0;"><br>Hvordan kan jeg se hvilke informasjonskapsler som lagres i nettleseren?</h4>
                            <p><span style="font-weight: 400;">I innstillingene til nettleseren Norgeshandeler du som regel en
                                    oversikt over alle informasjonskapsler som er lagret, slik at du eventuelt kan
                                    slette de du ikke ønsker. Nettleseren lagrer vanligvis alle informasjonskapsler i en
                                    bestemt mappe på harddisken, slik at du også kan undersøke innholdet i mer
                                    detalj.</span></p>
                            <p><span style="font-weight: 400;">Det Norgeshandeles også tjenester som er utviklet nettopp for at
                                    brukere skal kunne følge med på informasjonskapsler og andre sporingsmekanismer, for
                                    eksempel </span><a href="http://www.ghostery.com/"><span
                                        style="font-weight: 400;">www.ghostery.com</span></a><span
                                    style="font-weight: 400;"> eller </span><a href="http://www.disconnect.me/"><span
                                        style="font-weight: 400;">www.disconnect.me</span></a><span
                                    style="font-weight: 400;">.</span></p>
                            <h2>
                                <h4 style="font-weight:400;margin:20px 0;">Oversikt over informasjonskapsler på Norgeshandel</h4>
                            </h2>
                            <p><span style="font-weight: 400;">Norgeshandel har utarbeidet en oversikt over informasjonskapsler
                                    som er på siden til enhver tid. Oversikten omfatter datainnsamling på Norgeshandel.no og i
                                    Norgeshandels app’er. Du som bruker Norgeshandel vil ikke omfattes av alle verktøyene for
                                    datainnsamling samtidig. Vi har delt inn de ulike innsamlingene i bruksområder med
                                    egne oversikter over informasjonskapsler og beskrivelser av hva de brukes
                                    til.</span></p>
                            <p><span style="font-weight: 400;"><a
                                        href="#">Informasjonskapsler
                                        på Norgeshandel</a></span></p>
                          
                                <h4 style="font-weight:400;margin:20px 0px;">Hvordan kan jeg administrere informasjonskapsler i nettleseren?</h4>
                         
                            <p><span style="font-weight: 400;">De fleste nettlesere er innstilt på å akseptere
                                    informasjonskapsler automatisk, men du kan selv endre innstillingene slik at
                                    informasjonskapsler ikke blir akseptert. Husk at dette kan føre til at Norgeshandel.no ikke
                                    fungerer optimalt. For eksempel kan du bli nødt til å logge deg på på nytt hver
                                    gang.</span></p>
                            <p><span style="font-weight: 400;">De samme innstillingene lar deg vanligvis velge hvilke
                                    nettsteder du tillater informasjonskapsler fra, inkludert tredjeparter som er
                                    tilknyttet nettsidene. Du kan også be om å bli varslet hver gang en ny
                                    informasjonskapsel blir lagret. </span></p>
                            <h4 style="font-weight: 400;margin:20px 0px;">Slik går du frem for å slette informasjonskapsler i
                                    ulike nettlesere</h4>
                            <p><span style="font-weight: 400;">Den nøyaktige fremgangsmåten avhenger av enheten din og
                                    hvilken nettleser du bruker:</span></p>
                            <p><a
                                    href="http://windows.microsoft.com/en-GB/internet-explorer/delete-manage-cookies#ie=ie-10"><span
                                        style="font-weight: 400;">Cookie innstillinger i Internet Explorer</span></a>
                            </p>
                            <p><a href="http://support.mozilla.com/en-US/kb/Cookies"><span
                                        style="font-weight: 400;">Cookie innstillinger in Firefox</span></a></p>
                            <p><a href="https://support.google.com/chrome/answer/95647?hl=en&amp;ref_topic=14666"><span
                                        style="font-weight: 400;">Cookie innstillinger i Google Chrome</span></a></p>
                            <p><a href="https://support.apple.com/kb/PH17191?locale=en_US"><span
                                        style="font-weight: 400;">Cookie innstillinger i Safari web</span></a><span
                                    style="font-weight: 400;"> and </span><a
                                    href="http://support.apple.com/kb/HT1677"><span
                                        style="font-weight: 400;">iOS</span></a><span style="font-weight: 400;">.</span>
                            </p>
                            <p><span style="font-weight: 400;">Hvis du ønsker å begrense informasjonskapsler som brukes
                                    til annonsering, kan du laste ned en blank informasjonskapsel (”opt-out cookie”) fra
                                    våre ulike annonsepartnere, eller bruke egne løsninger som for eksempel </span><a
                                    href="http://www.youronlinechoices.com/nor/"><span
                                        style="font-weight: 400;">youronlinechoices.com</span></a><span
                                    style="font-weight: 400;">.</span></p>
                            <p><strong><strong><br></strong></strong>Endringer (nyeste øverst):</p>
                            <p><em>19. august 2019: Rettet en formateringsfeil. Ingen tekstlig endring.</em></p>
                            <p><em>15. november 2017: Utvidet listen med direktelenker for deaktivering av
                                    annonseverktøy.</em></p>
                            <p><em>10. oktober 2017: Lagt inn direktelenker for deaktivering av annonseverktøy.</em></p>
                            <h2>&nbsp;</h2>
                        </div>
                        <div class="article-attachments">
                            <ul class="attachments">

                            </ul>
                        </div>
                    </div>
                </section>

                <footer>
                    <div class="article-footer">


                    </div>

                    <div class="article-votes mt-5" align="center">
                        <span class="text-center">Var denne artikkelen nyttig?</span><br>
                        <div class="article-votes-controls" role="radiogroup"> <br> <br>
                            <a role="radio" rel="nofollow" class="dme-btn-outlined-blue article-vote article-vote-up" title="Ja" href="#"><i class="fas fa-check"></i>&nbsp; Ja</a> &emsp;
                            <a role="radio" rel="nofollow" class="dme-btn-outlined-blue article-vote article-vote-down" title="Nei"
                                href="#"><i class="fas fa-times"></i>&nbsp; Nei</a><br>
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


                </section>



            </article>

    </div>




</div>

@endsection
