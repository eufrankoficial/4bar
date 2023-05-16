<div class="card">
    <div class="body">
        <h5 class="title">{{ __('Search') }}</h5>
        <form action="{{ route('beer_type.index') }}" method="GET">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" class="form-control" placeholder="{{ __('Name') }}" name="name" value="{{ old('name', request()->get('name')) }}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group">
                        <label>{{ __('Status') }}</label>
                        <div class="multiselect_div">
                            <select name="status[]" class="multiselect-custom multiselect" multiple="multiple">
                                @foreach($status as $s)
                                    <option value="{{ $s }}" @if(is_array(request()->get('status')) && in_array($s, request()->get('status'))) selected @endif>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 text-left">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-search"></i> {{ __('Search') }}
                    </button>
                    <a href="{{ route('beer_type.index') }}" class="btn btn-warning">
                        <i class="fa fa-close"></i> {{ __('Clear search') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
