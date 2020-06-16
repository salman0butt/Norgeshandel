@extends('layouts.map')

@section('content')
<div id="map"></div>
<div id="image"></div>
<script>
    function initMap(data = {},images=[]) {
       // console.log(data);
        //console.log(images);
        
          var locations = data;

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 7,
      center: new google.maps.LatLng(59.911491, 10.757933),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) { 
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i]['latitude'], locations[i]['longitude']),
        map: map
      });
        //console.log(images[i]);
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(`<div class="row">
            <div id="images" class="col-md-4">
                <center><img src="${locations[i]['full_path']}" width="200"/></center>
            </div>
            <div class="col-md-8">
            <h6><a href="{{ url('/') }}/${locations[i]['ad_id']}">${locations[i]['headline']}</a></h6>
            <p>location: ${locations[i]['full_address']} </p>
            <p>price: ${locations[i]['total_price']}</p></div>
          </div>`);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
 }

</script>

@endsection
