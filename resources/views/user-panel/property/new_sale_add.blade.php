@extends('layouts.landingSite')
@section('page_content')

<!-- property for sale -->
<main>
        <div class="dme-container">
            <div class="row">
                <div class="col-md-10 offset-md-1 mt-5 mb-5">
                    <h2 class="text-muted">Bolig til Salgs</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="notice"></div>
                    @include('common.partials.property.property_for_sale_form')
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


            $(document).on('keyup', '.asking_price,.costs_include,.percentage_of_public_debt', function() {

                var asking_price    = $(".asking_price").val();
                var costs_include   = $(".costs_include").val();
                var percentage_of_public_debt = $(".percentage_of_public_debt").val();
                if(asking_price == "")
                {
                    asking_price = 0;
                }
                if(costs_include == "")
                {
                    costs_include = 0;
                }
                if(percentage_of_public_debt == "")
                {
                    percentage_of_public_debt = 0;
                }

                var total_price = parseInt(asking_price) + parseInt(costs_include) + parseInt(percentage_of_public_debt);
                $("#total_price_sale_add").text(total_price);
                $("#total_price").val(total_price);

            });

            $("#publiserannonsen").click(function(e){

                e.preventDefault();

                var url = '{{url('add/property/sale/ad')}}';
                $('.notice').html("");
                var myform = document.getElementById("property_for_sale_form");
                var fd = new FormData(myform);

                e.preventDefault();
                var l = Ladda.create(this);
                l.start();
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
                                $("#"+index).html(value);
                                $("input[name='"+index+"'],select[name='"+index+"']").addClass("error-input");
                            });
                            html += "</ul>";
                        },
                }).always(function() { l.stop(); });
                return false;

            });

            var i = 0;
            $("#add_more_viewing_times_sales").click(function(e){

                    e.preventDefault();
                    var html = '<div class="form-group">'+
                            '<label class="u-t5">Visningsdato (valgfritt)</label>'
                            +'<div class="row">'+
                                '<div class="col-sm-4 pr-md-0">'+
                                    '<input type="date" name="deliver_date[]" class="dme-form-control">'+
                                    '<span class="u-t5">Dato (eks. 31.12.2017 eller 31/12/2017)</span>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label class="u-t5">Fra klokken (valgfritt)</label>'+
                            '<div class="row">'+
                                '<div class="col-sm-4 pr-md-0">'+
                                    '<input type="text" name="from_clock[]" placeholder="tt.mm" class="dme-form-control">'+
                                    '<span class="u-t5">Tid (eksempel 18:00)</span>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label class="u-t5">Til klokken (valgfritt)</label>'+
                            '<div class="row">'+
                                '<div class="col-sm-4 pr-md-0">'+
                                    '<input type="text" name="clockwise[]" placeholder="tt.mm" class="dme-form-control">'+
                                    '<span class="u-t5">Tid (eksempel 19:00)</span>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
                            '<label class="u-t5">Merknad (valgfritt)</label>'+
                            '<div class="row">'+
                                '<div class="col-sm-12 pr-md-0">'+
                                    '<input type="text" name="note1[]" placeholder="F.eks.: visning etter avtale" class="dme-form-control">'+
                                '</div>'+
                            '</div>'+
                        '</div>';
                        $("#add_more_viewing_times_fields").append(html);

            });


        })

    </script>

@endsection
