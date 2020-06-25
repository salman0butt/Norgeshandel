<div style="display: none">
    <input id="autocomplete" class="controls" type="text" placeholder="Søk adresse">
</div>
<div id="map"></div>
<button id="stree-view">Gateutsikt</button>

<div id="infowindow-content">
    <span id="place-name" class="title"></span><br>
    <span id="place-address"></span>
</div>


<script>
    function initMap() {
        var lat = parseFloat($('#latitude').val()) ? parseFloat($('#latitude').val()) : parseFloat('59.911491');
        var lng = parseFloat($('#longitude').val()) ? parseFloat($('#longitude').val()) : parseFloat('10.757933');
        var map = new google.maps.Map(
            document.getElementById('map'), {
                center: {
                    lat: lat,
                    lng: lng
                },
                zoom: 8,
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
        autocomplete.setComponentRestrictions({
            'country': ['no']
        });
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
        ///new marker code start here
     if(parseFloat($('#latitude').val()) && parseFloat($('#longitude').val())) {
        geocodeLatLng(geocoder, map, infowindow);


      function geocodeLatLng(geocoder, map, infowindow) {
       // var input = document.getElementById('latlng').value;
        //var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat($('#latitude').val()), lng: parseFloat($('#longitude').val())};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              map.setZoom(13);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }
    }
        //new marker code ends here

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

                map.setZoom(15);
                map.setCenter(results[0].geometry.location);

                $('#latitude').val(place.geometry.location.lat());
                $('#longitude').val(place.geometry.location.lng());
                console.log(place.geometry.location.lat());
                console.log(place.geometry.location.lng());

                // Set the position of the marker using the place ID and location.
                marker.setPlace({
                    placeId: place.place_id,
                    location: results[0].geometry.location
                });
                infowindow.open(map, marker);
                marker.setVisible(true);
                infowindow.open(map, marker);
                 infowindow.setContent(place.name);
                infowindowContent.children['place-name'].textContent = place.name;
                //infowindowContent.children['place-id'].textContent = place.place_id;
                infowindowContent.children['place-address'].textContent = results[0].formatted_address;

                infowindow.open(map, marker);
            });
        });
    }
    $('#stree-view').on('click', function () {
        var lat = $('#latitude').val();
        var lng = $('#longitude').val();
        window.open("https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=" + lat + "," + lng + "",
            "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=400,width=800,height=600");
    });

</script>

