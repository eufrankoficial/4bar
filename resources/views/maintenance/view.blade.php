<div class="modal-header">
    <h5 class="modal-title" id="exampleModalCenterTitle">
        <i class="fa fa-cogs font-22 badge-warning"></i> {{ __('Maintenance') }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form>
    <div class="modal-body">
        @if($maintenance->device)
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>{{ __('Device') }}</label>
                        <select class="form-control custom-select" disabled>
                            <option selected>{{ $maintenance->device->name  }}</option>
                        </select>
                    </div>
                </div>
            </div>
        @elseif($maintenance->tap)
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>{{ __('Tap') }}</label>
                        <select class="form-control custom-select" disabled>
                            <option>{{ $maintenance->tap->name }}</option>
                        </select>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>{{ __('Cold chamer') }}</label>
                        <select class="form-control custom-select" disabled>
                            <option>{{ $maintenance->coldChamber->name }}</option>
                        </select>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Title') }}</label>
                    <input type="text" class="form-control" placeholder="{{ __('Title') }}" value="{{ $maintenance->name }}" disabled>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Description') }}</label>
                    <textarea class="form-control" rows="5" cols="30" disabled>{!! $maintenance->description !!}</textarea>
                </div>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">{{ __('Close') }}</button>
    </div>
</form>
