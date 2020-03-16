@extends('layouts.landingSite')

@section('style')
    <!-- Dropzone style files -->
    <link rel="stylesheet" href="{{asset('public/dropzone/plugins.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/dropzone/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/dropzone/basic.min.css')}}">

@endsection

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

            function record_store_ajax_request(event, this_obj) {
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
                        console.log(data);
                       // document.getElementById("property_for_rent_form").reset();
                       // document.getElementById("zip_code_city_name").innerHTML = '';
                   if (event == 'change') {
                       if(data.property_pdf){
                           $('.remove_property_pdf').attr('id',data.property_pdf);
                       }
                    $('.notice').html('<div class="alert alert-success">Annonsen din er lagret</div>');
                   }else if(event == 'click'){
                      $('.notice').html('<div class="alert alert-success">Annonsen din er publisert</div>');
                   }
                           if (event == 'change') {
                        setTimeout(function () {
                            $('.notice').show('slow');
                        }, 2000);
                        setTimeout(function () {
                            $('.notice').hide('slow');
                        }, 5000);
                    }
              
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
            
            $("input:not(input[type=date])").on('change', function (e) {
                e.preventDefault();
               record_store_ajax_request('change', (this));
                var postal = $('.zip_code').val();
                $('#old_zip').attr('value',postal);
            });
            //click button update
            $("#publiserannonsen").click(function (e) {
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

@endsection
