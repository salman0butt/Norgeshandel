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

    <script type="text/javascript">

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("input,select,form").on("keyup change submit", function() {
                $(this).parent().find('.error-span').html("");
                $(this).removeClass("error-input");

            });


 
            $("#publiser_annonsen").click(function (e) {

                e.preventDefault();
                if(! $('#property_for_rent_form').valid()) return false;

                $("input ~ span,select ~ span").each(function( index ) {
                    $(".error-span").html('');
                    $("input, select").removeClass("error-input");
                });
                $('.notice').html("");


                var myform = document.getElementById("property_for_rent_form");
                var fd = new FormData(myform);

                // fd.append('property_photos', $('#property_photos').get(0).files[0]);
                var l = Ladda.create(this);
                l.start();
                @if(Request::is('new/property/rent/ad/*/edit'))
                    var url = "{{ url('add/property/for/rent/ad/'.$property_for_rent1->id) }}";
                @else
                    var url = "{{ url('add/property/for/rent/ad/') }}";
                @endif
                $.ajax({

                    type: "POST",
                    url: url,
                    data: fd,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log(data);
                        document.getElementById("property_for_rent_form").reset();
                        document.getElementById("zip_code_city_name").innerHTML = '';
                        $('.notice').append('<div class="alert alert-success">Annonsen din er publisert</div>');

                    },
                    error: function (jqXhr, json, errorThrown) {// this are default for ajax errors

                        var errors = jqXhr.responseJSON;
                        console.log(errors.errors);
                        if(isEmpty(errors.errors))
                        {
                            $('.notice').append('<div class="alert alert-danger">noe gikk galt!</div>');
                            return false;
                        }
                        if(!isEmpty(errors.errors))
                        {
                            console.log(errors.errors);
                            $.each(errors.errors, function (index, value)
                            {
                                $("." + index).html(value);
                                $("input[name='" + index + "'],select[name='" + index + "']").addClass("error-input");
                            });
                        }
                        else
                        {
                            $('.notice').append('<div class="alert alert-danger">noe gikk galt!</div>');
                        }
                    },

                }).always(function () {
                    l.stop();
                });
                return false;
            });
            

            var i = 0;
            $("#add_more_viewing_times").click(function (e) {

                e.preventDefault();
                i = i + 1;
                var html = '<div class="form-group">' +
                    '<label class="u-t5">Visningsdato (valgfritt)</label>'
                    + '<div class="row">' +
                    '<div class="col-sm-4 pr-md-0">' +
                    '<input type="date" name="delivery_date[]" class="dme-form-control">' +
                    '<span class="u-t5">Dato (eks. 31.12.2017 eller 31/12/2017)</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label class="u-t5">Fra klokken (valgfritt)</label>' +
                    '<div class="row">' +
                    '<div class="col-sm-4 pr-md-0">' +
                    '<input type="text" name="from_clock[]" placeholder="tt.mm" class="dme-form-control">' +
                    '<span class="u-t5">Tid (eksempel 18:00)</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label class="u-t5">Til klokken (valgfritt)</label>' +
                    '<div class="row">' +
                    '<div class="col-sm-4 pr-md-0">' +
                    '<input type="text" name="clockwise_clock[]' + i + '" placeholder="tt.mm" class="dme-form-control">' +
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
                    '</div>';
                $("#add_more_viewing_times_fields").append(html);


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

@endsection
