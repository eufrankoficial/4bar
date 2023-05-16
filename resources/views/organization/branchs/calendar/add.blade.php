@extends('layouts.default', ['pageTitle' => __('New Calendar') . ' - ' . $branch->name, 'breadcrumb' => 'orgs.branchs.calendar.add', 'param' => [$branch->org, $branch]])

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="body">
                    <form action="{{ route('orgs.branchs.calendar.save.post', [$branch->org, $branch]) }}" method="POST" id="branch">
                        @csrf

                        <div class="row">

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Week Day') }}</label>
                                    <select class="form-control custom-select @error('week_day') parsley-error @enderror" name="week_day">
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach($days as $day)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Opening Time') }}</label>
                                    <input type="text" class="form-control @error('opening_time') parsley-error @enderror time" placeholder="{{ __('Opening Time') }}" name="opening_time" value="{{ old('opening_time') }}">
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>{{ __('Closing Time') }}</label>
                                    <input type="text" class="form-control @error('closing_time') parsley-error @enderror time" placeholder="{{ __('Closing Time') }}" name="closing_time" value="{{ old('closing_time') }}">
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
