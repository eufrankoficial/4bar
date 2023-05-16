@extends('layouts.default', ['pageTitle' => __('Edit'), 'breadcrumb' => 'devices.edit', 'param' => $device])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('devices.update.post', $device) }}" method="POST">

                        @csrf

                        @if(current_user()->hasRole('SuperAdmin'))
                            <select-org-branch orgsselect="{{ $orgs }}" org="{{ $device->organization_id }}" branch="{{ $device->branch_id }}"></select-org-branch>
                        @endif

                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" class="form-control @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', $device->name) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 text-left">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
