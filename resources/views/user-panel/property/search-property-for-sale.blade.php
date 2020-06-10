@extends('layouts.landingSite')

@section('page_content')
    <main class="dme-wrapper" id="dme-wrapper">

        @include('user-panel.property.search-property-for-sale-inner')
    </main>

    {{--<div id="results"></div>--}}
    {{--<button id="more">More results</button>--}}
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


       var map;
       var service;
       var infowindow;

       function initMap() {

           $(document).on('change', '#sort_by', function(e) {
               var val = $(this).val();
               if(val == 99){
                   if (navigator.geolocation) {
                       navigator.geolocation.getCurrentPosition(function(position) {
                           fetchAddress1(position);
                       });
                   }
               }
           });

           function fetchAddress1(p){
               var pyrmont = new google.maps.LatLng(p.coords.latitude,p.coords.longitude);//

               // map = new google.maps.Map(document.getElementById('map'), {
               //     center: pyrmont,
               //     zoom: 15
               // });

               var request = {
                   location: new google.maps.LatLng(59.77566488141714, 5.502821107291793),
                   // location: pyrmont,
                   radius: '10000',
                   type: ['cities'],
                   componentRestrictions: {country: 'no'}
               };
               var container = document.getElementById('results');
               service = new google.maps.places.PlacesService(container);

               var getNextPage = null;
               var moreButton = document.getElementById('more');
               moreButton.onclick = function() {
                   moreButton.disabled = true;
                   if (getNextPage) getNextPage();
               };




               service.nearbySearch(
                   {location: new google.maps.LatLng(59.77566488141714, 5.502821107291793), radius: 500, type: ['cities']},
                   function(results, status, pagination) {
                       if (status !== 'OK') return;

                       callback(results,status);
                       moreButton.disabled = !pagination.hasNextPage;
                       getNextPage = pagination.hasNextPage && function() {
                           pagination.nextPage();
                       };
                   });


               // service.nearbySearch(request, callback);

               function callback(results, status) {
                   if (status == google.maps.places.PlacesServiceStatus.OK) {
                       alert(results.length);
                       for (var i = 0; i < results.length; i++) {
                           console.log(results[i]);
                           // console.log(results[i].geometry.location.lat());
                           var place = results[i];

                           // container.innerHTML += results[i].name + '<br />';
                           // createMarker(results[i]);
                       }
                   }
               }
           }

       }
       */
    </script>
    {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9Ctn550_sIhRLl-ZlZeCVr7P_yLgqg7Y&libraries=places&callback=initMap" async defer></script>--}}

@endsection
