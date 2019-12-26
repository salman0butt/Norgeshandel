<?php

namespace App\Http\Controllers;

use App\Term;
use App\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $taxonomy = Taxonomy::where('slug', 'job-function')->first();
//        $job_functions = array('Architect', 'Librarian', 'Art Director', 'Child care', 'Biologist', 'FIREPROTECTION', 'SUPPORT', 'CASHIER', 'STORE_MANAGER', 'DESIGN', 'DOCUMENTATION', 'MAINTENANCE', 'NEGOTIATOR', 'BUSINESS DEVELOPMENT', 'FELLOW', 'PHOTO', 'FRANCHISE', 'POLY', 'BARBER', 'HEALTH', 'ACCOMMODATION', 'HR', 'SKIN_CARE', 'HANDYMAN', 'ENGINEER', 'PURCHASING', 'ITSUPP', 'ITDEVELOP', 'JOURNALIST', 'LAW', 'CONSULTANT', 'OFFICE', 'COORDINATION', 'CUSTOMER_SERVICE', 'COURSES', 'QA', 'MANAGEMENT', 'DOCTOR', 'WAREHOUSING', 'MARKETER', 'OPERATOR', 'WAITER', 'BROKER', 'MECHANIC', 'CHURCH_WORK', 'MILITARY', 'SOCIAL_WORKER', 'FLIGHTCREW', 'PLANNING', 'POLICE', 'PR', 'PRIEST', 'PRODUCTION', 'PRODUCT_MANAGEMENT', 'PROJECT', 'CLEANING', 'AUDIT', 'COUNSELLING', 'CASE OFFICER', 'SALES', 'SECURITY', 'SHIPPING', 'SOCIONOM', 'NURSE', 'TECHSTAFF', '', '', '', '', '', '', '', '');
//        $job_functions = array('Arkitekt og planleggin', 'Arkivar og biblioteka', 'Art director', 'Barnehage', 'Barnevernspedago', 'Biolog', 'Brannver', 'Brukerstøtte/support', 'Butikkansat', 'Butikksjef', 'Design', 'Dokumentasjon', 'Driftsoperatør/vaktmeste', 'Forhandling', 'Forretningsutvikling og strateg', 'Forskning/Stipendiat', 'Foto, lyd og ly', 'Franchise', 'Frisø', 'Geologi/Fysikk/Kjemi', 'Helsepersonell', 'HM', 'HR, personal og rekrutterin', 'Hudpleie', 'Håndverker', 'Ingeniør', 'Innkjøp/forhandlin', 'IT drift og vedlikehold', 'IT utvikling', 'Journalist', 'Jurist', 'Konsulen', 'Kontor og administrasjon', 'Koordinering', 'Kundeservic', 'Kurs og opplæring', 'Kvalitetssikrin', 'Ledelse', 'Lege', 'Logistikk og lage', 'Markedsfører', 'Maskinfører og', 'Mat og servering', 'Megle', 'Mekanikk og installasjon', 'Menighetsarbei', 'Militært personell', 'Omsorg og sosialt arbei', 'Pilot og flypersonell', 'Planlegge', 'Politi', 'PR og informasjo', 'Prest', 'Produksjon', 'Produktledels', 'Prosjektledelse', 'Renhol', 'Revisjon og kontroll', 'Rådgivnin', 'Saksbehandler', 'Sal', 'Salgsledels', 'Samfunnsviter', 'Sikkerhe', 'Sjøfart', 'Sosiono', 'Sykepleier', 'Teknisk personell', 'Teknisk servic', 'Teknisk tegner', 'Tekstforfatte', 'Tolk/oversetter', 'Transport og sjåfø', 'Trener / Personlig trener', 'Undervisning og pedagogik', 'Utøvende kuns', 'Vakt og sikkerhet', 'Veterinær og dyrepleie', 'Økonomi og regnskap', 'Anne');
//        $parent = Term::where('slug', str::slug('Økonomi og regnskap'))->first();
//        foreach ($job_functions as $job_function){
//            $term = new Term([
//                'name'=>$job_function,
//                'slug'=>str::slug($job_function),
//                'parent'=>$parent->id
//            ]);
//            $taxonomy->terms()->save($term);
//        }
//




//        $taxonomy = Taxonomy::where('slug', 'industry')->first();
//        $industries = array('Arbeidstaker- og arbeidsgiverorganisasjone', 'Arkitektur, areal og interiø', 'Arkiv og bibliotek', 'Bank, finans og forsikrin', 'Barn, skole og undervisnin', 'Bil, kjøretøy og verksted', 'Bil- og bildelproduksjo', 'Butikk og varehande', 'Bygg og anlegg', 'Drift og vedlikeholdstjeneste', 'Dyr og dyrehels', 'Eiendom', 'Elektronik', 'Event og arrangemente', 'Farmasi og legemiddel', 'Fiskeri og oppdret', 'Forlag og trykker', 'Forskning, utdanning og vitenskap', 'Forsvar og militæ', 'Grossisthandel import/ekspor', 'Helse og omsorg', 'Hotell og overnattin', 'HR, organisasjonsutvikling og rekrutterin', 'Håndverkstjenester', 'Ideelle organisasjone', 'Idrett og trenin', 'Industri og produksjon', 'Internettbaserte tjeneste', 'IT - maskinvare', 'IT - programvar', 'Jordbruk og skogbru', 'Juridiske tjenester', 'Kirke og menighe', 'Kjemisk industr', 'Konsulent og rådgivning', 'Kraft og energ', 'Kunst og kultu', 'Luftfart', 'Maritim og offshor', 'Markedsanalys', 'Markedsføring og annonsering', 'Matvareproduksjon og -industr', 'Medie- og innholdsproduksjo', 'Medisinsk utstyr og rekvisita', 'Metaller og minerale', 'Miljøtjeneste', 'Museer, gallerier og kulturminne', 'Musik', 'Offentlig administrasjo', 'Olje og gass', 'Organisasjone', 'Politi og sikkerhe', 'PR, informasjon og kommunikasjon', 'Reise og turism', 'Renovasjon og renhol', 'Restaurant, mat og uteliv', 'Shippin', 'Storhusholdning og caterin', 'Tekstil', 'Telekommunikasjo', 'Transport og logistik', 'Trevareindustri', 'Underholdnin', 'Velvær', 'Verksindustri', 'Økonomi og regnska', 'Annet');
//
//        foreach ($industries as $industry){
//            $term = new Term(['name'=>$industry, 'slug'=>str::slug($industry)]);
//            $taxonomy->terms()->save($term);
//        }
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
        //
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
