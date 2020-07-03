@if(!Request::is('map/select-property') && !Request::is('map/select-job'))

    <div class="form-group nav-dynamic-checks">
        <h3 class="u-t5">Område, by eller sted</h3>
        <div class="d-flex flex-row">
            <div class="mt-2">
                <input id="local_area_name_check" type="checkbox" name="local_area_name_check">
                <label for="local_area_name_check"></label>
            </div>
            <div class="w-100">
                <input type="range" class="custom-range range-width mt-3" name="radius" value="80" step="5" id="customRange1" min="5" max="200">
                <span class="ml-2 valueSpan2"></span>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="mt-3" style="width:100%;">
            <div style="display: none">
                <input id="pac-input" class="controls" name="local_area_name" type="text" placeholder="Enter a location">
            </div>
            <div id="map" style="clear:both; height:300px;"></div>

            <input type="hidden" id="map_lat" name="map_lat" value="">
            <input type="hidden" id="map_lng" name="map_lng" value="">
        </div>
    </div>

    <style>
        .pac-container {
            z-index: 999999 !important;
            display: block !important;
        }
        .pac-container:empty{
            display: none !important;
        }
        .pac-container:after {
            /* Disclaimer: not needed to show 'powered by Google' if also a Google Map is shown */
            background-image: none !important;
            height: 0px;
        }
       #mega_menu_form #map > div > div > div:nth-child(12), #mega_menu_form .gm-svpc, #mega_menu_form #map > div > div > button {
            display:none !important;
        }
        #pac-input {
            outline: none;
    border-top: 0;
    border-left: 0;
    border-right: 0;
    border-bottom: 1px solid #474445;
    border-radius: 0;
    box-shadow: none ;
    padding-left: 5px;
    font-size:18px;
    color: #474445;
   left:0px !important;
    height:45px;
    width:100%;
    background-color: #ecdfe2;
    -webkit-transition: box-shadow 0.5s;
    -moz-transition: box-shadow 0.5s;
    -ms-transition: box-shadow 0.5s;
    -o-transition: box-shadow 0.5s;
    transition: box-shadow 0.5s;
        }
       .valueSpan2{
            font-size: 16px;
            font-weight: 500;
        }
        a[href^="http://maps.google.com/maps"]{display:none !important}
        a[href^="https://maps.google.com/maps"]{display:none !important}

       .gmnoprint a, .gmnoprint span, .gm-style-cc {
            display:none;
        }
        /*.gmnoprint div {
            background:none !important;
        }*/
    </style>

@endif