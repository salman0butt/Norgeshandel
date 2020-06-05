@extends('layouts.landingSite')

@section('style')
    <link href="{{ asset('public/admin/css/select2.min.css') }}" rel="stylesheet">
    <style>
        .preference_cities_section span{
            background: #ecdfe2;
            font-size: 17px;
            font-weight: 400;
            padding: 12px;
            margin-right: 5px;
        }
    </style>
@endsection

@section('page_content')
@php
    $job_function = \App\Taxonomy::where('slug', 'job_function')->first();
    $job_functions = $job_function->terms()->orderBy('name','ASC')->get();
@endphp

<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9Ctn550_sIhRLl-ZlZeCVr7P_yLgqg7Y&libraries=places&callback=initMap"
        async defer></script>
<main class="job-preferences">
    <div class="dme-container">
        <div class="breade-crumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('my-business')}}">Min handel </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mine jobb-preferanser</li>
                </ol>
            </nav>
        </div>
        <!---- end breadcrumb----->
        <div class="panel u-mb32" id="main-content">
            <h2 class="mb-2">Mine jobb-preferanser</h2>
            @include('common.partials.flash-messages')
            <p class="u-mb16" style="font-weight:600;">Jobb preferanser</p>
            <p class="u-mb16">Her kan la bedriftene finne deg relatert til dine jobb preferanser. Husk til enhver tid å ha oppdaterte
                preferanser slik at du er et steg nærmere drømme jobben din!</p>
        </div>
        <div class="panel">
            <form action="{{route('job-preferences.store')}}" method="POST">
                @csrf
                <div class="u-mb32 form-group">
                    <div class="input input--text u-mb8">
                        <label for="keywords-input" class="u-t5">Dine preferanser</label>
                        <div style="display: block;">
                            <select class="form-control select2" id="functions" name="functions[]" multiple="">
                                @if($job_functions->count() > 0)
                                    @foreach($job_functions as $job_function)
                                        <option value="{{$job_function->name}}" @if(Auth::user()->job_preference_key_words->count()) {{is_numeric(array_search($job_function->name,Auth::user()->job_preference_key_words->pluck('key_word')->toArray())) ? 'selected' : '' }} @endif>{{$job_function->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="u-mb32 form-group">
                    <div>
                        <label for="pre_city_input" class="u-t5">Hvor?</label>
                        <div class="" style="display: block;">

                            <input type="hidden" class="user_pref_cities" name="cities" value="{{Auth::user()->job_preference_cities->count() ? json_encode(Auth::user()->job_preference_cities->pluck('city')->toArray()) : ''}}">
                            <input id="pre_city_input" placeholder="Oslo, Bergen" type="text" role="combobox" aria-autocomplete="list" aria-expanded="false" autocomplete="off" value="" class="dme-form-control">
                            <div class="preference_cities_section mt-3">
                                @if(Auth::user()->job_preference_cities->count())
                                    @foreach(Auth::user()->job_preference_cities as $pref_city)
                                        <a href="javascript:void(0);" class="remove_city" data-city="{{$pref_city->city}}">
                                            <span class="badge bade-primary">{{$pref_city->city}}<i class="fa fa-times pl-1"></i></span>
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hide company event and news section -->
                <div class="u-mb32 form-group d-none">
                    <label>Hva ønsker du informasjon om?</label>
                    <div class="input-toggle">
                        <input id="notification_option_3" type="checkbox" class="mrs">
                        <label class="" for="notification_option_3">Nyheter om bedriften</label>
                    </div>
                    <div class="input-toggle">
                        <input id="notification_option_2" type="checkbox" class="mrs">
                        <label class="" for="notification_option_2">Arrangementer</label>
                    </div>
                </div>

                <div class="u-mb32 form-group">
                    <div class="input input--text u-mb8">
                        <button type="submit" class="dme-btn-outlined-blue float-left">
                            Sende inn
                        </button>
                        @if(Auth::user()->job_preference_cities->count() || Auth::user()->job_preference_key_words->count())
                            <a href="{{route('delete-job-preferences')}}" type="submit" class="dme-btn-outlined-blue ml-3">
                                Fjern alle
                            </a>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                </div>
            </form>
        </div>


    </div>
</main>
@endsection

@section('script')
    <script src="{{ asset('public/admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/select2.full.min.js') }}"></script>
    <script>
        $(".select2").select2();

        function pref_cities_array(city_name){

            var user_pref_cities = $('.user_pref_cities').val();
            var dataArr = [];


            if(user_pref_cities){
                user_pref_cities = JSON.parse(user_pref_cities);
                if(user_pref_cities){
                    $( ".remove_city" ).each(function( index ) {
                    // $.each(user_pref_cities, function (index, value) {
                    //     dataArr[index+1] = value;
                        if($(this).data('city')){
                            dataArr[index+1] = $(this).data('city');
                        }
                    });
                }
            }else{
                dataArr[0] = city_name;
            }
            // dataArr = dataArr.reverse();
            dataArr = dataArr.filter(function (el) {
                return el != null && el != "";
            });
            $('.user_pref_cities').val(JSON.stringify(dataArr));
        }


        function initMap() {
            // var api_url = 'https://maps.googleapis.com/maps/api/place/autocomplete/json?key=AIzaSyC9Ctn550_sIhRLl-ZlZeCVr7P_yLgqg7Y&types=geocode&language=en&components=country:pk';
            var options = {
                types: ['(cities)'],
                componentRestrictions: {country: "no"}
            };
            var input = document.getElementById('pre_city_input');
            var autocomplete = new google.maps.places.Autocomplete(input, options);

            var infowindow = new google.maps.InfoWindow();


            autocomplete.addListener('place_changed', function () {
                infowindow.close();
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("Ingen detaljer tilgjengelig for inndata: '" + place.name + "'");
                    return;
                }

                if(place.name){
                    $('#pre_city_input').val('');
                    var city_html = '<a href="javascript:void(0);" class="remove_city" data-city="'+place.name+'"><span class="badge bade-primary">'+place.name+'<i class="fa fa-times pl-1"></i></span></a>';
                    $(".preference_cities_section").append(city_html);
                    pref_cities_array(place.name);
                }
            });
        }


        $(document).ready(function () {

            //remove cities
            $(document).on('click', '.remove_city', function(e){
                var val = $(this).data('city');
                $(this).remove();
                pref_cities_array(val);
            });

            //prevent to submit form on enter click in any input
            $('form #pre_city_input'). keydown(function (e) {
                if (e. keyCode == 13) {
                    e. preventDefault();
                    return false;
                }
            });
        });
    </script>
@endsection
