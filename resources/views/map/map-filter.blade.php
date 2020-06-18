@extends('layouts.map')

@section('content')
<div id="map"></div>

<script>
    function initMap(data = {}) {
       // console.log(data);

        
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
<script>
$('#property_type').on('change',function() {
     console.log($(this).val());

    var url = '{{ url('map/select-property') }}';
     $.ajax({
            data: {"property_type": $(this).val()},
            url: url,
            type: "GET",
            success: function (response) {
              console.log(response);
              if($('#collapsibleNavbar > ul > li.nav-item.filter-btn').length > 0){
                   $('#collapsibleNavbar ul .filter-btn:first').remove();
                     $('#collapsibleNavbar ul:first').prepend(response);
              }else {
                $('#collapsibleNavbar ul:first').prepend(response);
              }

            },
            error: function (error) {
                //console.log(error);
            }
        });
});
</script>

@endsection
