@extends('layouts.default',
    [
        'pageTitle' => __('Branchs'),
        'breadcrumb' => !is_null($org) ? 'orgs.branchs.index' : 'branchs.index',
        'param' => !is_null($org) ? $org : null,
        'addButton' => !is_null($org) ? route('orgs.branchs.add', $org) : route('branchs.add'),
        'functionPermission' => 'userHasPermission',
        'permissions' => ['add']
    ])

    @section('content')
        <div class="row clearfix">
            <div class="col-12">
                @include('elements.branchs.search')
                <div class="table-responsive">
                    <table class="table table-hover table-custom spacing8">
                        <thead>
                        <tr>
                            <th>{{ __('Branch') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('CNPJ') }}</th>
                            @if(!isset($org))
                                <th>{{ __('Organization') }}</th>
                            @endif
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($branchs as $branch)
                            <tr>

                                <td>
                                    <a href="{{ route('orgs.branchs.edit', [$branch->org->slug, $branch->slug]) }}" title="">{{ $branch->name }}</a>
                                </td>

                                <td>
                                    {{ $branch->phone }}
                                </td>

                                <td>
                                    {{ $branch->cnpj }}
                                </td>

                                @if(!isset($org))
                                    <th>
                                        {{ $branch->org->name }}
                                    </th>
                                @endif

                                <td>
                                    @can('alter')
                                        <a href="{{ route('orgs.branchs.edit', [$branch->org->slug, $branch->slug]) }}" class="btn btn-sm btn-default" title="Edit">
                                            <i class="fa fa-edit tex-white"></i> {{ __('Edit') }}
                                        </a>
                                    @endif

                                    @can('alter')
                                        <a href="{{ route('orgs.branchs.calendar.index', [$branch->org->slug, $branch->slug]) }}" class="btn btn-sm btn-default" title="Edit">
                                            <i class="fa fa-calendar tex-white"></i> {{ __('Calendar') }}
                                        </a>
                                    @endif

                                    @if(current_user()->userHasPermission(['full', 'delete']) && $branch->canDelete($branch))
                                        <delete-button url="{{ route('orgs.branchs.delete', [$branch->org->slug, $branch->slug]) }}"></delete-button>
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

                @include('partials.pagination', ['data' => $branchs])
            </div>
        </div>
    @endsection
