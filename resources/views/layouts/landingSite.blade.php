<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('main_title')</title>
    <meta charset="UTF-8">

    <script src="{{asset('public/admin/js/jquery.min.js')}}"></script>

    <script src="{{asset('public/admin/js/bootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">

    <link rel="shortcut icon" href="{{asset('public/images/favicon.ico')}}"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!--    <script src="assets/js/fontawesome-all.min.js"></script>-->
    <!--    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">-->
    <link rel="stylesheet" href="{{asset('public/mediexpert.css')}}">
    <link rel="stylesheet" href="{{asset('public/mediexpert-mq.css')}}">

    <link rel="stylesheet" href="{{asset('public/css/validate-error.css')}}">


    <link rel="stylesheet" href="{{asset('public/css/ladda-themeless.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/toastr.min.css')}}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('public/css/jssocials.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/jssocials-theme-flat.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!--    incluedes   -->
    {{--<script src="https://cdn.tiny.cloud/1/pyzh8nk5zts8kmnwuypdooa95t19aknwf2lnw5xg1pr8sjqc/tinymce/5/tinymce.min.js"--}}
            {{--referrerpolicy="origin"></script>--}}
    <script src="{{asset('public/js/html2canvas.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
            integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/"
            crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('style')
<link rel="stylesheet" href="{{ asset('public/css/intlTelInput.min.css') }}">
<style>
    span.far.fa-heart.text-muted,span.fa.fa-heart.text-muted {
        line-height: unset !important;
    }
    th.dow {
    padding: 8px;
}

</style>
<script>
    function views(this_obj) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = "{{ url('views') }}";
        var banner_id = this_obj;
        if (banner_id != '') {
            $.ajax({
                type: "POST",
                url: url+'/'+banner_id,
                dataType: "json",
                async: true,
                processData: false,
                contentType: false,
                success: function (data) {
                   return true;
                },
                error: function (jqXhr, json,
                    errorThrown) { // this are default for ajax errors
                    var errors = jqXhr.responseJSON;
                  return false;
                }
            });
        }
    }
</script>
</head>
<body class="@yield('body_class')">
@if(Request::is('account/*'))
@include('user-panel.partials.account_setting_header')
@else
@include('user-panel.partials.header')
@endif
@yield('page_content')
<div id="modal_select_category" class="modal fade" role="dialog">
    <div class="modal-dialog pt-5">
        <div class="modal-content smart-scroll" style="max-height: calc(100vh - 100px); overflow-y: scroll;">
            <div class="modal-body" id="list-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="u-t2">Velg liste</h3>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="row" id="fav_lists">
                    <div class="col-sm-4 pr-0">
                        <a data-toggle="modal" data-dismiss="modal" data-target="#modal_new_category" href="#"
                           id="new-list" class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                            <div class="image-section col-sm-12 p-2">
                                <div class="trailing-border">
                                    <span class="fa fa-plus"
                                          style="padding-top:55px;font-size: 35px; width: 100%; min-height: 150px"></span>
                                </div>
                            </div>
                            <div class="detailed-section col-sm-12 pl-2 pr-2">
                                <div class="title color-grey">Ny liste</div>
                                <div class="detail u-t5 text-muted"></div>
                                <div class="dealer-logo float-right mt-3"><img src="#" style="max-height: 40px;" alt=""
                                                                               class="img-fluid"></div>
                            </div>
                        </a>
                    </div>
                </div><br>
                <button type="button" class="btn dme-btn-outlined-blue float-right" data-dismiss="modal">Lukk</button>
            </div>
        </div>
    </div>
</div>
<div id="modal_new_category" class="modal fade" role="dialog">
    <div class="modal-dialog pt-5">
        <div class="modal-content">
            <div class="modal-body" id="list-body">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="u-t2">Ny liste</h3>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <form action="#">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="category_name">Gi listen et navn</label>
                            <input type="text" class="form-control" name="category_name" id="category_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pt-3">
                            <a href="#" data-toggle="modal" data-dismiss="modal"
                               data-target="#modal_select_category"><span class="fa fa-angle-left"></span> Tilbake</a>
                            <button type="submit" class="btn btn-success float-right" data-dismiss="modal"
                                    data-toggle="modal" id="save_category" data-target="#modal_select_category">Lagre
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modal_login" class="modal fade bd-example-modal-sm" role="dialog">
    <div class="modal-dialog modal-sm pt-5">
        <div class="modal-content">
            <div class="modal-body" id="list-body">
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <span class="fa fa-user" style="font-size: 60px;"></span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-10 offset-md-1 text-muted text-center">
                        <h5 class="u-t5">Logg inn for å legge annonsen i dine favorittlister. Da kan du lett finne de
                            igjen senere, uansett hvor du er.</h5>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-12 text-center pt-3">
                        <a href="{{route('login')}}" class="btn bg-maroon text-white">Logg inn</a>
                    </div>
                    <div class="col-md-12 text-center pt-3">
                        <a href="#" data-toggle="modal" data-dismiss="modal" @if(Auth::check())data-target="#modal_select_category" @endif>Tilbake</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal_saved" class="modal fade bd-example-modal-sm" role="dialog">
    <div class="modal-dialog modal-sm pt-5" style="position:relative;top:20%;">
        <div class="modal-content">
            <div class="modal-body" id="list-body">
                <div class="row">
                    <div class="col-md-6">
                    <h4>Lagre søk</h4>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-12 text-center pt-3">
                        <a href="{{route('login')}}" class="btn bg-maroon text-white col-md-7">Logg inn</a>
                    </div>
                       <div class="col-md-12 text-center pt-3 mt-2">
                        <a href="{{route('register')}}" class="dme-btn-outlined-blue col-md-8">Opprett ny konto</a>
                    </div>
                    <div class="col-md-12 text-center pt-3">
                        <a href="#" data-toggle="modal">Avbryt</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="get_fav_url" value="{{url('my-business/get-favorites')}}">
<input type="hidden" id="add_list_url" value="{{url('my-business/add-list')}}">
<input type="hidden" id="add_fav_url" value="{{url('my-business/add-fav')}}">
<input type="hidden" id="remove_fav_url" value="{{url('my-business/remove-fav')}}">
<script>
    var ad_id = 0;

    @if(Auth::check())
    function getLists() {
        var url = $('#get_fav_url').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: "GET",
            success: function (response) {
                $('#fav_lists').html($('#fav_lists').html() + response);
            }
//                    document.getElementById("contact_us").reset();
        });
    }

    @endif

    $(document).ready(function () {
        @if(Auth::check())
        getLists();
        @endif
        $(document).on('blur', 'input[type=url]', function () {
            var string = $(this).val();
            if (!~string.indexOf("http")) {
                string = "http://" + string;
            }
            $(this).val(string);
            return $(this);
        });
        $(document).on('click', 'a.not-fav', function () {
            ad_id = $(this).attr('data-id');
            var base = '{{route('login')}}';
            var url = base+'?fav-id='+ad_id ;
            $('#modal_login .modal-body a:first').attr('href',url)
 
        });
        $(document).on('click', 'a.fav', function (e) {
    
            e.preventDefault();
            var url = $('#remove_fav_url').val();
            ad_id = $(this).attr('data-id');
        
            $(this).find('span').removeClass('fa');
            $(this).find('span').addClass('far');
            $(this).addClass('not-fav');
            $(this).removeClass('fav');
            $(this).attr('data-target', "#modal_select_category");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url + '/' + ad_id,
                type: "GET",
                async: false,
                success: function (response) {
                    location.reload();
                }
            });
            if ($(this).closest('.favorite-list-item').length > 0) {
                $(this).closest('.favorite-list-item').remove();
            }
        });
        $(document).on('click', '#select_list', function () {
            $('#modal_select_category').modal('hide');
            var url = $('#add_fav_url').val();
            var list_id = $(this).attr('data-id');
            @if(session('fav_id'))
            var ad_id = {{ session('fav_id')}};
            @endif
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url + '/' + list_id + '/' + ad_id,
                type: "GET",
                async: false,
                success: function (response) {
                    window.location.reload();
                }
            });
           

            // $('a[data-id="'+ad_id+'"]').find('span').removeClass('far');
            // $('a[data-id="'+ad_id+'"]').find('span').addClass('fa');
            // $('a[data-id="'+ad_id+'"]').addClass('fav');
            // $('a[data-id="'+ad_id+'"]').removeClass('not-fav');
            // $('a[data-id="'+ad_id+'"]').removeAttr('data-target');

        });
        $('#new-list').click(function (e) {
            e.preventDefault();
        });
        $('#save_category').click(function () {
            var url = $('#add_list_url').val();
            var name = $('#category_name').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url + '/' + name,
                type: "GET",
                success: function (response) {
                }
            });
            setTimeout(function () {
                var data = '<div class="col-sm-4 pr-0">' + $('#fav_lists>div:first-child').html() + '</div>';
                $('#fav_lists').html(data);
                getLists();
            }, 500);
        });
    })
</script>
<footer>
    <nav class="navbar navbar-expand-sm justify-content-center text-center footer-nav">
        <ul class="footer-nav-ul mb-1 p-0">
            <li><a href="{{ url('/become-business') }}">Bli bedriftskunde</a></li>
            <li><a href="{{ url('/customer-admin-for-business') }}">Admin for bedrifter</a></li>
            <li><a href="{{ url('/about-us') }}">Om NorgesHandel.no</a></li>
            <li><a href="{{ url('/personvern') }}">Personvernerklæring</a></li>
            {{--<li><a href="{{ url('/personvern') }}">Cookies</a></li>--}}
            <li><a href="{{ url('/customer-services') }}"><span class="fa fa-help"></span>Kundeservice</a></li>
        </ul>
    </nav>
    <div class="justify-content-center">
        <ul class="footer-social-links mt-3 text-center p-0">
            <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
        </ul>
    </div>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-10 offset-sm-1">
                <!--                <p class="mt-3">Innholdet er beskyttet etter åndsverkloven. Regelmessig, systematisk eller kontinuerlig innhenting, lagring, indeksering, distribusjon og all annen form for bruk av data fra NorgesHandel.no til andre enn rent personlige formål tillates ikke uten eksplisitt, skriftlig tillatelse fra NorgesHandel.no.</p>-->
                <p>© {{now()->year}}<a href="#">NorgesHandel.no</a></p>
            </div>
        </div>
    </div>
</footer>
<script>
    function find_zipcode_city(val) {
        document.getElementById("zip_code_city_name").innerHTML = '';

        var zip_code = val;
        var api_url = 'https://api.bring.com/shippingguide/api/postalCode.json';
        // var api_url = 'https://api.bring.com/shippingguide/api/postalCode.json?clientUrl=demodesign.no&pnr=2014';
        var client_url = 'localhost';

        if (zip_code) {
            var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    // alert(obj_id);
                if (this.readyState == 4 && this.status == 200) { //
                    const postalCode = JSON.parse(this.responseText);

                    if (postalCode.result == "Ugyldig postnummer") {
                        $('#zip_code-error').css('display', 'block');
                        //console.log(postalCode.result);
                        if (document.getElementById('zip_code-error') == null) {
                            $("input[name='zip_code']").after("<label id='zip_code-error' class='error' for='zip_code' style='display: block;'>Ugyldig verdi</label>");
                        } else {
                            document.getElementById("zip_code-error").innerHTML = "Ugyldig verdi";
                        }
                        $('#zip_city').html('');
                    } else {
                        $('#zip_code-error').css('display','none');

                        document.getElementById("zip_code_city_name").innerHTML = postalCode.result;

                        str = postalCode.result;
                        res = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                        });

                        $('#zip_city').val(res);
                        //console.log(res);
                    }
                }
            };
            xhttp.open("GET", api_url + "?clientUrl=" + client_url + "&pnr=" + zip_code, false);
            xhttp.send();
        }
    }

    function jquery_data_tables_languages(table_id){
        (table_id).DataTable({
            "language": {
                "sProcessing":   "Laster...",
                "sLengthMenu":   "Vis _MENU_ linjer",
                "sZeroRecords":  "Ingen linjer matcher s&oslash;ket",
                "sInfo":         "Viser _START_ til _END_ av _TOTAL_ linjer",
                "sInfoEmpty":    "Viser 0 til 0 av 0 linjer",
                "sInfoFiltered": "(filtrert fra _MAX_ totalt antall linjer)",
                "sInfoPostFix":  "",
                "sSearch":       "S&oslash;k:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "F&oslash;rste",
                    "sPrevious": "Forrige",
                    "sNext":     "Neste",
                    "sLast":     "Siste"
                }
            },
            "order": [[ 0, "desc" ]]
        });
    }
</script>
@yield('script')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
{{--<script src="https://cdn.tiny.cloud/1/x0txntp9p38g4hksno5jsfsk6hkxeqyhqwonj7posbp6ystc/tinymce/5/tinymce.min.js"></script>--}}

<script src="https://js.pusher.com/3.1/pusher.min.js"></script>
<script src="{{asset('public/mediexpert.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<script src="{{asset('public/js/spin.min.js')}}"></script>
<script src="{{asset('public/js/ladda.min.js')}}"></script>
<script src="{{asset('public/js/common-norges.js')}}"></script>
<script src="{{asset('public/js/validater.js')}}"></script>
<script src="{{asset('public/js/additional-methods.min.js')}}"></script>
<script src="{{asset('public/js/messages_no.min.js')}}"></script>
<script src="{{asset('public/js/fslightbox.js')}}"></script>
<script src="{{asset('public/js/toastr.min.js')}}"></script>
<script src="{{asset('public/js/jssocials.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('public/js/bootstrap-datepicker.no.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('public/js/map.js') }}"></script>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>

@yield('map')
<script>
    var urlParams = new URLSearchParams(location.search);

    function search(data) {
        var urlParams = new URLSearchParams(location.search);
        var url = $('#mega_menu_search_url').val();

        $.ajax({
            data: data,
            url: url,
            type: "GET",
            success: function (response) {
                if(!isEmpty($("#basicExampleModal.show"))){
                    $('#dme-wrapper').html(response);
                }

            },
            error: function (error) {
                //console.log(error);
            }
        });
    }

    function fix_page_links() {
        $('.pagination a').each(function (i) {
            var par = urlParams;
            par.delete('page');
            var page_arr = $(this).attr('href').split('=');
            par.set('page', page_arr[1]);
            $(this).attr('href', "?" + par.toString());
        });
    }

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        @if(Auth::check())

        $.ajax({
            url: '{{url('notifications_count')}}',
            type: "get",
            async: false,
            dataType: "json",
            success: function (response) {
                var count = parseInt(response);
                if (count > 0) {
                    $('#notification:not(.page-notifications #notification)').html(count);
                } else {
                    $('#notification:not(.page-notifications #notification)').html('');
                }
            }
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            $('#notification:not(.page-notifications #notification)').html('');
        });
        @endif

        //spinner start here
       /* $(document).ajaxStart(function () {
            $("#imageLoader").css("display", "block");
            $(".pagination_data").css("display", "none");
        });

        $(document).ajaxComplete(function () {
            $("#imageLoader").css("display", "none");
            $(".pagination_data").css("display", "block");
        });*/
        //spinner ends here

            @if(Auth::check())
        var pusher = new Pusher('f607688e883e2a04ab39', {
                cluster: 'eu',
                forceTLS: true
            });
        Pusher.logToConsole = true;

        var channel = pusher.subscribe('header-chat-notification');
        channel.bind('header-chat-notification-event', function (data) {
            if (data.to_user_id == '{{Auth::id()}}') {
                var prev = $('#chat-notification:not(.page-messages #chat-notification)').html();
                if (isEmpty(prev)) {
                    prev = 0;
                }
                prev++;
                $('#chat-notification:not(.page-messages #chat-notification)').html(prev);
            }
        });
        var notifications = pusher.subscribe('notification');
        notifications.bind('notification-event', function (data) {
            if (data.to_user_id == '{{Auth::id()}}') {
                $.ajax({
                    url: '{{url('notifications_count')}}',
                    type: "get",
                    async: false,
                    dataType: "json",
                    success: function (response) {
                        var count = parseInt(response);
                        if (count > 0) {
                            $('#notification:not(.page-notifications #notification)').html(count);
                        } else {
                            $('#notification:not(.page-notifications #notification)').html('');
                        }
                    }
                }).fail(function (jqXHR, ajaxOptions, thrownError) {
                    $('#notification:not(.page-notifications #notification)').html('');
                });
            }
        });
        @endif
    });


    var site_url = "<?php echo url('/'); ?>";
</script>
<script>
        var job = '{{ \Request::is("jobs/*") }}';
        var property_for_rent = '{{ \Request::is("property/property-for-rent/*") }}';
        var holiday_home_for_sale = '{{ \Request::is("property/holiday-homes-for-sale/*") }}';
        var property_for_sale = '{{ \Request::is("property/property-for-sale/*") }}';
        var flat_wishes_rented = '{{ \Request::is("property/flat-wishes-rented/*") }}';
        var commercial_property_for_sale = '{{ \Request::is("property/commercial-property-for-sale/*") }}';
        var commercial_property_for_rent = '{{ \Request::is("property/commercial-property-for-rent/*") }}';
        var commercial_plot = '{{ \Request::is("property/commercial-plots/*") }}';
        var businesses_for_sale  = '{{ \Request::is("property/business-for-sale/*") }}';
        var strsearch = urlParams;
            strsearch.delete('page');
            var value = strsearch.toString();
            var type = '';
            if(job)
            type = strsearch.get('job_type');
            else if(property_for_rent)
             type = 'property-for-rent';
            else if(holiday_home_for_sale)
             type = 'holiday-homes-for-sale';
            else if(property_for_sale)
             type = 'property-for-sale';
            else if(flat_wishes_rented)
             type = 'flat-wishes-rented';
            else if(commercial_property_for_sale)
             type = 'commercial-property-for-sale';
            else if(commercial_property_for_rent)
             type = 'commercial-property-for-rent';
            else if(commercial_plot)
             type = 'commercial-plots';
            else if(businesses_for_sale)
             type = 'business-for-sale';

          //console.log(type);

            if(!isEmpty(type)) {
                if (!isEmpty(value)) {
                    var url = "{{url('/recentearches')}}";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url + '/' + value + '/' + urlParams.get('search') + '/' + type,
                        type: "POST",
                        success: function (response) {
                            return true;
                        },
                        error: function (error) {
                            // console.log(error);
                            return false;
                        }
                    });
                }

            }


</script>
<script>
    $("#shareRoundIcons").jsSocials({
        showLabel: false,
        showCount: false,
        shares: ["email", "twitter", "facebook"]
    });
    function date_picker(){
        $('.date-picker, input[type="date"]').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            language: 'no',
            clearBtn: true
        });
        $('input[type="date"]').attr('type','text');
    };
    $(function () {
        date_picker();
    });

    $('body').on('focusin', '.date-picker', function(e) {
        date_picker();
    });

</script>
@if(session('fav_id'))
<script>
$(function() {
    $('#modal_select_category').modal('show');
});
</script>
@endif
 {{ session()->forget('fav_id') }}
</body>
</html>
