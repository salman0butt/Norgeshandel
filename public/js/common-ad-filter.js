var new_url_property = '';
var new_map_var = '';
var circles = [];

var cur_lat = 0;
var cur_lon = 0;

function removeAllcircles() {
    for(var i in circles) {
        circles[i].setMap(null);
    }
    circles = [];
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
    removeAllcircles();
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

    // push the circle object to the array
    circles.push(circle);

}

function initMap() {

    var map = new google.maps.Map(
        document.getElementById('map'),
        { center: { lat: parseFloat($('#map_lat').val()), lng: parseFloat($('#map_lng').val())}, zoom: 7});
        // { center: { lat: 59.911491, lng: 10.757933}, zoom: 7});
    new_map_var = map;
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

            //assign_lat_long();
            //console.log(results[0].geometry.location.lat(),results[0].geometry.location.lng());
            map.setZoom(9);
            map.setCenter(results[0].geometry.location);
            marker1.setMap(null);
            // circle1.setMap(null);
            // Set the position of the marker using the place ID and location.
            marker.setPlace(
                {placeId: place.place_id, location: results[0].geometry.location});

            marker.setVisible(true);

            new_map_var = map;
            create_circle();
        });
    });

    create_circle();

    /*
    var rad = 80 * 1000;
    var circle1 = new google.maps.Circle({
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
        map: map,
        center: map.getCenter(),
        radius: rad
    }); */

    var marker1 = new google.maps.Marker({
        position: map.getCenter()
    });

    // To add the marker to the map, call setMap();
    marker1.setMap(map);

    // Add circle overlay and bind to marker
    $(document).on('change', '#customRange1', function () {
        create_circle();
        return false;

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
                newUrl = set_lat_lon(newUrl,'99');
                search(newUrl);
            }
        }, function() {
            alert('Du fant ikke nærmeste annonser fordi vi ikke får tilgang til posisjonen din. Fjern blokkeringen av siden vår fra nettleserinnstillingene dine og prøv igjen. Takk');
        });
    }
}

function set_lat_lon(newUrl,sort){
    if(sort === '99' && cur_lat && cur_lon){
        newUrl += "&lat=" + cur_lat.toFixed(6);
        newUrl += "&lon=" + cur_lon.toFixed(6);
    }
    return newUrl;
}

function remove_variables_from_url(){
    if($('#local_area_name_check'). prop("checked") == false){
        var filters = {
            "radius": true,
            "map_lng": true,
            "map_lat": true,
            "local_area_name": true,
            "local_area_name_check": true
        };

        var newUrl = $('#mega_menu_form').find(":input")
            .filter(function (i, item) {
                return !filters[item.name];
            }).serialize();

    }else if($('#local_area_name_check'). prop("checked") == true){
        var newUrl = $('#mega_menu_form').find("input[class!=area]").serialize();
    } else{
        var newUrl = $('#mega_menu_form').serialize();
    }
    return newUrl;
}


//default map postion set start
if ($("#map_lat").length && $("#map_lng").length) {
    //$("#map_lat").val(59.911491);
    //$("#map_lng").val(10.757933);
    //$("#pac-input").val('Oslo, Norge');

}
//default map position set ends

$(document).ready(function () {
    const $valueSpan = $('.valueSpan2');
    const $value = $('#customRange1');
    $valueSpan.html($value.val() + 'km');
    $value.on('input change', () => {
        $valueSpan.html($value.val() + 'km');
    });
});