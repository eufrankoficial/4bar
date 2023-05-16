@extends('layouts.default',
    [
        'pageTitle' => __('Sensor Type'),
        'breadcrumb' => 'sensor_type.index',
        'addButton' => route('sensor_type.add'),
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
                        <th>{{ __('Sensor Type') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($types as $type)
                        <tr>

                            <td>
                                <a href="{{ route('sensor_type.edit', $type) }}" title="">{{ $type->sensor_type_string }}</a>
                            </td>

                            <td>
                                {{ $type->sensor_type_name }}
                            </td>

                            <td>
                                @can('alter')
                                    <a href="{{ route('sensor_type.edit', $type->slug) }}" class="btn btn-sm btn-default" title="Edit">
                                        <i class="fa fa-edit tex-white"></i> {{ __('Edit') }}
                                    </a>
                                @endcan

                                @if(!$type->sensors)
                                    @can('delete')
                                        <delete-button url="{{ route('sensor_type.delete', $type->slug) }}"></delete-button>
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

            @include('partials.pagination', ['data' => $types])
        </div>
    </div>
@endsection
