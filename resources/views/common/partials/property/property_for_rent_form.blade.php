<form action="#" method="post" id="property_for_rent_form" class="dropzone addMorePics p-0"
      data-action="@if(Request::is('new/property/rent/ad/*/edit')){{url('update-upload-images?ad_id='.$property_for_rent1->ad->id)}}
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
    @if(Request::is('new/property/rent/ad/*/edit'))
    @method('PATCH')
    @endif

    <input type="hidden" name="upload_dropzone_images_type" value="property_for_rent_temp_images">
    <div class="pl-3 pr-3">
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
                    <input type="text" name="zip_code" value="{{ $property_for_rent->zip_code }}" class="dme-form-control">
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
                        @if(Request::is('new/property/rent/ad/*/edit'))
                            <option value="{{ $property_for_rent->property_type }}">{{ $property_for_rent->property_type }}</option>
                        @endif
                            <option value="{{$type->name}}">{{$type->name}}</option>
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
                    <input type="text" name="number_of_bedrooms" value="{{ $property_for_rent->number_of_bedrooms }}" class="dme-form-control" placeholder="m²">
                    <span class="error-span number_of_bedrooms"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Etasje (valgfritt)</label>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" name="floor" value="{{ $property_for_rent->floor }}" class="dme-form-control" placeholder="m²">
                    <span class="error-span floor"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="u-t5">Møblering</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select id="furnishing" name="furnishing" class="dme-form-control">
                    @if(Request::is('new/property/rent/ad/*/edit'))
                        <option value="{{ $property_for_rent->furnishing }}">{{ $property_for_rent->floor }}</option>
                    @endif
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
                @foreach($facilities as $facility)
                    <div class="col-md-4 input-toggle">
                        <input id="{{$facility->name}}-{{$facility->id}}" type="checkbox" value="{{$facility->name}}"
                               name="facilities[]">
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
                    @if(Request::is('new/property/rent/ad/*/edit'))
                        <option value="{{ $property_for_rent->energy_label_class }}">{{ $property_for_rent->energy_label_class }}</option>
                    @endif
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
        <div class="form-group">
            <label class="u-t5">Oppvarmingskarakter (valgfritt)</label>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select id="energy_label.color" name="energy_label_color" data-selector="" class="dme-form-control">
                    @if(Request::is('new/property/rent/ad/*/edit'))
                        <option value="{{ $property_for_rent->energy_label_color }}">{{ $property_for_rent->energy_label_color }}</option>
                    @endif
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
                    <input type="text" name="monthly_rent" value="{{ $property_for_rent->monthly_rent }}" class="dme-form-control" placeholder="Kr.">
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
                    <input type="date" value="{{ $property_for_rent->rented_from }}" name="rented_from" class="dme-form-control">
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
                    <input type="date" value="{{ $property_for_rent->rented_to }}" name="rented_to" class="dme-form-control">
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
                    <input type="date" name="delivery_date[]" value="{{ $property_for_rent->delivery_date }}" class="dme-form-control">
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
                <input id="published-on" name="published_on" type="checkbox" class="pub_validate">Ikke vis profilbilde og
 lenke til profilsiden
            </label><br>
            <span class="error-span published_on"></span>
        </div>
        <hr>
        <div class="notice"></div>
        <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" id="publiser_annonsen"
                class="dme-btn-outlined-blue mb-3 col-12 ladda-button"><span class="ladda-label"> @if(Request::is('new/property/rent/ad/*/edit')) {{'oppdater tillegget ditt'}} @else {{ 'Publiser annonsen' }} @endif</span></button>
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

