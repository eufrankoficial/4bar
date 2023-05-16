@extends('layouts.default', ['pageTitle' => __('Add group'), 'breadcrumb' => 'users.group.add'])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('users.group.save.post') }}" method="POST">

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
                                    <label>{{ __('Theme') }}</label>
                                    <div class="multiselect_div">
                                        <select name="theme" class="multiselect-custom multiselect">
                                            <option value="black">Black version</option>
                                            <option value="light_version">light_version</option>
                                        </select>
                                        </div>
                                </div>
                            </div>



                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Permissions') }}</label>
                                    <div class="@error('permission') parsley-error @enderror multiselect_div">
                                        <select name="permission[]" class="multiselect-custom multiselect" multiple="multiple">
                                            @foreach($permissions as $permission)
                                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Menus') }}</label>
                                    <div class="@error('menus') parsley-error @enderror multiselect_div">
                                        <select name="menus[]" class="multiselect-custom multiselect" multiple="multiple">
                                            @foreach($menus as $menu)
                                                @if($menu->parents->count() > 0)
                                                    <optgroup label="{{ $menu->menu }}">
                                                        @foreach($menu->parents as $parent)
                                                            <option value="{{ $parent->id }}">{{ $parent->menu }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @else
                                                    <optgroup label="{{ $menu->menu }}">
                                                        <option value="{{ $menu->id }}">{{ $menu->menu }}</option>
                                                    </optgroup>
                                                @endif
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
