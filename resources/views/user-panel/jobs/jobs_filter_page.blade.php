@extends('layouts.landingSite')
@section('page_content')
    <main class="dme-wrapper" id="dme-wrapper">
        @include('user-panel.jobs.jobs_filter_page_inner')
    </main>

    <input type="hidden" id="mega_menu_search_url" value="{{url('jobs/mega_menu_search')}}">
    <script>
      var added = false;

var cur_lat = 0;
var cur_lon = 0;

var new_url_property = '';
var new_map_var = '';
var new_circle_var = '';
 var circle = [];
function removeAllcircles(circle) {
    for (var i in circle) {
        circle[i].setMap(null);
    }
    circle = [];
}
function assign_lat_long(new_url=''){

    if(!isEmpty(new_url)){
        new_url_property = new_url;
    }

    if(new_url_property && $('#map_lat').val() && $('#map_lng').val()){
        var map_lat = $('#map_lat').val();
        var map_lng = $('#map_lng').val();
        new_url_property += "&map_lat=" + map_lat;//.toFixed(6);
        new_url_property += "&map_lng=" + map_lng;//.toFixed(6);
        search(new_url_property);
    }
}

function create_circle(new_url = '') {
        if(!isEmpty(new_url)){
        new_url_property = new_url;
    }
      
    var new_rad = $('#customRange1').val();
    var rad = new_rad * 1000;
    var map_lat = parseFloat($('#map_lat').val());
    var map_lng = parseFloat($('#map_lng').val());

      
     circle = new google.maps.Circle({
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
        map: new_map_var,
        center: { lat: map_lat, lng: map_lng },//citymap[city].center,
        radius: rad
    });
    //new_circle_var.bindTo('center', new_marker_var, 'position');

}


function initMap() {

    var map = new google.maps.Map(
        document.getElementById('map'),
        { center: { lat: 59.911491, lng: 10.757933}, zoom: 13});

    var input = document.getElementById('pac-input');

    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.bindTo('bounds', map);

    // Specify just the place data fields that you need.
    autocomplete.setFields(['place_id', 'geometry', 'name', 'formatted_address']);

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);

    var geocoder = new google.maps.Geocoder;

    var marker = new google.maps.Marker({map: map});
    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });
    autocomplete.setComponentRestrictions({
        'country': ['no']
    });

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        var place = autocomplete.getPlace();

        if (!place.place_id) {
            return;
        }
        geocoder.geocode({'placeId': place.place_id}, function(results, status) {
            if (status !== 'OK') {
                window.alert('Geocoder failed due to: ' + status);
                return;
            }
            $('#map_lat').val(results[0].geometry.location.lat());
            $('#map_lng').val(results[0].geometry.location.lng());

            assign_lat_long();
            //console.log(results[0].geometry.location.lat(),results[0].geometry.location.lng());
            map.setZoom(11);
            map.setCenter(results[0].geometry.location);

           
            new_circle_var = circle;
            // Set the position of the marker using the place ID and location.
            marker.setPlace(
                {placeId: place.place_id, location: results[0].geometry.location});

            marker.setVisible(true);

            //circle.setMap(null);

            new_map_var = map;
            removeAllcircles(circle);
            
            create_circle();


            //infowindowContent.children['place-name'].textContent = place.name;
            //infowindowContent.children['place-id'].textContent = place.place_id;
            //infowindowContent.children['place-address'].textContent =
            //  results[0].formatted_address;

            //infowindow.open(map, marker);
        });
    });
    

    // Add circle overlay and bind to marker
    $(document).on('change', '#customRange1', function () {
        
        var new_rad = $(this).val();
        var rad = new_rad * 1609.34;
        if (!circle || !circle.setRadius) {
            circle = new google.maps.Circle({
                map: map,
                radius: rad,
                fillColor: '#555',
                strokeColor: '#ffffff',
                strokeOpacity: 0.1,
                strokeWeight: 3
            });
            circle.bindTo('center', marker, 'position');
        } else circle.setRadius(rad);
    });
}

$('.smart-scroll').scroll(function() {
    $('.pac-container').attr("style", "display: none !important");
});
$(window).scroll(function() {
    $('.pac-container').attr("style", "display: none !important");
});


        function get_curr_location(newUrl=''){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    cur_lat = position.coords.latitude;
                    cur_lon = position.coords.longitude;

                    if(newUrl){
                        newUrl = set_lat_lon(newUrl,'4');
                        search(newUrl);
                    }
                }, function() {
                    alert('Du fant ikke nærmeste annonser fordi vi ikke får tilgang til posisjonen din. Fjern blokkeringen av siden vår fra nettleserinnstillingene dine og prøv igjen. Takk');
                });
            }
        }

        function set_lat_lon(newUrl,sort){
            if(sort === '4' && cur_lat && cur_lon){
                newUrl += "&lat=" + cur_lat.toFixed(6);
                newUrl += "&lon=" + cur_lon.toFixed(6);
            }
            return newUrl;
        }

        $(document).ready(function () {
            //get_curr_location();
            // $(window).on('popstate', function(e) {
            //     window.location.href =  window.location.href.split("?")[0];
            // });

            var urlParams = new URLSearchParams(location.search);
            var type = urlParams.get('job_type');
            if (isEmpty(type)) {
                $('.job-type').text("Alle stilling");
            }
            @if(!Request::is('jobs/company/*/ads'))
                search(urlParams.toString());
            @endif
            $(document).on('change', '#sort', function () {
               var sort_val = $(this).val();
                urlParams = new URLSearchParams(location.search);
                urlParams.delete('sort');
                urlParams.delete('lat');
                urlParams.delete('lon');
                urlParams.set('sort', $(this).val());


                if(sort_val === '4' && (!cur_lon || !cur_lat)) {
                    get_curr_location(urlParams.toString());
                }else{
                    var temp_newUrl = set_lat_lon(urlParams.toString(),sort_val);
                    search(temp_newUrl);
                }

                history.pushState('', 'NorgesHandel', "?" + urlParams.toString());
            });
            $(document).on('click', '#view', function (e) {
                e.preventDefault();
                urlParams = new URLSearchParams(location.search);
                urlParams.delete('view');
                urlParams.set('view', $(this).attr('data-name'));
                search(urlParams.toString());
                history.pushState('', 'NorgesHandel', "?" + urlParams.toString());
            });
            $('.mega-menu input').change(function (e) {
                var id = $(this).attr('id');
                var newUrl = $('#mega_menu_form').serialize();
                urlParams = new URLSearchParams(location.search);
                var view = urlParams.get('view');
                var sort = urlParams.get('sort');

                var x = new URLSearchParams(newUrl);
                if (!isEmpty(view)) {
                    newUrl += "&view=" + view;
                }
                if (!isEmpty(sort)) {
                    newUrl += "&sort=" + sort;
                }

                newUrl = set_lat_lon(newUrl,sort);
                        
                if(id === 'pac-input'){
                    assign_lat_long(newUrl);
                }
                else{
                    search(newUrl);
                }


                search(newUrl);
                if(!added){
                    history.pushState('{{url('jobs')}}', 'NorgesHandel', "?" + newUrl);
                    added = true;
                }
                else{
                    history.replaceState('{{url('jobs')}}', 'NorgesHandel', "?" + newUrl);
                    }
            });


        /*
            var strsearch = urlParams;
            strsearch.delete('page');
            var value = strsearch.toString();
            var job_type = strsearch.get('job_type');
            if(!isEmpty(job_type)) {
                if (!isEmpty(value)) {
                    var url = "{{url('/recentearches')}}";

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url + '/' + value + '/' + urlParams.get('search') + '/job',
                        type: "POST",
                        success: function (response) {
                            // console.log(response);
                        },
                        error: function (error) {
                            // console.log(error);
                        }
                    });
                }
            }*/
        });
    </script>
@endsection
