<div class="row">
    <div class="col-lg-3 col-md-3">
        <div class="form-group">
            <label>{{ __('Week Day') }}</label>
            <select class="form-control custom-select @error('week_day') parsley-error @enderror" readonly="readonly" name="calendar[{{ $day }}][week_day]">
                <option value="{{ $day }}">{{ $day }}</option>
            </select>
        </div>
    </div>

    <div class="col-lg-2 col-md-2">
        <div class="form-group">
            <label>{{ __('Open') }}</label>
            <input type="text" class="form-control @error('opening_time') parsley-error @enderror time" placeholder="00:00" name="calendar[{{ $day }}][opening_time]" value="{{ isset($calendar) ? $calendar->opening_time : old('opening_time') }}">
        </div>
    </div>

    <div class="col-lg-2 col-md-2">
        <div class="form-group">
            <label>{{ __('Close') }}</label>
            <input type="text" class="form-control @error('closing_time') parsley-error @enderror time" placeholder="00:00" name="calendar[{{ $day }}][closing_time]" value="{{ isset($calendar) ? $calendar->closing_time : old('closing_time') }}">
        </div>
    </div>
</div>
