@extends('layouts.default',
    [
        'pageTitle' => __('Beer Type'),
        'breadcrumb' => 'beer_type.index',
        'addButton' => route('beer_type.add'),
        'functionPermission' => 'userHasPermission',
        'permissions' => ['full', 'add']
     ]
    )

@section('content')
    <div class="row clearfix">
        <div class="col-12">
            @include('elements.beer_types.search')
            <div class="table-responsive">
                <table class="table table-hover table-custom spacing8">
                    <thead>
                    <tr>
                        <th>{{ __('Beer Type') }}</th>
                        <th>{{ __('IBU') }}</th>
                        @if(current_user()->hasRole('SuperAdmin'))
                            <th>{{ __('Approved') }}</th>
                            <th>{{ __('Actions') }}</th>
                            <th>{{ __('Status') }}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($types as $type)
                        <tr>

                            <td>
                                {{ $type->name }}
                            </td>

                            <td>
                                {{ $type->ibu }}
                            </td>

                            @if(current_user()->hasRole('SuperAdmin'))
                                <td>
                                    <approve-beer-type
                                        url="{{ route('beer_type.approve', $type) }}"
                                        warning="{{ $type->status !== \App\Models\BeerType::STATUS_APPROVED }}"
                                        text="Clique para aprovar"
                                    >
                                    </approve-beer-type>
                                </td>

                                <td>
                                    @if(current_user()->hasRole('SuperAdmin'))
                                        <a href="{{ route('beer_type.edit', $type->slug) }}" class="btn btn-sm btn-default open-modal" title="Edit">
                                            <i class="fa fa-edit tex-white"></i> {{ __('Edit') }}
                                        </a>

                                        <delete-button url="{{ route('beer_type.delete', $type->slug) }}"></delete-button>
                                    @endif

                                </td>

                                <td>
                                    <p class="mb-0 font-10 mt-3">
                                        <small class="badge badge-info">
                                            {{ $type->status }}
                                        </small>
                                    </p>
                                </td>
                            @endif
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
