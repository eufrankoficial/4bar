@extends('layouts.default',
    [
        'pageTitle' => __('Menus'),
        'breadcrumb' => 'menu.index',
        'addButton' => route('menu.add'),
        'functionPermission' => 'userHasPermission',
        'permissions' => ['full', 'add']
     ]
    )

@section('content')
    <div class="row clearfix">
        <div class="col-12">
            @include('elements.menus.search')
            <div class="table-responsive">
                <table class="table table-hover table-custom spacing8">
                    <thead>
                    <tr>
                        <th>{{ __('Menu') }}</th>
                        <th>{{ __('Parents') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($menus as $menu)

                            <tr>

                                <td>
                                    <a href="{{ route('menu.edit', $menu) }}" title="">{{ $menu->menu }}</a>
                                </td>

                                <td>
                                    {{ $menu->parents->count() }}
                                </td>

                                <td>
                                    @can('alter')
                                        <a href="{{ route('menu.edit', $menu->slug) }}" class="btn btn-sm btn-default" title="Edit">
                                            <i class="fa fa-edit tex-white"></i> {{ __('Edit') }}
                                        </a>
                                    @endcan

                                    @can('delete')
                                        <delete-button url="{{ route('menu.delete', $menu->slug) }}"></delete-button>
                                    @endcan
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

            @include('partials.pagination', ['data' => $menus])
        </div>
    </div>
@endsection
