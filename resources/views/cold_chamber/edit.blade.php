<div class="modal-header">
    <h5 class="modal-title" id="exampleModalCenterTitle">
        <i class="fa fa-desktop font-22 badge-warning"></i> {{ __('New Cold Chamber') }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form action="{{ route('cold_chamber.update.post', $coldChamber) }}" method="POST">

    @csrf

    <div class="modal-body">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Status') }}</label>
                    <select class="form-control custom-select" name="status">
                        <option value="Ativo" @if($coldChamber->status == 'Ativo') selected @endif>Ativo</option>
                        <option value="Inativo" @if($coldChamber->status == 'Inativo') selected @endif>Inativo</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Sensors') }}</label>
                    <select class="form-control custom-select" name="sensor_id" readonly>
                        @foreach($sensors as $sensor)
                            <option value="{{ $sensor->sensor_id }}" @if($sensor->id == $coldChamber->sensor_id) selected @endif>{{ $sensor->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Capacity') }}</label>
                    <input type="number" class="form-control decimal @error('capacity') parsley-error @enderror" placeholder="{{ __('Capacity') }}" name="capacity" value="{{ old('capacity', $coldChamber->capacity) }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Name') }}</label>
                    <input type="text" class="form-control decimal @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', $coldChamber->name) }}">
                </div>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-round btn-primary">{{ __('Save') }}</button>
    </div>
</form>
