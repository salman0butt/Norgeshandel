<form action="#" method="post" id="commercial_property_for_rent" enctype="multipart/form-data">
@php

     $commercial_property_for_rent = new \App\CommercialPropertyForRent();
    if(isset($commercial_for_rent)){
        $commercial_property_for_rent = $commercial_for_rent;
    }

    $country = \App\Taxonomy::where('slug', 'country')->first();
    $countries = $country->terms;

    $property_type = explode(',', $commercial_property_for_rent->property_type);
    $facilities = explode(',', $commercial_property_for_rent->facilities);
    

@endphp
  @if(Request::is('add/new/commercial/property/for/rent/*/edit'))
  @method('PATCH')
  @endif
                        <div class="pl-3">
                            <!-- checkbox -->
                            <div class="form-group">
                                <h3 class="u-t5">Type lokale</h3>
                                <div class="row">
                                    <div class="col-md-4 input-toggle">
                                        <input data-selector="" id="property_type-OFFICE" type="checkbox" value="Kontor" name="property_type[]" {{ (in_array("Kontor", $property_type))?"checked":"" }}>
                                        <label class="smalltext" for="property_type-OFFICE"> Kontor</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input data-selector="" id="property_type-BUSINESS" type="checkbox" value="Butikk/Handel" name="property_type[]" {{ (in_array("Butikk/Handel", $property_type))?"checked":"" }}>
                                        <label class="smalltext" for="property_type-BUSINESS"> Butikk/Handel</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input data-selector="" id="property_type-INDUSTRIAL" type="checkbox" value="Produksjon/Industri" name="property_type[]" {{ (in_array("Produksjon/Industri", $property_type))?"checked":"" }}>
                                        <label class="smalltext" for="property_type-INDUSTRIAL"> Produksjon/Industri</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input data-selector="" id="property_type-WAREHOUSE" type="checkbox" value="Lager/Logistikk" name="property_type[]" {{ (in_array("Lager/Logistikk", $property_type))?"checked":"" }}>
                                        <label class="smalltext" for="property_type-WAREHOUSE"> Lager/Logistikk</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input data-selector="" id="property_type-MULTIPURPOSEAREA" type="checkbox" value="Kombinasjonslokaler" name="property_type[]" {{ (in_array("Kombinasjonslokaler", $property_type))?"checked":"" }}>
                                        <label class="smalltext" for="property_type-MULTIPURPOSEAREA"> Kombinasjonslokaler</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input data-selector="" id="property_type-FARM" type="checkbox" value="Gårdsbruk/Småbruk" name="property_type[]" {{ (in_array("Gårdsbruk/Småbruk", $property_type))?"checked":"" }}>
                                        <label class="smalltext" for="property_type-FARM"> Gårdsbruk/Småbruk</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input data-selector="" id="property_type-MULTIUNITS" type="checkbox" value="Bygård/Flermannsbolig" name="property_type[]" {{ (in_array("Bygård/Flermannsbolig", $property_type))?"checked":"" }}>
                                        <label class="smalltext" for="property_type-MULTIUNITS"> Bygård/Flermannsbolig</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input data-selector="" id="property_type-SHOPPINGMALL" type="checkbox" value="Kjøpesenter" name="property_type[]" {{ (in_array("Kjøpesenter", $property_type))?"checked":"" }}>
                                        <label class="smalltext" for="property_type-SHOPPINGMALL"> Kjøpesenter</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input data-selector="" id="property_type-MECHSHOP" type="checkbox" value="Verksted" name="property_type[]" {{ (in_array("Verksted", $property_type))?"checked":"" }}>
                                        <label class="smalltext" for="property_type-MECHSHOP"> Verksted</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input data-selector="" id="property_type-GARAGE" type="checkbox" value="Garasje/Parkering" name="property_type[]" {{ (in_array("Garasje/Parkering", $property_type))?"checked":"" }}>
                                        <label class="smalltext" for="property_type-GARAGE"> Garasje/Parkering</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input data-selector="" id="property_type-HOTEL" type="checkbox" value="Hotell/Overnatting" name="property_type[]" {{ (in_array("Hotell/Overnatting", $property_type))?"checked":"" }}>
                                        <label class="smalltext" for="property_type-HOTEL"> Hotell/Overnatting</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input data-selector="" id="property_type-RESTAURANT" type="checkbox" value="Serveringslokale/Kantine" name="property_type[]" {{ (in_array("Serveringslokale/Kantine", $property_type))?"checked":"" }}>
                                        <label class="smalltext" for="property_type-RESTAURANT"> Serveringslokale/Kantine</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input data-selector="" id="property_type-LEARNINGFACILITY" type="checkbox" value="Undervisning/Arrangement" name="property_type[]" {{ (in_array("Undervisning/Arrangement", $property_type))?"checked":"" }}>
                                        <label class="smalltext" for="property_type-LEARNINGFACILITY"> Undervisning/Arrangement</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input data-selector="" id="property_type-OTHER" type="checkbox" value="OTHER" name="property_type[]" {{ (in_array("OTHER", $property_type))?"checked":"" }}>
                                        <label class="smalltext" for="property_type-OTHER"> Andre</label>
                                    </div>
                                </div>
                            </div>
                            <!--                            selection-->
                            <div class="form-group">
                                <h3 class="u-t5">Land</h3>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <select class="dme-form-control" id="country_code" name="countrty">
                                          @foreach($countries as $ctry)
                                       <option value="{{$ctry['name']}}"{{ ($commercial_property_for_rent->location == $ctry['name']) ? 'selected' : '' }}>{{$ctry['name']}}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Postnummer</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input type="text" name="zip_code" value="{{ $commercial_property_for_rent->zip_code }}" class="dme-form-control">
                                        <span id="zip_code_city_name"></span>
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                            </div>
                            <!--                            full input-->
                            <div class="form-group">
                                <h3 class="u-t5">Gateadresse (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <input type="text" name="street_address" value="{{ $commercial_property_for_rent->street_address }}" class="dme-form-control">
                            <span class="u-t5">Forklar kort om adkomsten til boligen og hvordan man finner fram, fortell gjerne om nærhet til vei, buss og tog.</span>
                                    </div>
                                </div>
                            </div>
                            <!--                            text area-->
                            <div class="form-group">
                                <h3 class="u-t5">Adkomst (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <textarea name="venue_description" value="" id="beskrivelse" cols="30" rows="10">{{ $commercial_property_for_rent->venue_description }}</textarea>
                                        <span class="u-t5">Forklar kort om adkomsten til lokalet og hvordan man finner fram, fortell gjerne om nærhet til vei, buss og tog.</span>
                                    </div>
                                </div>
                            </div>
                            <!--                            text area-->
                            <div class="form-group">
                                <h3 class="u-t5">Beliggenhet (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <textarea name="location_description" id="beskrivelse" cols="30" rows="10">{{ $commercial_property_for_rent->location_description }}</textarea>
                                        <span class="u-t5">Forklar kort om beliggenheten, omgivelsene, attraktive naturforhold, betraktninger om lokaliseringsfordeler og strøksattraktivitet</span>
                                    </div>
                                </div>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Kommunenummer (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input type="text" value="{{ $commercial_property_for_rent->municipal_number }}" name="municipal_number" class="dme-form-control">
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                                <span class="u-t5">Identifikasjonsnummeret til din kommune. Du kan finne ditt kommunenummer på kartverkets hjemmesider.</span>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Bruksnummer (Bnr) (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input type="text" value="{{ $commercial_property_for_rent->usage_number }}" name="usage_number" class="dme-form-control">
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                                <span class="u-t5">Hvert gårdsnummer er delt inn i bruksnummer, du kan finne dette på kartverkets hjemmesider.</span>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Gårdsnummer (Gnr) (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input type="text" value="{{ $commercial_property_for_rent->farm_number }}" name="farm_number" class="dme-form-control">
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                                <span class="u-t5">Nummeret på gårdsenheten, du kan finne dette på det lokale kartverkets hjemmesider.</span>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Bruttoareal (BTA) fra</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input type="text" name="gross_area_from" value="{{ $commercial_property_for_rent->gross_area_from }}" class="dme-form-control" placeholder="m²">
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                                <span class="u-t5">Bruttoareal beskriver arealet av hele lokalet, inkludert boder, kjellerrom og så videre, målt fra ytterveggenes yttersider.</span>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Bruttoareal (BTA) til</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input type="text" value="{{ $commercial_property_for_rent->gross_area_to }}" name="gross_area_to" class="dme-form-control" placeholder="m²">
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                                <span class="u-t5">Bruttoareal beskriver arealet av hele lokalet, inkludert boder, kjellerrom og så videre, målt fra ytterveggenes yttersider.</span>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Bruksareal (BRA) (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input type="text" value="{{ $commercial_property_for_rent->use_area }}" name="use_area" class="dme-form-control" placeholder="m²">
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                                <span class="u-t5">Bruksarealet er bruttoareal minus den plassen som opptas av yttervegger. Du kan finne bruksarealet i takstrapporten.</span>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Tomteareal (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input type="text" value="{{ $commercial_property_for_rent->land }}" name="land" class="dme-form-control" placeholder="m²">
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                                <span class="u-t5"></span>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Antall kontorplasser (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input type="text" value="{{ $commercial_property_for_rent->number_of_office_space }}" name="number_of_office_space" class="dme-form-control">
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Antall parkeringsplasser (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input type="text" name="number_of_parking_space" value="{{ $commercial_property_for_rent->number_of_parking_space }}" class="dme-form-control">
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Etasje (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input type="text" name="floors" value="{{ $commercial_property_for_rent->floors }}" class="dme-form-control">
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Byggeår (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                            <input type="text" value="{{ $commercial_property_for_rent->year_of_construction }}" name="year_of_construction" class="dme-form-control" placeholder="åååå">
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Renovert år (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input type="text" value="{{ $commercial_property_for_rent->rennovated_year }}" name="rennovated_year" class="dme-form-control" placeholder="åååå">
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                            </div>
                            <!--                            selection-->
                            <div class="form-group">
                                <h3 class="u-t5">Energikarakter (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <select class="dme-form-control" name="energy_grade">
                                            <option value=""></option>
                                            <option value="A" {{ ($commercial_property_for_rent->energy_grade == 'A' ? "selected" :  '') }}>A</option>
                                            <option value="B" {{ ($commercial_property_for_rent->energy_grade == 'B' ? "selected" : '') }}>B</option>
                                            <option value="C" {{ ($commercial_property_for_rent->energy_grade == 'C' ? "selected" : '') }}>C</option>
                                            <option value="D" {{ ($commercial_property_for_rent->energy_grade == 'D' ? "selected" : '') }}>D</option>
                                            <option value="E" {{ ($commercial_property_for_rent->energy_grade == 'E' ? "selected" : '') }}>E</option>
                                            <option value="F" {{ ($commercial_property_for_rent->energy_grade == 'F' ? "selected" : '') }}>F</option>
                                            <option value="G" {{ ($commercial_property_for_rent->energy_grade == 'G' ? "selected" : '') }}>G</option>
                                        </select>
                                        <span class="u-t5">Energikarakter går fra A til G, hvor A er best. Karakteren er basert på beregnet levert energi til boligen. En god energikarakter betyr at boligen er energieffektiv.</span>
                                    </div>
                                </div>
                            </div>
                            <!--                            selection-->
                            <div class="form-group">
                                <h3 class="u-t5">Oppvarmingskarakter (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <select class="dme-form-control" name="heating_character">
                                            <option value=""></option>
                                            <option value="Gul" {{ ($commercial_property_for_rent->heating_character == 'Gul' ? "selected" :  '') }}>Gul</option>
                                            <option value="Lysegrønn" {{ ($commercial_property_for_rent->heating_character == 'Lysegrønn' ? "selected" :  '') }}>Lysegrønn</option>
                                            <option value="Mørkegrønn" {{ ($commercial_property_for_rent->heating_character == 'Mørkegrønn' ? "selected" : '') }}>Mørkegrønn</option>
                                            <option value="Oransje" {{ ($commercial_property_for_rent->heating_character == 'Oransje' ? "selected" : '') }}>Oransje</option>
                                            <option value="Rød" {{ ($commercial_property_for_rent->heating_character == 'Rød' ? "selected" : '') }}>Rød</option>
                                        </select>
                                        <span class="u-t5">Oppvarmingskarakteren forteller om hvor stor andel av boligens oppvarming som gjøres med fossilt brensel og strøm. F.eks. blir karakteren mørkegrønn når andelen er under 30%, mens den blir rød når andelen er over 82,5%.</span>
                                    </div>
                                </div>
                            </div>
                            <!--                            text area-->
                            <div class="form-group">
                                <h3 class="u-t5">Standard/Tekniske opplysninger (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <textarea name="standard_technical_information" id="beskrivelse" cols="30" rows="10">{{ $commercial_property_for_rent->standard_technical_information }}</textarea>
                                        <span class="u-t5">Her kan du feks. gi en kort beskrivelse av standarden på lokalene, samt tilstand på ventilasjon, kjøling, sentralvarme, heis adgangskontroll, brannsikring m.m.</span>
                                    </div>
                                </div>
                            </div>
                            <!--                            checkbox -->
                            <div class="form-group">
                                <h3 class="u-t5">Fasiliteter (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-md-4 input-toggle">
                                        <input id="facilities-AIRCONDITIONING" type="checkbox" value="AIRCONDITIONING" name="facilities[]" {{ (in_array("AIRCONDITIONING", $facilities) ? "checked" : "") }}>
                                        <label class="smalltext" for="facilities-AIRCONDITIONING" > Aircondition</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input id="facilities-ALARM" type="checkbox" value="ALARM" name="facilities[]" {{ (in_array("ALARM", $facilities) ? "checked" : "") }}>
                                        <label class="smalltext" for="facilities-ALARM"> Alarm</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input id="facilities-BROADBAND" type="checkbox" value="Bredbåndstilknytning" name="facilities[]" {{ (in_array("Bredbåndstilknytning", $facilities) ? "checked" : "") }}>
                                        <label class="smalltext" for="facilities-BROADBAND"> Bredbåndstilknytning</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input id="facilities-RECEPTION" type="checkbox" value="Felles resepsjon" name="facilities[]" {{ (in_array("Felles resepsjon", $facilities) ? "checked" : "") }}>
                                        <label class="smalltext" for="facilities-RECEPTION"> Felles resepsjon</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input id="facilities-GARAGE" type="checkbox" value="Garasje/P-plass" name="facilities[]" {{ (in_array("Garasje/P-plass", $facilities) ? "checked" : "") }}>
                                        <label class="smalltext" for="facilities-GARAGE"> Garasje/P-plass</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input id="facilities-LIFT" type="checkbox" value="Heis" name="facilities[]" {{ (in_array("Heis", $facilities) ? "checked" : "") }}>
                                        <label class="smalltext" for="facilities-LIFT"> Heis</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input id="facilities-CANTEEN" type="checkbox" value="Kantine" name="facilities[]" {{ (in_array("Kantine", $facilities) ? "checked" : "") }}>
                                        <label class="smalltext" for="facilities-CANTEEN"> Kantine</label>
                                    </div>
                                    <div class="col-md-4 input-toggle">
                                        <input id="facilities-DRIVEIN" type="checkbox" value="Kjøreport" name="facilities[]" {{ (in_array("Kjøreport", $facilities) ? "checked" : "") }}>
                                        <label class="smalltext" for="facilities-DRIVEIN"> Kjøreport</label>
                                    </div>
                                </div>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Ledig fra / Leies ut fra (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input type="date" value="{{ $commercial_property_for_rent->availiable_from }}" name="availiable_from" class="dme-form-control">
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                                <span class="u-t5">Dato (eks. 31.12.2018 eller 31/12/2018)</span>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Husleie per m² per år (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input type="text" name="rent_per_meter_per_year" value="{{ $commercial_property_for_rent->rent_per_meter_per_year }}" class="dme-form-control" placeholder="Kr.">
                                    </div>
                                    <div class="col-sm-8">
                                    </div>
                                </div>
                                <span class="u-t5">Verditakst blir satt av takstmannen og er forventet salgsverdi eller markedsverdien på din eiendom.</span>
                            </div>
                            <!--                            small input-->
                            <div class="form-group">
                                <h3 class="u-t5">Visningsinformasjon (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-md-12 pr-md-0">
                                        <input type="text" name="display_information" value="{{ $commercial_property_for_rent->display_information }}" class="dme-form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <!--                            button-->
                            <div class="form-group">
                                <h3 class="u-t5">Legg til bilder (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <input type="file" name="commercial_property_for_rent_photos[]" value="{{ $commercial_property_for_rent->commercial_property_for_rent_photos }}"  id="commercial_property_for_rent_photos" class="" multiple>
                                    </div>
                                </div>
                            </div>
                            <!--                            button-->
                            <div class="form-group">
                                <h3 class="u-t5">Legg till pdf</h3>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <input type="file" name="commercial_property_for_rent_pdf[]" value="{{ $commercial_property_for_rent->commercial_property_for_rent_pdf }}" id="commercial_property_for_rent_pdf" class="" multiple>
                                    </div>
                                </div>
                            </div>
                            <!--                            full input-->
                            <div class="form-group">
                                <h3 class="u-t5">Annonseoverskrift</h3>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <input type="text" value="{{ $commercial_property_for_rent->heading }}" name="heading" class="dme-form-control">
                                    </div>
                                </div>
                            </div>
                            <!--                            text area-->
                            <div class="form-group">
                                <h3 class="u-t5">Beskrivelse (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <textarea name="last_description" id="beskrivelse" cols="30" rows="10">{{ $commercial_property_for_rent->last_description }}</textarea>
                                        <span class="u-t5">Fortell om hva som er bra med boligen, hva som er inkludert av møbler og innredning osv. Fortell gjerne litt om nabolaget og nærhet til transport.</span>
                                    </div>
                                </div>
                            </div>
                            <!--                            full input-->
                            <div class="form-group">
                                <h3 class="u-t5">Tekst på lenke (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <input name="link" type="text" value="{{ $commercial_property_for_rent->link }}" class="dme-form-control">
                                    </div>
                                </div>
                            </div>
                            <!--                            full input-->
                            <div class="form-group">
                                <h3 class="u-t5">Lenke for mer informasjon (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-12 pr-md-0">
                                        <input name="link_for_information" value="{{ $commercial_property_for_rent->link_for_information }}" type="text" class="dme-form-control">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <h3 class="u-t5">Telefon (valgfritt)</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input name="phone" value="{{ $commercial_property_for_rent->phone }}" type="text" class="dme-form-control">
                                    </div>
                                    <div class="col-md-8"></div>
                                </div>
                                <span class="u-t5">Hvilket telefonnummer ønsker du at interesserte kjøpere skal kontakte deg på?</span>
                                <br>
                            </div>
                            <div class="form-group">
                                <h3 class="u-t5">Kontaktperson</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input name="contact" value="{{ $commercial_property_for_rent->contact }}" type="text" class="dme-form-control">
                                    </div>
                                    <div class="col-md-8"></div>
                                </div>
                                <br>
                            </div>
                            <div class="form-group">
                                <h3 class="u-t5">E-post</h3>
                                <div class="row">
                                    <div class="col-sm-4 pr-md-0">
                                        <input name="email" value="{{ $commercial_property_for_rent->email }}" type="text" class="dme-form-control">
                                    </div>
                                    <div class="col-md-8"></div>
                                </div>
                                <br>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center mt-5 mb-5 bg-maroon-lighter p-4 radius-8">
                                    <div class="profile-icon">
                                        <img src="@if(Auth::user()->media!=null){{asset(\App\Helpers\common::getMediaPath(Auth::user()->media))}}@else {{asset('public/images/profile-placeholder.png')}} @endif" alt="Profile image" style="width:80px;">
                                    </div>
                                    <div class="profile-name">
                                        <h3 class="text-muted">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h3>
                                    </div>
                                    <p>Hvis denne profilen ikke er riktig kan du endre den under min handel deretter endre profil.</p>
                                </div>
                            </div>

                            <div class="form-group ">
                                <h3 class="u-t5">Publisert</h3>
                                <label class="mb-2 form-check-label" for="published-on">
                                    <input id="published-on" name="published-on" type="checkbox">Ikke vis profilbilde og
 lenke til profilsiden.
                                </label>
                            </div>

                            <hr>
                            <div class="notice"></div>
                            <!-- <input type="button" id="publiserannonsen" class="dme-btn-outlined-blue mb-3 col-12" value="Publiser annonsen!"> -->
                            <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" id="publiserannonsen" class="dme-btn-outlined-blue mb-3 col-12 ladda-button">
                                <span class="ladda-label">Publiser annonsen!</span>
                            </button>
                         
                        </div>
                    </form>
<script>   
    $(document).on('change', 'input[name="zip_code"]', function(e) {
         document.getElementById("zip_code_city_name").innerHTML = '';
    var zip_code = $(this).val();
    var api_url = 'https://api.bring.com/shippingguide/api/postalCode.json';
    // var api_url = 'https://api.bring.com/shippingguide/api/postalCode.json?clientUrl=demodesign.no&pnr=2014';
    var client_url = 'localhost';
    
    if(zip_code){
    var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      const postalCode = JSON.parse(this.responseText);
      document.getElementById("zip_code_city_name").innerHTML = postalCode.result;
        console.log(postalCode.result);
     }
    };
    xhttp.open("GET", api_url+"?clientUrl="+client_url+"&pnr="+zip_code, true);

    xhttp.send();
    }
});
   
    </script>