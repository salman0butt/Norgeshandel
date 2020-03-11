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
                 <a href="#">test@gmail.com</a>
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:transparent;border:none;">
                        <i class="fas fa-sort-down" style="color:gray;"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button"><b><i class="fas fa-user"></i>  developer_dmx</b></button>
                        <button class="dropdown-item" type="button"><i class="fas fa-cog"></i>Kontoinnstillinger</button>
                        <button class="dropdown-item" type="button"><i class="far fa-life-ring"></i> Hjelp</button>
                        <button class="dropdown-item" type="button"><i class="fas fa-sign-out-alt"></i> Logg ut</button>
                    </div>
                </div>
                </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
