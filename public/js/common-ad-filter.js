var new_url_property = '';
var new_map_var = '';
var circles = [];

var cur_lat = 0;
var cur_lon = 0;

var range_slider_value = 0;

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
    var filters = {
        "map_lng": true,
        "map_lat": true
    };

    var newUrl = $('#mega_menu_form').find(":input")
        .filter(function (i, item) {
            return !filters[item.name];
        }).serialize();
    new_url_property = newUrl;

    if(new_url_property && $('#map_lat').val() && $('#map_lng').val()){
        var map_lat = $('#map_lat').val();
        var map_lng = $('#map_lng').val();

        new_url_property += "&map_lat=" + map_lat;//.toFixed(6);
        new_url_property += "&map_lng=" + map_lng;//.toFixed(6);
        return new_url_property;
        // search(new_url_property);
    }
}

function create_circle(new_url = '') {
    removeAllcircles();
    if(!isEmpty(new_url)){
        new_url_property = new_url;
    }
    var new_rad = parseFloat($('#radius').val());

    // if(range_slider_value){
    //     new_rad = range_slider_value;
    // }else{
    //     new_rad = $('#hidden_range_val').val();
    // }
    // var new_rad = $('#customRange1').val();

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
    new_rad = parseFloat(new_rad);

    var zoomArray = {5:10.9, 10:9.9, 15:9.52, 20:8.9, 25:8.7, 30:8.55, 35:8, 40:7.9, 45:7.65, 50:7.59
        , 55:7.56, 60:7.53, 65:7, 70:6.95, 75:6.90, 80:6.85, 85:6.80, 90:6.75, 95:6.70, 100: 6.65
        , 105:6.60, 110:6.55, 115:6.53, 120:6.53, 125:6.53, 130:6, 135:6, 140:6, 145:6, 150:6
        , 155:5.95, 160:5.90, 165:5.85, 170:5.80, 175:5.75, 180:5.70, 185:5.65, 190:5.60, 195:5.58, 200:5.55};
    var zoom = zoomArray[new_rad];

    new_map_var.setZoom(zoom);

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
            // assign_lat_long();
            //console.log(results[0].geometry.location.lat(),results[0].geometry.location.lng());
            map.setZoom(20);
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
    $(document).on('change', '#radius', function () {
        range_slider_value = $(this).val();
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
    // $valueSpan.html('10km');
    $value.on('input change', () => {
        $valueSpan.html($value.val() + 'km');
    });



    $(function() {
        var valMap = [1,2,3,4,5,6,7,8,9,10,15,20,25,30,35,40,45,50,60,70,80,90,100,120,140,160,180,200];

        $("#slider").slider({
            // min: 0,
            range: "min",
            value: 9,
            max: valMap.length - 1,
            slide: function(event, ui) {
                $(".valueSpan2").text(valMap[ui.value]);
                $("#radius").val(valMap[ui.value]).change();
            },
        });

    });
});