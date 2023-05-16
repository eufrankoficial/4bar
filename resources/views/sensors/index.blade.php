@extends('layouts.default',
    [
        'pageTitle' => __('Sensors'),
        'breadcrumb' => 'sensors.index',
        'addButton' => route('sensors.add'),
        'modal' => true,
        'functionPermission' => 'userHasPermission',
        'permissions' => ['full', 'add']
     ]
    )

@section('content')
    <div class="row clearfix">
        <div class="col-12">

            <div class="table-responsive">
                <table class="table table-hover table-custom spacing8">
                    <thead>
                    <tr>
                        <th>{{ __('Sensor') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Flow Rate') }}</th>
                        <th>{{ __('Device Port') }}</th>
                        <th>{{ __('Stop Pouring Delay') }}</th>
                        <th>{{ __('Last Synchronization') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($sensors as $sensor)
                        <tr>

                            <td>
                                <a href="{{ route('sensors.edit', $sensor) }}" class="open-modal" title="">{{ $sensor->name }}</a>
                            </td>

                            <td>
                                {{ $sensor->type->sensor_type_name }}
                            </td>

                            <td>
                                {{ $sensor->flow_rate }}
                            </td>

                            <td>
                                {{ $sensor->device_port }}
                            </td>
                            <td>
                                {{ $sensor->stop_pouring_delay }}
                            </td>

                            <td>
                                {{ $sensor->device->last_synchronization->format('d/m/Y: H:i:s') }}
                            </td>

                            <td>
                                @can('alter')
                                    <a href="{{ route('sensors.edit', $sensor) }}" class="btn btn-sm btn-default open-modal" title="Edit">
                                        <i class="fa fa-edit tex-white"></i> {{ __('Edit') }}
                                    </a>
                                @endcan

                                @if(!$sensor->coldChambers)
                                    @can('delete')
                                        <delete-button url="{{ route('sensors.delete', $sensor) }}"></delete-button>
                                    @endcan
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="4">
                                {{ __('Is no data to show') }}
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>

            @include('partials.pagination', ['data' => $sensors])
        </div>
    </div>
@endsection
