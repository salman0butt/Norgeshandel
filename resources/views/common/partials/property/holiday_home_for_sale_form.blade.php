<form action="#" method="post" id="property_holiday_home_for_sale_form" class="dropzone addMorePics p-0" data-action="@if(Request::is('holiday/home/for/sale/*/edit')){{url('update-upload-images?ad_id='.$holiday_home_for_sale1->ad->id)}}
      @else {{route('upload-images')}} @endif" enctype="multipart/form-data" data-append_input='yes'>
    <div class="pl-3">
        @php
        $holiday_home_for_sale = new \App\PropertyHolidaysHomesForSale();
        if(isset($holiday_home_for_sale1)){
        $holiday_home_for_sale = $holiday_home_for_sale1;
        }

        $country = \App\Taxonomy::where('slug', 'country')->first();
        $countries = $country->terms;

        // $property_type = explode(',', $commercial_property_for_rent->property_type);
        // $facilities = explode(',', $commercial_property_for_rent->facilities);


        @endphp
        @if(Request::is('holiday/home/for/sale/*/edit'))
        @method('PATCH')
        @endif
        <input type="hidden" name="upload_dropzone_images_type" value="holiday_home_for_sale_temp_images">
        <div class="form-group">
            <h3 class="u-t5">Annonseoverskrift</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="ad_headline" value="{{ $holiday_home_for_sale->ad_headline }}" type="text"
                        class="dme-form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Postnummer</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="zip_code" type="text" value="{{ $holiday_home_for_sale->zip_code }}"
                        class="dme-form-control">
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
                    <input name="street_address" value="{{ $holiday_home_for_sale->ad_headline }}" type="text"
                        class="dme-form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Beliggenhet</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select name="location" id="situation" class="dme-form-control" data-selector="">
                        <option value="{{ $holiday_home_for_sale->location }}">{{ $holiday_home_for_sale->location }}
                        </option>
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
                    <input name="local_area_name" value="{{ $holiday_home_for_sale->local_area_name }}" type="text"
                        class="dme-form-control" placeholder="Område.">

                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Adkomst og beliggenhet (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="access_and_location" id="beskrivelsethird" cols="30"
                        rows="10">{{ $holiday_home_for_sale->access_and_location }}</textarea>

                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Boligtype</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select id="property_type" class="dme-form-control" name="property_type" data-selector="">
                        <option value="{{ $holiday_home_for_sale->property_type }}">
                            {{ $holiday_home_for_sale->property_type }}</option>
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
                        <option value="{{ $holiday_home_for_sale->ownership_type }}">
                            {{ $holiday_home_for_sale->ownership_type }}</option>
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
                    <input name="muncipal_number" value="{{ $holiday_home_for_sale->muncipal_number }}" type="text"
                        class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Dette finner du på kartverkets hjemmeside
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Gårdsnummer (Gnr) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="farm_number" value="{{ $holiday_home_for_sale->farm_number }}" type="text"
                        class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Dette finner du på kartverkets hjemmeside
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Bruksnummer (Bnr) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="usage_number" value="{{ $holiday_home_for_sale->usage_number }}" type="text"
                        class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Dette finner du på kartverkets hjemmeside
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Seksjonsnummer (Snr) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="section_number" value="{{ $holiday_home_for_sale->section_number }}" type="text"
                        class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Du kan finne ditt seksjonsnummer på kartverkets hjemmesider.
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Festenummer (Fnr) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="party_number" value="{{ $holiday_home_for_sale->party_number }}" type="text"
                        class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">
                    Du kan finne festenummeret til din eiendom på kartverkets hjemmesider.
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Bruksareal (BRA) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="use_area" type="text" value="{{ $holiday_home_for_sale->use_area }}"
                        class="dme-form-control" placeholder="m²">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Du kan finne bruksarealet i takstrapporten.
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Primærrom (P-ROM)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="primary_room" value="{{ $holiday_home_for_sale->primary_room }}"
                        class="dme-form-control" placeholder="m²">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Du kan finne arealet for primærrom i takstrapporten.
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Bruttoareal (BTA) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="gross_area" value="{{ $holiday_home_for_sale->gross_area }}" type="text"
                        class="dme-form-control" placeholder="m²">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Bruttoareal er totale arealet ink yttervegger
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Grunnflate (BYA) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="base" value="{{ $holiday_home_for_sale->base }}" type="text" class="dme-form-control"
                        placeholder="m²">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Det arealet som bygningen dekker på tomten.
                </div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Boligareal (BOA) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="housing_area" value="{{ $holiday_home_for_sale->housing_area }}" type="text"
                        class="dme-form-control" placeholder="m²">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Innvendig brukssareal</div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Arealbeskrivelse (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="area_description" id="beskrivelsefourth" cols="30"
                        rows="10">{{ $holiday_home_for_sale->area_description }}</textarea>
                    <span class="u-t5">Her kan du gi en kort oversikt over størrelsen på rom i eiendommen din.</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Byggeår (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="year_of_construction" value="{{ $holiday_home_for_sale->year_of_construction }}"
                        type="text" class="dme-form-control" placeholder="åååå">
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Renovert år (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="renovated_year" value="{{ $holiday_home_for_sale->renovated_year }}" type="text"
                        class="dme-form-control" placeholder="åååå">
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
                        <option value="{{ $holiday_home_for_sale->energy_grade }}">
                            {{ $holiday_home_for_sale->energy_grade }}</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                    </select>
                    <span class="tu-t5">Enegikarakter der A er best.</span>
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
                        <option value="{{ $holiday_home_for_sale->heating_character }}">
                            {{ $holiday_home_for_sale->heating_character }}</option>
                        <option value="Delvis møblert">Delvis møblert</option>
                        <option value="Møblert">Møblert</option>
                        <option value="Umøblert">Umøblert</option>
                    </select>
                    <span class="u-t5">Oppvarmingskarakteren forteller om hvor stor andel av boligens oppvarming som
                        gjøres med fossilt brensel og strøm. F.eks. blir karakteren mørkegrønn når andelen er under 30%,
                        mens den blir rød når andelen er over 82,5%.</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Antall soverom</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="number_of_bedrooms" value="{{ $holiday_home_for_sale->number_of_bedrooms }}"
                        type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Antall senger (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="number_of_beds" value="{{ $holiday_home_for_sale->number_of_beds }}" type="text"
                        class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Antall parkeringsplasser (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="number_of_parking_spaces"
                        value="{{ $holiday_home_for_sale->number_of_parking_spaces }}" type="text"
                        class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Standard (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="standard" id="beskrivelsefifth" cols="30"
                        rows="10">{{ $holiday_home_for_sale->standard }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Link til tilstandsrapport (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="state_report_link" value="{{ $holiday_home_for_sale->state_report_link }}" type="text"
                        class="dme-form-control">
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
                    <input id="facilities-PUBLIC_SEWER" type="checkbox" value="Offentlig vann/kloakk"
                        name="facilities[]">
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
                    <input id="facilities-JANITORSERVICE" type="checkbox" value="Vaktmester-/vektertjeneste"
                        name="facilities[]">
                    <label class="smalltext" for="facilities-JANITORSERVICE"> Vaktmester-/vektertjeneste</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-ANGLING" type="checkbox" value="Fiskemulighet" name="facilities">
                    <label class="smalltext" for="facilities-ANGLING"> Fiskemulighet</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input id="facilities-MAINS_ELECTRICITY" type="checkbox" value="Innlagt strøm" name="facilities[]">
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
                    <input name="meter_above_sea_level" value="{{ $holiday_home_for_sale->meter_above_sea_level }}"
                        type="text" class="dme-form-control">
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
                    <input name="party_fee" value="{{ $holiday_home_for_sale->party_fee }}" type="text"
                        class="dme-form-control">
                </div>

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
                    <input name="number_of_tenants" value="{{ $holiday_home_for_sale->number_of_tenants }}" type="text"
                        class="dme-form-control">
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
                    <textarea name="character_description" id="beskrivelse" cols="30"
                        rows="10">{{ $holiday_home_for_sale->character_description }}</textarea>
                    <span class="u-t5">Generelt om eiendommen og adkomst mm.</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Felleskostnader (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="common_costs" value="{{ $holiday_home_for_sale->common_costs }}" type="text"
                        class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Felleskost. etter avdragsfri periode (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="joint_board_after_interest_fee_period"
                        value="{{ $holiday_home_for_sale->joint_board_after_interest_fee_period }}" type="text"
                        class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Felleskostnader inkluderer (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="shared_costs_include" value="{{ $holiday_home_for_sale->shared_costs_include }}"
                        type="text" class="dme-form-control">
                    <div class="u-t5">Hva som inkluderer felleskostnadene pr. mnd.
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Formuesverdi (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="asset_value" value="{{ $holiday_home_for_sale->asset_value }}" type="text"
                        class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Mer om formuesverdi og hvordan du beregner dette kan du finne på skatteetaten sin
                hjemmeside.
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Prisantydning</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="asking_price" value="{{ $holiday_home_for_sale->asking_price }}" type="text"
                        class="dme-form-control asking_price" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Omkostninger (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="cost" value="{{ $holiday_home_for_sale->cost }}" type="text" class="dme-form-control"
                        placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Omkostninger ved salg av eiendom.
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Omkostninger inkluderer (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="cost_includes" value="{{ $holiday_home_for_sale->cost_includes }}" type="text"
                        class="dme-form-control cost_includes">
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
                    <input name="prcentage_of_joint_debt" value="{{ $holiday_home_for_sale->prcentage_of_joint_debt }}"
                        type="text" class="dme-form-control prcentage_of_joint_debt" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>

        </div>
        <div class="form-group">
            <h3 class="u-t5">Totalpris</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="total_price" value="{{ $holiday_home_for_sale->total_price }}" id="total_price"
                        value="" type="text" class="dme-form-control">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Total pris ink fellesgjeld, prisantydning og omkostninger.</div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Verditakst (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="value_rate" value="{{ $holiday_home_for_sale->value_rate }}" type="text"
                        class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Markedsverdi for din eiendom.</div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Lånetakst (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="loan_rate" value="{{ $holiday_home_for_sale->loan_rate }}" type="text"
                        class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Andel fellesformue (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="percentage_of_common_health"
                        value="{{ $holiday_home_for_sale->percentage_of_common_health }}" type="text"
                        class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>

        </div>


        <div class="form-group">
            <h3 class="u-t5">Link til takstdokumenter (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="link_to_terif_documents" value="{{ $holiday_home_for_sale->link_to_terif_documents }}"
                        type="text" class="dme-form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Link til salgsoppgave (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="task_link" type="text" value="{{ $holiday_home_for_sale->task_link }}"
                        class="dme-form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Bilder (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    @php $dropzone_img_obj = $holiday_home_for_sale; @endphp
                    @include('user-panel.partials.dropzone',compact('dropzone_img_obj'))
                    {{--<input type="file" name="property_home_for_sale_photos[]" id="property_home_for_sale_photos"--}}
                    {{--class="" multiple>--}}
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Beskrivelse (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="description" id="beskrivelsefirst" cols="30"
                        rows="10">{{ $holiday_home_for_sale->description }}</textarea>
                    <span class="u-t5">Fortell gjerne litt om nabolaget og nærhet til transport.</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Andre opplysninger (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="essential_information" id="beskrivelsecond" cols="30" rows="10">{{ $holiday_home_for_sale->essential_information }}</textarea>
                    <span class="u-t5">Informer om betydelig feil og mangler, referer evt. også til takst.</span>
                </div>
            </div>
        </div>

        <!-- Attachement as sales information -->
        <div wt-paste="sales-information">
            <div class="form-group">
                <h3 class="u-t5">Last opp komplett salgsinformasjon</h3>
                @if($holiday_home_for_sale && $holiday_home_for_sale->ad && $holiday_home_for_sale->ad->sales_information->count() > 0)
                    @foreach($holiday_home_for_sale->ad->sales_information as $holiday_home_for_sale_sales_information)
                        <div class="show-file-section">
                            <div class="row">
                                <p class="col-sm-4">{{($holiday_home_for_sale_sales_information->name)}}</p>
                                <p class="col-sm-2"><a href="javascript:void(0)" class="dz-remove" id="{{$holiday_home_for_sale_sales_information->name_unique}}">Fjerne</a></p>
                                {{--<div class="col-sm-6"></div>--}}
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-sm-4">
                        <input type="file" name="property_home_for_sale_sales_quote[]" id="property_home_for_sale_sales_quote" class="">
                    </div>
                    <div class="col-sm-2">
                        <button class="dme-btn-outlined-blue" type="button" wt-more="sales-information"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Video (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="video" type="text" value="{{ $holiday_home_for_sale->video }}"
                        class="dme-form-control">
                    <span class="u-t5">Link til video.</span>
                </div>
            </div>
        </div>

        <!-- Attachement as pdf files -->
        <div wt-paste="attachment-as-pdf">
            <div class="form-group">
                <h3 class="u-t5">PDF-vedlegg (valgfritt)</h3>
                @if($holiday_home_for_sale && $holiday_home_for_sale->ad && $holiday_home_for_sale->ad->pdf->count() > 0)
                    @foreach($holiday_home_for_sale->ad->pdf as $key=>$holiday_home_for_sale_pdf_file)
                        <div class="show-file-section">
                            <div class="row">
                                <p class="col-sm-4">{{($holiday_home_for_sale_pdf_file->name)}}</p>
                                <p class="col-sm-2"><a href="javascript:void(0)" class="dz-remove" id="{{$holiday_home_for_sale_pdf_file->name_unique}}">Fjerne</a></p>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-sm-4 ">
                        <input type="file" name="property_home_for_sale_pdf[]" id="property_home_for_sale_pdf" accept="application/pdf">
                    </div>
                    <div class="col-sm-2">
                        <button class="dme-btn-outlined-blue" type="button" wt-more="attachment-as-pdf"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Visningsdato (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input name="delivery_date[]" value="{{ $holiday_home_for_sale->delivery_date }}" type="date"
                        class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Dato (eks. 31.12.2017 eller 31/12/2017)</div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Fra klokken (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input name="from_clock[]" value="{{ $holiday_home_for_sale->from_clock }}" type="text"
                        class="dme-form-control" placeholder="tt.mm">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 u-t5">Tid (eksempel 18:00)</div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Til klokken (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input name="clockwise[]" value="{{ $holiday_home_for_sale->clockwise }}" type="text"
                        class="dme-form-control" placeholder="tt.mm">
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
                    <button id="add_more_viewing_times_sales" ype="button" class="dme-btn-outlined-blue">+ Visningstidspunt
                    </button>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Telefon (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="phone" value="{{ $holiday_home_for_sale->phone }}" type="tel" id="phone"
                        class="dme-form-control">
                    <span id="valid-msg" class="hide"></span>
                    <span id="error-msg" class="hide"></span>
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-12 text-center mt-5 mb-5 bg-maroon-lighter p-4 radius-8">
                <div class="profile-icon">
                    <img src="@if(Auth::user()->media!=null){{asset(\App\Helpers\common::getMediaPath(Auth::user()->media))}}@else {{asset('public/images/profile-placeholder.png')}} @endif"
                        alt="Profile image" style="width:80px;">
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
                <input id="published-on" name="published_on" type="checkbox">Ikke vis profilbilde og
                lenke til profilsiden.
            </label>
        </div>

        <hr>
        <div class="notice"></div>
        <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" id="publiserannonsen"
            class="dme-btn-outlined-blue mb-3 col-12 ladda-button"><span class="ladda-label">Oppdater
                annonser!</span></button>

    </div>
</form>
<script>
    $(document).on('change', 'input[name="zip_code"]', function (e) {
        document.getElementById("zip_code_city_name").innerHTML = '';
        var zip_code = $(this).val();
        var api_url = 'https://api.bring.com/shippingguide/api/postalCode.json';
        // var api_url = 'https://api.bring.com/shippingguide/api/postalCode.json?clientUrl=demodesign.no&pnr=2014';
        var client_url = 'localhost';

        if (zip_code) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const postalCode = JSON.parse(this.responseText);
                    document.getElementById("zip_code_city_name").innerHTML = postalCode.result;
                    console.log(postalCode.result);
                }
            };
            xhttp.open("GET", api_url + "?clientUrl=" + client_url + "&pnr=" + zip_code, true);

            xhttp.send();
        }
    });

</script>
