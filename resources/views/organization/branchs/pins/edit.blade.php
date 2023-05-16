@extends('layouts.default',
    [
        'pageTitle' => __('Edit ') . $pin->pin,
        'breadcrumb' => 'pins.edit',
        'param' => $pin
    ])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('pins.update.post', $pin)  }}" method="POST">

                        @csrf

                        <select-org-branch orgsselect="{{ $orgs }}" org="{{ $pin->organization_id }}" branch="{{ $pin->branch_id }}"></select-org-branch>

                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Pin') }}</label>
                                    <input type="text" class="form-control @error('pin') parsley-error @enderror" placeholder="{{ __('Pin') }}" name="pin" value="{{ old('pin', $pin->pin) }}">
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
