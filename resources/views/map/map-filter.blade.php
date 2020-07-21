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
                <center><img src="${locations[i]['full_path'] ? locations[i]['full_path'] : ''}" style="width:100%; max-width:100%;"/></center>
            </div>
            <div class="col-md-8">
            <h6><a href="{{ url('/') }}/${locations[i]['ad_id']}">${locations[i]['ad_heading'] ? locations[i]['ad_heading'] : 'N/A'}</a></h6>
            <p>Adresse: ${locations[i]['full_address'] ? locations[i]['full_address'] : ''} </p>
            <p> ${locations[i]['total_price'] ? 'Pris: '+locations[i]['total_price'] : ''}</p></div>
          </div>`);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
 }

</script>
<script>
function remve_nav_class() {
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
}
$(document).on('change', '#property_type',function() {
   var url = '{{ url('map/select-property') }}';
     $.ajax({
            data: {"property_type": $(this).val()},
            url: url,
            type: "GET",
             async: false,
            success: function (response) {
              if($('#collapsibleNavbar > ul > li.filter-btn').length > 0){
                   $('#collapsibleNavbar ul .filter-btn:first').remove();
                     $('#collapsibleNavbar ul:first').prepend(response);
              }else {
                $('#collapsibleNavbar ul:first').prepend(response);
              }
              remve_nav_class();

            },
            error: function (error) {
                //console.log(error);
            }
        });
});
</script>
<script>
  $(document).on('change', '#job_type',function() {
   var url = '{{ url('map/select-job') }}';
     $.ajax({
            data: {"map_job_type": $(this).val()},
            url: url,
            type: "GET",
            async: false,
            success: function (response) {
              if($('#collapsibleNavbar > ul > li.filter-btn').length > 0){
                   $('#collapsibleNavbar ul .filter-btn:first').remove();
                     $('#collapsibleNavbar ul:first').prepend(response);
              }else {
                $('#collapsibleNavbar ul:first').prepend(response);
              }
              remve_nav_class();

            },
            error: function (error) {
                //console.log(error);
            }
        });
});
</script>
@endsection
