
function myFunction(arr) {
    console.log(arr);
    if (arr.adresser.length > 0) {

        $('#latitude').val(arr.adresser[0].representasjonspunkt.lat);
        $('#longitude').val(arr.adresser[0].representasjonspunkt.lon);
        $('#full_address').val(arr.adresser[0].adressetekst + " " + arr.adresser[0].poststed + " " + arr.adresser[0].postnummer);
        console.log(arr.adresser[0].adressetekst + " " + arr.adresser[0].poststed + " " + arr.adresser[0].postnummer);
      
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

function addr_search(full_address) {
    var inp = full_address;
    console.log(inp);
    var xmlhttp = new XMLHttpRequest();
    var url = "https://ws.geonorge.no/adresser/v1/sok?adressetekst="+inp+"&treffPerSide=1&side=0&asciiKompatibel=true";
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var myArr = JSON.parse(this.responseText);
            console.log(myArr);
            console.log(myArr.adresser[0].adressetekst + " " + myArr.adresser[0].poststed + " " + myArr.adresser[0].postnummer);
      
            myFunction(myArr);
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function fullAddress() {
    var zip = $('.zip_code').val();
    var city = document.querySelector("#zip_code_city_name").innerText.toLowerCase();
    var street = $('input[name="street_address"]').val();
    var full_address = street + ' ' + city + ' ' + zip;
    console.log("full address "+full_address);
    addr_search(full_address);
    
}

function showMap(startlat, startlon, full_address){
    var options = {
        center: [startlat, startlon],
        zoom: 18,
        attributionControl: false
    }
    var map = L.map('map', options);
    var nzoom = 12;
    L.tileLayer('https://opencache.statkart.no/gatekeeper/gk/gk.open_gmaps?layers=norges_grunnkart&zoom={z}&x={x}&y={y}', {
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
