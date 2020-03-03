<form action="#" method="post" id="flat_wishes_rented_form" class="dropzone addMorePics p-0"
      data-action="@if(Request::is('new/flat/wishes/rented/*/edit')){{url('update-upload-images?ad_id='.$flat_wishes_rented1->ad->id)}}
      @else {{route('upload-images')}} @endif" enctype="multipart/form-data" data-append_input = 'yes'>
@php
     $flat_wishes_rented = new \App\FlatWishesRented();
    if(isset($flat_wishes_rented1)){
        $flat_wishes_rented = $flat_wishes_rented1;
    }

    $country = \App\Taxonomy::where('slug', 'country')->first();
    $countries = $country->terms;

    $property_type = explode(',', $flat_wishes_rented->property_type);
    $region = explode(',', $flat_wishes_rented->region);


@endphp
    @if(Request::is('new/flat/wishes/rented/*/edit'))
    @method('PATCH')
    @endif
    <input type="hidden" name="upload_dropzone_images_type" value="flat_wishes_rented_temp_images">
    <div class="pl-3">
        <div class="form-group">
            <h3 class="u-t5">Ønsket leieområde</h3>
            <div class="row">
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="akershus" name="region[]" id="region-akershus" {{ (in_array("akershus", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-akershus" data-has-area-subarea="true">Akershus</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="aust-agder" name="region[]" id="region-aust-agder" {{ (in_array("aust-agder", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-aust-agder" data-has-area-subarea="true">Aust-Agder</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="bergen" name="region[]" id="region-bergen" {{ (in_array("bergen", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-bergen"
                           data-has-area-subarea="true">Bergen</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="bodø" name="region[]" id="region-bodø" {{ (in_array("bodø", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-bodø"
                           data-has-area-subarea="false">Bodø</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="buskerud" name="region[]" id="region-buskerud" {{ (in_array("buskerud", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-buskerud" data-has-area-subarea="true">Buskerud</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="finnmark" name="region[]" id="region-finnmark" {{ (in_array("finnmark", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-finnmark" data-has-area-subarea="true">Finnmark</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="hedmark" name="region[]" id="region-hedmark" {{ (in_array("hedmark", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-hedmark" data-has-area-subarea="true">Hedmark</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="hordaland" name="region[]" id="region-hordaland" {{ (in_array("hordaland", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-hordaland" data-has-area-subarea="true">Hordaland</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="kristiansand" name="region[]"
                           id="region-kristiansand" {{ (in_array("kristiansand", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-kristiansand" data-has-area-subarea="true">Kristiansand</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="møre og romsdal" name="region[]"
                           id="region-møre og romsdal" {{ (in_array("møre og romsdal", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-møre og romsdal"
                           data-has-area-subarea="true">Møre og Romsdal</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="nordland" name="region[]" id="region-nordland" {{ (in_array("nordland", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-nordland" data-has-area-subarea="true">Nordland</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="oppland" name="region[]" id="region-oppland" {{ (in_array("oppland", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-oppland" data-has-area-subarea="true">Oppland</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="oslo" name="region[]" id="region-oslo" {{ (in_array("oslo", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-oslo"
                           data-has-area-subarea="true">Oslo</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="rogaland" name="region[]" id="region-rogaland" {{ (in_array("rogaland", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-rogaland" data-has-area-subarea="true">Rogaland</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="sogn og fjordane" name="region[]"
                           id="region-sogn og fjordane" {{ (in_array("sogn og fjordane", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-sogn og fjordane"
                           data-has-area-subarea="true">Sogn og Fjordane</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="stavanger" name="region[]" id="region-stavanger" {{ (in_array("stavanger", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-stavanger" data-has-area-subarea="true">Stavanger</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="svalbard" name="region[]" id="region-svalbard" {{ (in_array("svalbard", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-svalbard" data-has-area-subarea="true">Svalbard</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="telemark" name="region[]" id="region-telemark" {{ (in_array("telemark", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-telemark" data-has-area-subarea="true">Telemark</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="troms" name="region[]" id="region-troms" {{ (in_array("troms", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-troms"
                           data-has-area-subarea="true">Troms</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="tromsø" name="region[]" id="region-tromsø" {{ (in_array("tromsø", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-tromsø" data-has-area-subarea="false">Tromsø</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="trondheim" name="region[]" id="region-trondheim" {{ (in_array("trondheim", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-trondheim" data-has-area-subarea="true">Trondheim</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="trøndelag" name="region[]" id="region-trøndelag" {{ (in_array("trøndelag", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-trøndelag" data-has-area-subarea="true">Trøndelag</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="vest-agder" name="region[]" id="region-vest-agder" {{ (in_array("vest-agder", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-vest-agder" data-has-area-subarea="true">Vest-Agder</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="vestfold" name="region[]" id="region-vestfold" {{ (in_array("vestfold", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-vestfold" data-has-area-subarea="true">Vestfold</label>
                </div>
                <div class="input-toggle col-md-4">
                    <input type="checkbox" value="østfold" name="region[]" id="region-østfold" {{ (in_array("østfold", $region) ? "checked" : "") }}>
                    <label class="smalltext" for="region-østfold" data-has-area-subarea="true">Østfold</label>
                </div>
            </div>
        </div>   
        <div class="form-group">
            <h3 class="u-t5">Ønsket boligtype</h3>
            <div class="row">
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-FLAT" type="checkbox" value="Leilighet" name="property_type[]" {{ (in_array("Leilighet", $property_type) ? "checked" : "") }}>
                    <label class="smalltext" for="property_type-FLAT"> Leilighet</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-DETACHED" type="checkbox" value="Enebolig"
                           name="property_type[]" {{ (in_array("Enebolig", $property_type) ? "checked" : "") }}>
                    <label class="smalltext" for="property_type-DETACHED"> Enebolig</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-TERRACED" type="checkbox" value="Rekkehus"
                           name="property_type[]" {{ (in_array("Rekkehus", $property_type) ? "checked" : "") }}>
                    <label class="smalltext" for="property_type-TERRACED"> Rekkehus</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-SEMIDETACHED" type="checkbox" value="Tomannsbolig"
                           name="property_type[]" {{ (in_array("Tomannsbolig", $property_type) ? "checked" : "") }}>
                    <label class="smalltext" for="property_type-SEMIDETACHED"> Tomannsbolig</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-BEDSIT" type="checkbox" value="Hybel"
                           name="property_type[]" {{ (in_array("Hybel", $property_type) ? "checked" : "") }}>
                    <label class="smalltext" for="property_type-BEDSIT"> Hybel</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-HOUSESHARE" type="checkbox" value="Rom i bofellesskap"
                           name="property_type[]" {{ (in_array("Rom i bofellesskap", $property_type) ? "checked" : "") }}>
                    <label class="smalltext" for="property_type-HOUSESHARE"> Rom i bofellesskap</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-GARAGE" type="checkbox" value="Garasje Parkering"
                           name="property_type[]" {{ (in_array("Garasje Parkering", $property_type) ? "checked" : "") }}>
                    <label class="smalltext" for="property_type-GARAGE"> Garasje/Parkering</label>
                </div>
                <div class="col-md-4 input-toggle">
                    <input data-selector="" id="property_type-OTHER" type="checkbox" value="Andre"
                           name="property_type[]" {{ (in_array("Andre", $property_type) ? "checked" : "") }}>
                    <label class="smalltext" for="property_type-OTHER"> Andre</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Antall leietagere (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" value="{{ $flat_wishes_rented->number_of_tenants }}" name="number_of_tenants" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Møblert (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select class="dme-form-control" id="property_details.furnishing" name="furnishing">
                        <option value=""></option>
                        <option value="Delvis møblert" {{$flat_wishes_rented->furnishing == "Delvis møblert" ? "selected" : ""}}>Delvis møblert</option>
                        <option value="Møblert" {{$flat_wishes_rented->furnishing == "Møblert" ? "selected" : ""}}>Møblert</option>
                        <option value="Umøblert" {{$flat_wishes_rented->furnishing == "Umøblert" ? "selected" : ""}}>Umøblert</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Ønskes fra dato (valgfritt)</h3>
            <div class="row">
                <div class="col-md-4 pr-md-0">
                    <input type="date" value="{{ $flat_wishes_rented->wanted_from }}" name="wanted_from" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
                <div class="col-md-12 text-muted">Dato (eks. 31.12.2018 eller 31/12/2018)</div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Maks leiepris per måned (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="text" value="{{ $flat_wishes_rented->max_rent_per_month }}" name="max_rent_per_month" class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-md-8"></div>
                <br>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Bilder (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                @php $dropzone_img_obj = $flat_wishes_rented; @endphp
                @include('user-panel.partials.dropzone',compact('dropzone_img_obj'))

                    <!-- <button class="dme-btn-outlined-blue">Legg til bilder</button> -->
                    {{--<input type="file" name="flat_wishes_rented[]" id="flat_wishes_rented" class="" multiple>--}}
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Annonseoverskrift</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input type="text" value="{{ $flat_wishes_rented->headline }}"  name="headline" class="dme-form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Beskrivelse (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="description" id="beskrivelse" cols="30" rows="10">{{ $flat_wishes_rented->description }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Telefon (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input type="tel" value="{{ $flat_wishes_rented->phone }}"  name="phone" id="phone" class="dme-form-control">
                    <span id="valid-msg" class="hide"></span>
                    <span id="error-msg" class="hide"></span>
                </div>
                <div class="col-sm-8">
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
        </div>

        <hr>
        <div class="notice"></div>
        <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" id="publiserannonsen"
                class="dme-btn-outlined-blue mb-3 col-12 ladda-button"><span class="ladda-label">Publiser annonsen!</span></button>
    </div>
</form>


