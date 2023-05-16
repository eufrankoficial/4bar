
<div class="row clearfix">
    @if(count($kegs))
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="header">
                    <h2 class="size-custom-30">{{ __('Barrel stock') }}</h2>
                    <ul class="header-dropdown dropdown">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('kegs.add') }}">
                                        {{ __('Add') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif



    @forelse($kegs as $keg)
        <div class="col-lg-3 col-md-3">
            <div class="card">
                <div class="header">
                    <h2>{{ $keg->pin_keg }} - {{ $keg->name ? $keg->name : $keg->beerType->name }} </h2>
                </div>
                <div class="body ribbon text-center">
                    @if($keg->status == 'Full' && !$keg->near_due_date && !$keg->used)
                        <div class="ribbon-box green">
                            <i class="fa fa-plus"></i>
                        </div>
                    @elseif($keg->status == 'Half' && !$keg->near_due_date && !$keg->used)
                        <div class="ribbon-box orange">
                            <i class="fa fa-share"></i>
                        </div>
                    @elseif($keg->near_due_date && !$keg->used)
                        <div class="ribbon-box orange">
                            <i class="fa fa-warning"></i>
                        </div>
                    @elseif($keg->empty)
                        <div class="ribbon-box red">
                            <i class="fa fa-close"></i>
                        </div>
                    @endif
                    <div class="mt-4">
                        <a href="{{ route('kegs.edit', $keg) }}">
                            <img class="img-thumbnail" src="{{ keg_level($keg->capacity, $keg->volume_available)['image'] }}" alt="" width="100">
                        </a>
                    </div>
                    <h3 class="mb-0 mt-3 font300">{{ $keg->volume_available }}L</h3>

                    <div class="mt-4">
                        <div class="text-center text-muted">
                            <i class="fa fa-beer badge-warning"></i> {{ $keg->beerType->name }}
                        </div>

                        <div class="text-center text-muted">
                            <i class="fa fa-calendar-o badge-info" alt="{{ __('Due date') }}" title="{{ __('Due date') }}"></i> {{ $keg->due_date }}
                        </div>

                        @if(!$keg->coldChamber)
                            <div class="text-center text-muted">
                                {{ __('No Cold chamber') }}
                            </div>
                        @else
                            {{ $keg->coldChamber->name }}
                        @endif
                    </div>
                </div>

                <div class="card-footer text-center">
                    <div class="row clearfix">
                        <div class="col-2 text-center">
                            <a href="{{ route('alerts.add.keg', $keg) }}" class="open-modal" alt="{{ __('Alerts') }}" title="{{ __('Alerts') }}">
                                <i class="fa fa-bell font-22 badge-warning"></i>
                            </a>
                        </div>

                        <div class="col-2 text-center">
                            <a href="{{ route('kegs.taps_add', $keg) }}" class="open-modal" alt="{{ __('Taps') }}" title="{{ __('Taps') }}">
                                <i class="fa fa-tumblr font-22 badge-info"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-lg-12 col-md-12">
            <div class="card" href="javascript:void(0)">
                @if(isset($title))
                    <div class="header">
                        <h2>{{ $title }}</h2>
                    </div>
                @endif
                <div class="body text-center">
                    <div class="text-center text-muted">
                        {{ __('There are no barrels in stock.') }}
                        <hr>
                        <a href="{{ route('kegs.add') }}" class="btn btn-default">
                            <i class="fa fa-plus"></i>
                            {{ __('Tap to add') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforelse
</div>
