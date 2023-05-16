@extends('layouts.default', ['pageTitle' => $organization->name, 'breadcrumb' => 'orgs.edit', 'param' => $organization])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('orgs.update.post', $organization) }}" method="POST">

                        @csrf

                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" class="form-control @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', $organization->name) }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Administrator') }}</label>
                                    <select class="form-control custom-select @error('administrator_id') parsley-error @enderror" name="administrator_id">
                                        <option>{{ __('Choose...') }}</option>
                                        @foreach($users as $key => $user)
                                            <option value="{{ $key }}" @if($key === $organization->administrator_id) selected @endif> {{ $user }}</option>
                                        @endforeach
                                    </select>
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
