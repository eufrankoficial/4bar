@extends('layouts.default',
    [
        'pageTitle' => __('Permissions'),
        'breadcrumb' => 'users.permission.index',
        'addButton' => route('users.permission.add'),
        'functionPermission' => 'hasPermission',
        'permissions' => ['full', 'add']
     ])
    @section('content')

        <div class="row clearfix">
            <div class="col-12">

                <div class="table-responsive">
                    <table class="table table-hover table-custom spacing8">
                        <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($permissions as $permission)
                            <tr>

                                <td>
                                    {{ $permission->name }}
                                </td>

                                <td>
                                    @if(current_user()->hasPermission(['full', 'edit']))
                                        <a href="{{ route('users.permission.edit', $permission->slug) }}" class="btn btn-sm btn-default" title="Edit">
                                            <i class="fa fa-edit tex-white"></i> {{ __('Edit') }}
                                        </a>
                                    @endif

                                    @if(current_user()->hasPermission(['full', 'delete']))
                                        <delete-button url="{{ route('users.permission.delete', $permission->slug) }}"></delete-button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

                @include('partials.pagination', ['data' => $permissions])
            </div>
        </div>

    @endsection
