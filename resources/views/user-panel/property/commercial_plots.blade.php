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

    <!-- Attachment as PDF -->
    <div wt-copy="attachment-as-pdf" style="display:none">
        <div class=""  wt-duplicate="attachment-as-pdf">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4 ">
                        <input type="file" name="commercial_plot_pdf[]" id="commercial_plot_pdf" accept="application/pdf">
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
        
            $("#publiserannonsen").click(function(e){

                e.preventDefault();
                var l = Ladda.create(this);
                l.start();
                
                @if(Request::is('commercial/plots/*/edit'))
                    var url = "{{url('commercial/plots/'.$commercial_plots->id)}}";
                @else 
                    var url = '{{url('add/commercial/plot/ad')}}';
                @endif

                
                $('.notice').html("");
                var myform = document.getElementById("commercial_plot_form");
                var fd = new FormData(myform);

                $.ajax({
                    type: "POST",
                    url: url,
                    data: fd,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function(data){
                            $('.notice').append('<div class="alert alert-success">Eiendom lagt til!</div>');
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
