@extends('layouts.default', ['pageTitle' => $user->name, 'breadcrumb' => 'users.edit', 'param' => $user])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('users.update.post', $user->slug) }}" method="POST">

                        @csrf

                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" class="form-control @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', $user->name) }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Email') }}</label>
                                    <input type="text" class="form-control @error('email') parsley-error @enderror" placeholder="{{ __('E-mail') }}" name="email" value="{{ old('email', $user->email) }}">
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
                                    <input type="password" class="form-control" placeholder="{{ __('Password') }}" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Type user') }}</label>
                                    <div class="@error('role') parsley-error @enderror multiselect_div">
                                        <select name="role[]" class="multiselect-custom multiselect" multiple="multiple">
                                            @foreach($groups as $group)
                                                <option value="{{ $group->name }}" @if($user->hasRole($group->name)) selected @endif>{{ $group->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Branchs') }}</label>
                                    <div class="@error('branchs') parsley-error @enderror multiselect_div">
                                        <select name="branchs[]" class="multiselect-custom multiselect" multiple="multiple">
                                            @foreach($branchs as $key => $branch)
                                                <option value="{{ $key }}" @if(in_array($key, $userBranchs)) selected="selected" @endif>{{ $branch }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

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
