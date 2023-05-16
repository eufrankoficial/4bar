<div class="modal-header">
    <h5 class="modal-title" id="exampleModalCenterTitle">
        <i class="fa fa-desktop font-22 badge-warning"></i> {{ __('New tap') }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form action="{{ route('taps.save.post') }}" method="POST">

    @csrf

    <div class="modal-body">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Sensor') }}</label>
                    <select class="form-control custom-select" name="sensor_id">
                        <option value="">{{ __('Choose') }}</option>
                        @foreach($sensors as $sensor)
                            <option value="{{ $sensor->id }}">{{ $sensor->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Keg') }}</label>
                    <select class="form-control custom-select" name="keg_id">
                        <option value="">{{ __('Chooose') }}</option>
                        @foreach($kegs as $keg)
                            <option value="{{ $keg->id }}">{{ $keg->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Name') }}</label>
                    <input type="text" class="form-control decimal @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Status') }}</label>
                    <select class="form-control custom-select" name="status">
                        <option value="Ativo">{{ __('Active') }}</option>
                        <option value="Inativo">{{ __('Inactive') }}</option>
                    </select>
                </div>
            </div>
        </div>


    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-round btn-primary">{{ __('Save') }}</button>
    </div>
</form>
