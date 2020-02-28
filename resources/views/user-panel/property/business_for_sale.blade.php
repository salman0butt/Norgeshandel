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
                <h2 class="text-muted">Bedrifter til salgs</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                @include('common.partials.property.business_for_sale_form')
            </div>
        </div>
    </div>

    <!-- Attachment as PDF -->
    <div wt-copy="attachment-as-pdf" style="display:none">
        <div class=""  wt-duplicate="attachment-as-pdf">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4 ">
                        <input type="file" name="business_for_sale_pdf[]" id="business_for_sale_pdf" accept="application/pdf">
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

            $("#publiser_annonsen").click(function(e){

                    e.preventDefault();
                    $('.notice').html("");

                    @if(Request::is('add/business/for/sale/*/edit'))
                        var url = "{{url('add/business/for/sale/'.$business_for_sale->id)}}";
                    @else
                        var url = "{{url('add/business/for/sale')}}";
                    @endif

            
                    var myform = document.getElementById("business_for_sale");
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
                        success: function(data){
                            console.log(data);
                            $('.notice').append('<div class="alert alert-success">Annonsen din er publisert</div>');
                        },
                        error: function(jqXhr, json, errorThrown){// this are default for ajax errors
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
                
                    }).always(function() { l.stop(); });
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