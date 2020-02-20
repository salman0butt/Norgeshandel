@extends('layouts.landingSite')
@section('page_content')

<!-- property for sale -->
<main>
        <div class="dme-container">
            <div class="row">
                <div class="col-md-10 offset-md-1 mt-5 mb-5">
                    <h2 class="text-muted">Næringstomt</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    @include('common.partials.property.commercial_plots_form')
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 
        
            $("#publiserannonsen").click(function(e){

                e.preventDefault();
                var l = Ladda.create(this);
                l.start();
                
                @if(Request::is('commercial/plots/*/edit'))
                var url = "{{url('commercial/plots/'.$commercial_plots->id)}}";
                @else 
                var url = '{{url('add/commercial/plot/ad')}}';
                @endif

                
                $('.notice').html("");
                var myform = document.getElementById("commercial_plot_form");
                var fd = new FormData(myform);

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

            });

        })

    </script>

@endsection