<form action="#" method="post" id="commercial_plot_form" class="dropzone addMorePics p-0"
      data-action="@if(Request::is('commercial/plots/*/edit') || Request::is('complete/ad/*')){{url('update-upload-images?ad_id='.$commercial_plots->ad->id)}}
      @else {{route('upload-images')}} @endif" enctype="multipart/form-data" data-append_input = 'yes'>
@php

     $commercial_plot = new \App\CommercialPlot();
    if(isset($commercial_plots)){
        $commercial_plot = $commercial_plots;
    }

    $country = \App\Taxonomy::where('slug', 'country')->first();
    $countries = $country->terms;

   // $property_type = explode(',', $commercial_property_for_rent->property_type);
   // $facilities = explode(',', $commercial_property_for_rent->facilities);


@endphp
  @if(Request::is('commercial/plots/*/edit') || Request::is('complete/ad/*'))
  @method('PATCH')
  @endif
    <input type="hidden" id="old_zip" value="{{ (isset($commercial_plot->zip_code) ? $commercial_plot->zip_code : '') }}">
    <input type="hidden" name="upload_dropzone_images_type" value="commercial_plots_temp_images">
    <div class="pl-3">
        <!--                            radio -->
        <div class="form-group">
            <h3 class="u-t5">Annonsetype</h3>
            <div class="row pl-3">
                <div class="col-md-12 input-toggle">
                    <input class="checkmark" type="radio" value="Bortfeste" name="plot_type" id="type_boligtomt" @if(!$commercial_plot->plot_type) checked @endif {{ $commercial_plot->plot_type == "Bortfeste" ? "checked" : ''}}>
                    <label for="type_boligtomt" class="radio-lbl"> Salg</label>
                </div>
                <div class="col-md-12 input-toggle">
                    <input class="checkmark" type="radio" value="Salg" name="plot_type" id="type_fritidstomt" {{ $commercial_plot->plot_type == "Salg" ? "checked" : ''}}>
                    <label for="type_fritidstomt" class="radio-lbl"> Utleie</label>
                </div>
            </div>
        </div>
        <!--                            selection-->
        <div class="form-group">
            <h3 class="u-t5">Land</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select class="dme-form-control" id="country" name="country">
                        @foreach($countries as $ctry)
                        <option value="{{$ctry['name']}}"{{ ($commercial_plot->country == $ctry['name']) ? 'selected' : '' }}>{{$ctry['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Postnummerss</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="zip_code" type="text" value="{{ $commercial_plot->zip_code }}" class="dme-form-control zip_code">
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
                    <input name="street_address" value="{{ $commercial_plot->street_address }}" type="text" class="dme-form-control">
                </div>
            </div>
        </div>
        <!--                            text area-->
        <div class="form-group">
            <h3 class="u-t5">Beliggenhet (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="location_description" id="location_description" cols="30" rows="10">{{ $commercial_plot->location_description }}</textarea>
                    <span class="u-t5">Forklar kort om beliggenheten, omgivelsene, attraktive
                        naturforhold, betraktninger om lokaliseringsfordeler og
                        strøksattraktivitet</span>
                </div>
            </div>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Kommunenummer (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="municipal_number" value="{{ $commercial_plot->municipal_number }}" type="text" class="dme-form-control">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <span class="u-t5">Dette finner du på kartverkets hjemmeside</span>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Bruksnummer (Bnr)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="usage_number" value="{{ $commercial_plot->usage_number }}" type="text" class="dme-form-control">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <span class="u-t5">Dette finner du på kartverkets hjemmeside.</span>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Gårdsnummer (Gnr)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="farm_number" value="{{ $commercial_plot->farm_number }}" type="text" class="dme-form-control">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <span class="u-t5">Dette finner du på kartverkets hjemmeside.</span>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Tomteareal</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="plot_size" value="{{ $commercial_plot->plot_size }}" type="text" class="dme-form-control" placeholder="m²">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <span class="u-t5"></span>
        </div>
        <!--                            checkbox -->
        <div class="form-group">
            <div class="row">
                <div class="col-md-4 input-toggle">
                    <input id="facilities_road_access" type="checkbox" value="ROAD_ACCESS" name="owned_plot_facilities" {{ ($commercial_plot->owned_plot_facilities == 'ROAD_ACCESS' ? 'checked' : '') }}>
                    <label class="smalltext" for="facilities-ROAD_ACCESS"> Eiet tomt</label>
                </div>
            </div>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Prisantydning</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="asking_price" value="{{ $commercial_plot->asking_price }}" type="text" class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
            <span class="u-t5">Minstebeløpet du selger eiendommen for.</span>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Verditakst</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="verditakst" value="{{ $commercial_plot->verditakst }}" type="text" class="dme-form-control" placeholder="Kr.">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
   
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Visningsinformasjon (valgfritt)</h3>
            <div class="row">
                <div class="col-md-12 pr-md-0">
                    <input name="display_information" value="{{ $commercial_plot->display_information }}" type="text" class="dme-form-control" placeholder="">
                </div>
            </div>
        </div>
        <!--                            button-->
        <div class="form-group">
            <h3 class="u-t5">Legg til bilder (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    @php $dropzone_img_obj = $commercial_plot; @endphp
                    @include('user-panel.partials.dropzone',compact('dropzone_img_obj'))
                </div>
            </div>
        </div>


        <!-- Attachement as pdf files -->
        <div wt-paste="attachment-as-pdf">
            <div class="form-group">
                <h3 class="u-t5">Legg till pdf</h3>
                @if($commercial_plot && $commercial_plot->ad && $commercial_plot->ad->pdf->count() > 0)
                    @foreach($commercial_plot->ad->pdf as $key=>$commercial_plot_pdf_file)
                        <div class="show-file-section">
                            <div class="row">
                                <p class="col-sm-4">{{($commercial_plot_pdf_file->name)}}</p>
                                <p class="col-sm-2"><a href="javascript:void(0)" class="dz-remove" id="{{$commercial_plot_pdf_file->name_unique}}">Fjerne</a></p>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-sm-4 ">
                        <input type="file" name="commercial_plot_pdf[]" id="commercial_plot_pdf" accept="application/pdf">
                    </div>
                    <div class="col-sm-2">
                        <button class="dme-btn-outlined-blue" type="button" wt-more="attachment-as-pdf"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!--                            full input-->
        <div class="form-group">
            <h3 class="u-t5">Annonseoverskrift</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="headline" value="{{ $commercial_plot->headline }}" type="text" class="dme-form-control">
                </div>
            </div>
        </div>
        <!--                            text area-->
        <div class="form-group">
            <h3 class="u-t5">Beskrivelse (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="description" id="description" cols="30" rows="10">{{ $commercial_plot->description }}</textarea>
                    <span class="u-t5">Fortell gjerne litt om nabolaget og nærhet til
                        transport.</span>
                </div>
            </div>
        </div>
        <!--                            full input-->
        <div class="form-group">
            <h3 class="u-t5">Tekst på lenke</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="link" type="text" value="{{ $commercial_plot->link }}" class="dme-form-control">
                </div>
            </div>
        </div>
        <!--                            full input-->
        <div class="form-group">
            <h3 class="u-t5">Lenke for mer informasjon</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="text_for_information" value="{{ $commercial_plot->text_for_information }}" type="text" class="dme-form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Telefon (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="phone" value="{{ $commercial_plot->phone }}" id="phone" type="tel" class="dme-form-control">
                     <span id="valid-msg" class="hide"></span>
                    <span id="error-msg" class="hide"></span>
                </div>
                <div class="col-md-8"></div>
            </div>
            <br>
        </div>
        <div class="form-group">
            <h3 class="u-t5">Kontaktperson</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="contact" value="{{ $commercial_plot->contact }}" type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
            </div>
            <br>
        </div>
        <div class="form-group">
            <h3 class="u-t5">E-post</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="e_post" value="{{ $commercial_plot->e_post }}" type="text" class="dme-form-control">
                </div>
                <div class="col-md-8"></div>
            </div>
            <br>
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
                <p>Hvis denne profilen ikke er riktig kan du endre den under min handel deretter endre
                    profil.</p>
            </div>
        </div>

        <div class="form-group ">
            <h3 class="u-t5">Publisert</h3>
            <label class="mb-2 form-check-label" for="published-on">
                <input id="published-on" name="published_on" type="checkbox">Ikke vis profilbilde og
                lenke til profilsiden
            </label>
        </div>

        <hr>
        <div class="notice"></div>
        <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" id="publiserannonsen"
            class="dme-btn-outlined-blue mb-3 col-12 ladda-button">
            <span class="ladda-label">@if(Request::is('commercial/plots/*/edit')) {{'Oppdater annonsen'}} @else {{ 'Publiser annonsen!' }} @endif</span>
        </button>
        <!-- <input type="button" id="publiserannonsen" class="dme-btn-outlined-blue mb-3 col-12" value="Publiser annonsen!!"> -->
    </div>
</form>

