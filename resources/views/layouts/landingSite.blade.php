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

    <!--    incluedes   -->
    <script src="{{asset('public/js/tinymce.min.js')}}"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
@include('user-panel.partials.header')
@yield('page_content')
<div id="modal_select_category" class="modal fade" role="dialog">
    <div class="modal-dialog pt-5" >
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
                        <a data-toggle="modal" data-dismiss="modal" data-target="#modal_new_category" href="#" id="new-list" class="row product-list-item mr-1 p-sm-1 mt-3" style="text-decoration: none;">
                            <div class="image-section col-sm-12 p-2">
                                <div class="trailing-border">
                                    <span class="fa fa-plus" style="padding-top:55px;font-size: 35px; width: 100%; min-height: 150px"></span>
                                </div>
                            </div>
                            <div class="detailed-section col-sm-12 pl-2 pr-2">
                                <div class="title color-grey">Ny liste</div>
                                <div class="detail u-t5 text-muted"></div>
                                <div class="dealer-logo float-right mt-3" ><img src="#" style="max-height: 40px;" alt="" class="img-fluid"></div>
                            </div>
                        </a>
                    </div>
                </div>
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
                            <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#modal_select_category"><span class="fa fa-angle-left"></span> Tilbake</a>
                            <button type="submit" class="btn btn-success float-right" data-dismiss="modal" data-toggle="modal" id="save_category" data-target="#modal_select_category">Lagre</button>
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
                        <h5 class="u-t5">Logg inn for å legge annonsen i dine favorittlister. Da kan du lett finne de igjen senere, uansett hvor du er.</h5>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-12 text-center pt-3">
                        <a href="{{route('login')}}" class="btn btn-success">Logg inn</a>
                    </div>
                    <div class="col-md-12 text-center pt-3">
                        <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#modal_select_category">Tilbake</a>
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
    function getLists(){
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
                $('#fav_lists').html($('#fav_lists').html()+response);
            }
//                    document.getElementById("contact_us").reset();
        });
    }
    $(document).ready(function () {
        @if(Auth::check())
        getLists();
        @endif
        $(document).on('click', 'a.not-fav', function () {
            ad_id = $(this).attr('data-id');
        });
        $(document).on('click', 'a.fav', function () {
            var url = $('#remove_fav_url').val();
            ad_id = $(this).attr('data-id');
            $(this).find('span').removeClass('fa');
            $(this).find('span').addClass('far');
            $(this).addClass('not-fav');
            $(this).removeClass('fav');
            $(this).attr('data-target',"#modal_select_category");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url+'/'+ad_id,
                type: "GET",
                success: function (response) {
                }
            });
        });
        $(document).on('click', '#select_list', function () {
            $('#modal_select_category').modal('hide');
            var url = $('#add_fav_url').val();
            var list_id = $(this).attr('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url+'/'+list_id+'/'+ad_id,
                type: "GET",
                success: function (response) {
                }
            });

                $('a[data-id="'+ad_id+'"]').find('span').removeClass('far');
                $('a[data-id="'+ad_id+'"]').find('span').addClass('fa');
                $('a[data-id="'+ad_id+'"]').addClass('fav');
                $('a[data-id="'+ad_id+'"]').removeClass('not-fav');
                $('a[data-id="'+ad_id+'"]').removeAttr('data-target');

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
                url: url+'/'+name,
                type: "GET",
                success: function (response) {
                }
            });
            setTimeout(function () {
                var data = '<div class="col-sm-4 pr-0">'+$('#fav_lists>div:first-child').html()+'</div>';
                $('#fav_lists').html(data);
                getLists();
            }, 500);
        });
    })
</script>
<footer>
    <nav class="navbar navbar-expand-sm justify-content-center text-center footer-nav">
        <ul class="footer-nav-ul mb-1 p-0">
            <li><a href="#">Bli bedriftskunde</a></li>
            <li><a href="#">Admin for bedrifter</a></li>
            <li><a href="#">Om NorgesHandel.no</a></li>
            <li><a href="#">Personvernerklæring</a></li>
            <li><a href="#">Cookies</a></li>
            <li><a href="#"><span class="fa fa-help"></span>Kundeservice</a></li>
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
                <p>© 2019<a href="#">NorgesHandel.no</a></p>
            </div>
        </div>
    </div>
</footer>
<script src="{{asset('public/mediexpert.js')}}"></script>
<script src="{{asset('public/js/utils.js')}}"></script>
<script src="{{asset('public/js/spin.min.js')}}"></script>
<script src="{{asset('public/js/ladda.min.js')}}"></script>
</body>
</html>