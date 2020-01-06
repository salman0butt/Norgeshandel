@extends('layouts.landingSite')
@section('page_content')

<!-- property for rent -->
        <main>
            <div class="dme-container">
                <div class="row">
                    <div class="col-md-10 offset-md-1 mt-5 mb-5">
                        <h2 class="text-muted">Bedrifter til salgs</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="notice"></div>
                        @include('common.partials.property.business_for_sale_form')
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

            $("#publiser_annonsen").click(function(e){

                    e.preventDefault();
                    $('.notice').html("");
                    var url = '{{url('add/business/for/sale')}}';
            
                    var myform = document.getElementById("business_for_sale");
                    var fd = new FormData(myform);

                    
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: fd,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function(data){
                            console.log(data);
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
                
                    });
            
            });

        });

    

    </script>

@endsection