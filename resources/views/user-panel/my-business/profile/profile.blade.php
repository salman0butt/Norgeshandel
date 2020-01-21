@extends('layouts.landingSite')
<?php $countries = countries(); ?>
@section('page_content')
    <main class="profile">
        <div class="dme-container">
            <div class="breade-crumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('my-business')}}">Min handel </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Endre profil</li>
                    </ol>
                </nav>
            </div>            <!---- end breadcrumb----->

            @include('common.partials.flash-messages')
                        @if($user->roles->first()->name=="company")
            <div class="alert alert-info">
                For øyeblikket har du {{$user->allowed_job_companies->first()->value}} stillingsgrenser
                og {{$user->allowed_property_companies->first()->value}} eiendomsgrenser.
                <a href="{{url('my-business/profile/select_company_profile_type')}}">Be om mer grense.</a>
            </div>

            @if($user->allowed_companies>0 && $user->allowed_companies>count($user->companies))
                <div class="company-profile">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn dme-btn-outlined-blue" data-toggle="collapse"
                                    data-target="#company_profile_block">Rediger bedriftsprofilen din
                            </button>
                        </div>
                    </div>
                    <div class="row collapse" id="company_profile_block">
                        <div class="col-md-12">
                            <form action="{{route('company.store')}}" id="form_company_profile" method="POST"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <h4 class="text-muted pt-2">Bedriftsprofilen</h4>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="emp_name" class="col-md-2 u-t5">Arbeidsgiver</label>
                                        <div class="col-sm-10 ">
                                            <input name="emp_name" value="" id="emp_name" type="text"
                                                   class="form-control dme-form-control" required="">
                                        </div>
                                    </div>
                                </div>
                                {{--                                @dd($user->allowed_job_companies->first()->value)--}}
                                <div class="form-group">
                                    <div class="row">
                                        <label for="company_type" class="col-md-2 u-t5">Velg selskapets formål</label>
                                        <div class="col-sm-10 ">
                                            <select name="company_type" id="company_type" type="text"
                                                    class="form-control dme-form-control" required="">
                                                <option value="">Velg...</option>
                                                @if(count($user->job_companies)<$user->allowed_job_companies->first()->value)
                                                    <option value="job">Jobb</option>
                                                @else
                                                    <option value="" disabled>Jobb (Grensen overskredet)</option>
                                                @endif
                                                @if(count($user->property_companies)<$user->allowed_property_companies->first()->value)
                                                    <option value="property">property</option>
                                                @else
                                                    <option value="" disabled>Eiendom (Grensen overskredet)</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="emp_company_information" class="col-md-2 u-t5">Firmainformasjon
                                            (valgfritt)</label>
                                        <div class="col-sm-10 ">
                                            <textarea name="emp_company_information"
                                                      class="form-control dme-form-control emp_company_information"
                                                      id="emp_company_information" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="emp_website" class="col-md-2 u-t5">Nettsted (valgfritt)</label>
                                        <div class="col-sm-10 ">
                                            <input name="emp_website" value="" id="emp_website" type="text"
                                                   class="form-control dme-form-control" placeholder="firmanavn.no"
                                                   required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="emp_facebook" class="col-md-2 u-t5">Arbeidsgiver på Facebook
                                            (valgfritt)</label>
                                        <div class="col-sm-10 ">
                                            <input name="emp_facebook" value="" id="emp_facebook" type="text"
                                                   class="form-control dme-form-control"
                                                   placeholder="facebook.com/firmanavn">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="emp_linkedin" class="col-md-2 u-t5">Arbeidsgiver på LinkedIn
                                            (valgfritt)</label>
                                        <div class="col-sm-10 ">
                                            <input name="emp_linkedin" value="" id="emp_linkedin" type="text"
                                                   class="form-control dme-form-control"
                                                   placeholder="linkedin.com/company/firmanavn">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="emp_twitter" class="col-md-2 u-t5">Arbeidsgiver på Twitter
                                            (valgfritt)</label>
                                        <div class="col-sm-10 ">
                                            <input name="emp_twitter" value="" id="emp_twitter" type="text"
                                                   class="form-control dme-form-control" placeholder="@firmanavn">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="emp_country" class="col-md-2 u-t5">Country</label>
                                        <div class="col-sm-4 ">
                                            <select class="form-control dme-form-control" id="emp_country"
                                                    name="country">
                                                @if(!empty($company->country))
                                                    <option selected
                                                            value="{{$company->country}}">{{$company->country}}</option>
                                                @endif
                                                @foreach($countries as $ctry)
                                                    <option value="{{$ctry['name']}}"
                                                            @if($ctry['name']=="Norway") selected @endif>{{$ctry['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="emp_zip" class="col-md-2 u-t5">post kode</label>
                                        <div class="col-sm-4 ">
                                            <input name="zip" id="emp_zip" value="" type="text"
                                                   class="form-control dme-form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="address" class="col-md-2 u-t5">Gateadresse (valgfritt)</label>
                                        <div class="col-sm-10 ">
                                            <input name="address" id="address" type="text"
                                                   class="form-control dme-form-control" required="">
                                            <span class="u-t5">Forklar kort om tilgangen til boligen og hvordan du finner den, vennligst fortell om nærhet til vei, buss og tog.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="job_gallery" class="col-md-2 u-t5">Bedriftslogo (valgfritt)</label>
                                        <div class="col-sm-4 ">

                                            <input type="file" name="company_logo" id="company_logo" class=""
                                                   value="Select logo">
                                        </div>
                                        <label for="job_gallery" class="col-md-2 u-t5">Bilder fra arbeidsplassen
                                            (valgfritt)</label>
                                        <div class="col-sm-4 ">
                                            <input type="file" name="company_gallery[]" id="job_gallery" class=""
                                                   multiple="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label for="workplace_video" class="col-md-2 u-t5">Arbeidsplassvideo
                                            (valgfritt)</label>
                                        <div class="col-sm-10 ">
                                            <input name="workplace_video" id="workplace_video" type="text"
                                                   class="form-control dme-form-control">
                                            <span class="u-t5">For eksempel - youtube.com/watch?v=3C4W5zadc4g</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <button type="button" class="dme-btn-outlined-blue" data-toggle="collapse"
                                                    data-target="#company_profile_block">Avbryt
                                            </button>
                                            <button type="submit" class="dme-btn-outlined-blue">Submit</button>
                                        </div>
                                        <div class="col-md-6 offset-md-3">
                                            <hr class="p-0 mb-0">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            <?php $user_companies = $user->companies; ?>
            <div class="existing_companies">
                @foreach($user_companies as $company)
                    <div class="row m-0 pt-4">
                        <div class="col-md-12 radius-8 bg-light p-3">
                            <div class="row">
                                <div class="col-md-1">
                                    @if(is_countable($company->company_logo) && count($company->company_logo)>0)
                                        <img
                                            src="{{\App\Helpers\common::getMediaPath($company->company_logo->first())}}"
                                            style="max-height: 50px;" alt="">
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <div>
                                        <div class="font-weight-bold float-left" style="min-width: 120px;">Firmanavn:
                                        </div>
                                        <div>{{$company->emp_name}} <span class="small text-muted">(kategori: {{$company->company_type}})</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-weight-bold float-left" style="min-width: 120px;">Nettsted:
                                        </div>
                                        <div>{{$company->emp_website}}</div>
                                    </div>
                                    <div>
                                        <div class="font-weight-bold float-left" style="min-width: 120px;">Land:</div>
                                        <div>{{$company->country}}</div>
                                    </div>
                                </div>
                                <div class="col-md-2" style="font-size: 20px">
                                    <form class="float-right" action="{{route('company.destroy', compact('company'))}}"
                                          method="POST"
                                          onsubmit="jarascript:return confirm('Vil du slette denne firmaprofilen?')">
                                        {{method_field('DELETE')}}
                                        {{csrf_field()}}
                                        <button type="submit" class="link pl-3">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    <a class="float-right" data-toggle="collapse" href="#edit_company_{{$company->id}}"
                                       role="button" aria-expanded="false"
                                       aria-controls="edit_company_{{$company->id}}">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="row collapse" id="edit_company_{{$company->id}}">
                                <div class="col-md-12">
                                    <form action="{{route('company.update', compact('company'))}}"
                                          id="form_company_profile_edit_{{$company->id}}" method="POST"
                                          enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        {{method_field('PUT')}}
                                        <h4 class="text-muted pt-2">Bedriftsprofilen</h4>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="emp_name_{{$company->id}}" class="col-md-2 u-t5">Arbeidsgiver</label>
                                                <div class="col-sm-10 ">
                                                    <input name="emp_name" value="{{$company->emp_name}}"
                                                           id="emp_name_{{$company->id}}" type="text"
                                                           class="form-control dme-form-control" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="emp_company_information_{{$company->id}}"
                                                       class="col-md-2 u-t5">Firmainformasjon
                                                    (valgfritt)</label>
                                                <div class="col-sm-10 ">
                                            <textarea name="emp_company_information"
                                                      class="form-control dme-form-control emp_company_information"
                                                      id="emp_company_information_{{$company->id}}" cols="30"
                                                      rows="10">{{$company->emp_company_information}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="emp_website_{{$company->id}}" class="col-md-2 u-t5">Nettsted
                                                    (valgfritt)</label>
                                                <div class="col-sm-10 ">
                                                    <input name="emp_website" value="{{$company->emp_website}}"
                                                           id="emp_website_{{$company->id}}" type="text"
                                                           class="form-control dme-form-control"
                                                           placeholder="firmanavn.no"
                                                           required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="emp_facebook_{{$company->id}}" class="col-md-2 u-t5">Arbeidsgiver
                                                    på Facebook
                                                    (valgfritt)</label>
                                                <div class="col-sm-10 ">
                                                    <input name="emp_facebook" value="{{$company->emp_facebook}}"
                                                           id="emp_facebook_{{$company->id}}" type="text"
                                                           class="form-control dme-form-control"
                                                           placeholder="facebook.com/firmanavn">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="emp_linkedin_{{$company->id}}" class="col-md-2 u-t5">Arbeidsgiver
                                                    på LinkedIn
                                                    (valgfritt)</label>
                                                <div class="col-sm-10 ">
                                                    <input name="emp_linkedin" value="{{$company->emp_linkedin}}"
                                                           id="emp_linkedin_{{$company->id}}" type="text"
                                                           class="form-control dme-form-control"
                                                           placeholder="linkedin.com/company/firmanavn">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="emp_twitter_{{$company->id}}" class="col-md-2 u-t5">Arbeidsgiver
                                                    på Twitter
                                                    (valgfritt)</label>
                                                <div class="col-sm-10 ">
                                                    <input name="emp_twitter" value="{{$company->emp_twitter}}"
                                                           id="emp_twitter_{{$company->id}}" type="text"
                                                           class="form-control dme-form-control"
                                                           placeholder="@firmanavn">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="country_{{$company->id}}"
                                                       class="col-md-2 u-t5">Country</label>
                                                <div class="col-sm-4 ">
                                                    <select class="form-control dme-form-control"
                                                            id="country_{{$company->id}}"
                                                            name="country">
                                                        @foreach($countries as $ctry)
                                                            <option value="{{$ctry['name']}}"
                                                                    @if($ctry['name']=="Norway") selected @endif>{{$ctry['name']}}</option>
                                                        @endforeach
                                                        @if(!empty($company->country))
                                                            <option selected
                                                                    value="{{$company->country}}">{{$company->country}}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <label for="zip_{{$company->id}}" class="col-md-2 u-t5">post
                                                    kode</label>
                                                <div class="col-sm-4 ">
                                                    <input name="zip" id="zip_{{$company->id}}"
                                                           value="{{$company->zip}}" type="text"
                                                           class="form-control dme-form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="address_{{$company->id}}" class="col-md-2 u-t5">Gateadresse
                                                    (valgfritt)</label>
                                                <div class="col-sm-10 ">
                                                    <input name="address" id="address_{{$company->id}}" type="text"
                                                           class="form-control dme-form-control"
                                                           value="{{$company->address}}" required="">
                                                    <span class="u-t5">Forklar kort om tilgangen til boligen og hvordan du finner den, vennligst fortell om nærhet til vei, buss og tog.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="job_gallery_{{$company->id}}" class="col-md-2 u-t5">Bedriftslogo
                                                    (valgfritt)</label>
                                                <div class="col-sm-4 ">
                                                    <input type="file" name="company_logo"
                                                           id="company_logo_{{$company->id}}" class=""
                                                           value="Select logo">
                                                    @if(is_countable($company->company_logo) && count($company->company_logo)>0)
                                                        <img
                                                            src="{{\App\Helpers\common::getMediaPath($company->company_logo->first())}}"
                                                            style="max-width: 100px;" alt="">
                                                    @endif
                                                </div>
                                                <label for="job_gallery_{{$company->id}}" class="col-md-2 u-t5">Bilder
                                                    fra arbeidsplassen
                                                    (valgfritt)</label>
                                                <div class="col-sm-4 ">
                                                    <input type="file" name="company_gallery[]"
                                                           id="job_gallery_{{$company->id}}"
                                                           class=""
                                                           multiple="">
                                                    @if(is_countable($company->company_gallery) && count($company->company_gallery)>0)
                                                        @foreach($company->company_gallery as $img)
                                                            <img
                                                                src="{{\App\Helpers\common::getMediaPath($img)}}"
                                                                style="max-width: 75px;" alt="" class="img-thumbnail">
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="workplace_video_{{$company->id}}" class="col-md-2 u-t5">Arbeidsplassvideo
                                                    (valgfritt)</label>
                                                <div class="col-sm-10 ">
                                                    <input name="workplace_video" value="{{$company->workplace_video}}"
                                                           id="workplace_video_{{$company->id}}" type="text"
                                                           class="form-control dme-form-control">
                                                    <span
                                                        class="u-t5">For eksempel - youtube.com/watch?v=3C4W5zadc4g</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <button type="button" class="dme-btn-outlined-blue"
                                                            data-toggle="collapse"
                                                            data-target="#edit_company_{{$company->id}}">Avbryt
                                                    </button>
                                                    <button type="submit" class="dme-btn-outlined-blue">Submit</button>
                                                </div>
                                                <div class="col-md-6 offset-md-3">
                                                    <hr class="p-0 mb-0">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
                        @endif
            <div class="profile ">
                <div class="row">
                    <div class="col-md-6 mt-4 ">
                        <div class="inner-profile-section p-4 bg-light ">
                            <form action="{{route('users.update', $user->id)}}" enctype="multipart/form-data"
                                  method="post">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <h3 class="font-weight-normal">Din profil</h3>
                                <div class="img-btn mb-4">
                                    <div class="chip text-center">
                                        <div class="profile"
                                             style="padding: 10px; background: #fdfdfd; border: 2px dashed #ddd;max-width: 205px; margin:auto">
                                            <img
                                                src="@if(isset($user) && $user->media!=null){{asset(\App\Helpers\common::getMediaPath($user->media, '180x200'))}}@else {{asset('public/admin/images/users/1.jpg')}} @endif"
                                                id="cv_profile_image"
                                                style="max-width:180px;max-height: 200px; height:200px;" alt="">
                                        </div>
                                        <div class="custom-file" style="max-width: 205px;">
                                            <input type="file" class="custom-file-input" name="file"
                                                   id="customFile">
                                            <label class="custom-file-label" for="customFile"
                                                   style="text-align: left">Velg Fil</label>
                                        </div>
                                    </div>
                                </div>
                                <label for="user_about_me" class="font-weight-bold text-muted">Her kan du skrive litt om
                                    deg selv.</label>
                                <div class="textarea-section">
                                    <!--Material textarea-->
                                    <div class="md-form">
                                        <textarea id="user_about_me" class="md-textarea form-control" name="about_me"
                                                  rows="3">{{$user->about_me}}</textarea>
                                    </div>
                                    <p style="font-size:13px; color:#242524">Profiler med en kort beskrivende tekst får
                                        som regel flere seriøse henvendelser. Skriv gjerne litt om deg selv, slik at
                                        andre vet hvem de handler med.</p>

                                </div>
                                <button type="submit" class="btn bg-maroon text-white">Oppdater beskrivelse</button>
                            </form>
                        </div>

                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="collapse m-3 " id="edit_profile">
                            <h3 class="font-weight-normal mb-3">Endre Profil</h3>
                            <form action="{{route('users.update', $user->id)}}" enctype="multipart/form-data"
                                  method="post">
                                {{method_field('PUT')}}
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="personal_first_name">Fornavn*</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                           value="{{$user->first_name}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="personal_last_name">Etternavn*</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                           value="{{$user->last_name}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="personal_address">Adresse*</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                           value="{{$user->address}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="personal_zip">Postnummer*</label>
                                    <input type="text" class="form-control" id="zip" name="zip" value="{{$user->zip}}"
                                           required="">
                                </div>
                                <div class="form-group">
                                    <label for="personal_city">Poststed*</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                           value="{{$user->city}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="personal_country">Land</label>
                                    <select class="form-control" id="country" name="country">
                                        <option value="">Velg..</option>
                                        @foreach($countries as $ctry)
                                            <option value="{{$ctry['name']}}"
                                                    @if($user->country==$ctry['name']) selected
                                                    @elseif($user->country=="Norway") selected @endif>{{$ctry['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="personal_email">E-post*</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                           value="{{$user->email}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="personal_mobile">Mobil</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile_number"
                                           value="{{$user->mobile}}">
                                </div>
                                <div class="form-group">
                                    <label for="personal_birthday">Fødselsdato*</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday"
                                           value="{{$user->birthday}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="personal_gender">Kjønn*</label>
                                    <select class="form-control" id="gender" name="gender" required="">
                                        <option value="">Velg...</option>
                                        <option value="male"
                                                @if($user->gender=="male") selected @endif>Kvinne
                                        </option>
                                        <option value="female"
                                                @if($user->gender=="female") selected @endif>Mann
                                        </option>
                                    </select>
                                </div>
                                <p class="mr-3">
                                    <button class="btn bg-white color-maroon" data-toggle="collapse"
                                            data-target="#view_profile"
                                            onclick="javascript:$('#edit_profile').removeClass('show');">Avbyrt
                                    </button>
                                    <button class="btn bg-maroon text-white">Endre</button>
                                </p>
                            </form>
                        </div>
                        <div class="collapse show inner-col p-4 bg-maroon-lighter" id="view_profile">
                            <h3 class="font-weight-normal mb-3"> Profildata</h3>
                            <p><b style="color:#646162" class="mr-3">Visningsnavn :</b> {{$user->username}}</p>
                            <p><b style="color:#646162" class="mr-3">Fornavn :</b> {{$user->first_name}}</p>
                            <p><b style="color:#646162" class="mr-3">Etternavn :</b> {{$user->last_name}}</p>
                            <p><b style="color:#646162" class="mr-3">Mobilnummer :</b> {{$user->mobile_number}}</p>
                            <p><b style="color:#646162" class="mr-3">E-post :</b>{{$user->email}}</p>
                            <p><b style="color:#646162" class="mr-3">Passord :</b>******</p>
                            <p><b style="color:#646162" class="mr-3">Gateadresse :</b> {{$user->address}}</p>
                            <p><b style="color:#646162" class="mr-3">Postnummer :</b> {{$user->zip}}</p>
                            <p><b style="color:#646162" class="mr-3">Poststed :</b> {{$user->city}}</p>
                            <p><b style="color:#646162" class="mr-3">Land :</b> {{$user->country}}</p>
                            <p><b style="color:#646162" class="mr-3">Født :</b> {{$user->birthday}}</p>
                            <p><b style="color:#646162" class="mr-3">Kjønn :</b> {{$user->gender}}</p>
                            <p class="mr-3">
                                <button class="btn bg-maroon text-white" data-toggle="collapse"
                                        data-target="#edit_profile"
                                        onclick="javascript:$('#view_profile').removeClass('show');">Rediger profil
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row  mb-5">
                    <div class="col-md-6 mt-4">
                        <p>Profilbildet ditt vises på alle de aktive annonsene dine. I andre sammenhenger, som for
                            eksempel når du kommuniserer med andre i vår meldingstjeneste, viser vi bare profilbilde,
                            visningsnavn og beskrivelse.</p>
                        <a href="{{route('public_profile', $user->id)}}">Se profilen slik andre ser den</a>
                    </div>
                    <div class="col-md-6 mt-4">
                        <p>Profilen din på FINN.no er bygget opp av informasjon hentet fra FINN.no og Schibsted-konto.
                            Opplysningene vises ikke i annonsene dine uten at du ber om det.</p>
                        <a href="#">Les mer om hvordan endre profil og e-post</a>
                    </div>
                </div>
                @if($user->roles->first()->name!="company")
                    <div class="row  mb-5">
                        <div class="col-md-6 offset-md-3 mt-4 text-center">
                            <p>Teksten din går her. Teksten din går her. Teksten din går her. Teksten din går her.
                                Teksten
                                din går her. </p>
                            <a href="{{url('my-business/profile/select_company_profile_type')}}"
                               class="btn bg-maroon color-white">Be om firmaprofil</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#form_company_profile').submit(function (e) {
                $('#description').text(tinyMCE.get("description").getContent());
                $('#emp_company_information').text(tinyMCE.get("emp_company_information").getContent());
            });
            tinymce.init({
                selector: 'textarea.emp_company_information',
                width: $(this).parent().width(),
                height: 250,
                menubar: false,
                statusbar: false
            });
            $(".custom-file-input").on("change", function () {
                readFileURL((this), '.profile img');
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        });
    </script>
@endsection
