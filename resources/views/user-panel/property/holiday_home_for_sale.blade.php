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
                <h2 class="text-muted">Fritidsbolig til salgs</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 offset-md-1">
                 @include('common.partials.property.holiday_home_for_sale_form')
            </div>
        </div>
    </div>

    <!-- Upload sales information -->
    <div wt-copy="sales-information" style="display:none">
        <div class=""  wt-duplicate="sales-information">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4 ">
                        <input type="file" name="property_home_for_sale_sales_quote[]" id="property_home_for_sale_sales_quote">
                    </div>
                    <div class="col-sm-2">
                        <button class="dme-btn-outlined-blue" type="button" wt-delete="sales-information"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attachment as PDF -->
    <div wt-copy="attachment-as-pdf" style="display:none">
        <div class=""  wt-duplicate="attachment-as-pdf">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4 ">
                        <input type="file" name="property_home_for_sale_pdf[]" id="property_home_for_sale_pdf" accept="application/pdf">
                    </div>
                    <div class="col-sm-2">
                        <button class="dme-btn-outlined-blue" type="button" wt-delete="attachment-as-pdf"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
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

        $(document).on('keyup', '.asking_price,.cost_includes,.prcentage_of_joint_debt', function() {

            var asking_price    = $(".asking_price").val();
            var costs_include   = $(".cost_includes").val();
            var percentage_of_public_debt = $(".prcentage_of_joint_debt").val();
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
            $("#total_price").val(total_price);

        });


        $("#publiserannonsen").click(function(e){

            e.preventDefault();
            if(! $('#property_holiday_home_for_sale_form').valid()) return false;

            $('.notice').html("");
            var myform = document.getElementById("property_holiday_home_for_sale_form");
            var fd = new FormData(myform);
            e.preventDefault();
            var l = Ladda.create(this);
            l.start();
            @if(Request::is('holiday/home/for/sale/*/edit'))
                var url = '{{url('holiday/home/for/sale/'.$holiday_home_for_sale1->id)}}';
            @else
                var url = '{{url('add/property/home/for/sale/ad')}}';
            @endif
            $.ajax({
                type: "POST",
                url: url,
                data: fd,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(data){
                    document.getElementById("property_holiday_home_for_sale_form").reset();
                    document.getElementById("zip_code_city_name").innerHTML = '';

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


        var i = 0;
        $("#add_more_viewing_times_sales").click(function(e){

                e.preventDefault();
                i=i+1;
                var html = '<div class="form-group">'+
                        '<label class="u-t5">Visningsdato (valgfritt)</label>'
                        +'<div class="row">'+
                            '<div class="col-sm-4 pr-md-0">'+
                                '<input type="date" name="delivery_date[]" class="dme-form-control">'+
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
                                '<input type="text" name="note[]" placeholder="F.eks.: visning etter avtale" class="dme-form-control">'+
                            '</div>'+
                        '</div>'+
                    '</div>';
                    $("#add_more_viewing_times_fields").append(html);

        });



    })

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
