var added = false;

var cur_lat = 0;
var cur_lon = 0;

var new_url_property = '';
var new_map_var = '';
var new_circle_var = '';
var circles = [];

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

            // Set the position of the marker using the place ID and location.
            marker.setPlace(
                {placeId: place.place_id, location: results[0].geometry.location});

            marker.setVisible(true);

            new_map_var = map;
            removeAllcircles();
            create_circle();
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

$(document).ready(function () {
    const $valueSpan = $('.valueSpan2');
    const $value = $('#customRange1');
    $valueSpan.html($value.val()+'km');
    $value.on('input change', () => {
        $valueSpan.html($value.val()+'km');
    });


    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    search(urlParams.toString());
    fix_page_links();

    $('.mega-menu input').change(function (e) {
        var id = $(this).attr('id');
        var newUrl = $('#mega_menu_form').serialize();

        var view = getUrlParameter('view');
        var sort = getUrlParameter('sort');
        var user_id = getUrlParameter('user_id');

        if (!isEmpty(user_id)) {
            newUrl += "&user_id=" + user_id;
        }
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
        // else if (id === 'customRange1'){
           // create_circle(newUrl);
        // }
        else{
            search(newUrl);
        }

        // fix_page_links();
        var back_url = $('#back_url').val();
        if (!added) {
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
            added = true;
        } else {
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
        }
        // fix_page_links();
    });

    $(document).on('click', 'a.page-link', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var page_param = url.split('=');
        var page = page_param[1];
        var newUrl = $('#mega_menu_form').serialize();
        var sort = getUrlParameter('sort');
        var view = getUrlParameter('view');
        var user_id = getUrlParameter('user_id');
        if (parseInt(user_id)>0) {
            newUrl += "&user_id=" + user_id;
        }
        if (!isEmpty(sort)) {
            newUrl += "&sort=" + sort;
        }
        if (!isEmpty(view)) {
            newUrl += "&view=" + view;
        }
        if (!isEmpty(page)) {
            newUrl += "&page=" + page;
        }
        newUrl = set_lat_lon(newUrl,sort);
        // history.pushState('data', 'NorgesHandel', "?" + newUrl);
        search(newUrl);
        // fix_page_links();
        var back_url = $('#back_url').val();
        if (!added) {
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
            added = true;
        } else {
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
        }
    });

    $(document).on('change', '#sort_by', function () {
        var newUrl = $('#mega_menu_form').serialize();
        var sort = $(this).val();
        var view = getUrlParameter('view');
        var page = getUrlParameter('page');
        var user_id = getUrlParameter('user_id');
        if (parseInt(user_id)>0) {
            newUrl += "&user_id=" + user_id;
        }
        if (!isEmpty(sort)) {
            newUrl += "&sort=" + sort;
        }
        if (!isEmpty(view)) {
            newUrl += "&view=" + view;
        }
        if (!isEmpty(page)) {
            newUrl += "&page=" + page;
        }
        // newUrl = set_lat_lon(newUrl,sort);

        if(sort === '99' && (!cur_lon || !cur_lat)) {
            get_curr_location(newUrl);
        }else{
            newUrl = set_lat_lon(newUrl,sort);
            search(newUrl);
        }


        // fix_page_links();
        var back_url = $('#back_url').val();
        if (!added) {
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
            added = true;
        } else {
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
        }

    });
    $(document).on('click', '#view', function (e) {

        e.preventDefault();
        // urlParams = new URLSearchParams(window.location.search)
        // console.log(urlParams);
        var newUrl = $('#mega_menu_form').serialize();

        var sort = getUrlParameter('sort');
        var view = $(this).attr('data-view');
        var page = getUrlParameter('page');
        var user_id = getUrlParameter('user_id');
        if (!isEmpty(user_id)) {
            newUrl += "&user_id=" + user_id;
        }

        if (!isEmpty(sort)) {
            newUrl += "&sort=" + sort;
        }
        if (!isEmpty(view)) {
            newUrl += "&view=" + view;
        }
        if (!isEmpty(page)) {
            newUrl += "&page=" + page;
        }
        newUrl = set_lat_lon(newUrl,sort);
        // history.pushState('data', 'NorgesHandel', "?" + newUrl);
        search(newUrl);
        // fix_page_links();
        var back_url = $('#back_url').val();
        if (!added) {
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
            added = true;
        } else {
            window.history.replaceState(back_url, 'NorgesHandel', "?" + newUrl);
        }
    });
    // $(window).on('popstate', function (e) {
    //     window.location.href = window.location.href.split("?")[0];
    // });

});