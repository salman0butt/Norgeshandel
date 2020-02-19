@section('style')

    <link rel="stylesheet" href="{{asset('public/css/bootstrap-fileinput.css')}}">
    <link rel="stylesheet" href="{{asset('public/dropzone/plugins.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/dropzone/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/dropzone/basic.min.css')}}">

@endsection

@section('page_content')

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

    <form action="@if(Request::is('jobs/*/edit')){{route('jobs.update', $job->id)}}
    @else {{route('jobs.store')}} @endif" name="job-form" id="job-form" method="POST"
          class="dropzone addMorePics p-0" data-action="@if(Request::is('jobs/*/edit')){{route('jobs.update', $job->id)}}
    @else {{route('jobs.store')}} @endif" enctype="multipart/form-data" data-append_input = 'yes'>
        {{ csrf_field() }}
        @if(Request::is('jobs/*/edit')) {{method_field('PUT')}} @endif
        <input type="hidden" name="ad_id" id="ad_id" value="{{isset($obj_job->ad)?$obj_job->ad->id:""}}">
        <input type="hidden" name="job_id" id="job_id" value="{{isset($obj_job->id)?$obj_job->id:""}}">
        <div class="container p-3 pt-4 bg-white mt-5 shadow-10">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-muted pl-3 pr-3">{{__('About the position')}}</h4>
                    <div class="pl-3">
                        @include('common.partials.flash-messages')
                        <div class="notice"></div>
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
                                    <input name="positions" value="{{$obj_job->positions}}" id="positions"
                                           type="text" class="form-control dme-form-control" required>
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
                                        @if(!empty($obj_job->commitment_type))
                                            <option selected value="{{$obj_job->commitment_type}}">{{$obj_job->commitment_type}}</option>
                                        @endif
                                        @foreach($commitment_types as $commitment_type)
                                            <option value="{{$commitment_type['name']}}">{{$commitment_type['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="sector" class="col-md-2 u-t5">{{__('Sector')}}</label>
                                <div class="col-sm-4 ">
                                    <select id="sector" name="sector" class="form-control dme-form-control"
                                            data-selector="" required>
                                        @foreach($sectors as $sect)
                                            <option value="{{$sect->name}}" {{$sect->name==$obj_job->sector?"selected":""}}>{{$sect->name}}</option>
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
                                        <option value="{{$obj_job->industry}}">{{$obj_job->industry}}</option>
                                    @foreach($industries as $industry)
                                            <option value="{{$industry->name}}">{{$industry->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="job_function" class="col-md-2 u-t5">{{__('Job Function')}}</label>
                                <div class="col-sm-4 ">
                                    <select name="job_function" id="job_function" data-input-name="occupation"
                                            class="form-control dme-form-control" data-max-selections="3" required>
                                        <option value="{{$obj_job->job_function}}">{{$obj_job->job_function}}</option>
                                    @foreach($job_functions as $job_function)
                                            <option value="{{$job_function->name}}">{{$job_function->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--                            full input-->
                        @if(isset($job_type) && $job_type=="management")
                        <div class="form-group">
                            <div class="row">
                                <label for="leadership_category" class="col-md-2 u-t5">{{__('Leadership Category')}}</label>
                                <div class="col-sm-10 ">
                                    <select name="leadership_category" id="leadership_category" data-input-name="leadership_category"
                                            class="form-control dme-form-control">
                                        <option value="{{$obj_job->leadership_category}}">{{$obj_job->leadership_category}}</option>
                                    @foreach($leadership_categories as $leadership_category)
                                            <option value="{{$leadership_category->name}}">{{$leadership_category->name}}</option>
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
                                           class="form-control dme-form-control" >
                                    <span
                                        class="u-t5">{{__('Keywords make it easier for candidates to search for your exact position. Choose up to 5 words you think the candidates are applying for.')}}</span>
                                </div>
                            </div>
                        </div>
                        <!--                            text area-->
                        <div class="form-group">
                            <div class="row">
                                <label for="description"
                                       class="col-md-2 u-t5">{{__('Job description (optional)')}}</label>
                                <div class="col-sm-10 ">
                                        <textarea name="description" class="form-control dme-form-control description"
                                                  id="description" cols="30"
                                                  rows="10">{{$obj_job->description}}</textarea>
                                    <span
                                        class="u-t5">{{__('Tip. The job description should contain sections on work assignments, desired qualifications and what the employer can offer')}}</span>
                                </div>
                            </div>
                        </div>
                        <!--                            selection-->
                        <div class="form-group">
                            <div class="row">
                                <label for="deadline_type" class="col-md-2 u-t5">{{__('Deadline')}}</label>
                                <div class="col-sm-4 ">
                                    <select name="deadline_type" id="deadline_type"
                                            class="form-control dme-form-control" required>
                                        <option @if(empty($obj_job->deadline)) selected
                                                @endif value="Soonest">{{__('Soonest')}}</option>
                                        <option
                                            @if(!empty($obj_job->deadline)) selected @endif>{{__('Specify date')}}</option>
                                    </select>
                                    <input type="date" name="deadline" value="{{$obj_job->deadline}}" id="deadline"
                                           class="form-control dme-form-control"
                                           style=" @if(empty($obj_job->deadline)) display:none; @endif">
                                </div>
                                <label for="accession" class="col-md-2 u-t5">{{__('Accession (optional)')}}</label>
                                <div class="col-sm-4 ">
                                    <input name="accession" value="{{$obj_job->accession}}" id="accession"
                                           type="date" class="form-control dme-form-control">
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
                                            @if(is_countable(Auth::user()->job_companies) && count(Auth::user()->job_companies)>0)
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
                                                  id="emp_company_information" cols="30" rows="10"
                                        >{{$obj_job->emp_company_information}}</textarea>
                                </div>
                            </div>
                        </div>
                        <!--                            full input-->
                        <div class="form-group">
                            <div class="row">
                                <label for="emp_website" class="col-md-2 u-t5">{{__('Website (optional)')}}</label>
                                <div class="col-sm-10 ">
                                    <input name="emp_website" value="{{$obj_job->emp_website}}" id="emp_website"
                                           type="text" class="form-control dme-form-control"
                                           placeholder="firmanavn.no">
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
                                           type="text" class="form-control dme-form-control"
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
                                           type="text" class="form-control dme-form-control"
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
                                    <input name="emp_twitter" value="{{$obj_job->emp_twitter}}" id="emp_twitter"
                                           type="text" class="form-control dme-form-control"
                                           placeholder="@firmanavn">
                                </div>
                            </div>
                        </div>
                        <!--                            selection-->
                        <div class="form-group">
                            <div class="row">
                                <label for="country" class="col-md-2 u-t5">{{__('Land')}}</label>
                                <div class="col-sm-4 ">
                                    <select class="form-control dme-form-control" id="country" name="country">
                                        @if(!empty($obj_job->country))
                                        <option selected value="{{$obj_job->country}}">{{$obj_job->country}}</option>
                                        @endif
                                        @foreach($countries as $ctry)
                                            <option value="{{$ctry['name']}}" @if($ctry['name']=="Norway") selected @endif>{{$ctry['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="zip" class="col-md-2 u-t5">{{__('zip code')}}</label>
                                <div class="col-sm-4 ">
                                    <input name="zip" id="zip" value="{{$obj_job->zip}}" type="text"
                                           class="form-control dme-form-control">
                                           <span id="zip_code_city_name"></span>
                                </div>

                            </div>
                        </div>
                        <!--                            full input-->
                        <div class="form-group">
                            <div class="row">
                                <label for="address"
                                       class="col-md-2 u-t5">{{__('Street address  (optional)')}}</label>
                                <div class="col-sm-10 ">
                                    <input name="address" id="address" type="text"
                                           class="form-control dme-form-control" value="{{@$obj_job->address}}">
                                    <span
                                        class="u-t5">{{__('Explain briefly about the access to the accommodation and how to find it, please tell about proximity to road, bus and train.')}}</span>
                                </div>
                            </div>
                        </div>
                        <!--                            button-->
                        <div class="form-group">
                            <div class="row">
                                <label for="job_gallery"
                                       class="col-md-2 u-t5">{{__('Company logo  (optional)')}}</label>
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
                                           class="form-control dme-form-control" value="{{@$obj_job->workplace_video}}">
                                    <span class="u-t5">{{__('For example - youtube.com/watch?v=3C4W5zadc4g')}}</span>
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
                                <label for="app_receive_by"
                                       class="col-md-2 u-t5">{{__('Receive applications via')}}</label>
                                <div class="col-sm-4">
                                    <select class="form-control dme-form-control" id="app_receive_by"
                                            name="app_receive_by" data-selector="">
                                        <option value="email" {{$obj_job && $obj_job->app_receive_by == 'email' ? 'selected' : ''}}>Søkerhåndtering</option>
                                        <option value="url" {{$obj_job && $obj_job->app_receive_by == 'url' ? 'selected' : ''}}>Eget søknadsskjema</option>
                                    </select>
                                </div>
                                <label for="app_link_to_receive"
                                       class="col-md-2 u-t5">{{__('Link to application form')}}</label>
                                <div class="col-sm-4">
                                    <input type="text" name="app_link_to_receive" id="app_link_to_receive"
                                           class="form-control dme-form-control" value="{{@$obj_job->app_link_to_receive}}">
                                </div>
                                <div class="col-md-10 offset-md-2">
                                    <span
                                        class="u-t5">{{__('With Handel Seeker Handling, applicants upload contact information, CV and any application letter directly to Handel. You will be notified by email every time you receive a new application and get a full overview here at the business center.')}}</span>
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
                                <label for="app_contact" class="col-md-2 u-t5">{{__('Contact')}}</label>
                                <div class="col-sm-4 ">
                                    <input name="app_contact" id="app_contact" type="text"
                                           class="form-control dme-form-control" value="{{@$obj_job->app_contact}}">
                                </div>
                            </div>
                        </div>
                        <!--                            full input-->
                        <div class="form-group">
                            <div class="row">
                                <label for="app_contact_title"
                                       class="col-md-2 u-t5">{{__('Contact person (optional)')}}</label>
                                <div class="col-sm-10 ">
                                    <input name="app_contact_title" id="app_contact_title" type="text"  value="{{@$obj_job->app_contact_title}}"
                                           class="form-control dme-form-control">
                                    <span
                                        class="u-t5">{{__('Explain briefly about the access to the accommodation and how to find it, please tell about proximity to road, bus and train.')}}</span>
                                </div>
                            </div>
                        </div>
                        <!--                            small input-->
                        <div class="form-group">
                            <div class="row">
                                <label for="app_mobile" class="col-md-2 u-t5">{{__('Mobile  (optional)')}}</label>
                                <div class="col-sm-4 ">
                                    <input name="app_mobile" id="phone" type="tel"
                                           class="form-control dme-form-control" value="{{@$obj_job->app_mobile}}" >
                                    <span id="valid-msg" class="hide"></span>
                                    <span id="error-msg" class="hide"></span>
                                </div>
                                <label for="app_phone" class="col-md-2 u-t5">{{__('Phone  (optional)')}}</label>
                                <div class="col-sm-4 ">
                                    <input name="app_phone" id="phone" type="tel"
                                           class="form-control dme-form-control" value="{{@$obj_job->app_phone}}" >
                                    <span id="valid-msg" class="hide"></span>
                                    <span id="error-msg" class="hide"></span>
                                </div>
                            </div>
                        </div>
                        <!--                            full input-->
                        <div class="form-group">
                            <div class="row">
                                <label for="app_email" class="col-md-2 u-t5">{{__('Email  (optional)')}}</label>
                                <div class="col-sm-10 ">
                                    <input name="app_email" id="app_email" type="text"
                                           class="form-control dme-form-control" value="{{@$obj_job->app_email}}">
                                </div>
                            </div>
                        </div>
                        <!--                            full input-->
                        <div class="form-group">
                            <div class="row">
                                <label for="app_linkedin"
                                       class="col-md-2 u-t5">{{__('LinkedIn  (optional)')}}</label>
                                <div class="col-sm-10 ">
                                    <input name="app_linkedin" id="app_linkedin" type="text"
                                           class="form-control dme-form-control"
                                           placeholder="linkedin.com/in/kontaktperson" value="{{@$obj_job->app_linkedin}}">
                                </div>
                            </div>
                        </div>
                        <!--                            full input-->
                        <div class="form-group">
                            <div class="row">
                                <label for="app_twitter" class="col-md-2 u-t5">{{__('Twitter  (optional)')}}</label>
                                <div class="col-sm-10 ">
                                    <input name="app_twitter" id="app_twitter" type="text"
                                           class="form-control dme-form-control" placeholder="@kontaktperson" value="{{@$obj_job->app_twitter}}">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <input type="submit" class="dme-btn-outlined-blue mb-3 col-12" id="publiserannonsen" value="Publiser annonsen!">
{{--                        <button data-style="slide-up" data-spinner-color="#AC304A" data-size="l" class="btn btn-primary mb-3 col-12 ladda-button" id="publiserannonsen" data-style="expand-left"><span class="ladda-label">Publiser annonsen!</span></button>--}}

                        <p class="u-t5 text-center">By moving forward, the <a href="#">rules for advertising</a>are
                            also accepted</p>


                    </div>
                </div>
            </div>
        </div>

    </form>
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

            $('#job-form input, #job-form select').blur(function (e) {
                // $('#description').text(tinyMCE.get("description").getContent());
                // $('#emp_company_information').text(tinyMCE.get("emp_company_information").getContent());
                var link = $('#ad_id').val().length > 0 ? '{{url('jobs/update_dummy')}}' : '{{url('jobs/store_dummy')}}';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: link,
                    type: "POST",
                    data: $('#job-form').serialize(),
                    success: function (response) {
                        resp = $.parseJSON(response);
                        if ($('#ad_id').val().length < 1) {
                            $('.notice').hide();
                            $('.notice').append('<div class="alert alert-success">Jobben ble lagret!</div>');
                            setTimeout(function () {
                                $('.notice').show('slow');
                            }, 2000);
                            setTimeout(function () {
                                $('.notice').hide('slow');
                            }, 5000);
                            $('#job_id').val(resp.job_id);
                            $('#ad_id').val(resp.ad_id);
                        }
                    }

//                    document.getElementById("contact_us").reset();
                })
            });
        });

        $('#company_logo').change(function (e) {
            $(this).parent().prepend('<div class="uploaded-image" style=""><a href="javascript:void(0)" class="remove"><span class="fa fa-times"></span></a></div>');
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

<script>
    $(document).on('change', 'input[name="zip"]', function(e) {
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
@endsection


@section('script')
    <script src="{{asset('public/js/bootstrap-fileinput.js')}}"></script>
    <script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('public/dropzone/jquery.min.js')}}"></script>
    <script src="{{asset('public/dropzone/jquery-ui.min.js')}}"></script>
    <script src="{{asset('public/dropzone/form-dropzone.min.js')}}"></script>
    <script src="{{asset('public/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('public/mediexpert-custom-dropzone.js')}}"></script>

@endsection
