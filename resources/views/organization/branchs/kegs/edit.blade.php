@extends('layouts.default', ['pageTitle' => $keg->pin_keg, 'breadcrumb' => 'kegs.edit', 'param' => $keg])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="row">
                @if(!$keg->taps)
                    <div class="col-lg-3 col-md-6">
                        <out-keg-register-button keg="{{ $keg }}" url="{{ route('kegs.out', $keg) }}"></out-keg-register-button>
                    </div>
                @endif

                @if($keg->taps)
                    <div class="col-lg-3 col-md-6">
                        <change-keg-tap getpinurl="{{ route('pins.get') }}" tapprop="{{ $keg->taps }}" kegprop="{{ $keg }}" url="{{ route('taps.change.keg') }}"></change-keg-tap>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <realease-tap urlreleasetap="{{ route('taps.realease.post', $keg->taps->slug) }}"></realease-tap>
                    </div>
                @endif
            </div>

            <div class="card">
                <div class="body">
                    <form action="{{ route('kegs.update.post', $keg) }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label>{{ __('PIN') }}</label>
                                    <input type="text" class="form-control @error('pin_keg') parsley-error @enderror" readonly placeholder="{{ __('PIN') }}" name="pin_keg" value="{{ old('pin_keg', $keg->pin_keg) }}">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label>{{ __('Status') }}</label>
                                    <select class="form-control custom-select @error('status') parsley-error @enderror" name="status">
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach($status as $s)
                                            <option value="{{ $s }}" @if($s === $keg->status) selected @endif>{{ $s }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label>{{ __('Beer Type') }}</label>
                                    <select class="form-control custom-select @error('beer_type_id') parsley-error @enderror" name="beer_type_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach($beerTypes as $type)
                                            <option value="{{ $type->id }}" @if($type->id === $keg->beer_type_id) selected @endif>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label>{{ __('Supplier') }}</label>
                                    <select class="form-control custom-select @error('supplier_id') parsley-error @enderror" name="supplier_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach($suppliers as $sup)
                                            <option value="{{ $sup->id }}" @if($sup->id === $keg->supplier_id) selected @endif>{{ $sup->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label>{{ __('Capacity') }}</label>
                                    <input type="number" class="form-control @error('capacity') parsley-error @enderror limit" placeholder="{{ __('Ex.: 100') }}"  @if($keg->capacity > $keg->volume_available) readonly @endif maxlength="3" name="capacity" value="{{ old('capacity', $keg->capacity) }}">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label>{{ __('Available') }}</label>
                                    <input type="text" readonly class="form-control @error('volume_available') parsley-error @enderror decimal2" placeholder="{{ __('Volume Available') }}" name="volume_available" value="{{ old('volume_available', $keg->volume_available_view) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label>{{ __('Entry') }}</label>
                                    <input type="text" readonly data-date-format="dd/mm/yyyy" class="form-control @error('inbound_datetime') parsley-error @enderror datepicker" placeholder="{{ __('Entry date') }}" name="inbound_datetime" value="{{ old('inbound_datetime', $keg->inbound_datetime) }}">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label>{{ __('Out') }}</label>
                                    <input type="text" data-date-format="dd/mm/yyyy" @if($keg->outbound_datetime) readonly @endif class="form-control datepicker" placeholder="{{ __('Out date') }}" name="outbound_datetime" value="{{ old('outbound_datetime', $keg->outbound_datetime) }}">
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label>{{ __('Due date') }}</label>
                                    <input type="text" data-date-format="dd/mm/yyyy" class="form-control @error('due_date') parsley-error @enderror datepicker" placeholder="{{ __('Due date') }}" name="due_date" value="{{ old('due_date', $keg->due_date) }}">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>{{ __('Cold Chamber') }}</label>
                                    <select class="form-control custom-select @error('cold_chamber_id') parsley-error @enderror" name="cold_chamber_id">
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach($coldChambers as $coldChamber)
                                            <option value="{{ $coldChamber->id }}" @if($keg->cold_chamber_id == $coldChamber->id) selected @endif>{{ $coldChamber->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" class="form-control @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', $keg->name) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-12 text-left">
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
