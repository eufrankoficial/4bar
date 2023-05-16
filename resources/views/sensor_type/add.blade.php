@extends('layouts.default', ['pageTitle' => __('New'), 'breadcrumb' => 'sensor_type.add'])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('sensor_type.save.post') }}" method="POST">

                        @csrf

                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" class="form-control @error('sensor_type_name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="sensor_type_name" value="{{ old('sensor_type_name') }}">
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
