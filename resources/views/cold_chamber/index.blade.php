@extends('layouts.default',
    [
        'pageTitle' => __('Cold chamber'),
        'breadcrumb' => 'cold_chamber.index',
        'componentButtonAdd' => 'elements.cold_chamber.add_component',
        'functionPermission' => 'userHasPermission',
        'permissions' => ['add']
     ]
    )

@section('content')
    <div class="row clearfix">
        <div class="col-12">

            <div class="table-responsive">
                <table class="table table-hover table-custom spacing8">
                    <thead>
                    <tr>
                        <th>{{ __('Cold Chamber') }}</th>
                        <th>{{ __('Sensor') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Capacity') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($coldChambers as $chamber)
                        <tr>

                            <td>
                                {{ $chamber->name }}
                            </td>

                            <td>
                                @if($chamber->sensor)
                                    {{ $chamber->sensor->name }}
                                @endif
                            </td>

                            <td>
                                {{ $chamber->status }}
                            </td>

                            <td>
                                {{ $chamber->capacity }}
                            </td>

                            <td>
                                @can('alter')
                                    <edit-cold-chamber
                                        sensorsprop="{{ $sensors }}"
                                        postsaveurl="{{ route('cold_chamber.update.post', $chamber) }}"
                                        coldchamber="{{ $chamber }}"
                                    ></edit-cold-chamber>

                                    <a href="{{ route('alerts.add.cold_chamber', $chamber->slug) }}" class="btn btn-sm btn-default open-modal" title="Alerta">
                                        <i class="fa fa-warning tex-white"></i> {{ __('Add Alert') }}
                                    </a>
                                @endcan

                                @if(!$chamber->kegs)
                                    @can('delete')
                                        <delete-button url="{{ route('cold_chamber.delete', $chamber->slug) }}"></delete-button>
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="5">
                                {{ __('Is no data to show') }}
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>

            @include('partials.pagination', ['data' => $coldChambers])
        </div>
    </div>
@endsection
