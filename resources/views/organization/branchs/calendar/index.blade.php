@extends('layouts.default',
    [
        'pageTitle' => __('Calendar') . ' - ' . $branch->name,
        'breadcrumb' => 'orgs.branchs.calendar.index',
        'param' => [$branch->org, $branch],
        'addButton' => route('orgs.branchs.calendar.add', [$branch->org, $branch]),
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
                        <th>{{ __('Week Day') }}</th>
                        <th>{{ __('Opening time') }}</th>
                        <th>{{ __('Closing time') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($calendars as $calendar)
                        <tr>

                            <td>
                                <a href="{{ route('orgs.branchs.edit', ['teste', $calendar->slug]) }}" title="">{{ $calendar->week_day }}</a>
                            </td>

                            <td>
                                {{ $calendar->opening_time }}
                            </td>

                            <td>
                                {{ $calendar->closing_time }}
                            </td>

                            <td>
                                @can('alter')
                                    <a href="{{ route('orgs.branchs.calendar.edit', [$branch->org, $branch->slug, $calendar]) }}" class="btn btn-sm btn-default" title="Edit">
                                        <i class="fa fa-edit tex-white"></i> {{ __('Edit') }}
                                    </a>
                                @endif

                                @can('delete')
                                    <delete-button url="{{ route('orgs.branchs.calendar.delete', [$branch->org, $branch->slug, $calendar]) }}"></delete-button>
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

            @include('partials.pagination', ['data' => $calendars])
        </div>
    </div>
@endsection
