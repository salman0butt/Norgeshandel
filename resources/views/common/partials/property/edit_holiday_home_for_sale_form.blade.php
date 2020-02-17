<form action="#" method="post" id="property_holiday_home_for_sale_form" enctype="multipart/form-data">
    <div class="pl-3">
@method('PATCH')
        <div class="form-group">
            <h3 class="u-t5">Annonseoverskrift</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="ad_headline" value="{{ $holiday_home_for_sale->ad_headline }}" type="text" class="dme-form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Postnummer</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="zip_code" type="text" value="{{ $holiday_home_for_sale->zip_code }}" class="dme-form-control">
                     <span id="zip_code_city_name"></span>
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Gateadresse (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="street_address" value="{{ $holiday_home_for_sale->ad_headline }}" type="text" class="dme-form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Beliggenhet</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select name="location" id="situation" class="dme-form-control" data-selector="">
            <option value="{{ $holiday_home_for_sale->location }}">{{ $holiday_home_for_sale->location }}</option>
                        <option value=""></option>
                        <option value="INLAND">Innlandet</option>
                        <option value="MOUNTAINS">På fjellet</option>
                        <option value="COAST">Ved sjøen</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Navn på lokalområde (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="local_area_name" value="{{ $holiday_home_for_sale->local_area_name }}" type="text" class="dme-form-control"
                           placeholder="F.eks. Bjerke eller Kampen">
                    <span class="u-t5">Her kan du skrive inn hvilken bydel eller område eiendommen befinner seg i</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Adkomst og beliggenhet (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="access_and_location" id="beskrivelsethird" cols="30" rows="10">{{ $holiday_home_for_sale->access_and_location }}</textarea>
                    <span class="u-t5">Forklar kort om Adkomst og beliggenheten, omgivelsene, attraktive naturforhold, betraktninger om lokaliseringsfordeler, strøksattraktivitet og hvordan man finner fram, gjerne om nærhet til vei, buss og tog.</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Boligtype</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select id="property_type" class="dme-form-control" name="property_type" data-selector="">
                        <option value="{{ $holiday_home_for_sale->property_type }}">{{ $holiday_home_for_sale->property_type }}</option>
                        <option value=""></option>
                        <option value="Andre">Andre</option>
                        <option value="Enebolig">Enebolig</option>
                        <option value="Gårdsbruk Småbruk">Gårdsbruk/Småbruk</option>
                        <option value="Hytte">Hytte</option>
                        <option value="Leilighet">Leilighet</option>
                        <option value="Rekkehus">Rekkehus</option>
                        <option value="Tomannsbolig">Tomannsbolig</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Eieform (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select id="ownership_type" class="dme-form-control" name="ownership_type" data-selector="">
                        <option value="{{ $holiday_home_for_sale->ownership_type }}">{{ $holiday_home_for_sale->ownership_type }}</option>
                        <option value=""></option>
                        <option value="Aksje">Aksje</option>
                        <option value="Andel">Andel</option>
                        <option value="Annet">Annet</option>
                        <option value="Eier Selveier">Eier (Selveier)</option>
                        <option value="Obligasjon">Obligasjon</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Kommunenummer (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="muncipal_number" value="{{ $holiday_home_for_sale->muncipal_number }}" type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Identifikasjonsnummeret til din kommune, du kan finne dette på det lokale
                    kartverkets hjemmesider.
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Gårdsnummer (Gnr) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="farm_number" value="{{ $holiday_home_for_sale->farm_number }}" type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Nummeret på gårdsenheten, du kan finne dette på det lokale kartverkets
                    hjemmesider.
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Bruksnummer (Bnr) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="usage_number" value="{{ $holiday_home_for_sale->usage_number }}" type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Hvert gårdsnummer er delt inn i bruksnummer, du kan finne dette på det
                    lokale kartverkets hjemmesider.
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Seksjonsnummer (Snr) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="section_number" value="{{ $holiday_home_for_sale->section_number }}" type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Seksjonsnummer får man tildelt når eiendommen seksjoneres. Du kan finne ditt
                    seksjonsnummer på det lokale kartverkets hjemmesider.
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Festenummer (Fnr) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="party_number" value="{{ $holiday_home_for_sale->party_number }}" type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">
                    Brukes når bruksnummer skal deles inn i flere grunneiendommer. Du kan finne festenummeret til din
                    eiendom på det lokale kartverkets hjemmesider.
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Bruksareal (BRA) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="use_area" type="text" value="{{ $holiday_home_for_sale->use_area }}" class="dme-form-control" placeholder="m²">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Bruksarealet er bruttoareal minus den plassen som opptas av yttervegger. Du
                    kan finne bruksarealet i takstrapporten.
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Primærrom (P-ROM)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="primary_room" value="{{ $holiday_home_for_sale->primary_room }}" class="dme-form-control" placeholder="m²">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Arealet av primærrom på eiendommen, sekundærrom tas ikke med i betegnelsen.
                    Du kan finne arealet for primærrom i takstrapporten.
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Bruttoareal (BTA) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="gross_area" value="{{ $holiday_home_for_sale->gross_area }}" type="text" class="dme-form-control" placeholder="m²">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Bruttoareal beskriver arealet av hele boligen, inkludert boder, kjellerrom
                    og så videre, målt fra ytterveggenes yttersider.
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Grunnflate (BYA) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="base" value="{{ $holiday_home_for_sale->base }}" type="text" class="dme-form-control" placeholder="m²">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Det arealet som bygningen dekker på tomten, det vil si 'fotavtrykket' av
                    bygningen.
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Boligareal (BOA) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="housing_area" value="{{ $holiday_home_for_sale->housing_area }}" type="text" class="dme-form-control" placeholder="m²">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Innvendig bruksareal unntatt bodarealet. Arealet måles opp innvendig, og man
                    tar ikke med kott, boder, garasje, terrasser, balkonger, altaner og verandaer
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Arealbeskrivelse (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="area_description" id="beskrivelsefourth" cols="30" rows="10"
                              placeholder="F.eks. grunnflate 60m², stue 30m², kjøkken 10m², WC 10m² osv.">{{ $holiday_home_for_sale->area_description }}</textarea>
                    <span class="u-t5">Her kan du gi en kort oversikt over størrelsen på rom i eiendommen din.</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Byggeår (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="year_of_construction" value="{{ $holiday_home_for_sale->year_of_construction }}" type="text" class="dme-form-control" placeholder="åååå">
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Renovert år (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="renovated_year" value="{{ $holiday_home_for_sale->renovated_year }}" type="text" class="dme-form-control" placeholder="åååå">
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Energikarakter (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select name="energy_grade" class="dme-form-control" id="energy_label.class"
                            name="energy_label.class" data-selector="">
                        <option value=""></option>
                        <option value="{{ $holiday_home_for_sale->energy_grade }}">{{ $holiday_home_for_sale->energy_grade }}</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                    </select>
                    <span class="tu-t5">Energikarakter går fra A til G, hvor A er best. Karakteren er basert på beregnet levert energi til boligen. En god energikarakter betyr at boligen er energieffektiv.</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Oppvarmingskarakter (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select name="heating_character" class="dme-form-control" id="property_details.furnishing"
                            name="property_details.furnishing">
                        <option value=""></option>
                        <option value="{{ $holiday_home_for_sale->heating_character }}">{{ $holiday_home_for_sale->heating_character }}</option>
                        <option value="Delvis møblert">Delvis møblert</option>
                        <option value="Møblert">Møblert</option>
                        <option value="Umøblert">Umøblert</option>
                    </select>
                    <span class="u-t5">Oppvarmingskarakteren forteller om hvor stor andel av boligens oppvarming som gjøres med fossilt brensel og strøm. F.eks. blir karakteren mørkegrønn når andelen er under 30%, mens den blir rød når andelen er over 82,5%.</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Antall soverom</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="number_of_bedrooms" value="{{ $holiday_home_for_sale->number_of_bedrooms }}" type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Antall senger (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="number_of_beds" value="{{ $holiday_home_for_sale->number_of_beds }}" type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Antall parkeringsplasser (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="number_of_parking_spaces" value="{{ $holiday_home_for_sale->number_of_parking_spaces }}" type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Standard (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="standard" id="beskrivelsefifth" cols="30" rows="10">{{ $holiday_home_for_sale->standard }}</textarea>
                    <span class="u-t5">Gi en kort beskrivelse på hvordan boligen fremstår og standarden på overflater og utstyr, nevn gjerne type gulv, kjøkkeninnredning og bad.</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Link til tilstandsrapport (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="state_report_link" value="{{ $holiday_home_for_sale->state_report_link }}" type="text" class="dme-form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Fasiliteter (valgfritt)</h3>
            <div class="row">

                <div class="col-md-4 input-toggle">
                    <input id="facilities-DOWNHILL_SKIING" type="checkbox" value="Alpinanlegg" name="facilities[]">
                    <label class="smalltext" for="facilities-DOWNHILL_SKIING"> Alpinanlegg</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-BALCONY" type="checkbox" value="Balkong/Terrasse" name="facilities[]">
                    <label class="smalltext" for="facilities-BALCONY"> Balkong/Terrasse</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-ROAD_ACCESS" type="checkbox" value="Bilvei frem" name="facilities[]">
                    <label class="smalltext" for="facilities-ROAD_ACCESS"> Bilvei frem</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-BOAT_MOORING" type="checkbox" value="Båtplass" name="facilities[]">
                    <label class="smalltext" for="facilities-BOAT_MOORING"> Båtplass</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-GARAGE" type="checkbox" value="Garasje/P-plass" name="facilities[]">
                    <label class="smalltext" for="facilities-GARAGE"> Garasje/P-plass</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-GOLF" type="checkbox" value="Golfbane" name="facilities[]">
                    <label class="smalltext" for="facilities-GOLF"> Golfbane</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-CHARGING" type="checkbox" value="Lademulighet" name="facilities[]">
                    <label class="smalltext" for="facilities-CHARGING"> Lademulighet</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-PUBLIC_SEWER" type="checkbox" value="Offentlig vann/kloakk" name="facilities[]">
                    <label class="smalltext" for="facilities-PUBLIC_SEWER"> Offentlig vann/kloakk</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-FIREPLACE" type="checkbox" value=" Peis/Ildsted" name="facilities[]">
                    <label class="smalltext" for="facilities-FIREPLACE"> Peis/Ildsted</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-VIEW" type="checkbox" value="Utsikt" name="facilities[]">
                    <label class="smalltext" for="facilities-VIEW"> Utsikt</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-JANITORSERVICE" type="checkbox" value="Vaktmester-/vektertjeneste" name="facilities[]">
                    <label class="smalltext" for="facilities-JANITORSERVICE"> Vaktmester-/vektertjeneste</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-ANGLING" type="checkbox" value="Fiskemulighet" name="facilities">
                    <label class="smalltext" for="facilities-ANGLING"> Fiskemulighet</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-MAINS_ELECTRICITY" type="checkbox" value="Innlagt strøm"
                           name="facilities[]">
                    <label class="smalltext" for="facilities-MAINS_ELECTRICITY"> Innlagt strøm</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-MAINS_WATER" type="checkbox" value="Innlagt vann" name="facilities[]">
                    <label class="smalltext" for="facilities-MAINS_WATER"> Innlagt vann</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-SHORELINE" type="checkbox" value="Strandlinje" name="facilities[]">
                    <label class="smalltext" for="facilities-SHORELINE"> Strandlinje</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-HIKING" type="checkbox" value="Turterreng" name="facilities[]">
                    <label class="smalltext" for="facilities-HIKING"> Turterreng</label>
                </div>

            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Meter over havet (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="meter_above_sea_level" value="{{ $holiday_home_for_sale->meter_above_sea_level }}" type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Tomteareal (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="land" value="{{ $holiday_home_for_sale->land }}" type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-12 input-toggle">
                    <input id="owned_site" type="checkbox" value="DOWNHILL_SKIING">
                    <label class="smalltext" for=""> Eiet tomt (valgfritt)</label>
                    <span class="u-t5">Tomten eies av selger</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Festeavgift (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="party_fee" value="{{ $holiday_home_for_sale->party_fee }}" type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Hva er dagens festeavgift for tomten</div>
                <br>
            </div>
        </div>


        <div class="form-group">
            <h3 class="u-t5">Fasiliteter (valgfritt)</h3>
            <div class="row">
                <div class="col-md-12 input-toggle">
                    <input name="amenities" id="" type="checkbox" value="DOWNHILL_SKIING">
                    <label class="smalltext" for=""> Punktfeste (valgfritt)</label>
                    <span class="u-t5">Tomten eies av selger</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Antall leietagere (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="number_of_tenants" value="{{ $holiday_home_for_sale->number_of_tenants }}"  type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Hva er dagens festeavgift for tomten</div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Beskaffenhet (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="character_description" id="beskrivelse" cols="30" rows="10">{{ $holiday_home_for_sale->character_description }}</textarea>
                    <span class="u-t5">Her kan du feks. fortelle mer om formen på bygningen, utseende, konstruksjon og hvordan boligen er holdt. Kan også være greit å få med noe om tomt og plen, samt innkjørsel og parkering.</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Felleskostnader (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="common_costs" value="{{ $holiday_home_for_sale->common_costs }}" type="text" class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Felleskost. etter avdragsfri periode (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="joint_board_after_interest_fee_period" value="{{ $holiday_home_for_sale->joint_board_after_interest_fee_period }}"  type="text" class="dme-form-control"
                           placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Hva er estimerte felleskostnader etter den eventuelle avdragsfrie perioden? Dette feltet
                må fylles ut dersom boligen har fellesgjeld. Dersom det ikke er avdragsfrihet i fellesgjeld settes
                verdien til dagens felleskostnader.
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Felleskostnader inkluderer (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="shared_costs_include" value="{{ $holiday_home_for_sale->shared_costs_include }}" type="text" class="dme-form-control">
                    <div class="u-t5">Her bør du spesifisere de månedlige totalkostnadene/husleien, sett gjerne opp hva
                        som er felleskostnader og hva som er renter og avdrag.
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Formuesverdi (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="asset_value" value="{{ $holiday_home_for_sale->asset_value }}" type="text" class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Formuesverdi legges til grunn av skatteetaten og kommuner når skatt av boligen skal regnes
                ut. Mer om formuesverdi og hvordan du beregner dette kan du finne på skatteetaten sin hjemmeside.
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Prisantydning</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="asking_price" value="{{ $holiday_home_for_sale->asking_price }}" type="text" class="dme-form-control asking_price" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Minstebeløpet du selger eiendommen for.</div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Omkostninger (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="cost" value="{{ $holiday_home_for_sale->cost }}" type="text" class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Dersom det vil påløpe ekstra omkostninger ved salg av denne eiendommen oppgir du beløpet
                her. Fyll inn 0 hvis det ikke er ekstra omkostninger.
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Omkostninger inkluderer (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="cost_includes" value="{{ $holiday_home_for_sale->cost_includes }}" type="text" class="dme-form-control cost_includes">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Her kan du gi en mer detaljert beskrivelse av hvilke omkostninger som inngår i kjøpet.
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Andel fellesgjeld (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="prcentage_of_joint_debt" value="{{ $holiday_home_for_sale->prcentage_of_joint_debt }}" type="text" class="dme-form-control prcentage_of_joint_debt"
                           placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Fellesgjeld for din bolig. Har du ikke fellesgjeld på din bolig setter du denne verdien
                til 0.
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Totalpris</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="total_price" value="{{ $holiday_home_for_sale->total_price }}" id="total_price" value="" type="text" class="dme-form-control">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Regnes ut som summen av prisantydning, fellesgjeld og omkostninger. Alle disse tre feltene
                må fylles ut for at totalpris skal vises.
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Verditakst (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="value_rate" value="{{ $holiday_home_for_sale->value_rate }}" type="text" class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Verditakst blir satt av takstmannen og er forventet salgsverdi eller markedsverdien på din
                eiendom.
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Lånetakst (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="loan_rate" value="{{ $holiday_home_for_sale->loan_rate }}" type="text" class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Lånetakst vil si den boligverdien som banken bruker for lån, pant og eventuelt tvangssalg
                av boliger. Lånetaksten er basert på verditaksten.
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Andel fellesformue (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="percentage_of_common_health" value="{{ $holiday_home_for_sale->percentage_of_common_health }}" type="text" class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Boligens andel av borettslagets fellesformue</div>
        </div>


        <div class="form-group">
            <h3 class="u-t5">Link til takstdokumenter (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="link_to_terif_documents" value="{{ $holiday_home_for_sale->link_to_terif_documents }}" type="text" class="dme-form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Link til salgsoppgave (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="task_link" type="text" value="{{ $holiday_home_for_sale->task_link }}" class="dme-form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Bilder (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="file" name="property_home_for_sale_photos[]" id="property_home_for_sale_photos"
                           class="" multiple>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Beskrivelse (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="description" id="beskrivelsefirst" cols="30" rows="10">{{ $holiday_home_for_sale->description }}</textarea>
                    <span class="u-t5">Fortell om hva som er bra med boligen, hva som er inkludert av møbler og innredning osv. Fortell gjerne litt om nabolaget og nærhet til transport.</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Vesentlige opplysninger (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="essential_information" id="beskrivelsecond" cols="30" rows="10"
                              placeholder="F.eks. Taket på det ene soverommet lekker. Det elektriske anlegget i kjelleren er utført av ufaglært.">{{ $holiday_home_for_sale->essential_information }}</textarea>
                    <span class="u-t5">Opplysninger om vesentlige kjente feil og mangler som er av betydning for kjøper. Dette kan f.eks være større fysiske skader på boligen, endringer på boligen som er gjort uten å skaffe nødvendig tillatelse, byggeprosjekter som kan påvirke boligen eller utført arbeid på eiendommen av ufaglærte. Henvis også gjerne til takst.</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Last opp komplett salgsinformasjon</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <!-- <button type="button" id="sales_quote class="dme-btn-outlined-blue">Legg til salgsoppgave</button> -->
                    <input type="file" name="property_home_for_sale_sale_quote[]" id="property_home_for_sale_sale_quote"
                           class="" multiple>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Video (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="video" type="text" value="{{ $holiday_home_for_sale->video }}" class="dme-form-control">
                    <span class="u-t5">Kopier eller skriv inn linken til en video på Youtube eller Vimeo.</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">PDF-vedlegg (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <!-- <button type="button" class="dme-btn-outlined-blue">Legg til pdf</button> -->
                    <input type="file" name="property_home_for_sale_pdf_photos[]" id="property_home_for_sale_pdf_photos"
                           class="" multiple>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Visningsdato (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input name="delivery_date[]" value="{{ $holiday_home_for_sale->delivery_date }}" type="date" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Dato (eks. 31.12.2017 eller 31/12/2017)</div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Fra klokken (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input name="from_clock[]" value="{{ $holiday_home_for_sale->from_clock }}" type="text" class="dme-form-control" placeholder="tt.mm">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Tid (eksempel 18:00)</div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Til klokken (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input name="clockwise[]" value="{{ $holiday_home_for_sale->clockwise }}" type="text" class="dme-form-control" placeholder="tt.mm">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Tid (eksempel 19:30)</div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Merknad (valgfritt)</h3>
            <div class="row">
                <div class="col-md-12 pr-md-0">
                    <input name="note[]" value="{{ $holiday_home_for_sale->note }}" type="text" class="dme-form-control"
                           placeholder="F.eks.: visning etter avtale">
                </div>
                <div class="col-md-12 u-t5">Tid (eksempel 19:30)</div>
            </div>
        </div>


        <div id="add_more_viewing_times_fields">

        </div>

        <div class="form-group">
            <h3 class="u-t5">Bilder (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <button id="add_more_viewing_times_sales" ype="button" class="dme-btn-outlined-blue">+ Legg til
                        flere visningstidspunkt
                    </button>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Telefon (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="phone" value="{{ $holiday_home_for_sale->phone }}" type="tel" id="phone" class="dme-form-control">
                    <span id="valid-msg" class="hide"></span>
                    <span id="error-msg" class="hide"></span>
                </div>
                <div class="col-md-8"></div>
                <span class="u-t5">Hvilket telefonnummer ønsker du at interesserte kjøpere skal kontakte deg på?</span>
                <br>
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-12 text-center mt-5 mb-5 bg-maroon-lighter p-4 radius-8">
                <div class="profile-icon">
                    <img src="@if(Auth::user()->media!=null){{asset(\App\Helpers\common::getMediaPath(Auth::user()->media))}}@else {{asset('public/images/profile-placeholder.png')}} @endif" alt="Profile image" style="width:80px;">
                </div>
                <div class="profile-name">
                    <h3 class="text-muted">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h3>
                </div>
                <p>Hvis denne profilen ikke er riktig kan du endre den under Min handel deretter Endre profil.</p>
            </div>
        </div>

        <div class="form-group ">
            <h3 class="u-t5">Publisert</h3>
            <label class="mb-2 form-check-label" for="published-on">
                <input id="published-on" name="published_on" type="checkbox">Ikke vis profilbilde og
 lenke til profilsiden.
            </label>
        </div>

        <hr>
        <div class="notice"></div>
        <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" id="publiserannonsen"
                class="dme-btn-outlined-blue mb-3 col-12 ladda-button"><span class="ladda-label">Oppdater annonser!</span></button>
     
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