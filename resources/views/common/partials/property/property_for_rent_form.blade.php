<form action="#" method="post" id="property_for_rent_form" enctype="multipart/form-data">

    <div class="pl-3 pr-3">
        <div class="form-group">
            <label class="u-t5">Overskrift</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="heading" class="dme-form-control" required/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Postnummer</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="zip_code" class="dme-form-control" required>
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Gateadresse
            </label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="street_address" class="dme-form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Boligtype
            </label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select id="property_type" name="property_type" class="dme-form-control">
                        <option value=""></option>
                        <option value="OTHER">Andre</option>
                        <option value="DETACHED">Enebolig</option>
                        <option value="GARAGE">Garasje/Parkering</option>
                        <option value="BEDSIT">Hybel</option>
                        <option value="FLAT">Leilighet</option>
                        <option value="TERRACED">Rekkehus</option>
                        <option value="HOUSESHARE">Rom i bofellesskap</option>
                        <option value="SEMIDETACHED">Tomannsbolig</option>
                    </select>
                    <span class="u-t5">Dersom du kun skal leie ut et rom må du huske å velge 'Rom i bofelleskap' under boligtype.</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Primærrom (P-ROM)</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="primary_rom" class="dme-form-control" placeholder="m²">
                    <span class="u-t5">Arealet av primærrom i boligen, sekundærrom tas ikke med i betegnelsen. Du kan finne arealet for primærrom i takstrapporten.</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Bruttoareal (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="gross_area" class="dme-form-control" placeholder="m²">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Bruksareal (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="area_of_use" class="dme-form-control" placeholder="m²">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Antall soverom</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="number_of_bedrooms" class="dme-form-control" placeholder="m²">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Etasje (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="floor" class="dme-form-control" placeholder="m²">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Møblering</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select id="furnishing" name="furnishing" class="dme-form-control">
                        <option value=""></option>
                        <option value="PARTLY_FURNISHED">Delvis møblert</option>
                        <option value="FURNISHED">Møblert</option>
                        <option value="UNFURNISHED">Umøblert</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Fasiliteter (valgfritt)</label>
            <div class="row">
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-AIRCONDITIONING" type="checkbox" value="AIRCONDITIONING"
                           name="facilities[]">
                    <label class="smalltext" for="facilities-AIRCONDITIONING"> Aircondition</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-ALARM" type="checkbox" value="ALARM" name="facilities[]">
                    <label class="smalltext" for="facilities-ALARM"> Alarm</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-BALCONY" type="checkbox" value="BALCONY" name="facilities[]">
                    <label class="smalltext" for="facilities-BALCONY"> Balkong/Terrasse</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-CHILD-FRIENDLY" type="checkbox" value="CHILD-FRIENDLY"
                           name="facilities[]">
                    <label class="smalltext" for="facilities-CHILD-FRIENDLY"> Barnevennlig</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-BROADBAND" type="checkbox" value="BROADBAND"
                           name="facilities[]">
                    <label class="smalltext" for="facilities-BROADBAND"> Bredbåndstilknytning</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-COMMONWASHROOM" type="checkbox" value="COMMONWASHROOM"
                           name="facilities[]">
                    <label class="smalltext" for="facilities-COMMONWASHROOM"> Fellesvaskeri</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-GARAGE" type="checkbox" value="GARAGE" name="facilities[]">
                    <label class="smalltext" for="facilities-GARAGE"> Garasje/P-plass</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-LIFT" type="checkbox" value="LIFT" name="facilities[]">
                    <label class="smalltext" for="facilities-LIFT"> Heis</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-NO-NEIGHBOURS-OP" type="checkbox" value="NO-NEIGHBOURS-OP"
                           name="facilities[]">
                    <label class="smalltext" for="facilities-NO-NEIGHBOURS-OP"> Ingen gjenboere</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-CABLE-TV" type="checkbox" value="CABLE-TV"
                           name="facilities[]">
                    <label class="smalltext" for="facilities-CABLE-TV"> Kabel-TV</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-CHARGING" type="checkbox" value="CHARGING"
                           name="facilities[]">
                    <label class="smalltext" for="facilities-CHARGING"> Lademulighet</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-ACCESSIBILITY_LEVEL" type="checkbox"
                           value="ACCESSIBILITY_LEVEL" name="facilities[]">
                    <label class="smalltext" for="facilities-ACCESSIBILITY_LEVEL"> Livsløpsstandard</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-MODERN" type="checkbox" value="MODERN" name="facilities[]">
                    <label class="smalltext" for="facilities-MODERN"> Moderne</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-PARQUETT" type="checkbox" value="PARQUETT"
                           name="facilities[]">
                    <label class="smalltext" for="facilities-PARQUETT"> Parkett</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-FIREPLACE" type="checkbox" value="FIREPLACE"
                           name="facilities[]">
                    <label class="smalltext" for="facilities-FIREPLACE"> Peis/Ildsted</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-QUIET-AREA" type="checkbox" value="QUIET-AREA"
                           name="facilities[]">
                    <label class="smalltext" for="facilities-QUIET-AREA"> Rolig</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-CENTRAL" type="checkbox" value="CENTRAL" name="facilities[]">
                    <label class="smalltext" for="facilities-CENTRAL"> Sentralt</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-VIEW" type="checkbox" value="VIEW" name="facilities[]">
                    <label class="smalltext" for="facilities-VIEW"> Utsikt</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-JANITORSERVICE" type="checkbox" value="JANITORSERVICE"
                           name="facilities[]">
                    <label class="smalltext" for="facilities-JANITORSERVICE"> Vaktmester-/vektertjeneste</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="facilities-HIKING" type="checkbox" value="HIKING" name="facilities[]">
                    <label class="smalltext" for="facilities-HIKING"> Turterreng</label>
                </div>


            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Energikarakter (valgfritt)</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select id="energy_label.class" name="energy_label_class" data-selector="" class="dme-form-control">
                        <option value=""></option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                    </select>
                    <span class="u-t5">Energikarakter går fra A til G, hvor A er best. Karakteren er basert på beregnet levert energi til boligen. En god energikarakter betyr at boligen er energieffektiv.</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Oppvarmingskarakter (valgfritt)</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select id="energy_label.color" name="energy_label_color" data-selector="" class="dme-form-control">
                        <option value=""></option>
                        <option value="YELLOW">Gul</option>
                        <option value="LIGHT_GREEN">Lysegrønn</option>
                        <option value="DARK_GREEN">Mørkegrønn</option>
                        <option value="ORANGE">Oransje</option>
                        <option value="RED">Rød</option>
                    </select>
                    <span class="u-t5">Oppvarmingskarakteren forteller om hvor stor andel av boligens oppvarming som gjøres med fossilt brensel og strøm. F.eks. blir karakteren mørkegrønn når andelen er under 30%, mens den blir rød når andelen er over 82,5%.</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12 input-toggle">
                    <input data-selector="" id="facilities-AIRCONDITIONING2" type="checkbox" value="AIRCONDITIONING2"
                           name="facilities2">
                    <label class="smalltext" for="facilities-AIRCONDITIONING2"> Dyrehold tillatt </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Månedsleie</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="monthly_rent" class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Depositum (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="deposit" class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Inkludert i husleie (valgfritt)</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="include_in_rent" class="dme-form-control"
                           placeholder="F.eks.: Strøm, kabeltv, bredbånd osv.">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Leies ut fra</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="date" name="rented_from" class="dme-form-control">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Leies ut til (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="date" name="rented_to" class="dme-form-control">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Bilder (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <!-- <button class="dme-btn-outlined-blue">Legg til bilder</button> -->
                    <input type="file" name="property_photos[]" id="property_photos" class="" multiple>
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Beskrivelse (valgfritt)</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="description" id="beskrivelse" cols="30" rows="10"></textarea>
                    <span class="u-t5">Fortell om hva som er bra med boligen, hva som er inkludert av møbler og innredning osv. Fortell gjerne litt om nabolaget og nærhet til transport.<a
                            href="#" target="_blank">Les mer om FINN hjerterom</a></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Visningsdato (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="date" name="delivery_date[]" class="dme-form-control">
                    <span class="u-t5">Dato (eks. 31.12.2017 eller 31/12/2017)</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Fra klokken (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="from_clock[]" placeholder="tt.mm" class="dme-form-control">
                    <span class="u-t5">Tid (eksempel 18:00)</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Til klokken (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="clockwise_clock[]" placeholder="tt.mm" class="dme-form-control">
                    <span class="u-t5">Tid (eksempel 19:00)</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Merknad (valgfritt)</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="note[]" placeholder="F.eks.: visning etter avtale"
                           class="dme-form-control">
                </div>
            </div>
        </div>
        <div id="add_more_viewing_times_fields">

        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <button type="button" id="add_more_viewing_times" class="dme-btn-outlined-blue">+ Legg til flere
                        visningstidspunkt
                    </button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12 text-center mt-5 mb-5 bg-maroon-lighter p-4 radius-8">
                <div class="profile-icon">

                    <img src="{{asset('public/images/profile-1.jpg')}}" alt="Profile image" style="width:80px;">

                </div>
                <div class="profile-name">
                    <h3 class="text-muted">Ola Nordmann</h3>
                </div>
                <p>Hvis denne profilen ikke er riktig kan du endre den under Min handel deretter Endre profil.</p>
            </div>
        </div>

        <div class="form-group ">
            <h3 class="u-t5">Publisert</h3>
            <label class="mb-2 form-check-label" for="published-on">
                <input id="published-on" name="published_on" type="checkbox" class="pub_validate">Ikke vis profilbilde og lenke til
                profilsiden før kjøperen tar kontakt med meg.
            </label>
        </div>
        <hr>
        <span class="u-t5">Du må fylle ut Overskrift og 2 andre felter før du kan gå videre</span>
        <hr>
{{--        <input type="button" class="dme-btn-outlined-blue mb-3 col-12" id="publiser_annonsen"--}}
{{--               value="Publiser annonsen!">--}}
        <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" id="publiser_annonsen"
                class="dme-btn-outlined-blue mb-3 col-12 ladda-button"><span class="ladda-label">Publiser annonsen!</span></button>
        <p class="u-t5 text-center">Ved å gå videre aksepteres samtidig <a href="#">reglene for annonsering</a></p>
</form>


