@extends('layouts.default', ['pageTitle' => __('New'), 'breadcrumb' => 'orgs.add'])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('orgs.save.post') }}" method="POST">

                        @csrf

                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" class="form-control @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <ul class="parsley-errors-list filled" id="parsley-id-31">
                                            <li class="parsley-required list-unstyled">
                                                {{ $message }}
                                            </li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Administrator') }}</label>
                                    <select class="form-control custom-select @error('administrator_id') parsley-error @enderror" name="administrator_id">
                                        <option value="">{{ __('Choose...') }}</option>
                                        @foreach($users as $key => $user)
                                            <option value="{{ $key }}" @if($key == old('administrator_id')) selected @endif > {{ $user }}</option>
                                        @endforeach
                                    </select>

                                    @error('administrator_id')
                                        <ul class="parsley-errors-list filled" id="parsley-id-.31">

                                                <li class="parsley-required list-unstyled">
                                                    {{ $message }}
                                                </li>
                                        </ul>
                                    @enderror
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
