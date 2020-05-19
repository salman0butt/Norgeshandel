$(function(){
    mapboxgl.accessToken =
        'pk.eyJ1Ijoic2FsbWFuMTEyMzQiLCJhIjoiY2thYzR1Ym5lMHdpNjJ6cnVrMHYybXkwcCJ9.ueSOEnMd9XPHVmi8jrReDw';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-79.4512, 43.6568],
        zoom: 13
    });
    map.addControl(new mapboxgl.NavigationControl());


    var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        mapboxgl: mapboxgl
    });

    document.getElementById('geocoder').appendChild(geocoder.onAdd(map));


    var myloc = new L.LatLng(59.9139, 10.7522);
    var map = L.map('map', { zoomControl: false }).setView(myloc, 15);
    var marker = L.marker(myloc).addTo(map);

    var circle = L.circle(myloc, {
        color: '#f03',
        weight: 0.1,
        fillColor: '#f03',
        fillOpacity: 0.4,
        radius: 100
    }).addTo(map);

    var slider = document.getElementById("myRange");
    var output = document.getElementById("distance-map");
    output.innerHTML = slider.value;


    slider.oninput = function () {
        output.innerHTML = this.value;
        circle.setRadius(this.value); // Sets the radius of the circle to be the value of the slider
        var latLng = circle.getLatLng();
        var radius = circle.getRadius();
        console.log(this.value);
        console.log(latLng);
        console.log(radius);
    }

    function clickCircle(e) {
        var clickedCircle = e.target;
        console.log(e.target);
    }
});