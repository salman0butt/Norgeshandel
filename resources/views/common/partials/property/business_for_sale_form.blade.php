<form action="#" method="post" id="business_for_sale" class="dropzone addMorePics p-0"
      data-action="@if(Request::is('add/business/for/sale/*/edit')){{url('update-upload-images?ad_id='.$business_for_sale->ad->id)}}
      @else {{route('upload-images')}} @endif" enctype="multipart/form-data" data-append_input = 'yes'>

    @php
        $business_for_sale_obj = new \App\BusinessForSale();
       if(isset($business_for_sale)){
           $business_for_sale_obj = $business_for_sale;
       }
       $country = \App\Taxonomy::where('slug', 'country')->first();
       $countries = $country->terms;
      // $property_type = explode(',', $commercial_property_for_rent->property_type);
      // $facilities = explode(',', $commercial_property_for_rent->facilities);
    @endphp

    @if(Request::is('add/business/for/sale/*/edit'))
        @method('PATCH')
    @endif
    <div class="pl-3">
        <input type="hidden" name="upload_dropzone_images_type" value="business_for_sale_temp_images">
        <!--                            selection-->
        <div class="form-group">
            <h3 class="u-t5">Bransje</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select name="industry" class="dme-form-control">
                        <option value=""></option>
                        <option value="Agentur" {{$business_for_sale_obj->industry == 'Agentur' ? 'selected' : ''}}>Agentur</option>
                        <option value="Annet" {{$business_for_sale_obj->industry == 'Annet' ? 'selected' : ''}}>Annet</option>
                        <option value="Butikk/Kiosk" {{$business_for_sale_obj->industry == 'Butikk/Kiosk' ? 'selected' : ''}}>Butikk/Kiosk</option>
                        <option value="Frisør/Velvære" {{$business_for_sale_obj->industry == 'Frisør/Velvære' ? 'selected' : ''}}>Frisør/Velvære</option>
                        <option value="Hotell/Overnatting" {{$business_for_sale_obj->industry == 'Hotell/Overnatting' ? 'selected' : ''}}>Hotell/Overnatting</option>
                        <option value="Jordbruk/Skogbruk/Fiske" {{$business_for_sale_obj->industry == 'Jordbruk/Skogbruk/Fiske' ? 'selected' : ''}}>Jordbruk/Skogbruk/Fiske</option>
                        <option value="Nettbutikk/Nettsted" {{$business_for_sale_obj->industry == 'Nettbutikk/Nettsted' ? 'selected' : ''}}>Nettbutikk/Nettsted</option>
                        <option value="Restaurant/Kafé" {{$business_for_sale_obj->industry == 'Restaurant/Kafé' ? 'selected' : ''}}>Restaurant/Kafé</option>
                    </select>
                </div>
            </div>
        </div>
        <!--                            selection-->
        <div class="form-group">
            <h3 class="u-t5">Legg til en alternativ bransje (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select name="alternative_industry" class="dme-form-control">
                        <option value=""></option>
                        <option value="Agentur" {{$business_for_sale_obj->alternative_industry == 'Agentur' ? 'selected' : ''}}>Agentur</option>
                        <option value="Annet" {{$business_for_sale_obj->alternative_industry == 'Annet' ? 'selected' : ''}}>Annet</option>
                        <option value="Butikk/Kiosk" {{$business_for_sale_obj->alternative_industry == 'Butikk/Kiosk' ? 'selected' : ''}}>Butikk/Kiosk</option>
                        <option value="Frisør/Velvære" {{$business_for_sale_obj->alternative_industry == 'Frisør/Velvære' ? 'selected' : ''}}>Frisør/Velvære</option>
                        <option value="Hotell/Overnatting" {{$business_for_sale_obj->alternative_industry == 'Hotell/Overnatting' ? 'selected' : ''}}>Hotell/Overnatting</option>
                        <option value="Jordbruk/Skogbruk/Fiske" {{$business_for_sale_obj->alternative_industry == 'Jordbruk/Skogbruk/Fiske' ? 'selected' : ''}}>Jordbruk/Skogbruk/Fiske</option>
                        <option value="Nettbutikk/Nettsted" {{$business_for_sale_obj->alternative_industry == 'Nettbutikk/Nettsted' ? 'selected' : ''}}>Nettbutikk/Nettsted</option>
                        <option value="Restaurant/Kafé" {{$business_for_sale_obj->alternative_industry == 'Restaurant/Kafé' ? 'selected' : ''}}>Restaurant/Kafé</option>
                    </select>
                </div>
            </div>
        </div>
        <!--                            selection-->
        <div class="form-group">
            <h3 class="u-t5">Land</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <select class="dme-form-control" id="country_code" name="country">
                        @foreach($countries as $ctry)
                            <option value="{{$ctry['name']}}"{{ ($business_for_sale_obj->country == $ctry['name']) ? 'selected' : '' }}>{{$ctry['name']}}</option>
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
                    <input name="zip_code" type="text" class="dme-form-control zip_code" value="{{$business_for_sale_obj->zip_code}}">
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
                    <input name="street_address" type="text" class="dme-form-control" value="{{$business_for_sale_obj->street_address}}">
                </div>
            </div>
        </div>
        <!--                            full input-->
        <div class="form-group">
            <h3 class="u-t5">Navn på selskapet (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="company_name" type="text" class="dme-form-control" value="{{$business_for_sale_obj->company_name}}">
                </div>
            </div>
        </div>
        <!--                            full input-->
        <div class="form-group">
            <h3 class="u-t5">Organisasjonsnummer (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="organiztion_number" type="text" class="dme-form-control" value="{{$business_for_sale_obj->organiztion_number}}">
                </div>
            </div>
        </div>
        <!--                            small input-->
        <div class="form-group">
            <h3 class="u-t5">Pris (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="price" type="text" class="dme-form-control" value="{{$business_for_sale_obj->price}}">
                </div>
                <div class="col-sm-8">
                </div>
            </div>
           
        </div>
        <!--                            button-->
        <div class="form-group">
            <h3 class="u-t5">Legg til bilder (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    @php $dropzone_img_obj = $business_for_sale_obj ; @endphp
                    @include('user-panel.partials.dropzone',compact('dropzone_img_obj'))
                </div>
            </div>
        </div>

        <!-- Attachement as pdf files -->
        <div wt-paste="attachment-as-pdf">
            <div class="form-group">
                <h3 class="u-t5">Legg till pdf</h3>
                @if($business_for_sale_obj && $business_for_sale_obj->ad && $business_for_sale_obj->ad->pdf->count() > 0)
                    @foreach($business_for_sale_obj->ad->pdf as $key=>$business_for_sale_obj_pdf_file)
                        <div class="show-file-section">
                            <div class="row">
                                <p class="col-sm-4">{{($business_for_sale_obj_pdf_file->name)}}</p>
                                <p class="col-sm-2"><a href="javascript:void(0)" class="dz-remove" id="{{$business_for_sale_obj_pdf_file->name_unique}}">Fjerne</a></p>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-sm-4 ">
                        <input type="file" name="business_for_sale_pdf[]" id="business_for_sale_pdf" accept="application/pdf">
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
                    <input name="headline" type="text" class="dme-form-control" value="{{$business_for_sale_obj->headline}}">
                </div>
            </div>
        </div>
        <!--                            text area-->
        <div class="form-group">
            <h3 class="u-t5">Beskrivelse (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <textarea name="description" id="beskrivelse" cols="30" rows="10">{{$business_for_sale_obj->description}}</textarea>
                    <span class="u-t5">Fortell gjerne litt om nabolaget og nærhet til transport.</span>
                </div>
            </div>
        </div>
        <!--                            full input-->
        <div class="form-group">
            <h3 class="u-t5">Tekst på lenke (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="link" type="text" class="dme-form-control" value="{{$business_for_sale_obj->link}}">
                </div>
            </div>
        </div>
        <!--                            full input-->
        <div class="form-group">
            <h3 class="u-t5">Lenke for mer informasjon (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-12 pr-md-0">
                    <input name="link_for_information" type="text" class="dme-form-control" value="{{$business_for_sale_obj->link_for_information}}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <h3 class="u-t5">Telefon (valgfritt)</h3>
            <div class="row">
                <div class="col-sm-4 pr-md-0">
                    <input name="phone" type="text" class="dme-form-control" value="{{$business_for_sale_obj->phone}}">
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
                <input id="published-on" name="published_on" type="checkbox">Ikke vis profilbilde og
    lenke til profilsiden</label>
        </div>

        <hr>

            <div class="notice"></div>
            <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" id="publiser_annonsen"
            class="dme-btn-outlined-blue mb-3 col-12 ladda-button"><span class="ladda-label">Publiser annonsen!</span></button>


    </div>
</form>