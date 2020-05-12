
function myFunction(arr) {
    console.log(arr);
    if (arr.adresser.length > 0) {

        $('#latitude').val(arr.adresser[0].representasjonspunkt.lat);
        $('#longitude').val(arr.adresser[0].representasjonspunkt.lon);
        $('#full_address').val(arr.adresser[0].adressetekst + ", " + arr.adresser[0].postnummer + " "+ arr.adresser[0].poststed);
        console.log(arr.adresser[0].adressetekst + ", " + arr.adresser[0].postnummer + " " + arr.adresser[0].poststed);
    }
    else {
        console.log("Sorry, no results...");
    }

}
// function addr_search(full_address) {
//     var inp = full_address;
//     console.log(inp);
//     var xmlhttp = new XMLHttpRequest();
//     var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + inp;
//     xmlhttp.onreadystatechange = function () {
//         if (this.readyState == 4 && this.status == 200) {
//             var myArr = JSON.parse(this.responseText);
//             console.log(myArr);
//             myFunction(myArr);
//         }
//     };
//     xmlhttp.open("GET", url, true);
//     xmlhttp.send();
// }

function addr_search(street, city, zip) {

    var xmlhttp = new XMLHttpRequest();
    var url = "https://ws.geonorge.no/adresser/v1/sok?adressetekst="+street+"&poststed="+city+"&postnummer="+zip+"&treffPerSide=10&side=0&asciiKompatibel=true";
   

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var myArr = JSON.parse(this.responseText);
            console.log(myArr);
      
            myFunction(myArr);
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function fullAddress() {
    var zip = $('.zip_code').val();
    var city = (document.querySelector("#zip_code_city_name") ? document.querySelector("#zip_code_city_name").innerText.toLowerCase() : '');
    var street = $('input[name="street_address"],input[name="address"]').val();
    if (isEmpty(zip) || isEmpty(city) || isEmpty(street)){
        return;
    }
    addr_search(street, city, zip);
    
}
function companyAddress(element) {
        var id = element;
        var zip = $('#zip_'+id).val();
        var city = $("#zip_code_city_name_"+id)[0].innerText.toLowerCase();
        var street = $('#address_'+id).val();
        console.log(zip);
        console.log(city);
        console.log(street);
        if (isEmpty(zip) || isEmpty(city) || isEmpty(street)) {
            return;
        }
        addr_search(street, city, zip);
}

function showMap(startlat, startlon, full_address){
    var options = {
        center: [startlat, startlon],
        zoom: 12,
        attributionControl: false
    }
    var map = L.map('map', options);
    var nzoom = 12;
    L.tileLayer('https://opencache.statkart.no/gatekeeper/gk/gk.open_gmaps?layers=topo4&zoom={z}&x={x}&y={y}', {
        attribution: '<a href="http://www.kartverket.no/">Kartverket</a>'
    }).addTo(map);
    // L.marker([startlat, startlon]).addTo(map)
    //     .bindPopup('<strong>' + full_address +'</strong>.')
    //     .openPopup();

    var myMarker = L.marker([startlat, startlon], { title: "Coordinates", alt: "Coordinates", draggable: true }).addTo(map).on('dragend', function () {
        var lat = myMarker.getLatLng().lat.toFixed(8);
        var lon = myMarker.getLatLng().lng.toFixed(8);
        var czoom = map.getZoom();
        if (czoom < 18) { nzoom = czoom + 2; }
        if (nzoom > 18) { nzoom = 18; }
        if (czoom != 18) { map.setView([lat, lon], nzoom); } else { map.setView([lat, lon]); }

          myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
         
        var latlng = L.latLng(lat, lon);
        var map = L.map('map').setView([lat, lon], 18);
        
        var popup = L.popup()
            .setLatLng(latlng)
            .setContent('<p>Hello world!<br />This is a nice popup.</p>')
            .openOn(map);
         L.marker([lat, lon]).addTo(map);
       
    }).bindPopup('<strong>' + full_address + '</strong>.',{
        maxWidth:200
    }).openPopup();
}
