<div class="modal-header">
    <h5 class="modal-title" id="exampleModalCenterTitle">
        <i class="fa fa-desktop font-22 badge-warning"></i> {{ __('Assign tap to barrel ') }} {{ $keg->ping_keg . ' - ' . $keg->name }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form action="{{ route('kegs.taps_add.post', $keg) }}" method="POST">

    @csrf

    <div class="modal-body">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Tap') }}</label>
                    <select class="form-control custom-select" name="tap_id" required>
                        <option value="">{{ __('Choose') }}</option>
                        @foreach($taps as $tap)
                            <option value="{{ $tap->id }}" @if($keg->tap_id == $tap->id) selected @endif>{{ $tap->name }}</option>
                        @endforeach
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
