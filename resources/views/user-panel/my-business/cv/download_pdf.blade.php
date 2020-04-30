<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('main_title')</title>
    <meta charset="UTF-8">
{{--    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('public/mediexpert.css')}}">
    <link rel="stylesheet" href="{{asset('public/mediexpert-mq.css')}}">
</head>
<body>
<div class="printable_cv" id="open_cv" style="padding: 0.5in;">
    <style type="text/css">
        *{
            font-family: Arial, Helvetica, sans-serif;
        }
        .row{
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-md-8 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }
        .table-main {
            padding: 25px 20px 72px;
            background-color: rgba(176, 64, 88, 0.07);
            margin-top: 50px;
            border-radius: 4px;
        }
        .pr-4, .px-4 {
            padding-right: 1.5rem!important;
        }
        .u-t2 {
            font-size: 28px;
            line-height: 34px;
        }
        .col-md-4 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        .row-border {
            border-bottom: 1px solid #ccc;
        }

        tbody th, tbody tr {
            vertical-align: top;
            font-weight: 400;
        }

    </style>
    <span>CV-id: {{$cv->id}}</span>
    <div class="table-main-1">
        <div class="row personal" style="width: 100%;">
            <div class="col-md-8 pr-4">
                <h2 style="font-family: Arial, Helvetica, sans-serif; font-size: 26px;">{{$cv->personal->title}}</h2>
                <h3 style="font-size:24px; font-weight: normal; font-family: Arial, Helvetica, sans-serif; margin-bottom: 5px;">
                    Personalia</h3>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <div class="row personal">
            <div class="col-md-8" style="width:66%;float: left">
                <table class="w-100" style="width:98%;">
                    <tbody>
                    <tr style="border-top: 1px solid #dfe4e8;">
                        <th style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" class="th_row" scope="row">Navn</th>
                        <td style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" id="cvdetails-name">@if(!$anonym_cv_information) {{$cv->personal->first_name}} {{$cv->personal->last_name}} @else Anonym Kandidat @endif</td>
                    </tr>
                    <tr>
                        <th style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" class="th_row" scope="row">Født</th>
                        <td style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" id="cvdetails-birthdate">@if(!$anonym_cv_information) {{$cv->personal && $cv->personal->birthday ? date('d.m.Y',strtotime($cv->personal->birthday)) : ''}} @else {{$cv->personal && $cv->personal->birthday ? date('Y',strtotime($cv->personal->birthday)) : ''}} @endif</td>
                    </tr>
                    @if(!$anonym_cv_information)
                        <tr>
                            <th style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" class="th_row size1of4" scope="row">Adresse</th>
                            <td style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" id="cvdetails-address">{{$cv->personal->address}}</td>
                        </tr>
                    @endif
                    <tr>
                        <th style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" class="th_row" scope="row">Sted</th>
                        <td style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" id="cvdetails-postcode">@if(!$anonym_cv_information) {{$cv->personal->city}} @else Skjetten @endif</td>
                    </tr>
                    <tr>
                        <th style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" class="th_row" scope="row">Kjønn</th>
                        <td style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" id="cvdetails-gender">{{$cv->personal->gender}}</td>
                    </tr>
                    @if($cv->personal->country)
                        <tr>
                            <th style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" class="th_row" scope="row">Land</th>
                            <td style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" id="cvdetails-country">{{$cv->personal->country}}</td>
                        </tr>
                    @endif
                    @if($cv->personal->tell && !$anonym_cv_information)
                        <tr>
                            <th style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" class="th_row" scope="row">Telefon</th>
                            <td style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" id="cvdetails-phone">{{$cv->personal->tell}}</td>
                        </tr>
                    @endif
                    @if($cv->personal->mobile && !$anonym_cv_information)
                        <tr>
                            <th style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" class="th_row" scope="row">Mobil</th>
                            <td style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" id="cvdetails-phone2">{{$cv->personal->mobile}}</td>
                        </tr>
                    @endif
                    @if(!$anonym_cv_information)
                    <tr>
                        <th style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" class="th_row" scope="row">E-post</th>
                        <td style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" id="cvdetails-email">{{$cv->personal->email}}</td>
                    </tr>
                    @endif
                    @if($cv->personal->website && !$anonym_cv_information)
                        <tr>
                            <th style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" class="th_row" scope="row">Hjemmeside</th>
                            <td style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" id="cvdetails-homepage">{{$cv->personal->website}}</td>
                        </tr>
                    @endif
                    @if($cv->personal->occupational_status)
                        <tr>
                            <th style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" class="th_row" scope="row">Yrkesstatus</th>
                            <td style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" id="cvdetails-employmentstatus">{{$cv->personal->occupational_status}}</td>
                        </tr>
                    @endif
                    @if($cv->personal->driving_license)
                        <tr>
                            <th style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" class="th_row" scope="row">Førerkort</th>
                            <td style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" id="cvdetails-driverslicense">{{$cv->personal->driving_license}}</td>
                        </tr>
                    @endif
                    @php
                        $cv_industries = array();
                        if($cv->personal->industries){
                            $cv_industries = json_decode($cv->personal->industries);
                        }
                    @endphp
                    @if(count($cv_industries))
                        <tr>
                            <th style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" class="th_row" scope="row">{{ __('cv.industry') }}</th>
                            <td style="border-top: 1px solid #dfe4e8;padding: 5px; text-align: left" id="cvdetails-driverslicense">
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
            <div class="col-md-4" style="width:34%;float: left;">
                @if(isset($cv) && ($cv->media!=null) && empty($anonym_cv_information))
                    <div class="profile"
                         style="margin-left:10px;padding: 8px; background: #fdfdfd; border: 2px dashed #ddd;height: 200px; width:180px;">
                        <div style="height:200px; width:180px;background-size:contain;background-repeat:no-repeat;background-position:center;background-image: url({{asset(\App\Helpers\common::getMediaPath($cv->media, '180x200'))}})">

                        </div>
                    </div>
                @else
                    <h3 class="text-dark font-weight-normal pt-4" style="font-size:22px;">
                        Bilde
                    </h3>
                    <small class="text-dark">Denne CVen mangler bilde.</small>
                @endif

            </div>
        </div>
        @if(isset($cv->educations) && is_countable($cv->educations) && !empty($cv->educations->first()->school))
            <div class="row education mt-2">
                <div class="col-12 pt-4 ">
                    <h3 style="font-size:24px; font-weight: normal; font-family: Arial, Helvetica, sans-serif; margin-bottom: 5px;">
                        Utdanning
                    </h3>
                </div>
                <?php $cveducations = $cv->educations; ?>
            @foreach($cveducations as $cveducation)
                    <div class="col-md-9">
                        <div class="text-dark font-weight-normal" style="margin-bottom: 10px; min-height: 60px;">
                            <div class="u-t4" >
                                <span class="text-muted font-weight-normal small">{{date('d.m.Y', strtotime($cveducation->period_from))}} - {{date('d.m.Y', strtotime($cveducation->period_to))}}</span>
                                <span class="ml-3 font-weight-normal">{{$cveducation->school}}</span><br>
                                <span>{{$cveducation->degree}}</span>
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
                    <h3 style="font-size:24px; font-weight: normal; font-family: Arial, Helvetica, sans-serif; margin-bottom: 5px;">
                        Erfaring
                    </h3>
                </div>
                <?php $cvexperiences = $cv->experiences; ?>
            @foreach($cvexperiences as $experience)
                    <div class="col-md-9">
                        <div class="text-dark font-weight-normal" style="margin-bottom:10px;min-height: 60px;">
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
                    <h3 style="font-size:24px; font-weight: normal; font-family: Arial, Helvetica, sans-serif; margin-bottom: 5px;">
                        Nøkkelkompetanse
                    </h3>
                    <div style="margin-bottom: 10px;">{{$cv->key_skills}}</div>
                    <div style="font-weight: bold">Annen erfaring, tillitsverv, interesser etc.</div>
                    <div class="">{{$cv->other_skills}}</div>
                </div>
                <div class="col-md-9">
                    <hr>
                </div>
                <div class="col-md-3"></div>
            </div>
        @endif
        @if(isset($cv->languages) && !empty($cv->languages) && $cv->languages->count())
            <div class="row languages mt-1">
                <div class="col-12 pt-4 ">
                    <h3 style="font-size:24px; font-weight: normal; font-family: Arial, Helvetica, sans-serif; margin-bottom: 5px;">
                        Språk
                    </h3>
                    <?php $cvlanguages = $cv->languages; ?>
                @foreach($cvlanguages as $language)
                        <span>{{$language->name}}</span>
                    @endforeach
                </div>
                <div class="col-md-9">
                    <hr>
                </div>
            </div>
        @endif
        @if($cv->preference && $cv->preference->job_type)
            <div class="row preferences mt-1">
                <div class="col-12">
                    <h3 style="font-size:24px; font-weight: normal; font-family: Arial, Helvetica, sans-serif; margin-bottom: 5px;">Ønsker for neste jobb</h3>
                    <table class="sectioninfo super-condensed border-white w-100">
                        <tbody>
                        @if($cv->preference->job_type)
                            <tr>
                                <th style="border-bottom: 1px solid #bbbbbb;width:40%;padding: 5px; text-align: left;" class="th_row size1of4" scope="row">Jobbtype</th>
                                <td style="border-bottom: 1px solid #bbbbbb;width:60%;padding: 5px; text-align: left;" id="float-left">{{$cv->preference->job_type}}</td>
                            </tr>
                        @endif
                        @if($cv->preference->responsibilit)
                            <tr>
                                <th style="border-bottom: 1px solid #bbbbbb;width:40%;padding: 5px; text-align: left;" class="th_row" scope="row">Personalansvar</th>
                                <td style="border-bottom: 1px solid #bbbbbb;width:60%;padding: 5px; text-align: left;" id="future-personnel">{{$cv->preference->responsibility}}</td>
                            </tr>
                        @endif
                        @if($cv->preference->disclaimer)
                            <tr>
                                <th style="border-bottom: 1px solid #bbbbbb;width:40%;padding: 5px; text-align: left;" class="th_row" scope="row">Resultatansvar</th>
                                <td style="border-bottom: 1px solid #bbbbbb;width:60%;padding: 5px; text-align: left;" id="future-accountmanager">{{$cv->preference->disclaimer}}</td>
                            </tr>
                        @endif
                        @if($cv->preference->willingness)
                            <tr>
                                <th style="border-bottom: 1px solid #bbbbbb;width:40%;padding: 5px; text-align: left;" class="th_row" scope="row">Flyttevillighet</th>
                                <td style="border-bottom: 1px solid #bbbbbb;width:60%;padding: 5px; text-align: left;" id="future-move">{{$cv->preference->willingness}}</td>
                            </tr>
                        @endif
                        @if($cv->preference->travel_days)
                            <tr>
                                <th style="border-bottom: 1px solid #bbbbbb;width:40%;padding: 5px; text-align: left;" class="th_row" scope="row">Reisedøgn inntil pr år</th>
                                <td style="border-bottom: 1px solid #bbbbbb;width:60%;padding: 5px; text-align: left;" id="future-travel">{{$cv->preference->travel_days}}</td>
                            </tr>
                        @endif
                        @if($cv->preference->salary)
                            <tr>
                                <th style="border-bottom: 1px solid #bbbbbb;width:40%;padding: 5px; text-align: left;" class="th_row" scope="row">Lønnsvilkår</th>
                                <td style="border-bottom: 1px solid #bbbbbb;width:60%;padding: 5px; text-align: left;" id="future-salary">{{$cv->preference->salary}}</td>
                            </tr>
                        @endif
                        @if($cv->preference->termination_notice)
                            <tr>
                                <th style="border-bottom: 1px solid #bbbbbb;width:40%;padding: 5px; text-align: left;" class="th_row" scope="row">Oppsigelsestid i dagens jobb</th>
                                <td style="border-bottom: 1px solid #bbbbbb;width:60%;padding: 5px; text-align: left;" id="future-period">{{$cv->preference->termination_notice}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
<script src="{{asset('public/mediexpert.js')}}"></script>
<script src="{{asset('public/js/utils.js')}}"></script>
<script src="{{asset('public/js/spin.min.js')}}"></script>
<script src="{{asset('public/js/ladda.min.js')}}"></script>
</body>
</html>
