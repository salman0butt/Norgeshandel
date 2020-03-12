<style>
#collapsibleNavbar,.dropdown {
    display:block !important;
    float:right;
    text-align: right;
}
</style>
<header class="top-bar fixed-top">
    <div class="nav-container">
        <nav class="navbar navbar-expand-sm mt-0 pt-2 pb-0">
            <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('public/images/NorgesHondel-logo.png')}}"
                    height="28"></a>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <div class="dropdown">
                 <a href="#">{{Auth::user()->email}}</a>
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:transparent;border:none;">
                        <i class="fas fa-sort-down" style="color:gray;"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        @if(Auth::user()->username)
                            <a href="{{url('account/summary')}}" class="dropdown-item" type="button"><b><i class="fas fa-user pr-2"></i>{{Auth::user()->username}}</b></a>
                        @endif
                        <a href="{{url('account/setting')}}" class="dropdown-item" type="button"><i class="fas fa-cog pr-2"></i>Kontoinnstillinger</a>
                        <button class="dropdown-item" type="button"><i class="far fa-life-ring pr-2"></i> Hjelp</button>
                        <a href="{{url('logout')}}" class="dropdown-item" type="button"><i class="fas fa-sign-out-alt pr-2"></i> Logg ut</a>
                    </div>
                </div>
                </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
