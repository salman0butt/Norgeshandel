@if(!Request::is('map/select-property') && !Request::is('map/select-job'))

    <div class="form-group nav-dynamic-checks">
        <h3 class="u-t5">Område, by eller sted</h3>
        <div class="d-flex flex-row">
            <div class="mt-2">
                <input id="local_area_name_check" type="checkbox" name="local_area_name_check" {{isset(Request()->local_area_name_check) && Request()->local_area_name_check == 'on' ? 'checked' : ''}} >
                <label for="local_area_name_check"></label>
            </div>
     
        </div>

        <div class="clearfix"></div>

        <div class="mt-3" style="width:100%;">
            <div style="display: none">
                <input id="pac-input" class="controls" name="local_area_name" value="{{isset(Request()->local_area_name) ? Request()->local_area_name : 'Oslo, Norge'}}" type="text" placeholder="Enter a location">
            </div>
            <div id="map" style="clear:both; height:300px;"></div>

            <div class="d-flex justify-content-between my-2">
                <div>Avstand</div>
                <div>
                    <span class="ml-2 valueSpan2">{{isset(Request()->radius) ? Request()->radius : '10'}}km</span>
                </div>
            </div>
            <input type="range" class="custom-range w-100" name="radius" value="{{isset(Request()->radius) ? Request()->radius : '100'}}" step="5" id="customRange1" min="5" max="200">

            <input type="hidden" id="hidden_range_val" value="{{isset(Request()->radius) ? Request()->radius : '10'}}">
            <input type="hidden" id="map_lat" name="map_lat" value="{{isset(Request()->map_lat) ? Request()->map_lat : '59.911491'}}">
            <input type="hidden" id="map_lng" name="map_lng" value="{{isset(Request()->map_lng) ? Request()->map_lng : '10.757933'}}">
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
   left:52px !important;
    height:45px;
    width:86%;
    background-color: #ecdfe2;
    -webkit-transition: box-shadow 0.5s;
    -moz-transition: box-shadow 0.5s;
    -ms-transition: box-shadow 0.5s;
    -o-transition: box-shadow 0.5s;
    transition: box-shadow 0.5s;
        }
       .valueSpan2{
            font-size: 14px;
            font-weight: 400;
        }
        a[href^="http://maps.google.com/maps"]{display:none !important}
        a[href^="https://maps.google.com/maps"]{display:none !important}

       .gmnoprint a, .gmnoprint span, .gm-style-cc {
            display:none;
        }
        /*.gmnoprint div {
            background:none !important;
        }*/
        #mega_menu_form > div > div:nth-child(1) > div:nth-child(3) > div.d-flex.flex-row > div,#mega_menu_form > div > div > div > div.d-flex.flex-row > div {
                position: absolute;
                z-index: 9999999999999999;
                background: #fff;
                padding: 15px 10px;
        }
    </style>

@endif