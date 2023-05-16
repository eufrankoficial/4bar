
@if(count($taps) > 0)
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="header">
                    <h2 class="size-custom-30">{{ __('Taps') }}</h2>
                    <ul class="header-dropdown dropdown">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">
                                        Adicionar
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <tap-list
            tapscollection="{{ $taps }}"
            urlkegedit="{{ route('kegs.edit') }}"
            url="{{ route('taps.actives') }}"
            urlreleasetap="{{ route('taps.realease.post') }}"
            assignkegurl="{{ route('taps.assign.keg') }}"
            getpinurl="{{ route('pins.get') }}"
            addalerturl="{{ route('alerts.add.keg') }}"
        ></tap-list>
</div>
@endif
