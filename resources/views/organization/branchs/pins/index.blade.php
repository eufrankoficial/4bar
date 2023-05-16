@extends('layouts.default',
    [
        'pageTitle' => __('Pins Kegs'),
        'breadcrumb' => 'pins.index',
        'addButton' => route('pins.add'),
        'functionPermission' => 'userHasPermission',
        'permissions' => ['add']
    ])

@section('content')
    <div class="row clearfix">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover table-custom spacing8">
                    <thead>
                    <tr>
                        @if(current_user()->hasRole('SuperAdmin'))
                            <th>{{ __('Branch') }}</th>
                        @endif
                        <th>{{ __('Pin') }}</th>
                        <th>{{ __('Used') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($pins as $pin)
                        <tr>

                            @if(current_user()->hasRole('SuperAdmin'))
                                <td>
                                    {{ $pin->branchs->name }}
                                    <p class="mb-0">
                                        <small>
                                            <a href="{{ route('orgs.edit', $pin->org) }}" title="">{{ $pin->org->name }}</a>
                                        </small>
                                    </p>
                                </td>
                            @endif

                            <td>
                                {{ $pin->pin }}
                            </td>

                            <td>
                                @if($pin->used)
                                    <span class="badge badge-primary">{{ __('Used') }}</span>
                                @else
                                    <span class="badge badge-danger">{{ __('Not Used') }}</span>
                                @endif
                            </td>

                            <td>
                                @can('alter')
                                    <a href="{{ route('pins.edit', $pin) }}" class="btn btn-sm btn-default" title="Edit">
                                        <i class="fa fa-edit tex-white"></i> {{ __('Edit') }}
                                    </a>
                                @endif

                                @if(current_user()->userHasPermission(['delete']))
                                    <delete-button url="{{ route('pins.delete', $pin) }}"></delete-button>
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

            @include('partials.pagination', ['data' => $pins])
        </div>
    </div>
@endsection
