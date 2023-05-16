@extends('layouts.default', ['pageTitle' => __('Add new user'), 'breadcrumb' => 'users.add'])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('users.save.post') }}" method="POST">

                        @csrf

                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" class="form-control @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Email') }}</label>
                                    <input type="text" class="form-control @error('email') parsley-error @enderror" placeholder="{{ __('E-mail') }}" name="email" value="{{ old('email') }}">
                                </div>

                                @error('email')
                                    <ul class="parsley-errors-list filled" id="parsley-id-31">
                                        <li class="parsley-required list-unstyled">
                                            {{ $message }}
                                        </li>
                                    </ul>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Password') }}</label>
                                    <input type="password" class="form-control @error('password') parsley-error @enderror" placeholder="{{ __('Password') }}" name="password">
                                </div>

                                @error('password')
                                <ul class="parsley-errors-list filled" id="parsley-id-31">
                                    <li class="parsley-required list-unstyled">
                                        {{ $message }}
                                    </li>
                                </ul>
                                @enderror
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Type user') }}</label>
                                    @if(current_user()->hasRole('SuperAdmin'))
                                        <div class="@error('role') parsley-error @enderror multiselect_div">
                                            <select name="role[]" class="multiselect-custom multiselect" multiple="multiple">
                                                @foreach($groups as $group)
                                                    <option value="{{ $group->name }}">{{ $group->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <select name="role[]" class="form-control custom-select">
                                            <option value="">{{ __('Choose') }}</option>
                                            @foreach($groups as $group)
                                                <option value="{{ $group->name }}">{{ $group->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    @error('role')
                                    <ul class="parsley-errors-list filled" id="parsley-id-31">
                                        <li class="parsley-required list-unstyled">
                                            {{ $message }}
                                        </li>
                                    </ul>
                                    @enderror
                                </div>
                            </div>

                            @if(current_user()->hasRole('SuperAdmin'))
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Branchs') }}</label>
                                        <div class="@error('branchs') parsley-error @enderror multiselect_div">
                                            <select name="branchs[]" class="multiselect-custom multiselect" multiple="multiple">
                                                <option value="">{{ __('Select') }}</option>
                                                @foreach($branchs as $key => $branch)
                                                    <option value="{{ $key }}">{{ $branch }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif

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
