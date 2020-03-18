@extends('layouts.landingSite')

@section('style')
    <!-- Dropzone style files -->
    <link rel="stylesheet" href="{{asset('public/dropzone/plugins.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/dropzone/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/dropzone/basic.min.css')}}">

@endsection

@section('page_content')

    <!-- property for rent -->
    <main>
        <div class="dme-container">
            <div class="row">
                <div class="col-md-10 offset-md-1 mt-5 mb-5">
                    <h2 class="text-muted">Bolig til leie</h2>
                </div>

                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        @include('common.partials.property.property_for_rent_form')
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            
            function record_store_ajax_request(event, this_obj) {
                if(event == 'click'){
                    if(! $('#property_for_rent_form').valid()) return false;
                }

                if (event == 'change') {
                    var zip_code = $('.zip_code').val();
                    var old_zip = $('#old_zip').val();
                    
                    if (zip_code) {
                        if (old_zip != zip_code) {
                            find_zipcode_city(zip_code);
                        }
                    }
                    @if(Request::is('new/property/rent/ad/*/edit') || Request::is('complete/ad/*'))
                        var url = "{{url('add/property/for/rent/ad/'.$property_for_rent1->id)}}";
                    @endif
                } else {
                    @if(Request::is('new/property/rent/ad/*/edit') || Request::is('complete/ad/*'))
                        var url = "{{url('add/property/for/rent/ad/update/'.$property_for_rent1->id)}}";
                    @endif
                }

                //if (!$('#property_for_rent_form').valid()) return false;

                $("input ~ span,select ~ span").each(function (index) {
                    $(".error-span").html('');
                    $("input, select").removeClass("error-input");
                });



                var myform = document.getElementById("property_for_rent_form");
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
                        //console.log(data);
                       // document.getElementById("property_for_rent_form").reset();
                       // document.getElementById("zip_code_city_name").innerHTML = '';
                        if (event == 'change') {
                            $('.notice').html('<div class="alert alert-success">Annonsen din er lagret</div>');
                        }else if(event == 'click'){
                            $('.notice').css('display','block');
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
                        //console.log(errors.errors);
                        if (isEmpty(errors.errors)) {
                            $('.notice').html('<div class="alert alert-danger">noe gikk galt!</div>');
                            return false;
                        }
                        if (!isEmpty(errors.errors)) {
                            //console.log(errors.errors);
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
                if(! $(this).valid()) return false;
               record_store_ajax_request('change', (this));
                var postal = $('.zip_code').val();
                $('#old_zip').attr('value',postal);
            });
            //click button update
            $("#publiser_annonsen").click(function (e) {
                e.preventDefault();
                record_store_ajax_request('click', (this));
            });
        });
    </script>

    <!-- Dropzone script files -->
    <script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('public/dropzone/jquery.min.js')}}"></script>
    <script src="{{asset('public/dropzone/jquery-ui.min.js')}}"></script>
    <script src="{{asset('public/dropzone/form-dropzone.min.js')}}"></script>
    <script src="{{asset('public/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('public/mediexpert-custom-dropzone.js')}}"></script>

@endsection
