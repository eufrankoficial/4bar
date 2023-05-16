<div class="card">
    <div class="body">
        <h5 class="title">{{ __('Search') }}</h5>
        <form action="{{ route('maintenance.index') }}" method="GET">

            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>{{ __('Titulo') }}</label>
                        <input type="text" class="form-control" placeholder="{{ __('Titulo') }}" name="name" value="{{ old('name', request()->get('name')) }}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>{{ __('Tipo') }}</label>
                        <select name="type" class="form-control">
                            <option value="">{{ __('Choose') }}</option>
                            @foreach($types as $key => $t)
                                <option value="{{ $key }}" @if(request()->get('type') == $key) selected @endif>{{ $t }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 text-left">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-search"></i> {{ __('Search') }}
                    </button>
                    <a href="{{ route('maintenance.index') }}" class="btn btn-warning">
                        <i class="fa fa-close"></i> {{ __('Clear search') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
