<div id="left-sidebar" class="sidebar mini_sidebar_on">
    <div class="navbar-brand">
        <a href="{{ route('dashboard.index') }}">
            <img alt="4Bar Logo" src="{{ logo() }}" class="img-fluid img-responsive" width="100">
{{--            <span class="d-block">--}}
{{--                {{ show_name() }}--}}
{{--            </span>--}}
        </a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right">
            <i class="lnr lnr-menu icon-close"></i>
        </button>
    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
{{--            <div class="user_div">--}}
{{--                <img class="user-photo" src="{{ asset('assets/core/images/user.png') }}" alt="User Profile Picture">--}}
{{--            </div>--}}
            <div class="dropdown">
                <span>Bem-vindo,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ current_user()->name }}</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                    <li class="divider"></li>
                    <li><a href="{{ route('logout') }}"><i class="icon-power"></i>Logout</a></li>
                </ul>
            </div>
        </div>

        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">

                @if(cache('menus_'.cache_key()))
                    @foreach(cache('menus_'.cache_key()) as $menu)
                        @if($menu->parents->count() > 0)
                            <li>
                                <a href="{{ $menu->parents->count() == 0 && $menu->route != '#' ? route($menu->route) : '#' }}" class="{{ $menu->parents->count() > 0 ? 'has-arrow' : ''}}">
                                    @if($menu->icon)
                                        <i class="{{ $menu->icon }}"></i>
                                    @endif
                                    <span>{{ $menu->menu }}</span>
                                </a>
                                <ul>
                                    @foreach($menu->parents as $parent)
                                        <li>
                                            <a href="{{ !is_null($parent->route) ? route($parent->route) : '#' }}">
                                                {{ $parent->menu }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @elseif($menu->parents->count() == 0 && $menu->route !== '#' && $menu->route !== '')
                            <li>
                                <a href="{{ $menu->parents->count() == 0 && $menu->route != '#' ? route($menu->route) : '#' }}" class="{{ $menu->parents->count() > 0 ? 'has-arrow' : ''}}">
                                    @if($menu->icon)
                                        <i class="{{ $menu->icon }}"></i>
                                    @endif
                                    <span>{{ $menu->menu }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif


                <li class="header">{{ __('Temperature') }}</li>
                @if(count($coldChambers) > 0 && isset($coldChambers->first()->temperature))
                    <li class="hidden">
                        <temperature
                            coldchamber="{{ $coldChambers->first() }}"
                            temperaturechamber="{{ $coldChambers->first()->temperature_view }}"
                            image="{{ $coldChambers->first()->image_temperature }}"
                            url="{{ route('cold_chamber.current.temperature') }}"
                        ></temperature>
                    </li>
                @endif


                <li class="header">{{ __('Sessão') }}</li>
                <li>
                    <a href="{{ route('logout') }}">
                        <i class="icon-power"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</div>
