<form action="#" method="post" id="property_for_rent_form" class="dropzone addMorePics p-0"
      data-action="@if(Request::is('new/property/rent/ad/*/edit') || Request::is('complete/ad/*')){{url('update-upload-images?ad_id='.$property_for_rent1->ad->id)}}
      @else {{route('upload-images')}} @endif" enctype="multipart/form-data" data-append_input = 'yes'>
@php
     $property_for_rent = new \App\PropertyForRent();
    if(isset($property_for_rent1)){
        $property_for_rent = $property_for_rent1;
    }

    $country = \App\Taxonomy::where('slug', 'country')->first();
    $countries = $country->terms;

    $types = \App\Taxonomy::where('slug', 'pfr_property_type')->first();
    $property_types = $types->terms;

    $pfr_facilities = \App\Taxonomy::where('slug', 'pfr_facilities')->first();
    $facilities = $pfr_facilities->terms;

    //$property_type = explode(',', $flat_wishes_rented->property_type);
    //$region = explode(',', $flat_wishes_rented->region);


@endphp
    @if(Request::is('new/property/rent/ad/*/edit') || Request::is('complete/ad/*'))
        @method('PATCH')
    @endif
    <input type="hidden" id="old_zip" value="{{ (isset($property_for_rent->zip_code) ? $property_for_rent->zip_code : '') }}">
    <input type="hidden" name="upload_dropzone_images_type" value="property_for_rent_temp_images">
    <input type="hidden" name="media_position" class="media_position">
    <input type="hidden" name="deleted_media" class="deleted_media">
    <input type="hidden" name="latitude" id="latitude" value="">
    <input type="hidden" name="longitude" id="longitude" value="">
    <input type="hidden" name="full_address" id="full_address" value="">
      @if(Request::is('new/property/rent/ad/*/edit'))
    <input type="hidden" name="notify" id="notify" value="true">
    @endif
    <div class="pl-3 pr-3">
    <input type="hidden" id="zip_city" name="zip_city" value="{{ (isset($property_for_rent->zip_city) ? $property_for_rent->zip_city : '') }}">
        <div class="form-group">
            <label class="u-t5">Overskrift</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="heading" value="{{ $property_for_rent->heading }}" class="dme-form-control"/>
                    <span class="error-span heading"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Postnummer</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="zip_code" value="{{ $property_for_rent->zip_code }}" class="dme-form-control zip_code">
                    <span class="error-span zip_code"></span>
                     <span id="zip_code_city_name">{{ (isset($property_for_rent->zip_city) ? strtoupper($property_for_rent->zip_city) : '')
                      }}</span>
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
                    <input type="text" name="street_address" value="{{ $property_for_rent->street_address }}" class="dme-form-control">
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
                        @foreach($property_types as $type)
                            <option value="{{$type->name}}" {{$property_for_rent->property_type == $type->name ? 'selected' : ''}}>{{$type->name}}</option>
                        @endforeach
                    </select>
                    <span class="error-span property_type"></span>

                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Primærrom (P-ROM)</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" value="{{ $property_for_rent->primary_rom }}" name="primary_rom" class="dme-form-control" placeholder="m²">
                    <br><span class="error-span primary_rom"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Bruttoareal (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="gross_area" value="{{ $property_for_rent->gross_area }}"  class="dme-form-control" placeholder="m²">
                    <span class="error-span gross_area"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Bruksareal (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="area_of_use" value="{{ $property_for_rent->area_of_use }}" class="dme-form-control" placeholder="m²">
                    <span class="error-span area_of_use"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Antall soverom</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="number_of_bedrooms" value="{{ $property_for_rent->number_of_bedrooms }}" class="dme-form-control" placeholder="">
                    <span class="error-span number_of_bedrooms"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Etasje (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="floor" value="{{ $property_for_rent->floor }}" class="dme-form-control" placeholder="">
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
                        <option value="Delvis møblert" {{$property_for_rent->furnishing == 'Delvis møblert' ? 'selected' : ''}}>Delvis møblert</option>
                        <option value="Møblert" {{$property_for_rent->furnishing == 'Møblert' ? 'selected' : ''}}>Møblert</option>
                        <option value="Umøblert" {{$property_for_rent->furnishing == 'Umøblert' ? 'selected' : ''}}>Umøblert</option>
                    </select>
                    <span class="error-span furnishing"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Fasiliteter (valgfritt)</label>
            <div class="row">
                @php
                    $property_facilities = array();
                    if($property_for_rent->facilities){
                        $property_facilities = json_decode($property_for_rent->facilities);
                    }
                @endphp
                @foreach($facilities as $facility)
                    <div class="col-md-4 input-toggle">
                        <input id="{{$facility->name}}-{{$facility->id}}" type="checkbox" value="{{$facility->name}}"
                               name="facilities[]" {{is_numeric(array_search($facility->name, $property_facilities)) ? 'checked' : ''}}>
                        <label class="smalltext" for="{{$facility->name}}-{{$facility->id}}"> {{$facility->name}}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Energikarakter (valgfritt)</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select id="energy_label.class" name="energy_label_class" data-selector="" class="dme-form-control">
                        <option value=""></option>
                        <option value="A" {{ $property_for_rent->energy_label_class == 'A' ? 'selected' : ''}}>A</option>
                        <option value="B" {{ $property_for_rent->energy_label_class == 'B' ? 'selected' : ''}}>B</option>
                        <option value="C" {{ $property_for_rent->energy_label_class == 'C' ? 'selected' : ''}}>C</option>
                        <option value="D" {{ $property_for_rent->energy_label_class == 'D' ? 'selected' : ''}}>D</option>
                        <option value="E" {{ $property_for_rent->energy_label_class == 'E' ? 'selected' : ''}}>E</option>
                        <option value="F" {{ $property_for_rent->energy_label_class == 'F' ? 'selected' : ''}}>F</option>
                        <option value="G" {{ $property_for_rent->energy_label_class == 'G' ? 'selected' : ''}}>G</option>
                    </select>
                    <span class="u-t5">Enegikarakter der A er best.</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Oppvarmingskarakter (valgfritt)</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select id="energy_label.color" name="energy_label_color" data-selector="" class="dme-form-control">
                        <option value=""></option>
                        <option value="Gul" {{ $property_for_rent->energy_label_color == 'Gul' ? 'selected' : ''}}>Gul</option>
                        <option value="Lysegrønn" {{ $property_for_rent->energy_label_color == 'Lysegrønn' ? 'selected' : ''}}>Lysegrønn</option>
                        <option value="Mørkegrønn" {{ $property_for_rent->energy_label_color == 'Mørkegrønn' ? 'selected' : ''}}>Mørkegrønn</option>
                        <option value="Oransje" {{ $property_for_rent->energy_label_color == 'Oransje' ? 'selected' : ''}}>Oransje</option>
                        <option value="Rød" {{ $property_for_rent->energy_label_color == 'Rød' ? 'selected' : ''}}>Rød</option>
                    </select>
                    <span class="u-t5">Oppvarmingskarakteren forteller om hvor stor andel av boligens oppvarming som gjøres med fossilt brensel og strøm. F.eks. blir karakteren mørkegrønn når andelen er under 30%, mens den blir rød når andelen er over 82,5%.</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12 input-toggle">
                    <input data-selector="" id="facilities-AIRCONDITIONING2" type="checkbox" value="AIRCONDITIONING2"
                           name="facilities2" {{$property_for_rent->facilities2 == 'AIRCONDITIONING2' ? 'checked' : ''}}>
                    <label class="smalltext" for="facilities-AIRCONDITIONING2"> Dyrehold tillatt </label>
                    <span class="error-span facilities-AIRCONDITIONING2"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Månedsleie</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" id="monthly_rent" name="monthly_rent" value="{{ $property_for_rent->monthly_rent }}" class="dme-form-control" placeholder="Kr.">
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
                    <input type="text" name="deposit" value="{{ $property_for_rent->deposit }}" class="dme-form-control" placeholder="Kr.">
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
                    <input type="text" name="include_in_rent" value="{{ $property_for_rent->include_in_rent }}"  class="dme-form-control"
                           placeholder="F.eks.: Strøm, kabeltv, bredbånd osv.">
                    <span class="error-span include_in_rent"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Leies ut fra</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" value="{{ $property_for_rent->rented_from }}" name="rented_from" class="dme-form-control date-picker">
                    <span class="error-span rented_from"></span>
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Leies ut til</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" value="{{ $property_for_rent->rented_to }}" name="rented_to" class="dme-form-control date-picker">
                    <span class="error-span rented_to"></span>
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Bilder (valgfritt)</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    @php $dropzone_img_obj = $property_for_rent; @endphp
                    @include('user-panel.partials.dropzone',compact('dropzone_img_obj'))
                    {{--                    <input type="file" name="commercial_plot_photos[]" value="{{ $commercial_plot->commercial_plot_photos }}" id="property_photos" class="" multiple>--}}
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Beskrivelse (valgfritt)</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="description" id="beskrivelse" cols="30" rows="10">{{ $property_for_rent->description }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="u-t5">Visningsdato (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="delivery_date[]" value="{{ $property_for_rent->delivery_date }}" class="dme-form-control date-picker">
                    <span class="u-t5">Dato (eks. 31.12.2017 eller 31/12/2017)</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Fra klokken (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="from_clock[]" value="{{ $property_for_rent->from_clock }}" placeholder="tt.mm" class="dme-form-control">
                    <span class="u-t5">Tid (eksempel 18:00)</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Til klokken (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="clockwise_clock[]" value="{{ $property_for_rent->clockwise_clock }}" placeholder="tt.mm" class="dme-form-control">
                    <span class="u-t5">Tid (eksempel 19:00)</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Merknad (valgfritt)</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" name="note[]" value="{{ $property_for_rent->note }}" placeholder="F.eks.: visning etter avtale"
                           class="dme-form-control">
                </div>
            </div>
        </div>
        <div id="add_more_viewing_times_fields">

        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <button type="button" id="add_more_viewing_times" class="dme-btn-outlined-blue">+ Visningstidspunt</button>
                </div>
            </div>
        </div>
        @if(Auth::user()->hasRole('company'))
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 pr-md-0">
                        <button type="button" id="add_more_viewing_times" class="dme-btn-outlined-blue add-ad-agent">+ Legg til en annen megler</button>
                    </div>
                </div>
            </div>
            @php
                $ad_agents = array();
                if($property_for_rent && $property_for_rent->ad && $property_for_rent->ad->agent && $property_for_rent->ad->agent->agent_details){
                    $ad_agents = json_decode($property_for_rent->ad->agent->agent_details);
                }
            @endphp

            @include('user-panel.partials.ad_agent_section')
        @endif

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
                <input id="published-on" name="published_on" type="checkbox" class="pub_validate" {{$property_for_rent->published_on ? 'checked' : ''}}>Ikke vis profilbilde og
 lenke til profilsiden
            </label><br>
            <span class="error-span published_on"></span>
        </div>
        <hr>
        <div class="ad-auto-saved-notice"></div>
        <div class="ad-published-notice"></div>
        <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" id="publiser_annonsen"
                class="dme-btn-outlined-blue mb-3 col-12 ladda-button"><span class="ladda-label"> @if(Request::is('new/property/rent/ad/*/edit')) {{'Oppdater annonsen'}} @else {{ 'Publiser annonsen!' }} @endif</span></button>
    </div>
</form>


