<form action="#" method="post" id="property_for_rent_form" enctype="multipart/form-data">

    <div class="pl-3 pr-3">
        <div class="form-group">
            <label class="u-t5">Overskrift</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="heading" class="dme-form-control"/>
                    <span class="error-span heading"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Postnummer</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="zip_code" class="dme-form-control">
                    <span class="error-span zip_code"></span>
                     <span id="zip_code_city_name"></span>
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
                    <span class="error-span street_address"></span>
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
                        <option value="Andre">Andre</option>
                        <option value="Enebolig">Enebolig</option>
                        <option value="Garasje Parkering">Garasje/Parkering</option>
                        <option value="Hybel">Hybel</option>
                        <option value="Leilighet">Leilighet</option>
                        <option value="Rekkehus">Rekkehus</option>
                        <option value="Rom i bofellesskap">Rom i bofellesskap</option>
                        <option value="Tomannsbolig">Tomannsbolig</option>
                    </select>
                    <span class="error-span property_type"></span>

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
                    <br><span class="error-span primary_rom"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Bruttoareal (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="gross_area" class="dme-form-control" placeholder="m²">
                    <span class="error-span gross_area"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Bruksareal (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="area_of_use" class="dme-form-control" placeholder="m²">
                    <span class="error-span area_of_use"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Antall soverom</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="number_of_bedrooms" class="dme-form-control" placeholder="m²">
                    <span class="error-span number_of_bedrooms"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Etasje (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="floor" class="dme-form-control" placeholder="m²">
                    <span class="error-span floor"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Møblering</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select id="furnishing" name="furnishing" class="dme-form-control">
                        <option value=""></option>
                        <option value="Delvis møblert">Delvis møblert</option>
                        <option value="Møblert">Møblert</option>
                        <option value="Umøblert">Umøblert</option>
                    </select>
                    <span class="error-span furnishing"></span>
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
                        <option value="Gul">Gul</option>
                        <option value="Lysegrønn">Lysegrønn</option>
                        <option value="Mørkegrønn">Mørkegrønn</option>
                        <option value="Oransje">Oransje</option>
                        <option value="Rød">Rød</option>
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
                    <span class="error-span facilities-AIRCONDITIONING2"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Månedsleie</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="monthly_rent" class="dme-form-control" placeholder="Kr.">
                    <span class="error-span monthly_rent"></span>
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
                    <span class="error-span deposit"></span>
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
                    <span class="error-span include_in_rent"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Leies ut fra</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="date" name="rented_from" class="dme-form-control">
                    <span class="error-span rented_from"></span>
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
                    <span class="error-span rented_to"></span>
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
                    <span class="u-t5">Fortell om hva som er bra med boligen, hva som er inkludert av møbler og innredning osv. Fortell gjerne litt om nabolaget og nærhet til transport.</span>
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
                <input id="published-on" name="published_on" type="checkbox" class="pub_validate">Ikke vis profilbilde og
 lenke til profilsiden
            </label><br>
            <span class="error-span published_on"></span>
        </div>
        <hr>
        <div class="notice"></div>
        <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" id="publiser_annonsen"
                class="dme-btn-outlined-blue mb-3 col-12 ladda-button"><span class="ladda-label">Publiser annonsen!</span></button>
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

