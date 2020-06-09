<!DOCTYPE html>
<html>

<head>
    <title>Norgshandal Maps Diriections</title>
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
        <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-3.3.0.min.js"></script>
</head>

<body>
@include('user-panel.partials.header')

    <div id="mapCanvas" style="top: 50px;">&#160;</div>
    <div id="directionsPanel">
        <a href="#geoLocation" id="useGPS">Use My Location</a>
        <p class="or">[OR]</p>
        <div class="directionInputs">
            <form>
                <p>
                    <label>Fra</label>
                    <input type="text" value="" id="dirSource" />
                </p>
                <p>
                    <label>Til</label>
                    <input type="text" value="" id="dirDestination" />
                </p>
                <a href="#getDirections" id="getDirections">Get Directions</a>
                <a href="#reset" id="paneReset">Reset</a>
            </form>
        </div>
        <div id="directionSteps">
            <p class="msg">Direction Steps Will Render Here</p>
        </div>
        <a href="#toggleBtn" id="paneToggle" class="out">&lt;</a>
    </div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9Ctn550_sIhRLl-ZlZeCVr7P_yLgqg7Y&libraries=places&callback=initMap" async defer></script>
      <script src="{{ asset('public/js/diriection.js') }}"></script>
    <script>
    function init() {
        initMap();
    }
    </script>

    <script src="{{asset('public/admin/js/bootstrap.min.js')}}"></script>
</body>

</html>



