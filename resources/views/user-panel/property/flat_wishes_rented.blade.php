@extends('layouts.landingSite')
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
                @if(Request::is('new/flat/wishes/rented/*/edit'))
                     @include('common.partials.property.edit_flat_wishes_rented_form')
                @else
                      @include('common.partials.property.flat_wishes_rented_form')
                @endif
                   
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
             var url = "{{url('new/flat/wishes/rented/'.$flat_wishes_rented->id)}}";
            $.ajax({
                type: "POST",
                url: url,
                data: fd,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(data){
                        $('.notice').append('<div class="alert alert-success">Eiendom lagt til!</div>');
                },
                error: function(jqXhr, json, errorThrown){// this are default for ajax errors
                        var errors = jqXhr.responseJSON;
                        console.log(errors.errors);
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
    @else
      var url = '{{url('new/flat/wishes/rented')}}';
            $.ajax({
                type: "POST",
                url: url,
                data: fd,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(data){
                        $('.notice').append('<div class="alert alert-success">Eiendom lagt til!</div>');
                },
                error: function(jqXhr, json, errorThrown){// this are default for ajax errors
                        var errors = jqXhr.responseJSON;
                        console.log(errors.errors);
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

    @endif

    </script>


@endsection
