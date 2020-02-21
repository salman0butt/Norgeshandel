<?php
use App\Helpers\common;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $country = array( "Norge", array( "Akershus", array( "Asker", "Aurskog-Høland", "Bærum", "Eidsvoll", "Enebakk", "Fet", "Frogn - Drøbak", "Gjerdrum", "Hole", "Lørenskog", "Nannestad", "Nesodden", "Nes (Akershus)", "Nittedal", "Oppegård", "Rælingen", "Skedsmo", "Ski", "Sørum", "Ullensaker", "Vestby - Son", "Ås", ), "Aust-Agder", array( "Arendal", "Birkenes", "Bykle", "Evje og Hornnes", "Froland", "Grimstad", "Lillesand", "Risør", "Tvedestrand", "Valle", "Åmli", ), "Buskerud", array( "Bærum", "Drammen", "Flesberg", "Flå", "Gol", "Hemsedal", "Hol", "Hole", "Hurum", "Kongsberg", "Krødsherad", "Lier", "Modum", "Nedre Eiker", "Nes (Buskerud)", "Nore og Uvdal", "Ringerike", "Røyken", "Øvre Eiker", "Ål i Hallingdal", ), "Finnmark", array( "Alta", "Berlevåg", "Hammerfest", "Måsøy", "Nesseby", "Porsanger", "Sør-Varanger", "Vadsø", ), "Hedmark", array( "Alvdal", "Elverum", "Grue", "Hamar", "Kongsvinger", "Løten", "Ringsaker", "Stange", "Stor-Elvdal", "Sør-Odal", "Tolga", "Trysil", "Tynset", "Våler (Hedmark)", "Åmot", ), "Hordaland", array( "Askøy", "Austevoll", "Bergen", "Bømlo", "Etne", "Fjell", "Fusa", "Jondal", "Kvam", "Kvinnherad", "Lindås", "Meland", "Odda", "Osterøy", "Os (Hordaland)", "Radøy", "Samnanger", "Stord", "Tysnes", "Ullensvang", "Ulvik", "Vaksdal", "Voss", "Øygarden", ), "Møre og Romsdal", array( "Aukra", "Aure", "Fræna", "Giske", "Haram", "Hareid", "Herøy (M.R.)", "Kristiansund", "Molde", "Skodje", "Stranda", "Sula", "Sunndal", "Sykkylven", "Ulstein", "Vestnes", "Volda", "Ørsta", "Ålesund", ), "Nordland", array( "Alstahaug", "Andøy", "Bindal", "Bodø", "Brønnøy", "Evenes", "Fauske", "Flakstad", "Hadsel", "Hamarøy", "Lurøy", "Meløy", "Narvik", "Rana", "Saltdal", "Sortland", "Steigen", "Tysfjord", "Vefsn", "Vestvågøy", "Vågan", ), "Oppland", array( "Gausdal", "Gjøvik", "Gran", "Jevnaker", "Lillehammer", "Lunner", "Nord-Aurdal", "Nord-Fron", "Ringebu", "Sel", "Skjåk", "Søndre Land", "Vestre Toten", "Vågå", "Østre Toten", "Øyer", "Øystre Slidre", ), "Oslo", array( "Bjerke", "Bygdøy - Frogner", "Bøler", "Ekeberg - Bekkelaget", "Furuset", "Gamle Oslo", "Grefsen - Kjelsås", "Grorud", "Grünerløkka - Sofienberg", "Hellerud", "Helsfyr - Sinsen", "Lambertseter", "Manglerud", "Nordstrand", "Romsås", "Røa", "Sagene - Torshov", "Sentrum", "Sogn", "Stovner", "St.Hanshaugen - Ullevål", "Søndre Nordstrand", "Ullern", "Uranienborg - Majorstuen", "Vinderen", "Østensjø", ), "Rogaland", array( "Bjerkreim", "Eigersund", "Finnøy", "Gjesdal", "Haugesund", "Hå", "Karmøy", "Klepp", "Randaberg", "Rennesøy", "Sandnes", "Sola", "Stavanger", "Strand", "Suldal", "Time", "Tysvær", "Vindafjord", ), "Sogn og Fjordane", array( "Aurland", "Bremanger", "Eid", "Fjaler", "Flora", "Førde", "Gloppen", "Hyllestad", "Høyanger", "Jølster", "Leikanger", "Sogndal", "Vik", "Vågsøy", "Årdal", ), "Svalbard", "Telemark", array( "Bamble", "Bø (Telemark)", "Hjartdal", "Kragerø", "Kviteseid", "Nissedal", "Nome", "Notodden", "Porsgrunn", "Seljord", "Siljan", "Skien", "Tinn", ), "Troms", array( "Balsfjord", "Bardu", "Harstad", "Ibestad", "Kvæfjord", "Kåfjord", "Lenvik", "Målselv", "Nordreisa", "Tromsø", ), "Trøndelag", array( "Flatanger", "Frosta", "Grong", "Hemne", "Hitra", "Indre Fosen", "Klæbu", "Levanger", "Malvik", "Meldal", "Melhus", "Midtre Gauldal", "Namsos", "Nærøy", "Oppdal", "Orkdal", "Overhalla", "Rennebu", "Røros", "Selbu", "Skaun", "Snåsa", "Steinkjer", "Stjørdal", "Trondheim", "Verdal", "Vikna", "Ørland", "Åfjord", ), "Vestfold", array( "Færder", "Holmestrand", "Horten", "Larvik", "Re", "Sandefjord", "Sande (Vestfold)", "Svelvik", "Tønsberg", ), "Vest-Agder", array( "Farsund", "Flekkefjord", "Kristiansand", "Lindesnes", "Lyngdal", "Mandal", "Marnardal", "Songdalen", "Søgne", "Vennesla", ), "Østfold", array( "Askim", "Eidsberg", "Fredrikstad", "Halden", "Hobøl", "Moss", "Rakkestad", "Rygge", "Råde", "Sarpsborg", "Skiptvet", "Spydeberg", "Våler (Østfold)", ), ), "Utlandet", );
    private $sector = array( "Franchise/Selvstendig næringsdrivende", "Offentlig", "Organisasjoner","Privat","Samvirke");
    private $commitment_type = array("Engasjement","Fast","Prosjekt","Lærling","Selvstendig næringsdrivende","Sommer/Sesong","Trainee","Vikariat");
    private $leadership_category = array("Direktør","Fagleder","Leder");
    private $industry = array( "Bank, finans og forsikring", "Bil, kjøretøy og verksted", "Butikk og varehandel", "Bygg og anlegg", "Helse og omsorg", "Håndverkstjenester", "Industri og produksjon", "IT", "IT - programvare", "Konsulent og rådgivning", "Offentlig administrasjon", "Olje og gass", "Transport og logistikk", "Økonomi og regnskap", "Annet", );
    private $job_function = array("Butikkansatt", "Helsepersonell", array("Alternativ medisin", "Bioingeniør", "Ergoterapeut", "Ernæringsfysiolog", "Farmasøyt", "Fysioterapeut", "Helsefagarbeider/hjelpepleier", "Helsesekretær", "Kiropraktor", "Optiker", "Psykolog", "Radiograf", "Tannhelse", "Vernepleier/miljøterapeut",), "Håndverker", array("Andre montører", "Asfaltarbeid", "Betongarbeider", "Blikkenslager/tak", "Bygg/Anleggsleder", "Elektriker", "Elektronikkmontør", "Forskalingssnekker", "Grunnarbeid", "Hjelpearbeider", "Maler/Tapeserer", "Mekaniker", "Murer/Flislegger", "Murmester", "Rørlegger", "Snekker/Tømrer", "Stillasmontør", "Sveiser", "Ventilasjonstekniker",), "Ingeniør", array("Akustikk", "Asfaltingeniør", "Automasjon og instrument", "Boreteknikk/drilling", "Brannsikkerhet", "Bygge- og anleggsteknikk", "Bygningsfysikk", "Elektronikk", "Geomatikk", "Geoteknikk og ingeniørgeologi", "HVAC", "Kjemiingeniør", "Kybernetikk", "Marinteknikk / Naval architecture", "Materialteknologi", "Mekanisk", "Oppmåling og kartlegging", "Rør/struktur", "Samferdselsteknikk og arealplanlegging", "Strukturingeniør", "Subsea", "Taksering", "Teknisk sikkerhet/QHSE", "Vann- og miljøteknikk", "VAR-teknikk", "Vassdrag", "VVS- og klimateknikk",), "IT utvikling", array("Database", "Front-end", "IT-sikkerhet", "QA/Testing", "Systemarkitekt", "Utvikler (generell)",), "Konsulent", "Kontor og administrasjon", array("Kontorarbeid", "Personlig assistent", "Resepsjon", "Sekretær", "Sentralbord",), "Kundeservice", "Ledelse", "Mekanikk og installasjon", "Prosjektledelse", "Rådgivning", "Salg", array("Løsningssalg", "Produktsalg", "Stands- og dørsalg", "Teknisk salg", "Telefonsalg",), "Økonomi og regnskap", array("Controller", "Lønn", "Regnskap", "Revisjon", "Samfunnsøkonomi", "Økonomistyring og budsjettering",), "Annet",);
    private $deadline = array("Siste frist","Under en uke", "Under tre døgn");
    private $pfs_property_type = array('Leilighet', 'Enebolig', 'Tomannsbolig', 'Rekkehus', 'Gårdsbruk/Småbruk', 'Prosjekt', 'Hytte', 'Garasje/Parkering', 'Tomter', 'Annet fritid', 'Produksjon/Industri', 'Hyttetomt', 'Bygård/Flermannsbolig', 'Kontor', 'Andre');
    private $pfs_tenure = array('Aksje','Andel','Annet','Eier Selveier','Obligasjon');
    private $cpfs_property_type = array("Butikk/Handel","Bygård/Flermannsbolig","Garasje/Parkering","Gårdsbruk/Småbruk","Hotell/Overnatting","Kjøpesenter","Kombinasjonslokaler","Kontor","Lager/Logistikk","Produksjon/Industri","Serveringslokale/Kantine","Undervisning/Arrangement","Verksted","Andre",);

    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('parent')->default(0);
            $table->integer('taxonomy_id');
            $table->string('detail')->nullable();
            $table->timestamps();
        });
        common::insert_term_array($this->industry, \App\Taxonomy::where('slug', 'industry')->get()->first()->id, 0);
        common::insert_term_array($this->job_function, \App\Taxonomy::where('slug', 'job_function')->get()->first()->id, 0);
        common::insert_term_array($this->sector, \App\Taxonomy::where('slug', 'sector')->get()->first()->id, 0);
        common::insert_term_array($this->commitment_type, \App\Taxonomy::where('slug', 'commitment_type')->get()->first()->id, 0);
        common::insert_term_array($this->leadership_category, \App\Taxonomy::where('slug', 'leadership_category')->get()->first()->id, 0);
        common::insert_term_array($this->deadline, \App\Taxonomy::where('slug', 'deadline')->get()->first()->id, 0);
        common::insert_term_array($this->country, \App\Taxonomy::where('slug', 'country')->get()->first()->id, 0);
        common::insert_term_array($this->pfs_property_type, \App\Taxonomy::where('slug', 'pfs_property_type')->get()->first()->id, 0);
        common::insert_term_array($this->pfs_tenure, \App\Taxonomy::where('slug', 'pfs_tenure')->get()->first()->id, 0);
        common::insert_term_array($this->cpfs_property_type, \App\Taxonomy::where('slug', 'cpfs_property_type')->get()->first()->id, 0);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terms');
    }
}
