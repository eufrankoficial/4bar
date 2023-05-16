@extends('layouts.default',
    [
        'pageTitle' => __('Taps'),
        'breadcrumb' => 'taps.index',
        'addButton' => route('taps.add'),
        'modal' => true,
        'functionPermission' => 'userHasPermission',
        'permissions' => ['full', 'add']
     ]
    )

@section('content')
    <div class="row clearfix">
        <div class="col-12">

            @include('elements.taps.search')

            <div class="table-responsive">
                <table class="table table-hover table-custom spacing8">
                    <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Keg') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($taps as $tap)
                        <tr>

                            <td>
                                {{ $tap->name }}
                            </td>

                            <td>
                                @if($tap->keg)
                                    {{ $tap->keg->pin_keg }}
                                @else
                                    {{ __('Empty') }}
                                @endif
                            </td>

                            <td>
                                @can('alter')
                                    <a href="{{ route('taps.edit', $tap) }}" class="btn btn-sm btn-default open-modal" title="Edit">
                                        <i class="fa fa-edit tex-white"></i> {{ __('Edit') }}
                                    </a>
                                @endcan

                                @if(!$tap->keg)
                                    @can('delete')
                                        <delete-button url="{{ route('taps.delete', $tap) }}"></delete-button>
                                    @endcan
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

            @include('partials.pagination', ['data' => $taps])
        </div>
    </div>
@endsection
