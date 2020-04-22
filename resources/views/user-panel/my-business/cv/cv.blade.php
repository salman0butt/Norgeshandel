@extends('layouts.landingSite')
<?php use \App\Helpers\common; ?>
<?php $countries = countries(); ?>
<?php $cv_id = $cv->id; ?>
<?php $subjects = ['Annet', 'Allmennfag', 'Arkeologi', 'Astronomi', 'Automasjon', 'Bibliotek', 'Billedkunst', 'Biologi', 'Business', 'Bygg og anlegg', 'Dans', 'Data og Internett', 'Design', 'Elektrofag', 'Energiteknikk', 'Entreprenørskap', 'Farmasi', 'Film og TV', 'Filosofi', 'Flyskoler', 'Fysikk', 'Fysioterapi', 'Geofag', 'Havbruk og fiske', 'Helsefag', 'Historie', 'Hotell og restaurant', 'HR og personal', 'Idrett', 'Informatikk', 'Innovasjon', 'Journalistikk', 'Jus', 'Kjemi', 'Kultur', 'Landbruk', 'Litteratur', 'Logistikk', 'Marinteknologi', 'Markedsføring', 'Maskinteknikk', 'Matematikk', 'Mediefag', 'Medisin', 'Militærvesen', 'Molekylærbiologi', 'Musikk', 'Natur- og miljøvern', 'Naturfag', 'Odontologi', 'Organisasjon og ledelse', 'Pedagogikk', 'Politifag', 'PR og kommunikasjon', 'Psykologi', 'Realfag', 'Reiseliv', 'Samfunn og politikk', 'Sjøfart', 'Skogbruk', 'Sosialantropologi', 'Sos-pedagogikk', 'Sosiologi', 'Spes-pedagogikk', 'Språk', 'Strategi og ledelse', 'Svakstrøm', 'Sykepleie', 'Teater', 'Tekniske fag', 'Teologi', 'Veterinærmedisin', 'Yrkesfag', 'Zoologi', 'Økonomi'];
$education_levels = ['Vgs/Yrkesskole', 'Folkehøgskole', 'Etatsutdannelse', 'Fagskole', '1-2 år høy. utd', 'Bachelor', '4 årig Høyskole/Universitet', 'Master', 'Phd', 'Annet'];
$cvexperiences = $cv->experiences;
$cveducations = $cv->educations;
$cvlanguages = $cv->languages;
$industry = \App\Taxonomy::where('slug', 'industry')->first();
$industries = $industry->terms;

?>
@section('style')
    <link href="{{ asset('public/admin/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page_content')
    <style type="text/css" id="cv_style">
        a.edit-btn {
            font-size: 15px;
            border: 1px solid;
            padding: 2px 14px;
            font-weight: 400;
        }

        .table-main {
            padding: 25px 20px 72px;
            background-color: rgba(176, 64, 88, 0.07);
            margin-top: 50px;
            border-radius: 4px;
        }

        .row-border {
            border-bottom: 1px solid #ccc;
        }

        tbody th, tbody tr {
            border-top: 1px solid #dfe4e8;
            vertical-align: top;
            font-weight: 400;
        }

        .row.row-border {
            padding-bottom: 30px;
        }
    </style>
    <main class="cv">
        <div class="dme-container">
            <div class="breade-crumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{url('my-business')}}">Min handel</a></li> <!-- ('cv.breadcrumb.sub') -->
                        <li class="breadcrumb-item"><a href="#">Din CV</a></li> <!-- ('cv.breadcrumb.main') -->
                    </ol>
                </nav>
            </div>
            @include('common.partials.flash-messages')
            <div class="mt-5 mb-5">
                <ul class="nav nav-tabs mb-5" id="cv_tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">{{ __('cv.nav.item1') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                           aria-controls="profile" aria-selected="false">{{ __('cv.nav.item2') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                           aria-controls="contact" aria-selected="false">{{ __('cv.nav.item3') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="preview-tab" data-toggle="tab" href="#preview" role="tab"
                           aria-controls="preview" aria-selected="false">{{ __('cv.nav.item4') }}</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="inner-tab">
                            <h3 class="text-dark font-weight-normal" style="font-size:22px;">{{ __('cv.title') }}
                                <span class="float-right">
                                    <a href="{{ url('my-business/cv/en') }}"><img src="{{asset('public/images/united-kingdom.svg')}}"
                                                     width="16px"></a>
                                    <a href="{{ url('my-business/cv/nb') }}"><img src="{{asset('public/images/norway.svg')}}" width="20px"></a>
                                </span>
                            </h3>
                            <p>
                                @if($cv->status=="inactive")
                                    {{ __('cv.cv-inactive.p1') }} <span class="text-danger font-weight-bold">{{ __('cv.cv-inactive.p2') }}</span>,
                                    {{ __('cv.cv-inactive.p3') }} {{date('d.m.Y', strtotime($cv->expiry))}}.
                                @endif
                                @if($cv->visibility!="visible")
                                    {{ __('cv.cv-inactive.p4') }} <span class="font-weight-bold">{{ __('cv.cv-inactive.p5') }}</span>
                                @endif
                            </p>
                            <div class="alert alert-danger row">
                                <div class="col-md-10 pt-2">{{ __('cv.notify') }}
                                </div>
                                <a href="#profile" id="publish_tab" class="btn dme-btn-maroon radius-8 p-2 col-md-2">{{ __('cv.publish') }}</a>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mt-4 mb-4">
                                    <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:22px;">
                                        {{ __('cv.persnol') }} <span class="float-right">
                                        </span>
                                    </h3>
                                    <div class="table-main">
                                        <?php $cvpersonal = $cv->personal; ?>
                                        <form action="{{route('cvpersonal.update', $cvpersonal->id)}}"
                                              name="cvpersonal-form" id="cvpersonal-form" method="POST"
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{method_field('PUT')}}
                                            <div class="form-group">
                                                <label for="personal_title">{{ __('cv.cv-title.title') }}</label>
                                                <input type="text" class="form-control" id="personal_title" name="title"
                                                       value="{{$cvpersonal->title}}" required>
                                                <small id="emailHelp" class="form-text text-muted">{{ __('cv.cv-title.para') }}</small>
                                            </div>
                                            @php
                                                $cv_industries = array();
                                                if($cvpersonal->industries){
                                                    $cv_industries = json_decode($cvpersonal->industries);
                                                }
                                            @endphp
                                            <div class="form-group">
                                                <label for="industry">{{ __('cv.industry') }}</label>
                                                <select class="form-control select2" id="industry" name="industries[]"
                                                        required multiple="">
                                                    @if($industries->count())
                                                        @foreach($industries as $key=>$industry)
                                                            <option value="{{$industry->name}}" @if(count($cv_industries)) {{in_array($industry->name,$cv_industries) ? 'selected' : ''}} @endif>{{$industry->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_first_name">{{ __('cv.fname') }}</label>
                                                <input type="text" class="form-control" id="personal_first_name"
                                                       name="first_name" value="{{$cvpersonal->first_name}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_last_name">{{ __('cv.lname') }}</label>
                                                <input type="text" class="form-control" id="personal_last_name"
                                                       name="last_name" value="{{$cvpersonal->last_name}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_address">{{ __('cv.address') }}</label>
                                                <input type="text" class="form-control" id="personal_address"
                                                       name="address" value="{{$cvpersonal->address}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_zip">{{ __('cv.zip') }}</label>
                                                <input type="text" class="form-control" id="personal_zip" name="zip"
                                                       value="{{$cvpersonal->zip}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_city">{{ __('cv.city') }}</label>
                                                <input type="text" class="form-control" id="personal_city" name="city"
                                                       value="{{$cvpersonal->city}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_country">{{ __('cv.country') }}</label>
                                                <select class="form-control" id="personal_country" name="country">
                                                    <option value="">{{ __('cv.select') }}</option>
                                                    @foreach($countries as $ctry)
                                                        <option value="{{$ctry['name']}}" @if($cvpersonal->country==$ctry['name']) selected @elseif($cvpersonal->country=="Norway") selected @endif>{{$ctry['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_email">{{ __('cv.mail') }}</label>
                                                <input type="text" class="form-control" id="personal_email" name="email"
                                                       value="{{$cvpersonal->email}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_tell">{{ __('cv.tel') }}</label>
                                                <input type="text" class="form-control" id="personal_tell" name="tell"
                                                       value="{{$cvpersonal->tell}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_mobile">{{ __('cv.mobile') }}</label>
                                                <input type="text" class="form-control" id="phone"
                                                       name="mobile" value="{{$cvpersonal->mobile}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_birthday">{{ __('cv.bday') }}</label>
                                                <input type="text" class="form-control date-picker" id="personal_birthday"
                                                       name="birthday" value="{{$cvpersonal->birthday}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_gender">{{ __('cv.gender') }}</label>
                                                <select class="form-control" id="personal_gender" name="gender"
                                                        required>
                                                    <option value="">{{ __('cv.select') }}</option>
                                                    <option value="male"
                                                            @if($cvpersonal->gender=="male") selected @endif>Kvinne
                                                    </option>
                                                    <option value="female"
                                                            @if($cvpersonal->gender=="female") selected @endif>Mann
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_occupational_status">{{ __('cv.oc-status') }}</label>
                                                <select class="form-control" id="personal_occupational_status"
                                                        name="occupational_status" required>
                                                    <option>{{ __('cv.select') }}</option>
                                                    <option
                                                        @if($cvpersonal->occupational_status=="Arbeidssøkende") selected
                                                        @endif value="Arbeidssøkende">Arbeidssøkende
                                                    </option>
                                                    <option
                                                        @if($cvpersonal->occupational_status=="Deltidsstilling") selected
                                                        @endif value="Deltidsstilling">Deltidsstilling
                                                    </option>
                                                    <option @if($cvpersonal->occupational_status=="Fast jobb") selected
                                                            @endif value="Fast jobb">Fast jobb
                                                    </option>
                                                    <option @if($cvpersonal->occupational_status=="Freelance") selected
                                                            @endif value="Freelance">Freelance
                                                    </option>
                                                    <option
                                                        @if($cvpersonal->occupational_status=="Næringsdrivende") selected
                                                        @endif value="Næringsdrivende">Næringsdrivende
                                                    </option>
                                                    <option @if($cvpersonal->occupational_status=="Student") selected
                                                            @endif value="Student">Student
                                                    </option>
                                                    <option
                                                        @if($cvpersonal->occupational_status=="Midlertidig ansatt") selected
                                                        @endif value="Midlertidig ansatt">Midlertidig ansatt
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_website">{{ __('cv.web') }}</label>
                                                <input type="url" class="form-control" id="personal_website"
                                                       name="website" value="{{$cvpersonal->website}}">
                                                <small class="form-text text-muted">{{ __('cv.web-p') }}</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_driving_license">{{ __('cv.license') }}</label>
                                                <input type="text" class="form-control" id="personal_driving_license"
                                                       name="driving_license" value="{{$cvpersonal->driving_license}}">
                                                <small class="form-text text-muted"> E.g. A, B, C1 or D1E</small>
                                            </div>


                                            <button type="submit" class="dme-btn-outlined-blue float-left">
                                                {{ __('cv.submit') }}
                                            </button>
                                            <a class="dme-btn-outlined-blue float-left ml-2" href="">
                                                <div class="ml-2">{{ __('cv.cancel') }}</div>
                                            </a>
                                        </form>
                                    </div>

                                </div>

                                <div class="col-md-6  mb-4">
                                    <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:22px;">
                                            {{ __('cv.pic') }}
                                        <span class="float-right">

                                        <a class="edit-btn" data-toggle="collapse" href="#colapsedata" role="button"
                                           aria-expanded="false" aria-controls="colapsedata">
                                        {{ __('cv.change') }}
                                        </a>

                                        </span>
                                    </h3>
                                    <small class="form-text text-muted pl-4 pr-4 mb-5">{{ __('cv.pic-p') }}</small>
                                    <div class="collapse show" id="colapsedata" style="text-align: center">
                                        <form action="#" id="form_profile_picture" enctype="multipart/form-data">
                                            <div class="profile"
                                                 style="padding: 10px; background: #fdfdfd; border: 2px dashed #ddd;max-width: 205px; margin:auto">
                                                <img
                                                    src="@if(isset($cv) && $cv->media!=null && common::getMediaPath($cv->media, '180x200')!=null){{asset(common::getMediaPath($cv->media, '180x200'))}}@else {{asset('public/admin/images/users/1.jpg')}} @endif"
                                                    id="cv_profile_image" style="max-width:180px;max-height: 200px; height:200px;" alt="">
                                            </div>
                                            <div class="custom-file" style="max-width: 205px;">
                                                <input type="file" class="custom-file-input" name="cv_profile"
                                                       id="customFile">
                                                <label class="custom-file-label" for="customFile"
                                                       style="text-align: left">{{ __('cv.choose') }}</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row row-border education">
                            <div class="col-12 pt-4 ">
                                <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:26px;">{{ __('cv.edu') }}
                                    <span class="float-right">
                                        <a class="edit-btn" data-toggle="collapse" href="#new_education" role="button"
                                           aria-expanded="false" aria-controls="new_education">{{ __('cv.update-edu') }}</a>
                                    </span>
                                </h3>
                                <small class=" font-weight-normal form-text text-muted pl-4 pr-4 pb ">
                                    @if(!isset($cv->educations) || !is_countable($cv->educations) || empty($cv->educations->first()->school))
                                        {{ __('cv.edu-p') }}
                                    @endif
                                </small>
                                <div class="collapse" id="new_education" style="margin-top: -40px;">
                                    <div class="table-main">
                                        <form action="{{route('cveducation.store')}}" name="cveducation-form" class="cveducation_form"
                                              id="new_cvexperience-form" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="row form-group mt-3">
                                                <label class="col-md-12">{{ __('cv.skol') }}</label>
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" name="school" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="">{{ __('cv.start') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="date" name="period_from" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="">{{ __('cv.to') }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="date" name="period_to" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="">
                                                        <input type="checkbox" name="still_work" value="yes"
                                                               class="exp_still_work">
                                                        {{ __('cv.ex') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-5">
                                                    <label>{{ __('cv.subject') }}</label>
                                                    <select name="subject" class="form-control">
                                                        <option value="">{{ __('cv.select') }}</option>
                                                        @foreach($subjects as $subject)
                                                            <option value="{{$subject}}">{{$subject}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <label>{{ __('cv.subject') }}</label>
                                                    <select name="education_level" class="form-control">
                                                        <option value="">{{ __('cv.select') }}</option>
                                                        <option value="Vgs/Yrkesskole">Vgs/Yrkesskole</option>
                                                        <option value="Folkehøgskole">Folkehøgskole</option>
                                                        <option value="Etatsutdannelse">Etatsutdannelse</option>
                                                        <option value="Fagskole">Fagskole</option>
                                                        <option value="1-2 år høy. utd">1-2 år høy. utd</option>
                                                        <option value="Bachelor">Bachelor</option>
                                                        <option value="4 årig Høyskole/Universitet">4 årig
                                                            Høyskole/Universitet
                                                        </option>
                                                        <option value="Master">Master</option>
                                                        <option value="Phd">Phd</option>
                                                        <option value="Annet">Annet</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-8">
                                                    <label for="">{{ __('cv.e-city') }}</label>
                                                    <input type="text" name="degree" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <br>
                                                    <small class="text-muted">{{ __('cv.e-city-p') }}</small>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">{{ __('cv.desc') }}</label>
                                                <textarea name="detail" class="form-control" rows="3"></textarea>
                                            </div>

                                            <button type="submit" class="dme-btn-outlined-blue">{{ __('cv.save') }}</button>
                                            <a href="#" class="prevent cancel dme-btn-outlined-blue">{{ __('cv.cancel') }}</a></form>
                                    </div>
                                </div>
                            </div>
                    
                            @if(isset($cv->educations) && is_countable($cv->educations) && !empty($cv->educations->first()->school))
                                <div class="col-md-6 offset-md-3">
                                    <hr>
                                </div>
                            @endif
                            <div class="col-md-12">
                                @if(isset($cv->educations) && is_countable($cv->educations))
                                    <?php
                                    $cveducations = $cv->educations;
                                    ?>
                                    @for($i=0; $i<count($cveducations); $i++)
                                        <?php
                                        $cveducation = $cveducations[$i];
                                        ?>
                                        <div class="text-dark font-weight-normal pl-4 pr-4" style="min-height: 60px;">
                                            <div class="u-t4">
                                                <div style="width: 80%;float: left">
                                                    <span class="text-muted font-weight-normal small">{{date('d.m.Y', strtotime($cveducation->period_from))}} - {{date('d.m.Y', strtotime($cveducation->period_to))}} </span><span
                                                        class="ml-3 font-weight-normal">{{$cveducation->school}}</span><br>
                                                    <span class="mt-1">{{$cveducation->degree}}</span>
                                                </div>
                                                <div class="" style="font-size: 20px;width: 20%; float: left">
                                                    <form class="float-right"
                                                          action="{{route('cveducation.destroy', $cveducation->id)}}"
                                                          method="POST"
                                                          onsubmit="jarascript:return confirm('Vil du slette denne utdannelsen?')">
                                                        {{ csrf_field() }} {{method_field('DELETE')}}
                                                        <button type="submit" class="link pl-3">
                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                    <a class="float-right" data-toggle="collapse"
                                                       href="#edit_education_{{$i}}" role="button"
                                                       aria-expanded="false"
                                                       aria-controls="#edit_education_{{$i}}">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="edit_education_{{$i}}" style="margin-top: -40px;">
                                            <div class="table-main">
                                                {{--                                                {{dd($cvexperience)}}--}}
                                                <form action="{{route('cveducation.update', $cveducation->id)}}"
                                                      name="cveducation-form" id="cveducation-form_{{$i}}"
                                                      method="POST" enctype="multipart/form-data" class="cveducation_form">
                                                    {{method_field('PUT')}}
                                                    {{ csrf_field() }}
                                                    <div class="row form-group mt-3">
                                                        <label class="col-md-12">{{ __('cv.skol') }}</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" name="school"
                                                                   value="{{$cveducation->school}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="">{{ __('cv.start') }}</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="date" name="period_from" class="form-control"
                                                                   value="{{$cveducation->period_from}}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="">{{ __('cv.to') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input type="date" name="period_to" class="form-control"
                                                                   value="{{$cveducation->period_to}}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="">
                                                                <input type="checkbox" name="still_work" value="yes"
                                                                       class="exp_still_work"
                                                                       @if($cveducation->still_work == "yes") checked @endif>
                                                                {{ __('cv.ex') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-md-5">
                                                            <label>Fag</label>
                                                            <select name="subject" class="form-control">
                                                                <option value="">Velg...</option>
                                                                @foreach($subjects as $subject)
                                                                    <option value="{{$subject}}"
                                                                            @if($cveducation->subject==$subject) selected @endif>{{$subject}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label>{{ __('cv.edu') }}</label>
                                                            <select name="education_level" class="form-control">
                                                                <option value="">{{ __('cv.select') }}</option>
                                                                @foreach($education_levels as $education_level)
                                                                    <option value="{{$education_level}}"
                                                                            @if($cveducation->education_level==$education_level) selected @endif>{{$education_level}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2"></div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-8">
                                                            <label for="">{{ __('cv.e-city') }}</label>
                                                            <input type="text" name="degree" class="form-control"
                                                                   value="{{$cveducation->degree}}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <br>
                                                            <small class="text-muted">{{ __('cv.e-city-p') }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">{{ __('cv.desc') }}</label>
                                                        <textarea name="detail" class="form-control"
                                                                  rows="3">{{$cveducation->detail}}</textarea>
                                                    </div>

                                                    <button type="submit" class="dme-btn-outlined-blue">{{ __('cv.save') }}</button>
                                                    <a href="#" class="prevent cancel dme-btn-outlined-blue">{{ __('cv.cancel') }}</a>
                                                </form>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                        </div>
                        <div class="row row-border experience">
                            <div class="col-12 pt-4 ">
                                <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:26px;">{{ __('cv.exp') }}
                                    <span class="float-right">
                                        <a class="edit-btn" data-toggle="collapse" href="#new_experience" role="button"
                                           aria-expanded="false" aria-controls="new_experience">{{ __('cv.update-edu') }}</a>
                                    </span>
                                </h3>
                                <small class=" font-weight-normal form-text text-muted pl-4 pr-4 pb ">
                                    @if(!isset($cv->experiences) || !is_countable($cv->experiences) || empty($cv->experiences->first()->company))
                                        {{ __('cv.exp-p') }}
                                    @endif
                                </small>
                                @if(isset($cv->experiences) && is_countable($cv->experiences) && !empty($cv->experiences->first()->company))
                                    <div class="row">
                                        <div class="col-md-6 offset-md-3">
                                            <hr>
                                        </div>
                                    </div>
                                @endif
                                <div class="collapse" id="new_experience" style="margin-top: -40px;">
                                    <div class="table-main">
                                        <form action="{{route('cvexperience.store')}}" name="cvexperience-form"
                                              id="cvexperience-form" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="">{{ __('cv.start') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="date" name="period_from" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="">{{ __('cv.to') }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="date" name="period_to" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="">

                                                        <input type="checkbox" name="still_work" value="yes"
                                                               class="exp_still_work">
                                                        {{ __('cv.exp-p-work') }}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="row form-group mt-3">
                                                <label class="col-md-12" for="exampleFormControlInput1">{{ __('cv.company') }}*</label>
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" name="company">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-md-12" for="exampleFormControlInput1">{{ __('cv.job-title') }}
                                                    *</label>
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" name="job_title">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">{{ __('cv.sub') }}</label>
                                                <select name="industry" class="form-control">
                                                    @foreach($subjects as $subject)
                                                        <option value="{{$subject}}">{{$subject}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">{{ __('cv.text-p') }}</label>
                                                <textarea name="detail" class="form-control" rows="3"></textarea>
                                            </div>

                                            <button type="submit" class="dme-btn-outlined-blue">{{ __('cv.save') }}</button>
                                            <button class="cancel prevent dme-btn-outlined-blue">{{ __('cv.cancel') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @if(isset($cv->experiences) && is_countable($cv->experiences || !empty($cv->experiences->first()->company)))
                                <div class="col-md-6 offset-md-3">
                                    <hr>
                                </div>
                            @endif
                            <div class="col-md-12">
                                @if(isset($cv->experiences) && is_countable($cv->experiences))
                                    <?php
                                    $cvexpericences = $cv->experiences;
                                    ?>
                                    @for($i=0; $i<count($cvexpericences); $i++)
                                        <?php
                                        $cvexperience = $cvexpericences[$i];
                                        ?>
                                        <div class="text-dark font-weight-normal pl-4 pr-4" style="min-height: 60px;">
                                            <div class="u-t4">
                                                <div style="width: 80%;float: left">
                                                    <span class="text-muted font-weight-normal small">{{date('d.m.Y', strtotime($cvexperience->period_from))}} - {{date('d.m.Y', strtotime($cvexperience->period_from))}} </span><span
                                                        class="ml-3 font-weight-normal">{{$cvexperience->company}}</span><br>
                                                    <span class="mt-1">{{$cvexperience->job_title}}</span>
                                                </div>
                                                <div class="" style="font-size: 20px;width: 20%; float: left">
                                                    <form class="float-right"
                                                          action="{{route('cvexperience.destroy', $cvexperience->id)}}"
                                                          method="POST"
                                                          onsubmit="jarascript:return confirm('{{ __('cv.cv-confirm') }}')">
                                                        {{ csrf_field() }} {{method_field('DELETE')}}
                                                        <button type="submit" class="link pl-3">
                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                    <a class="float-right" data-toggle="collapse"
                                                       href="#edit_experience_{{$i}}" role="button"
                                                       aria-expanded="false"
                                                       aria-controls="#edit_experience_{{$i}}">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="edit_experience_{{$i}}" style="margin-top: -40px;">
                                            <div class="table-main">
                                                {{--                                                {{dd($cvexperience)}}--}}
                                                <form action="{{route('cvexperience.update', $cvexperience->id)}}"
                                                      name="cvexperience-form" id="cvexperience-form_{{$i}}"
                                                      method="POST" enctype="multipart/form-data">
                                                    {{method_field('PUT')}}
                                                    {{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="">{{ __('cv.start') }}</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="date" name="period_from" class="form-control"
                                                                   value="{{$cvexperience->period_from}}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="">{{ __('cv.to') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input type="date" name="period_to"
                                                                   class="form-control period_to"
                                                                   value="{{$cvexperience->period_to}}"
                                                                   @if($cvexperience->still_work=="yes") disabled @endif>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="">
                                                                {{--                                                        {{dd($cvexperience->still_work)}}--}}
                                                                <input type="checkbox" name="still_work" value="yes"
                                                                       @if($cvexperience->still_work=="yes") checked
                                                                       @endif class="still_work">
                                                                {{ __('cv.exp-p-work') }}
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group mt-3">
                                                        <label class="col-md-12" for="exampleFormControlInput1">{{ __('cv.company') }}
                                                            *</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" name="company"
                                                                   value="{{$cvexperience->company}}">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-md-12" for="exampleFormControlInput1">{{ __('cv.job-title') }}
                                                            *</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" name="job_title"
                                                                   value="{{$cvexperience->job_title}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">{{ __('cv.sub') }}</label>
                                                        <select name="industry" class="form-control">
                                                            <option value="">{{ __('cv.select') }}</option>
                                                            @foreach($subjects as $subject)
                                                                <option value="{{$subject}}"
                                                                        @if($cvexperience->industry==$subject) selected @endif>{{$subject}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">{{ __('cv.text-p') }}</label>
                                                        <textarea name="detail" class="form-control"
                                                                  rows="3">{{$cvexperience->detail}}</textarea>
                                                    </div>

                                                    <button type="submit" class="dme-btn-outlined-blue">{{ __('cv.save') }}</button>
                                                    <button class="prevent cancel dme-btn-outlined-blue">{{ __('cv.cancel') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                        </div>
                        <div class="row row-border key_skills">
                            <div class="col-12 pt-4 ">
                                <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:26px;">
                                    {{ __('cv.skills') }}
                                    <span class="float-right">
                                        <a class="edit-btn" data-toggle="collapse" href="#colapednok" role="button"
                                           aria-expanded="false" aria-controls="colapednok">{{ __('cv.update-edu') }}</a>
                                    </span>
                                </h3>
                                <div class=" font-weight-normal form-text text-muted pl-4 pr-4 pb ">
                                    @if(empty($cv->key_skills) || empty($cv->other_skills))
                                        {{ __('cv.skill-p') }}
                                    @else
                                        {{$cv->key_skills}}
                                        <br>
                                        <span
                                            class="font-weight-bold">{{ __('cv.skills-p') }}</span>
                                        <br>
                                        <span>{{$cv->other_skills}}</span>
                                    @endif
                                </div>
                                <div class="collapse" id="colapednok" style="margin-top: -40px;">
                                    <div class="table-main">
                                        <form action="{{route('update_skills', compact('cv_id'))}}" method="post"
                                              name="form_skills">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">{{ __('cv.skills') }}</label>
                                                <textarea name="key_skills" class="form-control"
                                                          rows="3">{{$cv->key_skills}}</textarea>
                                                <small>{{ __('cv.skills-para') }}</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">{{ __('cv.skills-p') }}</label>
                                                <textarea name="other_skills" class="form-control"
                                                          rows="3">{{$cv->other_skills}}</textarea>
                                            </div>
                                            <button type="submit" class="dme-btn-outlined-blue float-left">
                                                <div class="ml-2">{{ __('cv.submit') }}</div>
                                            </button>
                                            <a class="cancel prevent dme-btn-outlined-blue float-left ml-2" href="">{{ __('cv.cancel') }}</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-border language">
                            <div class="col-12 pt-4 ">
                                <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:26px;">
                                    {{ __('cv.lang') }}
                                    <span class="float-right">
                                        <a class="edit-btn" data-toggle="collapse" href="#languages" role="button"
                                           aria-expanded="false" aria-controls="languages">{{ __('cv.update-edu') }}</a>
                                    </span>
                                </h3>
                                <small class=" font-weight-normal form-text text-muted pl-4 pr-4 mb-5">
                                    <?php $selected_langs = $cv->languages;?>
                                    @if(!isset($cv->languages) || empty($cv->languages) || !is_countable($cv->languages) || count($cv->languages)<1)
                                        {{ __('cv.lang-p') }}
                                    @else
                                        @foreach($selected_langs as $lang)
                                            {{$lang->name}}&nbsp;
                                        @endforeach
                                    @endif
                                </small>
                                <div class="collapse bg-maroon-lighter" id="languages">
                                    <form action="{{route('update_languages', compact('cv_id'))}}" id="form_languages"
                                          name="form_languages" method="post">
                                        {{csrf_field()}}
                                        {{--                                        {{dd($cv->languages->pluck('id')->toArray())}}--}}
                                        <div class="row">
                                            <div class="col-md-5 p-4">
                                                {{--                                            <div class="row form-group">--}}
                                                <label for="source_languages">{{ __('cv.lang-select') }}</label>
                                                <select id="source_languages" class="form-control" size="10"
                                                        multiple="multiple">
                                                    <?php
                                                    $languages = \App\Models\Language::all(); ?>
                                                    @foreach($languages as $language)
                                                        <option value="{{$language->id}}"
                                                                @if(in_array($language->id, $cv->languages->pluck('id')->toArray())) selected @endif>{{$language->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5 p-4">
                                                <label for="selected_languages">{{ __('cv.lang-selected') }}</label>
                                                <select id="selected_languages" name="langs[]" class="form-control"
                                                        size="10"
                                                        multiple="multiple">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">
                                                <button class="prevent btn dme-btn-outlined-blue float-right"
                                                        id="add_language"> {{ __('cv.lang-add') }} <span
                                                        class="fa fa-arrow-right"></span></button>
                                            </div>
                                            <div class="col-md-1 p-3"></div>
                                            <div class="col-md-5">
                                                <button class="prevent btn dme-btn-outlined-blue float-left"
                                                        id="remove_language"><span class="fa fa-arrow-left"></span> {{ __('cv.lang-remove') }}
                                                </button>
                                            </div>
                                            <div class="col-md-1 p-3"></div>
                                            <div class="col-md-12 p-3 pr-5">
                                                <button type="submit"
                                                        class="m-2 float-right btn dme-btn-outlined-blue bg-maroon color-white radius-8">
                                                    {{ __('cv.save') }}
                                                </button>
                                                <a class="cancel prevent m-2 float-right btn dme-btn-outlined-blue">{{ __('cv.cancel') }}</a>
                                            </div>
                                        </div>
                                        <div id="vals">
                                            <input type="hidden" value="" id="langs">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row row-border preference">
                            <div class="col-12 pt-4 ">
                                <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:26px;">
                                    {{ __('cv.next-job') }}
                                    <span class="float-right">
                                        <a class="edit-btn" data-toggle="collapse" href="#preferences" role="button"
                                           aria-expanded="false" aria-controls="preferences">{{ __('cv.update-edu') }}</a>
                                    </span>
                                </h3>
                                <small class=" font-weight-normal form-text text-muted pl-4 pr-4 mb-5">
                                    @if(!isset($cv->preference) || (empty($cv->preference->prospective) && empty($cv->preference->job_type)))
                                        {{ __('cv.next-job-p') }}
                                    @endif
                                </small>
                                <div class="collapse bg-maroon-lighter p-3" id="preferences">
                                    <form action="{{route('update_preference', compact('cv_id'))}}"
                                          id="form_preferences" name="form_preferences" method="post">
                                        {{csrf_field()}}
                                        <div class="row form-group mt-3">
                                            <div class="col-md-12">
                                                <label for="">{{ __('cv.next-job-text') }}</label>
                                                <textarea name="prospective"
                                                          class="form-control">{{$cv->preference->prospective}}</textarea>
                                                <span class="small">{{ __('cv.next-job-para') }}</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <label for="">{{ __('cv.next-job-type') }}</label>
                                                <select class="form-control" name="job_type">
                                                    <option
                                                        value="{{$cv->preference->job_type}}">{{$cv->preference->job_type}}</option>
                                                    <option value="Ikke oppgitt">Ikke oppgitt</option>
                                                    <option value="Fast">Fast</option>
                                                    <option value="Midlertidig ansettelse">Midlertidig ansettelse
                                                    </option>
                                                    <option value="Vikar">Vikar</option>
                                                    <option value="Sesongarbeid">Sesongarbeid</option>
                                                    <option value="Deltid">Deltid</option>
                                                </select>
                                            </div>
                                            <div class="col-md-8"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <h4 class="u-t4">{{ __('cv.next-job-stuff') }}</h4>
                                                <label for="responsibility" class="radio-lbl">Ja
                                                    <input type="radio" id="responsibility" class="responsibility"
                                                           name="responsibility" value="yes"
                                                           @if($cv->preference->responsibility == "yes") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label for="responsibility1" class="radio-lbl">Uten betydning
                                                    <input type="radio" id="responsibility1" class="responsibility"
                                                           name="responsibility" value="irrelevant"
                                                           @if($cv->preference->responsibility == "irrelevant") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label for="responsibility2" class="radio-lbl">Nei
                                                    <input type="radio" id="responsibility2" class="responsibility"
                                                           name="responsibility" value="no"
                                                           @if($cv->preference->responsibility == "no") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <h4 class="u-t4">{{ __('cv.next-job-desclaimer') }}</h4>
                                                <label for="disclaimer" class="radio-lbl">{{ __('cv.next-job-option1') }}
                                                    <input type="radio" id="disclaimer" class="disclaimer"
                                                           name="disclaimer" value="yes"
                                                           @if($cv->preference->disclaimer == "yes") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label for="disclaimer1" class="radio-lbl">{{ __('cv.next-job-option2') }}
                                                    <input type="radio" id="disclaimer1" class="disclaimer"
                                                           name="disclaimer" value="irrelevant"
                                                           @if($cv->preference->disclaimer == "irrelevant") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label for="disclaimer2" class="radio-lbl">{{ __('cv.next-job-option3') }}
                                                    <input type="radio" id="disclaimer2" class="disclaimer"
                                                           name="disclaimer" value="no"
                                                           @if($cv->preference->disclaimer == "no") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <h4 class="u-t4">{{ __('cv.next-job-stuff') }}</h4>
                                                <label for="willingness" class="radio-lbl">{{ __('cv.next-job-option1') }}
                                                    <input type="radio" id="willingness" class="willingness"
                                                           name="willingness" value="yes"
                                                           @if($cv->preference->willingness == "yes") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label for="willingness1" class="radio-lbl">{{ __('cv.next-job-option2') }}
                                                    <input type="radio" id="willingness1" class="willingness"
                                                           name="willingness" value="irrelevant"
                                                           @if($cv->preference->willingness == "irrelevant") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label for="willingness2" class="radio-lbl">{{ __('cv.next-job-option3') }}
                                                    <input type="radio" id="willingness2" class="willingness"
                                                           name="willingness" value="no"
                                                           @if($cv->preference->willingness == "no") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <label for="travel_days">{{ __('cv.next-job-travel') }}</label>
                                                <input type="text" class="form-control" id="travel_days"
                                                       name="travel_days" value="{{$cv->preference->travel_days}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="salary">{{ __('cv.next-job-salary') }}</label>
                                                <input type="text" id="salary" name="salary" class="form-control"
                                                       value="{{$cv->preference->travel_days}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">{{ __('cv.next-job-terminate') }}</label>
                                                <select class="form-control" id="termination_notice"
                                                        name="termination_notice">
                                                    <option
                                                        value="{{$cv->preference->termination_notice}}">{{$cv->preference->termination_notice}}</option>
                                                    <option value="Mindre enn 1 måned">Mindre enn 1 måned</option>
                                                    <option value="1 - 3 måneder">1 - 3 måneder</option>
                                                    <option value="4 - 6 måneder">4 - 6 måneder</option>
                                                    <option value="Mer enn 6 måneder">Mer enn 6 måneder</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12 p-2 pr-5">
                                                <button type="submit"
                                                        class="m-2 float-right btn dme-btn-outlined-blue bg-maroon color-white radius-8">
                                                    {{ __('cv.save') }}
                                                </button>
                                                <a href=""
                                                   class="cancel prevent m-2 float-right btn dme-btn-outlined-blue">{{ __('cv.cancel') }}</a>
                                            </div>
                                        </div>
                                    </form>

                                </div>

                                <div class="mhl pl-4 pr-4 mt-3">
                                    <table class="sectioninfo super-condensed border-white w-100">
                                        <tbody>
                                        <tr>
                                            <th class="th_row size1of4" scope="row">{{ __('cv.job-type') }}</th>
                                            <td id="float-left">{{$cv->preference->job_type}}</td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">{{ __('cv.job-staff') }}</th>
                                            <td id="future-personnel">{{$cv->preference->responsibility}}</td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">{{ __('cv.earning') }}</th>
                                            <td id="future-accountmanager">{{$cv->preference->disclaimer}}</td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">{{ __('cv.Willing') }}</th>
                                            <td id="future-move">{{$cv->preference->willingness}}</td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">{{ __('cv.job-travel') }}</th>
                                            <td id="future-travel">{{$cv->preference->travel_days}}</td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">{{ __('cv.job-salary') }}</th>
                                            <td id="future-salary">{{$cv->preference->salary}}</td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">{{ __('cv.job-terminate') }}</th>
                                            <td id="future-period">{{$cv->preference->termination_notice}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <p class="pt-5 pb-5 pl-4 pr-4 text-dark">{{ __('cv.job-p') }}</p>
                        <p class="text-dark pl-4 pr-4">10670303</p>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{route('cv.update', compact('cv'))}}" method="POST">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <div class="inner-tab">
                                <p class="text-dark pb-4">{{ __('cv.job-setting') }}</p>
                                <h3 class="text-dark font-weight-normal" style="font-size:22px;">{{ __('cv.CV-innstill') }}</h3>
                                <p class="text-dark pb-4">{{ __('cv.CV-innstill-p') }}</p>
                            </div>

                            <div class="row row-border pb-4" style="border-top:1px solid #ccc">
                                <div class="col-md-4 pt-4"><p class="text-dark ">{{ __('cv.din-cv') }}</p></div>
                                <div class="col-md-8"><p class="text-dark ">
                                    </p>
                                    <div class="form-group">
                                        <div class="">
                                            <label class="radio-lbl" for="status1">
                                                <input type="radio" id="status1" name="status"
                                                       value="published" @if($cv->status==="published") checked @endif>{{ __('cv.published') }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="">
                                            <label class="radio-lbl" for="status2">
                                                <input type="radio" id="status2" name="status"
                                                       value="inactive" @if($cv->status==="inactive") checked @endif>{{ __('cv.inactive') }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <p class="text-dark pt-3">{{ __('cv.pub-p') }}</p>
                                    </div>

                                </div>
                            </div>
                            <div class="row row-border pb-4">
                                <div class="col-md-4 pt-4"><p class="text-dark ">{{ __('cv.view-persnol') }}</p></div>
                                <div class="col-md-8"><p class="text-dark ">
                                    </p>
                                    <div class="form-group">

                                        <div class="form-check">
                                            <label class="radio-lbl" for="visibility1">
                                                <input type="radio" class="" id="visibility1" name="visibility"
                                                       value="visible" @if($cv->visibility==="visible") checked @endif>{{ __('cv.view-option1') }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="radio-lbl" for="visibility2">
                                                <input type="radio" class="" id="visibility2" name="visibility"
                                                       value="anonymous"
                                                       @if($cv->visibility==="anonymous") checked @endif>{{ __('cv.view-option2') }}
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <p class="text-dark pt-3">{{ __('cv.view-para') }}</p>
                                    </div>

                                    <p></p></div>
                            </div>

                            <div class="row row-border ">
                                <div class="col-md-4 pt-2"><p class="text-dark ">{{ __('cv.register-view') }}</p></div>
                                <div class="col-md-8 pt-2"><p
                                        class="text-dark ">{{date('d.m.Y', strtotime($cv->user->created_at))}}</p></div>
                            </div>
                            <div class="row row-border ">
                                <div class="col-md-4 pt-2"><p class="text-dark ">{{ __('cv.last-update') }}</p></div>
                                <div class="col-md-8 pt-2"><p class="text-dark ">{{date('d.m.Y', strtotime($cv->updated_at))}}</p></div>
                            </div>
                            <div class="row row-border ">
                                <div class="col-md-4 pt-2"><p class="text-dark ">{{ __('cv.cv-id') }}</p></div>
                                <div class="col-md-8 pt-2"><p class="text-dark ">{{$cv->id}}</p></div>
                            </div>
                            <div class="row row-border">
                                <div class="col-md-4 pt-2"><p class="text-dark ">{{ __('cv.expire') }}</p></div>
                                <div class="col-md-8 pt-2">
                                    <p class="text-dark ">{{date('d.m.Y', strtotime($cv->expiry))}}
                                        <a class="ml-3" href="{{url('my-business/cv/extend')}}">{{ __('cv.month') }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="row row-border ">
                                <div class="col-md-4 pt-2"><p class="text-dark ">{{ __('cv.Disclaimer') }}</p></div>
                                <div class="col-md-8 pt-2"><p class="text-dark "><a href="#">{{ __('cv.readmore') }}</a></p></div>
                            </div>
                            <div class="btn-group mt-3">
                                <button type="submit" class="dme-btn-outlined-blue float-left">{{ __('cv.save') }}</button>
                                <button class="dme-btn-outlined-blue float-left ml-3">{{ __('cv.delete') }}</button>
                            </div>
                        </form>
                    </div>
                    @php
                        $unanswered_requests = Auth::user()->requests_received()->where('status','requested')->get();
                        $answered_requests = Auth::user()->requests_received()->where('status','<>','requested')->get();
                    @endphp
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="inner-tab">
                            <h3 class="text-dark font-weight-normal" style="font-size:22px;">{{ __('cv.inquiry') }}</h3>
                            <p class="text-dark">{{ __('cv.inquiry-p') }}</p>
                            <div class="mt-5 inquiries-table">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                           href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">{{ __('cv.unanswered') }}</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                           href="#nav-profile" role="tab" aria-controls="nav-profile"
                                           aria-selected="false">{{ __('cv.answered') }}</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active mt-5 cv-requests-tabs" id="nav-home" role="tabpanel"
                                         aria-labelledby="nav-home-tab">

                                        <table class="table table-striped" id="unanswered_requests_table">
                                            <thead>
                                            <tr>
                                                <th scope="col">{{ __('cv.date') }}</th>
                                                <th scope="col">{{ __('cv.request') }}</th>
                                                <th scope="col">{{ __('cv.Status') }}</th>
                                                <th scope="col">{{ __('cv.Action') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if($unanswered_requests->count())
                                                    @foreach($unanswered_requests as $key=>$unanswered_request)
                                                        <tr>
                                                            <th scope="row">{{$unanswered_request->created_at->format('d-m-Y')}}</th>
                                                            <td>{{$unanswered_request->employer && $unanswered_request->employer->username ? $unanswered_request->employer->username : ''}}</td>
                                                            <td>
                                                                @if($unanswered_request->status == "requested")
                                                                    <span class="badge badge-primary">Avventer</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{--{{url('cv-request?user_id='.$unanswered_request->user_id.'&employer_id='.$unanswered_request->employer_id)}}--}}
                                                                <a href="javascript:void(0);" class="action-cv-request" data-status="accepted" data-employer_id = "{{$unanswered_request->employer_id}}" data-user_id = "{{$unanswered_request->user_id}}" title="Aksepter det"><i class="far fa-check-circle fa-lg"></i></a>
                                                                <a href="javascript:void(0);" class="action-cv-request" data-status="rejected" data-employer_id = "{{$unanswered_request->employer_id}}" data-user_id = "{{$unanswered_request->user_id}}" title="Avvis det"><i class="far fa-times-circle fa-lg"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr class="odd"><td valign="top" colspan="4" class="dataTables_empty text-center">Ingen opptak funnet</td></tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade mt-5 cv-requests-tabs" id="nav-profile" role="tabpanel"
                                         aria-labelledby="nav-profile-tab">


                                        <table class="table table-striped" id="answered_requests_table">
                                            <thead>
                                            <tr>
                                               <th scope="col">{{ __('cv.date') }}</th>
                                               <th scope="col">{{ __('cv.request') }}</th>
                                               <th scope="col">{{ __('cv.Status') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($answered_requests->count())
                                                @foreach($answered_requests as $key=>$answered_request)
                                                    <tr>
                                                        <th scope="row">{{$answered_request->created_at->format('d-m-Y')}}</th>
                                                        <td>{{$answered_request->employer && $answered_request->employer->username ? $answered_request->employer->username : ''}}</td>
                                                        <td>
                                                            @if($answered_request->status == "accepted")
                                                                <span class="badge badge-success">Akseptert</span>
                                                            @elseif($answered_request->status == "rejected")
                                                                <span class="badge badge-danger">Avvist</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="odd"><td valign="top" colspan="4" class="dataTables_empty text-center">Ingen opptak funnet</td></tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="preview" role="tabpanel" aria-labelledby="preview-tab">
                        <div class="inner-tab">
                            <h3 class="text-dark font-weight-normal" style="font-size:22px;">{{ __('cv.preview') }}</h3>
                            <p class="text-dark">{{ __('cv.preview-p') }}</p>
                            <div class="row mb-5">
                                <div class="col-md-8">
                                    <div class="btn-group mt-3">
                                        <a class="m-2 dme-btn-outlined-blue float-left"
                                           data-toggle="collapse" href="#open_cv">
                                            {{ __('cv.open-cv') }}
                                        </a>
                                        <a class="m-2 dme-btn-outlined-blue float-left collapsed"
                                           data-toggle="collapse" href="#personal_cv">
                                            {{ __('cv.persnol-cv') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="btn-group mt-3">
                                        <a class="dme-btn-outlined-blue float-left" id="download_cv" href="{{url('my-business/cv/download_pdf', $cv->id)}}">
                                             {{ __('cv.pdf-download') }}
                                        </a>
                                        <a class="dme-btn-outlined-blue float-left ml-3" id="print_cv" href="#">
                                             {{ __('cv.print-resume') }}
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="collapse show printable_cv" data-toggle="collapse" data-parent="#preview" id="open_cv">
                                <p class="pt-3">CV-id: {{$cv->id}}</p>
                                <style type="text/css">
                                    .table-main {
                                        padding: 25px 20px 72px;
                                        background-color: rgba(176, 64, 88, 0.07);
                                        margin-top: 50px;
                                        border-radius: 4px;
                                    }

                                    .row-border {
                                        border-bottom: 1px solid #ccc;
                                    }

                                    tbody th, tbody tr {
                                        border-top: 1px solid #dfe4e8;
                                        vertical-align: top;
                                        font-weight: 400;
                                    }

                                    .row.row-border {
                                        padding-bottom: 30px;
                                    }
                                </style>
                                <div class="table-main-1">
                                    <div class="row personal">
                                        <div class="col-md-8 pr-4">
                                            <h2 class="u-t2">{{$cv->personal->title}}</h2>
                                            <h3 class="text-dark font-weight-normal pt-4 pb-4 u-t3" style="font-size:22px;">
                                                {{ __('cv.persnal') }}</h3>
                                        </div>
                                        <div class="col-md-4">
                                        </div>
                                    </div>
                                    <div class="row personal">
                                        <div class="col-md-8">
                                            <table class="w-100">
                                                <tbody>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.name') }}</th>
                                                    <td id="cvdetails-name">{{$cv->personal->first_name}} {{$cv->personal->last_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.birthday') }}</th>
                                                    <td id="cvdetails-birthdate">{{$cv->personal->birthday}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row size1of4" scope="row">{{ __('cv.address') }}</th>
                                                    <td id="cvdetails-address">{{$cv->personal->address}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.city') }}</th>
                                                    <td id="cvdetails-postcode">{{$cv->personal->city}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.gender') }}</th>
                                                    <td id="cvdetails-gender">{{$cv->personal->gender}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.country') }}</th>
                                                    <td id="cvdetails-country">{{$cv->personal->country}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.telephone') }}</th>
                                                    <td id="cvdetails-phone">{{$cv->personal->tell}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.mobile') }}</th>
                                                    <td id="cvdetails-phone2">{{$cv->personal->mobile}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.email') }}</th>
                                                    <td id="cvdetails-email">{{$cv->personal->email}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-website') }}</th>
                                                    <td id="cvdetails-homepage">{{$cv->personal->website}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-status') }}</th>
                                                    <td id="cvdetails-employmentstatus">{{$cv->personal->occupational_status}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-license') }}</th>
                                                    <td id="cvdetails-driverslicense">{{$cv->personal->driving_license}}</td>
                                                </tr>
                                                @if(count($cv_industries))
                                                    <tr>
                                                        <th class="th_row" scope="row">{{ __('cv.industry') }}</th>
                                                        <td id="cvdetails-driverslicense">
                                                            <ul class="pl-3">
                                                                @foreach($cv_industries as $industry)
                                                                    <li>{{$industry}}</li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="col-md-4">
                                            @if(isset($cv) && $cv->media!=null)
                                                <div class="profile"
                                                     style="padding: 10px; background: #fdfdfd; border: 2px dashed #ddd;max-width: 205px; margin:auto">
                                                    <img
                                                        src="{{asset(\App\Helpers\common::getMediaPath($cv->media, '180x200'))}}"
                                                        id="cv_profile_image"
                                                        style="max-width:180px;max-height: 200px; height:200px;" alt="">
                                                </div>
                                            @else
                                                <h3 class="text-dark font-weight-normal pt-4" style="font-size:22px;">
                                                    {{ __('cv.pre-picture') }}
                                                </h3>
                                                <small class="text-dark">{{ __('cv.pre-picture-p') }}</small>
                                            @endif

                                        </div>
                                    </div>
                                    @if(isset($cv->educations) && is_countable($cv->educations) && !empty($cv->educations->first()->school))
                                        <div class="row education mt-2">
                                            <div class="col-12 pt-4 ">
                                                <h3 class="text-dark font-weight-normal" style="font-size:26px;">
                                                    {{ __('cv.pre-education') }}
                                                </h3>
                                            </div>
                                            @foreach($cveducations as $cveducation)
                                                <div class="col-md-9">
                                                    <div class="text-dark font-weight-normal" style="min-height: 60px;">
                                                        <div class="u-t4">
                                                            <span class="text-muted font-weight-normal small">{{date('d.m.Y', strtotime($cveducation->period_from))}} - {{date('d.m.Y', strtotime($cveducation->period_to))}}</span>
                                                            <span class="ml-3 font-weight-normal">{{$cveducation->school}}</span><br>
                                                            <span class="mt-1">{{$cveducation->degree}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <hr>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($cv->experiences) && is_countable($cv->experiences) && !empty($cv->experiences->first()->company))
                                        <div class="row education mt-1">
                                            <div class="col-12 pt-4 ">
                                                <h3 class="text-dark font-weight-normal" style="font-size:26px;">
                                                    {{ __('cv.pre-experiance') }}
                                                </h3>
                                            </div>
                                            @foreach($cvexperiences as $experience)
                                                <div class="col-md-9">
                                                    <div class="text-dark font-weight-normal" style="min-height: 60px;">
                                                        <div class="u-t4">
                                                            <span class="text-muted font-weight-normal small">{{date('d.m.Y', strtotime($experience->period_from))}} - {{date('d.m.Y', strtotime($experience->period_to))}}</span>
                                                            <span class="ml-3 font-weight-normal">{{$experience->company}}</span><br>
                                                            <span class="mt-1">{{$experience->job_title}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <hr>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($cv->key_skills) && !empty($cv->key_skills))
                                        <div class="row key_skills mt-1">
                                            <div class="col-12 pt-4 ">
                                                <h3 class="text-dark font-weight-normal" style="font-size:26px;">
                                                    {{ __('cv.pre-skills') }}
                                                </h3>
                                                <div>{{$cv->key_skills}}</div>
                                                <div class="font-weight-bold">Annen erfaring, tillitsverv, interesser etc.</div>
                                                <div class="">{{$cv->other_skills}}</div>
                                            </div>
                                            <div class="col-md-9">
                                                <hr>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                    @endif
                                    @if(isset($cv->languages) && !empty($cv->languages))
                                        <div class="row languages mt-1">
                                            <div class="col-12 pt-4 ">
                                                <h3 class="text-dark font-weight-normal" style="font-size:26px;">
                                                    {{ __('cv.pre-lang') }}
                                                </h3>
                                                @foreach($cvlanguages as $language)
                                                    <span>{{$language->name}}</span>
                                                @endforeach
                                            </div>
                                            <div class="col-md-9">
                                                <hr>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row preferences mt-1">
                                        <div class="col-12">
                                            <h3 class="text-dark font-weight-normal pt-4 pb-4" style="font-size:22px;">
                                                {{ __('cv.pre-wish-job') }}</h3>
                                            <table class="sectioninfo super-condensed border-white w-100">
                                                <tbody>
                                                <tr>
                                                    <th class="th_row size1of4" scope="row">{{ __('cv.pre-job-type') }}</th>
                                                    <td id="float-left">{{$cv->preference->job_type}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-response') }}</th>
                                                    <td id="future-personnel">{{$cv->preference->responsibility}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-disclaimer') }}</th>
                                                    <td id="future-accountmanager">{{$cv->preference->disclaimer}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-willing') }}</th>
                                                    <td id="future-move">{{$cv->preference->willingness}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-travel') }}</th>
                                                    <td id="future-travel">{{$cv->preference->travel_days}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-salary') }}</th>
                                                    <td id="future-salary">{{$cv->preference->salary}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-terminate') }}</th>
                                                    <td id="future-period">{{$cv->preference->termination_notice}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" data-toggle="collapse" data-parent="#preview" id="personal_cv">
                                <div class="table-main-1">
                                    <div class="row personal">
                                        <div class="col-md-8 pr-4">
                                            <h2 class="u-t2">{{$cv->personal->title}}</h2>
                                            <h3 class="text-dark font-weight-normal pt-4 pb-4 u-t3" style="font-size:22px;">
                                                {{ __('cv.persnal') }}</h3>
                                            <table class="w-100">
                                                <tbody>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.name') }}</th>
                                                    <td id="cvdetails-name">{{$cv->personal->first_name}} {{$cv->personal->last_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.birthday') }}</th>
                                                    <td id="cvdetails-birthdate">{{$cv->personal->birthday}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row size1of4" scope="row">{{ __('cv.address') }}</th>
                                                    <td id="cvdetails-address">{{$cv->personal->address}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.city') }}</th>
                                                    <td id="cvdetails-postcode">{{$cv->personal->city}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.gender') }}</th>
                                                    <td id="cvdetails-gender">{{$cv->personal->gender}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.country') }}</th>
                                                    <td id="cvdetails-country">{{$cv->personal->country}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-status') }}</th>
                                                    <td id="cvdetails-employmentstatus">{{$cv->personal->occupational_status}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-license') }}</th>
                                                    <td id="cvdetails-driverslicense">{{$cv->personal->driving_license}}</td>
                                                </tr>
                                                @if(count($cv_industries))
                                                    <tr>
                                                        <th class="th_row" scope="row">{{ __('cv.industry') }}</th>
                                                        <td id="cvdetails-driverslicense">
                                                            <ul class="pl-3">
                                                                @foreach($cv_industries as $industry)
                                                                    <li>{{$industry}}</li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-4">
                                            <h3 class="text-dark font-weight-normal pt-4" style="font-size:22px;">Bilde</h3>
                                            @if(isset($cv) && $cv->media!=null)
                                                <div class="profile"
                                                     style="padding: 10px; background: #fdfdfd; border: 2px dashed #ddd;max-width: 205px; margin:auto">
                                                    <img
                                                        src="@if(isset($cv) && $cv->media!=null){{asset(\App\Helpers\common::getMediaPath($cv->media, '180x200'))}}@else {{asset('public/admin/images/users/1.jpg')}} @endif"
                                                        id="cv_profile_image"
                                                        style="max-width:180px;max-height: 200px; height:200px;" alt="">
                                                </div>
                                            @else
                                                <small class="text-dark">{{ __('cv.pre-picture-p') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    @if(isset($cv->educations) && is_countable($cv->educations) && !empty($cv->educations->first()->school))
                                        <div class="row education mt-2">
                                            <div class="col-12 pt-4 ">
                                                <h3 class="text-dark font-weight-normal" style="font-size:26px;">
                                                    {{ __('cv.pre-education') }}
                                                </h3>
                                            </div>
                                            @foreach($cveducations as $cveducation)
                                                <div class="col-md-9">
                                                    <div class="text-dark font-weight-normal" style="min-height: 60px;">
                                                        <div class="u-t4">
                                                            <span class="text-muted font-weight-normal small">{{date('d.m.Y', strtotime($cveducation->period_from))}} - {{date('d.m.Y', strtotime($cveducation->period_to))}}</span>
                                                            <span class="ml-3 font-weight-normal">{{$cveducation->school}}</span><br>
                                                            <span class="mt-1">{{$cveducation->degree}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <hr>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($cv->experiences) && is_countable($cv->experiences) && !empty($cv->experiences->first()->company))
                                        <div class="row education mt-1">
                                            <div class="col-12 pt-4 ">
                                                <h3 class="text-dark font-weight-normal" style="font-size:26px;">
                                                    {{ __('cv.pre-experiance') }}
                                                </h3>
                                            </div>
                                            @foreach($cvexperiences as $experience)
                                                <div class="col-md-9">
                                                    <div class="text-dark font-weight-normal" style="min-height: 60px;">
                                                        <div class="u-t4">
                                                            <span class="text-muted font-weight-normal small">{{date('d.m.Y', strtotime($experience->period_from))}} - {{date('d.m.Y', strtotime($experience->period_to))}}</span>
                                                            <span class="ml-3 font-weight-normal">{{$experience->company}}</span><br>
                                                            <span class="mt-1">{{$experience->job_title}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <hr>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($cv->key_skills) && !empty($cv->key_skills))
                                        <div class="row key_skills mt-1">
                                            <div class="col-12 pt-4 ">
                                                <h3 class="text-dark font-weight-normal" style="font-size:26px;">
                                                    Nøkkelkompetanse
                                                </h3>
                                                <div>{{$cv->key_skills}}</div>
                                                <div class="font-weight-bold">Annen erfaring, tillitsverv, interesser etc.</div>
                                                <div class="">{{$cv->other_skills}}</div>
                                            </div>
                                            <div class="col-md-9">
                                                <hr>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                    @endif
                                    @if(isset($cv->languages) && !empty($cv->languages))
                                        <div class="row languages mt-1">
                                            <div class="col-12 pt-4 ">
                                                <h3 class="text-dark font-weight-normal" style="font-size:26px;">
                                                    {{ __('cv.pre-lang') }}
                                                </h3>
                                                @foreach($cvlanguages as $language)
                                                    <span>{{$language->name}}</span>
                                                @endforeach
                                            </div>
                                            <div class="col-md-9">
                                                <hr>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row preferences mt-5">
                                        <div class="col-12">
                                            <h3 class="text-dark font-weight-normal pt-4 pb-4" style="font-size:22px;">
                                                {{ __('cv.pre-wish-job') }}</h3>
                                            <table class="sectioninfo super-condensed border-white w-100">
                                                <tbody>
                                                <tr>
                                                    <th class="th_row size1of4" scope="row">{{ __('cv.pre-job-type') }}</th>
                                                    <td id="float-left">{{$cv->preference->job_type}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-response') }}</th>
                                                    <td id="future-personnel">{{$cv->preference->responsibility}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-disclaimer') }}</th>
                                                    <td id="future-accountmanager">{{$cv->preference->disclaimer}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-willing') }}</th>
                                                    <td id="future-move">{{$cv->preference->willingness}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-travel') }}</th>
                                                    <td id="future-travel">{{$cv->preference->travel_days}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-salary') }}</th>
                                                    <td id="future-salary">{{$cv->preference->salary}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">{{ __('cv.pre-terminate') }}</th>
                                                    <td id="future-period">{{$cv->preference->termination_notice}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </main>
    <input type="hidden" id="link_upload_cv_profile" value="{{url('my-business/cv/upload_cv_profile')}}">
    <script type="text/javascript">
        function showTab(hash) {
            if (location.hash != "") {

                if(hash == "#nav-profile" || hash == "#nav-home"){
                    $(".tab-pane").removeClass('show');
                    $(".tab-pane").removeClass('active');
                    $('#nav-tab a').removeClass('active');
                    $('#cv_tabs a').removeClass('active');
                    $("#myTabContent #contact").addClass('show');
                    $("#myTabContent #contact").addClass('active');
                    $('.cv-requests-tabs' + hash).addClass('show');
                    $('.cv-requests-tabs' + hash).addClass('active');
                    $('#cv_tabs a[href="#contact"]').addClass('active');
                    $('#nav-tab a[href="' +hash+ '"]').addClass('active');
                }else{
                    $(".tab-pane:not('.cv-requests-tabs')").removeClass('show');
                    $(".tab-pane:not('.cv-requests-tabs')").removeClass('active');
                    $('.tab-pane' + hash).addClass('show');
                    $('.tab-pane' + hash).addClass('active');
                    $('#cv_tabs a').removeClass('active');
                    $('#cv_tabs a[href="' + hash + '"]').addClass('active');
                }
            }
        }
        var doc = new jsPDF();
        var specialElementHandlers = {
            '#editor': function (element, renderer) {
                return true;
            }
        };

        $('#selected_languages').html($('#source_languages').children('option:selected'));
        $(document).ready(function () {

            var htm = $('.printable_cv').html();
            // console.log(htm);
            $('#download_cv').click(function (e) {
            });

            $('#print_cv').click(function (e) {
                e.preventDefault();
                $('.printable_cv').css('padding','0.5in');
                var cv = $('.printable_cv').html();
                $('body').html('<div style="padding:0.5in">'+cv+'</div>');
                window.print();
                window.location.reload();
            });

            $(document).on('click', '.cancel', function (e) {
                $(this).closest('.collapse').removeClass('show');
                console.log($(this).closest('.collapse'));
            });

            $(document).on('click', '.prevent', function (e) {
                e.preventDefault();
            });

            $('#form_languages').submit(function (e) {
                $('#selected_languages option').prop('selected', true);
            });
            $(document).on('click', '#add_language', function () {
                $('#selected_languages').html($('#selected_languages').children().add($('#source_languages').children('option:selected')));
                $('#xx').val('12345');
            });

            $(document).on('click', '#remove_language', function () {
                $('#source_languages').html($('#source_languages').children().add($('#selected_languages').children('option:selected')));
            });


            $('.still_work').click(function (e) {
                // console.log($(this).closest('.row').prev().find('input.period_to').attr('disabled'));
                var attr = $(this).closest('.row').prev().find('input.period_to').attr('disabled');

                if (typeof attr !== typeof undefined && attr !== false) {
                    $(this).closest('.row').prev().find('input.period_to').removeAttr('disabled');
                } else {
                    $(this).closest('.row').prev().find('input.period_to').attr('disabled', 'disabled');
                    $(this).closest('.row').prev().find('input.period_to').val('');
                }
            });
            showTab(location.hash);
            $(document).on('click', '#publish_tab', function (e) {
                e.preventDefault();
                showTab($(this).attr('href'));
                location.hash = $(this).attr('href');
            });

            $(document).on('click', '#cv_tabs a', function () {
                location.hash = $(this).attr('href');
            });

            $(document).on('click', '#nav-tab a', function () {
                location.hash = $(this).attr('href');
            });
            $(".custom-file-input").on("change", function () {
                readFileURL((this), '.profile img');
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

                var link = $('#link_upload_cv_profile').val();
                var myform = document.getElementById("form_profile_picture");
                var fd = new FormData(myform);
                console.log(fd);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: link,
                    type: "POST",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                    }
//                    document.getElementById("contact_us").reset();
                })
            });

            @if($unanswered_requests->count() > 0)
                $('#unanswered_requests_table').DataTable({
                    "order": [[ 0, "desc" ]]
                });
            @endif
            @if($answered_requests->count() > 0)
                $('#answered_requests_table').DataTable({
                    "order": [[ 0, "desc" ]]
                });
            @endif
            //Sent request to view CV
            $(document).on('click', '.action-cv-request', function (e) {
                if (confirm("Er du sikker på å endre status? Du vil ikke endre det senere.") == true) {
                    e.preventDefault();
                    var user_id = $(this).data('user_id');
                    var employer_id = $(this).data('employer_id');
                    var status = $(this).data('status');
                    $.ajax({
                        url: '{{route('cv-request')}}',
                        type: "POST",
                        data:{'user_id':user_id,'employer_id':employer_id,'status':status},
                        async: false,
                        success: function (response) {
                            location.reload();
                        },
                        error: function (jqXhr, json, errorThrown) { // this are default for ajax errors
                            var errors = jqXhr.responseJSON;

                            notify("error","noe gikk galt!");
                            return false;
                        },
                    });
                }

            });
        });
    </script>
@endsection
@section('script')
    <script src="{{ asset('public/admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/select2.full.min.js') }}"></script>
    <script>
        $(".select2").select2();
    </script>
@endsection