<header class="top-bar fixed-top">
    <div class="nav-container">
        <nav class="navbar navbar-expand-sm mt-0 pt-0 pb-0 desktop-header">
            <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('public/images/NorgesHondel-logo.png')}}" height="28"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon fa fa-bars pt-2"></span>
            </button>
            @if(Auth::check())
            <input type="hidden" value="{{Auth::user()->id}}" id="user_id_notfy">
            <input type="hidden" value="{{App\User::find(Auth::user()->id)->is('admin')}}" id="user_role_admin">
            @endif
            @if(Auth::check())
            <div id="notifications">
            </div>
            @endif
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto" style="">
                    @if(\Illuminate\Support\Facades\Request::is('jobs/search'))
                        @include('user-panel.partials.templates.job-filter')
                    @endif
                    @if(\Illuminate\Support\Facades\Request::is('property/property-for-sale/search'))
                        @include('user-panel.partials.templates.filter-property-for-sale')
                    @endif
                    @if(\Illuminate\Support\Facades\Request::is('property/property-for-rent/search'))
                        @include('user-panel.partials.templates.filter-property-for-rent')
                    @endif
                    @if(\Illuminate\Support\Facades\Request::is('property/commercial-property-for-sale/search'))
                        @include('user-panel.partials.templates.filter-commercial-property-for-sale')
                    @endif
                    @if(\Illuminate\Support\Facades\Request::is('property/commercial-property-for-rent/search'))
                        @include('user-panel.partials.templates.filter-commercial-property-for-rent')
                    @endif
                    @if(\Illuminate\Support\Facades\Request::is('property/commercial-plots/search'))
                        @include('user-panel.partials.templates.filter-commercial-plots')
                    @endif
                    @if(\Illuminate\Support\Facades\Request::is('property/holiday-homes-for-sale/search'))
                        @include('user-panel.partials.templates.filter-holiday-homes-for-sale')
                    @endif
                    @if(\Illuminate\Support\Facades\Request::is('property/business-for-sale/search'))
                        @include('user-panel.partials.templates.filter-business-for-sale')
                    @endif
                    @if(\Illuminate\Support\Facades\Request::is('property/flat-wishes-rented/search'))
                        @include('user-panel.partials.templates.filter-flat-wishes-rented')
                    @endif
                    {{--<li class="nav-item" id="move_to_notifications">--}}
                        {{--<a class="nav-link position-relative" href="{{url('notifications')}}">--}}
                            {{--<span class="badge badge-primary pending position-absolute" id="notification" style="left:0"></span>--}}
                            {{--<i class="far fa-bell nav-icons"></i>--}}
                            {{--<div class="mt-2 ml-2">Varslinger</div>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{url('notifications')}}">
                            @if(\Auth::check())
                                <span class="badge badge-primary pending position-absolute {{ Auth::user()->header_unread_notifications()->count() ? '' : 'd-none'}}" id="notification" style="left:0">
                                    {{Auth::user()->header_unread_notifications()->count() > 0 ? Auth::user()->header_unread_notifications()->count(): 0}}
                                </span>
                            @endif
{{--                            @if(\Auth::check() && Auth::user()->header_unread_notifications()->count() >0)--}}
                                {{--<span class="badge badge-primary pending position-absolute" id="notification" style="left:0">--}}
{{--                                     {{ Auth::user()->header_unread_notifications()->count()}}--}}
                                {{--</span>--}}
                            {{--@endif--}}
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
                        <a class="nav-link position-relative" href="{{url('/messages')}}">
                            @if(\Auth::check())
                                <span class="badge badge-primary pending position-absolute {{count(\Auth::user()->unread_messages()) ? '' : 'd-none'}}" id="chat-notification" style="left:0">
                                    {{count(\Auth::user()->unread_messages()) > 0 ? count(\Auth::user()->unread_messages()): ""}}
                                </span>
                            @endif

                            {{--@if(\Auth::check() && count(\Auth::user()->unread_messages())>0 )--}}
                                {{--<span class="badge badge-primary pending position-absolute" id="chat-notification" style="left:0">--}}
                                    {{--{{count(\Auth::user()->unread_messages()) > 0 ? count(\Auth::user()->unread_messages()): ""}}--}}
                                {{--</span>--}}
                            {{--@endif--}}
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

       <nav class="navbar navbar-expand-lg mt-0 pt-0 pb-0 mobile-header">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('public/images/NorgesHondel-logo-mobile.png')}}" height="28"></a>
        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon fa fa-bars pt-2"></span>
        </button> --}}
        @if(Auth::check())
        <input type="hidden" value="{{Auth::user()->id}}" id="user_id_notfy">
        <input type="hidden" value="{{App\User::find(Auth::user()->id)->is('admin')}}" id="user_role_admin">
        @endif
        @if(Auth::check())
        <div id="notifications">
        </div>
        @endif
        <div class="" id="collapsibleNavbar">
            <ul class="nav ml-auto" style="">


                <li class="order-sm-0">
                    <a class="nav-link position-relative" href="{{url('notifications')}}">

                        @if(\Auth::check())
                            <span class="badge badge-primary pending position-absolute {{ Auth::user()->header_unread_notifications()->count() ? '' : 'd-none'}}" id="notification" style="left:0">
                                {{Auth::user()->header_unread_notifications()->count() > 0 ? Auth::user()->header_unread_notifications()->count(): 0}}
                            </span>
                        @endif

                        <i class="far fa-bell nav-icons"></i>
                    </a>
                </li>


                <li class="order-sm-1">
                    <a class="nav-link" href="{{url('/new')}}">
                        <i class="fas fa-plus nav-icons"></i>
                    </a>
                </li>

                <li class="order-sm-2">
                    <a class="nav-link position-relative" href="{{url('/messages')}}">
                        @if(\Auth::check())
                            <span class="badge badge-primary pending position-absolute {{count(\Auth::user()->unread_messages()) ? '' : 'd-none'}}" id="chat-notification" style="left:0">
                                {{count(\Auth::user()->unread_messages()) > 0 ? count(\Auth::user()->unread_messages()): ""}}
                            </span>
                        @endif
                        <i class="far fa-comment-alt nav-icons"></i>
                            {{-- <img src="{{asset('public/images/Meldinger_ikon.svg')}}" class="nav-icons" style="max-width: 20px; float: left;"> --}}

                    </a>
                </li>
                <li class="order-sm-3" style="padding-bottom: 2px;">
                    @if(Auth::check())
                    <a class="nav-link" href="{{url('my-business')}}">
                      <i class="fas fa-user-circle nav-icons"></i>
                    </a>
                    @else
                        <a class="nav-link" href="{{url('login')}}">
                            <i class="fas fa-user-circle nav-icons"></i>
                        </a>
                    @endif
                </li>
                                 @if(\Illuminate\Support\Facades\Request::is('jobs/search'))
                    @include('user-panel.partials.templates.job-filter')
                @endif
                @if(\Illuminate\Support\Facades\Request::is('property/property-for-sale/search'))
                    @include('user-panel.partials.templates.filter-property-for-sale')
                @endif
                @if(\Illuminate\Support\Facades\Request::is('property/property-for-rent/search'))
                    @include('user-panel.partials.templates.filter-property-for-rent')
                @endif
                @if(\Illuminate\Support\Facades\Request::is('property/commercial-property-for-sale/search'))
                    @include('user-panel.partials.templates.filter-commercial-property-for-sale')
                @endif
                @if(\Illuminate\Support\Facades\Request::is('property/commercial-property-for-rent/search'))
                    @include('user-panel.partials.templates.filter-commercial-property-for-rent')
                @endif
                @if(\Illuminate\Support\Facades\Request::is('property/commercial-plots/search'))
                    @include('user-panel.partials.templates.filter-commercial-plots')
                @endif
                @if(\Illuminate\Support\Facades\Request::is('property/holiday-homes-for-sale/search'))
                    @include('user-panel.partials.templates.filter-holiday-homes-for-sale')
                @endif
                @if(\Illuminate\Support\Facades\Request::is('property/business-for-sale/search'))
                    @include('user-panel.partials.templates.filter-business-for-sale')
                @endif
                @if(\Illuminate\Support\Facades\Request::is('property/flat-wishes-rented/search'))
                    @include('user-panel.partials.templates.filter-flat-wishes-rented')
                @endif
            </ul>
        </div>
    </nav>
    </div>
</header>
