<nav class="navbar top-navbar">
    <div class="container-fluid">
        <div class="navbar-left">
            <div class="navbar-btn">
                <a href="{{ route('dashboard.index') }}" class="hidden-xs">
                    <img alt="4BAR LOGO" src="{{ logo()  }}" class="img-fluid logo">
                </a>
                <button type="button" class="btn-toggle-offcanvas">
                    <i class="lnr lnr-menu fa fa-bars"></i>
                </button>
            </div>
        </div>

        <div class="navbar-right">
            <div class="hidden-sm">
                @if(count($coldChambers) > 0 && isset($coldChambers->first()->temperature))
                    <temperature
                        coldchamber="{{ $coldChambers->first() }}"
                        temperaturechamber="{{ $coldChambers->first()->temperature_view }}"
                        image="{{ $coldChambers->first()->image_temperature }}"
                        url="{{ route('cold_chamber.current.temperature') }}"
                    ></temperature>
                @endif
            </div>

            @if(cache('branchs_'.cache_key()) && cache('branchs_'.cache_key())->count() > 0 && (current_user()->hasRole('Admin') || current_user()->branchs->count() > 0))
                <select-branch
                    user_branchs="{{ cache('branchs_'.cache_key()) }}"
                    current_branch_user="{{ cache('current_branch_'.cache_key())  }}"
                    changebranchurl="{{ route('branch.change') }}"
                >
                </select-branch>
            @endif
            <div class="hidden-sm">
                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('logout') }}" class="icon-menu"><i class="icon-power"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="progress-container"><div class="progress-bar" id="myBar"></div></div>
</nav>
