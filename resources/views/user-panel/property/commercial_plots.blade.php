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
        if(Request()->id && Request::is('commercial/plots/*/edit')){
            $property = \App\CommercialPlot::find(Request()->id);
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

        function record_store_ajax_request(event, this_obj) {
            if($('.text-editor').length > 0) tinyMCE.triggerSave();
            if(event == 'click'){
                if(! $('#commercial_plot_form').valid()) return false;
            }
            var url = '';
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
                        @if(Request::is('commercial/plots/*/edit') || Request::is('complete/ad/*'))
                var url = "{{url('commercial/plots/'.$commercial_plots->id)}}";
                @endif
            } else {
                        @if(Request::is('commercial/plots/*/edit') || Request::is('complete/ad/*'))
                var url = "{{url('commercial/plots/update/'.$commercial_plots->id)}}";
                @endif
            }

            //if (!$('#business_for_sale').valid()) return false;

            $("input ~ span,select ~ span").each(function (index) {
                $(".error-span").html('');
                $("input, select").removeClass("error-input");
            });


            var myform = document.getElementById("commercial_plot_form");
            var fd = new FormData(myform);
            if($('.remove_property_pdf').attr('id')){
                fd.delete('commercial_plot_pdf');
            }

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

            $(document).on('change', '.ad_type', function(e) {
                var val = $(this).val();
                if(val === "Bortfeste"){
                    $('.price_section h3').html('Prisantydning');
                    $('.price_section span').html('Minstebeløpet du selger eiendommen for');
                }
                if(val == "Salg"){
                    $('.price_section h3').html('Utleie pris');
                    $('.price_section span').html('Utleie beløp per måned');
                }
            });
            $(document).on('change', 'input:not(input[type=date],input[name=to_publish_ad],select[name=package_id]),textarea', function(e) {
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
