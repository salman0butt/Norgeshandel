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

        .navbar {
            padding: 5px 10px !important;
        }

        .navbar-nav li {
            padding: 0px 15px !important;
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

        .pac-container:after {
            /* Disclaimer: not needed to show 'powered by Google' if also a Google Map is shown */

            background-image: none !important;
            height: 0px;
        }

    </style>
</head>

<body>
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
                    <a class="nav-link" href="javascript:void(0);" id="sok">Søk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" id="direction">Ruteplan</a>
                </li>
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
       var url = '{{ url('/map/search') }}';
        getMap(url);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')
            }
        });
        function getMap(url){
            if(url == '') {
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
        $('#sok').on('click',function() {

            $(this).parent().find('li.nav-item').addClass('active');
           url = '{{ url('/map/search') }}';
          getMap(url);
        });
        $('#direction').on('click',function() {
              $(this).parent().find('li.nav-item').addClass('active');
           url = '{{ url('/map/direction') }}';
          getMap(url);
        });
       
    });

</script>
    
</body>

</html>
