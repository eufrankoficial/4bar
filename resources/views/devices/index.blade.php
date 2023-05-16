@extends('layouts.default',
    [
        'pageTitle' => __('Devices'),
        'breadcrumb' => 'devices.index',
        'addButton' => route('devices.add'),
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
                        <th>{{ __('Device') }}</th>
                        <th>{{ __('Last Syncronization') }}</th>
                        <th>{{ __('Organization') }}</th>
                        <th>{{ __('Branch') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($devices as $device)
                        <tr>

                            <td>
                                <a href="{{ route('devices.edit', $device) }}" title="">{{ $device->name }}</a>
                            </td>

                            <td>
                                @if($device->last_synchronization)
                                    {{ $device->last_synchronization->format('d/m/Y H:i:s') }}
                                @endif
                            </td>

                            <td>
                                @if($device->org)
                                    {{ $device->org->name }}
                                @endif
                            </td>

                            <td>
                                @if($device->branchs)
                                    {{ $device->branchs->name }}
                                @endif
                            </td>

                            <td>
                                @can('alter')
                                    <a href="{{ route('devices.edit', $device->slug) }}" class="btn btn-sm btn-default" title="Edit">
                                        <i class="fa fa-edit tex-white"></i> {{ __('Edit') }}
                                    </a>

                                    <a href="{{ route('sensors.add', ['device' => $device->slug]) }}" class="btn btn-sm btn-default open-modal" title="{{ __('Add sensor') }}">
                                        <i class="fa fa-location-arrow tex-white"></i> {{ __('Add Sensor') }}
                                    </a>
                                @endcan

                                @if(!$device->sensor)
                                    @can('delete')
                                        <delete-button url="{{ route('devices.delete', $device->slug) }}"></delete-button>
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

            @include('partials.pagination', ['data' => $devices])
        </div>
    </div>
@endsection
