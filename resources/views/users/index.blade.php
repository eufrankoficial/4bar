@extends('layouts.default',
    [
        'pageTitle' => __('Users'),
        'breadcrumb' => 'users.index',
        'addButton' => route('users.add'),
        'functionPermission' => 'hasPermission',
        'permissions' => ['full', 'add']
    ])

@section('content')

    <div class="row clearfix">
        <div class="col-12">
            @include('elements.users.search')
            <div class="table-responsive">
                <table class="table table-hover table-custom spacing8">
                    <thead>
                    <tr>
                        <th>{{ __('User') }}</th>
                        <th>{{ __('Roles') }}</th>
                        <th>{{ __('Organization/Branch') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>

                            <td>
                                <a href="{{ route('users.edit', $user->slug) }}" title="">{{ $user->name }}</a>
                                <p class="mb-0">{{ $user->email }}</p>
                            </td>
                            <td>
                                @foreach($user->group as $group)
                                    <span class="badge badge-success">{{ $group->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if($user->organization)
                                    <span class="badge badge-info">{{ $user->organization->name }}</span>
                                @else
                                    @foreach($user->branchs as $branch)
                                        <span class="badge badge-warning">
                                            {{ $branch->name }} <br><br>
                                            <small>{{ $branch->org->name }}</small>
                                        </span>

                                    @endforeach
                                @endif
                            </td>

                            <td>
                                @if(current_user()->hasPermission(['full', 'edit']))
                                    <a href="{{ route('users.edit', $user->slug) }}" class="btn btn-sm btn-default" title="Edit">
                                        <i class="fa fa-edit tex-white"></i> {{ __('Edit') }}
                                    </a>
                                @endif

                                @if(current_user()->hasPermission(['full', 'delete']))
                                    <delete-button url="{{ route('users.delete', $user) }}"></delete-button>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            @include('partials.pagination', ['data' => $users])
        </div>
    </div>
@endsection
