@extends('layouts.default', ['pageTitle' => $supplier->name, 'breadcrumb' => 'supplier.edit', 'param' => $supplier])
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('supplier.update.post', $supplier) }}" method="POST">

                        @csrf

                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" class="form-control @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', $supplier->name) }}">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>{{ __('Type') }}</label>
                                    <select class="form-control custom-select @error('type') parsley-error @enderror" name="type">
                                        <option value="">{{ __('Choose...') }}</option>
                                        @foreach($types as $key => $type)
                                            <option value="{{ $key }}" @if($supplier->type == $key) selected @endif> {{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label>{{ __('CPF/CNPJ') }}</label>
                                    <input type="text" class="form-control @error('cpf_cnpj') parsley-error @enderror cnpj_cpf" placeholder="{{ __('CPF/CNPJ') }}" name="cpf_cnpj" value="{{ old('cnpj_cpf', $supplier->cpf_cnpj) }}">
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-lg-5 col-md-5">
                                <div class="form-group">
                                    <label>{{ __('Address') }}</label>
                                    <input type="text" class="form-control @error('address') parsley-error @enderror" placeholder="{{ __('Address') }}" name="address" value="{{ old('address', $supplier->address) }}">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>{{ __('Contact') }}</label>
                                    <input type="text" class="form-control @error('contact') parsley-error @enderror" placeholder="{{ __('Contact') }}" name="contact" value="{{ old('contact', $supplier->contact) }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('E-mail') }}</label>
                                    <input type="email" class="form-control @error('email') parsley-error @enderror" placeholder="{{ __('E-mail') }}" name="email" value="{{ old('email', $supplier->email) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>{{ __('Phone') }}</label>
                                    <input type="text" class="form-control @error('phone') parsley-error @enderror phone" placeholder="{{ __('Phone') }}" name="phone" value="{{ old('phone', $supplier->phone) }}">
                                </div>
                            </div>

                            @if(current_user()->hasRole('SuperAdmin'))
                                <select-org-branch orgsselect="{{ $orgs }}" org="{{ $supplier->organization_id }}" branch="{{ $supplier->branch_id }}"></select-org-branch>
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
