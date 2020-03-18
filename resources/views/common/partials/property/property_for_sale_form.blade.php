<form action="#" method="post" id="property_for_sale_form"  class="dropzone addMorePics p-0"
      data-action="@if(Request::is('new/property/sale/ad/*/edit') || Request::is('complete/ad/*'))
      {{url('update-upload-images?ad_id='.$property_for_sale1->ad->id)}}
        @else {{route('upload-images')}} @endif" enctype="multipart/form-data" data-append_input = 'yes'>
<?php
    $property_type = \App\Taxonomy::where('slug', 'pfs_property_type')->first();
    $property_types = $property_type->terms;
    $tenure = \App\Taxonomy::where('slug', 'pfs_tenure')->first();
    $tenures = $tenure->terms;

        $property_for_sale = new \App\PropertyForSale();
    if(isset($property_for_sale1)){
        $property_for_sale = $property_for_sale1;
    }

    $pfs_facility = \App\Taxonomy::where('slug', 'pfs_facilities')->first();
    $pfs_facilities = $pfs_facility->terms;
    ?>
 @if(Request::is('new/property/sale/ad/*/edit') || Request::is('complete/ad/*'))
   @method('PATCH')
  @endif
    <input type="hidden" id="total_price" name="total_price" value="{{ $property_for_sale->total_price }}">
    <input type="hidden" name="upload_dropzone_images_type" value="property_for_sale_temp_images">
    <input type="hidden" id="old_zip" value="{{ (isset($property_for_sale->zip_code) ? $property_for_sale->zip_code : '') }}">
    <input type="hidden" id="zip_city" name="zip_city" value="{{ (isset($property_for_sale->zip_city) ? $property_for_sale->zip_city : '') }}">



    <div class="pl-3 pr-3">
        <div class="form-group">
            <h3 class="u-t5">Annonseoverskrift</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="headline" id="1234as" value="{{ $property_for_sale->headline }}" class="dme-form-control">
                    <span class="error-span headline"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Postnummer</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="zip_code" type="text" value="{{ $property_for_sale->zip_code }}" class="dme-form-control zip_code">
                    <span class="error-span zip_code"></span>
                     <span id="zip_code_city_name">{{ (isset($property_for_sale->zip_city) ? strtoupper($property_for_sale->zip_city) : '')
                      }}</span>
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Gateadresse</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="street_address" type="text" value="{{ $property_for_sale->street_address }}" class="dme-form-control">
                    <span class="error-span street_address"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Adkomst <span class="text-muted">(valgfritt)</span></h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                <textarea type="text" name="access" class="dme-form-control">{{ $property_for_sale->access }}</textarea><br>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Beliggenhet <span class="text-muted">(valgfritt)</span></h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea type="text" name="location" class="dme-form-control">{{ $property_for_sale->location }}</textarea><br>

                    <span class="error-span location"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Navn på lokalområde <span class="text-muted">(valgfritt)</span></h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="local_area_name" value="{{ $property_for_sale->local_area_name }}" class="dme-form-control"
                           placeholder="Bydel.">

                    <span class="error-span local_area_name"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Boligtype</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select class="dme-form-control" name="property_type" id="property_type" class="select-box">
                        <option value=""></option>
                        @foreach($property_types as $type)
                            <option value="{{$type->name}}" {{ ($property_for_sale->property_type == $type->name ? 'selected' : '') }}>{{$type->name}}</option>
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
                    <select name="tenure" class="dme-form-control select-box">
                        <option value=""></option>
                        @foreach($tenures as $type)
                            <option value="{{$type->name}}" {{($property_for_sale->tenure == $type->name ? 'selected' : '')}}>{{$type->name}}</option>
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
                        <input name="municipality_number" type="text" value="{{ $property_for_sale->municipality_number }}" class="dme-form-control">
                        <span class="error-span municipality_number"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Du kan finne ditt kommunenummer på kartverkets hjemmesider.
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
                        <input name="farm_number" value="{{ $property_for_sale->farm_number }}" type="text" class="dme-form-control">
                        <span class="error-span farm_number"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Dette kan du finne på kartverkets hjemmesider.</div>
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
                        <input name="usage_number" value="{{ $property_for_sale->usage_number }}" type="text" class="dme-form-control">
                        <span class="error-span usage_number"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Du kan finne dette på kartverkets hjemmesider.
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
                        <input name="party_number" value="{{ $property_for_sale->party_number }}" type="text" class="dme-form-control">
                        <span class="error-span party_number"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Du kan finne festenummeret til din eiendom på kartverkets hjemmesider.
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
                        <input name="section_number" value="{{ $property_for_sale->section_number }}" type="text" class="dme-form-control">
                        <span class="error-span section_number"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Du kan finne ditt seksjonsnummer på kartverkets hjemmesider.
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
                        <input name="apartment_number" value="{{ $property_for_sale->apartment_number }}" type="text" class="dme-form-control" placeholder="H0201">
                        <span class="error-span apartment_number"></span>
                     </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">

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
                        <input type="text" name="use_area" value="{{ $property_for_sale->use_area }}" class="dme-form-control" placeholder="m²">
                        <span class="error-span use_area"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Du kan finne bruksarealet i takstrapporten.</div>
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
                    <input name="primary_room" value="{{ $property_for_sale->primary_room }}" type="text" class="dme-form-control" placeholder="m²">
                        <span class="error-span primary_room"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Du kan finne arealet for primærrom i takstrapporten.</div>
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
                        <input type="text" name="Base" value="{{ $property_for_sale->Base }}" class="dme-form-control" placeholder="m²">
                        <span class="error-span Base"></span>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-12">
                        <div class="u-t5">Det arealet som bygningen dekker på tomten.
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
                    <textarea name="area_description" type="text" class="dme-form-control">{{ $property_for_sale->area_description }}</textarea><br>
                    <span class="u-t5">Størrelsen på rom i eiendommen</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Byggeår</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="year" value="{{ $property_for_sale->year }}" type="text" class="dme-form-control" placeholder="åååå">
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
                    <input name="renovated_year" value="{{ $property_for_sale->renovated_year }}" type="text" class="dme-form-control" placeholder="åååå">
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
                    <select name="energy_grade" class="dme-form-control select-box">
                        <option value=""></option>
                        <option value="A" {{($property_for_sale->energy_grade == 'A' ? 'selected' : '')}}>A</option>
                        <option value="B" {{($property_for_sale->energy_grade == 'B' ? 'selected' : '')}}>B</option>
                        <option value="C" {{($property_for_sale->energy_grade == 'C' ? 'selected' : '')}}>C</option>
                        <option value="D" {{($property_for_sale->energy_grade == 'D' ? 'selected' : '')}}>D</option>
                        <option value="E" {{($property_for_sale->energy_grade == 'E' ? 'selected' : '')}}>E</option>
                        <option value="F" {{($property_for_sale->energy_grade == 'F' ? 'selected' : '')}}>F</option>
                        <option value="G" {{($property_for_sale->energy_grade == 'G' ? 'selected' : '')}}>G</option>
                    </select>
                    <span class="error-span energy_grade"></span>
                    <span class="u-t5">Enegikarakter der A er best.</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <h3 for="" class="u-t5">Oppvarmingskarakter (valgfritt)</h3>
                    <select name="heating_character" class="dme-form-control select-box">
                        <option value=""></option>
                        <option value="Gul" {{($property_for_sale->heating_character == 'Gul' ? 'selected' : '')}}>Gul</option>
                        <option value="Lysegrønn" {{($property_for_sale->heating_character == 'Lysegrønn' ? 'selected' : '')}}>Lysegrønn</option>
                        <option value="Mørkegrønn" {{($property_for_sale->heating_character == 'Mørkegrønn' ? 'selected' : '')}}>Mørkegrønn</option>
                        <option value="Oransje" {{($property_for_sale->heating_character == 'Oransje' ? 'selected' : '')}}>Oransje</option>
                        <option value="Rød" {{($property_for_sale->heating_character == 'Rød' ? 'selected' : '')}}>Rød</option>
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
                    <input name="number_of_bedrooms" value="{{ $property_for_sale->number_of_bedrooms }}" type="text" class="dme-form-control">
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
                    <input name="number_of_rooms" value="{{ $property_for_sale->number_of_rooms }}" type="text" class="dme-form-control">
                    <span class="error-span number_of_rooms"></span>
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12">
                    <div class="u-t5">Bod og garasje ol. er ikke medregnet.</div>
                </div>
                <br>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Etasje (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="floor" type="text" value="{{ $property_for_sale->floor }}" class="dme-form-control">
                    <span class="error-span floor"></span>

                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>
        <div class="form-group ">
            <h3 class="mb-2 form-check-label" for="approved_rental_part">
                <input id="approved_rental_part" value="true" name="approved_rental_part" type="checkbox" {{$property_for_sale->approved_rental_part == "true" ? "checked" : ""}}>Godkjent utleiedel
                <span class="error-span approved_rental_part"></span>
            </h3>
            <div class="u-t5">Dersom eiendommen har godkjent utleiedel huker du av for dette her.</div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Fasiliteter (valgfritt)</h3>
            <div class="row">
                @php
                    $property_facilities = array();
                    if($property_for_sale->facilities){
                        $property_facilities = json_decode($property_for_sale->facilities);
                    }
                @endphp
                @foreach($pfs_facilities as $facility)
                    <div class="col-md-4 input-toggle">
                        <input id="facilities-{{$facility->id}}" type="checkbox" value="{{$facility->name}}" name="facilities[]" {{is_numeric(array_search($facility->name, $property_facilities)) ? "checked" : ""}}>
                        <label class="smalltext" for="facilities-{{$facility->id}}"> {{$facility->name}}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Borettslagets navn (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="housing_team" value="{{ $property_for_sale->housing_team }}" class="dme-form-control">
                    <span class="error-span housing_team"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Borettslagets eier (valgfritt)
            </h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="owner_of_housing" value="{{ $property_for_sale->owner_of_housing }}" type="text" class="dme-form-control">
                    <span class="error-span owner_of_housing"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Borettslagets org.nummer (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="housing_type_org_number" value="{{ $property_for_sale->housing_type_org_number }}" type="text" class="dme-form-control">
                    <span class="error-span housing_type_org_number"></span>
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <div class="u-t5">Org. nr. til ditt borettslag finnes hos Brønnøysundregistrene.</div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Borettslagets andelsnummer (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                <input name="housing_cooperative_share_number" value="{{ $property_for_sale->housing_cooperative_share_number }}" type="text" class="dme-form-control">
                    <span class="error-span housing_cooperative_share_number"></span>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-md-12">
                    <div class="u-t5">Du kan finne ditt andelsnummer på kartverkets hjemmesider.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Tomteareal (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="land" type="text" value="{{ $property_for_sale->land }}"  class="dme-form-control" placeholder="m²">
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
                    <input name="holiday_year" value="{{ $property_for_sale->holiday_year }}"   type="text" class="dme-form-control" placeholder="åååå">
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
                    <input name="party_fee" value="{{ $property_for_sale->party_fee }}" type="text" class="dme-form-control" placeholder="Kr.">
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
                           value="AIRCONDITIONING2" {{$property_for_sale->facilities2 == "AIRCONDITIONING2" ? "checked" : ""}}>
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
                    <textarea name="character" id="beskrivelse" cols="30" rows="10">{{ $property_for_sale->character }}</textarea>
                    <span class="u-t5">Info om adkomst, regulering, parkering og hage mm.</span>
                    <span class="error-span character"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Husleie/felleskost.</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="rent_shared_cost" type="text" value="{{ $property_for_sale->rent_shared_cost }}"  class="dme-form-control" placeholder="Kr.">
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
                    <input name="shared_costs_include" value="{{ $property_for_sale->shared_costs_include }}" type="text" class="dme-form-control"
                           placeholder="F.eks. kabeltv, strøm, vaktmester, trappevask, forsikring, kommunale avgifter">
                    <span class="error-span shared_costs_include"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Felleskostnader etter avdragsfri periode (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input name="common_costs_after_interest_free_period" value="{{ $property_for_sale->common_costs_after_interest_free_period }}"  type="text" class="dme-form-control"
                           placeholder="Kr.">
                    <span class="error-span common_costs_after_interest_free_period"></span>
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12">
               </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Formuesverdi</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="asset_value" value="{{ $property_for_sale->asset_value }}"   type="text" class="dme-form-control total_price_constants"
                           placeholder="Kr.">
                    <span class="error-span asset_value"></span>
                    <div class="u-t5">Mer om formuesverdi og hvordan du beregner dette kan du finne på skatteetaten sin hjemmeside.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Prisantydning</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="asking_price" value="{{ $property_for_sale->asking_price }}" class="dme-form-control total_price_constants asking_price"
                           placeholder="Kr.">
                    <span class="error-span asking_price"></span>
                </div>
                <div class="col-sm-8">
                </div>

            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Omkostninger</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="expenses" type="text" value="{{ $property_for_sale->expenses }}" class="dme-form-control total_price_constants costs_include" placeholder="Kr.">
                    <span id="expenses" class="error-span expenses"></span>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-md-12">
                    <div class="u-t5">Omkostninger ved salg av eiendom.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Omkostninger inkluderer</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="costs_include" value="{{ $property_for_sale->costs_include }}" type="text" class="dme-form-control total_price_constants">
                    <span class="error-span costs_include"></span>
                </div>
                <div class="col-sm-8">
                </div>

            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Andel fellesgjeld</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                <input name="percentage_of_public_debt" value="{{ $property_for_sale->percentage_of_public_debt }}" type="text"
                           class="dme-form-control total_price_constants percentage_of_public_debt" placeholder="Kr.">
                    <span class="error-span percentage_of_public_debt"></span>
                </div>
                <div class="col-sm-8">
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
                    <div class="u-t5">Total pris ink fellesgjeld, prisantydning og
omkostninger.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Verditakst (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="value_rate" value="{{ $property_for_sale->value_rate }}" type="text" class="dme-form-control" placeholder="Kr.">
                    <span class="error-span value_rate"></span>
                </div>
                <div class="col-sm-8">
                </div>
                <div class="col-md-12">
                    <div class="u-t5">Markedsverdi for din eiendom.
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Lånetakst (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="loan_rate" value="{{ $property_for_sale->loan_rate }}" type="text" class="dme-form-control" placeholder="Kr">
                    <span class="error-span loan_rate"></span>
                </div>

            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Andel fellesformue (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" value="{{ $property_for_sale->percentage_of_common_wealth }}" name="percentage_of_common_wealth" class="dme-form-control" placeholder="Kr.">
                    <span class="error-span percentage_of_common_wealth"></span>
                </div>

            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Kommunale avgifter pr. år (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="muncipal_fees_per_year" value="{{ $property_for_sale->muncipal_fees_per_year }}" type="text" class="dme-form-control" placeholder="Kr.">
                    <span class="error-span muncipal_fees_per_year"></span>
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12 input-toggle">
                    <input data-selector="" id="facilities-AIRCONDITIONING3" type="checkbox" value="AIRCONDITIONING3"
                           name="facilities3" {{$property_for_sale->facilities3 == "AIRCONDITIONING3" ? "checked" : ""}}>
                    <label class="smalltext" for="facilities-AIRCONDITIONING3"> Borettslaget har
                        sikringsordning </label>
                    <span class="error-span facilities3"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Mer info om felleskostander (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="joint_debt_costs" id="beskrivelse" cols="30" rows="10">{{ $property_for_sale->joint_debt_costs }}</textarea>
                    <span class="error-span joint_debt_costs"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Forkjøpsrett (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="pre_empt_right" type="text" value="{{ $property_for_sale->pre_empt_right }}" class="dme-form-control">

                    <span class="error-span pre_empt_right"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12 input-toggle">
                    <input data-selector="" id="facilities-AIRCONDITIONING4" type="checkbox" value="facilities4"
                           name="facilities4" {{$property_for_sale->facilities4 == "facilities4" ? "checked" : ""}}>
                    <label class="smalltext" for="facilities-AIRCONDITIONING4"> Jeg har eierskifteforsikring </label>
                    <span id="AIRCONDITIONING4" class="error-span"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Bilder (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    @php $dropzone_img_obj = $property_for_sale; @endphp
                    @include('user-panel.partials.dropzone',compact('dropzone_img_obj'))
                    {{--<input type="file" name="property_photos[]" id="property_photos" class="mt-3" multiple>--}}
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Beskrivelse (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="description2" id="beskrivelse" cols="30" rows="10">{{ $property_for_sale->description2 }}</textarea>

                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Andre opplysninger (valgfritt)</h3>
            <div class="row">
            <div class="col-sm-12 pr-md-0">
                <textarea name="essential_information" id="beskrivelse" cols="30" rows="10">{{ $property_for_sale->essential_information }}</textarea>
                    <span class="u-t5">Informer om betydelig feil og mangler, referer evt. også til takst.</span>
                    <span class="error-span essential_information"></span>
            </div>
            </div>
        </div>
        @php
            $property_for_sale_quote = $property_for_sale_pdf = '';
            if($property_for_sale && $property_for_sale->ad && $property_for_sale->ad->sales_information->count() > 0){
                $property_for_sale_quote = $property_for_sale->ad->sales_information->first();
            }
            if($property_for_sale && $property_for_sale->ad && $property_for_sale->ad->pdf->count() > 0){
                $property_for_sale_pdf = $property_for_sale->ad->pdf->first();
            }
        @endphp
        <!-- Attachement as sales information -->
        <div class="form-group">
            <h3 class="u-t5">Last opp komplett salgsinformasjon</h3>
            <div class="row property-quote-div">
                <div class="col-sm-6">
                    <input type="file" name="property_quote" id="property_quote" accept="application/pdf" @if($property_for_sale_quote) style="pointer-events: none" @endif>
                </div>
                <div class="col-sm-3 property-quote-value">
                    @if($property_for_sale_quote)
                       {{Str::limit($property_for_sale_quote->name,20)}}
                    @endif
                </div>
                <div class="col-sm-2">
                    <span class="@if(!$property_for_sale_quote) d-none @endif remove-selected-file-button remove_property_quote dz-remove" @if($property_for_sale_quote) id="{{$property_for_sale_quote->name_unique}}" @endif><i class="fa fa-trash fa-lg mt-1"></i></span>
                </div>
                <span class="col-12 property-quote-information-message @if(!$property_for_sale_quote) d-none @endif"><small>Fjern gammel fil før du velger en ny fil.</small></span>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Skriv nettadresse for å gi bud på nett (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="offer_url" type="text" value="{{ $property_for_sale->offer_url }}" placeholder="webside.no" class="dme-form-control">
                    {{--<span class="error-span video"></span>--}}
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Video (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="video" type="text" value="{{ $property_for_sale->video }}" class="dme-form-control">
                    <div class="u-t5">Link til video</div>
                    <span class="error-span video"></span>
                </div>
            </div>
        </div>

        @if(Auth::user()->hasRole('company'))
            <!-- Attachement as pdf files -->
            <div class="form-group">
                <h3 class="u-t5">Vedlegg som PDF</h3>
                <div class="row property-pdf-div">
                    <div class="col-sm-6">
                        <input type="file" name="property_pdf" id="property_pdf" class="" accept="application/pdf"  @if($property_for_sale_pdf) style="pointer-events: none" @endif>
                    </div>
                    <div class="col-sm-3 property-pdf-value">
                        @if($property_for_sale_pdf)
                            {{Str::limit($property_for_sale_pdf->name,20)}}
                        @endif
                    </div>
                    <div class="col-sm-2">
                        <span class="@if(!$property_for_sale_pdf) d-none @endif remove-selected-file-button remove_property_pdf dz-remove"  @if($property_for_sale_pdf) id="{{$property_for_sale_pdf->name_unique}}" @endif><i class="fa fa-trash fa-lg mt-1"></i></span>
                    </div>
                    <span class="col-12 property-pdf-information-message @if(!$property_for_sale_pdf) d-none @endif"><small>Fjern gammel fil før du velger en ny fil.</small></span>

                </div>
            </div>
        @endif


        <div class="form-group">
            <h3 class="u-t5">Visningsdato (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input name="deliver_date[]" value="{{ $property_for_sale->deliver_date }}"  type="date" class="dme-form-control">
                    <span class="error-span deliver_date"></span>
                </div>
                <div class="col-md-8"></div>
                <div class="u-t5 col-12">Dato (eks. 31.12.2017 eller 31/12/2017)</div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Fra klokken (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input name="from_clock[]" value="{{ $property_for_sale->from_clock }}" type="text" class="dme-form-control" placeholder="tt.mm">
                    <span class="error-span from_clock"></span>
                </div>
                <div class="col-md-8"></div>
                <div class="u-t5 col-12">Tid (eksempel 18:00)</div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Til klokken (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input name="clockwise[]" value="{{ $property_for_sale->clockwise }}" type="text" class="dme-form-control" placeholder="tt.mm">
                    <span class="error-span clockwise"></span>
                </div>
                <div class="col-md-8"></div>
                <div class="u-t5 col-12">Tid (eksempel 19:30)</div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Merknad (valgfritt)</h3>
            <div class="row">
                <div class="col-md-12 pr-md-0">
                    <input name="note1[]" value="{{ $property_for_sale->note1 }}" type="text" class="dme-form-control"
                           placeholder="F.eks.: visning etter avtale">
                    <span class="error-span note1"></span>
                </div>
                <div class="u-t5 col-12">Tid (eksempel 19:30)</div>
            </div>
        </div>


        <div id="add_more_viewing_times_fields">

        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <button id="add_more_viewing_times_sales" type="button" class="dme-btn-outlined-blue"> + Visningstidspunt
                    </button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Telefon (valgfritt)</h3>
            <div class="row">
                <div class="col-md-12 pr-md-0">
                    <input name="phone" value="{{ $property_for_sale->phone }}" type="tel" id="phone" class="dme-form-control">
                    <span id="valid-msg" class="hide"></span>
                    <span id="error-msg" class="hide"></span>

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
                <p>Hvis denne profilen ikke er riktig kan du endre den under min handel deretter endre profil.</p>
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
                class="dme-btn-outlined-blue mb-3 col-12 ladda-button"><span class="ladda-label">@if(Request::is('new/property/sale/ad/*/edit')) {{'Oppdater annonsen'}} @else {{ 'Publiser annonsen!' }} @endif</span></button>
    </div>
</form>
