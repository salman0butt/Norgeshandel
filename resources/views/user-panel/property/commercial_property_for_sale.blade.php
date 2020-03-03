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
                    <h2 class="text-muted">Næringseiendom til salgs</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 offset-md-1">
                      @include('common.partials.property.commercial_property_for_sale_form')
                 </div>
            </div>
        </div>

        <!-- Attachment as PDF -->
        <div wt-copy="attachment-as-pdf" style="display:none">
            <div class=""  wt-duplicate="attachment-as-pdf">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4 ">
                            <input type="file" name="commercial_property_for_sale_pdf[]" id="commercial_property_for_sale_pdf" accept="application/pdf">
                        </div>
                        <div class="col-sm-2">
                            <button class="dme-btn-outlined-blue" type="button" wt-delete="attachment-as-pdf"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


        });

        $("#publiserannonsen").click(function (e) {

            e.preventDefault();
            if(! $('#commercial_property_for_sale').valid()) return false;

            @if(Request::is('add/new/commercial/property/for/sale/*/edit'))
                var url = "{{url('add/new/commercial/property/for/sale/'.$commercial_property->id)}}";
            @else 
                var url = "{{url('add/commercial/property/for/sale')}}";
            @endif

            $('.notice').html("");
            var myform = document.getElementById("commercial_property_for_sale");
            var fd = new FormData(myform);

            var l = Ladda.create(this);
            l.start();
            $.ajax({
                type: "POST",
                url: url,
                data: fd,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (data) {
                    document.getElementById("commercial_property_for_sale").reset();
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

                    var html="<ul>";
                    $.each( errors.errors, function( index, value ){
                        console.log(value);
                        html += "<li>"+value+"</li>";
                    });
                    html += "</ul>";
                    $('.notice').append('<div class="alert alert-danger">'+html+'</div>');
                },
            }).always(function () {
                l.stop();
            });
            return false;

        });
        window.history.pushState('', null, './');
        $(window).on('popstate', function() {
        location.reload(true);
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