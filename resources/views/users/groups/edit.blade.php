@extends('layouts.default', ['pageTitle' => $group->name, 'breadcrumb' => 'users.group.edit', 'param' => $group])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('users.group.update.post', $group->slug) }}" method="POST">

                        @csrf

                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" class="form-control @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', $group->name) }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Theme') }}</label>
                                    <div class="multiselect_div">
                                        <select name="theme" class="multiselect-custom multiselect">
                                            <option value="black" @if($group->theme == 'black') selected @endif>Black version</option>
                                            <option value="light_version" @if($group->light_version == 'light_version') selected @endif>light_version</option>
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
                                                <option value="{{ $permission->id }}" @if(in_array($permission->name, $groupPermissions)) selected  @endif >{{ $permission->name }}</option>
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
                                                            <option value="{{ $parent->id }}" @if(in_array($parent->id, $menusGroup)) selected  @endif>{{ $parent->menu }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @else
                                                    <optgroup label="{{ $menu->menu }}">
                                                        <option value="{{ $menu->id }}" @if(in_array($menu->id, $menusGroup)) selected  @endif>{{ $menu->menu }}</option>
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
