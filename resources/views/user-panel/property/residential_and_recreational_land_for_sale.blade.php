@extends('layouts.landingSite')
@section('page_content')


<div class="dme-container">
    <div class="col-md-10 offset-md-1 mt-5 mb-5">
        <main class="pageholder">
            <div class="form-grid--compact">
                <form action="" id="residential_and_recreational_land_for_sale" enctype='multipart/form-data'>
                    <div class="panel u-mv0">
                        <h1 class="u-t2">Bolig- og fritidstomt til salgs</h1>
                    </div>
                    <div>
                        <hr role="presentation">
                    </div>
                    <div class="form-group">
                        <div class="input u-mb0">
                            <label for="property_type" class="u-t5">Type tomt</label>
                        </div>
                        <div id="property_type" class="">
                            <div class="input-toggle radio-lbl">
                                <input id="radio-input-property_type-PLOT" type="radio" checked=""
                                    value="PLOT" name="property_type">
                                <label for="radio-input-property_type-PLOT"> Boligtomt</label>
                                <span class="checkmark"></span>
                            </div>
                            <div class="input-toggle radio-lbl">
                                <input id="radio-input-property_type-LEISURE_PLOT" type="radio"
                                    value="LEISURE_PLOT" name="property_type">
                                <label for="radio-input-property_type-LEISURE_PLOT"> Fritidstomt</label>
                                <span class="checkmark"></span>
                            </div>
                             <span class="error-span property_type"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="countryCode" class="u-t5">Land</label>
                        <div class="input--select__wrap">
                            <select id="countryCode" name="countryCode" class="dme-form-control">
                                <option value="AF">Afghanistan</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algerie</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarktika</option>
                                <option value="AG">Antigua og Barbuda</option>
                                <option value="AR">Argentina</option>
                                <option value="AM">Armenia</option>
                                <option value="AW">Aruba</option>
                                <option value="AZ">Aserbajdsjan</option>
                                <option value="AU">Australia</option>
                                <option value="BS">Bahamas</option>
                                <option value="BH">Bahrain</option>
                                <option value="BD">Bangladesh</option>
                                <option value="BB">Barbados</option>
                                <option value="BE">Belgia</option>
                                <option value="BZ">Belize</option>
                                <option value="BJ">Benin</option>
                                <option value="BM">Bermuda</option>
                                <option value="BT">Bhutan</option>
                                <option value="BO">Bolivia</option>
                                <option value="BA">Bosnia-Hercegovina</option>
                                <option value="BW">Botswana</option>
                                <option value="BV">Bouvetøya</option>
                                <option value="BR">Brasil</option>
                                <option value="IO">British Indian Ocean Territory</option>
                                <option value="VG">British Virgin Islands</option>
                                <option value="BN">Brunei</option>
                                <option value="BG">Bulgaria</option>
                                <option value="BF">Burkina Faso</option>
                                <option value="BI">Burundi</option>
                                <option value="CA">Canada</option>
                                <option value="KY">Cayman øyene</option>
                                <option value="CL">Chile</option>
                                <option value="CX">Christmas Island (The settlement)</option>
                                <option value="CC">Cocos Islands / Keelingøyene</option>
                                <option value="CO">Colombia</option>
                                <option value="CK">Cookøyene</option>
                                <option value="CR">Costa Rica</option>
                                <option value="CU">Cuba</option>
                                <option value="CD">DR Kongo</option>
                                <option value="DK">Danmark</option>
                                <option value="AE">De Forente Arabiske Emirater</option>
                                <option value="DO">Den Dominikanske republikk</option>
                                <option value="DJ">Djibouti</option>
                                <option value="DM">Dominica</option>
                                <option value="EC">Ecuador</option>
                                <option value="EG">Egypt</option>
                                <option value="GQ">Ekvatorial Guinea</option>
                                <option value="SV">El Salvador</option>
                                <option value="CI">Elfenbenskysten</option>
                                <option value="ER">Eritrea</option>
                                <option value="EE">Estland</option>
                                <option value="ET">Etiopia</option>
                                <option value="FK">Falklandsøyene</option>
                                <option value="FJ">Fiji</option>
                                <option value="PH">Filippinene</option>
                                <option value="FI">Finland</option>
                                <option value="FR">Frankrike</option>
                                <option value="GF">Fransk Guyana</option>
                                <option value="TF">Fransk Søndre og Antarktiske øyer</option>
                                <option value="FO">Færøyene</option>
                                <option value="GA">Gabon</option>
                                <option value="GM">Gambia</option>
                                <option value="GE">Georgia</option>
                                <option value="GH">Ghana</option>
                                <option value="GI">Gibraltar</option>
                                <option value="GD">Grenada</option>
                                <option value="GL">Grønland</option>
                                <option value="GP">Guadeloupe</option>
                                <option value="GT">Guatemala</option>
                                <option value="GG">Guernsey</option>
                                <option value="GN">Guinea</option>
                                <option value="GW">Guinea-Bissau</option>
                                <option value="GY">Guyana</option>
                                <option value="HT">Haiti</option>
                                <option value="HM">Heard Island og McDonaldøyene</option>
                                <option value="GR">Hellas</option>
                                <option value="HN">Honduras</option>
                                <option value="HK">Hong Kong</option>
                                <option value="BY">Hviterussland</option>
                                <option value="IN">India</option>
                                <option value="ID">Indonesia</option>
                                <option value="IQ">Irak</option>
                                <option value="IR">Iran</option>
                                <option value="IE">Irland</option>
                                <option value="IS">Island</option>
                                <option value="IL">Israel</option>
                                <option value="IT">Italia</option>
                                <option value="JM">Jamaica</option>
                                <option value="JP">Japan</option>
                                <option value="YE">Jemen</option>
                                <option value="JE">Jersey</option>
                                <option value="JO">Jordan</option>
                                <option value="KH">Kambodsja</option>
                                <option value="CM">Kamerun</option>
                                <option value="CV">Kapp Verde</option>
                                <option value="KZ">Kasakhstan</option>
                                <option value="KE">Kenya</option>
                                <option value="CN">Kina</option>
                                <option value="KG">Kirgisistan</option>
                                <option value="KI">Kiribati/Kiritimati (Christmas Island)</option>
                                <option value="KM">Komorene og Mayotte</option>
                                <option value="CG">Kongo (Zaire)</option>
                                <option value="XK">Kosovo</option>
                                <option value="HR">Kroatia</option>
                                <option value="KW">Kuwait</option>
                                <option value="CY">Kypros</option>
                                <option value="LA">Laos</option>
                                <option value="LV">Latvia</option>
                                <option value="LS">Lesotho</option>
                                <option value="LB">Libanon</option>
                                <option value="LR">Liberia</option>
                                <option value="LY">Libya</option>
                                <option value="LI">Liechtenstein</option>
                                <option value="LT">Litauen</option>
                                <option value="LU">Luxemburg</option>
                                <option value="MO">Macau</option>
                                <option value="MG">Madagaskar</option>
                                <option value="MK">Makedonia</option>
                                <option value="MW">Malawi</option>
                                <option value="MY">Malaysia</option>
                                <option value="MV">Maldivene</option>
                                <option value="ML">Mali</option>
                                <option value="MT">Malta</option>
                                <option value="MA">Marokko</option>
                                <option value="MH">Marshalløyene</option>
                                <option value="MQ">Martinique</option>
                                <option value="MR">Mauritania</option>
                                <option value="MU">Mauritius</option>
                                <option value="YT">Mayotte</option>
                                <option value="MX">Mexico</option>
                                <option value="MD">Moldova</option>
                                <option value="MC">Monaco</option>
                                <option value="MN">Mongolia</option>
                                <option value="ME">Montenegro</option>
                                <option value="MS">Montserrat</option>
                                <option value="MZ">Mosambik</option>
                                <option value="MM">Myanmar (Burma)</option>
                                <option value="NA">Namibia</option>
                                <option value="NR">Nauru</option>
                                <option value="NL">Nederland</option>
                                <option value="AN" selected="">Nederlandske Antiller</option>
                                <option value="NP">Nepal</option>
                                <option value="NC">New Caledonia</option>
                                <option value="NZ">New Zealand</option>
                                <option value="NI">Nicaragua</option>
                                <option value="NE">Niger</option>
                                <option value="NG">Nigeria</option>
                                <option value="NU">Niue</option>
                                <option value="KP">Nord-Korea</option>
                                <option value="NF">Norfolk Island</option>
                                <option value="NO">Norge</option>
                                <option value="OM">Oman</option>
                                <option value="PK">Pakistan</option>
                                <option value="PA">Panama</option>
                                <option value="PG">Papua Ny-Guinea</option>
                                <option value="PY">Paraguay</option>
                                <option value="PE">Peru</option>
                                <option value="PN">Pitcairn</option>
                                <option value="PL">Polen</option>
                                <option value="PT">Portugal</option>
                                <option value="QA">Qatar</option>
                                <option value="RE">Reunion</option>
                                <option value="RO">Romania</option>
                                <option value="RU">Russland</option>
                                <option value="RW">Rwanda</option>
                                <option value="SH">Saint Helena</option>
                                <option value="KN">Saint Kitts og Nevis</option>
                                <option value="LC">Saint Lucia</option>
                                <option value="VC">Saint Vincent og Grenadinene</option>
                                <option value="PM">Saint-Pierre-et-Miquelon</option>
                                <option value="SB">Salomonøyene</option>
                                <option value="WS">Samoa</option>
                                <option value="SM">San Marino</option>
                                <option value="ST">Sao Tome og Principe</option>
                                <option value="SA">Saudi-Arabia</option>
                                <option value="SN">Senegal</option>
                                <option value="CF">Sentralafrikanske republikk</option>
                                <option value="RS">Serbia</option>
                                <option value="SC">Seychellene</option>
                                <option value="SL">Sierra Leone</option>
                                <option value="SG">Singapore</option>
                                <option value="SK">Slovakia</option>
                                <option value="SI">Slovenia</option>
                                <option value="SO">Somalia</option>
                                <option value="ES">Spania</option>
                                <option value="LK">Sri Lanka</option>
                                <option value="SX">St-Martin / St Maarten</option>
                                <option value="GB">Storbritannia</option>
                                <option value="SD">Sudan</option>
                                <option value="SR">Surinam</option>
                                <option value="CH">Sveits</option>
                                <option value="SE">Sverige</option>
                                <option value="SZ">Swaziland</option>
                                <option value="SY">Syria</option>
                                <option value="ZA">Sør Afrika</option>
                                <option value="GS">Sør-Georgia</option>
                                <option value="KR">Sør-Korea</option>
                                <option value="TJ">Tadsjikistan</option>
                                <option value="PF">Tahiti</option>
                                <option value="TW">Taiwan</option>
                                <option value="TZ">Tanzania</option>
                                <option value="TH">Thailand</option>
                                <option value="TG">Togo</option>
                                <option value="TK">Tokelau</option>
                                <option value="TO">Tonga</option>
                                <option value="TT">Trinidad og Tobago</option>
                                <option value="TD">Tsjad</option>
                                <option value="CZ">Tsjekkia</option>
                                <option value="TN">Tunisia</option>
                                <option value="TM">Turkmenistan</option>
                                <option value="TC">Turks- og Caicosøyene</option>
                                <option value="TV">Tuvalu</option>
                                <option value="TR">Tyrkia</option>
                                <option value="DE">Tyskland</option>
                                <option value="US">USA</option>
                                <option value="UG">Uganda</option>
                                <option value="UA">Ukraina</option>
                                <option value="HU">Ungarn</option>
                                <option value="UY">Uruguay</option>
                                <option value="UZ">Uzbekistan</option>
                                <option value="VU">Vanuatu</option>
                                <option value="VA">Vatikanstaten</option>
                                <option value="VE">Venezuela</option>
                                <option value="EH">Vest-Sahara</option>
                                <option value="PS">Vestbredden</option>
                                <option value="VN">Vietnam</option>
                                <option value="WF">Wallis og Futuna</option>
                                <option value="ZR">Zaire</option>
                                <option value="ZM">Zambia</option>
                                <option value="ZW">Zimbabwe</option>
                                <option value="TL">Øst-Timor</option>
                                <option value="AT">Østerrike</option>
                            </select>
                            <span class="error-span countryCode"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input input--select">
                            <label for="areaId" class="u-t5">Område</label>
                            <div class="input--select__wrap">
                                <select id="areaId" name="areaId" class="dme-form-control">
                                    <option value="25069" selected="">Nederlandske Antiller</option>
                                </select>
                                  <span class="error-span areaId"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div data-controller="postal-code">
                            <label for="postal-code" class="u-t5">Postnummer</label>
                            <div class="col-md-4 pl-0">
                                <input id="postal-code" name="postal_code" type="text" value=""
                                    class="dme-form-control">
                                <span class="error-span postal_code"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="u-t5">Gateadresse (valgfritt)</label>
                            <input id="address" name="address" type="text" value="" autocomplete="off"
                                data-address="" role="combobox" aria-autocomplete="list" aria-expanded="false"
                                class="dme-form-control">
                            <span class="error-span address"></span>
                        </div>
                        <div class="form-group">
                            <label for="access" class="u-t5">Adkomst (valgfritt)</label>
                            <textarea id="access" name="access" rows="5"></textarea>
                            <span class="error-span access"></span>
                        </div>
                        <div class="form-group">
                            <label for="situation" class="u-t5">Beliggenhet (valgfritt)</label>
                            <textarea
                                placeholder="F.eks. Eiendommen ligger i nærheten til flotte tur- og friluftsområder og har kort gangavstand til skole og barnehage. "
                                id="situation" name="situation" rows="5"></textarea>
                            <span class="error-span situation"></span>
                            <div class="input__sub-text helpText">
                                <span class="u-t5">Forklar kort om beliggenheten, omgivelsene,
                                    attraktive naturforhold, betraktninger om lokaliseringsfordeler og
                                    strøksattraktivitet</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 pl-0">
                                <label for="county_number" class="u-t5">Kommunenummer (valgfritt)</label>
                                <input id="county_number" name="county_number" type="text" value=""
                                    class="dme-form-control">
                                <span class="error-span county_number"></span>
                            </div>
                            <div class="input__sub-text">
                                <span class="u-t5">Identifikasjonsnummeret til din
                                    kommune. Du kan finne ditt kommunenummer på kartverkets hjemmesider.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 pl-0">
                                <label for="cadastral_unit_number" class="u-t5">Gårdsnummer (Gnr) (valgfritt)</label>
                                <input id="cadastral_unit_number" name="cadastral_unit_number" type="text"
                                    value="" class="dme-form-control">
                                <span class="error-span cadastral_unit_number"></span>
                            </div>
                            <div class="input__sub-text">
                                <span class="u-t5">Nummeret på gårdsenheten, dette kan du
                                    finne på kartverkets hjemmesider.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 pl-0">
                                <label for="property_unit_number" class="u-t5">Bruksnummer (Bnr) (valgfritt)</label>
                                <input id="property_unit_number" name="property_unit_number" type="text" value=""
                                    class="dme-form-control">
                                     <span class="error-span property_unit_number"></span>
                                <span class="error-span property_unit_number"></span>
                            </div>
                            <div class="input__sub-text">
                                <span class="u-t5">Hvert gårdsnummer er delt inn i
                                    bruksnummer, du kan finne dette på kartverkets hjemmesider.</span>
                                     <span class="error-span property_unit_number"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 pl-0">
                                <label for="section_number" class="u-t5">Seksjonsnummer (Snr) (valgfritt)</label>
                                <input id="section_number" name="section_number" type="text" value=""
                                    class="dme-form-control">
                                <span class="error-span property_unit_number"></span>
                            </div>
                            <div class="input__sub-text">
                                <span class="u-t5">Seksjonsnummer får man tildelt når
                                    eiendommen seksjoneres. Du kan finne ditt seksjonsnummer på kartverkets
                                    hjemmesider.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 pl-0">
                                <label for="leasehold_unit_number" class="u-t5">Festenummer (Fnr)
                                    (valgfritt)</label>
                                <input id="leasehold_unit_number" name="leasehold_unit_number"
                                    type="text" value="" class="dme-form-control">
                                    <span class="error-span leasehold_unit_number"></span>
                            </div>
                              <span class="error-span leasehold_unit_number"></span>
                            <div class="input__sub-text">
                                <span class="u-t5">Brukes når bruksnummer skal deles inn i
                                    flere grunneiendommer. Du kan finne festenummeret til din eiendom på
                                    kartverkets hjemmesider.</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div data-controller="select-controller">
                            <div class="input u-mb0">
                                <label for="plot_area.plot_area_owned" class="u-t5">Salg eller bortfeste?</label>
                            </div>
                            <div id="plot_area.plot_area_owned">
                                <div class="input-toggle radio-lbl">
                                    <input data-selector="" id="radio-input-plot_area.plot_area_owned-FALSE"
                                        type="radio" value="FALSE" name="plot_area_owned">
                                    <label for="radio-input-plot_area-plot_area_owned-FALSE"> Bortfeste</label>
                                    <span class="checkmark"></span>
                                </div>
                                <div class="input-toggle radio-lbl">
                                    <input data-selector="" id="radio-input-plot_area.plot_area_owned-TRUE" type="radio"
                                        checked="" value="TRUE" name="plot_area_owned">
                                    <label for="plot_area_owned-TRUE"> Salg</label>
                                    <span class="checkmark"></span>
                                </div>
                                 <span class="error-span leasehold_unit_number"></span>
                            </div>
                            <div class="u-ma0 u-mt16">
                                <p class="u-t5">
                                    Dersom du oppretter, eller endrer en annonse til "Gis bort", husk å fjerne
                                    ord som "selges", "til salgs" osv. På den måten unngår du at annonsen blir
                                    avvist.
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 pl-0">
                                <label for="plot_area_size" class="u-t5">Tomteareal (valgfritt)</label>
                                <input id="plot_area_size" name="plot_area_size" type="text"
                                    value="" class="dme-form-control" placeholder="m²">
                                       <span class="error-span plot_area_size"></span>
                            </div>
                        </div>
                    </div>

                    {{-- 
																	
																		<div class="form-group">
																			<details id="detailspolyfill" class="u-primary-blue">
																				<summary class="u-t5" data-controller="summary-controller" aria-expanded="false" tabindex="0"
                        role="button">
                        Festeår
                    </summary>
																				<div class="input input--number">
																					<label for="leasehold_year" class="u-t5">Festeår </label>
																					<input id="leasehold_year" name="leasehold_year" type="text" value="" class="dme-form-control"
                            placeholder="åååå">
																					</div>
																				</details>
																			</div>
																			<div class="form-group">
																				<details id="detailspolyfill" class="u-primary-blue">
																					<summary class="u-t5" data-controller="summary-controller" aria-expanded="false" tabindex="0"
                        role="button">
                        Festeavgift
                    </summary>
																					<div class="input input--number ">
																						<label for="leasehold_fee">Festeavgift </label>
																						<input id="leasehold_fee" name="leasehold_fee" type="text" value="" class="dme-form-control">
																						</div>
																					</details>
																				</div> --}}




                    <div class="form-group">
                        <label class="u-t5" for="regulations">Tomten er regulert for (valgfritt)</label>
                        <input id="regulations" name="regulations" type="text" value="" class="dme-form-control">
                         <span class="error-span regulations"></span>
                        <div class="input__sub-text helpText" data-help-text="">
                            <span class="u-t5">Er tomtearealet en del av en større eller
                                mindre reguleringsplan for området?</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="condition" class="u-t5">Beskaffenhet (valgfritt) </label>
                        <textarea id="condition" name="condition" rows="5"></textarea>
                          <span class="error-span condition"></span>
                        <div class="input__sub-text">
                            <span class="u-t5">Hva består tomten av? Her kan du for
                                eksempel fortelle litt mer om hage, innkjørsel, parkering,og offentlige
                                reguleringer.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input u-mb0">
                            <label for="facilities" class="u-t5">Fasiliteter (valgfritt)</label>
                        </div>
                        <div id="facilities" class="grid grid--cols2to3 ">
                            <div class="grid__unit input-toggle" data-group-name="">
                                <input data-selector="" id="facilities-ROAD_ACCESS" type="checkbox" value="ROAD_ACCESS"
                                    name="facilities">
                                <label class="smalltext" for="facilities-ROAD_ACCESS"> Bilvei frem</label>
                            </div>
                            <div class="grid__unit input-toggle" data-group-name="">
                                <input data-selector="" id="facilities-BROADBAND" type="checkbox" value="BROADBAND"
                                    name="facilities">
                                <label class="smalltext" for="facilities-BROADBAND">
                                    Bredbåndstilknytning</label>
                            </div>
                            <div class="grid__unit input-toggle" data-group-name="">
                                <input data-selector="" id="facilities-BOAT_MOORING" type="checkbox"
                                    value="BOAT_MOORING" name="facilities">
                                <label class="smalltext" for="facilities-BOAT_MOORING"> Båtplass</label>
                            </div>
                            <div class="grid__unit input-toggle" data-group-name="">
                                <input data-selector="" id="facilities-GOLF" type="checkbox" value="GOLF"
                                    name="facilities">
                                <label class="smalltext" for="facilities-GOLF"> Golfbane</label>
                            </div>
                            <div class="grid__unit input-toggle" data-group-name="">
                                <input data-selector="" id="facilities-NO-NEIGHBOURS-OP" type="checkbox"
                                    value="NO-NEIGHBOURS-OP" name="facilities">
                                <label class="smalltext" for="facilities-NO-NEIGHBOURS-OP"> Ingen
                                    gjenboere</label>
                            </div>
                            <div class="grid__unit input-toggle" data-group-name="">
                                <input data-selector="" id="facilities-CABLE-TV" type="checkbox" value="CABLE-TV"
                                    name="facilities">
                                <label class="smalltext" for="facilities-CABLE-TV"> Kabel-TV</label>
                            </div>
                            <div class="grid__unit input-toggle" data-group-name="">
                                <input data-selector="" id="facilities-PUBLIC_SEWER" type="checkbox"
                                    value="PUBLIC_SEWER" name="facilities">
                                <label class="smalltext" for="facilities-PUBLIC_SEWER"> Offentlig
                                    vann/kloakk</label>
                            </div>
                            <div class="grid__unit input-toggle" data-group-name="">
                                <input data-selector="" id="facilities-VIEW" type="checkbox" value="VIEW"
                                    name="facilities">
                                <label class="smalltext" for="facilities-VIEW"> Utsikt</label>
                            </div>
                            <div class="grid__unit input-toggle" data-group-name="">
                                <input data-selector="" id="facilities-ANGLING" type="checkbox" value="ANGLING"
                                    name="facilities">
                                <label class="smalltext" for="facilities-ANGLING"> Fiskemulighet</label>
                            </div>
                            <div class="grid__unit input-toggle" data-group-name="">
                                <input data-selector="" id="facilities-SHORELINE" type="checkbox" value="SHORELINE"
                                    name="facilities">
                                <label class="smalltext" for="facilities-SHORELINE"> Strandlinje</label>
                            </div>
                            <div class="grid__unit input-toggle" data-group-name="">
                                <input data-selector="" id="facilities-HIKING" type="checkbox" value="HIKING"
                                    name="facilities">
                                <label class="smalltext" for="facilities-HIKING"> Turterreng</label>
                            </div>
                        </div>
                        <div data-group-list=""></div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="form-group">
                        <div class="col-md-4 pl-0">
                            <label for="price_suggestion" class="u-t5">Prisantydning </label>
                            <input id="price_suggestion" name="price_suggestion" type="text" value=""
                                class="dme-form-control" placeholder="Kr.">
                                  <span class="error-span price_suggestion"></span>
                        </div>
                        <div class="input__sub-text">
                            <span class="u-t5">Minstebeløpet du selger eiendommen
                                for.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 pl-0">
                            <label for="sales_cost_sum" class="u-t5">Omkostninger </label>
                            <input id="sales_cost_sum" name="sales_cost_sum" type="text" value=""
                                class="dme-form-control" placeholder="Kr.">
                                <span class="error-span sales_cost_sum"></span>
                        </div>
                        <div class="input__sub-text">
                            <span class="u-t5">Dersom det vil påløpe ekstra omkostninger
                                ved salg av denne eiendommen oppgir du beløpet her. Fyll inn 0 hvis det ikke er
                                ekstra omkostninger.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 pl-0">
                            <label for="total_price_view" class="u-t5">Totalpris</label>
                            <input class="dme-form-control" id="total_price_view" name="total_price_view" type="text"
                                value="" style="background:transparent;border:none;">
                                  <span class="error-span sales_cost_sum"></span>
                            {{-- <div class="hidden" data-hr-container="">
                                                                                                                                            <hr class="form-col-2 u-mv0">
                                                                                                                                                <hr class="form-col-2 u-mv0 u-mt4">
                                                                                                                                                </div> --}}
                        </div>
                        <div class="input__sub-text">
                            <span class="u-t5">Regnes ut som summen av prisantydning og
                                omkostninger. Begge disse feltene må fylles ut for at totalpris skal
                                vises.</span>
                        </div>
                    </div>
                    <input value="" id="total_price" type="hidden" name="total_price">
                    <div class="u-mb32" data-controller="view-time" data-max-elements="10">
                        <div data-viewtime-item="">
                            <div class="form-group">
                                <div class="input input--date">
                                    <div class="col-md-4 pl-0">
                                        <label for="viewing.date0" class="u-t5">(valgfritt)</label>
                                        <input id="viewing.date0" name="date0" type="date" value=""
                                            class="dme-form-control" placeholder="dd.mm.åååå">
                                             <span class="error-span date0"></span>
                                    </div>
                                    <div class="input__sub-text">
                                        <span class="input__sub-text__text-hint" data-identifier="viewing.date0"></span>
                                        <span class="u-t5">Dato (eks. 31.12.2017 eller
                                            31/12/2017)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input input--text">
                                    <div class="col-md-4 pl-0">
                                        <label for="viewing.time_from0" class="u-t5"> (valgfritt)</label>
                                        <input id="viewing.time_from0" name="time_from0" type="text" value=""
                                            class="dme-form-control" placeholder="tt.mm">
                                             <span class="error-span time_from0"></span>
                                    </div>
                                    <div class="input__sub-text">
                                        <span class="input__sub-text__text-hint"
                                            data-identifier="time_from0"></span>
                                        <span class="u-t5">Tid (eksempel 18:00)</span>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input input--text">
                                    <div class="col-md-4 pl-0">
                                        <label for="viewing.time_to0"> (valgfritt)</label>
                                        <input id="viewing.time_to0" name="time_to0" type="text" value=""
                                            class="dme-form-control" placeholder="tt.mm">
                                             <span class="error-span time_to0"></span>
                                    </div>
                                    <div class="input__sub-text">
                                        <span class="input__sub-text__text-hint"
                                            data-identifier="viewing.time_to0"></span>
                                        <span class="u-t5">Tid (eksempel 19:30)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input input--text">
                                    <label for="note0" class="u-t5"> (valgfritt)</label>
                                    <input id="note0" placeholder="F.eks.: visning etter avtale"
                                        name="note0" type="text" value="" class="dme-form-control">
                                         <span class="error-span time_to0"></span>
                                    <button class="dme-btn-outlined-blue mt-4">
                                        <span class="t2">+ </span> Legg til flere
                                        visningstidspunkt

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="u-t5"> Bilder (valgfritt) </label>
                        <input type="file" id="image" name="image" aria-hidden="true" multiple="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="document" class="u-t5">Vedlegg som PDF (valgfritt)</label>
                        <input data-pdf-input="" type="file" name="document" accept="application/pdf" aria-hidden="true"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title" class="u-t5">Annonseoverskrift</label>
                        <input id="title" name="title" type="text" value="" class="dme-form-control">
                         <span class="error-span title"></span>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 pl-0">
                            <label for="contact_mobile" class="u-t5">Telefon (valgfritt)</label>
                            <input id="contact_mobile" name="contact_mobile" type="tel" value=""
                                class="dme-form-control">
                                  <span class="error-span contact_mobile"></span>
                        </div>
                        <div class="input__sub-text">
                            <span class="u-t5">Hvilket telefonnummer ønsker du at
                                interesserte kjøpere skal kontakte deg på?</span>
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
                            <p>Hvis denne profilen ikke er riktig kan du endre den under Min handel deretter Endre
                                profil.</p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <h3 class="u-t5">Publisert</h3>
                        <label class="mb-2 form-check-label" for="published-on">
                            <input id="published-on" name="published_on" type="checkbox" class="pub_validate">Ikke vis
                            profilbilde og lenke til
                            profilsiden før kjøperen tar kontakt med meg.


                        </label>
                        <br>
                        <span class="error-span published_on"></span>
                    </div>
                    <hr>
                    <div class="notice"></div>
                    <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" id="publiser_annonsen"
                        class="dme-btn-outlined-blue mb-3 col-12 ladda-button">
                        <span class="ladda-label">Publiser
                            annonsen!</span>
                    </button>
                </form>
        </main>
    </div>
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("input,select").on("keyup change", function () {
                $(this).parent().find('.error-span').html("");
                $(this).removeClass("error-input");

            });


            /*$("#publiser_annonsen").click(function (e) {
                e.preventDefault();

                $("input ~ span,select ~ span").each(function( index ) {
                    $(".error-span").html('');
                    $("input, select").removeClass("error-input");
                });
            });
            */
        });

    </script>


    @endsection
