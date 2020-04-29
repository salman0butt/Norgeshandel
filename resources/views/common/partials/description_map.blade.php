@section('map')
    <script>
        $(function() {
        var lat = '{{ $map_obj->latitude }}';
        var lon = '{{ $map_obj->longitude }}';
        var full_address = '{{ $map_obj->full_address }}';
        showMap(lat, lon, full_address);
         });
    </script>
@stop
