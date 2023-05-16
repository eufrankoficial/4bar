

<div class="modal-header">
    <h5 class="modal-title" id="exampleModalCenterTitle">
        <i class="fa fa-bell font-22 badge-warning"></i> {{ __('Alerts') }} - {{ $coldChamber->name }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form action="{{ route('alerts.save.cold_chamber.post', $coldChamber) }}" method="POST">

    @csrf

    <div class="modal-body">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Type') }}</label>
                    <select class="form-control custom-select" name="type" readonly>
                        <option value="Camara Fria">Camara Fria</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Name') }}</label>
                    <input type="text" class="form-control @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Initial') }}</label>
                    <input type="number" class="form-control @error('from') parsley-error @enderror" placeholder="{{ __('Value from') }}" name="value_from" value="{{ old('value_from') }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Final') }}</label>
                    <input type="number" class="form-control @error('to') parsley-error @enderror" placeholder="{{ __('Value to') }}" name="value_to" value="{{ old('value_to') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-round btn-primary">{{ __('Save') }}</button>
    </div>

    <div class="modal-body">
        <div>
            @forelse($warnings as $warning)
                <div class="form-group">
                    <label class="d-block">{{ $warning->name }}
                        <span class="float-right">{{ $warning->value_from }}º a {{ $warning->value_to }}
                            <a href="{{ route('alerts.delete', $warning) }}">
                                <i class="icon-trash"></i>
                            </a>
                        </span>
                    </label>


                </div>
            @empty

            @endforelse
        </div>
    </div>
</form>
