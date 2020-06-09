@extends('layouts.landingSite')

@section('page_content')
    <main class="dme-wrapper" id="dme-wrapper">
        @include('user-panel.property.search-property-for-sale-inner')
    </main>
    <input type="hidden" id="mega_menu_search_url" value="{{url('property/property-for-sale/search')}}">
    <input type="hidden" id="back_url" value="{{ url()->current() }}">

    <script src="{{asset('public/js/property-filter.js')}}"></script>
@endsection

@section('script')
    <script>
        /*
        function fetchAddress(p) {
            var Position = new google.maps.LatLng(p.coords.latitude, p.coords.longitude),
                Locater = new google.maps.Geocoder();
            Locater.geocode({ 'latLng': Position }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var _r = results[0];
                    console.log(_r);
                    // $Selectors.dirSrc.val(_r.formatted_address);
                }
            });
        } // fetchAddress Ends

        // var initMap = function() {//
            function initMap(){
            //
            $(document).on('change', '#sort_by', function(e) {
                var val = $(this).val();
                if(val == 99){
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            fetchAddress(position);
                        });
                    }
                }
            });

        */
    </script>
    {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9Ctn550_sIhRLl-ZlZeCVr7P_yLgqg7Y&libraries=places&callback=initMap"--}}
            {{--async defer></script>--}}
    {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9Ctn550_sIhRLl-ZlZeCVr7P_yLgqg7Y&libraries=places&callback=initMap" async defer></script>--}}

@endsection
