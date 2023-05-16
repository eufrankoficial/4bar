@extends('layouts.default',
    [
        'pageTitle' => __('Group Users'),
        'breadcrumb' => 'users.group.index',
        'addButton' => route('users.group.add'),
        'functionPermission' => 'hasPermission',
        'permissions' => ['full', 'add']
     ])

@section('content')

    <div class="row clearfix">
        <div class="col-12">

            @include('elements.groups.search')

            <div class="table-responsive">
                <table class="table table-hover table-custom spacing8">
                    <thead>
                    <tr>
                        <th>{{ __('Group') }}</th>
                        <th>{{ __('Permissions') }}</th>
                        <th>{{ __('Menus') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $group)
                        <tr>

                            <td>
                                {{ $group->name }}
                            </td>

                            <td>
                                @foreach($group->permissions as $permission)
                                    <span class="badge badge-success">{{ $permission->name }}</span>
                                @endforeach
                            </td>

                            <td>
                                @foreach($group->menus as $m)
                                    <span class="badge badge-warning">{{ $m->menu }}</span>
                                @endforeach
                            </td>

                            <td>
                                @if(current_user()->hasPermission(['full', 'edit']))
                                    <a href="{{ route('users.group.edit', $group->slug) }}" class="btn btn-sm btn-default" title="Edit">
                                        <i class="fa fa-edit tex-white"></i> {{ __('Edit') }}
                                    </a>
                                @endif

                                @if(current_user()->hasPermission(['full', 'delete']))
                                    <delete-button url="{{ route('users.group.delete', $group->slug) }}"></delete-button>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            @include('partials.pagination', ['data' => $groups])
        </div>
    </div>
@endsection
