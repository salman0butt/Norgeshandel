@extends('layouts.landingSite')

@section('page_content')
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9Ctn550_sIhRLl-ZlZeCVr7P_yLgqg7Y&libraries=places&callback=initMap"
    async defer></script>
<style>
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
    #map {
        height: 95%;
        margin-top: 5px;
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
    #stree-view{
      position: absolute;
      top: 70px;
      right: 100px;
      background-color: #fff;
      border: none;
      padding: 5px 10px;
    }

</style>
<br><br>

    <input id="autocomplete" class="controls" type="text" placeholder="Enter a location">
    <div id="map"></div>
  <button id="stree-view">Street View</button>

    <div id="infowindow-content">
        <span id="place-name" class="title"></span><br>
        {{-- <strong>Place ID</strong>: <span id="place-id"></span><br> --}}
        <span id="place-address"></span>
    </div>

 
<script>

    function initMap() {
        var map = new google.maps.Map(
            document.getElementById('map'), {
                center: {
                    lat: 59.911491, 
                    lng: 10.757933
                },
                zoom: 13,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    position: google.maps.ControlPosition.TOP_CENTER
                },
            });

        var input = document.getElementById('autocomplete');

        var autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('autocomplete')), {
                types: ['geocode']
            });

        autocomplete.bindTo('bounds', map);

        // Specify just the place data fields that you need.
        autocomplete.setFields(['place_id', 'geometry', 'name', 'formatted_address']);
         // Set initial restrict to the greater list of countries.
        autocomplete.setComponentRestrictions(
            {'country': ['no']});
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);

        var geocoder = new google.maps.Geocoder;

        var marker = new google.maps.Marker({
            map: map
        });
        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });

        autocomplete.addListener('place_changed', function () {
            infowindow.close();
            var place = autocomplete.getPlace();

            if (!place.place_id) {
                return;
            }
            geocoder.geocode({
                'placeId': place.place_id
            }, function (results, status) {
                if (status !== 'OK') {
                    window.alert('Geocoder failed due to: ' + status);
                    return;
                }

                map.setZoom(13);
                map.setCenter(results[0].geometry.location);
           
                console.log(results);

                // Set the position of the marker using the place ID and location.
                marker.setPlace({
                    placeId: place.place_id,
                    location: results[0].geometry.location
                });
                     infowindow.open(map, marker);
                marker.setVisible(true);
                infowindow.open(map, marker);
                infowindowContent.children['place-name'].textContent = place.name;
                //infowindowContent.children['place-id'].textContent = place.place_id;
                infowindowContent.children['place-address'].textContent = results[0].formatted_address;

                infowindow.open(map, marker);
            });
        });
    }
$('#stree-view').on('click',function() {
    window.open("{{ url('/streetview') }}", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=400,width=800,height=600");
});
</script>

@endsection
