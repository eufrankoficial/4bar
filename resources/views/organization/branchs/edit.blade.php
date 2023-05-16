@extends('layouts.default', ['pageTitle' => $branch->name, 'breadcrumb' => 'orgs.branchs.edit', 'param' => [$org, $branch]])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('orgs.branchs.update.post', [$org, $branch]) }}" method="POST" id="branch">
                        @csrf

                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" class="form-control @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', $branch->name) }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Phone') }}</label>
                                    <input type="text" class="form-control @error('phone') parsley-error @enderror phone" placeholder="{{ __('Phone') }}" name="phone" value="{{ old('phone', $branch->phone) }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Address') }}</label>
                                    <input type="text" class="form-control @error('address') parsley-error @enderror" placeholder="{{ __('Address') }}" name="address" value="{{ old('address', $branch->address) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Number of Emploees') }}</label>
                                    <input type="number" class="form-control @error('number_of_employees') parsley-error @enderror" placeholder="{{ __('Number of Emploees') }}" name="number_of_employees" value="{{ old('number_of_employees', $branch->number_of_employees) }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('CNPJ/CPF') }}</label>
                                    <input type="text" class="form-control @error('cnpj') parsley-error @enderror cnpj" placeholder="{{ __('CNPJ') }}" name="cnpj" value="{{ old('cnpj', $branch->cnpj) }}">
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
