@extends('layouts.default', ['pageTitle' => __('New'), 'breadcrumb' => 'kegs.add'])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('kegs.save.post') }}" method="POST">
                        @csrf

                        @if(current_user()->hasRole('SuperAdmin'))
                            <select-org-branch orgsselect="{{ $orgs }}" org="false" branch="false"></select-org-branch>
                        @endif

                        <div class="row">
                            <div class="col-lg-3 col-md-2">
                                <div class="form-group">
                                    <label>{{ __('PIN') }}</label>
                                    <select class="form-control custom-select @error('pin_keg') parsley-error @enderror" name="pin_keg">
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach($pins as $pin)
                                            <option value="{{ $pin->pin }}" @if(old('pin_keg') == $pin->pin) selected @endif>{{ $pin->pin }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-2">
                                <div class="form-group">
                                    <label>{{ __('Beer Type') }}</label>
                                    <select class="form-control custom-select @error('beer_type_id') parsley-error @enderror" name="beer_type_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach($beerTypes as $type)
                                            <option value="{{ $type->id }}" @if(old('beer_type_id') == $type->id) selected @endif>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>{{ __('Supplier') }}</label>
                                    <select class="form-control custom-select @error('supplier_id') parsley-error @enderror" name="supplier_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach($suppliers as $sup)
                                            <option value="{{ $sup->id }}" @if(old('supplier_id') == $sup->id) selected @endif>{{ $sup->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>{{ __('Capacity') }}</label>
                                    <input type="number" class="form-control @error('capacity') parsley-error @enderror limit" placeholder="{{ __('Ex.: 100') }}" maxlength="3" name="capacity" value="{{ old('capacity') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label>{{ __('Due date') }}</label>
                                    <input type="text" data-date-format="dd/mm/yyyy" class="form-control @error('due_date') parsley-error @enderror datepicker" placeholder="{{ __('Due date') }}" name="due_date" value="{{ old('due_date') }}">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>{{ __('Cold Chamber') }}</label>
                                    <select class="form-control custom-select @error('cold_chamber_id') parsley-error @enderror" name="cold_chamber_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach($coldChambers as $coldChamber)
                                            <option value="{{ $coldChamber->id }}">{{ $coldChamber->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Beer name') }}</label>
                                    <input type="text" class="form-control @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}">
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
