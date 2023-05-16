@extends('layouts.default',
    [
        'pageTitle' => __('Organizations'),
        'breadcrumb' => 'orgs.index',
        'addButton' => route('orgs.add'),
        'functionPermission' => 'hasPermission',
        'permissions' => ['full', 'add']
     ]
    )

@section('content')
    <div class="row clearfix">
        <div class="col-12">
            @include('elements.organization.search')

            <div class="table-responsive">
                <table class="table table-hover table-custom spacing8">
                    <thead>
                    <tr>
                        <th>{{ __('Organization') }}</th>
                        <th>{{ __('Branchs') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($orgs as $org)
                        <tr>

                            <td>
                                <a href="{{ route('orgs.edit', $org->slug) }}" title="">{{ $org->name }}</a>
                                @if($org->administrator)
                                    <p class="mb-0">{{ $org->administrator->name }}</p>
                                @endif
                            </td>

                            <td>
                                <a href="#">{{ $org->branchs->count() }}</a>
                            </td>

                            <td>
                                @if(current_user()->hasPermission(['full', 'alter']))
                                    <a href="{{ route('orgs.edit', $org->slug) }}" class="btn btn-sm btn-default" title="Edit">
                                        <i class="fa fa-edit tex-white"></i> {{ __('Edit') }}
                                    </a>
                                @endif

                                @can('alter')
                                    <a href="{{ route('orgs.branchs.index', $org->slug) }}" class="btn btn-sm btn-default" title="Edit">
                                        <i class="fa fa-location-arrow tex-white"></i> {{ __('Branchs') }}
                                    </a>
                                @endif

                                @can('alter')
                                    <a href="{{ route('orgs.branchs.add', [$org->slug]) }}" class="btn btn-sm btn-default" title="Edit">
                                        <i class="fa fa-plus tex-white"></i> {{ __('Add Branch') }}
                                    </a>
                                @endif

                                    @if(current_user()->hasPermission(['full', 'delete']) && !$org->branchs)
                                    <delete-button url="{{ route('orgs.delete', $org->slug) }}"></delete-button>
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

            @include('partials.pagination', ['data' => $orgs])
        </div>
    </div>
@endsection
