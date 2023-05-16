

<div class="modal-header">
    <h5 class="modal-title" id="exampleModalCenterTitle">
        <i class="fa fa-bell font-22 badge-warning"></i> {{ __('Alerts') }} - {{ $keg->name }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form action="{{ route('alerts.save.keg.post', $keg) }}" method="POST">

    @csrf

    <div class="modal-body">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Type') }}</label>
                    <select class="form-control custom-select" name="type" readonly>
                        <option value="Barril">Barril</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Name') }}</label>
                    <input type="text" class="form-control @error('name') parsley-error @enderror" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>{{ __('Limit. Below') }} % </label>
                    <input type="number" class="form-control @error('value_from') parsley-error @enderror" placeholder="{{ __('Value from') }}" name="value_from" value="{{ old('value_from') }}">
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
                    <label class="d-block">{{ $warning->name }} <a href="{{ route('alerts.delete', $warning) }}"><i class="fa fa-trash text-danger"></i></a>
                        <span class="float-right">{{ $warning->value_from }}%</span>
                    </label>
                    <div class="progress progress-xxs">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $warning->value_from  }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $warning->value_from  }}%;"></div>
                    </div>
                </div>
            @empty

            @endforelse
        </div>
    </div>
</form>
