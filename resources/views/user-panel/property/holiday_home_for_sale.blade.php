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
           function record_store_ajax_request(event, this_obj) {
               if(event == 'click'){
                  if(! $('#property_holiday_home_for_sale_form').valid()) return false;
                       }
               var url = '';
                if (event == 'change') {
                    console.log('status 1');
                    var zip_code = $('.zip_code').val();
                    var old_zip = $('#old_zip').val();
                    console.log(old_zip);
                    if (zip_code) {
                        if (old_zip != zip_code) {
                            find_zipcode_city(zip_code);
                        }
                    }
                    @if(Request::is('new/property/sale/ad/*/edit') || Request::is('complete/ad/*'))
                       var url = '{{url('holiday/home/for/sale/'.$holiday_home_for_sale1->id)}}';
                    @endif
                } else {
                    @if(Request::is('new/property/sale/ad/*/edit') || Request::is('complete/ad/*'))
                    var url = '{{url('holiday/home/for/sale/update/'.$holiday_home_for_sale1->id)}}';
                    @endif
                }
                console.log('status 2');
                //if (!$('#property_for_rent_form').valid()) return false;

                $("input ~ span,select ~ span").each(function (index) {
                    $(".error-span").html('');
                    $("input, select").removeClass("error-input");
                });
                $('.notice').html("");

                console.log('status 3');
                var myform = document.getElementById("property_holiday_home_for_sale_form");
                var fd = new FormData(myform);
                
                // fd.append('property_photos', $('#property_photos').get(0).files[0]);
                var l = Ladda.create(this_obj);
                l.start();
                $.ajax({
                    type: "POST",
                    url: url,
                    data: fd,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log(data);
                       // document.getElementById("property_for_rent_form").reset();
                       // document.getElementById("zip_code_city_name").innerHTML = '';
                           if (event == 'change') {
                        setTimeout(function () {
                            $('.notice').show('slow');
                        }, 2000);
                        setTimeout(function () {
                            $('.notice').hide('slow');
                        }, 5000);
                    }
                    $('.notice').html('<div class="alert alert-success">Annonsen din er publisert</div>');

                    },
                    error: function (jqXhr, json, errorThrown) { // this are default for ajax errors

                        var errors = jqXhr.responseJSON;
                        console.log(errors.errors);
                        if (isEmpty(errors.errors)) {
                            $('.notice').html('<div class="alert alert-danger">noe gikk galt!</div>');
                            return false;
                        }
                        if (!isEmpty(errors.errors)) {
                            console.log(errors.errors);
                            $.each(errors.errors, function (index, value) {
                                $("." + index).html(value);
                                $("input[name='" + index + "'],select[name='" + index + "']").addClass("error-input");
                            });
                        } else {
                            $('.notice').html('<div class="alert alert-danger">noe gikk galt!</div>');
                        }
                    },

                }).always(function () {
                    l.stop();
                });
                return false;
            }
            
            $("input").on('change', function (e) {
                e.preventDefault();
                var postal = $('.zip_code').val();
                $('#old_zip').attr('value',postal);
               record_store_ajax_request('change', (this));
            });
            //click button update
            $("#publiserannonsen").click(function (e) {
                e.preventDefault();
                record_store_ajax_request('click', (this));
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
