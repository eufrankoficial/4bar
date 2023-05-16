@extends('layouts.default',
    [
        'pageTitle' => __('Maintenance'),
        'breadcrumb' => 'maintenance.index',
        'addButton' => route('maintenance.add'),
        'functionPermission' => 'userHasPermission',
        'permissions' => ['full', 'add']
     ]
    )

@section('content')
    <div class="row clearfix">
        <div class="col-12">
            @include('elements.maintenance.search')

            <div class="table-responsive">
                <table class="table table-hover table-custom spacing8">
                    <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Device') }}</th>
                        <th>{{ __('Cold Chamber') }}</th>
                        <th>{{ __('Tap') }}</th>
                        <th>{{ __('Created at') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($maintenence as $m)
                        <tr>

                            <td>
                                {{ $m->name }}
                            </td>

                            <td>
                                @if($m->device)
                                    {{ $m->device->name }}
                                @else
                                    N/N
                                @endif
                            </td>

                            <td>
                                @if($m->coldChamber)
                                    {{ $m->coldChamber->name }}
                                @else
                                    N/N
                                @endif
                            </td>

                            <td>
                                @if($m->tap)
                                    {{ $m->tap->name }}
                                @else
                                    N/N
                                @endif
                            </td>

                            <td>
                                {{ $m->created_at->format('d/m/Y') }}
                            </td>

                            <td>
                                <a href="{{ route('maintenance.view', $m) }}" class="btn btn-sm btn-default open-modal" title="{{ __('View') }}">
                                    <i class="fa fa-eye tex-white"></i> {{ __('View') }}
                                </a>

                                @if(current_user()->hasRole('SuperAdmin'))
                                    <delete-button url="{{ route('maintenance.delete', $m) }}"></delete-button>
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

            @include('partials.pagination', ['data' => $maintenence])
        </div>
    </div>
@endsection
