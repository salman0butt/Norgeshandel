@extends('layouts.landingSite')

@section('style')
{{--<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />--}}
{{--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
<!-- Dropzone style files -->
<link rel="stylesheet" href="{{asset('public/dropzone/plugins.min.css')}}">
<link rel="stylesheet" href="{{asset('public/dropzone/dropzone.min.css')}}">
<link rel="stylesheet" href="{{asset('public/dropzone/basic.min.css')}}">

@endsection

@section('page_content')
    @php
        $property_status = '';
        if(Request()->id && Request::is('new/property/sale/ad/*/edit')){
            $property = \App\PropertyForSale::find(Request()->id);
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

<!-- property for sale -->
<main>
    <div class="dme-container">
        <div class="row main-form-mobile">
            <div class="col-md-10 offset-md-1 mt-5 mb-5">
                <h2 class="text-muted">Bolig til Salgs</h2>
            </div>
        </div>
        <div class="row main-form-mobile">
            <div class="col-md-10 offset-md-1">
                <div class="notice"></div>
                @include('common.partials.property.property_for_sale_form')
            </div>
        </div>
    </div>
</main>

@endsection

@section('script')
<script type="text/javascript">
    function record_store_ajax_request(event, this_obj) {
        if($('.text-editor').length > 0) tinymce.triggerSave();
        if(event == 'click'){
            if(! $('#property_for_sale_form').valid()) return false;
        }
        if (event == 'change') {
            var zip_code = $('.zip_code').val();
            var old_zip = $('#old_zip').val();
            if (zip_code) {
                if (old_zip != zip_code) {
                    find_zipcode_city(zip_code);
                    $('input[name="street_address"],input[name="address"]').val('');
                     $('input[name="street_address"],input[name="address"]').parent().find('span.u-t5').remove();
                }
            }
            @if(Request::is('new/property/sale/ad/*/edit') || Request::is('complete/ad/*'))
            var url = "{{url('new/property/sale/ad/'.$property_for_sale1->id)}}";
            @endif
        } else {
                    @if(Request::is('new/property/sale/ad/*/edit') || Request::is('complete/ad/*'))
            var url = "{{ url('new/property/sale/ad/update/'.$property_for_sale1->id) }}";
            @endif
        }


        $("input ~ span,select ~ span").each(function (index) {
            $(".error-span").html('');
            $("input, select").removeClass("error-input");
        });

        // $('.notice').html("");
        var myform = document.getElementById("property_for_sale_form");
        var fd = new FormData(myform);

        if($('.remove_property_quote').attr('id')){
            fd.delete('property_quote');
        }

        if($('.remove_property_pdf').attr('id')){
            fd.delete('property_pdf');
        }

        var l = Ladda.create(this_obj);
        l.start();
        $.ajax({
            type: "POST",
            url: url,
            // async: false,
            data: fd,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(data) {
                if (event == 'change') {
                    notify("info","Annonsen din er lagret");
                }else if(event == 'click'){
                    if(data.flag === false){
                        notify("error",data.message);
                        return false;
                    }

                    $('.deleted_media').val('');
                    $('.media_position').val('');
                    $('.ad_status').val(data.status);

                    if(data.status === 'published'){
                        $('.ad_published_payment_method_div').addClass('d-none');
                    }

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
                if (event == 'change') {
                    return "error";
                } else {
                    // var html="<ul>";
                    $.each(errors.errors, function (index, value) {
                        //console.log(value);
                        $("." + index).html(value);
                        $("input[name='" + index + "'],select[name='" + index + "']")
                            .addClass("error-input");
                    });

                }
            },
        }).always(function () {
            l.stop();
        });
        return false;
    }

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("input,select").on("keyup", function () {
            $(this).parent().find('.error-span').html("");
            $(this).removeClass("error-input");
        });

        $(document).on('keyup', '.asking_price,.costs_include,.percentage_of_public_debt', function () {

            var asking_price = $(".asking_price").val();
            var costs_include = $(".costs_include").val();
            var percentage_of_public_debt = $(".percentage_of_public_debt").val();
            if (asking_price == "") {
                asking_price = 0;
            }
            if (costs_include == "") {
                costs_include = 0;
            }
            if (percentage_of_public_debt == "") {
                percentage_of_public_debt = 0;
            }

            var total_price = parseInt(asking_price) + parseInt(costs_include) + parseInt(
                percentage_of_public_debt);
            $("#total_price").val(total_price);
            total_price = total_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            $("#total_price_sale_add").text(total_price);

        });

        $(document).on('keyup', 'input:not(input[type=date],.text-editor),textarea', function(e) {
            var val = $(this).val();
            // if(!isEmpty(val)){
                explicit_keywords($(this));
            // }
        });

        $(document).on('change', 'input:not(input[type=date],input[type=radio],select[name=package_id]),textarea', function(e) {

            e.preventDefault();

            if(! $(this).valid()) return false;

            var val = $(this).val();
            if(!isEmpty(val)){
                if(!$(this).hasClass('text-editor')){
                    var explicit = explicit_keywords($(this));
                }
                if(explicit === false){
                    return false;
                }
            }

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

            var event_name = $(this).attr('name');
            if(event_name === 'street_address' || event_name === 'address' || event_name === 'zip_code'){
                //calling address
                fullAddress();
            }
        });

        //click button update
        $(document).on('click', '#publiserannonsen', function(e){
            e.preventDefault();
            record_store_ajax_request('click', (this));
        });

        var i = 0;
        $("#add_more_viewing_times").click(function (e) {

            e.preventDefault();
            var html = '<div class="appended_viewing_times_fields"><div class="form-group">' +
                '<label class="u-t5">Visningsdato (valgfritt)</label>' +
                '<div class="row">' +
                '<div class="col-sm-4 pr-md-0">' +
                '<input type="text" name="delivery_date[]" class="dme-form-control date-picker">' +
                '<span class="u-t5">Dato (eks. 31.12.2017 eller 31/12/2017)</span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '<label class="u-t5">Fra klokken (valgfritt)</label>' +
                '<div class="row">' +
                '<div class="col-sm-4 pr-md-0">' +
                '<input type="text" name="time_start[]" placeholder="tt.mm" class="dme-form-control">' +
                '<span class="u-t5">Tid (eksempel 18:00)</span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '<label class="u-t5">Til klokken (valgfritt)</label>' +
                '<div class="row">' +
                '<div class="col-sm-4 pr-md-0">' +
                '<input type="text" name="time_end[]" placeholder="tt.mm" class="dme-form-control">' +
                '<span class="u-t5">Tid (eksempel 19:00)</span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '<label class="u-t5">Merknad (valgfritt)</label>' +
                '<div class="row">' +
                '<div class="col-sm-12 pr-md-0">' +
                '<input type="text" name="note[]" placeholder="F.eks.: visning etter avtale" class="dme-form-control">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '   <div class="row">'+
                '       <div class="col-sm-12 pr-md-0">'+
                '           <button type="button" class="dme-btn-outlined-blue remove_appended_viewing_times_fields">Fjern</button>' +
                '       </div>'+
                '   </div>'+
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
