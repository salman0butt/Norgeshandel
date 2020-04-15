@section('style')

<link rel="stylesheet" href="{{asset('public/css/bootstrap-fileinput.css')}}">

<!-- Dropzone style files -->
<link rel="stylesheet" href="{{asset('public/dropzone/plugins.min.css')}}">
<link rel="stylesheet" href="{{asset('public/dropzone/dropzone.min.css')}}">
<link rel="stylesheet" href="{{asset('public/dropzone/basic.min.css')}}">

@endsection

@section('page_content')
    @php
        $job_status = '';
        if(Request::is('jobs/*/edit')){
            if($job && $job->ad){
                $job_status = $job->ad->status;
            }
        }else if(Request::is('complete/job/*')){
            $job_status = 'saved';
        }
    @endphp
    <input type="hidden" class="ad_status" value="{{$job_status}}">

<?php
    $job_fun = "";
    $ind = "";

//    $countries = countries();
    $leadership_category = \App\Taxonomy::where('slug', 'leadership_category')->first();
    $leadership_categories = $leadership_category->terms;
    $commitment_type = \App\Taxonomy::where('slug', 'commitment_type')->first();
    $commitment_types = $commitment_type->terms;
    $country = \App\Taxonomy::where('slug', 'country')->first();
    $countries = $country->terms;
    $industry = \App\Taxonomy::where('slug', 'industry')->first();
    $industries = $industry->terms;
    $job_function = \App\Taxonomy::where('slug', 'job_function')->first();
    $job_functions = $job_function->terms;
    $sector = \App\Taxonomy::where('slug', 'sector')->first();
    $sectors = $sector->terms;
    //    $arr = ["id" => null,"name" => null,"title" => null,"job_type" => null,"slug" => null,"positions" => null,"commitment_type" => null,"sector" => null,"keywords" => null,"description" => null,"deadline" => null,"accession" => null,"emp_name" => null,"emp_company_information" => null,"emp_website" => null,"emp_facebook" => null,"emp_linkedin" => null,"emp_twitter" => null,"country" => null,"zip" => null,"address" => null,"workplace_video" => null,"app_receive_by" => null,"app_link_to_receive" => null,"app_email_to_receive" => null,"app_contact" => null,"app_contact_title" => null,"app_mobile" => null,"app_phone" => null,"app_email" => null,"app_linkedin" => null,"app_twitter" => null,"ad_id" => null,"user_id" => null,"created_at" => null,"updated_at" => null]
    $obj_job = new \App\Admin\Jobs\Job();
    if(isset($job)){
        $obj_job = $job;
    }
    ?>

<form action="#" name="job-form" id="job-form" method="POST" @if(Auth::user()->roles->first()->name != "company") class="dropzone addMorePics p-0" @endif
    data-action="@if(Request::is('jobs/*/edit') || Request::is('complete/job/*')){{route('jobs.update', $job->id)}}
    @else {{route('jobs.store')}} @endif" enctype="multipart/form-data" data-append_input='yes'>
    {{ csrf_field() }}
 @if(Request::is('jobs/*/edit') || Request::is('complete/job/*'))
   @method('PATCH')
  @endif

    <input type="hidden" name="upload_dropzone_images_type" value="job_temp_images">
    <input type="hidden" name="media_position" class="media_position">
    <input type="hidden" name="deleted_media" class="deleted_media">

    <input type="hidden" name="ad_id" id="ad_id" value="{{isset($obj_job->ad)?$obj_job->ad->id:""}}">
    <input type="hidden" name="job_id" id="job_id" value="{{isset($obj_job->id)?$obj_job->id:""}}">
    <input type="hidden" id="zip_city" name="zip_city" value="{{ (isset($obj_job->zip_city) ? $obj_job->zip_city : '') }}">
    <div class="container p-3 pt-4 bg-white mt-5 shadow-10">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-muted pl-3 pr-3">{{__('About the position')}}</h4>
                <div class="pl-3">
        {{-- @if ($message = Session::get('success'))
        <script>
        $(function(){
            notify("success","Jobben er lagt til");
        });
        
        </script>
        @endif --}}
                    {{-- <div class="notice"></div> --}}
                    <!--                            full input-->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-10 ">
                                <input name="job_type" id="job_type" type="hidden" value="{{$job_type}}"
                                    class="form-control dme-form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="name" class="col-md-2 u-t5">{{__('Ad Headline')}}</label>
                            <div class="col-sm-10 ">
                                <input name="name" value="{{$obj_job->name}}" id="name" type="text"
                                    class="form-control dme-form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label for="title" class="col-md-2 u-t5">{{__('Job Title')}}</label>
                            <div class="col-sm-6 ">
                                <input name="title" value="{{$obj_job->title}}" id="title" type="text"
                                    class="form-control dme-form-control" required>
                            </div>
                            <label for="positions" class="col-md-2 u-t5">{{__('Number of positions')}}</label>
                            <div class="col-sm-2 ">
                                <input name="positions" value="{{$obj_job->positions}}" id="positions" type="text"
                                    class="form-control dme-form-control" required>
                            </div>
                            <div class="col-sm-8">
                            </div>
                        </div>
                    </div>
                    <!--                            selection-->
                    <div class="form-group">
                        <div class="row">
                            <label for="commitment_type" class="col-md-2 u-t5">{{__('Commitment type')}}</label>
                            <div class="col-sm-4 ">
                                <select id="commitment_type" name="commitment_type"
                                    class="form-control dme-form-control" data-selector="" required>
                                    @foreach($commitment_types as $commitment_type)
                                        <option value="{{$commitment_type['name']}}" {{$obj_job->commitment_type == $commitment_type['name'] ? 'selected' : ''}}>{{$commitment_type['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="sector" class="col-md-2 u-t5">{{__('Sector')}}</label>
                            <div class="col-sm-4 ">
                                <select id="sector" name="sector" class="form-control dme-form-control" data-selector=""
                                    required>
                                    @foreach($sectors as $sect)
                                    <option value="{{$sect->name}}" {{$sect->name==$obj_job->sector ? "selected" : ""}}>
                                        {{$sect->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--                            selection-->
                    <div class="form-group">
                        <div class="row">
                            <label for="industry" class="col-md-2 u-t5">{{__('Industry')}}</label>
                            <div class="col-sm-4 ">
                                <select name="industry" id="industry" data-input-name="industry"
                                    class="form-control dme-form-control" data-max-selections="3" required>
                                    @foreach($industries as $industry)
                                    <option value="{{$industry->name}}" {{$obj_job->industry == $industry->name ? 'selected' : ''}}>{{$industry->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="job_function" class="col-md-2 u-t5">{{__('Job Function')}}</label>
                            <div class="col-sm-4 ">
                                <select name="job_function" id="job_function" data-input-name="occupation"
                                    class="form-control dme-form-control" data-max-selections="3" required>
                                    @foreach($job_functions as $job_function)
                                    <option value="{{$job_function->name}}" {{$obj_job->job_function == $job_function->name ? 'selected' : ''}}>{{$job_function->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--                            full input-->
                    @if(isset($job_type) && $job_type=="management")
                    <div class="form-group">
                        <div class="row">
                            <label for="leadership_category" class="col-md-2 u-t5">Lederkategori</label>
                            <div class="col-sm-10 ">
                                <select name="leadership_category" id="leadership_category"
                                    data-input-name="leadership_category" class="form-control dme-form-control">
                                    @foreach($leadership_categories as $leadership_category)
                                    <option value="{{$leadership_category->name}}" {{$obj_job->leadership_category == $leadership_category->name ? 'selected' : ''}}>{{$leadership_category->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!--                            full input-->
                    <div class="form-group">
                        <div class="row">
                            <label for="keywords" class="col-md-2 u-t5">{{__('Keywords (optional)')}}</label>
                            <div class="col-sm-10 ">
                                <input name="keywords" value="{{$obj_job->keywords}}" id="keywords" type="text"
                                    class="form-control dme-form-control">

                            </div>
                        </div>
                    </div>
                    <!--                            text area-->
                    <div class="form-group">
                        <div class="row">
                            <label for="description" class="col-md-2 u-t5">{{__('Job description (optional)')}}</label>
                            <div class="col-sm-10 ">
                                <textarea name="description" class="form-control dme-form-control description"
                                    id="description" cols="30" rows="10">{{$obj_job->description}}</textarea>

                            </div>
                        </div>
                    </div>
                    <!--                            selection-->
                    <div class="form-group">
                        <div class="row">
                            <label for="deadline_type" class="col-md-2 u-t5">{{__('Deadline')}}</label>
                            <div class="col-sm-4 ">
                                <select name="deadline_type" id="deadline_type" class="form-control dme-form-control"
                                    required>
                                    <option @if(empty($obj_job->deadline)) selected
                                        @endif value="Soonest">{{__('Soonest')}}</option>
                                    <option @if(!empty($obj_job->deadline)) selected @endif>{{__('Specify date')}}
                                    </option>
                                </select>
                                <input type="date" name="deadline" value="{{$obj_job->deadline}}" id="deadline"
                                    class="form-control dme-form-control"
                                    style=" @if(empty($obj_job->deadline)) display:none; @endif">
                            </div>
                            <label for="accession" class="col-md-2 u-t5">{{__('Accession (optional)')}}</label>
                            <div class="col-sm-4 ">
                                <input name="accession" value="{{$obj_job->accession}}" id="accession" type="date"
                                    class="form-control dme-form-control">
                            </div>
                            <div class="col-md-6 offset-md-3">
                                <hr class="p-0 mb-0">
                            </div>
                        </div>
                    </div>
                    <!--                            full input-->
                    {{--employer part--}}
                    <h4 class="text-muted pt-2">{{__('About the employer')}}</h4>
                    {{--{{dd(Auth::user()->roles->first()->name)}}--}}
                    @if(Auth::user()->roles->first()->name=="company")
                        <div class="form-group">
                            <div class="row">
                                <label for="company_id" class="col-md-2 u-t5">{{__('Select Your Company')}}</label>
                                <div class="col-sm-10 ">
                                    <select name="company_id" id="company_id" class="form-control dme-form-control">
                                        <option value="">{{__('Select')}}</option>
                                        @if(is_countable(Auth::user()->job_companies) &&
                                        count(Auth::user()->job_companies)>0)
                                        @foreach(Auth::user()->job_companies as $company)
                                        <option value="{{$company->id}}">{{$company->emp_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <div class="row">
                                <label for="emp_name" class="col-md-2 u-t5">{{__('Employer')}}</label>
                                <div class="col-sm-10 ">
                                    <input name="emp_name" value="{{$obj_job->emp_name}}" id="emp_name" type="text"
                                        class="form-control dme-form-control" required>
                                </div>
                            </div>
                        </div>
                        <!--                            text area-->
                        <div class="form-group">
                            <div class="row">
                                <label for="emp_company_information"
                                    class="col-md-2 u-t5">{{__('Company Information (optional)')}}</label>
                                <div class="col-sm-10 ">
                                    <textarea name="emp_company_information"
                                        class="form-control dme-form-control emp_company_information"
                                        id="emp_company_information" cols="30"
                                        rows="10">{{$obj_job->emp_company_information}}</textarea>
                                </div>
                            </div>
                        </div>
                        <!--                            full input-->
                        <div class="form-group">
                            <div class="row">
                                <label for="emp_website" class="col-md-2 u-t5">{{__('Website (optional)')}}</label>
                                <div class="col-sm-10 ">
                                    <input name="emp_website" value="{{$obj_job->emp_website}}" id="emp_website" type="text"
                                        class="form-control dme-form-control url_http" placeholder="firmanavn.no">
                                </div>
                            </div>
                        </div>
                        <!--                            full input-->
                        <div class="form-group">
                            <div class="row">
                                <label for="emp_facebook"
                                    class="col-md-2 u-t5">{{__('Employer on Facebook (optional)')}}</label>
                                <div class="col-sm-10 ">
                                    <input name="emp_facebook" value="{{$obj_job->emp_facebook}}" id="emp_facebook"
                                        type="text" class="form-control dme-form-control url_http"
                                        placeholder="facebook.com/firmanavn">
                                </div>
                            </div>
                        </div>
                        <!--                            full input-->
                        <div class="form-group">
                            <div class="row">
                                <label for="emp_linkedin"
                                    class="col-md-2 u-t5">{{__('Employer on LinkedIn (optional)')}}</label>
                                <div class="col-sm-10 ">
                                    <input name="emp_linkedin" value="{{$obj_job->emp_linkedin}}" id="emp_linkedin"
                                        type="text" class="form-control dme-form-control url_http"
                                        placeholder="linkedin.com/company/firmanavn">
                                </div>
                            </div>
                        </div>
                        <!--                            full input-->
                        <div class="form-group">
                            <div class="row">
                                <label for="emp_twitter"
                                    class="col-md-2 u-t5">{{__('Employer on Twitter  (optional)')}}</label>
                                <div class="col-sm-10 ">
                                    <input name="emp_twitter" value="{{$obj_job->emp_twitter}}" id="emp_twitter" type="text"
                                        class="form-control dme-form-control" placeholder="@firmanavn">
                                </div>
                            </div>
                        </div>
                        <!--                            selection-->
                        <div class="form-group">
                            <div class="row">
                                <label for="country" class="col-md-2 u-t5">{{__('Land')}}</label>
                                <div class="col-sm-4 ">
                                    <select class="form-control dme-form-control" id="country" name="country">
                                        @php
                                            $country = "Norway";
                                            if($obj_job->country){
                                                $country = $obj_job->country;
                                            }
                                        @endphp
                                        @foreach($countries as $ctry)
                                        <option value="{{$ctry['name']}}" {{$country == $ctry['name'] ? 'selected' : ''}}>{{$ctry['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="zip" class="col-md-2 u-t5">{{__('zip code')}}</label>
                                <div class="col-sm-4 ">
                                    <input name="zip" id="zip" value="{{$obj_job->zip}}" type="text"
                                        class="form-control dme-form-control zip_code">
                                    <span id="zip_code_city_name">{{ (isset($obj_job->zip_city) ? strtoupper($obj_job->zip_city) : '')
                      }}</span>
                                </div>
                                <input type="hidden" id="old_zip" value="{{ (isset($obj_job->zip) ? $obj_job->zip : '') }}">

                            </div>
                        </div>
                        <!--                            full input-->
                        <div class="form-group">
                            <div class="row">
                                <label for="address" class="col-md-2 u-t5">{{__('Street address  (optional)')}}</label>
                                <div class="col-sm-10 ">
                                    <input name="address" id="address" type="text" class="form-control dme-form-control"
                                        value="{{@$obj_job->address}}">

                                </div>
                            </div>
                        </div>
                        <!--                            button-->
                        <div class="form-group">
                            <div class="row">
                                <label for="job_gallery" class="col-md-2 u-t5">{{__('Company logo  (optional)')}}</label>
                                <div class="col-sm-4 ">
                                    @php $single_image_obj = $obj_job; $file_upload_name = 'company_logo'; @endphp
                                    @include('user-panel.partials.upload-single-image',compact('single_image_obj'))
                                    {{----}}
                                    {{--<input type="file" name="company_logo" id="company_logo" class=""--}}
                                    {{--value="Select logo">--}}
                                </div>
                                {{--<label for="job_gallery"--}}
                                {{--class="col-md-2 u-t5">{{__('Workplace photos  (optional)')}}</label>--}}
                                {{--<div class="col-sm-4 ">--}}
                                {{--<input type="file" name="company_gallery[]" id="job_gallery" class="" multiple>--}}
                                {{--</div>--}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label for="address" class="col-md-2 u-t5">{{__('Workplace (optional)')}}</label>
                                <div class="col-sm-10 ">
                                    @php $dropzone_img_obj = $obj_job; @endphp
                                    @include('user-panel.partials.dropzone',compact('dropzone_img_obj'))

                                </div>
                            </div>
                        </div>

                        <!--                            full input-->
                        <div class="form-group">
                            <div class="row">
                                <label for="workplace_video"
                                    class="col-md-2 u-t5">{{__('Workplace video  (optional)')}}</label>
                                <div class="col-sm-10 ">
                                    <input name="workplace_video" id="workplace_video" type="text"
                                        class="form-control dme-form-control url_http" value="{{@$obj_job->workplace_video}}">
                                    <span class="u-t5">Youtube link.</span>
                                </div>
                                <div class="col-md-6 offset-md-3">
                                    <hr class="p-0 mb-0">
                                </div>
                            </div>
                        </div>
                    @endif
                    {{--end employer part--}}

                    <h4 class="text-muted pt-3">{{__('Application Management')}}</h4>
                    <!--                            selection-->
                    <div class="form-group">
                        <div class="row">
                            <label for="app_receive_by" class="col-md-2 u-t5">{{__('Receive applications via')}}</label>
                            <div class="col-sm-4">
                                <select class="form-control dme-form-control" id="app_receive_by" name="app_receive_by"
                                    data-selector="">
                                    <option value="url" {{$obj_job && $obj_job->app_receive_by == 'url' ? 'selected' : ''}}>Eget
                                        søknadsskjema</option>
                                    <option value="email" {{$obj_job && $obj_job->app_receive_by == 'email' ? 'selected' : ''}}>
                                        NorgesHandel Søknadsskjema</option>
                                </select>
                            </div>
                            <label for="app_link_to_receive"
                                   class="col-md-2 u-t5 apply_link {{$obj_job && $obj_job->app_receive_by == 'email' ? 'd-none' : ''}}">{{__('Link to application form')}} (valgfritt)</label>
                            <div class="col-sm-4 apply_link {{$obj_job && $obj_job->app_receive_by == 'email' ? 'd-none' : ''}}">
                                <input type="text" name="app_link_to_receive" id="app_link_to_receive"
                                       class="form-control dme-form-control url_http " value="{{@$obj_job->app_link_to_receive}}" required>

                            </div>
                            {{--<div class="col-md-10 offset-md-2">--}}
                                {{--<span class="u-t5">{{__('Du får beskjed på e-post hver gang du mottar en ny--}}
{{--søknad og får oversikt her på Norgeshandel.')}}</span>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <!--                            full input-->
                    <div class="form-group">
                        <div class="row">
                            <label for="app_contact_title"
                                   class="col-md-2 u-t5">{{__('Contact person')}}</label>
                            <div class="col-sm-10 ">
                                <input name="app_contact_title" id="app_contact_title" type="text"
                                       value="{{@$obj_job->app_contact_title}}" class="form-control dme-form-control">

                            </div>
                        </div>
                    </div>
                    <!--                            full input-->
                    <div class="form-group">
                        <div class="row">
                            <label for="app_email_to_receive"
                                class="col-md-2 u-t5">{{__('Email to receive notification')}}</label>
                            <div class="col-sm-4 ">
                                <input name="app_email_to_receive" id="app_email_to_receive" type="text"
                                    class="form-control dme-form-control" value="{{@$obj_job->app_email_to_receive}}">
                            </div>
                            <label for="app_contact" class="col-md-2 u-t5">{{__('job Title')}}</label>
                            <div class="col-sm-4 ">
                                <input name="app_contact" id="app_contact" type="text"
                                    class="form-control dme-form-control" value="{{@$obj_job->app_contact}}">
                            </div>
                        </div>
                    </div>

                    <!--                            small input-->
                    <div class="form-group">
                        <div class="row">
                            <label for="app_mobile" class="col-md-2 u-t5">{{__('Mobile  (optional)')}}</label>
                            <div class="col-sm-4 ">
                                <input name="app_mobile" id="phone" type="tel" class="form-control dme-form-control"
                                    value="{{@$obj_job->app_mobile}}"><br>
                                <span id="valid-msg" class="hide"></span>
                                <span id="error-msg" class="hide"></span>
                            </div>
                            <label for="app_phone" class="col-md-2 u-t5">{{__('Phone  (optional)')}}</label>
                            <div class="col-sm-4 ">
                                <input name="app_phone" id="phone" type="tel" class="form-control dme-form-control"
                                    value="{{@$obj_job->app_phone}}">
                                <span id="valid-msg" class="hide"></span>
                                <span id="error-msg" class="hide"></span>
                            </div>
                        </div>
                    </div>
                    <!--                            full input-->
                    <div class="form-group">
                        <div class="row">
                            <label for="app_email" class="col-md-2 u-t5">{{__('Email')}}</label>
                            <div class="col-sm-10 ">
                                <input name="app_email" id="app_email" type="text" class="form-control dme-form-control"
                                    value="{{@$obj_job->app_email}}">
                            </div>
                        </div>
                    </div>
                    <!--                            full input-->
                    <div class="form-group">
                        <div class="row">
                            <label for="app_linkedin" class="col-md-2 u-t5">{{__('LinkedIn  (optional)')}}</label>
                            <div class="col-sm-10 ">
                                <input name="app_linkedin" id="app_linkedin" type="text"
                                    class="form-control dme-form-control url_http" placeholder="linkedin.com/in/kontaktperson"
                                    value="{{@$obj_job->app_linkedin}}">
                            </div>
                        </div>
                    </div>
                    <!--                            full input-->
                    <div class="form-group">
                        <div class="row">
                            <label for="app_twitter" class="col-md-2 u-t5">{{__('Twitter  (optional)')}}</label>
                            <div class="col-sm-10 ">
                                <input name="app_twitter" id="app_twitter" type="text"
                                    class="form-control dme-form-control" placeholder="@kontaktperson"
                                    value="{{@$obj_job->app_twitter}}">
                            </div>
                        </div>
                    </div>

                    <hr>
            <input type="hidden" name="click_button" class="click_button" value="no">

                    {{-- <input type="submit" class="dme-btn-outlined-blue mb-3 col-12" id="publiserannonsen"
                        value="@if(Request::is('jobs/*/edit'))  Oppdater annonsen @else Publiser annonsen! @endif"> --}}
            <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" id="publiserannonsen"
                class="dme-btn-outlined-blue mb-3 col-12 ladda-button" value="this is button" name="submit-button"><span class="ladda-label">@if(Request::is('jobs/*/edit'))  Oppdater annonsen @else Publiser annonsen! @endif</span></button>
                    {{--                        <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" class="btn btn-primary mb-3 col-12 ladda-button" id="publiserannonsen" data-style="expand-left"><span class="ladda-label">Publiser annonsen!</span></button>--}}

                    {{--<p class="u-t5 text-center">By moving forward, the <a href="#">rules for advertising</a>are--}}
                        {{--also accepted</p>--}}


                </div>
            </div>
        </div>
    </div>

</form>
@endsection

@section('script')

    <script type="text/javascript">
        function readURL(input, element) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(element).css('background-image', 'url(' + e.target.result + ')');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function (e) {

               $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

           /* $('#job-form input, #job-form select').blur(function (e) {
                // $('#description').text(tinyMCE.get("description").getContent());
                // $('#emp_company_information').text(tinyMCE.get("emp_company_information").getContent());

                var zip_code = $('.zip_code').val();
                var old_zip = $('#old_zip').val();

                if (zip_code) {
                    if (old_zip != zip_code) {
                        find_zipcode_city(zip_code);
                    }
                }

                var postal = $('.zip_code').val();
                $('#old_zip').attr('value',postal);

                var link = '{{url('jobs/update_dummy')}}';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var myform = document.getElementById("job-form");
                var fd = new FormData(myform);
                if($('.input_type_file .dz-remove').attr('id')){
                    fd.delete('company_logo');
                }

                    $.ajax({
                        url: link,
                        type: "POST",
                        data: fd,//$('#job-form').serialize(),
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function (response) {
                                console.log('gfhf');
                            // var resp = JSON.parse(response);
                            if(response.company_logo_id){
                                $('.input_type_file .dz-remove').attr('id',response.company_logo_id);
                            }

                            if ($('#ad_id').val().length < 1) {
                                //console.log(resp.job_id);
                                notify("info","Jobben ble lagret!");

                                $('#job_id').val(response.job_id);
                                $('#ad_id').val(response.ad_id);
                            }
                        }

                        //document.getElementById("contact_us").reset();
                    });
            
            });*/

        //new function starts here
        function record_store_ajax_request(event, this_obj) {
           if(event == 'click'){
               if(! $('#job-form').valid()) return false;
           }
            if (event == 'change') {
                var zip_code = $('.zip_code').val();
                var old_zip = $('#old_zip').val();
                if (zip_code) {
                    if (old_zip != zip_code) {
                        find_zipcode_city(zip_code);
                    }
                }
                @if(Request::is('jobs/*/edit') || Request::is('complete/job/*'))
                    var link = '{{url('jobs/update_dummy')}}';
                @endif
            } else {
                @if(Request::is('complete/job/*'))
                    var link = '{{url('jobs/store')}}';
                @elseif (Request::is('jobs/*/edit'))
                    var link = '{{url('jobs/update/'.$obj_job->id)}}';
                @endif
            }
             

          $("input ~ span,select ~ span").each(function (index) {
                $(".error-span").html('');
                $("input, select").removeClass("error-input");
            });

            var myform = document.getElementById("job-form");
            var fd = new FormData(myform);
            if($('.input_type_file .dz-remove').attr('id')){
                fd.delete('company_logo');
            }
            console.log(link);
               var l = Ladda.create(this_obj);
            l.start();
            $.ajax({
                url: link,
                type: "POST",
                data: fd,//$('#job-form').serialize(),
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (response) {
                    // var resp = JSON.parse(response);
                    if(response.company_logo_id){
                        $('.input_type_file .dz-remove').attr('id',response.company_logo_id);
                    }
                    if (event == 'change') {
                       notify("info","Annonsen din er lagret");
                   }else if(event == 'click'){
                        $('.deleted_media').val('');
                        $('.media_position').val('');
                        $('.click_button').val('no');
                        $('.ad_status').val(response.status);
                        var message = 'Annonsen din er publisert';
                        if(response.message){
                            message = response.message;
                        }
                        notify("success",message);
                   }

                    if ($('#ad_id').val().length < 1) {
                        $('#job_id').val(response.job_id);
                        $('#ad_id').val(response.ad_id);
                    }
                },
                error: function (jqXhr, json, errorThrown) { // this are default for ajax errors
                    var errors = jqXhr.responseJSON;
                    //console.log(errors.errors);
                       notify("error","noe gikk galt!");
                      /* if (isEmpty(errors.errors)) {
                      notify("error","noe gikk galt!");
                        return false;
                    }
                    if (event == 'change') {
                     notify("error","noe gikk galt!");
                    }else {
                        // var html="<ul>";
                     $.each(errors.errors, function (index, value) {
                            //console.log(value);
                            $("." + index).html(value);
                            $("input[name='" + index + "'],select[name='" + index + "']")
                                .addClass("error-input");
                        });

                    }*/
                },
            }).always(function () {
                l.stop();
            });
            return false;
        }

        $("input:not(input[type=date]),textarea").on('change', function (e) {
            e.preventDefault();
            if(! $(this).valid()) return false;

            var ad_status = $('.ad_status').val();
            if(ad_status == 'saved'){
                record_store_ajax_request('change', (this));
            }else{
                var zip_code = $('.zip_code').val();
                var old_zip = $('#old_zip').val();

                if (zip_code) {
                    if (old_zip != zip_code) {
                        find_zipcode_city(zip_code);
                    }
                }
            }

            var postal = $('.zip_code').val();
            $('#old_zip').attr('value',postal);
        });

        //click button update
        $("#publiserannonsen").click(function (e) {
            e.preventDefault();
            $('.click_button').val('yes');
            record_store_ajax_request('click', (this));
        });
        


         //new function ends here
        });

        $(document).on('change', '#app_receive_by', function (e) {
            var val = $(this).val(); //apply_link
            if(val == 'email'){
                $('.apply_link').addClass('d-none');
                $('#app_link_to_receive').removeAttr('required');
            }else{
                $('.apply_link').removeClass('d-none');
                $('#app_link_to_receive').prop('required','true')
            }
        });

        $('#company_logo').change(function (e) {
            $(this).parent().prepend(
                '<div class="uploaded-image" style=""><a href="javascript:void(0)" class="remove"><span class="fa fa-times"></span></a></div>'
            );
            readURL(this, '.uploaded-image');
        });
        $(document).on('click', 'a.remove', function (e) {
            $(this).parent().parent().find('input').val('');
            $(this).parent().parent().find('.uploaded-image').remove();

            e.preventDefault();
        });
        $('#deadline_type').change(function (e) {
            if ($(this).val() == 'Soonest') {
                $(this).next().val('');
                $(this).next().slideUp();
            } else {
                $(this).next().slideDown();
            }
            // $(this).val()
        });
        // tinymce.init({
        //     selector: 'textarea.description',
        //     width: $(this).parent().width(),
        //     height: 250,
        //     menubar: false,
        //     statusbar: false
        // });
        // tinymce.init({
        //     selector: 'textarea.emp_company_information',
        //     width: $(this).parent().width(),
        //     height: 250,
        //     menubar: false,
        //     statusbar: false
        // });

    </script>

<script src="{{asset('public/js/bootstrap-fileinput.js')}}"></script>

<!-- Dropzone script files -->
<script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('public/dropzone/jquery.min.js')}}"></script>
<script src="{{asset('public/dropzone/jquery-ui.min.js')}}"></script>
<script src="{{asset('public/dropzone/form-dropzone.min.js')}}"></script>
<script src="{{asset('public/dropzone/dropzone.min.js')}}"></script>
<script src="{{asset('public/mediexpert-custom-dropzone.js')}}"></script>
<script src="{{asset('public/js/intlTelInput-jquery.min.js')}}"></script>
<script src="{{asset('public/js/intlTelInput.min.js')}}"></script>
<script src="{{asset('public/js/utils.js')}}"></script>
<script src="{{asset('public/js/telPhone.js')}}"></script>

@endsection
