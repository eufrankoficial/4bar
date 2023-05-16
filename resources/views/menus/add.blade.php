@extends('layouts.default', ['pageTitle' => __('New'), 'breadcrumb' => 'menu.add'])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('menu.save.post') }}" method="POST">

                        @csrf

                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Menu') }}</label>
                                    <input type="text" class="form-control @error('menu') parsley-error @enderror" placeholder="{{ __('Menu') }}" name="menu" value="{{ old('menu') }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Icon') }}</label>
                                    <input type="text" class="form-control" placeholder="{{ __('Icon') }}" name="icon" value="{{ old('icon') }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Route') }}</label>
                                    <input type="text" class="form-control" placeholder="{{ __('Route') }}" name="route" value="{{ old('route') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Parents') }}</label>
                                    <div class="multiselect_div">
                                        <select name="parents[]" class="multiselect-custom multiselect" multiple="multiple">
                                            @foreach($menus as $m)
                                                <option value="{{ $m->slug }}">{{ $m->menu }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
