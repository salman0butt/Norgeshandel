@extends('layouts.map')
@section('styles')

<link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">

<link rel="stylesheet" href="{{asset('public/mediexpert.css')}}">
<link rel="stylesheet" href="{{asset('public/mediexpert-mq.css')}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link href="{{ asset('public/css/diriection.css') }}" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
var jQuery_1_8_3 = jQuery.noConflict();
</script> 
<script src="{{asset('public/admin/js/jquery.min.js')}}"></script>

@stop
@section('content')

<div id="mapper">

</div>
@stop
@section('scripts')
<script src="{{asset('public/admin/js/bootstrap.min.js')}}"></script>
<script>
    $(function () {
       var url = '{{ url('/map/search') }}';
        getMap(url);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')
            }
        });
        function getMap(url){
            if(url == '') {
                return;
            }
             jQuery.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                $('#mapper').html('');
                $('#mapper').html(data);
                initMap();
                //console.log(data);

            },
            error: function (jqXhr, json, errorThrown) { // this are default for ajax errors
                console.log(jqXhr);
                // console.log(jqXhr.responseJSON);

            },

        });

        }
        $('#search').on('click',function() {
            $(this).parent().find('li.nav-item').addClass('active');
           url = '{{ url('/map/search') }}';
          getMap(url);
        });
        $('#direction').on('click',function() {
              $(this).parent().find('li.nav-item').addClass('active');
           url = '{{ url('/map/direction') }}';
          getMap(url);
        });
       
    });

</script>
@endsection
