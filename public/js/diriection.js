
var initMap = function() {

    var map,
        directionsService, directionsDisplay,
        autoSrc, autoDest, pinA, pinB,

        markerA = new google.maps.MarkerImage('public/m1.png',
            new google.maps.Size(24, 27),
            new google.maps.Point(0, 0),
            new google.maps.Point(12, 27)),
        markerB = new google.maps.MarkerImage('public/m2.png',
            new google.maps.Size(24, 28),
            new google.maps.Point(0, 0),
            new google.maps.Point(12, 28)),

        // Caching the Selectors		
        $Selectors = {
            mapCanvas: jQuery_1_8_3('#mapCanvas')[0],
            dirPanel: jQuery_1_8_3('#directionsPanel'),
            dirInputs: jQuery_1_8_3('.directionInputs'),
            dirSrc: jQuery_1_8_3('#dirSource'),
            dirDst: jQuery_1_8_3('#dirDestination'),
            getDirBtn: jQuery_1_8_3('#getDirections'),
            dirSteps: jQuery_1_8_3('#directionSteps'),
            paneToggle: jQuery_1_8_3('#paneToggle'),
            useGPSBtn: jQuery_1_8_3('#useGPS'),
            paneResetBtn: jQuery_1_8_3('#paneReset')
        };

    function autoCompleteSetup() {
        autoSrc = new google.maps.places.Autocomplete($Selectors.dirSrc[0]);
        autoSrc.setComponentRestrictions({ 'country': ['no'] });
        autoDest = new google.maps.places.Autocomplete($Selectors.dirDst[0]);
        autoDest.setComponentRestrictions({ 'country': ['no'] });
    } // autoCompleteSetup Ends

    function directionsSetup() {
        directionsService = new google.maps.DirectionsService();
        directionsDisplay = new google.maps.DirectionsRenderer({
            suppressMarkers: true
        });

        directionsDisplay.setPanel($Selectors.dirSteps[0]);
    } // direstionsSetup Ends

    function trafficSetup() {
        // Creating a Custom Control and appending it to the map
        var controlDiv = document.createElement('div'),
            controlUI = document.createElement('div'),
            trafficLayer = new google.maps.TrafficLayer();

        jQuery(controlDiv).addClass('gmap-control-container').addClass('gmnoprint');
        jQuery(controlUI).text('Trafikk').addClass('gmap-control');
        jQuery(controlDiv).append(controlUI);

        // Traffic Btn Click Event	  
        google.maps.event.addDomListener(controlUI, 'click', function() {
            if (typeof trafficLayer.getMap() == 'undefined' || trafficLayer.getMap() === null) {
                jQuery(controlUI).addClass('gmap-control-active');
                trafficLayer.setMap(map);
            } else {
                trafficLayer.setMap(null);
                jQuery(controlUI).removeClass('gmap-control-active');
            }
        });
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(controlDiv);
    } // trafficSetup Ends

    function mapSetup() {
        map = new google.maps.Map($Selectors.mapCanvas, {
            zoom: 13,
            center: new google.maps.LatLng(59.911491, 10.757933),
            componentRestrictions: { country: 'no' },
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DEFAULT,
                position: google.maps.ControlPosition.TOP_CENTER
            },

            panControl: true,
            panControlOptions: {
                position: google.maps.ControlPosition.RIGHT_TOP
            },

            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE,
                position: google.maps.ControlPosition.RIGHT_TOP
            },

            scaleControl: true,
            streetViewControl: true,
            overviewMapControl: true,
        
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        autoCompleteSetup();
        directionsSetup();
        trafficSetup();
    } // mapSetup Ends 

    function directionsRender(source, destination) {
        $Selectors.dirSteps.find('.msg').hide();
        directionsDisplay.setMap(map);

        var request = {
            origin: source,
            destination: destination,
            provideRouteAlternatives: false,
            travelMode: google.maps.DirectionsTravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false

        };

        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {

                directionsDisplay.setDirections(response);

                var _route = response.routes[0].legs[0];
                console.log(_route);

                pinA = new google.maps.Marker({ position: _route.start_location, map: map, icon: markerA }),
                    pinB = new google.maps.Marker({ position: _route.end_location, map: map, icon: markerB });
            }
        });
    } // directionsRender Ends

    function fetchAddress(p) {
        var Position = new google.maps.LatLng(p.coords.latitude, p.coords.longitude),
            Locater = new google.maps.Geocoder();

        Locater.geocode({ 'latLng': Position }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var _r = results[0];
                $Selectors.dirSrc.val(_r.formatted_address);
            }
        });
    } // fetchAddress Ends

    function invokeEvents() {
        // Get Directions
        $Selectors.getDirBtn.on('click', function(e) {
            e.preventDefault();
            var src = $Selectors.dirSrc.val(),
                dst = $Selectors.dirDst.val();

            directionsRender(src, dst);
        });

        // Reset Btn
        $Selectors.paneResetBtn.on('click', function(e) {
            $Selectors.dirSteps.html('');
            $Selectors.dirSrc.val('');
            $Selectors.dirDst.val('');

            if (pinA) pinA.setMap(null);
            if (pinB) pinB.setMap(null);

            directionsDisplay.setMap(null);
        });

        // Toggle Btn
        $Selectors.paneToggle.toggle(function(e) {
            $Selectors.dirPanel.animate({ 'left': '-=305px' });
            jQuery(this).html('&gt;');
        }, function() {
            $Selectors.dirPanel.animate({ 'left': '+=305px' });
            jQuery(this).html('&lt;');
        });

        // Use My Location / Geo Location Btn
        $Selectors.useGPSBtn.on('click', function(e) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    fetchAddress(position);
                });
            }
        });
    } //invokeEvents Ends 

    mapSetup();
    invokeEvents();
};
