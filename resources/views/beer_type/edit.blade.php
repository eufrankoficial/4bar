@extends('layouts.default', ['pageTitle' => __('New'), 'breadcrumb' => 'beer_type.edit', 'param' => $type])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('beer_type.update.post', $type) }}" method="POST">

                        @csrf

                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" class="form-control @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', $type->name) }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('IBU') }}</label>
                                    <input type="text" class="form-control @error('ibu') parsley-error @enderror" placeholder="{{ __('IBU') }}" name="ibu" value="{{ old('ibu', $type->ibu) }}">
                                </div>
                            </div>
                        </div>

                        @if(current_user()->hasRole('SuperAdmin'))
                            <select-org-branch orgsselect="{{ $orgs }}" org="{{ $type->organization_id }}" branch="{{ $type->branch_id }}"></select-org-branch>
                        @endif

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
