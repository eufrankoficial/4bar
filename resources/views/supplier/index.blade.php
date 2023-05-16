@extends('layouts.default',
    [
        'pageTitle' => __('Suppliers'),
        'breadcrumb' => 'supplier.index',
        'addButton' => route('supplier.add'),
        'functionPermission' => 'userHasPermission',
        'permissions' => ['add']
    ])

    @section('content')
        <div class="row clearfix">
            <div class="col-12">
                @include('elements.supplier.search')
                <div class="table-responsive">
                    <table class="table table-hover table-custom spacing8">
                        <thead>
                        <tr>
                            <th>{{ __('Supplier') }}</th>
                            <th>{{ __('CPF/CNPJ') }}</th>
                            @if(current_user()->hasRole('SuperAdmin'))
                                <th>{{ __('Organization') }}</th>
                            @endif
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($suppliers as $sup)
                            <tr>

                                <td>
                                    <a href="{{ route('supplier.edit', $sup->slug) }}" title="">{{ $sup->name }}</a>
                                </td>

                                <td>{{ $sup->cpf_cnpj }}

                                @if(current_user()->hasRole('SuperAdmin'))
                                    @if($sup->organization)
                                        <td>{{ $sup->organization->name }}</td>
                                    @else
                                        <td>{{ config('app.name') }}</td>
                                    @endif
                                @endif


                                <td>
                                    @can('alter')
                                        <a href="{{ route('supplier.edit', $sup->slug) }}" class="btn btn-sm btn-default" title="Edit">
                                            <i class="fa fa-edit tex-white"></i> {{ __('Edit') }}
                                        </a>

                                    @endif

                                    @if(!$sup->kegs)
                                        @can('delete')
                                            <delete-button url="{{ route('supplier.delete', $sup->slug) }}"></delete-button>
                                        @endif
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

                @include('partials.pagination', ['data' => $suppliers])

            </div>
        </div>
    @endsection
