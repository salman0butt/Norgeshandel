@if(!Request::is('map/select-property') && !Request::is('map/select-job'))

    <div class="form-group nav-dynamic-checks">
        <h3 class="u-t5">Område, by eller sted</h3>
        <div class="float-left mt-2">
            <input id="local_area_name_check" type="checkbox" name="local_area_name_check">
            <label for="local_area_name_check"></label>
        </div>
        <div class="clearfix"></div>

        <div class="mt-3" style="width:97%;">
            <div style="display: none">
                <input id="pac-input" class="controls" name="local_area_name" type="text" placeholder="Enter a location">
            </div>
            <div id="map" style="clear:both; height:250px;"></div>
            <input type="range" class="custom-range" name="radius" id="customRange1" value="20">
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
        #mega_menu_form #map > div > div > div:nth-child(12),#mega_menu_form .gm-svpc, #mega_menu_form #map > div > div > button {
            display:none;
        }
        #pac-input {
            width:100%;
            left:0px !important;
            border: 2px solid #ac304a;
            border-radius: 8px !important;
            padding: 5px 5px 5px 15px;
            font-size: 25px;
            color: #474445;
            /* font-weight: bold; */
            height: 40px;
            z-index: 5;
        }
    </style>

@endif