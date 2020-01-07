@extends('layouts.landingSite')
<?php $countries = countries(); ?>
<?php $cv_id = $cv->id; ?>
<?php $subjects = ['Annet', 'Allmennfag', 'Arkeologi', 'Astronomi', 'Automasjon', 'Bibliotek', 'Billedkunst', 'Biologi', 'Business', 'Bygg og anlegg', 'Dans', 'Data og Internett', 'Design', 'Elektrofag', 'Energiteknikk', 'Entreprenørskap', 'Farmasi', 'Film og TV', 'Filosofi', 'Flyskoler', 'Fysikk', 'Fysioterapi', 'Geofag', 'Havbruk og fiske', 'Helsefag', 'Historie', 'Hotell og restaurant', 'HR og personal', 'Idrett', 'Informatikk', 'Innovasjon', 'Journalistikk', 'Jus', 'Kjemi', 'Kultur', 'Landbruk', 'Litteratur', 'Logistikk', 'Marinteknologi', 'Markedsføring', 'Maskinteknikk', 'Matematikk', 'Mediefag', 'Medisin', 'Militærvesen', 'Molekylærbiologi', 'Musikk', 'Natur- og miljøvern', 'Naturfag', 'Odontologi', 'Organisasjon og ledelse', 'Pedagogikk', 'Politifag', 'PR og kommunikasjon', 'Psykologi', 'Realfag', 'Reiseliv', 'Samfunn og politikk', 'Sjøfart', 'Skogbruk', 'Sosialantropologi', 'Sos-pedagogikk', 'Sosiologi', 'Spes-pedagogikk', 'Språk', 'Strategi og ledelse', 'Svakstrøm', 'Sykepleie', 'Teater', 'Tekniske fag', 'Teologi', 'Veterinærmedisin', 'Yrkesfag', 'Zoologi', 'Økonomi'];
$education_levels = ['Vgs/Yrkesskole', 'Folkehøgskole', 'Etatsutdannelse', 'Fagskole', '1-2 år høy. utd', 'Bachelor', '4 årig Høyskole/Universitet', 'Master', 'Phd', 'Annet'];
$cvexperiences = $cv->experiences;
$cveducations = $cv->educations;
$cvlanguages = $cv->languages;
?>
@section('page_content')
    <style type="text/css">
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
                        <li class="breadcrumb-item"><a href="#">Min handel </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Your CV</li>
                    </ol>
                </nav>
            </div>
            @include('common.partials.flash-messages')
            <div class="mt-5 mb-5">
                <ul class="nav nav-tabs mb-5" id="cv_tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">Din CV</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                           aria-controls="profile" aria-selected="false">CV-innstillinger</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                           aria-controls="contact" aria-selected="false">Dine forespørsler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="preview-tab" data-toggle="tab" href="#preview" role="tab"
                           aria-controls="preview" aria-selected="false">Forhåndsvis CV</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="inner-tab">
                            <h3 class="text-dark font-weight-normal" style="font-size:22px;">Your CV
                                <span class="float-right">
                                    <a href="#"><img src="{{asset('public/images/united-kingdom.svg')}}"
                                                     width="16px"></a>
                                    <a href="#"><img src="{{asset('public/images/norway.svg')}}" width="20px"></a>
                                </span>
                            </h3>
                            <p>
                                @if($cv->status=="inactive")
                                    CVen din er <span class="text-danger font-weight-bold">inaktiv</span>, med
                                    utløpsdato {{date('d.m.Y', strtotime($cv->expiry))}}.
                                @endif
                                @if($cv->visibility!="visible")
                                    Personlige detaljer er <span class="font-weight-bold">ikke synlige.</span>
                                @endif
                            </p>
                            <div class="alert alert-danger row">
                                <div class="col-md-10 pt-2">CVen din kan bare vises av våre kunder når du har registrert
                                    personopplysninger og utdanning eller erfaring.
                                </div>
                                <a href="#profile" id="publish_tab" class="btn dme-btn-maroon radius-8 p-2 col-md-2">Publiser
                                    CV</a>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mt-4 mb-4">
                                    <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:22px;">
                                        Personalia <span class="float-right">
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
                                                <label for="personal_title">CV-tittel *</label>
                                                <input type="text" class="form-control" id="personal_title" name="title"
                                                       value="{{$cvpersonal->title}}" required>
                                                <small id="emailHelp" class="form-text text-muted">F.eks "Bachelor med 4
                                                    års erfaring som regnskapsfører" eller "Anestesisykepleier med
                                                    betydelig erfaring fra akuttmedisin, ambulansetjeneste og kirurgi
                                                    utført på polikliniske pasienter"</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_first_name">Fornavn*</label>
                                                <input type="text" class="form-control" id="personal_first_name"
                                                       name="first_name" value="{{$cvpersonal->first_name}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_last_name">Etternavn*</label>
                                                <input type="text" class="form-control" id="personal_last_name"
                                                       name="last_name" value="{{$cvpersonal->last_name}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_address">Adresse*</label>
                                                <input type="text" class="form-control" id="personal_address"
                                                       name="address" value="{{$cvpersonal->address}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_zip">Postnummer*</label>
                                                <input type="text" class="form-control" id="personal_zip" name="zip"
                                                       value="{{$cvpersonal->zip}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_city">Poststed*</label>
                                                <input type="text" class="form-control" id="personal_city" name="city"
                                                       value="{{$cvpersonal->city}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_country">Land</label>
                                                <select class="form-control" id="personal_country" name="country">
                                                    <option value="">Velg..</option>
                                                    @foreach($countries as $ctry)
                                                        <option value="{{$ctry['name']}}"
                                                                @if($cvpersonal->country==$ctry['name']) selected @endif>{{$ctry['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_email">E-post*</label>
                                                <input type="text" class="form-control" id="personal_email" name="email"
                                                       value="{{$cvpersonal->email}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_tell">Telefon</label>
                                                <input type="text" class="form-control" id="personal_tell" name="tell"
                                                       value="{{$cvpersonal->tell}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_mobile">Mobil</label>
                                                <input type="text" class="form-control" id="personal_mobile"
                                                       name="mobile" value="{{$cvpersonal->mobile}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_birthday">Fødselsdato*</label>
                                                <input type="date" class="form-control" id="personal_birthday"
                                                       name="birthday" value="{{$cvpersonal->birthday}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_gender">Kjønn*</label>
                                                <select class="form-control" id="personal_gender" name="gender"
                                                        required>
                                                    <option value="">Velg...</option>
                                                    <option value="male"
                                                            @if($cvpersonal->gender=="male") selected @endif>Kvinne
                                                    </option>
                                                    <option value="female"
                                                            @if($cvpersonal->gender=="female") selected @endif>Mann
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_occupational_status">Yrkesstatus*</label>
                                                <select class="form-control" id="personal_occupational_status"
                                                        name="occupational_status" required>
                                                    <option>Velg..</option>
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
                                                <label for="personal_website">Hjemmeside</label>
                                                <input type="url" class="form-control" id="personal_website"
                                                       name="website" value="{{$cvpersonal->website}}">
                                                <small class="form-text text-muted">Fylles bare ut dersom du har egen
                                                    hjemmeside eller profilside</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="personal_driving_license">Førerkort</label>
                                                <input type="text" class="form-control" id="personal_driving_license"
                                                       name="driving_license" value="{{$cvpersonal->website}}">
                                                <small class="form-text text-muted"> E.g. A, B, C1 or D1E</small>
                                            </div>


                                            <button type="submit" class="dme-btn-outlined-blue float-left">
                                                Lagre endringer
                                            </button>
                                            <a class="dme-btn-outlined-blue float-left ml-2" href="">
                                                <div class="ml-2">Avbryt</div>
                                            </a>
                                        </form>
                                    </div>

                                </div>

                                <div class="col-md-6  mb-4">
                                    <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:22px;">Bilde
                                        <span class="float-right">

                                        <a class="edit-btn" data-toggle="collapse" href="#colapsedata" role="button"
                                           aria-expanded="false" aria-controls="colapsedata">
                                        Endre
                                        </a>

                                        </span>
                                    </h3>
                                    <small class="form-text text-muted pl-4 pr-4 mb-5"> Du har ikke lagret et
                                        bilde til din CV.</small>
                                    <div class="collapse show" id="colapsedata" style="text-align: center">
                                        <form action="#" id="form_profile_picture" enctype="multipart/form-data">
                                            <div class="profile"
                                                 style="padding: 10px; background: #fdfdfd; border: 2px dashed #ddd;max-width: 205px; margin:auto">
                                                <img
                                                    src="@if(isset($cv) && $cv->media!=null){{asset(\App\Helpers\common::getMediaPath($cv->media, '180x200'))}}@else {{asset('public/admin/images/users/1.jpg')}} @endif"
                                                    id="cv_profile_image"
                                                    style="max-width:180px;max-height: 200px; height:200px;" alt="">
                                            </div>
                                            <div class="custom-file" style="max-width: 205px;">
                                                <input type="file" class="custom-file-input" name="cv_profile"
                                                       id="customFile">
                                                <label class="custom-file-label" for="customFile"
                                                       style="text-align: left">Velg Fil</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row row-border education">
                            <div class="col-12 pt-4 ">
                                <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:26px;">Utdanning
                                    <span class="float-right">
                                        <a class="edit-btn" data-toggle="collapse" href="#new_education" role="button"
                                           aria-expanded="false" aria-controls="new_education">Oppdater</a>
                                    </span>
                                </h3>
                                <small class=" font-weight-normal form-text text-muted pl-4 pr-4 pb ">
                                    @if(!isset($cv->educations) || !is_countable($cv->educations) || empty($cv->educations->first()->school))
                                        Ingen utdanning registrert ennå
                                    @endif
                                </small>
                                <div class="collapse" id="new_education" style="margin-top: -40px;">
                                    <div class="table-main">
                                        <form action="{{route('cveducation.store')}}" name="cveducation-form"
                                              id="new_cvexperience-form" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="row form-group mt-3">
                                                <label class="col-md-12">Skol *</label>
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" name="school" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="">Periode fra</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="date" name="period_from" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="">til</label>
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
                                                        Er fortsatt i studiet
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-5">
                                                    <label>Fag</label>
                                                    <select name="subject" class="form-control">
                                                        <option value="">Velg...</option>
                                                        @foreach($subjects as $subject)
                                                            <option value="{{$subject}}">{{$subject}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <label>Fag</label>
                                                    <select name="education_level" class="form-control">
                                                        <option value="">Velg..</option>
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
                                                    <label for="">Grad</label>
                                                    <input type="text" name="degree" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <br>
                                                    <small class="text-muted">Velg det som passer best i nedtrekksfeltet
                                                        og evt. spesifiser grad</small>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Beskrivelse</label>
                                                <textarea name="detail" class="form-control" rows="3"></textarea>
                                            </div>

                                            <button type="submit" class="dme-btn-outlined-blue">Lagre</button>
                                            <a href="#" class="prevent cancel dme-btn-outlined-blue">Avbryt</a></form>
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
                                                      method="POST" enctype="multipart/form-data">
                                                    {{method_field('PUT')}}
                                                    {{ csrf_field() }}
                                                    <div class="row form-group mt-3">
                                                        <label class="col-md-12">Skol *</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" name="school"
                                                                   value="{{$cveducation->school}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="">Periode fra</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="date" name="period_from" class="form-control"
                                                                   value="{{$cveducation->period_from}}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="">til</label>
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
                                                                Er fortsatt i studiet
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
                                                            <label>Utdanningsnivå</label>
                                                            <select name="education_level" class="form-control">
                                                                <option value="">Velg..</option>
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
                                                            <label for="">Grad</label>
                                                            <input type="text" name="degree" class="form-control"
                                                                   value="{{$cveducation->degree}}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <br>
                                                            <small class="text-muted">Velg det som passer best i
                                                                nedtrekksfeltet og evt. spesifiser grad</small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">Beskrivelse</label>
                                                        <textarea name="detail" class="form-control"
                                                                  rows="3">{{$cveducation->detail}}</textarea>
                                                    </div>

                                                    <button type="submit" class="dme-btn-outlined-blue">Lagre</button>
                                                    <a href="#" class="prevent cancel dme-btn-outlined-blue">Avbryt</a>
                                                </form>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                        </div>
                        <div class="row row-border experience">
                            <div class="col-12 pt-4 ">
                                <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:26px;">Erfaring
                                    <span class="float-right">
                                        <a class="edit-btn" data-toggle="collapse" href="#new_experience" role="button"
                                           aria-expanded="false" aria-controls="new_experience">Oppdater</a>
                                    </span>
                                </h3>
                                <small class=" font-weight-normal form-text text-muted pl-4 pr-4 pb ">
                                    @if(!isset($cv->experiences) || !is_countable($cv->experiences) || empty($cv->experiences->first()->company))
                                        Ingen utdannelse er registrert
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
                                                    <label class="">Periode fra</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="date" name="period_from" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="">til</label>
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
                                                        Er fortsatt i stillingen
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="row form-group mt-3">
                                                <label class="col-md-12" for="exampleFormControlInput1">Firma *</label>
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" name="company">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-md-12" for="exampleFormControlInput1">Stillingstittel
                                                    *</label>
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" name="job_title">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Bransje/Sektor *</label>
                                                <select name="industry" class="form-control">
                                                    @foreach($subjects as $subject)
                                                        <option value="{{$subject}}">{{$subject}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Beskriv hva du arbeidet med;
                                                    verktøy, metoder,teknologi etc.</label>
                                                <textarea name="detail" class="form-control" rows="3"></textarea>
                                            </div>

                                            <button type="submit" class="dme-btn-outlined-blue">Lagre</button>
                                            <button class="cancel prevent dme-btn-outlined-blue">Avbryt</button>
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
                                                          onsubmit="jarascript:return confirm('Vil du slette denne opplevelsen?')">
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
                                                            <label class="">Periode fra</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="date" name="period_from" class="form-control"
                                                                   value="{{$cvexperience->period_from}}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="">til</label>
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
                                                                Er fortsatt i stillingen
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group mt-3">
                                                        <label class="col-md-12" for="exampleFormControlInput1">Firma
                                                            *</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" name="company"
                                                                   value="{{$cvexperience->company}}">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-md-12" for="exampleFormControlInput1">Stillingstittel
                                                            *</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" name="job_title"
                                                                   value="{{$cvexperience->job_title}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Bransje/Sektor *</label>
                                                        <select name="industry" class="form-control">
                                                            <option value="">Velg..</option>
                                                            @foreach($subjects as $subject)
                                                                <option value="{{$subject}}"
                                                                        @if($cvexperience->industry==$subject) selected @endif>{{$subject}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">Beskriv hva du arbeidet
                                                            med; verktøy, metoder,teknologi etc.</label>
                                                        <textarea name="detail" class="form-control"
                                                                  rows="3">{{$cvexperience->detail}}</textarea>
                                                    </div>

                                                    <button type="submit" class="dme-btn-outlined-blue">Lagre</button>
                                                    <button class="prevent cancel dme-btn-outlined-blue">Avbryt</button>
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
                                    Nøkkelkompetanse
                                    <span class="float-right">
                                        <a class="edit-btn" data-toggle="collapse" href="#colapednok" role="button"
                                           aria-expanded="false" aria-controls="colapednok">Oppdater</a>
                                    </span>
                                </h3>
                                <div class=" font-weight-normal form-text text-muted pl-4 pr-4 pb ">
                                    @if(empty($cv->key_skills) || empty($cv->other_skills))
                                        Ingen utdannelse er registrert
                                    @else
                                        {{$cv->key_skills}}
                                        <br>
                                        <span
                                            class="font-weight-bold">Annen erfaring, tillitsverv, interesser etc.</span>
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
                                                <label for="exampleFormControlTextarea1">Nøkkelkompetanse</label>
                                                <textarea name="key_skills" class="form-control"
                                                          rows="3">{{$cv->key_skills}}</textarea>
                                                <small>F.eks. "Anestesisykepleier med bred erfaring innen akutt medisin,
                                                    ambulansetransport, sentraloperasjon og dagkirurgi."</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Annen erfaring, tillitsverv,
                                                    interesser etc.</label>
                                                <textarea name="other_skills" class="form-control"
                                                          rows="3">{{$cv->other_skills}}</textarea>
                                            </div>
                                            <button type="submit" class="dme-btn-outlined-blue float-left">
                                                <div class="ml-2">Lagre endringer</div>
                                            </button>
                                            <a class="cancel prevent dme-btn-outlined-blue float-left ml-2" href="">Avbryt</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-border language">
                            <div class="col-12 pt-4 ">
                                <h3 class="text-dark font-weight-normal pl-4 pr-4" style="font-size:26px;">
                                    Language
                                    <span class="float-right">
                                        <a class="edit-btn" data-toggle="collapse" href="#languages" role="button"
                                           aria-expanded="false" aria-controls="languages">Oppdater</a>
                                    </span>
                                </h3>
                                <small class=" font-weight-normal form-text text-muted pl-4 pr-4 mb-5">
                                    <?php $selected_langs = $cv->languages;?>
                                    @if(!isset($cv->languages) || empty($cv->languages) || !is_countable($cv->languages) || count($cv->languages)<1)
                                        Du har ikke registrert noen språk ennå.
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
                                                <label for="source_languages">Velg språk</label>
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
                                                <label for="selected_languages">Valgte språk</label>
                                                <select id="selected_languages" name="langs[]" class="form-control"
                                                        size="10"
                                                        multiple="multiple">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-5">
                                                <button class="prevent btn dme-btn-outlined-blue float-right"
                                                        id="add_language"> legg til <span
                                                        class="fa fa-arrow-right"></span></button>
                                            </div>
                                            <div class="col-md-1 p-3"></div>
                                            <div class="col-md-5">
                                                <button class="prevent btn dme-btn-outlined-blue float-left"
                                                        id="remove_language"><span class="fa fa-arrow-left"></span> ta
                                                    bort
                                                </button>
                                            </div>
                                            <div class="col-md-1 p-3"></div>
                                            <div class="col-md-12 p-3 pr-5">
                                                <button type="submit"
                                                        class="m-2 float-right btn dme-btn-outlined-blue bg-maroon color-white radius-8">
                                                    Lagre
                                                </button>
                                                <a class="cancel prevent m-2 float-right btn dme-btn-outlined-blue">Avbryt</a>
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
                                    Ønsker for neste jobb
                                    <span class="float-right">
                                        <a class="edit-btn" data-toggle="collapse" href="#preferences" role="button"
                                           aria-expanded="false" aria-controls="preferences">Oppdater</a>
                                    </span>
                                </h3>
                                <small class=" font-weight-normal form-text text-muted pl-4 pr-4 mb-5">
                                    @if(!isset($cv->preference) || (empty($cv->preference->prospective) && empty($cv->preference->job_type)))
                                        Du har ikke registrert noen Ønsker ennå.
                                    @endif
                                </small>
                                <div class="collapse bg-maroon-lighter p-3" id="preferences">
                                    <form action="{{route('update_preference', compact('cv_id'))}}"
                                          id="form_preferences" name="form_preferences" method="post">
                                        {{csrf_field()}}
                                        <div class="row form-group mt-3">
                                            <div class="col-md-12">
                                                <label for="">Her legger du inn det du ønsker å jobbe med i
                                                    fremtiden</label>
                                                <textarea name="prospective"
                                                          class="form-control">{{$cv->preference->prospective}}</textarea>
                                                <span class="small">F.eks "Jeg ønsker å jobbe med IT-drift og backoffice-relaterte oppgaver. Jeg trives med å sette ting i system, utarbeide rutiner og dokumentere."</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <label for="">Ønsket Jobbtype</label>
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
                                                <h4 class="u-t4">Personalansvar</h4>
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
                                                <h4 class="u-t4">Resultatansvar</h4>
                                                <label for="disclaimer" class="radio-lbl">Ja
                                                    <input type="radio" id="disclaimer" class="disclaimer"
                                                           name="disclaimer" value="yes"
                                                           @if($cv->preference->disclaimer == "yes") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label for="disclaimer1" class="radio-lbl">Flyttevillighet
                                                    <input type="radio" id="disclaimer1" class="disclaimer"
                                                           name="disclaimer" value="irrelevant"
                                                           @if($cv->preference->disclaimer == "irrelevant") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label for="disclaimer2" class="radio-lbl">Nei
                                                    <input type="radio" id="disclaimer2" class="disclaimer"
                                                           name="disclaimer" value="no"
                                                           @if($cv->preference->disclaimer == "no") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <h4 class="u-t4">Personalansvar</h4>
                                                <label for="willingness" class="radio-lbl">Ja
                                                    <input type="radio" id="willingness" class="willingness"
                                                           name="willingness" value="yes"
                                                           @if($cv->preference->willingness == "yes") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label for="willingness1" class="radio-lbl">Uten betydning
                                                    <input type="radio" id="willingness1" class="willingness"
                                                           name="willingness" value="irrelevant"
                                                           @if($cv->preference->willingness == "irrelevant") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label for="willingness2" class="radio-lbl">Nei
                                                    <input type="radio" id="willingness2" class="willingness"
                                                           name="willingness" value="no"
                                                           @if($cv->preference->willingness == "no") checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <label for="travel_days">Reisedøgn inntil pr år</label>
                                                <input type="text" class="form-control" id="travel_days"
                                                       name="travel_days" value="{{$cv->preference->travel_days}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="salary">Lønnsvilkår</label>
                                                <input type="text" id="salary" name="salary" class="form-control"
                                                       value="{{$cv->preference->travel_days}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Oppsigelsestid i dagens jobb</label>
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
                                                    Lagre
                                                </button>
                                                <a href=""
                                                   class="cancel prevent m-2 float-right btn dme-btn-outlined-blue">Avbryt</a>
                                            </div>
                                        </div>
                                    </form>

                                </div>

                                <div class="mhl pl-4 pr-4 mt-3">
                                    <table class="sectioninfo super-condensed border-white w-100">
                                        <tbody>
                                        <tr>
                                            <th class="th_row size1of4" scope="row">Jobbtype</th>
                                            <td id="float-left">{{$cv->preference->job_type}}</td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">Personalansvar</th>
                                            <td id="future-personnel">{{$cv->preference->responsibility}}</td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">Resultatansvar</th>
                                            <td id="future-accountmanager">{{$cv->preference->disclaimer}}</td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">Flyttevillighet</th>
                                            <td id="future-move">{{$cv->preference->willingness}}</td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">Reisedøgn inntil pr år</th>
                                            <td id="future-travel">{{$cv->preference->travel_days}}</td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">Lønnsvilkår</th>
                                            <td id="future-salary">{{$cv->preference->salary}}</td>
                                        </tr>
                                        <tr>
                                            <th class="th_row" scope="row">Oppsigelsestid i dagens jobb</th>
                                            <td id="future-period">{{$cv->preference->termination_notice}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <p class="pt-5 pb-5 pl-4 pr-4 text-dark">CVen din kan bare vises av våre kunder når du har
                            registrert personopplysninger og utdanning eller erfaring.</p>
                        <p class="text-dark pl-4 pr-4">10670303</p>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{route('cv.update', compact('cv'))}}" method="POST">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <div class="inner-tab">
                                <p class="text-dark pb-4">Din CV kan først søkes opp av våre kunder når du har
                                    registrert
                                    personalia og utdanning eller erfaring.</p>
                                <h3 class="text-dark font-weight-normal" style="font-size:22px;">CV-innstillinger</h3>
                                <p class="text-dark pb-4">Her kan du administrere din CV. Husk å alltid holde den
                                    oppdatert
                                    med fersk informasjon. Det øker sjansene for å bli kontaktet av potensielle
                                    arbeidsgivere.</p>
                            </div>

                            <div class="row row-border pb-4" style="border-top:1px solid #ccc">
                                <div class="col-md-4 pt-4"><p class="text-dark ">Din CV er</p></div>
                                <div class="col-md-8"><p class="text-dark ">
                                    </p>
                                    <div class="form-group">
                                        <div class="">
                                            <label class="radio-lbl" for="status1">
                                                <input type="radio" id="status1" name="status"
                                                       value="published" @if($cv->status==="published") checked @endif>Publisert
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="">
                                            <label class="radio-lbl" for="status2">
                                                <input type="radio" id="status2" name="status"
                                                       value="inactive" @if($cv->status==="inactive") checked @endif>Inaktiv
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <p class="text-dark pt-3">Som publisert vil din CV kunne bli søkt opp av
                                            FINN.nos
                                            kunder. Din CV kan først publiseres når du har registrert minst en gyldig
                                            utdanning eller erfaring.</p>
                                    </div>

                                </div>
                            </div>
                            <div class="row row-border pb-4">
                                <div class="col-md-4 pt-4"><p class="text-dark ">Vis personalia</p></div>
                                <div class="col-md-8"><p class="text-dark ">
                                    </p>
                                    <div class="form-group">

                                        <div class="form-check">
                                            <label class="radio-lbl" for="visibility1">
                                                <input type="radio" class="" id="visibility1" name="visibility"
                                                       value="visible" @if($cv->visibility==="visible") checked @endif>Personalia
                                                synlig
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="radio-lbl" for="visibility2">
                                                <input type="radio" class="" id="visibility2" name="visibility"
                                                       value="anonymous"
                                                       @if($cv->visibility==="anonymous") checked @endif>Anonym
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <p class="text-dark pt-3">For profesjonelle rekrutteringsbyråer har du mulighet
                                            til
                                            å tilgjengeliggjøre din kontaktinformasjon, mens for andre bedrifter vil din
                                            CV
                                            fremstå anonymt og bedrifter må forespørre for å få innsyn i din CV. Som
                                            CV-eier
                                            vil du selv avgjøre om du ønsker å gi den bedriften som forespør innsyn i
                                            dine
                                            personlige data.</p>
                                    </div>

                                    <p></p></div>
                            </div>

                            <div class="row row-border ">
                                <div class="col-md-4 pt-2"><p class="text-dark ">Registrert første gang</p></div>
                                <div class="col-md-8 pt-2"><p
                                        class="text-dark ">{{date('d.m.Y', strtotime($cv->user->created_at))}}</p></div>
                            </div>
                            <div class="row row-border ">
                                <div class="col-md-4 pt-2"><p class="text-dark ">Sist oppdatert</p></div>
                                <div class="col-md-8 pt-2"><p
                                        class="text-dark ">{{date('d.m.Y', strtotime($cv->created_at))}}</p></div>
                            </div>
                            <div class="row row-border ">
                                <div class="col-md-4 pt-2"><p class="text-dark ">Din CV-id</p></div>
                                <div class="col-md-8 pt-2"><p class="text-dark ">{{$cv->id}}</p></div>
                            </div>
                            <div class="row row-border">
                                <div class="col-md-4 pt-2"><p class="text-dark ">Utløper</p></div>
                                <div class="col-md-8 pt-2">
                                    <p class="text-dark ">{{date('d.m.Y', strtotime($cv->expiry))}}
                                        <a class="ml-3" href="{{url('my-business/cv/extend')}}">Nye 6 måneder</a>
                                    </p>
                                </div>
                            </div>
                            <div class="row row-border ">
                                <div class="col-md-4 pt-2"><p class="text-dark ">Brukervilkår</p></div>
                                <div class="col-md-8 pt-2"><p class="text-dark "><a href="#">Les vilkår</a></p></div>
                            </div>
                            <div class="btn-group mt-3">
                                <button type="submit" class="dme-btn-outlined-blue float-left"> Lagre</button>
                                <button class="dme-btn-outlined-blue float-left ml-3"> Slett CV</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="inner-tab">
                            <h3 class="text-dark font-weight-normal" style="font-size:22px;">Your inquiries</h3>
                            <p class="text-dark">This is where you manage your inquiries. You may accept or reject
                                these.</p>


                            <div class="mt-5 inquiries-table">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                           href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Unanswered</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                           href="#nav-profile" role="tab" aria-controls="nav-profile"
                                           aria-selected="false">Answered</a>

                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                         aria-labelledby="nav-home-tab">

                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Requested by</th>
                                                <th scope="col">On behalf of</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">12/04/2019</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>Approve</td>
                                                <td><a href="#"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">12/04/2019</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>Approve</td>
                                                <td><a href="#"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">12/04/2019</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>Approve</td>
                                                <td><a href="#"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                         aria-labelledby="nav-profile-tab">


                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Requested by</th>
                                                <th scope="col">On behalf of</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">12/04/2019</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>Approve</td>
                                                <td><a href="#"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">12/04/2019</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>Approve</td>
                                                <td><a href="#"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">12/04/2019</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>Approve</td>
                                                <td><a href="#"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="preview" role="tabpanel" aria-labelledby="preview-tab">
                        <div class="inner-tab">
                            <h3 class="text-dark font-weight-normal" style="font-size:22px;">CV preview</h3>
                            <p class="text-dark">Denne forhåndsvisningen viser hvordan din CV vil fremstå for rekrutteringsbyråer og bedrifter som benytter seg av FINNs CV-database.</p>
                            <div class="row mb-5">
                                <div class="col-md-8">
                                    <div class="btn-group mt-3">
                                        <a class="m-2 dme-btn-outlined-blue float-left"
                                           data-toggle="collapse" href="#open_cv">
                                            Forhåndsvis åpen CV
                                        </a>
                                        <a class="m-2 dme-btn-outlined-blue float-left collapsed"
                                           data-toggle="collapse" href="#personal_cv">
                                            Forhåndsvis anonym CV
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="btn-group mt-3">
                                        <a class="dme-btn-outlined-blue float-left" href="#">
                                            <div class="ml-2">Download as PDF</div>
                                        </a>
                                        <a class="dme-btn-outlined-blue float-left ml-3" href="#">
                                            <div class="ml-2">Print CV</div>
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <p class="pt-3">CV-id: {{$cv->id}}</p>
                            <div class="collapse show" data-toggle="collapse" data-parent="#preview" id="open_cv">
                                <div class="table-main-1">
                                    <div class="row personal">
                                        <div class="col-md-8 pr-4">
                                            <h2 class="u-t2">{{$cv->personal->title}}</h2>
                                            <h3 class="text-dark font-weight-normal pt-4 pb-4 u-t3" style="font-size:22px;">
                                                Personalia</h3>
                                            <table class="w-100">
                                                <tbody>
                                                <tr>
                                                    <th class="th_row" scope="row">Navn</th>
                                                    <td id="cvdetails-name">{{$cv->personal->first_name}} {{$cv->personal->last_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Født</th>
                                                    <td id="cvdetails-birthdate">{{$cv->personal->birthday}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row size1of4" scope="row">Addresse</th>
                                                    <td id="cvdetails-address">{{$cv->personal->address}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Sted</th>
                                                    <td id="cvdetails-postcode">{{$cv->personal->city}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Kjønn</th>
                                                    <td id="cvdetails-gender">{{$cv->personal->gender}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Land</th>
                                                    <td id="cvdetails-country">{{$cv->personal->country}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Telefon</th>
                                                    <td id="cvdetails-phone">{{$cv->personal->tell}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Mobil</th>
                                                    <td id="cvdetails-phone2">{{$cv->personal->mobile}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">E-post</th>
                                                    <td id="cvdetails-email">{{$cv->personal->email}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Hjemmeside</th>
                                                    <td id="cvdetails-homepage">{{$cv->personal->website}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Yrkesstatus</th>
                                                    <td id="cvdetails-employmentstatus">{{$cv->personal->occupational_status}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Førerkort</th>
                                                    <td id="cvdetails-driverslicense">{{$cv->personal->driving_license}}</td>
                                                </tr>
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
                                                <small class="text-dark">Denne CVen mangler bilde.</small>
                                            @endif
                                        </div>
                                    </div>
                                    @if(isset($cv->educations) && is_countable($cv->educations) && !empty($cv->educations->first()->school))
                                        <div class="row education mt-2">
                                            <div class="col-12 pt-4 ">
                                                <h3 class="text-dark font-weight-normal" style="font-size:26px;">
                                                    Utdanning
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
                                                    Erfaring
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
                                                    Språk
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
                                                Ønsker for neste jobb</h3>
                                            <table class="sectioninfo super-condensed border-white w-100">
                                                <tbody>
                                                <tr>
                                                    <th class="th_row size1of4" scope="row">Jobbtype</th>
                                                    <td id="float-left">{{$cv->preference->job_type}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Personalansvar</th>
                                                    <td id="future-personnel">{{$cv->preference->responsibility}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Resultatansvar</th>
                                                    <td id="future-accountmanager">{{$cv->preference->disclaimer}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Flyttevillighet</th>
                                                    <td id="future-move">{{$cv->preference->willingness}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Reisedøgn inntil pr år</th>
                                                    <td id="future-travel">{{$cv->preference->travel_days}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Lønnsvilkår</th>
                                                    <td id="future-salary">{{$cv->preference->salary}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Oppsigelsestid i dagens jobb</th>
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
                                                Personalia</h3>
                                            <table class="w-100">
                                                <tbody>
                                                <tr>
                                                    <th class="th_row" scope="row">Navn</th>
                                                    <td id="cvdetails-name">{{$cv->personal->first_name}} {{$cv->personal->last_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Født</th>
                                                    <td id="cvdetails-birthdate">{{$cv->personal->birthday}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row size1of4" scope="row">Addresse</th>
                                                    <td id="cvdetails-address">{{$cv->personal->address}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Sted</th>
                                                    <td id="cvdetails-postcode">{{$cv->personal->city}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Kjønn</th>
                                                    <td id="cvdetails-gender">{{$cv->personal->gender}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Land</th>
                                                    <td id="cvdetails-country">{{$cv->personal->country}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Yrkesstatus</th>
                                                    <td id="cvdetails-employmentstatus">{{$cv->personal->occupational_status}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Førerkort</th>
                                                    <td id="cvdetails-driverslicense">{{$cv->personal->driving_license}}</td>
                                                </tr>
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
                                                <small class="text-dark">Denne CVen mangler bilde.</small>
                                            @endif
                                        </div>
                                    </div>
                                    @if(isset($cv->educations) && is_countable($cv->educations) && !empty($cv->educations->first()->school))
                                        <div class="row education mt-2">
                                            <div class="col-12 pt-4 ">
                                                <h3 class="text-dark font-weight-normal" style="font-size:26px;">
                                                    Utdanning
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
                                                    Erfaring
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
                                                    Språk
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
                                                Ønsker for neste jobb</h3>
                                            <table class="sectioninfo super-condensed border-white w-100">
                                                <tbody>
                                                <tr>
                                                    <th class="th_row size1of4" scope="row">Jobbtype</th>
                                                    <td id="float-left">{{$cv->preference->job_type}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Personalansvar</th>
                                                    <td id="future-personnel">{{$cv->preference->responsibility}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Resultatansvar</th>
                                                    <td id="future-accountmanager">{{$cv->preference->disclaimer}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Flyttevillighet</th>
                                                    <td id="future-move">{{$cv->preference->willingness}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Reisedøgn inntil pr år</th>
                                                    <td id="future-travel">{{$cv->preference->travel_days}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Lønnsvilkår</th>
                                                    <td id="future-salary">{{$cv->preference->salary}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="th_row" scope="row">Oppsigelsestid i dagens jobb</th>
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
                $('.tab-pane').removeClass('show');
                $('.tab-pane').removeClass('active');
                $('.tab-pane' + hash).addClass('show');
                $('.tab-pane' + hash).addClass('active');
                $('#cv_tabs a').removeClass('active');
                $('#cv_tabs a[href="' + hash + '"]').addClass('active');
            }
        }

        $('#selected_languages').html($('#source_languages').children('option:selected'));
        $(document).ready(function () {
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
        });
    </script>
@endsection
