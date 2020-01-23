<header class="top-bar fixed-top">
    <div class="nav-container">
        <nav class="navbar navbar-expand-sm mt-0 pt-0 pb-0">
            <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('public/images/NorgesHondel-logo.png')}}" height="28"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon fa fa-bars pt-2"></span>
            </button>
            <div id="notifications">
            </div>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto" style="">
                    @if(\Illuminate\Support\Facades\Request::is('jobs/search'))
                        @include('user-panel.partials.templates.job-filter')
                    @endif

                    <style>
                    #collapsibleNavbar > ul > li:nth-child(2) > a > span {
                        -webkit-tap-highlight-color: rgba(0,0,0,0);
                            font-family: "Open Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
                            list-style: none;
                            box-sizing: border-box;
                            text-align: center;
                            white-space: nowrap;
                            vertical-align: baseline;
                            border-radius: 1em;
                            color: #fff;
                            text-shadow: 0 -1px 0 rgba(0,0,0,.2);
                            font-weight: 600;
                            top: 10px;
                            font-size: 10px;
                            padding: 0 2px;
                            line-height: 12px;
                            position: absolute;
                            display: block;
                            background: red;
                            padding:1px
                                padding-left: 2px;
                        padding-right: 2px;
                    }
                    </style>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                        <span class="label">5</span>

                            <i class="far fa-bell nav-icons"></i>
                            <div class="mt-2 ml-2">Varslinger</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/new')}}">
                            <i class="fas fa-plus nav-icons"></i>
                            <div class="mt-2 ml-2">Ny annonse</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/messages')}}">
                            <img src="{{asset('public/images/Meldinger_ikon.svg')}}" class="nav-icons" style="max-width: 20px; float: left;">
                            <div class="mt-2 ml-2">Meldinger</div>
                        </a>
                    </li>
                    <li class="nav-item type-btn" style="padding-top: 4px; padding-bottom: 2px;">
                        @if(Auth::check())
                        <a class="nav-link dme-btn-outlined-blue" href="{{url('my-business')}}">
                            <div class="mt-2 ml-2">Min handel</div>
                        </a>
                        @else
                            <a class="nav-link dme-btn-outlined-blue" href="{{url('login')}}">
                                <div class="mt-2 ml-2">Logg inn</div>
                            </a>
                        @endif
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>