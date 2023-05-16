@extends('layouts.default',
    [
        'pageTitle' => __('New Branch'),
        'breadcrumb' => isset($org) ? 'orgs.branchs.add' : 'branchs.add',
        'param' => isset($org) ? $org : null
    ])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ isset($org) ? route('orgs.branchs.save.post', $org) : route('branchs.save.post') }}" method="POST" id="branch">
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
                                    <label>{{ __('Phone') }}</label>
                                    <input type="text" class="form-control @error('phone') parsley-error @enderror phone" placeholder="{{ __('Phone') }}" name="phone" value="{{ old('phone') }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Address') }}</label>
                                    <input type="text" class="form-control @error('address') parsley-error @enderror" placeholder="{{ __('Address') }}" name="address" value="{{ old('address') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Number of Emploees') }}</label>
                                    <input type="number" class="form-control @error('number_of_employees') parsley-error @enderror" placeholder="{{ __('Number of Emploees') }}" name="number_of_employees" value="{{ old('number_of_employees') }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __(' CNPJ/CPF') }}</label>
                                    <input type="text" class="form-control @error('cnpj') parsley-error @enderror cnpj_cpf" placeholder="{{ __('CNPJ') }}" name="cnpj" value="{{ old('cnpj') }}">
                                </div>
                            </div>

                            @if(!isset($org) || current_user()->hasRole('SuperAdmin'))
                                <div class="col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label>{{ __('Organization') }}</label>
                                        <select class="form-control custom-select" name="organization_id">
                                            <option value="">{{ __('Choose') }}</option>
                                            @foreach($orgs as $o)
                                                <option value="{{ $o->id }}">{{ $o->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
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
