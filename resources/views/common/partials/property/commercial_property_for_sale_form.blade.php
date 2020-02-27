<form action="#" method="post" id="commercial_property_for_sale" class="dropzone addMorePics p-0"
      data-action="@if(Request::is('add/new/commercial/property/for/sale/*/edit')){{url('update-upload-images?ad_id='.$commercial_property->ad->id)}}
      @else {{route('upload-images')}} @endif" enctype="multipart/form-data" data-append_input = 'yes'>
@php

     $commercial_property_for_sale = new \App\CommercialPropertyForSale();
    if(isset($commercial_property)){
        $commercial_property_for_sale = $commercial_property;
    }
    $country = \App\Taxonomy::where('slug', 'country')->first();
    $countries = $country->terms;

    $property_type = json_decode($commercial_property_for_sale->property_type);
       // dd($property_type);
    if(empty($property_type)){$property_type=array();}

    $facilities = explode(',', $commercial_property_for_sale->facilities);

@endphp
  @if(Request::is('add/new/commercial/property/for/sale/*/edit'))
@method('PATCH')
@endif
    <div class="pl-3">

        <input type="hidden" name="upload_dropzone_images_type" value="commercial_property_for_sale_temp_images">

        <!--                            checkbox -->
        <div class="form-group">
            <h3 class="u-t5">Type lokale</h3>
            <div class="row">
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-OFFICE" type="checkbox" value="Kontor" name="property_type[]"  {{ (in_array("Kontor", $property_type)) ? "checked" : "" }} >
                    <label class="smalltext" for="property_type-OFFICE"> Kontor</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-BUSINESS" type="checkbox" value="Butikk/Handel" name="property_type[]" {{ (in_array("Butikk/Handel", $property_type))?"checked":"" }} >
                    <label class="smalltext" for="property_type-BUSINESS"> Butikk/Handel</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-INDUSTRIAL" type="checkbox" value="Produksjon/Industri" name="property_type[]" {{ (in_array("Produksjon/Industri", $property_type))?"checked":"" }} >
                    <label class="smalltext" for="property_type-INDUSTRIAL"> Produksjon/Industri</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-WAREHOUSE" type="checkbox" value="Lager/Logistikk" name="property_type[]" {{ (in_array("Lager/Logistikk", $property_type))?"checked":"" }}>
                    <label class="smalltext" for="property_type-WAREHOUSE"> Lager/Logistikk</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-MULTIPURPOSEAREA" type="checkbox" value="Kombinasjonslokaler" {{ (in_array("Kombinasjonslokaler", $property_type))?"checked":"" }} name="property_type[]">
                    <label class="smalltext" for="property_type-MULTIPURPOSEAREA"> Kombinasjonslokaler</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-FARM" type="checkbox" value="Gårdsbruk/Småbruk" name="property_type[]" {{ (in_array("Gårdsbruk/Småbruk", $property_type))?"checked":"" }} >
                    <label class="smalltext" for="property_type-FARM"> Gårdsbruk/Småbruk</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-MULTIUNITS" type="checkbox" value="Bygård/Flermannsbolig" name="property_type[]" {{ (in_array("Bygård/Flermannsbolig", $property_type))?"checked":"" }}>
                    <label class="smalltext" for="property_type-MULTIUNITS"> Bygård/Flermannsbolig</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-SHOPPINGMALL" type="checkbox" value="Kjøpesenter" name="property_type[]" {{ (in_array("Kjøpesenter", $property_type))?"checked":"" }} >
                    <label class="smalltext" for="property_type-SHOPPINGMALL"> Kjøpesenter</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-MECHSHOP" type="checkbox" value="Verksted" name="property_type[]" {{ (in_array("Verksted", $property_type))?"checked":"" }} >
                    <label class="smalltext" for="property_type-MECHSHOP"> Verksted</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-GARAGE" type="checkbox" value="Garasje/Parkering" name="property_type[]" {{ (in_array("Garasje/Parkering", $property_type))?"checked":"" }} >
                    <label class="smalltext" for="property_type-GARAGE"> Garasje/Parkering</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-HOTEL" type="checkbox" value="Hotell/Overnatting" name="property_type[]" {{ (in_array("Hotell/Overnatting", $property_type))?"checked":"" }} >
                    <label class="smalltext" for="property_type-HOTEL"> Hotell/Overnatting</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-RESTAURANT" type="checkbox" value="Serveringslokale/Kantine" name="property_type[]" {{ (in_array("Serveringslokale/Kantine", $property_type))?"checked":"" }} >
                    <label class="smalltext" for="property_type-RESTAURANT"> Serveringslokale/Kantine</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-LEARNINGFACILITY" type="checkbox" value="Undervisning/Arrangement" name="property_type[]" {{ (in_array("Undervisning/Arrangement", $property_type))?"checked":"" }}>
                    <label class="smalltext" for="property_type-LEARNINGFACILITY"> Undervisning/Arrangement</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-OTHER" type="checkbox" value="Andre" name="property_type[]" {{ (in_array("Andre", $property_type))?"checked":"" }} >
                    <label class="smalltext" for="property_type-OTHER"> Andre</label>
                </div>
            </div>
        </div>

        <!--                            selection-->
        <div class="form-group">
            <h3 class="u-t5">Land</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select class="dme-form-control" id="location" name="location">
                        @foreach($countries as $ctry)
                   <option value="{{$ctry['name']}}"{{ ($commercial_property_for_sale->location == $ctry['name']) ? 'selected' : '' }}>{{$ctry['name']}}</option>
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
                    <input name="zip_code" value="{{ $commercial_property_for_sale->zip_code }}" type="text" class="dme-form-control">
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
                    <input name="street_address" value="{{ $commercial_property_for_sale->street_address }}" type="text" class="dme-form-control">
                    <span class="u-t5">Forklar kort om adkomsten til boligen og hvordan man finner fram, fortell gjerne om nærhet til vei, buss og tog.</span>
                </div>
            </div>
        </div>
        <!--                            text area-->
        <div class="form-group">
            <h3 class="u-t5">Adkomst (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="descripion_access" id="descripion_access" cols="30" rows="10">{{ $commercial_property_for_sale->descripion_access }}</textarea>
                    <span class="u-t5">Forklar kort om adkomsten til lokalet og hvordan man finner fram, fortell gjerne om nærhet til vei, buss og tog.</span>
                </div>
            </div>
        </div>
        <!--                            text area-->
        <div class="form-group">
            <h3 class="u-t5">Adkomst (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="descripion_access1" id="descripion_access1" cols="30" rows="10">{{ $commercial_property_for_sale->descripion_access1 }}</textarea>
                    <span class="u-t5">Forklar kort om beliggenheten, omgivelsene, attraktive naturforhold, betraktninger om lokaliseringsfordeler og strøksattraktivitet</span>
                </div>
            </div>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Kommunenummer (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="municipal_number" value="{{ $commercial_property_for_sale->municipal_number }}" type="text" class="dme-form-control">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <span class="u-t5">Dette finner du på kartverkets hjemmeside.</span>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Bruksnummer (Bnr) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="usage_number" value="{{ $commercial_property_for_sale->usage_number }}" type="text" class="dme-form-control">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <span class="u-t5">Dette finner du på kartverkets hjemmeside.</span>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Gårdsnummer (Gnr) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="farm_number" value="{{ $commercial_property_for_sale->farm_number }}" type="text" class="dme-form-control">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <span class="u-t5">Dette finner du på kartverkets hjemmeside.</span>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Bruttoareal (BTA) fra</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="gross_area_from" value="{{ $commercial_property_for_sale->gross_area_from }}" type="text" class="dme-form-control" placeholder="m²">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <span class="u-t5">Bruttoareal er totale arealet ink yttervegger.</span>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Bruttoareal (BTA) til</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="gross_area_to" value="{{ $commercial_property_for_sale->gross_area_to }}" type="text" class="dme-form-control" placeholder="m²">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <span class="u-t5">Bruttoareal er totale arealet ink yttervegger.</span>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Primærrom (P-ROM) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="primary_room" value="{{ $commercial_property_for_sale->primary_room }}" type="text" class="dme-form-control" placeholder="m²">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <span class="u-t5">Du kan finne arealet for primærrom i takstrapporten.</span>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Bruksareal (BRA) (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="use_area" value="{{ $commercial_property_for_sale->use_area }}" type="text" class="dme-form-control" placeholder="m²">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <span class="u-t5">Du kan finne bruksarealet i takstrapporten.</span>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Tomteareal (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="land" value="{{ $commercial_property_for_sale->land }}" type="text" class="dme-form-control" placeholder="m²">
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
                    <input name="number_of_office_space" value="{{ $commercial_property_for_sale->number_of_office_space }}" type="text" class="dme-form-control">
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
                    <input name="number_of_parking_space" value="{{ $commercial_property_for_sale->number_of_parking_space }}" type="text" class="dme-form-control">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Etasjer (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="floors" value="{{ $commercial_property_for_sale->floors }}"  type="text" class="dme-form-control">
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
                    <input name="year_of_construction" value="{{ $commercial_property_for_sale->year_of_construction }}" type="text" class="dme-form-control" placeholder="åååå">
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
                    <input name="rennovated_year" value="{{ $commercial_property_for_sale->rennovated_year }}" type="text" class="dme-form-control" placeholder="åååå">
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
                        <option value="{{ $commercial_property_for_sale->energy_grade }}">{{ $commercial_property_for_sale->energy_grade }}</option>
                        <option value=""></option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                    </select>
                    <span class="u-t5">Enegikarakter der A er best.</span>
                </div>
            </div>
        </div>
        <!--                            selection-->
        <div class="form-group">
            <h3 class="u-t5">Oppvarmingskarakter (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select name="heating_character" class="dme-form-control">
                        <option value="{{ $commercial_property_for_sale->heating_character }}">{{ $commercial_property_for_sale->heating_character }}</option>
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
        <!--                            text area-->
        <div class="form-group">
            <h3 class="u-t5">Standard/Tekniske opplysninger (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="standard_technica_information" id="standard_technica_information" cols="30" rows="10">{{ $commercial_property_for_sale->standard_technica_information }}</textarea>

                </div>
            </div>
        </div>
        <!--                            checkbox -->
        <div class="form-group">
            <h3 class="u-t5">Fasiliteter (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 input-toggle">
                    <input id="facilities-AIRCONDITIONING" type="checkbox" value="AIRCONDITIONING" name="facilities[]" {{ (in_array("AIRCONDITIONING", $facilities) ? "checked" : "") }}>
                    <label class="smalltext" for="facilities-AIRCONDITIONING"> Aircondition</label>
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
            <h3 class="u-t5">Leieinntekter (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="rental_income" value="{{ $commercial_property_for_sale->rental_income }}" type="text" class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>

        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Verditakst (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="value_rate" value="{{ $commercial_property_for_sale->value_rate }}" type="text" class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <span class="u-t5">Markedsverdi for din eiendom.</span>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Lånetakst (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="loan_rate" value="{{ $commercial_property_for_sale->loan_rate }}" type="text" class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>

        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Ledig fra (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="availiable_from" value="{{ $commercial_property_for_sale->availiable_from }}" type="date" class="dme-form-control">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <span class="u-t5">Dato (eks. 31.12.2018 eller 31/12/2018)</span>
        </div>
        <!--                            full input-->
        <div class="form-group">
            <h3 class="u-t5">Visningsinformasjon (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="display_information" value="{{ $commercial_property_for_sale->display_information }}"  type="text" class="dme-form-control">
                </div>
            </div>
        </div>
        <!--                            button-->
        <div class="form-group">
            <h3 class="u-t5">Legg til bilder (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    @php $dropzone_img_obj = $commercial_property_for_sale; @endphp
                    @include('user-panel.partials.dropzone',compact('dropzone_img_obj'))

                    {{--<input type="file" value="{{ $commercial_property_for_sale->commercial_property_for_sale_photos }}" name="commercial_property_for_sale_photos[]" id="commercial_property_for_sale_photos" class="" multiple>--}}
                </div>
            </div>
        </div>
        <!--                            button-->
        <div class="form-group">
            <h3 class="u-t5">Legg till pdf</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="file" value="{{ $commercial_property_for_sale->commercial_property_for_sale_pdf }}" name="commercial_property_for_sale_pdf[]" id="commercial_property_for_sale_pdf" class="" multiple>
                </div>
            </div>
        </div>
        <!--                            full input-->
        <div class="form-group">
            <h3 class="u-t5">Annonseoverskrift</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="headline" value="{{ $commercial_property_for_sale->headline }}" type="text" class="dme-form-control">
                </div>
            </div>
        </div>
        <!--                            text area-->
        <div class="form-group">
            <h3 class="u-t5">Beskrivelse (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="description_simple" id="description_simple" cols="30" rows="10">{{ $commercial_property_for_sale->description_simple }}</textarea>

                </div>
            </div>
        </div>
        <!--                            full input-->
        <div class="form-group">
            <h3 class="u-t5">Tekst på lenke (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="line_text" value="{{ $commercial_property_for_sale->line_text }}" type="text" class="dme-form-control">
                </div>
            </div>
        </div>
        <!--                            full input-->
        <div class="form-group">
            <h3 class="u-t5">Lenke for mer informasjon (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="link_for_information" value="{{ $commercial_property_for_sale->link_for_information }}" type="text" class="dme-form-control">
                </div>
            </div>
        </div>


        <div class="form-group">
            <h3 class="u-t5">Telefon (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="phone" value="{{ $commercial_property_for_sale->phone }}" type="text" class="dme-form-control">
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
