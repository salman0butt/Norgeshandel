@extends('layouts.landingSite')

@section('style')
    <!-- Dropzone style files -->
    <link rel="stylesheet" href="{{asset('public/dropzone/plugins.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/dropzone/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/dropzone/basic.min.css')}}">

@endsection

@section('page_content')
    @php
        $property_status = '';
        if(Request()->id && Request::is('holiday/home/for/sale/*/edit')){
            $property = \App\PropertyHolidaysHomesForSale::find(Request()->id);
            if($property && $property->ad){
                $property_status = $property->ad->status;
            }
        }elseif(Request()->id && Request::is('complete/ad/*')){
            $ad = \App\Models\Ad::find(Request()->id);
            if($ad){
                $property_status = $ad->status;
            }
        }
    @endphp
    <input type="hidden" class="ad_status" value="{{$property_status}}">
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

</main>
<script type="text/javascript">

    function record_store_ajax_request(event, this_obj) {

        if($('.text-editor').length > 0) tinyMCE.triggerSave();

        if(event == 'click'){
            if(! $('#property_holiday_home_for_sale_form').valid()) return false;
        }
        var url = '';
        if (event == 'change') {

            var zip_code = $('.zip_code').val();
            var old_zip = $('#old_zip').val();
            //console.log(old_zip);
            if (zip_code) {
                if (old_zip != zip_code) {
                    find_zipcode_city(zip_code);
                    $('input[name="street_address"],input[name="address"]').val('');
                     $('input[name="street_address"],input[name="address"]').parent().find('span.u-t5').remove();
                }
            }
            @if(Request::is('holiday/home/for/sale/*/edit') || Request::is('complete/ad/*'))
            var url = '{{url('holiday/home/for/sale/'.$holiday_home_for_sale1->id)}}';
            @endif
        } else {
            @if(Request::is('holiday/home/for/sale/*/edit') || Request::is('complete/ad/*'))
            var url = '{{url('holiday/home/for/sale/update/'.$holiday_home_for_sale1->id)}}';
            @endif
        }

        //if (!$('#property_for_rent_form').valid()) return false;

        $("input ~ span,select ~ span").each(function (index) {
            $(".error-span").html('');
            $("input, select").removeClass("error-input");
        });
        //$('.notice').html("");

        //console.log('status 3');
        var myform = document.getElementById("property_holiday_home_for_sale_form");
        var fd = new FormData(myform);

        if($('.remove_property_quote').attr('id')){
            fd.delete('property_home_for_sale_sales_quote');
        }

        if($('.remove_property_pdf').attr('id')){
            fd.delete('property_home_for_sale_pdf');
        }
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
                // document.getElementById("property_for_rent_form").reset();
                // document.getElementById("zip_code_city_name").innerHTML = '';
                if (event == 'change') {
                    notify("info","Annonsen din er lagret");

                }else if(event == 'click'){
                    $('.deleted_media').val('');
                    $('.media_position').val('');
                    $('.ad_status').val(data.status);
                    var message = 'Annonsen din er publisert';
                    if(data.message){
                        message = data.message;
                    }
                    notify("success",message);
                }

                if(data.property_quote){
                    $('.remove_property_quote').attr('id',data.property_quote);
                }
                if(data.property_pdf){
                    $('.remove_property_pdf').attr('id',data.property_pdf);
                }

            },
            error: function (jqXhr, json, errorThrown) { // this are default for ajax errors

                var errors = jqXhr.responseJSON;
                //console.log(errors.errors);
                if (isEmpty(errors.errors)) {
                    notify("error","noe gikk galt!");
                    return false;
                }
                if (!isEmpty(errors.errors)) {
                    //console.log(errors.errors);
                    $.each(errors.errors, function (index, value) {
                        $("." + index).html(value);
                        $("input[name='" + index + "'],select[name='" + index + "']").addClass("error-input");
                    });
                } else {
                    notify("error","noe gikk galt!");
                }
            },

        }).always(function () {
            l.stop();
        });
        return false;
    }

    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('keyup', '.asking_price,.prcentage_of_joint_debt', function() {

            var asking_price    = $(".asking_price").val();
            // var costs_include   = $(".cost_includes").val();
            var percentage_of_public_debt = $(".prcentage_of_joint_debt").val();
            if(asking_price == "")
            {
                asking_price = 0;
            }

            if(percentage_of_public_debt == "")
            {
                percentage_of_public_debt = 0;
            }
            // + parseInt(costs_include)
            var total_price = parseInt(asking_price) + parseInt(percentage_of_public_debt);
            $("#total_price").val(total_price);

        });          

        $(document).on('change', 'input:not(input[type=date]),textarea', function(e) {
            e.preventDefault();
            if(! $(this).valid()) return false;

            var ad_status = $('.ad_status').val();
            if(ad_status == 'saved'){
                record_store_ajax_request('change', (this));
            }else{
                var zip_code = $('.zip_code').val();
                var old_zip = $('#old_zip').val();

                if (zip_code) {
                    if (old_zip != zip_code) {
                        find_zipcode_city(zip_code);
                    }
                }
            }
            var postal = $('.zip_code').val();
            $('#old_zip').attr('value',postal);

            //calling address
             fullAddress();
        });
        //click button update
        $(document).on('click', '#publiserannonsen', function(e){
            e.preventDefault();
            record_store_ajax_request('click', (this));
        });
       

        var i = 0;
        $("#add_more_viewing_times_sales").click(function(e){

                e.preventDefault();
                i=i+1;
                var html = '<div class="appended_viewing_times_fields"><div class="form-group">'+
                        '<label class="u-t5">Visningsdato (valgfritt)</label>'
                        +'<div class="row">'+
                            '<div class="col-sm-4 pr-md-0">'+
                                '<input type="text" name="secondary_deliver_date[]" class="dme-form-control date-picker">'+
                                '<span class="u-t5">Dato (eks. 31.12.2017 eller 31/12/2017)</span>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label class="u-t5">Fra klokken (valgfritt)</label>'+
                        '<div class="row">'+
                            '<div class="col-sm-4 pr-md-0">'+
                                '<input type="text" name="secondary_from_clock[]" placeholder="tt.mm" class="dme-form-control">'+
                                '<span class="u-t5">Tid (eksempel 18:00)</span>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label class="u-t5">Til klokken (valgfritt)</label>'+
                        '<div class="row">'+
                            '<div class="col-sm-4 pr-md-0">'+
                                '<input type="text" name="secondary_clockwise[]" placeholder="tt.mm" class="dme-form-control">'+
                                '<span class="u-t5">Tid (eksempel 19:00)</span>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label class="u-t5">Merknad (valgfritt)</label>'+
                        '<div class="row">'+
                            '<div class="col-sm-12 pr-md-0">'+
                                '<input type="text" name="secondary_note[]" placeholder="F.eks.: visning etter avtale" class="dme-form-control">'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="form-group">' +
                        '<div class="row">' +
                            '<div class="col-sm-12 pr-md-0">' +
                                '<button type="button" class="dme-btn-outlined-blue remove_appended_viewing_times_fields">Fjern</button>' +
                            '</div>' +
                        '</div>' +
                    '</div></div>';
                    $("#add_more_viewing_times_fields").append(html);

        });

        $(document).on('click', '.remove_appended_viewing_times_fields', function(e){
            e.preventDefault();
            $(this).closest('.appended_viewing_times_fields').remove();

            var ad_status = $('.ad_status').val();
            if(ad_status == 'saved'){
                record_store_ajax_request('change', (this));
            }
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
    <script src="{{asset('public/js/intlTelInput-jquery.min.js')}}"></script>
    <script src="{{asset('public/js/intlTelInput.min.js')}}"></script>
    <script src="{{asset('public/js/utils.js')}}"></script>
    <script src="{{asset('public/js/telPhone.js')}}"></script>

@endsection
