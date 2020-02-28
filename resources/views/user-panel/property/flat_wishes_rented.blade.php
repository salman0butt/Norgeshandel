@extends('layouts.landingSite')

@section('style')
    <!-- Dropzone style files -->
    <link rel="stylesheet" href="{{asset('public/dropzone/plugins.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/dropzone/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/dropzone/basic.min.css')}}">

@endsection

@section('page_content')

<main>
    <div class="dme-container">
        <div class="row">
            <div class="col-md-10 offset-md-1 mt-5 mb-5 pl-4">
                <h2 class="text-muted">Bolig ønskes leid</h2>
            </div>
        </div>

          <div class="row">
            <div class="col-md-10 offset-md-1">
                  @include('common.partials.property.flat_wishes_rented_form')
            </div>
        </div>
    </div>
</main>

    <script>

        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


        });

        $("#publiserannonsen").click(function(e){

            e.preventDefault();

            $('.notice').html("");
            var myform = document.getElementById("flat_wishes_rented_form");
            var fd = new FormData(myform);
            e.preventDefault();
            var l = Ladda.create(this);
            l.start();
            @if(Request::is('new/flat/wishes/rented/*/edit'))
             var url = "{{url('new/flat/wishes/rented/'.$flat_wishes_rented1->id)}}";
            @else
            var url = '{{url('new/add/flat/wishes/rented')}}';
            @endif 
            $.ajax({
                type: "POST",
                url: url,
                data: fd,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(data){
                        $('.notice').append('<div class="alert alert-success">Annonsen din er publisert</div>');
                },
                error: function(jqXhr, json, errorThrown){// this are default for ajax errors
                    var errors = jqXhr.responseJSON;
                    console.log(errors.errors);
                    if(isEmpty(errors.errors))
                    {
                        $('.notice').append('<div class="alert alert-danger">noe gikk galt!</div>');
                        return false;
                    }
                    var html="<ul>";
                    $.each( errors.errors, function( index, value ){
                    console.log(value);
                    html += "<li>"+value+"</li>";
                    });
                    html += "</ul>";
                    $('.notice').append('<div class="alert alert-danger">'+html+'</div>');
                    },
            }).always(function() { l.stop(); });
            return false;

    });

    </script>


@endsection

@section('script')
    <!-- Dropzone script files -->
    <script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('public/dropzone/jquery.min.js')}}"></script>
    <script src="{{asset('public/dropzone/jquery-ui.min.js')}}"></script>
    <script src="{{asset('public/dropzone/form-dropzone.min.js')}}"></script>
    <script src="{{asset('public/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('public/mediexpert-custom-dropzone.js')}}"></script>

@endsection