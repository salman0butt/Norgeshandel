<!DOCTYPE html>
<html lang="no">

<head>
    <title>Norgshandal Maps</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta name="description" content="Google Maps Diriections" />
    <meta name="keywords" content="Google Maps Diriections" />
    <meta name="author" content="Giri Jeedigunta - thewebstorebyg" />

    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/mediexpert.css')}}">
    <link rel="stylesheet" href="{{asset('public/mediexpert-mq.css')}}">
     <link rel="stylesheet" href="{{asset('public/ameer-mq.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="{{ asset('public/css/diriection.css') }}" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
        var jQuery_1_8_3 = jQuery.noConflict();
    </script>
    <script src="{{asset('public/admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/admin/js/bootstrap.min.js')}}"></script>

    @yield('styles')
    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
            height: 90%;
        }
        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #pac-input {
            left: 0 !important;
        }
        .controls {
            background-color: #fff;
            border-radius: 2px;
            border: 1px solid transparent;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            box-sizing: border-box;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            height: 29px;
            margin-left: 17px;
            margin-top: 10px;
            outline: none;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }
        .controls:focus {
            border-color: #4d90fe;
        }
        .title {
            font-weight: bold;
        }
        #infowindow-content {
            display: none;
        }
        #map #infowindow-content {
            display: inline;
        }
        footer {
            display: none !important;
        }
        #stree-view {
            position: absolute;
            top: 15px;
            right: 100px;
            background-color: #fff;
            border: none;
            padding: 5px 10px;
        }
        .primary-color {
            background: #ac304a;
        }
        @media (min-width: 768px) {
        .navbar {
            padding: 5px 10px !important;
        }
        }
        .navbar-nav li {
            padding: 0px 8px !important;
        }
        .navbar-nav li a:hover {
            background: #ac304ad9;
        }
        #mapper {
            position: relative;
            height: 100vh;
        }
        .navbar {
            z-index: 9999;
        }

        #navbarDropdownMenuLink {
                cursor: pointer;
        }

        .pac-container:after {
            /* Disclaimer: not needed to show 'powered by Google' if also a Google Map is shown */
            background-image: none !important;
            height: 0px;
        }
   
     @media (max-width: 992px){
              .navbar-toggler {
            width: 100% !important;
             padding-left: 90% !important;
             }
        } 
    </style>
</head>

<body id="mapper-page">
@include('user-panel.partials.header')
<br><br>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color">

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
            aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="@if(\Illuminate\Support\Facades\Request::is('map/property') || \Illuminate\Support\Facades\Request::is('map/job')) {{ url('/map') }} @else javascript:void(0); @endif" id="sok">Søk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="@if(\Illuminate\Support\Facades\Request::is('map/property') || \Illuminate\Support\Facades\Request::is('map/job')) {{ url('/map') }} @else javascript:void(0); @endif" id="direction">Ruteplan</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Norgeshandel</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ url('/map/property') }}">Eiendom</a>
                        <a class="dropdown-item" href="{{ url('/map/job') }}">Jobb</a>
                    </div>
                </li>
                @if(\Illuminate\Support\Facades\Request::is('map/property'))

                <li>
                    <select name="property_type" id="property_type" class="dme-form-control searchKey">
                        <option value="">Velg Eiendom</option>
                        <option value="property_for_sale">Bolig til salgs </option>
                        <option value="property_for_rent">Bolig til leie</option>
                        <option value="holiday_home_for_sale">Fritidsbolig til salgs</option>
                        <option value="flat_wishes_rented">Bolig ønskes leid</option>
                        <option value="commercial_property_for_sale">Næringseiendom til salgs </option>
                        <option value="commercial_property_for_rent">Næringseiendom til leie </option>
                        <option value="commercial_plot">Næringstomter</option>
                        <option value="Business_for_sale">Bedrifter til salgs</option>
                    </select>
                </li>
            @endif
            @if(\Illuminate\Support\Facades\Request::is('map/job'))
                <li>
        <select name="job_type" id="job_type" class="dme-form-control searchKey">
                <option value="">Velg Jobb</option>
            <option value="full_time">Heltidsstilling</option>
            <option value="part_time">Deltidsstillinger</option>
            <option value="management">Lederstillinger</option>
            </select>

                </li>
            @endif
        </ul>
        <!-- Links -->

    </div>
    <!-- Collapsible content -->

</nav>
<!--/.Navbar-->

    @yield('content')


@yield('scripts')
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9Ctn550_sIhRLl-ZlZeCVr7P_yLgqg7Y&libraries=places&language=no"
        async defer></script>
<script src="{{ asset('public/js/map-property-filter.js') }}"></script>
<script src="{{asset('public/mediexpert.js')}}"></script>
<script>
    $(function () {
     
        setTimeout(function() {
            @if(request()->property_type == 'property_for_sale')
             $('#property_type').find('option[value="property_for_sale"]').attr('selected',true).change();
           @elseif(request()->property_type == 'property_for_rent')
             $('#property_type').find('option[value="property_for_rent"]').attr('selected',true).change();
            @elseif(request()->property_type == 'holiday_home_for_sale')
             $('#property_type').find('option[value="holiday_home_for_sale"]').attr('selected',true).change();
            @elseif(request()->property_type == 'flat_wishes_rented')
             $('#property_type').find('option[value="flat_wishes_rented"]').attr('selected',true).change();
            @elseif(request()->property_type == 'commercial_property_for_sale')
             $('#property_type').find('option[value="commercial_property_for_sale"]').attr('selected',true).change();
            @elseif(request()->property_type == 'commercial_property_for_rent')
             $('#property_type').find('option[value="commercial_property_for_rent"]').attr('selected',true).change();
            @elseif(request()->property_type == 'commercial_plot')
             $('#property_type').find('option[value="commercial_plot"]').attr('selected',true).change();
            @elseif(request()->property_type == 'Business_for_sale')
             $('#property_type').find('option[value="Business_for_sale"]').attr('selected',true).change();
            @elseif(request()->job_type == 'full_time')
             $('#job_type').find('option[value="full_time"]').attr('selected',true).change();
            @elseif(request()->job_type == 'management')
             $('#job_type').find('option[value="management"]').attr('selected',true).change();
           @endif
            }, 500);
    
        var url = '{{ url('/map/search') }}';
        getMap(url);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')
            }
        });
        function getMap(url) {
            if (url == '') {
                return;
            }
            jQuery.ajax({
                type: "GET",
                url: url,
                success: function (data) {
                    $('#mapper').html('');
                    $('#mapper').html(data);
                    initMap();
                    //console.log(data);
                },
                error: function (jqXhr, json, errorThrown) { // this are default for ajax errors
                    console.log(jqXhr);
                    // console.log(jqXhr.responseJSON);
                },
            });
        }
        $('#sok').on('click', function () {
            $(this).parent().find('li.nav-item').addClass('active');
            url = '{{ url('/map/search') }}';
            getMap(url);
        });
        $('#direction').on('click', function () {
            $(this).parent().find('li.nav-item').addClass('active');
            url = '{{ url('/map/direction') }}';
            getMap(url);
                
        setTimeout(function() {
       var destination =  $('#search-address').val();
            if(destination != ''){
                $('#dirDestination').val(destination); 
            }
        }, 1000);  
       
        });
    });
</script>
<script>
        (function($) {
        var $window = $(window);
            // $html = $('html');

        $window.resize(function resize(){
            if ($window.width() < 992) {
                if($('#collapsibleNavbar .filter-btn').hasClass('nav-item')){
                    $('#collapsibleNavbar .filter-btn').removeClass('nav-item');
                }
                // return $html.addClass('mobile');
            }else{
                if(!$('#collapsibleNavbar .filter-btn').hasClass('nav-item')){
                    $('#collapsibleNavbar .filter-btn').addClass('nav-item');

                }
            }

            // $html.removeClass('mobile');
        }).trigger('resize');
    })(jQuery);
</script>
@yield('scripts')

</body>

</html>