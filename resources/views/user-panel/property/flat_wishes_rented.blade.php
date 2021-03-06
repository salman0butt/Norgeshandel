
@extends('layouts.landingSite')

@section('style')
    <link rel="stylesheet" href="{{asset('public/css/bootstrap-fileinput.css')}}">
    <!-- Dropzone style files -->
    <link rel="stylesheet" href="{{asset('public/dropzone/plugins.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/dropzone/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/dropzone/basic.min.css')}}">

@endsection

@section('page_content')
    @php
        $property_status = '';
        if(Request()->id && Request::is('new/flat/wishes/rented/*/edit')){
            $property = \App\FlatWishesRented::find(Request()->id);
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
        <div class="row main-form-mobile">
            <div class="col-md-10 offset-md-1 mt-5 mb-5 pl-4">
                <h2 class="text-muted">Bolig ønskes leid</h2>
            </div>
        </div>

          <div class="row main-form-mobile">
            <div class="col-md-10 offset-md-1">
                  @include('common.partials.property.flat_wishes_rented_form')
            </div>
        </div>
    </div>
</main>

    <script>

        function record_store_ajax_request(event, this_obj) {

            if($('.text-editor').length > 0) tinyMCE.triggerSave();

            if(event == 'click'){
                if(! $('#flat_wishes_rented_form').valid()) return false;
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
                        @if(Request::is('new/flat/wishes/rented/*/edit') || Request::is('complete/ad/*'))
                var url = "{{url('new/flat/wishes/rented/'.$flat_wishes_rented1->id)}}";
                @endif
            } else {
                        @if(Request::is('new/flat/wishes/rented/*/edit') || Request::is('complete/ad/*'))
                var url = "{{url('new/flat/wishes/rented/update/'.$flat_wishes_rented1->id)}}";
                @endif
            }

            //if (!$('#property_for_rent_form').valid()) return false;

            $("input ~ span,select ~ span").each(function (index) {
                $(".error-span").html('');
                $("input, select").removeClass("error-input");
            });
            //  $('.notice').html("");


            var myform = document.getElementById("flat_wishes_rented_form");
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

            $(document).on('keyup', 'input:not(input[type=date],.text-editor),textarea', function(e) {
                var val = $(this).val();
                // if(!isEmpty(val)){
                    explicit_keywords($(this));
                // }
            });

            $(document).on('change', 'input:not(input[type=date]),textarea', function(e) {
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

                 //calling address
                fullAddress();
            });
            //click button update
            $(document).on('click', '#publiserannonsen', function(e){
                e.preventDefault();
                record_store_ajax_request('click', (this));
            });
       
    });

    </script>


@endsection

@section('script')
    <script src="{{asset('public/js/bootstrap-fileinput.js')}}"></script>
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