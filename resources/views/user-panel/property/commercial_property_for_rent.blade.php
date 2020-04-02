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
        if(Request()->id){
            $property = \App\CommercialPropertyForRent::find(Request()->id);
            if($property && $property->ad){
                $property_status = $property->ad->status;
            }
        }
    @endphp

<main>
    <div class="dme-container">
        <div class="row">
            <div class="col-md-10 offset-md-1 mt-5 mb-5 pl-4">
                <h2 class="text-muted">Næringseiendom til leie</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 offset-md-1">

                @include('common.partials.property.commercial_property_for_rent_form')
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

        function record_store_ajax_request(event, this_obj) {
               if(event == 'click'){
                   if(! $('#commercial_property_for_rent').valid()) return false;
                  }
               var url = '';
                if (event == 'change') {
                    //console.log('status 1');
                    var zip_code = $('.zip_code').val();
                    var old_zip = $('#old_zip').val();
                    //console.log(old_zip);
                    if (zip_code) {
                        if (old_zip != zip_code) {
                            find_zipcode_city(zip_code);
                        }
                    }
                    @if(Request::is('add/new/commercial/property/for/rent/*/edit') || Request::is('complete/ad/*'))
                        var url = "{{url('add/new/commercial/property/for/rent/'.$commercial_for_rent->id)}}";
                    @endif
                } else {
                    @if(Request::is('add/new/commercial/property/for/rent/*/edit') || Request::is('complete/ad/*'))
                        var url = "{{url('add/new/commercial/property/for/rent/update/'.$commercial_for_rent->id)}}";
                    @endif
                }
                //console.log('status 2');
                //if (!$('#property_for_rent_form').valid()) return false;

                $("input ~ span,select ~ span").each(function (index) {
                    $(".error-span").html('');
                    $("input, select").removeClass("error-input");
                });
              //  $('.notice').html("");

                //console.log('status 3');
                var myform = document.getElementById("commercial_property_for_rent");
                var fd = new FormData(myform);
                if($('.remove_property_pdf').attr('id')){
                    fd.delete('commercial_property_for_rent_pdf');
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
                    if (event == 'change') {
                        notify("info","Annonsen din er lagret");
                    }else if(event == 'click'){
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
            
            $("input:not(input[type=date]),textarea").on('change', function (e) {
                e.preventDefault();
                if(! $(this).valid()) return false;

                @if(Request::is('complete/ad/*') || $property_status == 'saved')
                    record_store_ajax_request('change', (this));
                @else
                    var zip_code = $('.zip_code').val();
                    var old_zip = $('#old_zip').val();
                    if (zip_code) {
                        if (old_zip != zip_code) {
                            find_zipcode_city(zip_code);
                        }
                    }
                @endif

                var postal = $('.zip_code').val();
                $('#old_zip').attr('value',postal);
            });
            //click button update
            $("#publiserannonsen").click(function (e) {
                e.preventDefault();
                record_store_ajax_request('click', (this));
            });


});

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