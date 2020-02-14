<form action="#" method="post" id="property_for_sale_form"  enctype="multipart/form-data">
<?php
    $property_type = \App\Taxonomy::where('slug', 'pfs_property_type')->first();
    $property_types = $property_type->terms;
    $tenure = \App\Taxonomy::where('slug', 'pfs_tenure')->first();
    $tenures = $tenure->terms;
?>
    <input type="hidden" id="total_price" name="total_price" value="">
    <div class="pl-3 pr-3">
        <div class="form-group">
            <h3 class="u-t5">Annonseoverskrift</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="headline" class="dme-form-control">
                    <span class="error-span headline"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Postnummer</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="zip_code" type="text" class="dme-form-control">
                    <span class="error-span zip_code"></span>
                     <span id="zip_code_city_name"></span>
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Gateadresse</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="street_address" type="text" class="dme-form-control">
                    <span class="error-span street_address"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Adkomst <span class="text-muted">(valgfritt)</span></h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea type="text" name="access" class="dme-form-control"></textarea><br>
                    <span class="u-t5">Forklar kort om adkomsten til boligen og hvordan man finner fram, fortell gjerne om nærhet til vei, buss og tog.</span>

                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Beliggenhet <span class="text-muted">(valgfritt)</span></h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea type="text" name="location" class="dme-form-control"
                              placeholder="F.eks. Eiendommen ligger i nærheten til flotte tur- og friluftsområder og har kort gangavstand til skole og barnehage."></textarea><br>
                    <span class="u-t5">Forklar kort om beliggenheten, omgivelsene, attraktive naturforhold, betraktninger om lokaliseringsfordeler og strøksattraktivitet</span>
                    <span class="error-span location"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Navn på lokalområde <span class="text-muted">(valgfritt)</span></h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="local_area_name" class="dme-form-control"
                           placeholder="F.eks. Bjerke eller Kampen">
                    <span class="u-t5">Her kan du skrive inn hvilken bydel eller område eiendommen befinner seg i</span>
                    <span class="error-span local_area_name"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Boligtype</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select class="dme-form-control" name="property_type" id="property_type">
                        <option value=""></option>
                        @foreach($property_types as $type)
                            <option value="{{$type->name}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                    <span class="error-span property_type"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Eieform</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select name="tenure" class="dme-form-control">
                        <option value=""></option>
                        @foreach($tenures as $type)
                            <option value="{{$type->name}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                    <span class="u-t5">Beskriv varen kort. Denne beskrivelsen brukes til å finne riktig kategori i feltene under.</span>
                    <br><span  class="error-span tenure"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <h3 class="u-t5">Kommunenummer</h3>
                <div class="row">
                    <div class="col-sm-4 pr-md-0">
                        <input name="municipality_number" type="text" class="dme-form-control">
                        <span class="error-span municipality_number"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Identifikasjonsnummeret til din kommune. Du kan finne ditt kommunenummer på
                            kartverkets hjemmesider.
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <h3 class="u-t5">Gårdsnummer (Gnr)</h3>
                <div class="row">
                    <div class="col-sm-4 pr-md-0">
                        <input name="farm_number" type="text" class="dme-form-control">
                        <span class="error-span farm_number"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Nummeret på gårdsenheten, dette kan du finne på kartverkets hjemmesider.</div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <h3 class="u-t5">Bruksnummer (Bnr)</h3>
                <div class="row">
                    <div class="col-sm-4 pr-md-0">
                        <input name="usage_number" type="text" class="dme-form-control">
                        <span class="error-span usage_number"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Hvert gårdsnummer er delt inn i bruksnummer, du kan finne dette på kartverkets
                            hjemmesider.
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <h3 class="u-t5">Festenummer (Fnr) <span class="text-muted">(valgfritt)</span></h3>
                <div class="row">
                    <div class="col-sm-4 pr-md-0">
                        <input name="party_number" type="text" class="dme-form-control">
                        <span class="error-span party_number"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Brukes når bruksnummer skal deles inn i flere grunneiendommer. Du kan finne
                            festenummeret til din eiendom på kartverkets hjemmesider.
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <h3 class="u-t5">Seksjonsnummer (Snr) (valgfritt)</h3>
                <div class="row">
                    <div class="col-sm-4 pr-md-0">
                        <input name="section_number" type="text" class="dme-form-control">
                        <span class="error-span section_number"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Seksjonsnummer får man tildelt når eiendommen seksjoneres. Du kan finne ditt
                            seksjonsnummer på kartverkets hjemmesider.
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <h3 class="u-t5">Leilighetsnummer (valgfritt)</h3>
                <div class="row">
                    <div class="col-sm-4 pr-md-0">
                        <input name="apartment_number" type="text" class="dme-form-control" placeholder="H0201">
                        <span class="error-span apartment_number"></span>
                     </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Leilighetsnummeret består av en H, L, U eller K og fire tall. H står for
                            hovedetasje, 02 for andre etasje og 01 for første bolig til venstre.
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <h3 class="u-t5">Bruksareal (BRA)</h3>
                <div class="row">
                    <div class="col-sm-4 pr-md-0">
                        <input type="text" name="use_area" class="dme-form-control" placeholder="m²">
                        <span class="error-span use_area"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Bruksarealet er bruttoareal minus den plassen som opptas av yttervegger. Du
                            kan finne bruksarealet i takstrapporten.
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <h3 class="u-t5">Primærrom (P-ROM)</h3>
                <div class="row">
                    <div class="col-sm-4 pr-md-0">
                        <input name="primary_room" type="text" class="dme-form-control" placeholder="m²">
                        <span class="error-span primary_room"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Arealet av primærrom på eiendommen, sekundærrom tas ikke med i betegnelsen. Du
                            kan finne arealet for primærrom i takstrapporten.
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <h3 class="u-t5">Grunnflate (BYA) (valgfritt)</h3>
                <div class="row">
                    <div class="col-sm-4 pr-md-0">
                        <input type="text" name="Base" class="dme-form-control" placeholder="m²">
                        <span class="error-span Base"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Det arealet som bygningen dekker på tomten, det vil si 'fotavtrykket' av
                            bygningen.
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Arealbeskrivelse (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="area_description" type="text" class="dme-form-control"
                              placeholder="F.eks. grunnflate 60m², stue 30m², kjøkken 10m², WC 10m² osv."></textarea><br>
                    <span class="u-t5">Her kan du gi en kort oversikt over størrelsen på rom i eiendommen din.</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Byggeår</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="year" type="text" class="dme-form-control" placeholder="åååå">
                    <span class="error-span year"></span>
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Renovert år (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="renovated_year" type="text" class="dme-form-control" placeholder="åååå">
                    <span class="error-span renovated_year"></span>
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Energikarakter (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select name="energy_grade" class="dme-form-control">
                        <option value=""></option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                    </select>
                    <span class="error-span energy_grade"></span>
                    <span class="u-t5">Energikarakter går fra A til G, hvor A er best. Karakteren er basert på beregnet levert energi til boligen. En god energikarakter betyr at boligen er energieffektiv.</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <h3 for="" class="u-t5">Oppvarmingskarakter (valgfritt)</h3>
                    <select name="heating_character" class="dme-form-control">
                        <option value=""></option>
                        <option value="Gul">Gul</option>
                        <option value="Lysegrønn">Lysegrønn</option>
                        <option value="Mørkegrønn">Mørkegrønn</option>
                        <option value="Oransje">Oransje</option>
                        <option value="Rød">Rød</option>
                    </select>
                    <span class="error-span heating_character"></span>
                    <span class="u-t5">Oppvarmingskarakteren forteller om hvor stor andel av boligens oppvarming som gjøres med fossilt brensel og strøm. F.eks. blir karakteren mørkegrønn når andelen er under 30%, mens den blir rød når andelen er over 82,5%.</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Antall soverom</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="number_of_bedrooms" type="text" class="dme-form-control">
                    <span class="error-span number_of_bedrooms"></span>
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Antall rom (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="number_of_rooms" type="text" class="dme-form-control">
                    <span class="error-span number_of_rooms"></span>
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12">
                    <div class="u-t5">Hvor mange bruksrom er det totalt på eiendommen? (bod og garasje ol. er ikke
                        medregnet)
                    </div>
                </div>
                <br>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Etasje (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="floor" type="text" class="dme-form-control">
                    <span class="error-span floor"></span>

                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>
        <div class="form-group ">
            <h3 class="mb-2 form-check-label" for="approved_rental_part">
                <input id="approved_rental_part" name="approved_rental_part" type="checkbox">Godkjent utleiedel
                <span class="error-span approved_rental_part"></span>
            </h3>
            <div class="u-t5">Dersom eiendommen har godkjent utleiedel huker du av for dette her.</div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Fasiliteter (valgfritt)</h3>
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
            <h3 class="u-t5">Borettslagets navn (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="housing_team" class="dme-form-control">
                    <span class="error-span housing_team"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Borettslagets eier (valgfritt)
            </h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="owner_of_housing" type="text" class="dme-form-control">
                    <span class="error-span owner_of_housing"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Borettslagets org.nummer (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="housing_type_org_number" type="text" class="dme-form-control">
                    <span class="error-span housing_type_org_number"></span>
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Organisasjonsnummeret til ditt borettslag kan du finne på Brønnøysundregistrene.</div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Borettslagets andelsnummer (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="housing_cooperative_share_number" type="text" class="dme-form-control">
                    <span class="error-span housing_cooperative_share_number"></span>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-md-12">
                    <div class="u-t5">Dette er det tinglyste nummeret for din seksjon (leilighet). Dette nummeret oppgis
                        gjerne sammen med gårds- og bruksnummer for å identifisere en seksjon i en boligblokk. Du kan
                        finne ditt andelsnummer på kartverkets hjemmesider.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Tomteareal (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="land" type="text" class="dme-form-control" placeholder="m²">
                    <span class="error-span land"></span>
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Festeår (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="holiday_year" type="text" class="dme-form-control" placeholder="åååå">
                    <span class="error-span holiday_year"></span>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-md-12">
                    <div class="u-t5">Neste årstall for regulering av festeavgiften</div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Festeavgift (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="party_fee" type="text" class="dme-form-control" placeholder="Kr.">
                    <span class="error-span party_fee"></span>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-md-12">
                    <div class="u-t5">Hva er dagens festeavgift for tomten</div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12 input-toggle">
                    <input name="facilities2" data-selector="" id="facilities-AIRCONDITIONING2" type="checkbox"
                           value="AIRCONDITIONING2" name="facilities2">
                    <label class="smalltext" for="facilities-AIRCONDITIONING2"> Eiet tomt (valgfritt) </label>
                    <div class="u-t5">Tomten eies av selger</div>
                    <span class="error-span facilities2"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Beskaffenhet (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="character" id="beskrivelse" cols="30" rows="10"></textarea>
                    <span class="u-t5">Hva består tomten av? Her kan du for eksempel fortelle litt mer om hage, innkjørsel, parkering,og offentlige reguleringer.</span>
                    <span class="error-span character"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Husleie/felleskost.</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="rent_shared_cost" type="text" class="dme-form-control" placeholder="Kr.">
                    <span class="error-span rent_shared_cost"></span>
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Felleskostnader inkluderer</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="shared_costs_include" type="text" class="dme-form-control"
                           placeholder="F.eks. kabeltv, strøm, vaktmester, trappevask, forsikring, kommunale avgifter">
                    <span class="error-span shared_costs_include"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Felleskostnader etter avdragsfri periode (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input name="common_costs_after_interest_free_period" type="text" class="dme-form-control"
                           placeholder="Kr.">
                    <span class="error-span common_costs_after_interest_free_period"></span>
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12">
                    <div class="u-t5">Hva er estimerte felleskostnader etter den eventuelle avdragsfrie perioden? Dette
                        feltet må fylles ut dersom boligen har fellesgjeld. Dersom det ikke er avdragsfrihet i
                        fellesgjeld settes verdien til dagens felleskostnader.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Formuesverdi</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="asset_value" type="text" class="dme-form-control total_price_constants"
                           placeholder="Kr.">
                    <span class="error-span asset_value"></span>
                    <div class="u-t5">Formuesverdi legges til grunn av skatteetaten og kommuner når skatt av boligen
                        skal regnes ut. Mer om formuesverdi og hvordan du beregner dette kan du finne på skatteetaten
                        sin hjemmeside.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Prisantydning</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="asking_price" class="dme-form-control total_price_constants asking_price"
                           placeholder="Kr.">
                    <span class="error-span asking_price"></span>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-md-12">
                    <div class="u-t5">Minstebeløpet du selger eiendommen for.</div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Omkostninger</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="expenses" type="text" class="dme-form-control total_price_constants" placeholder="Kr.">
                    <span id="expenses" class="error-span expenses"></span>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-md-12">
                    <div class="u-t5">Dersom det vil påløpe ekstra omkostninger ved salg av denne eiendommen oppgir du
                        beløpet her. Fyll inn 0 hvis det ikke er ekstra omkostninger.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Omkostninger inkluderer</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="costs_include" type="text" class="dme-form-control total_price_constants costs_include">
                    <span class="error-span costs_include"></span>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-md-12">
                    <div class="u-t5">Her kan du gi en mer detaljert beskrivelse av hvilke omkostninger som inngår i
                        kjøpet.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Andel fellesgjeld</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="percentage_of_public_debt" type="text"
                           class="dme-form-control total_price_constants percentage_of_public_debt" placeholder="Kr.">
                    <span class="error-span percentage_of_public_debt"></span>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-md-12">
                    <div class="u-t5">Fellesgjeld for din bolig. Har du ikke fellesgjeld på din bolig setter du denne
                        verdien til 0.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Totalpris</h3><span id="total_price_sale_add"></span>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <!--                                        <input type="text" class="dme-form-control" placeholder="Kr.">-->
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-md-12">
                    <div class="u-t5">Regnes ut som summen av prisantydning, fellesgjeld og omkostninger. Alle disse tre
                        feltene må fylles ut for at totalpris skal vises.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Verditakst (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="value_rate" type="text" class="dme-form-control" placeholder="Kr.">
                    <span class="error-span value_rate"></span>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-md-12">
                    <div class="u-t5">Verditakst blir satt av takstmannen og er forventet salgsverdi eller
                        markedsverdien på din eiendom.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Lånetakst (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="loan_rate" type="text" class="dme-form-control" placeholder="Kr">
                    <span class="error-span loan_rate"></span>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-md-12">
                    <div class="u-t5">Lånetakst vil si den boligverdien som banken bruker for lån, pant og eventuelt
                        tvangssalg av boliger. Lånetaksten er basert på verditaksten.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Andel fellesformue (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="percentage_of_common_wealth" class="dme-form-control" placeholder="Kr.">
                    <span class="error-span percentage_of_common_wealth"></span>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-md-12">
                    <div class="u-t5">Boligens andel av borettslagets fellesformue</div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Kommunale avgifter pr. år (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="muncipal_fees_per_year" type="text" class="dme-form-control" placeholder="Kr.">
                    <span class="error-span muncipal_fees_per_year"></span>
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12 input-toggle">
                    <input data-selector="" id="facilities-AIRCONDITIONING2" type="checkbox" value="AIRCONDITIONING2"
                           name="facilities3">
                    <label class="smalltext" for="facilities-AIRCONDITIONING2"> Borettslaget har
                        sikringsordning </label>
                    <span class="error-span facilities3"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Utfyllende informasjon om fellesgjeld og felleskostnader (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="joint_debt_costs" id="beskrivelse" cols="30" rows="10"></textarea>
                    <span class="u-t5">Dersom du har ytterligere informasjon om fellesgjeld og felleskostnader så kan du fortelle mer om det her.</span>
                    <span class="error-span joint_debt_costs"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Forkjøpsrett (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="pre_empt_right" type="text" class="dme-form-control">
                    <div class="u-t5">Her kan du angi om det praktiseres en forkjøpsrett, eller når en eventuell
                        forkjøpsrett vil bli avklart.
                    </div>
                    <span class="error-span pre_empt_right"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12 input-toggle">
                    <input data-selector="" id="facilities-AIRCONDITIONING2" type="checkbox" value="AIRCONDITIONING2"
                           name="facilities4">
                    <label class="smalltext" for="facilities-AIRCONDITIONING2"> Jeg har eierskifteforsikring </label>
                    <span id="AIRCONDITIONING2" class="error-span"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Bilder (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="file" name="property_photos[]" id="property_photos" class="mt-3" multiple>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Beskrivelse (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="description2" id="beskrivelse" cols="30" rows="10"></textarea>
                    <span class="u-t5">Fortell om hva som er bra med eiendommen, hvorfor har du trivdes der og hva som er inkludert av møbler og innredning osv.</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Vesentlige opplysninger (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="essential_information" id="beskrivelse" cols="30" rows="10"
                              placeholder="F.eks. Taket på det ene soverommet lekker. Det elektriske anlegget i kjelleren er utført av ufaglært."></textarea>
                    <span class="u-t5">Opplysninger om vesentlige kjente feil og mangler som er av betydning for kjøper. Dette kan f.eks være større fysiske skader på boligen, endringer på boligen som er gjort uten å skaffe nødvendig tillatelse, byggeprosjekter som kan påvirke boligen eller utført arbeid på eiendommen av ufaglærte. Henvis også gjerne til takst.</span>
                    <span class="error-span essential_information"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="u-t5">Last opp komplett salgsinformasjon</label>
                <div class="col-sm-12 pr-md-0">
                    <!-- <button  type="button" class="dme-btn-outlined-blue">Legg til salgsoppgave</button> -->
                    <input type="file" name="property_quote[]" id="property_quote" class="" multiple>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Video (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="video" type="text" class="dme-form-control">
                    <div class="u-t5">Kopier eller skriv inn linken til en video på Youtube eller Vimeo.</div>
                    <span class="error-span video"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="u-t5">Vedlegg som PDF</label>
                <div class="col-sm-12 pr-md-0">
                    <!-- <button class="dme-btn-outlined-blue">Legg til pdf</button> -->
                    <input type="file" name="property_pdf[]" id="property_pdf" class="" multiple>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Visningsdato (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input name="deliver_date[]" type="date" class="dme-form-control">
                    <span class="error-span deliver_date"></span>
                </div>
                <div class="col-md-8"></div>
                <div class="u-t5">Dato (eks. 31.12.2017 eller 31/12/2017)</div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Fra klokken (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input name="from_clock[]" type="text" class="dme-form-control" placeholder="tt.mm">
                    <span class="error-span from_clock"></span>
                </div>
                <div class="col-md-8"></div>
                <div class="u-t5">Tid (eksempel 18:00)</div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Til klokken (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input name="clockwise[]" type="text" class="dme-form-control" placeholder="tt.mm">
                    <span class="error-span clockwise"></span>
                </div>
                <div class="col-md-8"></div>
                <div class="u-t5">Tid (eksempel 19:30)</div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Merknad (valgfritt)</h3>
            <div class="row">
                <div class="col-md-12 pr-md-0">
                    <input name="note1[]" type="text" class="dme-form-control"
                           placeholder="F.eks.: visning etter avtale">
                    <span class="error-span note1"></span>
                </div>
                <div class="u-t5">Tid (eksempel 19:30)</div>
            </div>
        </div>


        <div id="add_more_viewing_times_fields">

        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <button id="add_more_viewing_times_sales" type="button" class="dme-btn-outlined-blue"> + Legg til
                        flere visningstidspunkt
                    </button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Telefon (valgfritt)</h3>
            <div class="row">
                <div class="col-md-12 pr-md-0">
                    <input name="phone" type="tel" id="phone" class="dme-form-control">
                    <span id="valid-msg" class="hide"></span>
                    <span id="error-msg" class="hide"></span>
                    <div class="u-t5">Hvilket telefonnummer ønsker du at interesserte kjøpere skal kontakte deg på?
                    </div>
                    <span class="error-span phone"></span>
                </div>
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
                <input id="published-on" name="published-on" type="checkbox" class="pub_validate">Ikke vis profilbilde og
                lenke til profilsiden.
            </label>
            <span class="error-span published-on"></span>
        </div>
        <hr>
        <div class="notice"></div>
        <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" id="publiserannonsen"
                class="dme-btn-outlined-blue mb-3 col-12 ladda-button"><span class="ladda-label">Publiser annonsen!</span></button>
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