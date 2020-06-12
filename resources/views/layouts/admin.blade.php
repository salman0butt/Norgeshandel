<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/favicon.ico')}}">
    <title>Admin - NorgesHandel</title>
    <!-- Custom CSS -->
    <script src="{{ asset('public/admin/js/jquery.min.js') }}"></script>
    <link href="{{ asset('public/admin/css/float-chart.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/fontawesome-all.css') }}" rel="stylesheet">

{{--    <link href="{{ asset('public/admin/css/themify-icons.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('public/admin/css/multicheck.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/datatables.bootstrap4.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('public/admin/style.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <link href="{{ asset('public/admin/mediexpert.css') }}" rel="stylesheet">
    @yield('style')

    <script src="{{ asset('public/admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/select2.full.min.js') }}"></script>


    {{--<script src="{{asset('public/js/tinymce.min.js')}}"></script>--}}
    <!--[if lt IE 9]>
    <script src="{{ asset('public/admin/js/html5shiv.js') }}"></script>
    <script src="{{ asset('public/admin/js/respond.min.js') }}"></script>

    <![endif]--><style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style></head>

<body cz-shortcut-listen="true">

<!-- Preloader - style you can find in spinners.css -->

<div class="preloader" style="display: none;">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>

<!-- Main wrapper - style you can find in pages.scss -->

<div id="main-wrapper" data-sidebartype="full" class="">

    <!-- Topbar header - style you can find in pages.scss -->

    <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header" data-logobg="skin5">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>

                <!-- Logo -->

                <a class="navbar-brand" href="{{url('/admin')}}">
                    <!-- Logo icon -->
                    <b class="logo-icon pl-3 pr-3">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="{{ asset('public/images/NorgesHondel-logo.png')}}" alt="homepage" class="light-logo img-fluid">

                    </b>
                </a>

                <!-- End Logo -->


                <!-- Toggle which is visible on mobile only -->

                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
            </div>

            <!-- End Logo -->

            <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

                <!-- toggle and nav items -->

                <ul class="navbar-nav float-left mr-auto">
                    <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                </ul>

                <!-- Right side toggle and nav items -->

                <ul class="navbar-nav float-right">

                    <!-- Comment -->

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{url('/')}}">{{__('Go to main site')}}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
                        </a>
                        {{--<div class="dropdown-menu" aria-labelledby="navbarDropdown" style="display: none;">--}}
                            {{--<a class="dropdown-item" href="#">Action</a>--}}
                            {{--<a class="dropdown-item" href="#">Another action</a>--}}
                            {{--<div class="dropdown-divider"></div>--}}
                            {{--<a class="dropdown-item" href="#">Something else here</a>--}}
                        {{--</div>--}}
                    </li>

                    <!-- End Comment -->


                    <!-- Messages -->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
                        </a>
                        {{--<div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2" style="display: none;">--}}
                            {{--<ul class="list-style-none">--}}
                                {{--<li>--}}
                                    {{--<div class="">--}}
                                        {{--<!-- Message -->--}}
                                        {{--<a href="javascript:void(0)" class="link border-top">--}}
                                            {{--<div class="d-flex no-block align-items-center p-10">--}}
                                                {{--<span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>--}}
                                                {{--<div class="m-l-10">--}}
                                                    {{--<h5 class="m-b-0">Event today</h5>--}}
                                                    {{--<span class="mail-desc">Just a reminder that event</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</a>--}}
                                        {{--<!-- Message -->--}}
                                        {{--<a href="javascript:void(0)" class="link border-top">--}}
                                            {{--<div class="d-flex no-block align-items-center p-10">--}}
                                                {{--<span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>--}}
                                                {{--<div class="m-l-10">--}}
                                                    {{--<h5 class="m-b-0">Settings</h5>--}}
                                                    {{--<span class="mail-desc">You can customize this template</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</a>--}}
                                        {{--<!-- Message -->--}}
                                        {{--<a href="javascript:void(0)" class="link border-top">--}}
                                            {{--<div class="d-flex no-block align-items-center p-10">--}}
                                                {{--<span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>--}}
                                                {{--<div class="m-l-10">--}}
                                                    {{--<h5 class="m-b-0">Pavan kumar</h5>--}}
                                                    {{--<span class="mail-desc">Just see the my admin!</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</a>--}}
                                        {{--<!-- Message -->--}}
                                        {{--<a href="javascript:void(0)" class="link border-top">--}}
                                            {{--<div class="d-flex no-block align-items-center p-10">--}}
                                                {{--<span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>--}}
                                                {{--<div class="m-l-10">--}}
                                                    {{--<h5 class="m-b-0">Luanch Admin</h5>--}}
                                                    {{--<span class="mail-desc">Just see the my new admin!</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    </li>

                    <!-- End Messages -->



                    <!-- User profile and search -->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="@if(\Illuminate\Support\Facades\Auth::user()->media){{asset(\App\Helpers\common::getMediaPath(\Illuminate\Support\Facades\Auth::user()->media, '66x66'))}}@else{{asset('public/admin/images/users/1.jpg')}}@endif" alt="user" class="rounded-circle" width="31" style="margin-top:15px;"></a>
                        <div class="dropdown-menu dropdown-menu-right user-dd animated">
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> {{__('My Profile')}}</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> {{__('Account Setting')}}</a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{url('logout')}}"><i class="fa fa-power-off m-r-5 m-l-5"></i> {{__('Logout')}}</a>
                        </div>
                    </li>

                    <!-- User profile and search -->

                </ul>
            </div>
        </nav>
    </header>

    <!-- End Topbar header -->


    <!-- Left Sidebar - style you can find in sidebar.scss  -->

    <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav" class="p-t-30">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="{{url('/admin')}}" ><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">{{__('Dashboard')}}</span></a></li>
{{--                    @permission('manage_realestates')--}}
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-home-modern"></i><span class="hide-menu">Realestate </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{url('admin/property/realestate')}}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> {{__('All Realestates')}} </span></a></li>
                            <li class="sidebar-item"><a href="{{url('new')}}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> {{__('Add new')}} </span></a></li>
                        </ul>
                    </li>
{{--                    @endpermission--}}
{{--                    @permission('manage_jobs')--}}
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-case-sensitive-alt"></i><span class="hide-menu">{{__('Jobb')}} </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{url('admin/jobs')}}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> {{__('All Jobs')}} </span></a></li>
                            <li class="sidebar-item"><a href="{{url('admin/jobs/create')}}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> {{__('Add new')}} </span></a></li>
                        </ul>
                    </li>
                {{-- ads mangment --}}
                  <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-case-sensitive-alt"></i><span class="hide-menu">{{__('Ads Mangemnet')}}</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{url('admin/ads')}}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> {{__('All Banner Ads')}} </span></a></li>
                            <li class="sidebar-item"><a href="{{url('admin/ads/create')}}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> {{__('Add Banner')}} </span></a></li>
                            <li class="sidebar-item"><a href="{{url('/admin/banner-group/index')}}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> {{__('All Banner Group')}} </span></a></li>
                            <li class="sidebar-item"><a href="{{url('/admin/banner-group/create')}}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> {{__('Add Banner Group')}} </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('admin/companies-list') }}" aria-expanded="false"><i class="mdi mdi-cash-multiple"></i><span class="hide-menu">{{__('Companies')}}</span></a></li>
                    
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('admin/agent-list') }}" aria-expanded="false"><i class="mdi mdi-cash-multiple"></i><span class="hide-menu">{{__('Agents')}}</span></a></li>
{{--                    @endpermission--}}
{{--                    @permission('manage_users')--}}
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">{{__('Users')}} </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{url('admin/users')}}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> {{__('All users')}} </span></a></li>
                            <li class="sidebar-item"><a href="{{url('admin/users/create')}}" class="sidebar-link"><i class="mdi mdi-plus"></i><span class="hide-menu"> {{__('Add new')}} </span></a></li>
                            <li class="sidebar-item"><a href="{{url('admin/roles/index')}}" class="sidebar-link"><i class="mdi mdi-account-settings"></i><span class="hide-menu"> {{__('Settings')}} </span></a></li>
                        </ul>
                    </li>
{{--                    @endpermission--}}
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">{{__('Settings')}} </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="settings-site.php" class="sidebar-link"><i class="mdi mdi-settings"></i><span class="hide-menu"> {{__('Site settings')}} </span></a></li>
                            <li class="sidebar-item"><a href="settings-realestate.php" class="sidebar-link"><i class="mdi mdi-home-modern"></i><span class="hide-menu"> {{__('Realestate')}} </span></a></li>
                            <li class="sidebar-item"><a href="settings-job.php" class="sidebar-link"><i class="mdi mdi-case-sensitive-alt"></i><span class="hide-menu"> {{__('Job')}} </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('admin/ratings') }}" aria-expanded="false"><i class="fa fa-star"></i><span class="hide-menu">{{__('Ratings & Reviews')}}</span></a></li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>

    <!-- End Left Sidebar - style you can find in sidebar.scss  -->


    <!-- Page wrapper  -->

    <div class="page-wrapper">

        <!-- Bread crumb and right sidebar toggle -->

        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">@yield('main_title')</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            @yield('breadcrumb')
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- End Bread crumb and right sidebar toggle -->


        <!-- Container fluid  -->

        <div class="container-fluid">
            @yield('page_content')
        </div>

        <!-- End Container fluid  -->


    </div>

    <!-- End Page wrapper  -->

</div>

<!-- End Wrapper -->



<!-- End Wrapper -->


<!-- footer -->

<!--<footer class="footer text-center">-->
<!--    Developed by <a href="https://digitalmx.no">Digitalmx</a>.-->
<!--</footer>-->

<!-- End footer -->


<!-- All Jquery -->
@yield('script')
<script src="{{asset('public/admin/mediexpert.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('public/admin/js/popper.min.js') }}"></script>
<script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/admin/js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('public/admin/js/sparkline.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('public/admin/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('public/admin/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('public/admin/js/custom.min.js') }}"></script>
<!---->
<script src="{{ asset('public/admin/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/admin/js/select2.min.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.multicheck.js') }}"></script>
<script src="{{ asset('public/admin/js/datatable-checkbox-init.js') }}"></script>

<script src="{{ asset('public/admin/js/datatable.min.js') }}"></script>

<!--This page JavaScript -->
<!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
<!-- Charts js Files -->


<script src="{{ asset('public/admin/js/excanvas.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.flot.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.flot.time.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.flot.crosshair.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('public/admin/js/chart-page-init.js') }}"></script>
<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    if($('#zero_config')){
        $('#zero_config').DataTable();
    }
       $('.url_http').on('change', function(){
    s = $(this).val();
    if (!s.match(/^[a-zA-Z]+:\/\//))
    {
        s = 'http://' + s;
    $(this).val(s);
    }
    });
</script>



<div class="flotTip" style="position: absolute; left: 441px; top: 358px; display: none;"></div></body></html>
