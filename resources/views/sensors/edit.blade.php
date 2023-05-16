<div class="modal-header">
    <h5 class="modal-title" id="exampleModalCenterTitle">
        <i class="fa fa-desktop font-22 badge-warning"></i> {{ __('Edit sensor') }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form action="{{ route('sensors.update.post', $sensor) }}" method="POST">

    @csrf

    <div class="modal-body">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Device') }}</label>
                    <select class="form-control custom-select" name="device_id">
                        <option value="">{{ __('Chooose') }}</option>
                        @foreach($devices as $device)
                            <option value="{{ $device->id }}" @if($device->id == $sensor->device_id) selected @endif>{{ $device->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Type') }}</label>
                    <select class="form-control custom-select" name="sensor_type_id">
                        <option value="">{{ __('Chooose') }}</option>
                        @foreach($sensorTypes as $type)
                            <option value="{{ $type->id }}" @if($sensor->sensor_type_id == $type->id) selected @endif>{{ $type->sensor_type_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Name') }}</label>
                    <input type="text" class="form-control @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', $sensor->name) }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Flow rate') }}</label>
                    <input type="text" class="form-control decimal @error('flow_rate') parsley-error @enderror" placeholder="{{ __('Flow rate') }}" name="flow_rate" value="{{ old('flow_rate', $sensor->flow_rate) }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Device Port') }}</label>
                    <input type="number" class="form-control decimal @error('device_port') parsley-error @enderror" placeholder="{{ __('Device Port') }}" name="device_port" value="{{ old('device_port', $sensor->device_port) }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Stop Pouring Dalay') }}</label>
                    <input type="number" class="form-control @error('stop_pouring_delay') parsley-error @enderror" placeholder="{{ __('Stop Pouring Dalay') }}" name="stop_pouring_delay" value="{{ old('stop_pouring_delay', $sensor->stop_pouring_delay) }}">
                </div>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-round btn-primary">{{ __('Save') }}</button>
    </div>
</form>
