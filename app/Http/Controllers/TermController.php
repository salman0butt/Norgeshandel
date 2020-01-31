<?php

namespace App\Http\Controllers;

use App\Helpers\common;
use App\Term;
use Illuminate\Support\Arr;
use App\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TermController extends Controller
{
//    do not remove these commented arrays
//    private $country = array( "Norge", array( "Akershus", array( "Asker", "Aurskog-Høland", "Bærum", "Eidsvoll", "Enebakk", "Fet", "Frogn - Drøbak", "Gjerdrum", "Hole", "Lørenskog", "Nannestad", "Nesodden", "Nes (Akershus)", "Nittedal", "Oppegård", "Rælingen", "Skedsmo", "Ski", "Sørum", "Ullensaker", "Vestby - Son", "Ås", ), "Aust-Agder", array( "Arendal", "Birkenes", "Bykle", "Evje og Hornnes", "Froland", "Grimstad", "Lillesand", "Risør", "Tvedestrand", "Valle", "Åmli", ), "Buskerud", array( "Bærum", "Drammen", "Flesberg", "Flå", "Gol", "Hemsedal", "Hol", "Hole", "Hurum", "Kongsberg", "Krødsherad", "Lier", "Modum", "Nedre Eiker", "Nes (Buskerud)", "Nore og Uvdal", "Ringerike", "Røyken", "Øvre Eiker", "Ål i Hallingdal", ), "Finnmark", array( "Alta", "Berlevåg", "Hammerfest", "Måsøy", "Nesseby", "Porsanger", "Sør-Varanger", "Vadsø", ), "Hedmark", array( "Alvdal", "Elverum", "Grue", "Hamar", "Kongsvinger", "Løten", "Ringsaker", "Stange", "Stor-Elvdal", "Sør-Odal", "Tolga", "Trysil", "Tynset", "Våler (Hedmark)", "Åmot", ), "Hordaland", array( "Askøy", "Austevoll", "Bergen", "Bømlo", "Etne", "Fjell", "Fusa", "Jondal", "Kvam", "Kvinnherad", "Lindås", "Meland", "Odda", "Osterøy", "Os (Hordaland)", "Radøy", "Samnanger", "Stord", "Tysnes", "Ullensvang", "Ulvik", "Vaksdal", "Voss", "Øygarden", ), "Møre og Romsdal", array( "Aukra", "Aure", "Fræna", "Giske", "Haram", "Hareid", "Herøy (M.R.)", "Kristiansund", "Molde", "Skodje", "Stranda", "Sula", "Sunndal", "Sykkylven", "Ulstein", "Vestnes", "Volda", "Ørsta", "Ålesund", ), "Nordland", array( "Alstahaug", "Andøy", "Bindal", "Bodø", "Brønnøy", "Evenes", "Fauske", "Flakstad", "Hadsel", "Hamarøy", "Lurøy", "Meløy", "Narvik", "Rana", "Saltdal", "Sortland", "Steigen", "Tysfjord", "Vefsn", "Vestvågøy", "Vågan", ), "Oppland", array( "Gausdal", "Gjøvik", "Gran", "Jevnaker", "Lillehammer", "Lunner", "Nord-Aurdal", "Nord-Fron", "Ringebu", "Sel", "Skjåk", "Søndre Land", "Vestre Toten", "Vågå", "Østre Toten", "Øyer", "Øystre Slidre", ), "Oslo", array( "Bjerke", "Bygdøy - Frogner", "Bøler", "Ekeberg - Bekkelaget", "Furuset", "Gamle Oslo", "Grefsen - Kjelsås", "Grorud", "Grünerløkka - Sofienberg", "Hellerud", "Helsfyr - Sinsen", "Lambertseter", "Manglerud", "Nordstrand", "Romsås", "Røa", "Sagene - Torshov", "Sentrum", "Sogn", "Stovner", "St.Hanshaugen - Ullevål", "Søndre Nordstrand", "Ullern", "Uranienborg - Majorstuen", "Vinderen", "Østensjø", ), "Rogaland", array( "Bjerkreim", "Eigersund", "Finnøy", "Gjesdal", "Haugesund", "Hå", "Karmøy", "Klepp", "Randaberg", "Rennesøy", "Sandnes", "Sola", "Stavanger", "Strand", "Suldal", "Time", "Tysvær", "Vindafjord", ), "Sogn og Fjordane", array( "Aurland", "Bremanger", "Eid", "Fjaler", "Flora", "Førde", "Gloppen", "Hyllestad", "Høyanger", "Jølster", "Leikanger", "Sogndal", "Vik", "Vågsøy", "Årdal", ), "Svalbard", "Telemark", array( "Bamble", "Bø (Telemark)", "Hjartdal", "Kragerø", "Kviteseid", "Nissedal", "Nome", "Notodden", "Porsgrunn", "Seljord", "Siljan", "Skien", "Tinn", ), "Troms", array( "Balsfjord", "Bardu", "Harstad", "Ibestad", "Kvæfjord", "Kåfjord", "Lenvik", "Målselv", "Nordreisa", "Tromsø", ), "Trøndelag", array( "Flatanger", "Frosta", "Grong", "Hemne", "Hitra", "Indre Fosen", "Klæbu", "Levanger", "Malvik", "Meldal", "Melhus", "Midtre Gauldal", "Namsos", "Nærøy", "Oppdal", "Orkdal", "Overhalla", "Rennebu", "Røros", "Selbu", "Skaun", "Snåsa", "Steinkjer", "Stjørdal", "Trondheim", "Verdal", "Vikna", "Ørland", "Åfjord", ), "Vestfold", array( "Færder", "Holmestrand", "Horten", "Larvik", "Re", "Sandefjord", "Sande (Vestfold)", "Svelvik", "Tønsberg", ), "Vest-Agder", array( "Farsund", "Flekkefjord", "Kristiansand", "Lindesnes", "Lyngdal", "Mandal", "Marnardal", "Songdalen", "Søgne", "Vennesla", ), "Østfold", array( "Askim", "Eidsberg", "Fredrikstad", "Halden", "Hobøl", "Moss", "Rakkestad", "Rygge", "Råde", "Sarpsborg", "Skiptvet", "Spydeberg", "Våler (Østfold)", ), ), "Utlandet", );
//    private $sector = array( "Franchise/Selvstendig næringsdrivende", "Offentlig", "Organisasjoner","Privat","Samvirke");
//    private $commitment_type = array("Engasjement","Fast","Prosjekt","Lærling","Selvstendig næringsdrivende","Sommer/Sesong","Trainee","Vikariat");
//    private $leadership_category = array("Direktør","Fagleder","Leder");
//    private $industry = array( "Bank, finans og forsikring", "Bil, kjøretøy og verksted", "Butikk og varehandel", "Bygg og anlegg", "Helse og omsorg", "Håndverkstjenester", "Industri og produksjon", "IT", "IT - programvare", "Konsulent og rådgivning", "Offentlig administrasjon", "Olje og gass", "Transport og logistikk", "Økonomi og regnskap", "Annet", );
//    private $job_function = array("Butikkansatt", "Helsepersonell", array("Alternativ medisin", "Bioingeniør", "Ergoterapeut", "Ernæringsfysiolog", "Farmasøyt", "Fysioterapeut", "Helsefagarbeider/hjelpepleier", "Helsesekretær", "Kiropraktor", "Optiker", "Psykolog", "Radiograf", "Tannhelse", "Vernepleier/miljøterapeut",), "Håndverker", array("Andre montører", "Asfaltarbeid", "Betongarbeider", "Blikkenslager/tak", "Bygg/Anleggsleder", "Elektriker", "Elektronikkmontør", "Forskalingssnekker", "Grunnarbeid", "Hjelpearbeider", "Maler/Tapeserer", "Mekaniker", "Murer/Flislegger", "Murmester", "Rørlegger", "Snekker/Tømrer", "Stillasmontør", "Sveiser", "Ventilasjonstekniker",), "Ingeniør", array("Akustikk", "Asfaltingeniør", "Automasjon og instrument", "Boreteknikk/drilling", "Brannsikkerhet", "Bygge- og anleggsteknikk", "Bygningsfysikk", "Elektronikk", "Geomatikk", "Geoteknikk og ingeniørgeologi", "HVAC", "Kjemiingeniør", "Kybernetikk", "Marinteknikk / Naval architecture", "Materialteknologi", "Mekanisk", "Oppmåling og kartlegging", "Rør/struktur", "Samferdselsteknikk og arealplanlegging", "Strukturingeniør", "Subsea", "Taksering", "Teknisk sikkerhet/QHSE", "Vann- og miljøteknikk", "VAR-teknikk", "Vassdrag", "VVS- og klimateknikk",), "IT utvikling", array("Database", "Front-end", "IT-sikkerhet", "QA/Testing", "Systemarkitekt", "Utvikler (generell)",), "Konsulent", "Kontor og administrasjon", array("Kontorarbeid", "Personlig assistent", "Resepsjon", "Sekretær", "Sentralbord",), "Kundeservice", "Ledelse", "Mekanikk og installasjon", "Prosjektledelse", "Rådgivning", "Salg", array("Løsningssalg", "Produktsalg", "Stands- og dørsalg", "Teknisk salg", "Telefonsalg",), "Økonomi og regnskap", array("Controller", "Lønn", "Regnskap", "Revisjon", "Samfunnsøkonomi", "Økonomistyring og budsjettering",), "Annet",);
//        private $deadline = array("Siste frist","Under en uke", "Under tre døgn");

//    private $job_function
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $terms = Term::orderBy('id', 'desc')->get();
        $taxonomies = Taxonomy::orderBy('id', 'desc')->get();
        return view('admin.categories.terms', compact('taxonomies', 'terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $term = new Term(['name'=>$request->name,'slug'=>Str::slug($request->name)])
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        //
    }
}
